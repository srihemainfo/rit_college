<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmRequestPermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('hrm_request_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_of_hours')->nullable();
            $table->string('from_date')->nullable();
            $table->string('reason')->nullable();
            $table->string('approved_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
