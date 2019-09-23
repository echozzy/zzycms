@extends('admin::layouts.master')

@section('title','权限列表')
@section('breadcrumb')
@parent
<li class="breadcrumb-item"><a pjax href="/admin/permission">权限管理</a></li>
<li class="breadcrumb-item active">权限列表</li>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link active" href="#">权限列表</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" pjax href="/admin/permission/create">添加权限</a>
            </li>
        </ul>
    </div>
    @component('admin::components.modal',['formid'=>'del_forms','id'=>'del','url'=>'/admin/permission','method'=>'DELETE','title'=>'删除权限'])
    <input type="hidden" name="id" id="id" value="" />
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
                            var html = '<a class="btn btn-xs bg-gradient-primary" href="/admin/permission/'+item.id+'/edit">编辑</a>\n';
                            html += '<a class="btn btn-xs bg-gradient-danger" href="#" onclick="del(this)" data-id="'+item.id+'" data-title="'+item.title+'">删除</a>\n';
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
@endsection
@push('js-stack')
{{-- <script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.treeGrid.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.language.js')}}"></script> --}}
@endpush