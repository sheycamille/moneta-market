<?php

namespace App\Providers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;

use App\Actions\Jetstream\DeleteUser;

use App\Models\AccountType;
use App\Models\Country;
use App\Models\User;


class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();
        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::loginView(function () {
            return view('auth.login', [
                'title' => 'Sign In to Continue',
            ]);
        });


        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if (
                $user &&
                Hash::check($request->password, $user->password)
            ) {
                $request->session()->put('getAnouc', 'true');
                return $user;
            }
        });


        Fortify::registerView(function () {
            $countries = Country::whereStatus('active')->orderBy('name', 'asc')->get();
            $account_types = AccountType::where('active', 1)->get();

            return view('auth.register', [
                'title' => 'Register an Account',
                // 'user_country' => $user_country,
                'countries' => $countries,
                'account_types' => $account_types,
            ]);
        });
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
