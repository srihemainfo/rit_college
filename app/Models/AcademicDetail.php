<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicDetail extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'academic_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'enroll_master_number_id',
        'register_number',
        'emis_number',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function enroll_master_number()
    {
        return $this->belongsTo(CourseEnrollMaster::class, 'enroll_master_number_id');
    }
}
