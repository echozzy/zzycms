<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>ZzyCMS | 登录系统</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <!-- 图标矢量图 -->
  <link rel="stylesheet" href="{{asset('static/admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('static/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- 模版样式 -->
  <link rel="stylesheet" href="{{asset('static/admin/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('static/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="/admin/login"><b>Zzy</b>CMS</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">管理系统</p>

        <form action="/admin/login" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="text" name="user_name" class="form-control" value="admin" placeholder="请输入后台账号">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-alt"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" value="admin888" placeholder="登录密码">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  记住我
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="{{ mix('js/app.js') }}"></script>
  <script src="{{asset('static/admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
  @include('admin::layouts._validate')
</body>

</html>