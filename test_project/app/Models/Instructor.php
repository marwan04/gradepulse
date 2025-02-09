<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Instructor extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'Instructor';
    protected $fillable = [
        'InstructorID',
        'name',
        'email',
        'password',
        'phone',
        'RoleID',
    ];
    protected $primaryKey = 'InstructorID';

    public $timestamps = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Automatically hash the password when setting it.
     *
     * @param string $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Define a relationship with the Role model (if applicable).
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'RoleID');
    }
}