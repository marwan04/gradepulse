<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * عرض قائمة الأدوار.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * عرض نموذج إنشاء دور جديد.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * تخزين دور جديد في قاعدة البيانات.
     */
public function store(Request $request)
{
    // ✅ تعديل اسم الجدول في التحقق من صحة البيانات
    $request->validate([
        'RoleName' => 'required|string|max:255|unique:Role,RoleName',
    ]);

    // ✅ حفظ الدور الجديد
    Role::create([
        'RoleName' => $request->RoleName,
    ]);

    return redirect()->route('admin.roles.index')->with('success', 'Role created successfully!');
}


    /**
     * عرض نموذج تعديل دور موجود.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * تحديث بيانات دور معين.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'RoleName' => 'required|string|max:255',
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'RoleName' => $request->RoleName,
        ]);

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully!');
    }

    /**
     * حذف دور معين.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully!');
    }
}

