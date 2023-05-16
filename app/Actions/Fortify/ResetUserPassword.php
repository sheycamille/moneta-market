<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Libraries\MobiusTrader;
use App\Libraries\MobiusTrader\MtClient;
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
        $m7 = new MtClient(config('mobius'));
        $account = $resp['data'];
        $data = array(
            'ClientId' => (int)$account['Id'],
            'Login' => $account['Email'],
            'Password' => $data['password'],
            'SessionType' => 0
        );

        // set the password
        $respPassSet = $m7->call('PasswordSet', $data);
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