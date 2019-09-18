<form @isset($formid)id="{{$formid}}"@endisset role="form" action="{{$url}}" method="post">
    @csrf
    @isset($method)
    @method($method)
    @endisset
    <div class="modal fade" id="{{$id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{$slot}}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">确定</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>