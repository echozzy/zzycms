<script type="text/javascript">
    $(function(){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 4000
        });
    
        @if(count($errors)>0)
            let title = '';
            @foreach($errors->all() as $error)
                title += '{{$error}}<br>';
            @endforeach
            Toast.fire({
                type: 'error',
                title: title,
            })
        @endif
    });
</script>