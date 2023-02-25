<?php

namespace App\Http\Controllers;

use App\Models\Setting;

use App\Mail\NewNotification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;


use Carbon\Carbon;


class TwoFactorController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function index()
    {
        return view('auth.user_two_factor');
    }


    public function store(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'required',
        ]);

        if ($request->input('two_factor_code') == Auth::user()->token_2fa) {
            $user = Auth::user();
            $user->updated_at = Carbon::now();
            $user->save();

            $site_name = Setting::getValue('site_name');

            //send email notification
            $objDemo = new \stdClass();
            $objDemo->message = "This is a successful login on your account. If this was not you, kindly take action by changing your account and email passwords.";
            $objDemo->sender = $site_name;
            $objDemo->date = Carbon::now();
            $objDemo->subject = "Successful login";

            Mail::bcc($user->email)->send(new NewNotification($objDemo));

            return redirect('/dashboard');
        } else {
            return redirect()->back()->with('message', 'Incorrect code.');
        }
    }


    public function resend()
    {
        auth()->user()->resendCode();

        return redirect()->back()->withMessage('Check your email, the two factor code has been sent again');
    }


    public function check2FA(){

        if(Auth::user()->enable_2fa == 'no'){

            $id = auth()->user()->id;

            User::where('id', $id)
                ->update(['enable_2fa' => 'yes']);

            return redirect()->back();

        }else{

            $id = auth()->user()->id;

            User::where('id', $id)
                ->update(['enable_2fa' => 'no']);

            return redirect()->back();

        }

    }
}
