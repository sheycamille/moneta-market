<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Deposit;
use App\Models\Wdmethod;
use App\Models\Withdrawal;
use App\Models\Trader7;
use App\Models\Notification;
use App\Models\TpTransaction;
use App\Events\CheckAccounts;

use App\Mail\KycUpload;
use App\Mail\UserUpload;
use App\Mail\NewNotification;

use App\Http\Controllers\QueueEmails;

use App\Libraries\MobiusTrader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

use Carbon\Carbon;
use Exception;
use Stripe;


class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['callbackRagapay', 'verify']]);
    }


    public function dashboard(Request $request)
    {
        $user = Auth::user();

        //Get bonus from users table
        $user = User::where('id', $user->id)->first();

        //log user out if not approved
        if ($user->status != "active") {
            $request->session()->flush();
            $request->session()->put('reged', 'yes');
            return redirect()->route('dashboard');
        }

        return view('user.dashboard')
            ->with(array(
                //'earnings'=>$earnings,
                'title' => 'User Panel',
                'deposited' => $user->totalDeposited(),
                'total_bonus' => $user->totalBonus(),
                'total_credit' => $user->totalCredit(),
                'total_balance' => $user->totalBalance(),
            ));
    }


    // profile route
    public function profile()
    {
        $countries = Country::orderBy('name')->whereStatus('active')->get();
        $userinfo = User::where('id', Auth::user()->id)->first();

        return view('user.profile')->with(array(
            'userinfo' => $userinfo,
            'title' => 'Profile',
            'countries' => $countries,
        ));
    }


    //Updating Profile Route
    public function updateprofile(Request $request)
    {
        User::where('id', Auth::user()->id)
            ->update([
                'name' => $request->first_name . ' ' . $request->last_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'dob' => $request->dob,
                'phone' => $request->phone,
                'address' => $request->address,
                'phone' => $request->phone,
                'town' => $request->town,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'country_id' => $request->country,
            ]);
        return redirect()->back()
            ->with('message', 'Profile Information Updated Sucessfully!');
    }


    // return deposit route
    public function deposits()
    {
        $deposits = Deposit::where('user', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('user.deposits')
            ->with(array(
                'title' => 'Deposits',
                'deposits' => $deposits,
            ));
    }


    // return withdrawals route
    public function withdrawals()
    {
        return view('user.withdrawals')
            ->with(array(
                'title' => 'withdrawals',
                'withdrawals' => Withdrawal::where('user', Auth::user()->id)
                    ->orderBy('id', 'desc')
                    ->get(),
            ));
    }


    // serves withdrawal page
    public function mwithdrawal()
    {
        return view('user.mwithdrawal')->with(array(
            'title' => 'Make Withdrawal',
            'wmethods' => Wdmethod::where('type', 'withdrawal')
                ->where('status', 'enabled')->get(),
        ));
    }


    // return add account form
    public function withdrawaldetails(Request $request)
    {
        return view('user.withdrawaldetails')->with(array(
            'title' => 'Update Withdrawal Details',
        ));
    }


    // update account and contact info
    public function updatewithdrawaldetails(Request $request)
    {
        User::where('id', $request->id)
            ->update([
                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'swift_code' => $request->swift_code,
                'bank_address' => $request->bank_address,
                'btc_address' => $request->btc_address,
                'eth_address' => $request->eth_address,
                'ltc_address' => $request->ltc_address,
                'xrp_address' => $request->xrp_address,
                'usdt_address' => $request->usdt_address,
                'usdc_address' => $request->usdc_address,
                'bch_address' => $request->bch_address,
                'bnb_address' => $request->bnb_address,
                'interac' => $request->interac,
                'paypal_email' => $request->paypal_email,
            ]);
        return redirect()->back()
            ->with('message', 'Withdrawal Info updated Sucessfully');
    }


    // save deposit requests
    public function savedeposit(Request $request)
    {
        $this->validate($request, [
            'proof' => ['required', 'mimes:jpg,jpeg,png,PNG,JPEG,JPG | max:5000'],
        ]);

        $currency = Setting::getValue('currency');
        $location = Setting::getValue('location');
        $site_name = Setting::getValue('site_name');
        $contact_email = Setting::getValue('contact_email');
        $deposit_email = Setting::getValue('deposit_email');

        $strtxt = $this->generate_string(6);

        if ($request->hasfile('proof')) {
            $file = $request->file('proof');
            $name = $file->getClientOriginalName();

            if ($location  == "Email") {
                $proofname = $strtxt . $name;
                $data = [
                    'document' => $file
                ];
                Mail::to($contact_email)->send(new UserUpload($data));
            } elseif ($location  == "Local") {
                $proofname = $strtxt . $name;
                // save to storage/app/uploads as the new $filename
                $path = $file->storeAs('public/photos', $proofname);
            } else {
                $filePath = 'storage/' . $name;
                Storage::disk('s3')->put($filePath, file_get_contents($file));
            }
        }

        //get user
        $user = User::where('id', Auth::user()->id)->first();
        $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);

        //send email notification
        $objDemo = new \stdClass();
        $objDemo->message = "\r Hello Admin, \r\n" .
            "\r This is to inform you that $name just made a successfull Deposit of $currency$request->amount, on your system. \r\n" .
            "\r Please login to review and take the neccesary action. \r\n";
        $objDemo->sender = $site_name;
        $objDemo->date = Carbon::Now();
        $objDemo->subject = "Action Needed: Successful Deposit";
        Mail::mailer('smtp')->bcc($deposit_email)->send(new NewNotification($objDemo));


        $t7_id = $request->session()->get('t7_account_id');
        $status = 'Pending';
        $purpose = 'Deposit';

        $dp = new Deposit();
        $dp->amount = $request['amount'];
        $dp->payment_mode = $request['payment_mode'];
        $dp->status = $status;
        $dp->account_id = $t7_id;
        $dp->proof = $proofname;
        $dp->user = Auth::user()->id;
        $dp->save();

        // Kill the session variables
        $request->session()->forget('payment_mode');
        $request->session()->forget('amount');

        return redirect()->route('account.deposits')
            ->with('message', 'Action Sucessful! Please wait for system to validate this transaction.');
    }


    // save withdrawal requests
    public function savewithdrawal(Request $request)
    {
        //get settings
        $currency = Setting::getValue('currency');
        $withdrawal_email = Setting::getValue('withdrawal_email');
        $enable_kyc = Setting::getValue('enable_kyc');
        $site_name = Setting::getValue('site_name');
        $method = Wdmethod::where('id', $request->method_id)->first();

        // get user
        $user = Auth::user();

        if ($request->amount < $method->minimum) {
            return redirect()->back()
                ->with("message", "Sorry, the minimum amount is for your selected method is $$method->minimum.");
        }

        if ($enable_kyc == "yes") {
            if (Auth::user()->account_verify != "Verified") {
                return redirect()->back()->with('message', 'Your account must be verified before you can make withdrawal.');
            }
        }

        $setting_key = $method->setting_key;
        if ($setting_key) {
            $payment_address = $user->{$setting_key};

            if (empty($payment_address)) {
                return redirect()->route('withdrawaldetails')
                    ->with('message', 'You must set up your withdrawal details for the method you are trying to withdraw with, before you can withdraw.');
            }
        }

        // ensuring withdrawals of at least $50
        $to_withdraw = $request->amount;
        if ($request->amount <= 50)
            $to_withdraw = 50;
        else
            $to_withdraw = round($request->amount);

        // adding withdrawal charges and percentage
        if ($method->charges_percentage > 0) {
            $charges_percentage = $request->amount * $method->charges_percentage / 100;
            $to_withdraw = round($request->amount + $charges_percentage + $method->charges_fixed);
        }

        // return if amount is lesser than method minimum withdrawal amount

        if (Auth::user()->totalBalance() < $to_withdraw) {
            return redirect()->back()
                ->with('message', 'Sorry, your account balance is insufficient for this request.');
        }

        $payment_mode = $method->name;
        $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);

        // send email notification
        $objDemo = new \stdClass();
        $objDemo->message = "\r Hello Admin, \r\n " .
            "\r This is to inform you that $name has made a withdrawal request of $currency$request->amount. \r\n" .
            "\r Please kindly login to your account and review and take the neccesary action. \r\n";
        $objDemo->sender = $site_name;
        $objDemo->date = Carbon::Now();
        $objDemo->subject = "Action Needed: Withdrawal Request";

        Mail::mailer('smtp')->bcc($withdrawal_email)->send(new NewNotification($objDemo));

        // update account balances
        event(new CheckAccounts($user));

        // save withdrawal info
        $wd = new Withdrawal();

        $wd->amount = $request->amount;
        $wd->to_deduct = $to_withdraw;
        $wd->account_id = $request->account_id;
        $wd->payment_mode = "$payment_mode";
        $wd->status = 'Pending';
        $wd->user = $user->id;

        $wd->save();

        return redirect()->back()
            ->with('message', 'Action Sucessful! Please wait for the system to process your request.');
    }


    // verify PayPal deposits
    public function paypalverify(Request $request, $amount)
    {
        $user = User::where('id', Auth::user()->id)->first();

        $t7_id = $request->session()->get('t7_account_id');

        $t7 = Trader7::find($t7_id);

        $resp = $this->performTransaction($t7->currency, $t7->number, $amount, 'MM-PayPal', 'MM-AUTOPP-' . $request->orderid, 'deposit', 'balance');
        if (gettype($resp) !== 'integer') {
            return json_encode(['message' => 'Sorry an error occured, report this to support!']);
        } else {
            $t7->balance += $amount;
            $t7->save();
        }

        //save transaction
        $this->saveTransaction($user->id, $amount, 'Deposit', 'Credit');

        //save and confirm the deposit
        $this->saveRecord($user->id, $t7_id, 'PayPal', $amount, 'Deposit', 'Processed', 'PayPal');

        // dispatch email
        $process_emls = new QueueEmails();
        $this->$process_emls->dispatchEmail();

        //send email notification
        /*$currency = Setting::getValue('currency');
        $site_name = Setting::getValue('site_name');
        $objDemo = new \stdClass();

        $name = $user->name ? $user->name: ($user->first_name ? $user->first_name: $user->last_name);
        $objDemo->message = "\r Hello $name, \r\n

        \r This is to inform you that your deposit of $currency$amount has been received and confirmed.";
        $objDemo->sender = "$site_name";
        $objDemo->date = Carbon::Now();
        $objDemo->subject = "Deposit Processed!";

        Mail::bcc($user->email)->send(new NewNotification($objDemo));*/

        Session::flash('message', 'Your deposit was successfully processed!');

        return response()->json(['message' => 'Deposit Sucessful! Redirecting...']);
    }


    public function downloads(Request $request)
    {
        return view('user.downloads', [
            'title' => 'Downloads',
        ]);
    }


    public function support(Request $request)
    {
        return view('user.support', [
            'title' => 'Contact Support',
        ]);
    }


    // return change password form
    public function changepassword(Request $request)
    {
        return view('user.changepassword')->with(array('title' => 'Change Password',));
    }


    // update Password
    public function updatepass(Request $request)
    {
        if (!password_verify($request['old_password'], $request['current_password'])) {
            return redirect()->back()
                ->with('message', 'Incorrect Old Password');
        }
        $this->validate($request, [
            'password_confirmation' => 'same:password',
            'password' => 'min:8',
        ]);

        $user = $request->user();
        $password = $request->password;

        // set the password
        $resp =  $this->setMobiusPassword($user->account_number, $user->email, $password);
        if ($resp['status'] == MobiusTrader::STATUS_OK) {
            $msg = "Your password has been updated.";
            $user->forceFill([
                'password' => Hash::make($password),
            ])->save();
        } else {
            $msg = "Sorry, there was an error, contact support.";
        }

        return redirect()->back()
            ->with('message', $msg);
    }


    // change user email
    public function chngemail(Request $request)
    {
        $user = User::where('id', $request['user_id'])->first();
        User::where('id', $request['user_id'])
            ->update([
                'email' => $request['email'],
            ]);
        return redirect()->route('manageusers')
            ->with('message', 'Action Successful!');
    }


    // serves referrals page
    public function referuser()
    {
        $array = User::all();
        return view('user.referuser')->with(array(
            'title' => 'My Referrals',
            'team' => User::where('ref_by', Auth::user()->id)->get(),
        ));
    }


    // get user status
    function getUserStatus($id)
    {
        $user = User::where('id', $id)->first();

        return $user->status;
    }


    // get User Registration Date
    public function getUserRegDate($id)
    {
        $user = User::where('id', $id)->first();

        return $user->created_at;
    }


    // serves forgot password page
    public function forgotpassword()
    {
        return view('auth.forgot-password', [
            'title' => 'Forgot Password',
        ]);
    }


    // serves verifyemail page
    public function verifyemail()
    {
        return view('auth.verify-email', [
            'title' => 'Verify your email address',
        ]);
    }


    // serves account security page
    public function security()
    {
        $countries = Country::orderBy('name')->whereStatus('active')->get();

        return view('profile.show', [
            'title' => 'Two Factor Authentication',
            'countries' => $countries,
        ]);
    }


    // serves verify account page
    function verifyaccount()
    {
        return view('user.verify', [
            'title' => 'Verify your Account',
        ]);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     *
     * Trading history route
     */
    public function tradinghistory()
    {
        return view('user.thistory')
            ->with(array(

                't_history' => TpTransaction::where('user', Auth::user()->id)
                    ->orderBy('id', 'desc')
                    ->get(),
                'title' => 'Trading History',
            ));
    }


    // account transactions history route
    public function accounthistory()
    {
        return view('user.transactions')
            ->with(array(
                't_history' => TpTransaction::where('user', Auth::user()->id)
                    ->where('type', '<>', 'ROI')
                    ->orderBy('id', 'desc')
                    ->get(),
                'withdrawals' => Withdrawal::where('user', Auth::user()->id)->orderBy('id', 'desc')
                    ->get(),
                'deposits' => Deposit::where('user', Auth::user()->id)->orderBy('id', 'desc')
                    ->get(),
                'title' => 'Account Transactions History',
            ));
    }


    // notification route
    public function notification()
    {
        return view('user.notification')
            ->with(array(
                'Notif' => Notification::where('user_id', Auth::user()->id)->orderBy('id', 'desc')
                    ->paginate(12),
                'title' => 'Notification',
            ));
    }


    public function delnotif($id)
    {
        Notification::where('id', $id)->delete();
        //$notif =notifcations::where('id',$id)->delete();
        return redirect()->back()
            ->with('message', 'Message Sucessfully Deleted');
    }


    //accept KYC route
    public function changetheme(Request $request)
    {
        if (isset($request['style']) and $request['style'] == 'true') {
            $dashboard_style = "dark";
        } else {
            $dashboard_style = "light";
        }
        //change dashboard style
        User::where('id', Auth::user()->id)
            ->update([
                'dashboard_style' => $dashboard_style,
            ]);
        return response()->json(['success' => 'Changed']);
    }


    public function refreshAccounts(Request $request)
    {
        $user = Auth::user();

        // update user accounts
        $this->updateaccounts($user);

        return redirect()->back()->with('message', "Account balances have been updated");
    }


    //Save verification documents requests
    public function savevdocs(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'idcard' => 'mimes:jpg,jpeg,png|max:4000|image',
            'idcard_back' => 'mimes:jpg,jpeg,png|max:4000|image',
            'passport' => 'mimes:jpg,jpeg,png|max:4000|image',
            'address_document' => 'mimes:jpg,jpeg,png|max:4000|image',
        ]);

        $cardname = $user->id_card;
        $cardname1 = $user->id_card_back;
        $passname = $user->passport;
        $addressname = $user->address_document;

        $location = Setting::getValue('location');
        $site_name = Setting::getValue('site_name');
        $contact_email = Setting::getValue('verification_email');
        $strtxt = $this->generate_string(6);

        if ($request->hasfile('idcard')) {
            $document0 = $request->file('idcard');
            $filename0 = $document0->getClientOriginalName();

            if ($location  == "Email") {
                $cardname = $strtxt . $filename0;
            } elseif ($location == "S3") {
                $cardname = $strtxt . $filename0;
                $filePath = 'storage/' . $cardname;
                Storage::disk('s3')->put($filePath, file_get_contents($filename0));
            } else {
                $cardname = $strtxt . $filename0;
                // save to storage/app/uploads as the new $filename
                $path = $document0->storeAs('public/photos', $cardname);
            }
        }

        if ($request->hasfile('idcard_back')) {
            $document1 = $request->file('idcard_back');
            $filename1 = $document1->getClientOriginalName();

            if ($location  == "Email") {
                $cardname1 = $strtxt . $filename1;
            } elseif ($location == "S3") {
                $cardname1 = $strtxt . $filename1;
                $filePath = 'storage/' . $cardname1;
                Storage::disk('s3')->put($filePath, file_get_contents($filename1));
            } else {
                $cardname1 = $strtxt . $filename1;
                // save to storage/app/uploads as the new $filename
                $path = $document1->storeAs('public/photos', $cardname1);
            }
        }

        if ($request->hasfile('passport')) {
            $document2 = $request->file('passport');
            $filename2 = $document2->getClientOriginalName();

            if ($location  == "Email") {
                $passname = $strtxt . $filename2;
            } elseif ($location == "S3") {
                $passname = $strtxt . $filename2;
                $filePaths = 'storage/' . $passname;
                Storage::disk('s3')->put($filePaths, file_get_contents($passname));
            } else {
                $passname = $strtxt . $filename2;
                // save to storage/app/uploads as the new $filename
                $path = $document2->storeAs('public/photos', $passname);
            }
        }

        if ($request->hasfile('address_document')) {
            $document3 = $request->file('address_document');
            $filename3 = $document3->getClientOriginalName();

            if ($location  == "Email") {
                $addressname = $strtxt . $filename3;
            } elseif ($location == "S3") {
                $addressname = $strtxt . $filename3;
                $filePaths = 'storage/' . $addressname;
                Storage::disk('s3')->put($filePaths, file_get_contents($filename3));
            } else {
                $addressname = $strtxt . $filename3;
                // save to storage/app/uploads as the new $filename
                $path = $document3->storeAs('public/photos', $addressname);
            }
        }

        if ($location  == "Email") {
            $data = [
                'document0' => $document0,
                'document1' => $document1,
                'document2' => $document2,
                'document3' => $document3,
            ];
            Mail::to($contact_email)->send(new KycUpload($data));
        }

        //send email notification
        $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);
        $objDemo = new \stdClass();
        $objDemo->message = "\r This is to inform you of $name submitting their KYC Documents. \r\n" .
            "\r Please login to review documents. \r \n";
        $objDemo->sender = $site_name;
        $objDemo->date = Carbon::Now();
        $objDemo->subject = "Action Needed: Verification Documents Uploaded";
        Mail::mailer('smtp')->bcc($contact_email)->send(new NewNotification($objDemo));

        //update user
        User::where('id', Auth::user()->id)
            ->update([
                'id_card' => $cardname,
                'id_card_back' => $cardname1,
                'passport' => $passname,
                'address_document' => $addressname,
                'account_verify' => 'Under Review',
                'docs_uploaded_date' => Carbon::Now()
            ]);

        return redirect()->back()
            ->with('message', 'Action Sucessful! Please wait for system to validate your submission.');
    }


    public function selectPaymentMethod(Request $request)
    {
        $accountId = $request->account_id;
        $amount = $request->amount;

        // get the account or take the first
        $account = Trader7::find($accountId);

        if (!$account) {
            $account = Trader7::first();
        }

        // keep needed values in the user's session
        $request->session()->put('t7_account_id', $account->id);
        $request->session()->put('amount', $amount);

        $country_id = Auth::user()->country_id;
        $payment_methods = Wdmethod::where('type', 'deposit')
            ->where('status', 'enabled')
            ->where('minimum', '<=', $amount)
            ->where('maximum', '>=', $amount)
            ->where('country_ids', 'like', '%' . $country_id . '%')
            ->get();

        return view('user.paymentmethods', [
            'title' => 'Deposit Funds',
            'account' => $account,
            'amount' => $amount,
            'pmethods' => $payment_methods
        ]);
    }


    public function startPayment(Request $request, $accountId, $methodId)
    {
        $method = Wdmethod::find($methodId);
        $amount = $request->session()->get('amount');
        $countries = Country::orderBy('name')->whereStatus('active')->get();
        $user = Auth::user();
        $t7_id = $request->session()->get('t7_account_id');

        $data = [];
        if (strpos(strtolower($method->name), 'bank') > -1 || strpos(strtolower($method->setting_key), 'bank') > -1) {
            $view = 'banktransfer';
            $title = 'Make Bank Payment';
            $data = [
                'dmethod' => $method,
            ];
        } elseif (strpos(strtolower($method->setting_key), 'paypal') > -1) {
            $view = 'paypal';
            $title = 'Make PayPal Payment';
            $data = [
                'dmethod' => $method,
            ];
        } elseif (strpos(strtolower($method->setting_key), 'paystudio') > -1) {
            $view = 'paystudio';
            $title = 'Make PayStudio Payment';
            $data = [
                'countries' => $countries,
                'dmethod' => $method,
            ];
        } elseif (strpos(strtolower($method->setting_key), 'chargemoney') > -1) {
            $view = 'chargemoney';
            $title = 'Make ChargeMoney Payment';
            $data = [
                'countries' => $countries,
                'dmethod' => $method,
            ];
        } elseif (strpos(strtolower($method->setting_key), 'praxis') > -1) {
            $view = 'praxis';
            $title = 'Make Praxis Payment';
            $data = [
                'countries' => $countries,
                'dmethod' => $method,
            ];
        } elseif (strpos(strtolower($method->setting_key), 'virtualpay') > -1) {
            $view = 'virtualpay';
            $title = 'Make VirtualPay Payment';
            $requestid = strtoupper('VPGLIVE-' . Auth::user()->id . '-' . strtotime('now'));
            $data = [
                'countries' => $countries,
                'dmethod' => $method,
                'requestid' => $requestid,
            ];
        } elseif (strpos(strtolower($method->setting_key), 'ywallitpay') > -1) {
            $view = 'ywallitpay';
            $title = 'Make YWallitPay Payment';
            $data = [
                'countries' => $countries,
                'dmethod' => $method,
            ];
        } elseif (strpos(strtolower($method->setting_key), 'authorizenet') > -1) {
            $view = 'authorizenet';
            $title = 'Make Authorize.Net Payment';
            $data = [
                'countries' => $countries,
                'dmethod' => $method,
            ];
        } elseif (strpos(strtolower($method->name), 'interac') > -1) {
            $view = 'interac';
            $title = 'Make Interac Payment';
            $data = [
                'dmethod' => $method,
            ];
        } elseif (strpos(strtolower($method->setting_key), 'taopay') > -1) {
            $view = 'taopay';
            $title = 'Make Taopay Payment';
            $data = [
                'countries' => $countries,
                'dmethod' => $method,
            ];
        } elseif (strpos(strtolower($method->setting_key), 'cashonex') > -1) {
            $view = 'cashonex';
            $title = 'Make Cashonex Payment';
            $data = [
                'countries' => $countries,
                'dmethod' => $method,
            ];
        } elseif (strpos(strtolower($method->setting_key), 'numpay') > -1) {
            $view = 'numpay';
            $title = 'Make NumPay Payment';
            $transaction_id = rand();
            $request->session()->put('numpay_transaction_id', $transaction_id);
            $data = [
                'countries' => $countries,
                'dmethod' => $method,
                'transaction_id' => $transaction_id,
            ];
        } elseif (strpos(strtolower($method->setting_key), 'paycly') > -1) {
            $depo = new Deposit();
            $depo->amount = number_format((float)$amount, 2, '.', '');;
            $depo->payment_mode = 'Paycly';
            $depo->user = $user->id;
            $depo->account_id = $t7_id;
            $depo->status = 'Pending';
            $depo->save();

            $view = 'paycly';
            $title = 'Make Paycly Payment';

            $data = [
                'countries' => $countries,
                'dmethod' => $method,
                'id_order' => 'order-' . $depo->id . '-' . $t7_id,
                'client_ip' => $request->ip(),
            ];
        } elseif (strpos(strtolower($method->setting_key), 'ragapay') > -1) {
            $depo = new Deposit();
            $depo->amount = number_format((float)$amount, 2, '.', '');;
            $depo->payment_mode = 'Ragapay';
            $depo->user = $user->id;
            $depo->account_id = $t7_id;
            $depo->status = 'Pending';
            $depo->save();

            $order_number = 'order-' . $depo->id . '-' . $t7_id;

            $request->session()->put('ragapay_order_number', $order_number);

            $view = 'ragapay';
            $title = 'Make RagaPay Payment';

            $data = [
                'countries' => $countries,
                'dmethod' => $method,
                'transaction_id' => $order_number,
            ];

            // make an auth request to Ragapay
            $desc = 'Payment of goods';
            $amount = number_format((float)$amount, 2, '.', '');
            $to_md5 = sha1(md5(strtoupper($order_number . $amount . 'usd' . $desc . config('ragapay.api_secret'))));

            $input = [
                'merchant_key' => config('ragapay.api_key'),
                'operation' => 'purchase',
                'methods' => [],
                'order' => [
                    'number' => $order_number,
                    'amount' => $amount,
                    'currency' => 'USD',
                    'description' => $desc,
                ],
                'cancel_url' => route('cancelragapaycharge'),
                'success_url' => route('successragapaycharge'),
                'customer' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'hash' => $to_md5
            ];

            $response = Http::post(config('ragapay.endpoint'), $input);

            $data['url'] = $response['redirect_url'];
            // dd([$input, $response, $response['redirect_url']]);
            return redirect($data['url']);
        } elseif (strpos(strtolower($method->setting_key), 'xpro') > -1) {
            $depo = new Deposit();
            $depo->amount = number_format((float)$amount, 2, '.', '');;
            $depo->payment_mode = 'Xpro';
            $depo->user = $user->id;
            $depo->account_id = $t7_id;
            $depo->status = 'Pending';
            $depo->save();

            $order_number = 'order-' . $depo->id . '-' . $t7_id;

            $request->session()->put('xpro_order_number', $order_number);

            $view = 'xpro';
            $title = 'Make Xpro Payment';

            $data = [
                'countries' => $countries,
                'dmethod' => $method,
                'transaction_id' => $order_number,
            ];

            // make an auth request to Xpro
            $desc = 'Payment of goods';
            $amount = number_format((float)$amount, 2, '.', '');
            $to_md5 = sha1(md5(strtoupper($order_number . $amount . 'usd' . $desc . config('xpro.api_secret'))));

            $input = [
                'merchant_key' => config('xpro.api_key'),
                'operation' => 'purchase',
                'methods' => ['card'],
                'order' => [
                    'number' => $order_number,
                    'amount' => $amount,
                    'currency' => 'USD',
                    'description' => $desc,
                ],
                'cancel_url' => route('cancelxprocharge'),
                'success_url' => route('successxprocharge'),
                'customer' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'hash' => $to_md5
            ];

            $response = Http::post(config('xpro.endpoint'), $input);

            $data['url'] = $response['redirect_url'];
            return redirect($data['url']);
        } elseif (strpos(strtolower($method->setting_key), 'stripe') > -1) {
            $view = 'stripe';
            $title = 'Make Stripe Payment';
            $data = [
                'countries' => $countries,
                'dmethod' => $method,
            ];
        } elseif (strpos(strtolower($method->setting_key), 'helcim') > -1) {
            $view = 'helcim';
            $title = 'Make Helcim Payment';
            $data = [
                'dmethod' => $method,
            ];
        } else {
            $view = 'coins';
            $wallet_address = Setting::where('name', $method->setting_key)->first()->value;
            $title = "Make $method->name Payment";
            $coin_name = strtolower($method->name);
            $data = [
                'coin_name' => $coin_name,
                'wallet_address' => $wallet_address,
                'dmethod' => $method,
            ];
        }

        $someData = [
            'title' => $title,
            'amount' => $amount,
        ];

        $data = array_merge($data, $someData);

        return view("user.$view", $data);
    }


    public function startPaypoundCharge(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();

        $t7_id = $request->session()->get('t7_account_id');
        $amt = $request->session()->get('amount');

        $t7 = Trader7::find($t7_id);

        $data = $request->all();
        $data['api_key'] = config('paypound.api_key');
        $data['ip_address'] = $request->ip();
        $data['response_url'] = route('verifypaypoundcharge');
        $data['customer_order_id'] = $user->id;

        unset($data['_token']);

        $response = Http::post('https://portal.paypound.ltd/api/transaction', $data);

        $resp = json_decode($response->body());

        if ($resp->status == 'success') {
            $amt = $resp->data->amount;
            $respTrans = $this->performTransaction($t7->currency, $t7->number, $amt, 'MM-PayPound', 'MM-AUTOPPD', 'deposit', 'balance');
            if (gettype($respTrans) !== 'integer') {
                return redirect()->back()->with('message', 'Sorry an error occured, report this to support! ');
            } else {
                $t7->balance = $t7->balance + $amt;
                $t7->save();
            }

            // save transaction
            $this->saveTransaction($user->id, $amt, 'Deposit', 'Credit');

            // save and confirm the deposit
            $this->saveRecord($user->id, $t7_id, 'PayPound', $amt, 'Deposit', 'Processed', 'PayPound Order Id: ' . $resp->data->order_id);

            // send email notification
            $currency = Setting::getValue('currency');
            $site_name = Setting::getValue('site_name');

            $objDemo = new \stdClass();
            $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);
            $objDemo->message = "\r Hello $name, \r\n
                \r This is to inform you that your deposit of $currency$amt has been received and confirmed.";
            $objDemo->sender = "$site_name";
            $objDemo->date = Carbon::Now();
            $objDemo->subject = "Deposit Processed!";

            Mail::bcc($user->email)->send(new NewNotification($objDemo));

            return redirect(route('account.liveaccounts'))->with('message', 'Your deposit was successfully processed!');
        } elseif ($resp->status == 'fail') {
            return redirect()->back()->with('message', $resp->message);
        } elseif ($resp->status == '3d_redirect') {
            // save and confirm the deposit
            $this->saveRecord($user->id, $t7_id, 'PayPound', $amt, 'Deposit', 'Pending', 'PayPound Order Id: ' . $resp->data->order_id);

            return redirect($resp->redirect_3ds_url)->with('message', 'Redirecting you to complete 3DS security challenge.');
        } else {
            return redirect()->back()->with('message', $resp->message);
        }
    }


    public function verifyPaypoundCharge(Request $request)
    {
        $data = $request->all();
        $user = User::find($data['customer_order_id']);
        $dp = $user->dp()->latest()->first();

        $t7_id = $request->session()->get('t7_account_id');

        $t7 = Trader7::find($t7_id);

        if ($data['status'] == 'success') {
            $amt = $dp->amount;
            $respTrans = $this->performTransaction($t7->currency, $t7->number, $amt, 'MM-PayPound', 'MM-AUTOPPD', 'deposit', 'balance');
            if (gettype($respTrans) !== 'integer') {
                return redirect()->back()->with('message', 'Sorry an error occured, report this to support!');
            } else {
                $t7->balance = $t7->balance + $amt;
                $t7->save();
            }

            // save transaction
            $this->saveTransaction($user->id, $amt, 'Deposit', 'Credit');

            // update the deposit
            $dp->status = "Processed";
            $dp->save();

            // send email notification
            $currency = Setting::getValue('currency');
            $site_name = Setting::getValue('site_name');

            $objDemo = new \stdClass();
            $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);
            $objDemo->message = "\r Hello $name, \r\n
                \r This is to inform you that your deposit of $currency$amt has been received and confirmed.";
            $objDemo->sender = "$site_name";
            $objDemo->date = Carbon::Now();
            $objDemo->subject = "Deposit Processed!";

            Mail::bcc($user->email)->send(new NewNotification($objDemo));

            return redirect(route('account.liveaccounts'))->with('message', 'Your deposit was successfully processed!');
        } else {
            return redirect()->back()->with('message', $data['message']);
        }
    }


    public function startPayStudioCharge(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();

        $t7_id = $request->session()->get('t7_account_id');
        $amt = $request->session()->get('amount');

        $t7 = Trader7::find($t7_id);

        $data = $request->all();
        $data['api_key'] = config('paystudio.api_key');
        $data['ip_address'] = $request->ip();
        $data['response_url'] = route('verifypaystudiocharge');
        $data['customer_order_id'] = $user->id;

        unset($data['_token']);

        $response = Http::post('https://dashboard.paystudio.app/api/transaction', $data);

        $resp = json_decode($response->body());

        if ($resp->status == 'success') {
            $amt = $resp->data->amount;
            $respTrans = $this->performTransaction($t7->currency, $t7->number, $amt, 'MM-PayStudio', 'MM-AUTOPS', 'deposit', 'balance');
            if (gettype($respTrans) !== 'integer') {
                return redirect()->back()->with('message', 'Sorry an error occured, report this to support!');
            } else {
                $t7->balance = $t7->balance + $amt;
                $t7->save();
            }

            // save transaction
            $this->saveTransaction($user->id, $amt, 'Deposit', 'Credit');

            // save and confirm the deposit
            $this->saveRecord($user->id, $t7_id, 'PayStudio', $amt, 'Deposit', 'Processed', 'PayStudio Order Id: ' . $resp->data->order_id);

            // send email notification
            $currency = Setting::getValue('currency');
            $site_name = Setting::getValue('site_name');

            $objDemo = new \stdClass();
            $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);
            $objDemo->message = "\r Hello $name, \r\n
                \r This is to inform you that your deposit of $currency$amt has been received and confirmed.";
            $objDemo->sender = "$site_name";
            $objDemo->date = Carbon::Now();
            $objDemo->subject = "Deposit Processed!";

            Mail::bcc($user->email)->send(new NewNotification($objDemo));

            return redirect(route('account.liveaccounts'))->with('message', 'Your deposit was successfully processed!');
        } elseif ($resp->status == 'fail') {
            return redirect()->back()->with('message', $resp->message);
        } elseif ($resp->status == '3d_redirect') {
            // save and confirm the deposit
            $this->saveRecord($user->id, $t7_id, 'PayStudio', $amt, 'Deposit', 'Pending', 'PayStudio Order Id: ' . $resp->data->order_id);

            return redirect($resp->redirect_3ds_url)->with('message', 'Redirecting you to complete 3DS security challenge.');
        } else {
            return redirect()->back()->with('message', $resp->message);
        }
    }


    public function verifyPayStudioCharge(Request $request)
    {
        $data = $request->all();
        $user = User::find($data['customer_order_id']);
        $dp = $user->dp()->latest()->first();

        $t7_id = $request->session()->get('t7_account_id');

        $t7 = Trader7::find($t7_id);

        if ($data['status'] == 'success') {
            $amt = $dp->amount;
            $respTrans = $this->performTransaction($t7->currency, $t7->number, $amt, 'MM-PayStudio', 'MM-AUTOPS', 'deposit', 'balance');
            if (gettype($respTrans) !== 'integer') {
                return redirect()->back()->with('message', 'Sorry an error occured, report this to support! ');
            } else {
                $t7->balance = $t7->balance + $amt;
                $t7->save();
            }

            // save transaction
            $this->saveTransaction($user->id, $amt, 'Deposit', 'Credit');

            // update the deposit
            $dp->status = "Processed";
            $dp->save();

            // send email notification
            $currency = Setting::getValue('currency');
            $site_name = Setting::getValue('site_name');

            $objDemo = new \stdClass();
            $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);
            $objDemo->message = "\r Hello $name, \r\n
                \r This is to inform you that your deposit of $currency$amt has been received and confirmed.";
            $objDemo->sender = "$site_name";
            $objDemo->date = Carbon::Now();
            $objDemo->subject = "Deposit Processed!";

            Mail::bcc($user->email)->send(new NewNotification($objDemo));

            return redirect(route('account.liveaccounts'))->with('message', 'Your deposit was successfully processed!');
        } else {
            return redirect()->back()->with('message', $data['message']);
        }
    }


    public function startChargeMoneyCharge(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();

        $t7_id = $request->session()->get('t7_account_id');
        $amt = $request->session()->get('amount');

        $t7 = Trader7::find($t7_id);

        $order_id = rand();
        $request->session()->put('chargemoney_order_id', $order_id);

        $data = $request->all();
        $data['api_key'] = config('chargemoney.api_key');
        $data['ip_address'] = $request->ip();
        $data['response_url'] = route('verifychargemoneycharge');
        $data['webhook_url'] = route('verifychargemoneycharge');
        $data['customer_order_id'] = $t7_id . '-' . $order_id . '-' . $user->id;

        unset($data['_token']);

        $response = Http::post('https://dashboard.charge.money/api/transaction', $data);

        $resp = json_decode($response->body());

        if ($resp->status == 'success') {
            $amt = $resp->data->amount;
            $respTrans = $this->performTransaction($t7->currency, $t7->number, $amt, 'MM-ChargeMoney', 'MM-AUTOCM', 'deposit', 'balance');
            if (gettype($respTrans) !== 'integer') {
                return redirect()->back()->with('message', 'Sorry an error occured, report this to support, we have received your payment! ');
            } else {
                $t7->balance = $t7->balance + $amt;
                $t7->save();
            }

            // save transaction
            $this->saveTransaction($user->id, $amt, 'Deposit', 'Credit');

            // save and confirm the deposit
            $this->saveRecord($user->id, $t7_id, 'ChargeMoney', $amt, 'Deposit', 'Processed', 'ChargeMoney Order Id: ' . $resp->data->order_id);

            // send email notification
            $currency = Setting::getValue('currency');
            $site_name = Setting::getValue('site_name');

            $objDemo = new \stdClass();
            $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);
            $objDemo->message = "\r Hello $name, \r\n
                \r This is to inform you that your deposit of $currency$amt has been received and confirmed.";
            $objDemo->sender = "$site_name";
            $objDemo->date = Carbon::Now();
            $objDemo->subject = "Deposit Processed!";

            Mail::bcc($user->email)->send(new NewNotification($objDemo));

            return redirect(route('account.liveaccounts'))->with('message', 'Your deposit was successfully processed!');
        } elseif ($resp->status == '3d_redirect') {
            // save and confirm the deposit
            $this->saveRecord($user->id, $t7_id, 'ChargeMoney', $amt, 'Deposit', 'Pending', 'ChargeMoney Order Id: ' . $resp->data->order_id);

            return redirect($resp->redirect_3ds_url)->with('message', 'Redirecting you to complete 3DS security challenge.');
        } else {
            $msg = $resp->message;
            foreach ($resp->errors as $field => $error) {
                $msg .= implode(", ", $error);
            }
            return redirect()->back()->with('message', $msg);
        }
    }


    public function startYWallitPayCharge(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();

        $t7_id = $request->session()->get('t7_account_id');
        $amt = $request->session()->get('amount');

        $t7 = Trader7::find($t7_id);

        $data = $request->all();
        $data['mid'] = config('ywallitpay.mid');
        $data['ip'] = $request->ip();
        $data['orderNumber'] = strtoupper('apglive' . $user->id . '-') . strtotime('now');
        $data['callback_url'] = route('verifyywallitpaycharge');
        $data['success_url'] = route('verifyywallitpaycharge');
        $data['error_url'] = route('verifyywallitpaycharge');

        unset($data['_token']);

        $response = Http::withToken(config('ywallitpay.api_key'))->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->post('https://app.ywallitpay.com/api/v1/transactions', $data);

        $resp = $response->json();

        if ($resp['status'] == 'C') {
            $amt = $resp['amount'];
            $respTrans = $this->performTransaction($t7->currency, $t7->number, $amt, 'MM-YWallit', 'MM-AUTOYWP', 'deposit', 'balance');
            if (gettype($respTrans) !== 'integer') {
                return redirect()->back()->with('message', 'Sorry an error occured, report this to support! ');
            } else {
                $t7->balance = $t7->balance + $amt;
                $t7->save();
            }

            // save transaction
            $this->saveTransaction($user->id, $amt, 'Deposit', 'Credit');

            // save and confirm the deposit
            $this->saveRecord($user->id, $t7_id, 'YWallitPay', $amt, 'Deposit', 'Processed', 'YWallitPay Order Id: ' . $resp->data->order_id);

            // send email notification
            $currency = Setting::getValue('currency');
            $site_name = Setting::getValue('site_name');

            $objDemo = new \stdClass();
            $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);
            $objDemo->message = "\r Hello $name, \r\n
                \r This is to inform you that your deposit of $currency$amt has been received and confirmed.";
            $objDemo->sender = "$site_name";
            $objDemo->date = Carbon::Now();
            $objDemo->subject = "Deposit Processed!";

            Mail::bcc($user->email)->send(new NewNotification($objDemo));

            return redirect(route('account.liveaccounts'))->with('message', 'Your deposit was successfully processed!');
        } elseif ($resp['status'] == 'S') {
            // save deposit as pending and redirect to 3ds
            $this->saveRecord($user->id, $t7_id, 'YWallitPay', $amt, 'Deposit', 'Pending', 'YWallitPay Order Id: ' . $resp->data->order_id);

            return redirect($resp['redirect_url'])->with('message', $resp['message']);
        } else {
            return redirect()->back()->with('message', $resp['message']);
        }
    }


    public function verifyYWallitPayCharge(Request $request)
    {
        $data = $request->all();
        $user = User::find($data['customer_order_id']);
        $dp = $user->dp()->latest()->first();

        $t7_id = $request->session()->get('t7_account_id');

        $t7 = Trader7::find($t7_id);

        if ($data['status'] == 'C') {
            $amt = $dp->amount;
            $respTrans = $this->performTransaction($t7->currency, $t7->number, $amt, 'MM-YWallit', 'MM-AUTOYWP', 'deposit', 'balance');
            if (gettype($respTrans) !== 'integer') {
                return redirect()->back()->with('message', 'Sorry an error occured, report this to support! ');
            } else {
                $t7->balance = $t7->balance + $amt;
                $t7->save();
            }

            // save transaction
            $this->saveTransaction($user->id, $amt, 'Deposit', 'Credit');

            // update the deposit
            $dp->proof = $dp->proof . '';
            $dp->status = "Processed";
            $dp->save();

            // send email notification
            $currency = Setting::getValue('currency');
            $site_name = Setting::getValue('site_name');

            $objDemo = new \stdClass();
            $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);
            $objDemo->message = "\r Hello $name, \r\n
                \r This is to inform you that your deposit of $currency$amt has been received and confirmed.";
            $objDemo->sender = "$site_name";
            $objDemo->date = Carbon::Now();
            $objDemo->subject = "Deposit Processed!";

            Mail::bcc($user->email)->send(new NewNotification($objDemo));

            return redirect(route('account.liveaccounts'))->with('message', 'Your deposit was successfully processed!');
        } else {
            return redirect()->back()->with('message', $data['message']);
        }
    }


    public function startVirtualPayCharge(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();

        $t7_id = $request->session()->get('t7_account_id');
        $amt = $request->session()->get('amount');

        $t7 = Trader7::find($t7_id);

        $data = $request->all();

        $data['MID'] = config('virtualpay.mid', 'Axes');
        $data['API_KEY'] = config('virtualpay.api_key');
        $data['API_SECRET'] = config('virtualpay.api_secret');
        $data['PRIVATE_KEY'] = config('virtualpay.private_key');
        $data['REDIRECT_URL'] = route('verifyvirtualpaycharge');
        $data['NOTIFICATION_URL'] = route('verifyvirtualpaycharge');
        // $data[''] = '';
        // $data[''] = '';
        // $data[''] = '';
        // $data[''] = '';
        // $data[''] = '';
        $data['ip'] = $request->ip();
        $data['REQUESTID'] = 'VPGLIVE-' . $user->id . '-' . strtotime('now');

        unset($data['_token']);

        $response = Http::post('https://evirtualpay.com/pg/vpcheckout/index.php', $data);

        $resp = json_decode($response->body());

        if ($resp->responseCode == '0') {
            $amt = $resp->amount;
            $respTrans = $this->performTransaction($t7->currency, $t7->number, $amt, 'MM-VirtualPay', 'MM-AUTOVP', 'deposit', 'balance');
            if (gettype($respTrans) !== 'integer') {
                return redirect()->back()->with('message', 'Sorry an error occured, report this to support! ');
            } else {
                $t7->balance = $t7->balance + $amt;
                $t7->save();
            }

            // save transaction
            $this->saveTransaction($user->id, $amt, 'Deposit', 'Credit');

            // save and confirm the deposit
            $this->saveRecord($user->id, $t7_id, 'VirtualPay', $amt, 'Deposit', 'Processed', 'VirtualPay Order Id: ' . $resp->data->order_id);

            // send email notification
            $currency = Setting::getValue('currency');
            $site_name = Setting::getValue('site_name');

            $objDemo = new \stdClass();
            $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);
            $objDemo->message = "\r Hello $name, \r\n
                \r This is to inform you that your deposit of $currency$amt has been received and confirmed.";
            $objDemo->sender = "$site_name";
            $objDemo->date = Carbon::Now();
            $objDemo->subject = "Deposit Processed!";

            Mail::bcc($user->email)->send(new NewNotification($objDemo));

            return redirect(route('account.liveaccounts'))->with('message', 'Your deposit was successfully processed!');
        } elseif ($resp->status == 'fail') {
            return redirect()->back()->with('message', $resp->message);
        } elseif ($resp->status == '3d_redirect') {
            // save and confirm the deposit
            $this->saveRecord($user->id, $t7_id, 'VirtualPay', $amt, 'Deposit', 'Pending', 'VirtualPay Order Id: ' . $resp->data->order_id);

            return redirect($resp->redirect_3ds_url)->with('message', 'Redirecting you to complete 3DS security challenge.');
        } else {
            return redirect()->back()->with('message', $resp->message);
        }
    }


    public function verifyVirtualPayCharge(Request $request)
    {
        $data = $request->all();
        $user = User::find($data['customer_order_id']);
        $dp = $user->dp()->latest()->first();

        $t7_id = $request->session()->get('t7_account_id');

        $t7 = Trader7::find($t7_id);

        if ($data['responseCode'] == '0') {
            $amt = $dp->amount;
            $respTrans = $this->performTransaction($t7->currency, $t7->number, $amt, 'MM-VirtualPay', 'MM-AUTOVP', 'deposit', 'balance');
            if (gettype($respTrans) !== 'integer') {
                return redirect()->back()->with('message', 'Sorry an error occured, report this to support! ');
            } else {
                $t7->balance = $t7->balance + $amt;
                $t7->save();
            }

            // save transaction
            $this->saveTransaction($user->id, $amt, 'Deposit', 'Credit');

            // update the deposit
            $dp->status = "Processed";
            $dp->save();

            // send email notification
            $currency = Setting::getValue('currency');
            $site_name = Setting::getValue('site_name');

            $objDemo = new \stdClass();
            $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);
            $objDemo->message = "\r Hello $name, \r\n
                \r This is to inform you that your deposit of $currency$amt has been received and confirmed.";
            $objDemo->sender = "$site_name";
            $objDemo->date = Carbon::Now();
            $objDemo->subject = "Deposit Processed!";

            Mail::bcc($user->email)->send(new NewNotification($objDemo));

            return redirect(route('account.liveaccounts'))->with('message', 'Your deposit was successfully processed!');
        } else {
            return redirect()->back()->with('message', $data['message']);
        }
    }


    public function handleAuthorizeNetPay(Request $request)
    {
        $user = auth()->user();
        $t7_id = $request->session()->get('t7_account_id');
        $t7 = Trader7::find($t7_id);

        /* Create a merchantAuthenticationType object with authentication details
          retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(config('authorizenet.mid'));
        $merchantAuthentication->setTransactionKey(config('authorizenet.transaction_key'));

        // Set the transaction's refId
        $refId = $user->id . time();
        $cardNumber = preg_replace('/\s+/', '', $request->cardNumber);

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $creditCard->setExpirationDate($request->expYear . "-" . $request->expMonth);
        $creditCard->setCardCode($request->cvv);

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($request->amount);
        $transactionRequestType->setPayment($paymentOne);

        // Assemble the complete transaction request
        $requests = new AnetAPI\CreateTransactionRequest();
        $requests->setMerchantAuthentication($merchantAuthentication);
        $requests->setRefId($refId);
        $requests->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($requests);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);

        if ($response != null) {
            // Check to see if the API request was successfully received and acted upon
            if ($response->getMessages()->getResultCode() == "Ok") {
                // Since the API request was successful, look for a transaction response
                // and parse it to display the results of authorizing the card
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getMessages() != null) {
                    // echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n";
                    // echo " Transaction Response Code: " . $tresponse->getResponseCode() . "\n";
                    // echo " Message Code: " . $tresponse->getMessages()[0]->getCode() . "\n";
                    // echo " Auth Code: " . $tresponse->getAuthCode() . "\n";
                    // echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";
                    $message_text = $tresponse->getMessages()[0]->getDescription() . ", Transaction ID: " . $tresponse->getTransId();

                    $amt = $data['amount'];
                    $respTrans = $this->performTransaction($t7->currency, $t7->number, $amt, 'MM-AuthorizeNet', 'MM-AUTOAN', 'deposit', 'balance');
                    if (gettype($respTrans) !== 'integer') {
                        return redirect()->back()->with('message', 'Sorry an error occured, report this to support!');
                    } else {
                        $t7->balance = $t7->balance + $amt;
                        $t7->save();
                    }

                    // save transaction
                    $this->saveTransaction($user->id, $amt, 'Deposit', 'Credit');

                    // save the deposit
                    $this->saveRecord($user->id, $t7_id, 'Authorize.Net', $amt, 'Deposit', 'Processed', 'Authorize.net Order Id: ' . $tresponse->getTransId());

                    // send email notification
                    $currency = Setting::getValue('currency');
                    $site_name = Setting::getValue('site_name');

                    $objDemo = new \stdClass();
                    $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);
                    $objDemo->message = "\r Hello $name, \r\n\r This is to inform you that your deposit of $currency$amt has been received and confirmed.";
                    $objDemo->sender = "$site_name";
                    $objDemo->date = Carbon::Now();
                    $objDemo->subject = "Deposit Processed!";

                    Mail::bcc($user->email)->send(new NewNotification($objDemo));
                } else {
                    $message_text = 'There were some issue with the payment. Please try again later.';

                    if ($tresponse->getErrors() != null) {
                        $message_text = $tresponse->getErrors()[0]->getErrorText();
                    }
                }
                // Or, print errors if the API request wasn't successful
            } else {
                $message_text = 'There were some issue with the payment. Please try again later.';

                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getErrors() != null) {
                    $message_text = $tresponse->getErrors()[0]->getErrorText();
                } else {
                    $message_text = $response->getMessages()->getMessage()[0]->getText();
                }
            }
        } else {
            $message_text = "No response returned";
        }
        return redirect(route('account.liveaccounts'))->with('message', $message_text);
    }


    public function startCashonexPay(Request $request)
    {
        $endpoint = config('cashonex.endpoint');

        $t7_id = $request->session()->get('t7_account_id');
        $t7 = Trader7::find($t7_id);
        $user = Auth::user();
        $amount = $request->amount;

        $deposit = new Deposit();
        $deposit->status = 'Pending';
        $deposit->payment_mode = 'Cashonex';
        $deposit->amount = $amount;
        $deposit->user = $user->id;
        $deposit->account_id = $t7_id;
        $deposit->save();

        $postInput = [
            'salt' => config('cashonex.api_key'),
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'zip_code' => $request->zip_code,
            'amount' => $amount,
            'currency' => $request->currency,
            'pay_by' => $request->pay_by,
            'card_number' => $request->card_number,
            'card_name' => $request->card_name,
            'cvv_code' => $request->cvv_code,
            'expiry_month' => $request->expiry_month,
            'expiry_year' => $request->expiry_year,
            'clientip' => $request->ip(),
            'redirect_url' => route('verifycashonexcharge'),
            'webhook_url' => route('verifycashonexcharge'),
            'orderid' => $deposit->id,
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'Idempotency-Key' => config('cashonex.api_secret')
        ];

        $response = Http::withHeaders($headers)->withBody(json_encode($postInput), 'application/json')->post($endpoint);

        $resp = json_decode($response->getBody(), true);
        // $msg = $resp['message'];

        // if($resp['success'] ==  false) {
        //     return redirect()->back()->with('message', $msg);
        // }

        if ($resp['data']['gatewayStatus'] == 'APPROVED') {
            $paymentId = $resp['data']['paymentId'];
            $respT7 = $this->performTransaction($t7->currency, $t7->number, $amount, 'MM-Cashonex', 'MM-AUTOCO-' . $paymentId, 'deposit', 'balance');

            if (gettype($respT7) !== 'integer') {
                return redirect()->back()->with('message', 'Sorry an error occured, report this to support!');
            } else {
                $t7->balance += $amount;
                $t7->save();
                $deposit->amount = $amount;
                $deposit->txn_id = $paymentId;
                $deposit->status = 'Processed';
                $deposit->save();

                //save transaction
                $this->saveTransaction($user->id, $amount, 'Deposit', 'Credit');

                //send email notification
                $currency = Setting::getValue('currency');
                $site_name = Setting::getValue('site_name');
                $objDemo = new \stdClass();

                $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);
                $objDemo->message = "\r Hello $name, \r\n

                \r This is to inform you that your deposit of $currency$amount has been received and confirmed.";
                $objDemo->sender = "$site_name";
                $objDemo->date = Carbon::Now();
                $objDemo->subject = "Deposit Processed!";

                Mail::bcc($user->email)->send(new NewNotification($objDemo));
                $msg = 'Your deposit was successfully processed!';
            }
        }

        // If 3D
        $url = $resp['data']['redirectUrl'];
        // dd([$url, $response]);
        if ($url) {
            $msg = 'Security Redirection by PSP! Redirecting...';
            return redirect($url);
        }

        // If 2D
        if ($resp['data']['gatewayStatus'] == 'initiated') {
            $msg = 'Deposit Initiated by PSP! Check back later...';
        }

        if ($resp['data']['gatewayStatus'] == 'DECLINED') {
            $msg = 'Deposit Declined by PSP!' . $resp['data']['gatewayResponse'];
        }

        Session::flash('message', $msg);
        return redirect(route('account.liveaccounts'))->with('message', $msg);
    }


    public function handleCashonexPay(Request $request)
    {
        $t7_id = $request->session()->get('t7_account_id');
        $t7 = Trader7::find($t7_id);
        $user = Auth::user();
        $msg = $request->message;

        $deposit = Deposit::find($request->orderId);
        if ($deposit) {
            if ($request->status == 'DECLINED') {
                $deposit->status = 'Declined';
                $deposit->save();

                $msg = 'Sorry your payment was delined because for the following reason: ' . $request->message;
            } elseif ($request->status == 'APPROVED') {
                $amount = $deposit->amount;
                $paymentId = $request->paymentId;
                $respT7 = $this->performTransaction($t7->currency, $t7->number, $amount, 'MM-Cashonex', 'MM-AUTOCO-' . $paymentId, 'deposit', 'balance');

                if (gettype($respT7) !== 'integer') {
                    return redirect()->back()->with('message', 'Sorry an error occured, report this to support!');
                } else {
                    $t7->balance += $amount;
                    $t7->save();
                    $deposit->txn_id = $paymentId;
                    $deposit->status = 'Processed';
                    $deposit->save();

                    //save transaction
                    $this->saveTransaction($user->id, $amount, 'Deposit', 'Credit');

                    //send email notification
                    $currency = Setting::getValue('currency');
                    $site_name = Setting::getValue('site_name');
                    $objDemo = new \stdClass();

                    $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);
                    $objDemo->message = "\r Hello $name, \r\n

                    \r This is to inform you that your deposit of $currency$amount has been received and confirmed.";
                    $objDemo->sender = "$site_name";
                    $objDemo->date = Carbon::Now();
                    $objDemo->subject = "Deposit Processed!";

                    Mail::bcc($user->email)->send(new NewNotification($objDemo));
                    $msg = 'Your deposit was successfully processed!';
                }
            }
        }

        Session::flash('message', $msg);
        return redirect(route('account.liveaccounts'))->with('message', $msg);
    }


    public function finalizeNumPay(Request $request)
    {
        $data = $request->all();
        $stringD = implode(', ', $data);
        error_log($stringD);

        $amount = $request->session()->get('amount');
        $t7_id = $request->session()->get('t7_account_id');
        $t7 = Trader7::find($t7_id);
        $user = Auth::user();
        $paymentId = $request->transaction_id;

        $deposit = Deposit::where('txn_id', $paymentId)->first();
        if (!$deposit) $deposit = new Deposit();

        $deposit->status = $request->status;
        $deposit->payment_mode = 'NumPay';
        $deposit->user = $user->id;
        $deposit->account_id = $t7_id;
        $deposit->amount = $amount;
        $deposit->txn_id = $paymentId;
        $deposit->save();
        $msg = $request->status . ': '  . $request->xresponse;

        if ($request->status ==  'Declined') {
            return redirect(route('account.liveaccounts'))->with('message', $msg);
        }

        if ($request->status == 'Success') {
            if ($request->paid_amount) $amount = $request->paid_amount;
            $respT7 = $this->performTransaction($t7->currency, $t7->number, $amount, 'MM-NUMPAY', 'MM-AUTONP-' . $paymentId, 'deposit', 'balance');

            if (gettype($respT7) !== 'integer') {
                return redirect(route('account.liveaccounts'))->with('message', 'Sorry an error occured, report this to support!');
            } else {
                $t7->balance += $amount;
                $t7->save();
                $deposit->txn_id = $paymentId;
                $deposit->amount = $amount;
                $deposit->status = 'Processed';
                $deposit->save();

                //save transaction
                $this->saveTransaction($user->id, $amount, 'Deposit', 'Credit');

                //send email notification
                $currency = Setting::getValue('currency');
                $site_name = Setting::getValue('site_name');
                $objDemo = new \stdClass();

                $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);
                $objDemo->message = "\r Hello $name, \r\n

                \r This is to inform you that your deposit of $currency$amount has been received and confirmed.";
                $objDemo->sender = "$site_name";
                $objDemo->date = Carbon::Now();
                $objDemo->subject = "Deposit Processed!";

                Mail::bcc($user->email)->send(new NewNotification($objDemo));
                $msg = 'Your deposit was successfully processed!';
            }
        }

        Session::flash('message', $msg);
        return redirect(route('account.liveaccounts'))->with('message', $msg);
    }


    public function successRagapay(Request $request)
    {
        $data = $request->all();
        $order_number = $request->session()->get('ragapay_order_number');
        $txn_id = $data['id'];

        $t7_id = explode('-', $order_number)[2];
        $t7 = Trader7::find($t7_id);
        $user = Auth::user();

        $deposit = Deposit::find(explode('-', $order_number)[1]);
        $deposit->status = 'Pending';
        $deposit->payment_mode = 'RagaPay';
        $deposit->user = $user->id;
        $deposit->account_id = $t7_id;
        $deposit->txn_id = $txn_id;
        $deposit->save();

        $msg = 'We are processing your payment, check back later. ' . $request->reason;

        Session::flash('message', $msg);
        return redirect(route('account.liveaccounts'))->with('message', $msg);
    }


    public function cancelRagapay(Request $request)
    {
        $msg = "Sorry, we couldn't complete the process successfully, retry the payment and maybe use another payment option";

        Session::flash('message', $msg);
        return redirect(route('account.liveaccounts'))->with('message', $msg);
    }


    public function startPaycly(Request $request)
    {
        $endpoint = config('paycly.endpoint') . '/checkout.do';

        $t7_id = $request->session()->get('t7_account_id');
        $t7 = Trader7::find($t7_id);
        $user = Auth::user();
        $amount = $request->amount;

        $deposit = new Deposit();
        $deposit->status = 'Pending';
        $deposit->payment_mode = 'Paycly';
        $deposit->amount = $amount;
        $deposit->user = $user->id;
        $deposit->account_id = $t7_id;
        $deposit->save();

        $postInput = [
            'website_id' => config('paycly.website_id'),
            'api_token' => config('paycly.api_key'),
            'cardsend' => 'CHECKOUT',
            'client_ip' => $request->ip(),
            'action' => 'producct',
            'source' => 'Host-Redirect-Card-Payment (Core PHP)',
            'source_url' => (isset($_SERVER["HTTPS"]) ? 'https://' : 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']),
            'product_name' => 'Training Pack 1',
            'fullname' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'bill_street_1' => $request->address,
            'bill_street_2' => $request->address,
            'bill_city' => $request->city,
            'bill_state' => $request->state,
            'bill_country' => $request->country,
            'bill_zip' => $request->zip_code,
            'bill_phone' => $request->phone,
            'price' => $amount,
            'curr' => $request->currency,
            'pay_by' => $request->pay_by,
            'card_number' => $request->card_number,
            'card_name' => $request->card_name,
            'ccvv' => $request->cvv_code,
            'month' => $request->expiry_month,
            'year' => $request->expiry_year,
            'notify_url' => route('handlepayclycharge'),
            'success_url' => route('handlepayclycharge'),
            'error_url' => route('handlepayclycharge'),
            'id_order' => $deposit->id,
            // '' => '',
            // '' => '',
        ];

        // $headers = [
        //     'Content-Type' => 'application/json',
        //     'Idempotency-Key' => config('cashonex.api_secret')
        // ];

        $response = Http::withBody(json_encode($postInput), 'application/json')->post($endpoint);

        $resp = json_decode($response->getBody(), true);
        dd([$postInput, $resp]);
        // $msg = $resp['message'];

        // if($resp['success'] ==  false) {
        //     return redirect()->back()->with('message', $msg);
        // }

        if ($resp['data']['gatewayStatus'] == 'APPROVED') {
            $paymentId = $resp['data']['paymentId'];
            $respT7 = $this->performTransaction($t7->currency, $t7->number, $amount, 'MM-Paycly', 'MM-AUTOCO-' . $paymentId, 'deposit', 'balance');

            if (gettype($respT7) !== 'integer') {
                return redirect()->back()->with('message', 'Sorry an error occured, report this to support!');
            } else {
                $t7->balance += $amount;
                $t7->save();
                $deposit->amount = $amount;
                $deposit->txn_id = $paymentId;
                $deposit->status = 'Processed';
                $deposit->save();

                //save transaction
                $this->saveTransaction($user->id, $amount, 'Deposit', 'Credit');

                //send email notification
                $currency = Setting::getValue('currency');
                $site_name = Setting::getValue('site_name');
                $objDemo = new \stdClass();

                $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);
                $objDemo->message = "\r Hello $name, \r\n

                \r This is to inform you that your deposit of $currency$amount has been received and confirmed.";
                $objDemo->sender = "$site_name";
                $objDemo->date = Carbon::Now();
                $objDemo->subject = "Deposit Processed!";

                Mail::bcc($user->email)->send(new NewNotification($objDemo));
                $msg = 'Your deposit was successfully processed!';
            }
        }

        // If 3D
        $url = $resp['data']['redirectUrl'];
        // dd([$url, $response]);
        if ($url) {
            $msg = 'Security Redirection by PSP! Redirecting...';
            return redirect($url);
        }

        // If 2D
        if ($resp['data']['gatewayStatus'] == 'initiated') {
            $msg = 'Deposit Initiated by PSP! Check back later...';
        }

        if ($resp['data']['gatewayStatus'] == 'DECLINED') {
            $msg = 'Deposit Declined by PSP!';
        }

        Session::flash('message', $msg);
        return redirect(route('account.liveaccounts'))->with('message', $msg);
    }


    public function successXpro(Request $request)
    {
        $data = $request->all();
        $order_number = $request->session()->get('xpro_order_number');
        $txn_id = $data['id'];

        $t7_id = explode('-', $order_number)[2];
        $t7 = Trader7::find($t7_id);
        $user = Auth::user();

        $deposit = Deposit::find(explode('-', $order_number)[1]);
        $deposit->status = 'Pending';
        $deposit->payment_mode = 'Xpro';
        $deposit->user = $user->id;
        $deposit->account_id = $t7_id;
        $deposit->txn_id = $txn_id;
        $deposit->save();

        $msg = 'We are processing your payment, check back later. ' . $request->reason;

        Session::flash('message', $msg);
        return redirect(route('account.liveaccounts'))->with('message', $msg);
    }


    public function cancelXpro(Request $request)
    {
        $msg = "Sorry, we couldn't complete the process successfully, retry the payment and maybe use another payment option";

        Session::flash('message', $msg);
        return redirect(route('account.liveaccounts'))->with('message', $msg);
    }


    public function stripePost(Request $request)
    {
        $user = Auth::user();
        $amount = $request->amount;

        Stripe\Stripe::setApiKey(config('stripe.api_secret'));

        $msg = 'Payment successful!';

        try {

            $customer = Stripe\Customer::create(array(
                "address" => [
                    "line1" => $user->address,
                    "postal_code" => $user->zip_code,
                    "city" => $user->town,
                    "state" => $user->state,
                    "country" => strtoupper($user->country->code),
                ],
                "email" => $user->email,
                "name" => $user->name,
                "source" => $request->stripeToken
            ));

            $charge = Stripe\Charge::create([
                "amount" => $amount * 100,
                "currency" => "usd",
                "customer" => $customer->id,
                "description" => "Purchase of Product",
                "shipping" => [
                    "name" => $user->name,
                    "address" => [
                        "line1" => $user->address,
                        "postal_code" => $user->zip_code,
                        "city" => $user->town,
                        "state" => $user->state,
                        "country" => strtoupper($user->country->code),
                    ],
                ]
            ]);
        } catch (Exception $e) {
            $msg = $e->getMessage() . ' Please check your card details';
            return redirect()->back()->with('message', $msg);
        }

        if ($charge->status !== 'succeeded') {
            $msg = 'An error has occured: ';
        } else {
            $t7_id = $request->session()->get('t7_account_id');
            $t7 = Trader7::find($t7_id);
            $user = Auth::user();

            $deposit = new Deposit();
            $deposit->status = 'Pending';
            $deposit->payment_mode = 'Stripe';
            $deposit->amount = $amount;
            $deposit->user = $user->id;
            $deposit->account_id = $t7_id;
            $deposit->save();

            $paymentId = $charge->id;
            $respT7 = $this->performTransaction($t7->currency, $t7->number, $amount, 'MM-Stripe', 'MM-AUTOCO-' . $paymentId, 'deposit', 'balance');

            if (gettype($respT7) !== 'integer') {
                return redirect()->back()->with('message', 'Sorry an error occured, report this to support!');
            } else {
                $t7->balance += $amount;
                $t7->save();
                $deposit->txn_id = $paymentId;
                $deposit->status = 'Processed';
                $deposit->save();

                //save transaction
                $this->saveTransaction($user->id, $amount, 'Deposit', 'Credit');

                //send email notification
                $currency = Setting::getValue('currency');
                $site_name = Setting::getValue('site_name');
                $objDemo = new \stdClass();

                $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);
                $objDemo->message = "\r Hello $name, \r\n

                \r This is to inform you that your deposit of $currency$amount has been received and confirmed.";
                $objDemo->sender = "$site_name";
                $objDemo->date = Carbon::Now();
                $objDemo->subject = "Deposit Processed!";

                Mail::bcc($user->email)->send(new NewNotification($objDemo));
                $msg = 'Your deposit was successfully processed!';
            }
        }

        Session::flash('success', $msg);

        return redirect(route('account.liveaccounts'))->with('message', $msg);
    }

    //Logout the user
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }


    public function startHelcim(Request $request)
    {
        $data = $request->all();
        $amount = $request->session()->get('amount');
        if (!$amount)
            $amount = $data['amount'] / 1.4;

        if ($data['response']) {

            $user = User::where('id', Auth::user()->id)->first();

            $t7_id = $request->session()->get('t7_account_id');

            $t7 = Trader7::find($t7_id);

            $resp = $this->performTransaction($t7->currency, $t7->number, $amount, 'MM-Helcim', 'MM-AUTOHELCIM-' . $data['transactionId'], 'deposit', 'balance');
            if (gettype($resp) !== 'integer') {
                return json_encode(['message' => 'Sorry an error occured, report this to support!']);
            } else {
                $t7->balance += $amount;
                $t7->save();
            }

            //save transaction
            $this->saveTransaction($user->id, $amount, 'Deposit', 'Credit');

            //save and confirm the deposit
            $this->saveRecord($user->id, $t7_id, 'Helcim', $amount, 'Deposit', 'Processed', 'Helcim');

            //send email notification
            $currency = Setting::getValue('currency');
            $site_name = Setting::getValue('site_name');
            $objDemo = new \stdClass();

            $name = $user->name ? $user->name : ($user->first_name ? $user->first_name : $user->last_name);
            $objDemo->message = "\r Hello $name, \r\n

            \r This is to inform you that your deposit of $currency$amount has been received and confirmed.";
            $objDemo->sender = "$site_name";
            $objDemo->date = Carbon::Now();
            $objDemo->subject = "Deposit Processed!";

            Mail::bcc($user->email)->send(new NewNotification($objDemo));

            $msg = 'Your deposit was successfully processed!';
            Session::flash('message', $msg);
            return redirect(route('account.liveaccounts'))->with('message', $msg);
        } else {
            $msg = $data['responseMessage'];
            Session::flash('message', $msg);
            return redirect()->back();
        }
    }
}
