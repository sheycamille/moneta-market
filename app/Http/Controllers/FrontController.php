<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use App\Models\City;
use App\Models\Country;
use App\Models\Deposit;
use App\Models\State;
use App\Models\Setting;
use App\Models\User;

use App\Models\Trader7;

use App\Mail\NewNotification;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;


class FrontController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->to('login');
    }


    public function about()
    {
        return view('front.about');
    }


    public function contact()
    {
        return view('front.contact');
    }


    //send contact message to admin email
    public function sendContact(Request $request)
    {
        $site_name = Setting::getValue('site_name');
        $contact_email = Setting::getValue('contact_email');

        $objDemo = new \stdClass();
        $objDemo->message = substr(wordwrap($request['message'], 70), 0, 350);
        $objDemo->sender = "$site_name";
        $objDemo->date = Carbon::Now();
        $objDemo->subject = "Inquiry from $request->name with email $request->email";

        Mail::mailer('smtp')->bcc($contact_email)->send(new NewNotification($objDemo));

        return redirect()->back()
            ->with('message', ' Your message was sent successfully!');
    }


    public function products()
    {
        return view('front.products');
    }


    public function tradingPlatforms()
    {
        return view('front.trading-platforms');
    }


    public function marketNews()
    {
        return view('front.market-news');
    }


    public function economicCalender()
    {
        return view('front.economic-calender');
    }


    public function accountTypes()
    {
        $account_types = AccountType::where('active', 1)->get();

        return view('front.account-types', compact('account_types'));
    }


    public function forgotpassword()
    {
        return view('auth.forgot-password');
    }


    // public function ftds()
    // {
    //     $users = User::all();

    //     return view('front.ftds', [
    //         'title' => "First Time Deposits",
    //         'users' => $users,
    //     ]);
    // }


    public function creditScore()
    {
        return view('front.credit-score');
    }


    public function security()
    {
        return view('front.security');
    }


    public function forex()
    {
        return view('front.forex');
    }


    public function futures()
    {
        return view('front.futures');
    }


    public function indices()
    {
        return view('front.indices');
    }


    public function shares()
    {
        return view('front.shares');
    }


    public function metals()
    {
        return view('front.metals');
    }


    public function energies()
    {
        return view('front.energies');
    }


    public function crypto()
    {
        return view('front.crypto');
    }


    public function webtrader()
    {
        return view('front.webtrader');
    }


    public function trader7()
    {
        return view('front.trader7');
    }


    public function calculator()
    {
        return view('front.calculator');
    }


    public function switchLang($lang)
    {
        app()->setLocale($lang);
        session()->put('lang', $lang);
        return redirect()->back();
    }


    public function privacy()
    {
        return view('front.privacy');
    }


    public function terms()
    {
        return view('front.terms-of-serv');
    }


    public function execution()
    {
        return view('front.order-execution');
    }


    public function disclosure()
    {
        return view('front.risk-disclosure');
    }


    public function fetchDependent()
    {
        $countries = Country::get();
        return view('index', compact('countries'));
    }


    public function getStateList(Request $request)
    {
        $states = State::where("country_id", $request->country_id)
            ->get();
        return response()->json($states);
    }


    public function getTownList(Request $request)
    {
        $cities = City::where("state_id", $request->state_id)
            ->get();
        return response()->json($cities);
    }


    public function payNotifications(Request $request)
    {
        $data = $request->all();
        $currency = Setting::getValue('currency');
        $site_name = Setting::getValue('site_name');
        $deposit_email = Setting::getValue('deposit_email');

        $order_number = explode('-', $data['order_number']);
        $txn_id = $data['id'];

        $t7_id = $order_number[2];
        $t7 = Trader7::find($t7_id);
        $user = $t7->tuser();
        $amount = $data['order_amount'];

        $deposit = Deposit::find($order_number[1]);
        $deposit->amount = $amount;
        $deposit->txn_id = $txn_id;
        $deposit->save();

        $msg = 'We are processing your payment, check back later. ' . $data['reason'];

        if(strtolower($data['status']) == 'success' && $deposit->status == 'Pending') {
            $respT7 = $this->performTransaction($data['order_currency'], $t7->number, $amount, 'MM-Ragapay', 'MM-AUTORP-'.$txn_id, 'deposit', 'balance');

            if(gettype($respT7) !== 'integer') {
                $msg = 'Please contact support immediately, an unexpected error has occured but we got your funds.';
                return redirect()->back()->with('message', $msg);
            } else {
                $deposit->status = 'Processed';
                $deposit->save();
                $t7->balance += $amount;
                $t7->save();

                //save transaction
                $this->saveTransaction($user->id, $amount, 'Deposit', 'Credit');

                //send email notification
                $currency = Setting::getValue('currency');
                $site_name = Setting::getValue('site_name');
                $objDemo = new \stdClass();

                $name = $user->name ? $user->name: ($user->first_name ? $user->first_name: $user->last_name);
                $objDemo->message = "\r Hello $name, \r\n

                \r This is to inform you that your deposit of $currency$amount has been received and confirmed.";
                $objDemo->sender = "$site_name";
                $objDemo->date = Carbon::Now();
                $objDemo->subject = "Deposit Processed!";

                Mail::bcc($user->email)->send(new NewNotification($objDemo));
                $msg = 'Your deposit was successfully processed!';

                //send email notification to admin
                $objDemo = new \stdClass();
                $objDemo->message = "\r Hello Admin, \r\n" .
                    "\r This is to inform you of a successful deposit of $currency$amount with deposit id $order_number[1] to account number $t7->number by user $name, that just occured on your system through Ragapay. \r\n" .
                    "\r Please no extra action is needed at this time(auto-deposit) \r\n";
                $objDemo->sender = 'RagaPay Deposit: ' . $site_name;
                $objDemo->date = Carbon::Now();
                $objDemo->subject = "Action Needed: Successful RagaPay Deposit";
                Mail::mailer('smtp')->bcc($deposit_email)->send(new NewNotification($objDemo));
            }
        }

        return json_encode(['status' => true]);
    }
}
