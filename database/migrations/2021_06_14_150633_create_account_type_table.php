<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('image')->nullable();
            $table->boolean('active')->default(true);
            $table->string('cost')->nullable();
            $table->string('trading_model')->nullable()->default('STP');
            $table->string('trading_platforms')->nullable()->default('Trader7, iOs, Andriod');
            $table->boolean('account_manager')->nullable()->default(true);
            $table->double('min_trade_size')->nullable();
            $table->string('max_trade_size')->nullable();
            $table->boolean('swaps')->nullable()->default(true);
            $table->string('fx_commission')->nullable();
            $table->integer('num_fx_pairs')->nullable()->default(71);
            $table->integer('num_commodities_pairs')->nullable()->default(12);
            $table->integer('num_indices_pairs')->nullable()->default(5);
            $table->double('min_deposit')->nullable();
            $table->string('max_leverage')->nullable();
            $table->double('typical_spread')->nullable();
            $table->string('execution_type')->nullable();
            $table->string('requotes')->nullable()->default('None');
            $table->string('available_instruments')->nullable()->default('FX, Indices, Commodities, Metals, Crypto, Actions');
            $table->boolean('educational_material')->nullable()->default(true);
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
        Schema::dropIfExists('account_types');
    }
}
