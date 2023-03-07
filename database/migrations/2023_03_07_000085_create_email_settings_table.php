<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('email_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('host_name')->nullable();
            $table->string('user_name')->nullable();
            $table->string('password')->nullable();
            $table->string('smtp_secure')->nullable();
            $table->string('port_no')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('cc')->nullable();
            $table->string('bcc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
