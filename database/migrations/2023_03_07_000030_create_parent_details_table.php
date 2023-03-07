<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('parent_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('father_name')->nullable();
            $table->string('father_mobile_no')->nullable();
            $table->string('fathers_occupation')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_mobile_no')->nullable();
            $table->string('mothers_occupation')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_mobile_no')->nullable();
            $table->string('gaurdian_occupation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
