<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDocumentsTable extends Migration
{
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->unsignedBigInteger('nameofuser_id')->nullable();
            $table->foreign('nameofuser_id', 'nameofuser_fk_8129221')->references('id')->on('users');
        });
    }
}
