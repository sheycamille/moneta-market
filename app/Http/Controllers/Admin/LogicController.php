<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Models\User;
use App\Models\Images;
use App\Models\Content;
use App\Models\Deposit;
use App\Models\Setting;
use App\Models\Testimony;
use App\Models\Withdrawal;
use App\Models\Trader7;
use App\Models\AccountType;
use App\Mail\NewNotification;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Tarikh\PhpMeta\Entities\Trade;

use Carbon\Carbon;


class LogicController extends Controller
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    // function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }


    // Add account type
    public function addaccounttype(Request $request)
    {
        $accounttype = new AccountType();

        $accounttype->name = $request['name'];
        $accounttype->cost = $request['cost'];
        $accounttype->min_price = $request['min_price'];
        $accounttype->max_price = $request['max_price'];
        $accounttype->minr = $request['minr'];
        $accounttype->maxr = $request['maxr'];
        $accounttype->gift = $request['gift'];
        $accounttype->expected_return = $request['return'];
        $accounttype->increment_type = $request['t_type'];
        $accounttype->increment_interval = $request['t_interval'];
        $accounttype->increment_amount = $request['t_amount'];
        $accounttype->expiration = $request['expiration'];
        $accounttype->type = 'Main';
        $accounttype->save();
        return redirect()->back()
            ->with('message', 'Account Type created Sucessfully!');
    }


    // Update account type
    public function updateaccounttype(Request $request)
    {
        AccountType::where('id', $request['id'])
            ->update([
                'name' => $request['name'],
                'price' => $request['price'],
                'min_price' => $request['min_price'],
                'max_price' => $request['max_price'],
                'minr' => $request['minr'],
                'maxr' => $request['maxr'],
                'gift' => $request['gift'],
                'expected_return' => $request['return'],
                'increment_type' => $request['t_type'],
                'increment_amount' => $request['t_amount'],
                'increment_interval' => $request['t_interval'],
                'type' => 'Main',
                'expiration' => $request['expiration'],
            ]);
        return redirect()->back()
            ->with('message', 'Account Type Update Sucessful!');
    }


    // Trash Account Type route
    public function delaccounttype($id)
    {
        //remove users from the account type before deleting
        $users = User::where('account_type', $id)->get();
        foreach ($users as $user) {
            User::where('id', $user->id)
                ->update([
                    'account_type' => 0,
                ]);
        }
        AccountType::where('id', $id)->delete();
        return redirect()->back()
            ->with('message', 'Account Type has been deleted successfully!');
    }


    // Reject deposit
    public function rejectdeposit(Request $request, $id)
    {
        // fetch models
        $deposit = Deposit::where('id', $id)->first();
        $user = User::where('id', $deposit->user)->first();

        // change deposit status
        $deposit->status = 'Rejected';
        $deposit->save();

        // get settings
        $site_name = Setting::getValue('site_name');
        $currency = Setting::getValue('currency');

        // send email notification
        $objDemo = new \stdClass();
        $name = $user->name ? $user->name: ($user->first_name ? $user->first_name: $user->last_name);
        $objDemo->message = "\r Hello $name, \r \n " .
        "This is to inform you that your deposit of $currency$deposit->amount has been received but unfortunately rejected because of the following reaon: \r \n ".
        "$request->reason \r \n ".
        "Please fix the problem, we will gladly process it or contact our support for further assistance. \r\n ";
        $objDemo->sender = "$site_name";
        $objDemo->date = Carbon::Now();
        $objDemo->subject = "Deposit Request Rejected!";

        Mail::mailer('smtp')->bcc($user->email)->send(new NewNotification($objDemo));

        return redirect()->back()
            ->with('message', 'Deposit rejected successfully!');
    }


    // process deposits
    public function pdeposit(Request $request, $id)
    {
        $deposit = Deposit::where('id', $id)->first();
        $user = User::where('id', $deposit->user)->first();

        // get Trader7 account in question
        $t7 = Trader7::find($deposit->account_id);

        // do the deposit on the Trader7 account
        $respTrans = $this->performTransaction($t7->currency, $t7->number, $deposit->amount, 'SKG-Admin', 'MM-Auto', 'deposit', 'balance');

        if(gettype($respTrans) !== 'integer') {
            return redirect()->back()->with('message', 'Sorry an error occured, report this to IT!');
        }

        $deposit->status = 'Processed';
        $deposit->save();

        // update the local Trader7 account
        $t7->balance += $deposit->amount;
        $t7->save();

        // save transaction
        $this->saveTransaction($user->id, $deposit->amount, 'Processed Deposit', 'Credit');

        // get settings
        $site_name = Setting::getValue('site_name');
        $currency = Setting::getValue('currency');

        // send email notification
        $objDemo = new \stdClass();
        $name = $user->name ? $user->name: ($user->first_name ? $user->first_name: $user->last_name);
        $objDemo->message = "\r Hello $name, \r \n
        This is to inform you that your deposit of $currency$deposit->amount has been received and processed. You can now check your Trader7 account. \r\r";
        $objDemo->sender = "$site_name";
        $objDemo->date = Carbon::Now();
        $objDemo->subject = "Deposit processed successfully!";

        Mail::mailer('smtp')->bcc($user->email)->send(new NewNotification($objDemo));

        return redirect()->route('mdeposits')
            ->with('message', 'The user\'s account has been successfully topped up!');
    }


    //process withdrawals
    public function pwithdrawal(Request $request, $id)
    {
        $withdrawal = Withdrawal::where('id', $id)->first();
        $user = User::where('id', $withdrawal->user)->first();

        // do the withdrawal from on the Trader7 account
        $t7 = Trader7::find($withdrawal->account_id);
        $respTrans = $this->performTransaction($t7->currency, $t7->number, $withdrawal->amount, 'SKG-Admin', 'MM-Auto', 'withdrawal');

        if(gettype($respTrans) !== 'integer') {
            return redirect()->back()->with('message', 'Sorry an error occured, report this to IT!');
        }

        // update withdrawal
        $withdrawal->status = 'Processed';
        $withdrawal->save();

        // update the local Trader7 account
        $t7->balance -= round($withdrawal->amount);
        $t7->save();

        // save transaction
        $this->saveTransaction($user->id, round($withdrawal->amount), 'Processed Withdrawal', 'Debit');

        // get settings
        $currency = Setting::getValue('currency');
        $site_name = Setting::getValue('site_name');

        // send email notification
        $objDemo = new \stdClass();
        $name = $user->name ? $user->name: ($user->first_name ? $user->first_name: $user->last_name);
        $objDemo->message = "\r Hello $name, \r\n
        This is to inform you that your withdrawal request of $currency$withdrawal->amount have approved and the funds have been sent to your selected account. \r\n";
        $objDemo->sender = $site_name;
        $objDemo->subject = "Successful withdrawal";
        $objDemo->date = Carbon::Now();

        Mail::mailer('smtp')->bcc($user->email)->send(new NewNotification($objDemo));

        return redirect()->back()
            ->with('message', 'Widthdrawal Processed Sucessfully!');
    }


    // process withdrawals
    public function rejectwithdrawal(Request $request)
    {
        // load the models
        $withdrawal = Withdrawal::where('id', $request->id)->first();
        $user = User::where('id', $withdrawal->user)->first();

        // update the model
        $withdrawal->status = 'Rejected';
        $withdrawal->save();

        // get settings
        $site_name = Setting::getValue('site_name');
        $currency = Setting::getValue('currency');

        // send email notification
        $objDemo = new \stdClass();
        $objDemo->message = "Hello $user->name, \r \n " .
        "This is to inform you that your withdrawal request of $currency$withdrawal->amount has been received but unfortunately rejected because of the following reason: \r \n " .
        "$request->reason \r \n " .
        "Please fix the problem, we will gladly process it or contact our support for further assistance \r \n ";
        $objDemo->sender = $site_name;
        $objDemo->subject = "Rejected Withdrawal Request";
        $objDemo->date = Carbon::Now();

        Mail::mailer('smtp')->bcc($user->email)->send(new NewNotification($objDemo));

        return redirect()->back()
            ->with('message', 'Withdrawal Request Canceled!');
    }


    public function savefaq(Request $request)
    {

        $String = $this->generate_string(6);

        $faq = new Faq();
        $faq->ref_key = $String;
        $faq->question = $request['question'];
        $faq->answer = $request['answer'];
        $faq->save();
        return redirect()->back()
            ->with('message', 'Faq Added Sucessfully!');
    }


    public function savetestimony(Request $request)
    {
        $String = $this->generate_string(6);
        $tes = new Testimony();
        $tes->name = $request['testifier'];
        $tes->ref_key = $String;
        $tes->position = $request['position'];
        $tes->what_is_said = $request['said'];
        $tes->picture = $request['picture'];
        $tes->save();
        return redirect()->back()
            ->with('message', 'Testimony Added Sucessfully!');
    }


    public function saveimg(Request $request)
    {
        $String = $this->generate_string(6);

        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png|image',
        ]);

        if ($request->hasfile('image')) {
            $filef = $request->file('image');
            $namef = $String . $filef->getClientOriginalName();
            // save to storage/app/uploads as the new $filename
            $path = $filef->storeAs('public/photos', $namef);
        }

        $img = new Images();
        $img->title = $request['img_title'];
        $img->ref_key = $String;
        $img->description = $request['img_desc'];
        $img->img_path = $namef;
        $img->save();
        return redirect()->back()
            ->with('message', 'Image Added Sucessfully!');
    }


    public function savecontents(Request $request)
    {
        $String = $this->generate_string(6);
        $cont = new Content();
        $cont->title = $request['title'];
        $cont->ref_key = $String;
        $cont->description = $request['content'];
        $cont->save();
        return redirect()->back()
            ->with('message', 'Contents Added Sucessfully!');
    }


    public function updatefaq(Request $request)
    {
        Faq::where('id', $request['id'])
            ->update([
                'question' => $request['question'],
                'answer' => $request['answer'],
            ]);
        return redirect()->back()
            ->with('message', 'Faq Update Sucessful!');
    }


    public function updatetestimony(Request $request)
    {
        Testimony::where('id', $request['id'])
            ->update([
                'name' => $request['testifier'],
                'position' => $request['position'],
                'what_is_said' => $request['said'],
                'picture' => $request['picture'],
            ]);
        return redirect()->back()
            ->with('message', 'Testimony Update Sucessful!');
    }


    public function updatecontents(Request $request)
    {
        Content::where('id', $request['id'])
            ->update([
                'title' => $request['title'],
                'description' => $request['content'],
            ]);
        return redirect()->back()
            ->with('message', 'Content Update Sucessful!');
    }


    public function updateimg(Request $request)
    {
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png|image',
        ]);

        $imgs = Images::where('id', '=', $request->id)->first();
        $String = $this->generate_string(6);

        if (empty($request->file('image'))) {
            $filePathf = $imgs->img_path;
        } else {
            if ($request->hasfile('image')) {
                $filef = $request->file('image');
                $namef = $String . $filef->getClientOriginalName();
                // save to storage/app/uploads as the new $filename
                $path = $filef->storeAs('public/photos', $namef);
            }
        }

        Images::where('id', $request['id'])
            ->update([
                'title' => $request['img_title'],
                'description' => $request['img_desc'],
                'img_path' => $namef,
            ]);
        return redirect()->back()
            ->with('message', 'Image Updated Sucessfully!');
    }


    public function delfaq($id)
    {
        Faq::where('id', $id)->delete();
        return redirect()->back()
            ->with('message', 'Faq Sucessfully Deleted');
    }
}
