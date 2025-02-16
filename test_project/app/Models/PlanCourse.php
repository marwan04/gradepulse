<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanCourse extends Model
{
    use HasFactory;

    protected $table = 'PlanCourse';
    public $timestamps = false;

    protected $fillable = [
        'PlanID',
        'CourseID'
    ];
}

