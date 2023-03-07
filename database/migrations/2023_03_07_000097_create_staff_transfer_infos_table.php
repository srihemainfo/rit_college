<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTransferInfosTable extends Migration
{
    public function up()
    {
        Schema::create('staff_transfer_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('period')->nullable();
            $table->string('from_user')->nullable();
            $table->string('to_user')->nullable();
            $table->string('transfer_date')->nullable();
            $table->string('approved_by_user')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
