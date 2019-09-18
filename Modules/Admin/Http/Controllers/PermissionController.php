<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Admin\Http\Requests\PermissionRequest;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin::permission.index');
    }

    //获取权限列表
    public function list(Request $request){
        $permissions = \ZyModule::getPermissions();
        return json_encode($permissions);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $permissions = \ZyModule::getPermissions();
        return view('admin::permission.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(PermissionRequest $request)
    {
        $data = [
            'p_id' => $request->p_id,
            'title' => $request->title,
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ];
        $status = Permission::create($data);
        if($status){
            Cache::forget('admin.permission');
        }
        return redirect('/admin/permission')->with('success', '权限添加成功');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $permission =  Permission::find($id);
        $permissions = \ZyModule::getPermissions();
        return view('admin::permission.edit',compact('permission','permissions'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $data = [
            'p_id' => $request->p_id,
            'title' => $request->title,
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ];
        $status = $permission->update($data);
        if($status){
            Cache::forget('admin.permission');
        }
        return redirect('/admin/permission')->with('success', '权限更新成功');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $children = Permission::where('p_id',$id)->first();
        if(!$children){
            Permission::destroy($id);
            Cache::forget('admin.permission');
            session()->flash('success','权限删除成功');
            return back();
        }else{
            session()->flash('error','该权限有下级，请先删除下级权限');
            return back();
        }
    }
}
