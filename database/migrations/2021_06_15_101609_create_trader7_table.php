<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrader7Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trader7s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('client_id')->nullable();
            $table->longText('number')->nullable();
            $table->longText('name')->nullable();
            $table->string('type')->nullable();
            $table->string('balance')->nullable();
            $table->string('bonus')->nullable();
            $table->string('credit')->nullable();
            $table->string('currency')->nullable()->default('USD');
            $table->string('currency_id')->nullable();
            $table->string('leverage')->nullable();
            $table->string('swap_type')->nullable();
            $table->string('options')->nullable();
            $table->string('client_sort')->nullable();
            $table->string('status')->nullable()->default('active');
            $table->datetime('is_cheater')->nullable();
            $table->datetime('loyalty')->nullable();
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
        Schema::dropIfExists('trader7s');
    }
}
