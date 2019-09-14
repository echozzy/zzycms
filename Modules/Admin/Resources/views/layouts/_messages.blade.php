<script type="text/javascript">
    $(function(){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 4000
        });
        
        @foreach(['success','warning','error'] as $type)
        @if(session()->has($type))
            let title = '';
            let type = 'warning';
            title = '{{session()->get($type)}}';
            type = '{{$type}}';
            Toast.fire({
                type: type,
                title: title,
            })
        @endif
        @endforeach

        @if (session('status'))
            let title = '';
            title = "{{ session('status') }}";

            Toast.fire({
                type: 'error',
                title: title,
            })
        @endif
    });
</script>