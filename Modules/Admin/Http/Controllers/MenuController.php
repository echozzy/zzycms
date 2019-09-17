<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Admin\Http\Requests\MenuRequest;
use Modules\Admin\Model\AdminMenu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $menus = \ZyModule::getMenus();
        return view('admin::menu.index',compact('menus'));
    }

    //获取菜单列表
    public function list(Request $request){
        $menus = \ZyModule::getMenus();
        return json_encode($menus);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(MenuRequest $request)
    {
        $data = [
            'title' => $request->title,
            'p_id' => $request->p_id,
            'icon' => $request->icon,
            'permission' => $request->permission,
            'url' => $request->url
        ];
        $status = AdminMenu::create($data);
        if($status){
            Cache::forget('admin.menus');
        }

        session()->flash('success','菜单添加成功');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        dd($request->all());
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

    //获取菜单
    public function getMenu(Request $request){
        $id = $request->id;
        $menu = AdminMenu::where('id',$id)->first();
        return json_encode($menu);
    }

    //菜单排序
    public function sort(Request $request){
        $list_order = $request->val;
        $id = $request->id;
        $status = AdminMenu::where('id',$id)->update(['list_order' => $list_order]);
        if($status){
            Cache::forget('admin.menus');
            $res = array('msg' => '排序更新成功','status'=>true);
        }else{
            $res = array('msg' => '排序更新失败','status'=>false);
        }
        return json_encode($res);
    }
}
