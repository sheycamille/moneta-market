<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\Setting;

use App\Jobs\ProcessEmails;

use App\Mail\NewNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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


    public function sendContact(Request $request)
    {
        $site_name = Setting::getValue('site_name');
        $contact_email = Setting::getValue('contact_email');

        $objDemo = new \stdClass();
        $objDemo->message = substr(wordwrap($request['message'], 70), 0, 350);
        $objDemo->sender = "$site_name";
        $objDemo->date = Carbon::Now();
        $objDemo->subject = "Inquiry from $request->name with email $request->email";

        //dispatch email
        dispatch(new ProcessEmails($objDemo));

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
}
