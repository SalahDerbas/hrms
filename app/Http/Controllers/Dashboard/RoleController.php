<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;


class RoleController extends Controller
{

//    function __construct()
//
//    {
//
//        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
//
//        $this->middleware('permission:role-create', ['only' => ['create','store']]);
//
//        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
//
//        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
//
//    }

    public function index(Request $request)

    {

        $roles = Role::orderBy('id','DESC')->paginate(5);
        $permission = Permission::get();

        return view('Pages.Roles.index',compact('roles' , 'permission')) ->with('i', ($request->input('page', 1) - 1) * 5);

    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('Roles.index')->with('success','Role created successfully');
    }


    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('roles.show',compact('role','rolePermissions'));

    }


    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('roles.edit',compact('role','permission','rolePermissions'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($request->id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('Roles.index')->with('success','Role updated successfully');

    }

    public function destroy(Request $request)
    {
        DB::table("roles")->where('id',$request->id)->delete();
        return redirect()->route('Roles.index')->with('success','Role deleted successfully');

    }

    public function permissions ()
    {
        $permissions = Permission::get();
        return view ('Pages.Permissions.index' , compact('permissions'));
    }
}
