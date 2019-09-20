<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $roles = Role::get();
        return view('admin::role.index', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(RoleRequest $request)
    {
        Role::create(['title' => $request->title, 'name' => $request->name]);
        session()->flash('success', '角色添加成功');
        return back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update(['title' => $request->title, 'name' => $request->name]);
        session()->flash('success','角色编辑成功');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    // 角色权限
    public function permission(Role $role)
    {
        $permissions = \ZyModule::getPermissions();
        return view('admin::role.permission', compact('role', 'permissions'));
    }

    // 角色权限更新
    public function permissionStore(Request $request, Role $role)
    {
        $role->syncPermissions($request->id);
        session()->flash('success','权限设置成功');
        return back();
    }
}
