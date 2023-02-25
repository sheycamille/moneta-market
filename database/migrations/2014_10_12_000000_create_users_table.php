<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('first_name');
            $table->text('last_name');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->string('phone_password')->nullable();
            $table->string('account_type')->nullable();
            $table->date('dob')->nullable();

            $table->text('address')->nullable();
            $table->string('country_id')->nullable();
            $table->text('town')->nullable();
            $table->text('state')->nullable();
            $table->text('zip_code')->nullable();

            $table->string('dashboard_style')->default('dark');
            $table->string('enable_2fa')->default('no');
            $table->string('bank_name')->nullable();
            $table->string('bank_address')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('acnt_type_active')->nullable();
            $table->string('btc_address')->nullable();
            $table->string('eth_address')->nullable();
            $table->string('ltc_address')->nullable();
            $table->string('bch_address')->nullable();
            $table->string('bnb_address')->nullable();
            $table->string('usdt_address')->nullable();
            $table->string('usdc_address')->nullable();
            $table->string('xrp_address')->nullable();
            $table->string('interac')->nullable();
            $table->string('paypal_email')->nullable();

            $table->integer('account_bal')->default('0');
            $table->integer('bonus')->default('0');
            $table->integer('ref_bonus')->default('0');
            $table->integer('signup_bonus')->nullable();
            $table->string('auto_trade')->nullable();
            $table->integer('bonus_released')->default('0');
            $table->string('ref_by')->nullable();
            $table->string('ref_link')->nullable();


            $table->string('id_card')->nullable();
            $table->string('id_card_back')->nullable();
            $table->text('address_document')->nullable();
            $table->string('passport')->nullable();
            $table->datetime('docs_uploaded_date')->nullable();
            $table->datetime('docs_verified_date')->nullable();
            $table->string('account_verify')->nullable();

            $table->datetime('entered_at')->nullable();
            $table->datetime('activated_at')->nullable();
            $table->datetime('last_growth')->nullable();
            $table->string('status')->default('blocked');
            $table->string('trade_mode')->nullable();
            $table->string('act_session')->nullable();

            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->text('token_2fa')->nullable();
            $table->text('token_2fa_expiry')->nullable();

            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}