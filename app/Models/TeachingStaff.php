<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeachingStaff extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'teaching_staffs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'subject_id',
        'enroll_master_id',
        'working_as_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'StaffCode',
        'BiometricID',
        'Gender',
        'Designation',
        'Dept',
        'Qualification',
        'DOJ',
        'DOR',
        'OtherEnggCollegeExperience',
        'TotalExperience',
        'ContactNo',
        'EmailIDOffical',
        'Religion',
        'Community',
        'PanNo',
        'PassportNo',
        'AadharNo',
        'COECode',
        'AICTE',
        'DOB',
        'HighestDegree'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function enroll_master()
    {
        return $this->belongsTo(CourseEnrollMaster::class, 'enroll_master_id');
    }

    public function working_as()
    {
        return $this->belongsTo(Role::class, 'working_as_id');
    }
}
