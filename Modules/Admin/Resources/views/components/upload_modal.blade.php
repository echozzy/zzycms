<div class="modal fade" id="{{$id}}-modal">
    <div class="modal-dialog" style="max-width: 580px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 0.4rem 1rem;">
                <h5 class="modal-title">{{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0.2rem 1rem;">
                    <nav style="margin-bottom: 10px;">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="{{$id}}-file-upload-tab" data-toggle="tab" href="#{{$id}}-file-upload" role="tab" aria-controls="{{$id}}-file-upload" aria-selected="true">上传文件</a>
                            <a class="nav-item nav-link" id="{{$id}}-file-url-tab" data-toggle="tab" href="#{{$id}}-file-url" role="tab" aria-controls="{{$id}}-file-url" aria-selected="false">网络文件</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="{{$id}}-file-upload" role="tabpanel" aria-labelledby="{{$id}}-file-upload-tab">
                            <input id="{{$id}}-inp" type="file" @if(isset($is_multiple)) multiple='multiple' @endif >
                        </div>
                        <div class="tab-pane fade" id="{{$id}}-file-url" role="tabpanel" aria-labelledby="{{$id}}-file-url-tab">
                            <div class="form-group">
                                <label for="{{$id}}-file-url-content">请输入网络地址</label>
                                <input type="text" class="form-control" id="{{$id}}-file-url-content"  placeholder="https://">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer" style="padding: 0.4rem 1rem;">
                <input type="hidden" id="{{$id}}-file-url-inp" value="1">
                <input type="hidden" id="{{$id}}-file-path-inp" value="2">
                <input type="hidden" id="{{$id}}-file-name-inp" value="2">
                <a class="btn btn-xs bg-gradient-primary" href="javascript:;" onclick="uploadConfirm('#{{$id}}')">确定</a>
                <a class="btn btn-xs bg-gradient-secondary" href="javascript:;" onclick="uploadCancel('#{{$id}}')">取消</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>