<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\AdminUserRequest;
use Modules\Admin\Model\AdminUsers;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $admin_users = AdminUsers::get();
        return view('admin::admin_user.index',compact('admin_users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin::admin_user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(AdminUserRequest $request)
    {
        $data = [
            'user_name' => $request->user_name,
            'password' => bcrypt($request->password),
            'nick_name' => $request->nick_name,
            'remember_token' => str_random(10)
        ];
        $admin_user = AdminUsers::create($data);

        $admin_user->assignRole($request->role_id);
        
        return redirect('/admin/adminUser')->with('success', '管理员添加成功');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $admin_user = AdminUsers::find($id);
        $roles = Role::get();
        return view('admin::admin_user.edit',compact('admin_user','roles'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(AdminUserRequest $request, AdminUsers $adminUser)
    {
        $data = [
            'user_name' => $request->user_name,
            'nick_name' => $request->nick_name,
        ];
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $adminUser->update($data);
        $adminUser->syncRoles($request->role_id);
        return redirect('/admin/adminUser')->with('success', '管理员编辑成功');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(AdminUsers $adminUser)
    {
        $role_name = $adminUser->getRoleNames();
        $adminUser->removeRole($role_name[0]);
        $adminUser->delete();
        session()->flash('success','管理员删除成功');
        return back();
    }
}
