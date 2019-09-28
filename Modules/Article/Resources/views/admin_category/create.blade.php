@extends('admin::layouts.master')

@section('content')
    @component('admin::components.main',['title'=>'添加分类','body_css'=>'col-sm-9 m-auto'])
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a pjax href="/article/admin_category">文章分类</a></li>
            <li class="breadcrumb-item active">添加分类</li>
        @endslot
        @slot('nav')
            <li class="nav-item">
                <a pjax class="nav-link" href="/article/admin_category">分类列表</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">添加分类</a>
            </li>
        @endslot
        @slot('body')
            <form action="/article/admin_category" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="p_id" class="col-sm-2 col-form-label">上级</label>
                        <div class="col-sm-10">
                            <select id="p_id" name="p_id" class="form-control">
                                <option value="0">作为一级分类</option>
                                @foreach ($categorys as $item)
                                <option value="{{$item['id']}}">{!!$item['_cat_name']!!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">分类名称</label>
                        <div class="col-sm-10">
                            <input type="cat_name" class="form-control" id="cat_name" name="cat_name" placeholder="请输入分类名称" required
                            value="{{old('cat_name')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_description" class="col-sm-2 col-form-label">分类描述</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="cat_description" name="cat_description" placeholder="请输入分类描述"
                            value="{{old('cat_description')}}">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">提交</button>
                </div>
            </form>
        @endslot
    @endcomponent
@endsection