<?php

namespace Modules\Article\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Article\Http\Requests\ArticleCategoryRequest;
use Modules\Article\Model\ArticleCategory;

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
    public function list(ArticleCategory $article_category)
    {
        $categorys = $article_category->getAllLevel();
        return json_encode($categorys);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(ArticleCategory $article_category)
    {
        $categorys = $article_category->getAll();
        return view('article::admin_category.create', compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(ArticleCategoryRequest $request, ArticleCategory $article_category)
    {
        $article_category->fill($request->all());
        $article_category->save();
        return redirect('/article/adminCategory')->with('success', '文章分类添加成功');
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
    public function edit(ArticleCategory $adminCategory)
    {
        $categorys = $adminCategory->getAll($adminCategory);
        return view('article::admin_category.edit', compact('categorys', 'adminCategory'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(ArticleCategoryRequest $request, ArticleCategory $adminCategory)
    {
        $adminCategory->update($request->all());
        return redirect('/article/adminCategory')->with('success', '文章分类修改成功');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(ArticleCategory $adminCategory)
    {
        if($adminCategory->hasChild()){
            return back()->with('error','该分类有下级分类,请先删除下级分类');
        }
        $adminCategory->delete();
        return redirect('/article/adminCategory')->with('success', '文章分类删除成功');
    }

    //分类排序
    public function sort(Request $request)
    {
        $list_order = $request->val;
        $id = $request->id;
        $status = ArticleCategory::where('id', $id)->update(['list_order' => $list_order]);
        if ($status) {
            $res = array('msg' => '排序更新成功', 'status' => true);
        } else {
            $res = array('msg' => '排序更新失败', 'status' => false);
        }
        return json_encode($res);
    }
}
