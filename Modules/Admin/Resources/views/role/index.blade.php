@extends('admin::layouts.master')
@push('css-stack')
<link rel="stylesheet" href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.css')}}">
<style>
    th,
    td {
        padding: .6rem !important;
        vertical-align: middle !important;
    }
</style>
@endpush

@section('title','角色列表')
@section('breadcrumb')
@parent
<li class="breadcrumb-item"><a href="/admin/role">角色管理</a></li>
<li class="breadcrumb-item active">角色列表</li>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link active" href="#">角色列表</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#addRole">添加角色</a>
            </li>
        </ul>
    </div>
    @component('admin::components.modal',['id'=>'addRole','url'=>'/admin/role','title'=>'添加角色'])
    <div class="form-group">
        <label for="roleTitle">角色名称</label>
        <input type="text" class="form-control" name="title" id="roleTitle" placeholder="请输入角色名称"
            value="{{old('title')}}">
    </div>
    <div class="form-group">
        <label for="roleName">角色标识</label>
        <input type="text" class="form-control" name="name" id="roleName" placeholder="标识必须为英文字母"
            value="{{old('name')}}">
    </div>
    @endcomponent

    <!-- /.card-header -->
    <div class="card-body">
        <table id="role_list" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>角色名称</th>
                    <th>角色标识</th>
                    <th>创建时间</th>
                    <th class="text-center" style="width:200px;">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{$role['id']}}</td>
                    <td>{{$role['title']}}</td>
                    <td>{{$role['name']}}</td>
                    <td>{{$role['created_at']}}</td>
                    <td class="text-center">
                        <a class="btn btn-xs bg-gradient-primary" href="#" data-toggle="modal"
                            data-target="#editRole{{$role['id']}}">编辑</a>
                        <a href="/admin/role/permission/{{$role['id']}}" class="btn btn-xs bg-gradient-primary">权限</a>
                        <a href="#" class="btn btn-xs bg-gradient-danger">删除</a>

                        @component('admin::components.modal',['id'=>"editRole{$role['id']}",'method'=>'PUT','url'=>"/admin/role/{$role['id']}",'title'=>"编辑角色{$role['title']}"])
                        <div class="form-group">
                            <label for="roleTitle">角色名称</label>
                            <input type="text" class="form-control" name="title" id="roleTitle" placeholder="请输入角色名称"
                                value="{{$role['title']}}">
                        </div>
                        <div class="form-group">
                            <label for="roleName">角色标识</label>
                            <input type="text" class="form-control" name="name" id="roleName" placeholder="标识必须为英文字母"
                                value="{{$role['name']}}">
                        </div>
                        @endcomponent
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection
@push('js-stack')
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.language.js')}}"></script>
<script>
    $(function () {
        $('#role_list').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false
        });
    });
</script>
@endpush