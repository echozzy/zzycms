<div class="modal fade" id="{{$id}}-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="{{$id}}-inp" type="file">
            </div>
            <div class="modal-footer">
                <button id="{{$id}}-ok" type="buttion" class="btn btn-primary">确定</button>
                <button id="{{$id}}-cancel" type="buttion" class="btn btn-default">取消</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>