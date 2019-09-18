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

@section('title','权限管理')
@section('content')
<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link active" href="#">权限列表</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/permission/create">添加权限</a>
            </li>
        </ul>
    </div>
    @component('admin::components.modal',['formid'=>'del_forms','id'=>'delPermission','url'=>'/admin/permission','method'=>'DELETE','title'=>'删除权限'])
        <input type="hidden" name="id" id="permission_id" value="" />
        <p id="msg">你确定要删除该权限</p>
    @endcomponent
    <!-- /.card-header -->
    <div class="card-body">
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
    </div>
    <!-- /.card-body -->
</div>
@endsection
@push('js-stack')
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.treeGrid.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.language.js')}}"></script>
<script>
    $(function () {
        // 初始化表格
        $('#permission_list').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
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
                            var html = '<a class="btn btn-xs bg-gradient-primary" href="#" onclick="updateMenu(this)" data-id="'+item.id+'">编辑</a>\n';
                            html += '<a class="btn btn-xs bg-gradient-danger" href="#" onclick="delMenu(this)" data-id="'+item.id+'" data-title="'+item.title+'">删除</a>\n';
                            return html;
                        }
                    }
                ]

        });
    });

    function updateMenu(obj){
        var id = $(obj).data('id');
        $.ajax({
            type: 'post',
            dataType:'json',
            data: {'id':id,},
            url:"/admin/menu/getMenu",
            success:function(data){
                $("#upMenuParent").val(data.p_id);
                $("#upMenuTitle").val(data.title);
                $("#upMenuIcon").val(data.icon);
                $("#upMenuPermission").val(data.permission);
                $("#upMenuUrl").val(data.url);

                var url = '/admin/menu/'+id;
                $("#forms").attr('action',url);

                $('#updateMenu').modal('show');
            },
        });
    }

    function delMenu(obj){
        var id = $(obj).data('id');
        var msg = '你确定要删除'+$(obj).data('title')+'?';
        var url = '/admin/menu/'+id;
        $("#menu_id").val(id);
        $("#msg").html(msg);
        $("#del_forms").attr('action',url);
        $('#delMenu').modal('show');
    }

    function updateSort(obj) {
        let id = $(obj).data("id");
        let val = $(obj).val();
        $.ajax({
            type: 'post',
            dataType:'json',
            data: {'id':id,'val':val},
            url:"/admin/menu/sort",
            success:function(data){
                if(data.status){
                    JsToast.fire({
                        type: 'success',
                        title: data.msg,
                    })
                }else{
                    JsToast.fire({
                        type: 'error',
                        title: data.msg,
                    })
                }
            },
        });
    }
</script>
@endpush