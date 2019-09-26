@extends('admin::layouts.master')

@section('content')
    @component('admin::components.main',['title'=>"编辑管理员[$admin_user[nick_name]]",'body_css'=>'col-sm-9 m-auto'])
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a pjax href="/admin/admin_user">管理员列表</a></li>
            <li class="breadcrumb-item active">编辑管理员</li>
        @endslot
        @slot('nav')
            <li class="nav-item">
                <a pjax class="nav-link" href="/admin/admin_user">管理员列表</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">编辑管理员</a>
            </li>
        @endslot
        @slot('body')
            <form action="/admin/admin_user/{{$admin_user['id']}}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <label for="user_name" class="col-sm-2 col-form-label">管理员账号</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="请输入管理员账号" required
                            value="{{$admin_user['user_name']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">管理员密码</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nick_name" class="col-sm-2 col-form-label">管理员昵称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nick_name" name="nick_name" placeholder="请输入管理员昵称" required
                            value="{{$admin_user['nick_name']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="parent" class="col-sm-2 col-form-label">管理员角色</label>
                        <div class="col-sm-10">
                            <select id="parent" name="role_id" class="form-control">
                                @foreach ($roles as $item)
                                <option value="{{$item['id']}}" @hasrole($item['id'])selected="selected"@endhasrole >{{$item['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">提交</button>
                </div>
            </form>
        @endslot
    @endcomponent
@endsection