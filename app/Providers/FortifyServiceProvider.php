<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;


use App\Models\Setting;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;
use Illuminate\Support\Facades\Auth;

use App\Mail\Twofa;

use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {

              if (Auth::check()) {

                    if(Auth::user()->enable_2fa == 'yes'){
                        //dd(Auth::user()->email);
                        $user = Auth::user();
                        $user->token_2fa = mt_rand(100000, 999999);
                        $user->token_2fa_expiry = now()->addMinutes(60);
                        $username = $user->name;
                        $user->save();

                        // send 2fa email notification
                        $site_name = Setting::getValue('site_name');
                        $demo = new \stdClass();
                        $demo->message = $user->token_2fa;
                        $demo->sender = $site_name;
                        $demo->receiver_name = $username;
                        $demo->subject = "Two Factor Code";
                        $demo->date = Carbon::Now();

                        Mail::bcc($user->email)->send(new Twofa($demo));

                        return redirect()->route('user.verify.index');

                    }else{
                        return redirect('/dashboard');
                    }
                }
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::twoFactorChallengeView(function () {
            return view('auth.two-factor-challenge', [
                'title' => 'Two Factor Authentication',
            ]);
        });
    }
}