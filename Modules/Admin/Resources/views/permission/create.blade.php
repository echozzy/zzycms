@extends('admin::layouts.master')
@push('css-stack')

@endpush

@section('title','权限管理/添加权限')
@section('content')
<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link" href="/admin/permission">权限列表</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">添加权限</a>
            </li>
        </ul>
    </div>
    @component('admin::components.modal',['formid'=>'del_forms','id'=>'delPermission','url'=>'/admin/permission','method'=>'DELETE','title'=>'删除权限'])
    <input type="hidden" name="id" id="permission_id" value="" />
    <p id="msg">你确定要删除该权限</p>
    @endcomponent
    <!-- /.card-header -->
    <div class="card-body col-sm-9 m-auto">
        <form action="/admin/permission" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="parent" class="col-sm-2 col-form-label">父级</label>
                    <div class="col-sm-10">
                        <select id="parent" name="p_id" class="form-control">
                            <option value="0" selected="selected">作为顶级</option>
                            @foreach ($permissions as $item)
                            <option value="{{$item['id']}}">{{$item['title']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">权限名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" placeholder="请输入权限名称" required
                            value="{{old('title')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">权限标识</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="请输入权限名称" required
                            value="{{old('name')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="guard_name" class="col-sm-2 col-form-label">Guard</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="guard_name" name="guard_name" placeholder="请输入权限名称 例如:admin"
                            required value="{{old('guard_name')}}">
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">提交</button>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
@endsection
@push('js-stack')

@endpush