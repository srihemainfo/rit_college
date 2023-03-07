<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClassRoomsTable extends Migration
{
    public function up()
    {
        Schema::table('class_rooms', function (Blueprint $table) {
            $table->unsignedBigInteger('block_id')->nullable();
            $table->foreign('block_id', 'block_fk_8139439')->references('id')->on('college_blocks');
        });
    }
}
