<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function role(){
        $permissions = Permission::all();
        $roles = Role::all();
        $users = User::all();
        return view('admin.role.role',[
            'permissions'=>$permissions,
            'roles'=>$roles,
            'users'=>$users,
        ]);
    }
    function permission_store(Request $request){
        Permission::create(['name' => $request->permission_name]);
        return back()->with('saved', 'Permission Saved!');
    }
    function role_store(Request $request){
        $role = Role::create(['name' => $request->role]);
        $role->givePermissionTo($request->permission);
        return back()->with('role', 'Permission Assigned!');
    }
    function assign_role(Request $request){
        $user = User::find($request->user_id);
        $user->assignRole($request->role);
        return back()->with('assigned', 'User Assigned!');
    }
    function role_delete($id){
        $role = Role::find($id);
        $role->syncPermissions([]);
        Role::find($id)->delete();
        return back()->with('deleted', 'Role has deleted!');
    }
    function remove_role_user($id){
        $user = User::find($id);
        $user->syncRoles([]);
        return back()->with('remove', 'Role has removed!');
    }
}
