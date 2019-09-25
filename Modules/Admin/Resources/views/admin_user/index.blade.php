@extends('admin::layouts.master')
@section('content')
@component('admin::components.main',['title'=>'管理员列表'])

@slot('breadcrumb')
<li class="breadcrumb-item active">管理员列表</li>
@endslot

@slot('nav')
<li class="nav-item">
    <a class="nav-link active" href="#">管理员列表</a>
</li>
<li class="nav-item">
    <a class="nav-link" pjax href="/admin/admin_user/create">添加管理员</a>
</li>
@component('admin::components.modal',['formid'=>'del_forms','id'=>'del','url'=>'/admin/admin_user','method'=>'DELETE','title'=>'删除管理员'])
<input type="hidden" name="id" id="id" value="" />
<p id="msg">你确定要删除该管理员</p>
@endcomponent
@endslot

@slot('body')
<table id="tab_list" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th width="50">ID</th>
            <th>管理员账号</th>
            <th>管理员昵称</th>
            <th>创建时间</th>
            <th width="120">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($admin_users as $user)
        <tr>
            <td>{{$user['id']}}</td>
            <td>{{$user['user_name']}}</td>
            <td>{{$user['nick_name']}}</td>
            <td>{{$user['created_at']}}</td>
            <td class="text-center">
                <a href="/admin/admin_user/{{$user['id']}}/edit" class="btn btn-xs bg-gradient-primary">编辑</a>
                <a href="#" onclick="del(this)" data-id="{{$user['id']}}" data-user_name="{{$user['user_name']}}" class="btn btn-xs bg-gradient-danger">删除</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function () {
        $('#tab_list').DataTable({
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
        var msg = '你确定要删除管理员['+$(obj).data('user_name')+']?';
        var url = '/admin/admin_user/'+id;
        $("#id").val(id);
        $("#msg").html(msg);
        $("#del_forms").attr('action',url);
        $('#del').modal('show');
    }
            
</script>
@endslot
@endcomponent
@endsection