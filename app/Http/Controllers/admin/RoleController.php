<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('admin.roles.index',compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'description' => 'nullable|string|max:500',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id', // Ensure permissions exist in the database
        ]);

        // Check if all permissions exist in the permissions table
        $permissions = Permission::whereIn('id', $validatedData['permissions'])->get();

        // Ensure that the permissions are valid and belong to the correct guard
        if ($permissions->isEmpty()) {
            return redirect()->back()->withErrors(['permissions' => 'Selected permissions are invalid.']);
        }

        // Create the new role
        $role = Role::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? null,
        ]);

        // Sync permissions to the role
        $role->syncPermissions($permissions);

        return redirect()->route('admin.roles.index')->with('success', 'Permission created successfully.');
    }

    public function edit($id)
    {

        $role = Role::with('permissions')->findOrFail($id);

        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,  // Exclude the current role from uniqueness check
            'description' => 'nullable|string|max:500',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id', // Ensure permissions exist in the database
        ]);

        // Find the role by ID
        $role = Role::findOrFail($id);


        $permissions = Permission::whereIn('id', $validatedData['permissions'] ?? [])->get();

        if ($permissions->isEmpty()) {
            return redirect()->back()->withErrors(['permissions' => 'Selected permissions are invalid or no permissions selected.']);
        }

        $role->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? null,
        ]);

        $role->syncPermissions($permissions);

        return redirect()->route('admin.roles.index')->with('success', 'Role updated and permissions assigned successfully.');
    }

    public function destroy($id)
    {

        $role = Role::findOrFail($id);

        if ($role->users->count() > 0) {
            return redirect()->route('admin.roles.index')->with('error', 'Role cannot be deleted because it is assigned to users.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }





}
