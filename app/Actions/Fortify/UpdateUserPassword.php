<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Libraries\MobiusTrader;

use Laravel\Fortify\Contracts\UpdatesUserPasswords;


class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        $cur_password = $input['current_password'];
        $password = $input['password'];
        Validator::make($input, [
            'current_password' => ['required', 'string'],
            'password' => $this->passwordRules(),
        ])->after(function ($validator) use ($user, $cur_password) {
            if (!Hash::check($cur_password, $user->password)) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        })->validateWithBag('updatePassword');

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