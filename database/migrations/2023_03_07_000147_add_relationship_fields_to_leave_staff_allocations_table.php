<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLeaveStaffAllocationsTable extends Migration
{
    public function up()
    {
        Schema::table('leave_staff_allocations', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_8139236')->references('id')->on('users');
            $table->unsignedBigInteger('academic_year_id')->nullable();
            $table->foreign('academic_year_id', 'academic_year_fk_8139237')->references('id')->on('academic_years');
        });
    }
}
