<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // ✅ التأكد من أن اسم الجدول متطابق تمامًا مع اسم الجدول في MySQL
    protected $table = 'Role';  // مهم أن يكون الحرف الأول كبيرًا كما هو في MySQL

    // ✅ تحديد المفتاح الأساسي الصحيح
    protected $primaryKey = 'RoleID';

    // ✅ السماح بتعديل الحقول الضرورية
    protected $fillable = ['RoleName'];

    // ❌ تعطيل التوقيتات لأنها غير موجودة في الجدول
    public $timestamps = false;

    /**
     * علاقة بين الدور والمدربين (إذا كان هناك علاقة)
     */
    public function instructors()
    {
        return $this->hasMany(Instructor::class, 'RoleID', 'RoleID');
    }
}

