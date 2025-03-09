<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    /**
     * ✅ Define the database table name
     * Ensures Laravel correctly maps the model to the `Section` table.
     */
    protected $table = 'Section';

    /**
     * ✅ Set the primary key field
     * Since the primary key is not the default 'id', we explicitly define it.
     */
    protected $primaryKey = 'SectionID';

    /**
     * ✅ Disable timestamps
     * If the `Section` table does not have `created_at` and `updated_at`, we disable timestamps.
     */
    public $timestamps = false;

    /**
     * ✅ Mass Assignable Attributes
     * Specifies which attributes can be mass assigned using `Section::create([...])`
     */
    protected $fillable = [
        'Semester',     // Academic semester (e.g., "Fall 2024")
        'Year',         // Year of the section
        'CourseID',     // Foreign key linking to the Course model
        'InstructorID'  // Foreign key linking to the Instructor model
    ];

    /**
     * ✅ Relationship: Section → Course (Many-to-One)
     * Each section belongs to a specific course.
     * - `CourseID` is the foreign key in the `Section` table.
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'CourseID');
    }

    /**
     * ✅ Relationship: Section → Instructor (Many-to-One)
     * Each section is assigned to a specific instructor.
     * - `InstructorID` is the foreign key in the `Section` table.
     */
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'InstructorID');
    }

    /**
     * ✅ Relationship: Section → Enrollments (One-to-Many)
     * A section can have multiple student enrollments.
     * - `SectionID` is the foreign key in the `Enrollment` table.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'SectionID');
    }
}

