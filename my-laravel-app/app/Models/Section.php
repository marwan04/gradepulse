<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'Section';
    protected $primaryKey = 'SectionID';
    public $timestamps = false;

    protected $fillable = [
        'Semester',
        'Year',
        'CourseID',
        'InstructorID'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'CourseID');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'InstructorID');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'SectionID');
    }
}

