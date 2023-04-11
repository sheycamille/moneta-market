<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Carbon\Carbon;

use App\Models\Setting;
use App\Models\User;

use App\Mail\NewNotification;

class ProcessEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        $route = Route::current()->getName();

        if ($route == 'enquiry') {
            $site_name = Setting::getValue('site_name');
            $contact_email = Setting::getValue('contact_email');

            $objDemo = new \stdClass();
            $objDemo->message = substr(wordwrap($request['message'], 70), 0, 350);
            $objDemo->sender = "$site_name";
            $objDemo->date = Carbon::Now();
            $objDemo->subject = "Inquiry from $request->name with email $request->email";

            Mail::mailer('smtp')->bcc('wisdomcamille@gmail.com')->send(new NewNotification($objDemo));
        } else {

            $user = User::where('id', Auth::user()->id)->first();

            $amt = $request->session()->get('amount');

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
        }
    }
}
