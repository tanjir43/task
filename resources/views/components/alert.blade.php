@if($type == 'error')
    @if(is_array($msg) || is_object($msg))
        @foreach($msg->all() as $key => $value)
            <script>
                $(document).ready(function () {
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'What are you doing',
                        //subtitle: 'Subtitle',
                        body: `Error! &nbsp;&nbsp;{{ $value }}&nbsp;&nbsp;`,
                        //autohide : true,
                        //delay: 5000
                    });
                });
            </script>
        @endforeach
    @else
        <script>
            $(document).ready(function () {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'What are you doing',
                    //subtitle: 'Subtitle',
                    body: `Error! &nbsp;&nbsp;{{ $msg }}&nbsp;&nbsp;`,
                    //autohide : true,
                    //delay: 5000
                });
            });
        </script>
    @endif
@elseif($type == 'success')
    @if(is_array($msg) || is_object($msg))
        @foreach($msg->all() as $key => $value)
            <script>
                $(document).ready(function () {
                    $(document).Toasts('create', {
                        class: 'bg-success',
                        title: 'Success',
                        //subtitle: 'Subtitle',
                        body: 'Wel done! &nbsp;&nbsp;{{ $msg }}&nbsp;&nbsp;',
                        autohide : true,
                        delay: 5000
                    });
                });
            </script>
        @endforeach
    @else
        <script>
            $(document).ready(function () {
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: 'Success',
                    //subtitle: 'Subtitle',
                    body: 'Wel done! &nbsp;&nbsp;{{ $msg }}&nbsp;&nbsp;',
                    autohide : true,
                    delay: 5000
                });
            });
        </script>
    @endif
@endif
