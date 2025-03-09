<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    /**
     * ✅ Define the database table name
     * Ensures Laravel uses the correct table.
     */
    protected $table = 'Enrollment';

    /**
     * ✅ Set the primary key field
     * Since the primary key is not 'id', we explicitly define it.
     */
    protected $primaryKey = 'EnrollmentID';

    /**
     * ✅ Disable timestamps
     * If the `Enrollment` table does not have `created_at` and `updated_at`, we disable timestamps.
     */
    public $timestamps = false;

    /**
     * ✅ Mass Assignable Attributes
     * Specifies which attributes can be mass assigned using `Enrollment::create([...])`
     */
    protected $fillable = [
        'NumericMark',  // Student's numeric grade
        'AlphaMark',    // Student's alphabetical grade (A, B, C, etc.)
        'Completed',    // Boolean flag indicating if the course is completed
        'StudentID',    // Foreign key linking to the Student model
        'SectionID'     // Foreign key linking to the Section model
    ];

    /**
     * ✅ Relationship: Enrollment → Student (Many-to-One)
     * Each enrollment belongs to a single student.
     * - `StudentID` is the foreign key in the `Enrollment` table.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentID');
    }

    /**
     * ✅ Relationship: Enrollment → Section (Many-to-One)
     * Each enrollment belongs to a specific section of a course.
     * - `SectionID` is the foreign key in the `Enrollment` table.
     */
    public function section()
    {
        return $this->belongsTo(Section::class, 'SectionID');
    }
}

