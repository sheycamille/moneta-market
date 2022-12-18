<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:mrole-list|mrole-create|mrole-edit|mrole-delete', ['only' => ['index']]);
        $this->middleware('permission:mrole-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:mrole-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mrole-delete', ['only' => ['destroy']]);
    }


    //Return Roles route--------------------------------------------------------------------------------
    public function index()
    {
        $permission = Permission::get();
        $roles = Role::get();
        return view('admin.roles.index')->with(array(
            'title' => 'Add new role',
            'roles' => $roles,
            'permission' => $permission
        ));
    }


    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.create', compact('permission'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'admin']);
        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('manageroles')
            ->with('success', 'Role created successfully');
    }


    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('admin.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }


    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        if (!$role) return redirect()->back();

        $role->name = $request->name;
        $role->syncPermissions($request->permissions);
        $role->save();

        return redirect()->route('manageroles')->with('success', 'Role updated successfully');
    }


    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('manageroles')->with('success', 'Role deleted successfully');
    }
}