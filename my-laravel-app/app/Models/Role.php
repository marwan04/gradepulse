<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * ✅ Define the database table name
     * Ensures Laravel correctly maps the model to the `Role` table.
     */
    protected $table = 'Role';  // Ensure the table name matches the MySQL table exactly

    /**
     * ✅ Set the primary key field
     * Since the primary key is not the default 'id', we explicitly define it.
     */
    protected $primaryKey = 'RoleID';

    /**
     * ✅ Mass Assignable Attributes
     * Specifies which attributes can be mass assigned using `Role::create([...])`
     */
    protected $fillable = ['RoleName']; // The name of the role (e.g., "Admin", "Instructor")

    /**
     * ✅ Disable timestamps
     * If the `Role` table does not have `created_at` and `updated_at`, we disable timestamps.
     */
    public $timestamps = false;

    /**
     * ✅ Relationship: Role → Instructors (One-to-Many)
     * A role can be assigned to multiple instructors.
     * - `RoleID` is the foreign key in the `Instructor` table.
     */
    public function instructors()
    {
        return $this->hasMany(Instructor::class, 'RoleID', 'RoleID');
    }
}

