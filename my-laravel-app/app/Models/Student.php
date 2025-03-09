<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    /**
     * ✅ Define the database table name
     * Ensures Laravel correctly maps the model to the `Student` table.
     */
    protected $table = 'Student';

    /**
     * ✅ Set the primary key field
     * Since the primary key is not the default 'id', we explicitly define it.
     */
    protected $primaryKey = 'StudentID';

    /**
     * ✅ Disable timestamps
     * If the `Student` table does not have `created_at` and `updated_at`, we disable timestamps.
     */
    public $timestamps = false;

    /**
     * ✅ Mass Assignable Attributes
     * Specifies which attributes can be mass assigned using `Student::create([...])`
     */
    protected $fillable = [
        'StudentID',  // Unique student identifier
        'name',       // Student's full name
        'email',      // Student's email address
        'password',   // Encrypted password
        'PlanID'      // Foreign key linking to the Plan model
    ];

    /**
     * ✅ Relationship: Student → Plan (Many-to-One)
     * Each student is enrolled in one academic plan.
     * - `PlanID` is the foreign key in the `Student` table.
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'PlanID');
    }
}

