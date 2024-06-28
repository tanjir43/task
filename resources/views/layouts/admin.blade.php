<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" translate="{{ env('TRANSLATE', 0) }}">

<head>
    <x-admin-meta-component />

    <title>{{ config('app.name', 'Abroad') }}</title>

    <x-admin-style-component />

    @yield('css')
</head>

<body class="show" data-layout-color="light" data-layout-mode="fluid" data-rightbar-onstart="true"
    data-leftbar-theme="dark">

    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="content-page">
            <div class="content">
                @include('layouts.topbar')

                <div class="container-fluid mt-2">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <x-admin-script-component />
    <script>
        $('.flag-icon').on('click', function(e) {
            e.preventDefault();
            toastr.error('Sorry! This is an upcoming feature.');
        });
     
    </script>
</body>

</html>
