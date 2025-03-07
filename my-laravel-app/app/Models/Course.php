<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'Course'; // تأكد من أن اسم الجدول مطابق في قاعدة البيانات
    protected $primaryKey = 'CourseID'; // المفتاح الأساسي المخصص
    public $timestamps = false; // تعطيل الـ timestamps إذا لم تكن موجودة في الجدول

    protected $fillable = [
        'CourseName',
        'Credits'
    ];

    // العلاقة مع Section
    public function sections()
    {
        return $this->hasMany(Section::class, 'CourseID', 'CourseID');
    }

    // العلاقة مع Plan
    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'PlanCourse', 'CourseID', 'PlanID');
    }
}

