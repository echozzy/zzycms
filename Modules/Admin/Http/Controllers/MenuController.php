<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Admin\Http\Requests\MenuRequest;
use Modules\Admin\Model\AdminMenu;
use Zzy\Arr\Arr;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $menus = \ZyModule::getMenusLevel();
        return view('admin::menu.index',compact('menus'));
    }

    //获取菜单列表
    public function list(Request $request){
        $menus = \ZyModule::getMenusLevel();
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
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(MenuRequest $request, AdminMenu $menu)
    {
        $data = [
            'title' => $request->title,
            'p_id' => $request->p_id,
            'icon' => $request->icon,
            'permission' => $request->permission,
            'url' => $request->url
        ];
        $status = $menu->update($data);
        if($status){
            Cache::forget('admin.menus');
        }
        session()->flash('success','菜单编辑成功');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $children = AdminMenu::where('p_id',$id)->first();
        if(!$children){
            AdminMenu::destroy($id);
            Cache::forget('admin.menus');
            session()->flash('success','菜单删除成功');
            return back();
        }else{
            session()->flash('error','该菜单有下级，请先删除下级菜单');
            return back();
        }
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
