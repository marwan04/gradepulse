<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Instructor extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * ✅ Define the database table name
     * Ensures Laravel uses the correct table name in MySQL.
     */
    protected $table = 'Instructor';

    /**
     * ✅ Set the primary key field
     * Since the primary key is not 'id', we explicitly define it.
     */
    protected $primaryKey = 'InstructorID';

    /**
     * ✅ Disable timestamps
     * If the `Instructor` table does not have `created_at` and `updated_at`, we disable timestamps.
     */
    public $timestamps = false;

    /**
     * ✅ Mass Assignable Attributes
     * Specifies which attributes can be mass assigned using `Instructor::create([...])`
     */
    protected $fillable = [
        'InstructorID', // Unique instructor identifier
        'name',         // Instructor's full name
        'email',        // Instructor's email address
        'password',     // Encrypted password
        'phone',        // Instructor's contact number
        'RoleID'        // Foreign key linking to the Role model
    ];

    /**
     * ✅ Hidden Attributes
     * These fields will be hidden when converting to JSON (e.g., API responses).
     */
    protected $hidden = [
        'password', 
        'remember_token'
    ];

    /**
     * ✅ Relationship: Instructor → Role (Many-to-One)
     * Each instructor is assigned a specific role.
     * - `RoleID` is the foreign key in the `Instructor` table.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'RoleID');
    }
}

