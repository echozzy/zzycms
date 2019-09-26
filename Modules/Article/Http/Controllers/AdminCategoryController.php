<?php

namespace Modules\Article\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('article::admin_category.index');
    }

    //获取分类列表
    public function list(Request $request){
        $menus = \ZyModule::getMenus();
        return json_encode($menus);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('article::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('article::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('article::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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

    //分类排序
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
