<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

use App\Libraries\MobiusTrader;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'first_name', 'last_name', 'email', 'phone', 'country_id', 'password', 'phone_password', 'address', 'town', 'state', 'dashboard_style', 'account_type', 'zip_code', 'status', 'token_2fa_expiry', 'bank_name', 'account_name', 'account_number', 'swift_code', 'bank_address', 'btc_address', 'eth_address', 'xrp_address', 'usdt_address', 'usdc_address', 'bch_address', 'bnb_address', 'interac', 'paypal_email'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function dp()
    {
        return $this->hasMany('App\Models\Deposit', 'user');
    }


    public function ftd()
    {
        return $this->dp()->where('status', 'Processed')->first();
    }


    public function wd()
    {
        return $this->hasMany('App\Models\Withdrawal', 'user');
    }


    public function tuser()
    {
        return $this->belongsTo('App\Models\Admin', 'assign_to');
    }

    /**
     * A user has a referrer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referrer()
    {
        return $this->belongsTo(User::class, 'ref_by', 'id');
    }


    /**
     * A user has many referrals.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'ref_by', 'id');
    }


    public function accounttype()
    {
        return $this->belongsTo('App\Models\AccountType', 'account_type');
    }


    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }


    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }


    public function town()
    {
        return $this->belongsTo('App\Models\City', 'town_id');
    }


    public function accounts()
    {
        $accounts = Trader7::where('client_id', $this->id)->where('type', MobiusTrader::ACCOUNT_NUMBER_TYPE_REAL)->get();
        return $accounts;
    }


    public function demoaccounts()
    {
        $accounts = Trader7::where('client_id', $this->id)->where('type', MobiusTrader::ACCOUNT_NUMBER_TYPE_DEMO)->get();
        return $accounts;
    }


    public function totalBalance()
    {
        $accounts = $this->accounts();
        $total = 0;
        foreach ($accounts as $acc) {
            $total += $acc->balance;
        }
        return $total;
    }


    public function totalDeposited()
    {
        $total_deposited = DB::table('deposits')->select(DB::raw("SUM(amount) as total"))->where('user', $this->id)->where('status', 'Processed')->get()->toArray()[0]->total;
        return $total_deposited - $this->totalBonus() - $this->totalCredit();
    }


    public function totalBonus()
    {
        $accounts = $this->accounts();
        $total = 0;
        foreach ($accounts as $acc) {
            $total += $acc->bonus;
        }
        return $total + $this->signup_bonus + $this->ref_bonus;
    }


    public function totalCredit()
    {
        $accounts = $this->accounts();
        $total = 0;
        foreach ($accounts as $acc) {
            $total += $acc->credit;
        }
        return $total;
    }
}