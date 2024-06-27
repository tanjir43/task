<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    @include('components.user-meta-component')
    @include('components.user-style-component')
</head>

<body style="background-color:#f3f6fb !important;">
    @if (isset($university_details_page))
    @else
        @include('components.user-header-component')
    @endif
    @empty($body_class)
        @include('components.user-article-component')
    @endisset
    <div id="body" class="csh-theme-background-color-light {{ @$body_class }}">
        @if (isset($body_class))
            @if (isset($university_details_page) && $university_details_page == 'yes')
                <div class="header-image">
                    <div class="container">
                        <div class="header-image-cta">
                            <h1>Study at Wrocław University of Science and Technology</h1>
                            <h2>Wroclaw, Poland</h2>
                        </div>
                    </div>
                    <img alt="Study in Europe" title="Study in Europe" src="{{ asset('eu-map.jpg') }}" />
                </div>
            @endif
            <div class="csh-wrapper csh-wrapper-full csh-wrapper-large">
                <div class="csh-article">
                    @yield('body')
                </div>
            </div>
        @else
            <div class="csh-wrapper">
                <div role="main" class="csh-home">
                    @yield('body')
                </div>
            </div>
        @endif
    </div>
    @include('components.user-footer-component')
    @include('components.user-script-component')
</body>

</html>
