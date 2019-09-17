@extends('admin::layouts.master')
@push('css-stack')
<link rel="stylesheet" href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<style>
    th,
    td {
        padding: .6rem !important;
        vertical-align: middle !important;
    }
</style>
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
    @component('admin::components.modal',['id'=>'addMenu','url'=>'/admin/menu','title'=>'添加菜单'])
    <div class="form-group">
        <label for="menuParent">上级</label>
        <select id="menuParent" name="p_id" class="form-control select2" style="width: 100%;">
            <option value="0" selected="selected">作为一级菜单</option>
            @foreach ($menus as $item)
            <option value="{{$item['id']}}">{{$item['title']}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="menuTitle">菜单名称</label>
        <input type="text" class="form-control" name="title" id="menuTitle" placeholder="请输入菜单名称"
            value="{{old('title')}}">
    </div>
    <div class="form-group">
        <label for="menuIcon">菜单图标</label>
        <input type="text" class="form-control" name="icon" id="menuIcon" placeholder="请输入菜单名称" value="{{old('icon')}}">
        <p class="help-block">
            <a href="http://www.fontawesome.com.cn/faicons/" target="_blank">选择图标</a>使用的Font Awesome图标库 例:fa fa-navicon
        </p>
    </div>
    <div class="form-group">
        <label for="menuPermission">权限标识</label>
        <input type="text" class="form-control" name="permission" id="menuPermission" placeholder="请输入权限标识"
            value="{{old('permission')}}">
    </div>
    <div class="form-group">
        <label for="menuUrl">URL路径</label>
        <input type="text" class="form-control" name="url" id="menuUrl" placeholder="请输入URL路径" value="{{old('url')}}">
    </div>
    @endcomponent

    @component('admin::components.modal',['formid'=>'forms','id'=>'updateMenu','url'=>'/admin/menu','method'=>'PUT','title'=>'编辑菜单'])
    <div class="form-group">
        <label for="upMenuParent">上级</label>
        <select id="upMenuParent" name="p_id" class="form-control select2" style="width: 100%;">
            <option value="0">作为一级菜单</option>
            @foreach ($menus as $item)
            <option value="{{$item['id']}}">{{$item['title']}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="upMenuTitle">菜单名称</label>
        <input type="text" class="form-control" name="title" id="upMenuTitle" placeholder="请输入菜单名称"
            value="{{old('title')}}">
    </div>
    <div class="form-group">
        <label for="upMenuIcon">菜单图标</label>
        <input type="text" class="form-control" name="icon" id="upMenuIcon" placeholder="请输入菜单名称" value="{{old('icon')}}">
        <p class="help-block">
            <a href="http://www.fontawesome.com.cn/faicons/" target="_blank">选择图标</a>使用的Font Awesome图标库 例:fa fa-navicon
        </p>
    </div>
    <div class="form-group">
        <label for="upMenuPermission">权限标识</label>
        <input type="text" class="form-control" name="permission" id="upMenuPermission" placeholder="请输入权限标识"
            value="{{old('permission')}}">
    </div>
    <div class="form-group">
        <label for="upMenuUrl">URL路径</label>
        <input type="text" class="form-control" name="url" id="upMenuUrl" placeholder="请输入URL路径" value="{{old('url')}}">
    </div>
    @endcomponent

    <!-- /.card-header -->
    <div class="card-body">
        <table id="menu_list" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="20"></th>
                    <th width="60">排序</th>
                    <th width="50">ID</th>
                    <th>菜单名称</th>
                    <th>权限标识</th>
                    <th width="200">操作</th>
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
        $('#menu_list').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "ajax": {
                        "url": "/admin/menu/list",
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
                        
                        "className":"text-center",
                        data:function(item){
                            var html = '<input type="text" class="list_order" onchange="updateSort(this)" style="width:100%;" data-id="'+item.id+'" value="'+item.list_order+'"/>';
                            return html;
                        }
                    },
                    {
                        "data": "id",
                    },
                    {
                        "data": "title",
                    },
                    {
                        "data": "permission",
                    },
                    {
                        "className":"text-center",
                        data:function(item){
                            var html = '<a class="btn btn-xs btn-primary" href="#" onclick="updateMenu(this)" data-id="'+item.id+'">编辑</a>\n';
                            html += '<button type="button" class="btn btn-xs bg-gradient-primary">权限</button>\n';
                            html += '<button type="button" class="btn btn-xs bg-gradient-danger">删除</button>\n';
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