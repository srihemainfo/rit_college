<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStaffTransferInfosTable extends Migration
{
    public function up()
    {
        Schema::table('staff_transfer_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('enroll_master_id')->nullable();
            $table->foreign('enroll_master_id', 'enroll_master_fk_8139776')->references('id')->on('course_enroll_masters');
        });
    }
}
