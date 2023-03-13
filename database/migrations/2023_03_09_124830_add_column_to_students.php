<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('roll_no');
            $table->string('register_no');
            $table->string('student_batch');
            $table->string('current_semester');
            $table->string('section');
            $table->string('student_name');
            $table->string('student_initial');
            $table->string('admitted_course');
            $table->string('admitted_mode');
            $table->string('qualifying_examination');
            $table->string('later_entry_(y/n)');
            $table->string('day_scholar/hosteler');
            $table->string('gender');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('guardian_name_(if_applicable)');
            $table->string('occupation_of_parent_or_guardian');
            $table->string('annual_income');
            $table->string('communication_address(permanent)');


            $table->string('communication_address');
            $table->string('city/town/village_name');
            $table->string('district');
            $table->string('pincode');
            $table->string('state');
            $table->string('father_phone_no');
            $table->string('mother_phone_no');
            $table->string('student_phone_no');
            $table->string('student_email_id');
            $table->string('parent_email_id');
            $table->string('date_of_birth');
            $table->string('nationality');
            $table->string('religion');
            $table->string('community');
            $table->string('aadhar_card_no');
            $table->string('blood_group');
            $table->string('mother_tongue');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
         $table->string('roll_no');
$table->string('register_no');
$table->string('student_batch');
$table->string('current_semester');
$table->string('section');
$table->string('student_name');
$table->string('student_initial');
$table->string('admitted_course');
$table->string('admitted_mode');
$table->string('qualifying_examination');
$table->string('later_entry_(y/n)');
$table->string('day_scholar/hosteler');
$table->string('gender');
$table->string('father_name');
$table->string('mother_name');
$table->string('guardian_name_(if_applicable)');
$table->string('occupation_of_parent_or_guardian');
$table->string('annual_income');
$table->string('communication_address(permanent)');


$table->string('communication_address');
$table->string('city/town/village_name');
$table->string('district');
$table->string('pincode');
$table->string('state');
$table->string('father_phone_no');
$table->string('mother_phone_no');
$table->string('student_phone_no');
$table->string('student_email_id');
$table->string('parent_email_id');
$table->string('date_of_birth');
$table->string('nationality');
$table->string('religion');
$table->string('community');
$table->string('aadhar_card_no');
$table->string('blood_group');
$table->string('mother_tongue');

        });
    }
};
