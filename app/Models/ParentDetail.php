<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParentDetail extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'parent_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'father_name',
        'father_mobile_no',
        'fathers_occupation',
        'mother_name',
        'mother_mobile_no',
        'mothers_occupation',
        'guardian_name',
        'guardian_mobile_no',
        'gaurdian_occupation',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
