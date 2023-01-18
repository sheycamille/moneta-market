<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Controllers\Controller;
use App\Libraries\MobiusTrader;
use App\Mail\NewNotification;

use App\Models\User;
use App\Models\Admin;
use App\Models\Setting;
use App\Models\Country;
use App\Models\Deposit;
use App\Models\Trader7;
use App\Models\Withdrawal;
use App\Models\TpTransaction;
use Carbon\Carbon;


class UsersController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:muser-list|muser-create|muser-edit|muser-delete', ['only' => ['index']]);
        $this->middleware('permission:muser-create', ['only' => ['store']]);
        $this->middleware('permission:muser-edit', ['only' => ['update', 'dellaccounts']]);
        $this->middleware('permission:muser-block', ['only' => ['ublock', 'unblock', '']]);
        $this->middleware('permission:muser-messageall', ['only' => ['sendmailtooneuser', 'sendmailtoall']]);
        $this->middleware('permission:muser-access-account', ['only' => ['switchtouser']]);
        $this->middleware('permission:muser-access-wallet', ['only' => ['userwallet']]);
        $this->middleware('permission:muser-reset-password', ['only' => ['resetpswd']]);
        $this->middleware('permission:muser-credit-debit', ['only' => ['topup']]);
        $this->middleware('permission:muser-delete', ['only' => ['destroy']]);
        $this->middleware('permission:mkyc-validate', ['only' => ['acceptkyc', 'rejectkyc', 'resetkyc']]);
    }


    // Return manage users route
    public function index()
    {
        $countries = Country::get();
        $users = User::latest()->get();

        return view('admin.users')
            ->with(array(
                'title' => 'All users',
                'countries' => $countries,
                'users' => $users
            ));
    }

    public function getactions(Request $request, $id)
    {
        $user = User::find($id);

        if(!$user) return '';

        if(auth('admin')->user()->hasPermissionTo('muser-reset-password', 'admin')) {
            $action = '<a href="#" data-toggle="modal" data-target="#resetpswdModal' . $user->id .'" class="m-1 btn btn-warning btn-xs">Reset Password</a>';
        }
        if (auth('admin')->user()->hasPermissionTo('muser-block', 'admin')) {
            if ($user->status == null || $user->status == 'blocked') {
                $action .= '<a class="m-1 btn btn-primary btn-sm"
                href="'. route('userunblock', $user->id) .'">Unblock</a>';
            }
            else {
                $action .= '<a class="m-1 btn btn-danger btn-sm"
                href="'. route('userublock', $user->id) .'">Block</a>';
            }
        }
        if (auth('admin')->user()->hasPermissionTo('muser-access-wallet', 'admin')) {
            $action .= '<a class="m-1 btn btn-info btn-sm" href="'. route('userwallet', $user->id) .'">See Wallet</a>';
        }
        if (auth('admin')->user()->hasPermissionTo('muser-credit-debit', 'admin')) {
            $action .= '<a href="#" data-toggle="modal" data-target="#topupModal'. $user->id .'" class="m-1 btn btn-dark btn-xs">Topup</a>';
        }
        if (auth('admin')->user()->hasPermissionTo('muser-edit', 'admin')) {
            $action .= '<a href="#" data-toggle="modal" data-target="#edituser'. $user->id .'" class="m-1 btn btn-secondary btn-xs">Edit</a>';
        }
        if (auth('admin')->user()->hasPermissionTo('muser-delete', 'admin')) {
            $action .= '<a href="#" data-toggle="modal" data-target="#deleteModal'. $user->id .'" class="m-1 btn btn-danger btn-xs">Delete</a>';
        }
        // if(count($user->accounts()) > 1) {
        //     $action .= ' <a href="#" data-toggle="modal" data-target="#liveaccounts'. $user->id . '" class="m-1 btn btn-danger btn-xs">Delete Accounts</a>';
        // }
        if (auth('admin')->user()->hasPermissionTo('muser-messageall', 'admin')) {
            $action .= '<a href="#" data-toggle="modal" data-target="#sendmailtooneuserModal'. $user->id .'" class="m-1 btn btn-info btn-xs">Message</a>';
        }
        if (auth('admin')->user()->hasPermissionTo('muser-access-account', 'admin')) {
            $action .= '<a href="#" data-toggle="modal"
            data-target="#switchuserModal'. $user->id .'" class="m-2 btn btn-success btn-xs">Get access</a>';
        }

        $countries = Country::all();
        $action .= view('admin.users_actions', compact('user', 'countries'))->render();

        return $action;
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'Answer' => 'same:Captcha_Result',
        ]);

        $thisid = DB::table('users')->insertGetId(
            [
                'name' => $request['name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'ref_by' => Auth::user()->id,
                'password' => Hash::make($request->password),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        //assign referal link to user
        $site_address = Setting::getValue('site_address');

        User::where('id', $thisid)
            ->update([
                'ref_link' => $site_address . '/ref/' . $thisid,
            ]);
        return redirect()->back()
            ->with('message', 'User Registered Sucessful!');
    }


    // update users info
    public function update(Request $request)
    {
        User::where('id', $request['user_id'])
            ->update([
                'name' => $request->first_name . ' ' . $request->last_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'dob' => $request->dob,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'town' => $request->town,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'country_id' => $request->country,
                'ref_link' => $request['ref_link'],
            ]);
        return redirect()->back()
            ->with('message', 'User updated Successful!');
    }


    // Reset Password
    public function resetpswd(Request $request, $id)
    {
        $user = User::find($id);
        $password = 'user01236';

        $resp = $this->setMobiusPassword($user->account_number, $user->email, $password);
        if($resp['status'] == MobiusTrader::STATUS_OK) {
            $msg = "Password has been reset to default.";
            $user->forceFill([
                'password' => Hash::make($password),
            ])->save();
        } else {
            $msg = "Sorry, there was an error, contact IT.";
        }
        return redirect()->route('manageusers')
            ->with('message', $msg);
    }


    // Delete user
    public function destroy(Request $request, $id)
    {
        //delete the user's withdrawals and deposits
        $deposits = Deposit::where('user', $id)->get();
        if (!empty($deposits)) {
            foreach ($deposits as $deposit) {
                Deposit::where('id', $deposit->id)->delete();
            }
        }

        $withdrawals = Withdrawal::where('user', $id)->get();
        if (!empty($withdrawals)) {
            foreach ($withdrawals as $withdrawals) {
                Withdrawal::where('id', $withdrawals->id)->delete();
            }
        }

        User::where('id', $id)->delete();
        return redirect()->route('manageusers')
            ->with('message', 'User has been deleted!');
    }


    public function dellaccounts(Request $request, $id)
    {
        $t7 = Trader7::find($id);

        if (!isset($t7)) {
            return redirect()->back()
                ->with('message', 'Account not found!');
        }

        // initialize the Trader7 api
        // $m7 = new MobiusTrader(config('mobius'));

        // // delete the Trader7 account
        // $data = $m7->deleteUser($t7->account_number);
        // if ($resp['status'] === MobiusTrader::STATUS_OK) {
        //     return redirect()->back()
        //         ->with('message', 'Sorry an error occured, please contact admin with this error message: ' . $e->getMessage());
        // }

        $t7->delete();

        return redirect()->back();
            // ->with('message', 'Account successfully deleted!');
    }


    public function userwallet($id)
    {
        $user = User::where('id', $id)->first();

        // update user accounts
        $this->updateaccounts($user);

        $name = $user->name ? $user->name: ($user->first_name ? $user->first_name: $user->last_name);

        return view('admin.user_wallet')
            ->with(array(
                'ref_bonus' => $user->ref_bonus,
                'deposited' => $user->totalDeposited(),
                'bonus' => $user->totalBonus(),
                'account_bal' => $user->totalBalance(),
                'user' => $name,
                'title' => 'User Profile',
            ));
    }


    // Access users account
    public function switchtouser(Request $request, $id)
    {
        $admin = auth('admin')->user();
        $user = User::where('id', $id)->first();

        //Byeppass 2FA
        $user->token_2fa_expiry = \Carbon\Carbon::now()->addMinutes(15)->toDateTimeString();
        $user->save();
        Auth::guard('admin')->login($admin, true);
        Auth::guard('web')->login($user, true);
        $request->session()->invalidate();
        $request->session()->regenerate();

        $name = $user->name ? $user->name: ($user->first_name ? $user->first_name: $user->last_name);

        return redirect()->route('dashboard')
            ->with('message', "You are logged in as $name!");
    }


    // Send Mail to all users
    public function sendmailtoall(Request $request)
    {
        $site_name = Setting::getValue('site_name');

        //send email notification
        $objDemo = new \stdClass();
        $objDemo->message =  "\r Hello, \r \n"
            . "\r $request->message \r\n";
        $objDemo->sender = $site_name;
        $objDemo->date = Carbon::Now();
        $objDemo->subject = "$site_name Notification";

        Mail::mailer('smtp')->bcc(User::all())->send(new NewNotification($objDemo));

        return redirect()->back()->with('message', 'Your message was sent successful!');
    }


    // Send mail to one user
    public function sendmailtooneuser(Request $request)
    {
        $site_name = Setting::getValue('site_name');

        $mailer = 'smtp';

        //send email notification
        $mailduser = User::where('id', $request->user_id)->first();
        $objDemo = new \stdClass();
        $objDemo->message = "\r Hello $mailduser->name, \r \n"
            . "\r $request->message \r\n";
        $objDemo->sender = $site_name;
        $objDemo->date = Carbon::Now();
        $objDemo->subject = "$site_name Notification";

        Mail::mailer($mailer)->bcc($mailduser->email)->send(new NewNotification($objDemo));
        return redirect()->back()->with('message', 'Your message was sent successful!');
    }


    // Manually Add Trading History to Users Route
    public function addHistory(Request $request)
    {
        $history = TpTransaction::create([
            'user' => $request->user_id,
            'purpse' => $request->purpose,
            'amount' => $request->amount,
            'type' => $request->type,
        ]);
        $user = User::where('id', $request->user_id)->first();
        // $user_bal = $user->account_bal;
        // if (isset($request['amount']) > 0) {
        //     User::where('id', $request->user_id)
        //         ->update([
        //             'account_bal' => $user_bal + $request->amount,
        //         ]);
        // }
        // $user_roi = $user->roi;
        // if (isset($request['type']) == "ROI") {
        //     User::where('id', $request->user_id)
        //         ->update([
        //             'roi' => $user_roi + $request->amount,
        //         ]);
        // }

        return redirect()->back()
            ->with('message', 'Action Sucessful!');
    }


    // Clear user Account
    public function clearacct(Request $request, $id)
    {
        $deposits = Deposit::where('user', $id)->get();
        if (!empty($deposits)) {
            foreach ($deposits as $deposit) {
                Deposit::where('id', $deposit->id)->delete();
            }
        }

        $withdrawals = Withdrawal::where('user', $id)->get();
        if (!empty($withdrawals)) {
            foreach ($withdrawals as $withdrawals) {
                Withdrawal::where('id', $withdrawals->id)->delete();
            }
        }

        User::where('id', $id)
            ->update([
                'account_bal' => '0',
                'ref_bonus' => '0',
            ]);
        return redirect()->route('manageusers')
            ->with('message', 'Account cleared to $0.00');
    }


    // top up route
    public function topup(Request $request)
    {
        $msg = 'Action Successful';
        $amt = $request->amount;

        if ($request->t_type == "Credit") {
            $respTrans = ['status' => false];
            // get Trader7 account in question
            $t7 = Trader7::find($request->account_id);
            if (!$t7)
                return redirect()->back()->with('message', 'Trader7 account not found');

            if ($request->type == "Bonus") {
                $respTrans = $this->performTransaction($t7->currency, $t7->number, $amt, 'MM-Admin', 'MM-AUTO', 'deposit', 'bonus');
                $t7->bonus += $amt;
            } elseif ($request->type == "Credit") {
                $respTrans = $this->performTransaction($t7->currency, $t7->number, $amt, 'MM-Admin', 'MM-AUTO', 'deposit', 'credit');
                $t7->bonus += $amt;
            } elseif ($request->type == "Balance") {
                $respTrans = $this->performTransaction($t7->currency, $t7->number, $amt, 'MM-Admin', 'MM-AUTO', 'deposit', 'balance');
                $t7->balance += $amt;
            }

            if(gettype($respTrans) !== 'integer') {
                return redirect()->route('manageusers')
                    ->with('message', 'Sorry an error occured, report this to IT!');
            } else {
                // Create deposit record
                $this->saveRecord($request->user_id, $request->account_id, 'Express Credit', $request->amount, 'Deposit', 'Processed');

                // save transaction
                $this->saveTransaction($request->user_id, $request->amount, 'Express Credit', $request->type);

                $msg = 'The user\'s account has been successfully credited!';
                $t7->save();
            }

        } elseif ($request->t_type == "Debit") {
            $respTrans = ['status' => false];
            // get Trader7 account in question
            $t7 = Trader7::find($request->account_id);
            if (!$t7)
                return redirect()->back()->with('message', 'Trader7 account not found');

            if ($request->type == "Bonus") {
                $respTrans = $this->performTransaction($t7->currency, $t7->number, $amt, 'MM-Admin', 'MM-AUTO', 'withdrawal', 'bonus');
                $t7->bonus -= $amt;
            } elseif ($request->type == "Balance") {
                $respTrans = $this->performTransaction($t7->currency, $t7->number, $amt, 'MM-Admin', 'MM-AUTO', 'withdrawal', 'balance');
                $t7->balance -= $amt;
            }

            if (gettype($respTrans) !== 'integer') {
                // create withdrawal record
                $this->saveRecord($request->user_id, $request->account_id, 'Express Debit', $amt, 'Withdrawal', 'Processed');

                // save transaction
                $this->saveTransaction($request->user_id, $amt, 'Express Debit', $request->type);

                $msg = 'The user\'s account has been successfully debited!';
                $t7->save();
            } else {
                return redirect()->route('manageusers')
                    ->with('message', 'Sorry an error occured, report this to IT!');
            }
        }

        return redirect()->route('manageusers')
            ->with('message', $msg);
    }


    // accept KYC route
    public function acceptkyc($id)
    {
        //update user
        User::where('id', $id)
            ->update([
                'account_verify' => 'Verified',
                'docs_verified_date' => Carbon::Now(),
            ]);

        return redirect()->back()
            ->with('message', 'Action Sucessful!');
    }


    // reject KYC route
    public function rejectkyc($id)
    {
        //update user
        User::where('id', $id)
            ->update([
                'account_verify' => 'Rejected',
                'id_card' => NULL,
                'id_card_back' => NULL,
                'passport' => NULL,
                'address_document' => NULL,
                'docs_verified_date' => NULL,
                'docs_uploaded_date' => NULL
            ]);

        return redirect()->back()
            ->with('message', 'Rejected KYC Sucessfully!');
    }


    // reset KYC route
    public function resetkyc($id)
    {
        //update user
        $user = User::where('id', $id)
            ->update([
                'account_verify' => '',
                'id_card' => NULL,
                'id_card_back' => NULL,
                'passport' => NULL,
                'address_document' => NULL,
                'docs_verified_date' => NULL,
                'docs_uploaded_date' => NULL
            ]);

        return redirect()->back()
            ->with('message', 'Reseted KYC Sucessfully!');
    }


    // block user
    public function ublock($id)
    {
        User::where('id', $id)
            ->update([
                'status' => 'blocked',
            ]);
        return redirect()->route('manageusers')
            ->with('message', 'Action Sucessful!');
    }


    // unblock user
    public function unblock($id)
    {
        User::where('id', $id)
            ->update([
                'status' => 'active',
            ]);
        return redirect()->route('manageusers')
            ->with('message', 'Action Sucessful!');
    }


    // accept KYC route
    public function changestyle(Request $request)
    {
        if (isset($request['style']) and $request['style'] == 'true') {
            $dashboard_style = "dark";
        } else {
            $dashboard_style = "light";
        }
        //change dashboard style
        Admin::where('id', Auth('admin')->User()->id)
            ->update([
                'dashboard_style' => $dashboard_style,
            ]);
        return response()->json(['success' => 'Changed']);
    }


    // fetch users on mobius server
    public function fetchmobiususers(Request $request)
    {
        $ids = [350617,350618,350815,350875,350876,351026,351184,351344,351970,352155,352160,352162,352175,352177,352178,352181,352182,352183,352185,352186,352346,352363,352364,352365,352367,352368,352371,352375,352376,352379,352381,352384,352385,352386,352388,352389,352391,352392,352394,352398,352509,352511,352512,352515,352516,352532,352539,352542,352545,352548,352553,352554,352555,352556,352557,352560,352561,352562,352563,352670,352834,352840,352844,352846,352849,352851,352853,352854,352855,352856,352963,352969,352980,352984,352985,352986,352987,352989,352991,352993,352995,352996,352997,353220,353224,353236,353237,353238,353247,353248,353249,353250,353251,353324,353325,353327,353330,353334,353335,353343,353346,353348,353349,353350,353352,353354,353413,353498,353500,353513,353517,353518,353519,353520,353521,353525,353526,353528,353529,353530,353531,353532,353533,353534,353535,353536,353537,353538,353540,353704,353707,353720,353730,353734,353738,353743,353746,353751,353752,353754,353757,353758,353759,353761,353762,353763,353768,353770,353771,353772,353774,353775,353777,353778,353780,353781,353782,353783,353784,353785,353786,353829,353928,353949,353952,353954,353955,353956,353957,353958,353959,353963,353967,353971,353974,353977,353982,353983,353984,353994,353996,354002,354003,354005,354006,354007,354010,354011,354012,354013,354015,354016,354017,354018,354019,354118,354131,354141,354143,354148,354150,354152,354153,354154,354159,354162,354166,354167,354168,354169,354170,354171,354173,354174,354175,354176,354177,354178,354179,354180,354182,354273,354277,354279,354286,354295,354304,354308,354309,354313,354316,354317,354318,354319,354321,354322,354323,354324,354325,354326,354327,354328,354329,354330,354331];

        $m7 = new MobiusTrader(config('mobius'));
        foreach($ids as $id) {
            $resp = $m7->get_account($id);
            if($resp['status'] === MobiusTrader::STATUS_OK) {
                $acc = $resp['data'];
                if(User::whereEmail($acc['Email'])->first() == null) {
                    $country = Country::whereName($acc['Country'])->first();
                    $password = 'user01236';

                    $user = new User();
                    $user->first_name = $acc['Name'];
                    $user->last_name = $acc['LastName'];
                    $user->name = $acc['Name'] . ' ' . $acc['LastName'];
                    $user->phone = $acc['Phone'];
                    $user->email = $acc['Email'];
                    $user->status = 'active';
                    $user->account_number = $acc['Id'];
                    $user->town = $acc['City'];
                    $user->country_id = $country->id;
                    $user->state = $acc['State'];
                    $user->zip_code = $acc['ZipCode'];
                    $user->password = Hash::make($password);
                    $user->created_at = date('Y-m-d H:i:s', strtotime($acc['RegDate']));
                    $user->updated_at = date('Y-m-d H:i:s', strtotime($acc['DateUpdate']));
                    $user->save();

                    $this->setMobiusPassword($user->account_number, $user->email, $password);
                }
            }
        }
        return redirect()->back()->with('message', 'Successfully fetched users.');
    }
}
