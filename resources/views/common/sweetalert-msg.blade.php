<script>
    $(document).ready(function () {
        setTimeout(function () {
            @if(isset($common_data->alert_type) && ($common_data->alert_type == 'toastr'))
                @if (session('error'))
                toastr.error('{{Session::get("error")}}', 'Error!');
                @endif
                @if (session('failed'))
                toastr.error('{{Session::get("failed")}}', 'Error!');
                @endif
                @if (session('success'))
                toastr.success('{{Session::get("success")}}', 'Success');
                @endif
            @elseif(session('alert_type') && (session('alert_type') == 'toastr'))
                @if (session('error'))
                toastr.error('{{Session::get("error")}}', 'Error!');
                @endif
                @if (session('failed'))
                toastr.error('{{Session::get("failed")}}', 'Error!');
                @endif
                @if (session('success'))
                toastr.success('{{Session::get("success")}}', 'Success');
                @endif
            @else
                @if($errors->any())
                Swal.fire({
                    confirmButtonText: 'OKAY',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    title: 'Error',
                    html: 'Form Validation Error!',
                    icon: 'error',
                    width: '300px',
                    customClass: {
                        confirmButton: 'btn btn-danger swal-okay-button',
                        title: 'swal-title',
                        content: 'swal-subtitle'
                    }
                });
                beep();
                @endif

                @if (session('error'))
                Swal.fire({
                    confirmButtonText: 'OKAY',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    title: 'Error',
                    html: '{{Session::get("error")}}',
                    icon: 'error',
                    width: '300px',
                    customClass: {
                        confirmButton: 'btn btn-danger swal-okay-button',
                        title: 'swal-title',
                        content: 'swal-subtitle'
                    }
                });
                beep();
                @endif

                @if (session('failed'))
                Swal.fire({
                    confirmButtonText: 'OKAY',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    title: 'Error',
                    html: '{{Session::get("failed")}}',
                    icon: 'error',
                    width: '300px',
                    customClass: {
                        confirmButton: 'btn btn-danger swal-okay-button',
                        title: 'swal-title',
                        content: 'swal-subtitle'
                    }
                });
                $(document).ready(function () {
                    beep();
                });
                @endif

                @if (session('success'))
                Swal.fire({
                    confirmButtonText: 'OKAY',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    title: 'Success',
                    html: '{{Session::get("success")}}',
                    icon: 'success',
                    width: '300px',
                    customClass: {
                        confirmButton: 'btn geo-primary swal-okay-button',
                        title: 'swal-title',
                        content: 'swal-subtitle'
                    }
                });
                @endif
            @endif
        }, 300);
    });
</script>
