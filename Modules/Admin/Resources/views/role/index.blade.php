@extends('admin::layouts.master')

@section('content')
    @component('admin::components.main',['title'=>'角色列表'])
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a pjax href="/admin/role">角色管理</a></li>
            <li class="breadcrumb-item active">角色列表</li>
            @component('admin::components.modal',['formid'=>'del_forms','id'=>'del','url'=>'/admin/role','method'=>'DELETE','title'=>'删除角色'])
                <input type="hidden" name="id" id="id" value="" />
                <p id="msg">你确定要删除该角色</p>
            @endcomponent
        @endslot

        @slot('nav')
            <li class="nav-item">
                <a class="nav-link active" href="#">角色列表</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#addRole">添加角色</a>
            </li>
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
        @endslot

        @slot('body')
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
                            <a class="btn btn-xs bg-gradient-primary @if($role['name']=='Administrators') disabled @endif" href="#" data-toggle="modal"
                                data-target="#editRole{{$role['id']}}" >编辑</a>
                            <a href="/admin/role/permission/{{$role['id']}}" class="btn btn-xs bg-gradient-primary @if($role['name']=='Administrators') disabled @endif">权限</a>
                            <a href="#"  onclick="del(this)" data-id="{{$role['id']}}" data-title="{{$role['title']}}" class="btn btn-xs bg-gradient-danger @if($role['name']=='Administrators') disabled @endif">删除</a>
    
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
                function del(obj){
                    var id = $(obj).data('id');
                    var msg = '你确定要删除角色['+$(obj).data('title')+']?';
                    var url = '/admin/role/'+id;
                    $("#id").val(id);
                    $("#msg").html(msg);
                    $("#del_forms").attr('action',url);
                    $('#del').modal('show');
                }
            </script>
        @endslot
    @endcomponent
@endsection