@extends('admin::layouts.master')
@section('content')
@component('admin::components.main',['title'=>'文章分类'])

@slot('breadcrumb')
<li class="breadcrumb-item active">文章分类</li>
@endslot

@slot('nav')
<li class="nav-item">
    <a class="nav-link active" href="#">文章分类</a>
</li>
<li class="nav-item">
    <a class="nav-link" pjax href="/article/admin_category/create">添加分类</a>
</li>
@component('admin::components.modal',['formid'=>'del_forms','id'=>'del','url'=>'/article/admin_category','method'=>'DELETE','title'=>'删除分类'])
<input type="hidden" name="id" id="id" value="" />
<p id="msg">你确定要删除该分类</p>
@endcomponent
@endslot

@slot('body')
<table id="tab_list" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th width="20"></th>
            <th width="60">排序</th>
            <th width="50">ID</th>
            <th>分类名称</th>
            <th>分类描述</th>
            <th>创建时间</th>
            <th width="120">操作</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
<script>
    $(function () {
        // 初始化表格
        $('#tab_list').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "ajax": {
                        "url": "/article/admin_category/list",
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
                        "data": "_cat_name",
                    },
                    {
                        "data": "cat_description",
                    },
                    {
                        "data": "updated_at",
                    },
                    {
                        "className":"text-center",
                        data:function(item){
                            var html = '<a href="/article/admin_category/create/'+item.id+'" class="btn btn-xs bg-gradient-primary" href="#">添加子分类</a>';
                            html += '<a href="/article/admin_category/'+item.id+'/edit" class="btn btn-xs bg-gradient-primary" href="#">编辑</a>';
                            html += '<a class="btn btn-xs bg-gradient-danger" href="#" onclick="del(this)" data-id="'+item.id+'" data-cat_name="'+item.cat_name+'">删除</a>\n';
                            return html;
                        }
                    }
                ]

        });
    });
            
    function del(obj){
        var id = $(obj).data('id');
        var msg = '你确定要删除分类['+$(obj).data('cat_name')+']?';
        var url = '/article/admin_category/'+id;
        $("#id").val(id);
        $("#msg").html(msg);
        $("#del_forms").attr('action',url);
        $('#del').modal('show');
    }
    function updateSort(obj) {
        let id = $(obj).data("id");
        let val = $(obj).val();
        $.ajax({
            type: 'post',
            dataType:'json',
            data: {'id':id,'val':val},
            url:"/article/admin_category/sort",
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
@endslot
@endcomponent
@endsection