<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'Plan';
    protected $fillable = [
        'PlanName',
        'RequiredCredits',
    ];
    protected $primaryKey = 'PlanID';

    public $timestamps = false;

    /**
     * Define the relationship with the Student model.
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'PlanID');
    }
}
