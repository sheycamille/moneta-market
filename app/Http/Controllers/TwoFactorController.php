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

use Carbon\Carbon;


class TwoFactorController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function verifyTwoFactor(Request $request)
    {
        $request->validate([
            '2fa' => 'required',
        ]);

        if ($request->input('2fa') == Auth::user()->token_2fa) {
            $user = Auth::user();
            $user->token_2fa_expiry = Carbon::now()->addMinutes(config('session.lifetime'));
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


    public function showTwoFactorForm()
    {
        return view('auth.two_factor');
    }
}
