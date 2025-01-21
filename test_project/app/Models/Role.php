<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'Role';
    protected $fillable = [
        'RoleName',
    ];
    protected $primaryKey = 'RoleID';

    public $timestamps = false;
    /**
     * Define the relationship with the Instructor model.
     */
    public function instructors()
    {
        return $this->hasMany(Instructor::class, 'RoleID');
    }
}

