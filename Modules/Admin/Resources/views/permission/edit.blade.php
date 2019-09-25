@extends('admin::layouts.master')

@section('content')
    @component('admin::components.main',['title'=>"编辑权限[$permission[title]]",'body_css'=>'col-sm-9 m-auto'])
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a pjax href="/admin/permission">权限管理</a></li>
            <li class="breadcrumb-item active">编辑权限</li>
        @endslot
        @slot('nav')
            <li class="nav-item">
                <a pjax class="nav-link" href="/admin/permission">权限列表</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">编辑权限</a>
            </li>
        @endslot
        @slot('body')
            <form action="/admin/permission/{{$permission['id']}}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <label for="parent" class="col-sm-2 col-form-label">父级</label>
                        <div class="col-sm-10">
                            <select id="parent" name="p_id" class="form-control">
                                <option value="0" @if($permission['p_id']==0) selected="selected" @endif>作为顶级</option>
                                @foreach ($permissions as $item)
                                <option value="{{$item['id']}}" @if($permission['p_id']==$item['id']) selected="selected" @endif>
                                    {{$item['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">权限名称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title" placeholder="请输入权限名称" required
                                value="{{$permission['title']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">权限标识</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="请输入权限标识" required
                                value="{{$permission['name']}}">
                            <small class="form-text text-muted">
                                权限标识规则:为命名空间+控制器+@方法,例如:Modules\Admin\Http\Controllers\AdminController@index
                            </small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="guard_name" class="col-sm-2 col-form-label">Guard</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="guard_name" name="guard_name" placeholder="请输入权限名称 例如:admin"
                                required value="{{$permission['guard_name']}}">
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">更新</button>
                </div>
            </form>
        @endslot
    @endcomponent
@endsection