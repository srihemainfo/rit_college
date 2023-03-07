<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentGatewaysTable extends Migration
{
    public function up()
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('gateway_type')->nullable();
            $table->string('prefix')->nullable();
            $table->string('url')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('merchand')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
