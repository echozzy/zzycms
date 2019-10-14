@extends('admin::layouts.master')
@section('content')
    @component('admin::components.main',['title'=>'权限列表'])

        @slot('breadcrumb')
        <li class="breadcrumb-item"><a pjax href="/admin/permission">权限管理</a></li>
        <li class="breadcrumb-item active">权限列表</li>
        @endslot

        @slot('nav')
        <li class="nav-item">
            <a class="nav-link active" href="#">权限列表</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" pjax href="/admin/permission/create">添加权限</a>
        </li>
        @component('admin::components.modal',['formid'=>'del_forms','id'=>'del','url'=>'/admin/permission','method'=>'DELETE','title'=>'删除权限'])
        <input type="hidden" name="id" id="id" value="" />
        <p id="msg">你确定要删除该权限</p>
        @endcomponent
        @endslot

        @slot('body')
        <table id="permission_list" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="20"></th>
                    <th width="60">ID</th>
                    <th>权限名称</th>
                    <th>权限标识</th>
                    <th>Guard</th>
                    <th width="120">操作</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <script>
            $(function () {
                    // 初始化表格
                    $('#permission_list').DataTable({
                        "ajax": {
                                    "url": "/admin/permission/list",
                                    "type": "POST",
                                    "async": false,
                                    "dataSrc":""
                                },
                        "treeGrid": {
                                    'left': 15,
                                    'expandIcon': '<span><i class="far fa-plus-square"></i></span>',
                                    'collapseIcon': '<span><i class="far fa-minus-square"></i></span>'
                                },
                        "columns": [
                                {
                                    "className":"treegrid-control",
                                    data: function (item) {
                                        if (item.children.length>0) {
                                            return '<span><i class="far fa-plus-square"></i></span>';
                                        }
                                        return '';
                                    }
                                },
                                {
                                    "data": "id",
                                },
                                {
                                    "data": "title",
                                },
                                {
                                    "data": "name",
                                },
                                {
                                    "data": "guard_name",
                                },
                                {
                                    "className":"text-center",
                                    data:function(item){
                                        var html = '<a class="btn btn-xs bg-gradient-primary" href="/admin/permission/'+item.id+'/edit">编辑</a>';
                                        html += '<a class="btn btn-xs bg-gradient-danger" href="#" onclick="del(this)" data-id="'+item.id+'" data-title="'+item.title+'">删除</a>';
                                        return html;
                                    }
                                }
                            ]
            
                    });
                });
            
                function del(obj){
                    var id = $(obj).data('id');
                    var msg = '你确定要删除权限['+$(obj).data('title')+']?';
                    var url = '/admin/permission/'+id;
                    $("#id").val(id);
                    $("#msg").html(msg);
                    $("#del_forms").attr('action',url);
                    $('#del').modal('show');
                }
            
        </script>
        @endslot
    @endcomponent
@endsection