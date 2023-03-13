<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'students';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'roll_no',
        'reg_no',
        'student_batch',
        'current_semester',
        'section',
        'student_initial',
        'admitted_course',
        'admitted_mode',
        'qualifying_examination',
        'later_entry_(y/n)',
        'day_scholar/hosteler',
        'gender',
        'father_name',
        'mother_name',
        'guardian_name_(if_applicable)',
        'occupation_of_parent_or_guardian',
        'annual_income',
        'communication_address(permanent)',
        'communication_address',
        'city/town/village_name',
        'district',
        'pincode',
        'state',
        'father_phone_no',
        'mother_phone_no',
        'student_phone_no',
        'student_email_id',
        'parent_email_id',
        'date_of_birth',
        'nationality',
        'religion',
        'community',
        'aadhar_card_no',
        'blood_group',
        'mother_tongue',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function enroll_master()
    {
        return $this->belongsTo(CourseEnrollMaster::class, 'enroll_master_id');
    }
}
