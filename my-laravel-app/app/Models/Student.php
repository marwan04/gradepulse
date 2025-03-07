<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'Student';
    protected $fillable = [
        'StudentID',
        'name',
        'email',
        'password',
        'PlanID',
    ];
    protected $primaryKey = 'StudentID';

    public $timestamps = false;
    

    /**
     * Define a relationship with the Plan model (if applicable).
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'PlanID');
    }
}
