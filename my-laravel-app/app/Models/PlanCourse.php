<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanCourse extends Model
{
    use HasFactory;

    /**
     * ✅ Define the database table name
     * Ensures Laravel correctly maps this model to the `PlanCourse` table.
     */
    protected $table = 'PlanCourse';

    /**
     * ✅ Disable timestamps
     * The `PlanCourse` table does not need `created_at` or `updated_at` fields.
     */
    public $timestamps = false;

    /**
     * ✅ Mass Assignable Attributes
     * Specifies which attributes can be mass assigned using `PlanCourse::create([...])`
     */
    protected $fillable = [
        'PlanID',    // Foreign key linking to the `Plan` table
        'CourseID'   // Foreign key linking to the `Course` table
    ];
}

