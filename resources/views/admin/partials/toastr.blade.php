<script>
    $(window).on('load', async function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
        });
{{--        @if ( $errors->any() )--}}
{{--            @foreach ( $errors->all() as $error )--}}
{{--                await Toast.fire({--}}
{{--                    icon: 'error',--}}
{{--                    title: '{{ $error }}'--}}
{{--                })--}}
{{--            @endforeach--}}
{{--        @endif--}}
        @foreach ( ['error', 'warning', 'success', 'info'] as $type_message )
            @if( Session::has('alert-' . $type_message) )
                @foreach (Session::get('alert-' . $type_message) as $message)
                    await Toast.fire({
                        icon: '{{ $type_message }}',
                        title: '{{ $message }}'
                    })
                @endforeach
            @endif
        @endforeach
    });
</script>

