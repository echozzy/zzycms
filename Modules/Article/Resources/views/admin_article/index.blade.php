@extends('admin::layouts.master')
@section('content')
@component('admin::components.main',['title'=>'文章列表'])

@slot('breadcrumb')
<li class="breadcrumb-item active">文章列表</li>
@endslot

@slot('nav')
<li class="nav-item">
    <a class="nav-link active" href="#" pjax>文章列表</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/article/admin_article/create">添加文章</a>
</li>
@component('admin::components.modal',['formid'=>'del_forms','id'=>'del','url'=>'/article/admin_article','method'=>'DELETE','title'=>'删除文章'])
<input type="hidden" name="id" id="id" value="" />
<p id="msg">你确定要删除该文章</p>
@endcomponent
@endslot

@slot('body')
<table id="tab_list" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th width="50">ID</th>
            <th>文章名称</th>
            <th>文章分类</th>
            <th>作者</th>
            <th>点击量</th>
            <th>更新时间</th>
            <th width="40">显示</th>
            <th width="40">推荐</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
<script>
    $(function () {
        // 初始化表格
        $('#tab_list').DataTable({
            "paging":true,
            "info": true,
            "bLengthChange": true,//也就是页面上确认是否可以进行选择一页展示多少条
            "serverSide": true, //启用服务器端分页，要进行后端分页必须的环节
            "ajax": {
                        "url": "/article/admin_article/list",
                        "type": "POST",
                        "async": false,
                        "data": function (data) {
                            data.page = (data.start) / data.length + 1;//当前页码
                        },
                    },
            "columns": [
                    {
                        "data": "id",
                    },
                    {
                        "data": "title",
                    },
                    {
                        "data": "article_category.cat_name",
                    },
                    {
                        "data": "author",
                    },
                    {
                        "className":"text-center",
                        "data": "clicks",
                    },
                    {
                        "data": "updated_at",
                    },
                    {
                        "className":"text-center",
                        data: function (item) {
                            if (item.is_show==1) {
                                return '<span><i class="fas fa-check" style="color: #40d062"></i></span>';
                            }else{
                                return '<span><i class="fas fa-times" style="color: #f12b2b"></i></span>';
                            }
                        }
                    },
                    {
                        "className":"text-center",
                        data: function (item) {
                            if (item.is_recommend==1) {
                                return '<span><i class="fas fa-check" style="color: #40d062"></i></span>';
                            }else{
                                return '<span><i class="fas fa-times" style="color: #f12b2b"></i></span>';
                            }
                        }
                    },
                    {
                        "className":"text-center",
                        data:function(item){
                            var html = '<a href="/article/admin_article/'+item.id+'/edit" class="btn btn-xs bg-gradient-primary" href="#">编辑</a>';
                            html += '<a class="btn btn-xs bg-gradient-danger" href="#" onclick="del(this)" data-id="'+item.id+'" data-title="'+item.title+'">删除</a>\n';
                            return html;
                        }
                    }
                ]

        });
    });
            
    function del(obj){
        var id = $(obj).data('id');
        var msg = '你确定要删除文章['+$(obj).data('title')+']?';
        var url = '/article/admin_article/'+id;
        $("#id").val(id);
        $("#msg").html(msg);
        $("#del_forms").attr('action',url);
        $('#del').modal('show');
    }
    
            
</script>
@endslot
@endcomponent
@endsection