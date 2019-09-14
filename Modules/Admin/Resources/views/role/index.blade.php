@extends('admin::layouts.master')
@push('css-stack')
<link rel="stylesheet" href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush

@section('title','角色管理')
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
    @component('components.modal',['id'=>'addRole','url'=>'/admin/role','title'=>'添加角色'])
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
                    <th style="width:200px;">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{$role['id']}}</td>
                    <td>{{$role['title']}}</td>
                    <td>{{$role['name']}}</td>
                    <td>{{$role['created_at']}}</td>
                    <td align="center">
                        <a class="btn btn-xs btn-primary" href="#"  data-toggle="modal" data-target="#editRole{{$role['id']}}">编辑</a>
                        <button type="button" class="btn btn-xs bg-gradient-primary">权限</button>
                        <button type="button" class="btn btn-xs bg-gradient-danger">删除</button>
                        @component('components.modal',['id'=>"editRole{$role['id']}",'method'=>'PUT','url'=>"/admin/role/{$role['id']}",'title'=>"编辑角色{$role['title']}"])
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
@endpush
@section('scripts')
<script>
    $(function () {
        $('#role_list').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "language": {
                "processing" : "处理中...",
                "search" : "搜索:",
                "emptyTable" : "没有数据",
                "loadingRecords" : "数据加载中...",
                "info": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                "infoEmpty" : "显示第 0 至 0 项结果，共 0 项",
                "paginate" : {
                    "first" : "首页",
                    "previous" : "上页",
                    "next" : "下页",
                    "last" : "末页"
                }
            },
        });
    });
</script>
@endsection