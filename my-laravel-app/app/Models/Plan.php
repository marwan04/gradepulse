<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    /**
     * ✅ Define the database table name
     * Ensures Laravel correctly maps the model to the `Plan` table.
     */
    protected $table = 'Plan';

    /**
     * ✅ Set the primary key field
     * Since the primary key is not the default 'id', we explicitly define it.
     */
    protected $primaryKey = 'PlanID';

    /**
     * ✅ Disable timestamps
     * If the `Plan` table does not have `created_at` and `updated_at`, we disable timestamps.
     */
    public $timestamps = false;

    /**
     * ✅ Mass Assignable Attributes
     * Specifies which attributes can be mass assigned using `Plan::create([...])`
     */
    protected $fillable = [
        'PlanName',         // Name of the academic plan
        'RequiredCredits',  // Number of credits required to complete the plan
    ];

    /**
     * ✅ Relationship: Plan → Students (One-to-Many)
     * A plan can be associated with multiple students.
     * - `PlanID` is the foreign key in the `Student` table.
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'PlanID');
    }
}

