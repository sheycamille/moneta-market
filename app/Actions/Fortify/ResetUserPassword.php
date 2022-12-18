<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Libraries\MobiusTrader;

use Laravel\Fortify\Contracts\ResetsUserPasswords;


class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function reset($user, array $input)
    {
        $password = $input['password'];
        Validator::make($input, [
            'password' => $this->passwordRules(),
        ])->validate();

        // set the password
        $m7 = new MobiusTrader(config('mobius'));
        $resp = $m7->password_set($user->account_number, $user->email, $password);
        if($resp['status'] == MobiusTrader::STATUS_OK) {
            $data = ['status' => 'OK', "message" => "Password has been reset to default."];
            $user->forceFill([
                'password' => Hash::make($password),
            ])->save();
        } else {
            $data = ['status' => 'OK', "message" => "Sorry, there was an error, contact support."];
        }

        return $data;
    }
}