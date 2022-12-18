<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWdmethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wdmethods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->longText('logo')->nullable();
            $table->string('setting_key')->nullable();
            $table->string('exchange_symbol')->nullable();
            $table->longText('country_ids')->nullable();
            $table->bigInteger('minimum')->nullable();
            $table->bigInteger('maximum')->nullable();
            $table->string('charges_fixed')->nullable();
            $table->string('charges_percentage')->nullable();
            $table->string('duration')->nullable();
            $table->string('type')->nullable();
            $table->text('details')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('wdmethods');
    }
}
