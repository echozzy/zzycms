<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>ZzyCms | 仪表板</title>
  <meta name="description" content="zzycms" />
  <meta name="keywords" content="zzycms" />
  <!-- 告诉浏览器响应屏幕宽度 -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <!-- 图标矢量图 -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet"
    href="{{asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- 模版样式 -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- 日期组件 -->
  <link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">

  <link rel="stylesheet" href="{{asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">

  <script src="{{ mix('js/app.js') }}"></script>
  @stack('css-stack')
</head>
<style>
  .user-image {
    height: auto;
    width: 2.1rem;
    margin-top: -0.4rem;
  }

  .dropdown-item span {
    padding-left: 0.8rem;
  }
  
  .content-header{
    padding: 10px .5rem;
  }

  /* 警告框 */
  .swal2-title {
    margin-left: 0.8rem !important;
  }

  /* 按钮 */
  .btn-xs {
    padding: .2rem .6rem;
    font-size: .875rem;
    line-height: 1.4;
    border-radius: .2rem;
  }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- 导航栏 -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- 左导航栏链接 -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="/admin" class="nav-link">Home</a>
        </li>
      </ul>

      <!-- 右导航栏链接 -->
      <ul class="navbar-nav ml-auto">
        <!-- 消息下拉菜单 -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- 消息开始 -->
              <div class="media">
                <img src="{{asset('admin/dist/img/user1-128x128.jpg')}}" alt="User Avatar"
                  class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">你什么时候可以打电话给我…</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>4小时前</p>
                </div>
              </div>
              <!-- 消息结束 -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- 消息开始 -->
              <div class="media">
                <img src="{{asset('admin/dist/img/user8-128x128.jpg')}}" alt="User Avatar"
                  class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">我收到你的留言了兄弟</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>4小时前</p>
                </div>
              </div>
              <!-- 消息结束 -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- 消息开始 -->
              <div class="media">
                <img src="{{asset('admin/dist/img/user3-128x128.jpg')}}" alt="User Avatar"
                  class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">主题在这里</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>4小时前</p>
                </div>
              </div>
              <!-- 消息结束 -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">查看所有消息</a>
          </div>
        </li>
        <!-- 个人中心 -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="user-image img-circle elevation-2" alt="User Image">
            <span class="hidden-xs">{{auth()->user()->nick_name}}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
            <a class="dropdown-item" href="#"><i class="fa fa-user-circle"></i><span>修改信息</span></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><i class="fa fa-lock"></i><span>修改密码</span></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"
              onclick="event.preventDefault();document.getElementById('logout').submit()"><i
                class="fa fa-sign-out-alt"></i><span>退出</span></a>
            <form action="{{route('logout')}}" method="post" id="logout">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.导航栏 -->

    <!-- 主边栏容器 -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/admin" class="brand-link">
        <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">ZzyCms 1</span>
      </a>

      <!-- 边栏 -->
      <div class="sidebar">
        <!-- 边栏用户面板（可选） -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{auth()->user()->nick_name}}</a>
          </div>
        </div>

        <!-- 边栏 Menu -->
        <nav class="mt-2">
          @include('admin::layouts._menus')
        </nav>
        <!-- /.边栏-menu -->
      </div>
      <!-- /.边栏 -->
    </aside>

    <!-- 页面内容 -->
    <div class="content-wrapper">
      <!-- 内容头部 -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h5 class="m-0 text-dark">@yield('title')</h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                @section('breadcrumb')
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                @show
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.内容头部 -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          @yield('content')
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.页面内容 -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.0-beta.2
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->
  <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
  <script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('admin/plugins/fastclick/fastclick.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('admin/dist/js/adminlte.js')}}"></script>
  <!-- 警告框 -->
  <script src="{{asset('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
  <script>
    // Resolve conflict in jQuery UI tooltip with Bootstrap tooltip 
    $.widget.bridge('uibutton', $.ui.button)
    // ajax csrf保护
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // ajax js消息提示框
    const JsToast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 2000
    });
  </script>

  @include('admin::layouts._validate')
  @include('admin::layouts._messages')
  @stack('js-stack')
</body>

</html>