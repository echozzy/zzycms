@extends('admin::layouts.master')
@push('css-stack')
<link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<style>
    .fa-lg {
        font-size: 1.5em;
    }

    span.mr-2 {
        cursor: pointer;
    }
</style>
@endpush
@section('title',"[{$role['title']}]权限设置")
@section('breadcrumb')
@parent
<li class="breadcrumb-item"><a href="/admin/role">角色管理</a></li>
<li class="breadcrumb-item active">权限设置</li>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link" href="/admin/role">角色列表</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">权限设置</a>
            </li>
        </ul>
    </div>
    <!-- /.card-header -->
    <div class="card-body col-sm-9 m-auto">
        <form action="/admin/role/permission/{{$role['id']}}" method="post">
            @csrf
            <div class="card-body">
                <div class="accordion">
                    @foreach ($permissions as $permission)
                    <div class="card" style="margin-bottom: 0 !important;">
                        <div class="card-header">
                            <span class="mr-2" data-toggle="collapse" data-target="#collapse{{$permission['id']}}"><i
                                    class="far fa-caret-square-right fa-lg"></i></span>
                            <div class="icheck-primary d-inline mr-4">
                                <input type="checkbox" id="checkbox{{$permission['id']}}" name="id[]"
                                    value="{{$permission['id']}}"
                                    {{$role->hasPermissionTo($permission['id'])?'checked':''}}>
                                <label for="checkbox{{$permission['id']}}">
                                    {{$permission['title']}}
                                </label>
                            </div>
                        </div>
                        <div id="collapse{{$permission['id']}}" class="collapse">
                            <div class="card-body">
                                @foreach ($permission['children'] as $item)
                                <div class="icheck-primary d-inline mr-4">
                                    <input type="checkbox" id="checkbox{{$item['id']}}" name="id[]"
                                        value="{{$item['id']}}" {{$role->hasPermissionTo($item['id'])?'checked':''}}>
                                    <label for="checkbox{{$item['id']}}">
                                        {{$item['title']}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">提交</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
@endsection
@push('js-stack')
<script>
    $(function() {
        $('.collapse').on('hide.bs.collapse', function () {
            let i = $(this).prev().find('i');
            i.prop('class','far fa-caret-square-right fa-lg');
        })
        $('.collapse').on('show.bs.collapse', function () {
            let i = $(this).prev().find('i');
            i.prop('class','far fa-caret-square-down fa-lg');
        })
        $('input[type="checkbox"]').click(function () {
            let parent = $(this).parents('.collapse');
            if(parent.length<1){
                parent = $(this).parents('.card-header');
                if($(this).prop('checked')){
                    parent.next().find('input[type="checkbox"]').each(function () {
                        $(this).prop("checked",true);
                    })
                }else{
                    parent.next().find('input[type="checkbox"]').each(function () {
                        $(this).prop("checked",false);
                    })
                }
            }else{
                if($(this).prop('checked')){
                    parent.prev().find('input[type="checkbox"]').prop("checked",true);
                }
            }
        });
    });
</script>
@endpush