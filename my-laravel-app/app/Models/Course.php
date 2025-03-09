<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * ✅ Define the database table name
     * Ensure that Laravel uses the correct table in the database.
     */
    protected $table = 'Course'; 

    /**
     * ✅ Set the primary key field
     * Since the primary key is not 'id', we explicitly define it.
     */
    protected $primaryKey = 'CourseID';

    /**
     * ✅ Disable timestamps
     * If the `Course` table does not have `created_at` and `updated_at`, we disable timestamps.
     */
    public $timestamps = false; 

    /**
     * ✅ Define primary key properties
     * - `$incrementing = false`: The primary key is NOT auto-incrementing.
     * - `$keyType = 'int'`: The primary key is an integer.
     */
    public $incrementing = false;
    protected $keyType = 'int';

    /**
     * ✅ Mass Assignable Attributes
     * Specifies which attributes can be mass assigned using `Course::create([...])`
     */
    protected $fillable = [
        'CourseName',
        'Credits'
    ];

    /**
     * ✅ Relationship: Course → Sections (One-to-Many)
     * A course can have multiple sections.
     * The foreign key `CourseID` in the `Section` table maps to `CourseID` in this table.
     */
    public function sections()
    {
        return $this->hasMany(Section::class, 'CourseID', 'CourseID');
    }

    /**
     * ✅ Relationship: Course → Plans (Many-to-Many)
     * A course can belong to multiple plans via the `PlanCourse` pivot table.
     * - `CourseID` is the foreign key in `PlanCourse` for the `Course` model.
     * - `PlanID` is the foreign key in `PlanCourse` for the `Plan` model.
     */
    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'PlanCourse', 'CourseID', 'PlanID');
    }
}

