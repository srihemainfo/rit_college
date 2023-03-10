<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffSalariesTable extends Migration
{
    public function up()
    {
        Schema::create('staff_salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('staff_code')->nullable();
            $table->string('biometric')->nullable();
            $table->string('staff_name')->nullable();
            $table->string('department')->nullable();
            $table->string('designation')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->string('total_working_days')->nullable();
            $table->string('loss_of_pay')->nullable();
            $table->string('no_of_day_payable')->nullable();
            $table->string('actual_gross_salary')->nullable();
            $table->string('basic_pay')->nullable();
            $table->string('agp')->nullable();
            $table->string('da')->nullable();
            $table->string('hra')->nullable();
            $table->string('arrears')->nullable();
            $table->string('special_pay')->nullable();
            $table->string('other_allowances')->nullable();
            $table->string('appraisal_based_increment')->nullable();
            $table->string('phd_allowance')->nullable();
            $table->string('gross_salary')->nullable();
            $table->string('it')->nullable();
            $table->string('pt')->nullable();
            $table->string('salary_advance')->nullable();
            $table->string('other_deduction')->nullable();
            $table->string('esi')->nullable();
            $table->string('epf')->nullable();
            $table->string('total_deductions')->nullable();
            $table->string('net_salary')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
