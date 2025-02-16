<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'Course';
    protected $primaryKey = 'CourseID';
    public $timestamps = false;

    protected $fillable = [
        'CourseName',
        'Credits'
    ];

    public function sections()
    {
        return $this->hasMany(Section::class, 'CourseID');
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'PlanCourse', 'CourseID', 'PlanID');
    }
}
