<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEducationalDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('educational_details', function (Blueprint $table) {
            $table->unsignedBigInteger('education_type_id')->nullable();
            $table->foreign('education_type_id', 'education_type_fk_8123771')->references('id')->on('education_types');
            $table->unsignedBigInteger('medium_id')->nullable();
            $table->foreign('medium_id', 'medium_fk_8123772')->references('id')->on('mediumof_studieds');
        });
    }
}
