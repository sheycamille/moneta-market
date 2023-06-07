<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Country;
use App\Models\Setting;
use App\Mail\NewNotification;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use Laravel\Jetstream\Jetstream;
use Laravel\Fortify\Contracts\CreatesNewUsers;

use Carbon\Carbon;

use App\Libraries\MobiusTrader;
use App\Libraries\MobiusTrader\MtClient;
use App\Rules\ReCaptcha;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;


    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $validator = Validator::make($input, [
            // 'name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'phone' => ['required', 'string',],
            'account_type' => ['required', 'string',],
            'address' => ['required', 'string',],
            'town' => ['required', 'string',],
            'state' => ['required', 'string',],
            'zip_code' => ['required', 'string',],
            'country' => ['required', 'string',],
            'g-recaptcha-response' => ['required', new ReCaptcha],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $referrer = session()->pull('ref_by') ? session()->pull('ref_by') : $input['ref_by'];
        $name = $input['first_name'];
        $name .= $input['last_name'] ? ' ' . $input['last_name'] : '';
        $data = [
            'name' => $name,
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'account_type' => $input['account_type'],
            'address' => $input['address'],
            'town' => $input['town'],
            'state' => $input['state'],
            'zip_code' => $input['zip_code'],
            'country_id' => $input['country'],
            'ref_by' => $referrer,
            'status' => 'active',
            'password' => $input['password'],
            'ref_by' => $referrer,
        ];

        // create the user
        $user = User::create($data);

        // create the user on mobius server
        $data['ClientId'] = $user->id;
        $mobiusResp = $this->createTrader($data);

        if($mobiusResp['status'] === MobiusTrader::STATUS_OK) {
            // hash the password before updating the user
            $data['password'] = Hash::make($data['password']);
            $data['account_number'] = $mobiusResp['data']['Id'];

            $user->update($data);

            // update the user's referral link and his referrer
            $ref_link = 'https://' . request()->getHttpHost() . '/ref/' . $user->id;
            $user->ref_link = $ref_link;

            if(!$user->ref_by) $user->ref_by = $referrer;

            $user->save();

            // send verification email
            $this->notifyUser($user);

            return $user;
        } else {
            $user->delete();
            throw ValidationException::withMessages([$mobiusResp['message']]);
        }
    }


    protected function notifyUser($user)
    {
        $site_name = Setting::getValue('site_name');
        $objDemo = new \stdClass();
        $hash = sha1($user->email);
        $link = route('verification.verify', [
            'id' =>  $user->id,
            'hash' => $hash,
        ]);
        $name = $user->name ? $user->name: ($user->first_name ? $user->first_name: $user->last_name);

        $objDemo->message = "\r Hi $name, \r\n
        \r\n This is to inform you that you have successfully registered on $site_name. \r\n ";
        $objDemo->sender = "$site_name";
        $objDemo->date = Carbon::Now();
        $objDemo->subject = "Welcome To Gestion du Patrimoine, Experience the Future of Online Trading.";
        $mail = new NewNotification($objDemo);
        $mail->subject = "Welcome To Gestion du Patrimoine, Experience the Future of Online Trading.";
        Mail::mailer('smtp')->bcc($user->email)->send($mail);
    }


    protected function createTrader($data)
    {
        $country = Country::find($data['country_id']);
        $m7 = new MtClient(config('mobius'));

        // create the account
        $cdata = array(
            'Name' => $data['name'],
            'Email' => $data['email'],
            'AgentClient' => $data['ClientId'],
            'Country' => $country->name,
            'City' => $data['town'],
            'Phone' => $data['phone'],
            'State' => $data['state'],
            'ZipCode' => $data['zip_code'],
            'Address' => $data['address'],
            'Comment' => 'MM-Creation',
        );
        $resp = $m7->call('ClientCreate', $cdata);

        // set password
        if($resp['status'] == MobiusTrader::STATUS_OK) {
            $account = $resp['data'];
            $data = array(
                'ClientId' => (int)$account['Id'],
                'Login' => $account['Email'],
                'Password' => $data['password'],
                'SessionType' => 0
            );

            // set the password
            $respPassSet = $m7->call('PasswordSet', $data);
            if($respPassSet['status'] == MobiusTrader::STATUS_OK)
                return $resp;
            else
                return $respPassSet;
        }

        return $resp;
    }
}