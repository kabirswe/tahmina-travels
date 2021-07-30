<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB, DataTables;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        //  $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::get();
            return DataTables::of($roles)
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name'
        ]);

        $data = $request->all();
        $data['guard_name'] = 'web';
        Role::create($data);
        return redirect()->route('roles.create')
                        ->with('success','Role created successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissionCreate(Request $request)
    {
        if ($request->ajax()) {
            $roles = Permission::get();
            return DataTables::of($roles)
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.roles.permission-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function permissionStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
            'module' => 'required',
            'display_name' => 'required'
        ]);

        $data = $request->all();
        $data['guard_name'] = 'web';
        Permission::create($data);
        return redirect()->route('role.permission.create')
                        ->with('success','Role created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $roleSelect = Role::select('name', 'id')->get();
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view(
            'admin.roles.edit',
            compact(
                'role',
                'permissions',
                'rolePermissions',
                'roleSelect'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required'
        ]);

        $role = Role::find($id);
        // $role->name = $request->input('name');
        $role->syncPermissions($request->input('permission'));
        $role->save();
        return redirect()->route('roles.edit', $id)
            ->with('success', 'Role updated successfully');
    }
}
