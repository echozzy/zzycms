@extends('admin::layouts.master')
@include('vendor.ueditor.assets')
@push('css')
<link rel="stylesheet" href="{{asset('static/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('static/admin/plugins/bootstrap-fileinput-5.0.6/css/fileinput.min.css')}}">
@endpush
@section('content')
    @component('admin::components.main',['title'=>'编辑文章'])
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a pjax href="/article/admin_article">文章列表</a></li>
            <li class="breadcrumb-item active">编辑文章</li>
        @endslot
        @slot('nav')
            <li class="nav-item">
                <a pjax class="nav-link" href="/article/admin_article">文章列表</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">编辑文章</a>
            </li>
            @component('admin::components.upload_modal',['id'=>'thumbnail','title'=>'图片上传'])
            @endcomponent
            @component('admin::components.upload_modal',['id'=>'files','title'=>'文件上传','is_multiple'=>'true'])
            @endcomponent
        @endslot
        @slot('body')
            <form action="/article/admin_article/{{$article['id']}}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">文章标题</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="title" name="title" placeholder="请输入文章标题" required
                            value="{{$article['title']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_id" class="col-sm-2 col-form-label">文章分类</label>
                        <div class="col-sm-8">
                            <select id="cat_id" name="cat_id" class="form-control">
                                @foreach ($categorys as $item)
                                <option value="{{$item['id']}}" {{$item['_selected']?'selected':''}}>{!!$item['_cat_name']!!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="author" class="col-sm-2 col-form-label">作者</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="author" name="author" placeholder="请输入作者" value="{{$article['author']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keywords" class="col-sm-2 col-form-label">关键词</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="keywords" name="keywords" placeholder="请输入文章关键词" aria-describedby="keywordsHelp" required
                            value="{{$article['keywords']}}">
                            <small id="keywordsHelp" class="form-text text-muted">多关键词之间用英文逗号隔开</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">简介描述</label>
                        <div class="col-sm-8">
                            <textarea class="form-control"id="description" name="description" placeholder="请输入简介描述" required>{{$article['description']}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">是否显示</label>
                        <div class="col-sm-8 col-form-label">
                            <div class="icheck-primary d-inline mr-4">
                                <input type="radio" id="is_show1" name="is_show" value="1" {{$article['is_show']=='1'?'checked':''}}>
                                <label for="is_show1">
                                    显示
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="is_show2" name="is_show" value="0"  {{$article['is_show']=='0'?'checked':''}}>
                                <label for="is_show2">
                                    不显示
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">是否推荐</label>
                        <div class="col-sm-8 col-form-label">
                            <div class="icheck-primary d-inline mr-4">
                                <input type="radio" id="is_recommend1" name="is_recommend" value="1" {{$article['is_recommend']=='1'?'checked':''}}>
                                <label for="is_recommend1">
                                    推荐
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="is_recommend2" name="is_recommend" value="0" {{$article['is_recommend']=='0'?'checked':''}}>
                                <label for="is_recommend2">
                                    不推荐
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="thumb" class="col-sm-2 col-form-label">缩略图</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="thumb" class="form-control" id="thumbnail" value="{{$article['thumb']}}">
                            <div>
                                <a href="javascript:;" onclick="uploadOneImage('#thumbnail','article')">
                                    <img src="@if($article['thumb'])/{{$article['thumb']}}@else{{asset('static/admin/dist/img/default-thumbnail.png')}}@endif" id="thumbnail-preview" width="135" style="cursor: pointer">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="thumb" class="col-sm-2 col-form-label">附件</label>
                        <div class="col-sm-8 col-form-label">
                            <ul id="files" class="list-group">
                                @foreach ($article['more']['files'] as $item)
                                <li class="form-inline mb-2">
                                    <input type="hidden" class="form-control" name="files_url[]" value="{{$item['files_url']}}">
                                    <input type="text" class="form-control" name="files_name[]" value="{{$item['files_name']}}">
                                    <a class="ml-2" href="/{{$item['files_url']}}" target="_blank">下载</a>
                                    <a class="ml-2" href="javascript:;" onclick="removeFile(this)">删除</a>
                                </li>
                                @endforeach
                            </ul>
                            <a class="btn btn-xs bg-gradient-primary" href="javascript:;" onclick="uploadFiles('#files','article')">选择文件</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-sm-2 col-form-label">文章内容</label>
                        <div class="col-sm-8">
                            <script id="container" name="content" type="text/plain">{!!$article['content']!!}</script>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-left">提交</button>
                </div>
            </form>
        @endslot
    @endcomponent
@endsection
@push('scripts')
<script src="{{asset('static/admin/plugins/bootstrap-fileinput-5.0.6/js/fileinput.min.js')}}"></script>
<script src="{{asset('static/admin/plugins/bootstrap-fileinput-5.0.6/js/locales/zh.js')}}"></script>
<script src="{{asset('static/admin/plugins/bootstrap-fileinput-5.0.6/themes/fas/theme.js')}}"></script>
<script src="{{asset('static/admin/plugins/bootstrap-fileinput-5.0.6/js/init_fileinput.js')}}"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });
</script>
@endpush