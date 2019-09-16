@extends('admin::layouts.master')
@push('css-stack')
<link rel="stylesheet" href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

@section('title','菜单管理')
@section('content')
<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link active" href="#">菜单列表</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#addMenu">添加菜单</a>
            </li>
        </ul>
    </div>
    @component('admin::components.modal',['id'=>'addMenu','url'=>'/admin/menu/create','title'=>'添加菜单'])
    <div class="form-group">
        <label for="menuParent">上级</label>
        <select id="roleParent" class="form-control select2" style="width: 100%;">
          <option selected="selected">作为一级菜单</option>
          <option>Alaska</option>
          <option>California</option>
          <option>Delaware</option>
          <option>Tennessee</option>
          <option>Texas</option>
          <option>Washington</option>
        </select>
    </div>
    <div class="form-group">
        <label for="menuTitle">菜单名称</label>
        <input type="text" class="form-control" name="title" id="menuTitle" placeholder="请输入菜单名称"
            value="{{old('title')}}">
    </div>
    <div class="form-group">
        <label for="menuIcon">菜单图标</label>
        <input type="text" class="form-control" name="icon" id="menuIcon" placeholder="请输入菜单名称"
            value="{{old('icon')}}">
    </div>
    <div class="form-group">
        <label for="menuPermission">权限标识</label>
        <input type="text" class="form-control" name="permission" id="menuPermission" placeholder="请输入权限标识"
            value="{{old('permission')}}">
    </div>
    <div class="form-group">
        <label for="menuUrl">URL路径</label>
        <input type="text" class="form-control" name="url" id="menuUrl" placeholder="请输入URL路径"
            value="{{old('url')}}">
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
                {{-- @foreach ($roles as $role)
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
                @endforeach --}}
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