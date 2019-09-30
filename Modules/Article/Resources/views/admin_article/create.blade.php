@extends('admin::layouts.master')
@push('css')
<link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endpush
@section('content')
    @component('admin::components.main',['title'=>'添加分类'])
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a pjax href="/article/admin_article">文章列表/a></li>
            <li class="breadcrumb-item active">添加文章</li>
        @endslot
        @slot('nav')
            <li class="nav-item">
                <a pjax class="nav-link" href="/article/admin_article">文章列表</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">添加文章</a>
            </li>
        @endslot
        @slot('body')
            <form action="/article/admin_article" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">文章标题</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="title" name="title" placeholder="请输入文章标题" required
                            value="{{old('title')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="p_id" class="col-sm-2 col-form-label">文章分类</label>
                        <div class="col-sm-6">
                            <select id="p_id" name="p_id" class="form-control">
                                <option value="0">作为一级分类</option>
                                {{-- @foreach ($categorys as $item)
                                <option value="{{$item['id']}}" {{$item['_selected']?'selected':''}}>{!!$item['_cat_name']!!}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="author" class="col-sm-2 col-form-label">作者</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="author" name="author" placeholder="请输入作者" value="{{old('author')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keywords" class="col-sm-2 col-form-label">关键词</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="keywords" name="keywords" placeholder="请输入文章关键词" required
                            value="{{old('keywords')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">简介描述</label>
                        <div class="col-sm-6">
                            <textarea class="form-control"id="description" name="description" placeholder="请输入简介描述" required>{{old('description')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">是否显示</label>
                        <div class="col-sm-6 col-form-label">
                            <div class="icheck-primary d-inline mr-4">
                                <input type="radio" id="is_show1" name="is_show">
                                <label for="is_show1">
                                    显示
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="is_show2" name="is_show">
                                <label for="is_show2">
                                    不显示
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">是否推荐</label>
                        <div class="col-sm-6 col-form-label">
                            <div class="icheck-primary d-inline mr-4">
                                <input type="radio" id="is_recommend1" name="is_recommend">
                                <label for="is_recommend1">
                                    推荐
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="is_recommend2" name="is_recommend">
                                <label for="is_recommend2">
                                    不推荐
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="thumb" class="col-sm-2 col-form-label">缩略图</label>
                        <div class="col-sm-6">
                            <input type="hidden" name="more[thumbnail]" class="form-control" id="js-thumbnail-input">
                            <div>
                                <a href="#">
                                    <img src="{{asset('admin/dist/img/default-thumbnail.png')}}" id="js-thumbnail-input-preview" width="135" style="cursor: pointer">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-sm-2 col-form-label">文章内容</label>
                        <div class="col-sm-6">
                            <input type="cat_name" class="form-control" id="content" name="content" placeholder="请输入文章标题" required
                            value="{{old('content')}}">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-left">提交</button>
                </div>
            </form>
        @endslot
    @endcomponent
@endsection