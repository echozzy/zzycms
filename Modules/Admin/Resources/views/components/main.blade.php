<!-- 内容头部 -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h5 class="m-0 text-dark">{{$title}}</h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    {{$breadcrumb}}
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.内容头部 -->
<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
                {{$nav}}
            </ul>
        </div>
        <div class="card-body @isset($body_css){{$body_css}}@endisset">
            {{$body}}
        </div>
    </div>
</section>
<!-- /.content -->