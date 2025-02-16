<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $table = 'Enrollment';
    protected $primaryKey = 'EnrollmentID';
    public $timestamps = false;

    protected $fillable = [
        'NumericMark',
        'alphaMark',
        'Completed',
        'StudentID',
        'SectionID'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentID');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'SectionID');
    }
}

