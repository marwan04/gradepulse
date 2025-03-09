<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProgress extends Model
{
    use HasFactory;

    /**
     * ✅ Define the database table name
     * Ensures Laravel correctly maps the model to the `StudentProgress` table.
     */
    protected $table = 'StudentProgress';

    /**
     * ✅ Set the primary key field
     * Since the primary key is not the default 'id', we explicitly define it.
     */
    protected $primaryKey = 'StudentID';

    /**
     * ✅ Disable timestamps
     * If the `StudentProgress` table does not have `created_at` and `updated_at`, we disable timestamps.
     */
    public $timestamps = false;

    /**
     * ✅ Mass Assignable Attributes
     * Specifies which attributes can be mass assigned using `StudentProgress::create([...])`
     */
    protected $fillable = [
        'StudentID',           // Unique student identifier
        'TotalCreditsEarned',  // Total credits the student has earned
        'GraduationStatus',    // Boolean flag indicating graduation status
        'PlanID'               // Foreign key linking to the Plan model
    ];

    /**
     * ✅ Relationship: StudentProgress → Student (Many-to-One)
     * Each student progress record belongs to a specific student.
     * - `StudentID` is the foreign key in the `StudentProgress` table.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentID');
    }

    /**
     * ✅ Relationship: StudentProgress → Plan (Many-to-One)
     * Each student progress record is linked to an academic plan.
     * - `PlanID` is the foreign key in the `StudentProgress` table.
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'PlanID');
    }
}

