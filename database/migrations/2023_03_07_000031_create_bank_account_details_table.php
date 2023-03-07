<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('bank_account_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account_type')->nullable();
            $table->string('account_no')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('bank_location')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
