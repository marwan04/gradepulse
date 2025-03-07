<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Instructor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'Instructor'; // ✅ تأكد من تطابق اسم الجدول مع MySQL
    protected $primaryKey = 'InstructorID'; // ✅ استخدم المفتاح الأساسي الصحيح
    public $timestamps = false; // ✅ تأكيد عدم الحاجة إلى timestamps

    protected $fillable = [
        'InstructorID',
        'name',
        'email',
        'password',
        'phone',
        'RoleID',
    ];

    protected $hidden = [
        'password', 'remember_token', // ✅ إخفاء كلمة المرور عند الإرجاع
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'RoleID');
    }
}

