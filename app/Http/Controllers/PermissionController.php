<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(15);
        return view('permission.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:permissions',
            'description' => 'nullable|string',
            'module' => 'required|string',
        ]);

        Permission::create($validated);
        return redirect('/permissions')->with('success', 'Permission created successfully');
    }

    public function edit(Permission $permission)
    {
        return view('permission.edit', ['permission' => $permission]);
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $permission->id,
            'description' => 'nullable|string',
            'module' => 'required|string',
        ]);

        $permission->update($validated);
        return redirect('/permissions')->with('success', 'Permission updated successfully');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect('/permissions')->with('success', 'Permission deleted successfully');
    }
}
