<?php

namespace Modules\Article\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Article\Http\Requests\ArticleRequest;
use Modules\Article\Model\Article;
use Modules\Article\Model\ArticleCategory;

class AdminArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('article::admin_article.index');
    }

    //获取列表
    public function list(Request $request, Article $article)
    {
        $article = $article->getList($request);
        return json_encode($article);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(ArticleCategory $article_category)
    {
        $categorys = $article_category->getAll();
        return view('article::admin_article.create',compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(ArticleRequest $request,Article $article)
    {
        $data = $article->moreHandle($request);
        $article->fill($data);
        $article->save();
        return redirect('/article/admin_article')->with('success', '文章添加成功');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Article $article)
    {
        $article_category = new ArticleCategory;
        $categorys = $article_category->getAll($article->articleCategory,true);
        return view('article::admin_article.edit',compact('article','categorys'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(ArticleRequest $request,Article $article)
    {
        $data = $article->moreHandle($request);
        $article->fill($data);
        $article->save();
        return redirect('/article/admin_article')->with('success', '文章更新成功');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect('/article/admin_article')->with('success', '文章删除成功');
    }
}
