<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * ✅ Display all roles.
     * - Retrieves all roles from the database and passes them to the view.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * ✅ Show the form for creating a new role.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * ✅ Store a new role in the database.
     * - Validates input and ensures role name uniqueness.
     */
    public function store(Request $request)
    {
        $request->validate([
            'RoleName' => 'required|string|max:255|unique:Role,RoleName', // Ensure unique role name
        ]);

        Role::create([
            'RoleName' => $request->RoleName,
        ]);

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully!');
    }

    /**
     * ✅ Show the form for editing an existing role.
     * - Ensures the requested role exists before displaying the form.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * ✅ Update an existing role in the database.
     * - Validates input before updating the role details.
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
     * ✅ Delete a role from the database.
     * - Ensures the role is deleted and redirects with a success message.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully!');
    }
}

