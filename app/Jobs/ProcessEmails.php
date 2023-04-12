<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Mail\NewNotification;

class ProcessEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $objDemo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($objDemo)
    {
        $this->objDemo = $objDemo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        //contact email
        Mail::mailer('smtp')->bcc('wisdomcamille@gmail.com')->send(new NewNotification($this->objDemo));

        //deposit email
        $user = User::where('id', Auth::user()->id)->first();

        Mail::bcc($user->email)->send(new NewNotification($this->objDemo));
    }
}
