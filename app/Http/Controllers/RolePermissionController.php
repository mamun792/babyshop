<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as ModelsRole;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = ModelsRole::with('permissions')->get();
        return view('web.dashboard.role.index', compact('roles'));
    }
    public function create()
    {
        $permissions = Permission::all();
        $roles = ModelsRole::all();
        return view('web.dashboard.role.create', compact('permissions', 'roles'));
    }

    public function edit($role)
    {
        $roles = ModelsRole::with('permissions')->findOrFail($role);
        $id = $roles->id;
        $roleName = $roles->name;
        $permissions = Permission::all();
        $rolePermissions =  $roles['permissions']->pluck('id')->toArray();

        //  foreach ($roles as $value) {
        //     return $value->name;
        //  }
        // return print_r($roles->permissions);

        return view('web.dashboard.role.edit', compact('roleName', 'permissions', 'rolePermissions', 'id'));
    }
    public function store(Request $request)
    {
        // Create a role
        // return $request->all();

       

        // $role = ModelsRole::create(['name' => $request->name]);

        // // Assign permissions by their IDs
        // $role->givePermissionTo($request->permissions);

        // $roles = ModelsRole::with('permissions')->get();
        // return redirect()->route('dashboard.role.index', compact('roles'));

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        DB::beginTransaction(); 

        try {
           
            $role = ModelsRole::create(['name' => $validated['name']]);


            if (!empty($validated['permissions'])) {
                $role->syncPermissions($validated['permissions']);
            }

            DB::commit(); 

           toastr()->success('Role created successfully.');
            return redirect()->route('dashboard.roles.index')->with('success', 'Role created successfully.');
        } catch (\Exception $e) {
            DB::rollBack(); 

            toastr()->error('Failed to create role: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create role: ' . $e->getMessage());
        }
    

    }

    public function update(Request $request, $role)
    {
        // Find the role by its ID
        $roleObj = ModelsRole::findOrFail($role);

        // Update the role's name
        $roleObj->update([
            'name' => $request->name
        ]);

        // Sync the role's permissions
        $roleObj->syncPermissions($request->permissions);
        return back();
    }

    public function destroy($id)
    {
        // Find the role by ID
        $role = ModelsRole::findOrFail($id);

        // Detach the role from all permissions
        $role->permissions()->detach();

        // Delete the role
        $role->delete();
        return back();
    }

    function permissionUpdate(Request $request, $id)
    {
        $permission = Permission::find($id);
        // Update the permission's name
        $permission->update(['name' => $request->name]);


        return response(true, 200);
    }


    function permissionDelete($id)
    {
        $permission = Permission::find($id);
        $permission->roles()->detach();
        $permission->delete();

        return response(true, 200);
    }

    public function allUsers()
    {
        $usersWithRoles = User::with('roles')->get();

        // foreach ($usersWithRoles as $user) {
        //     echo "User: " . $user->name . " has the following roles: ";

        //     // Retrieve role names and convert to a comma-separated string
        //     $roleNames = $user->roles->pluck('name')->implode(', ');

        //     echo $roleNames . "\n";
        // }


        return view('web.dashboard.role.allUsers', compact('usersWithRoles'));
    }

    public function profileView()
    {
        $user = auth()->user();
        //  return  $user->name;
        return view('web.dashboard.role.profileView', compact('user'));
    }
}
