@extends('layouts.app')

@section('body')

    <style>
        .csh-home section .csh-home-list {
            font-size: 0;
            margin-top: 30px;
            display: grid;
            grid-template-columns: repeat(4,1fr) !important;
            column-gap: 24px;
            row-gap: 16px;
            }

        .csh-home section .csh-home-list li a .csh-home-list-image {
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            width: 40px !important;
            height: 40px !important;
            overflow: hidden;
            display: block;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            -ms-border-radius: 10px;
            -o-border-radius: 10px;
            border-radius: 10px;
        }
    </style>
    <section data-type="categories">
        <h1 class="csh-home-title csh-text-wrap csh-font-sans-bold">
            Select Your Subject
        </h1>
        <ul role="list" class="csh-home-list csh-home-list-large">
            <li role="listitem">
                <a href="{{ route('search') }}" role="link" class="csh-box csh-box-link csh-font-sans-regular">
                    <span style="
                        background-image: url({{ asset('subject_icon/arts.svg') }});
                        "
                        class="csh-home-list-image">
                    </span>
                    <span class="csh-home-list-aside">
                        <span class="csh-home-list-category">
                            <span data-has-category="true" class="csh-home-list-university">Art, Design & Media</span>
                        </span>
                    </span>
                </a>
            </li>

            <li role="listitem">
                <a href="category/getting-started-z4vtrk/index.html" role="link"
                    class="csh-box csh-box-link csh-font-sans-regular"><span
                        style="
                            background-image: url({{ asset('subject_icon/business.svg') }});
                            "
                        class="csh-home-list-image">
                    </span>
                    <span class="csh-home-list-aside">
                        <span class="csh-home-list-category">
                            <span data-has-category="true" class="csh-home-list-university">Business & Management</span>
                        </span>
                    </span>
                </a>
            </li>
            <li role="listitem">
                <a href="category/getting-started-z4vtrk/index.html" role="link"
                    class="csh-box csh-box-link csh-font-sans-regular"><span
                        style="
              background-image: url({{ asset('subject_icon/computer.svg') }});
            "
                        class="csh-home-list-image"></span><span class="csh-home-list-aside">
                        <span class="csh-home-list-category">
                            <span data-has-category="true" class="csh-home-list-university">Computer Science & IT</span>
                        </span>
                    </span>
                </a>
            </li>

            <li role="listitem">
                <a href="category/getting-started-z4vtrk/index.html" role="link"
                    class="csh-box csh-box-link csh-font-sans-regular">
                    <span style="
              background-image: url({{ asset('subject_icon/engineering.svg') }});
            "
                        class="csh-home-list-image">
                    </span>
                    <span class="csh-home-list-aside">
                        <span class="csh-home-list-category">
                            <span data-has-category="true" class="csh-home-list-university">Engineering & Technology</span>
                        </span>
                    </span>
                </a>
            </li>

            <li role="listitem">
                <a href="category/getting-started-z4vtrk/index.html" role="link"
                    class="csh-box csh-box-link csh-font-sans-regular">
                    <span style="
              background-image: url({{ asset('subject_icon/environment.svg') }});
            "
                        class="csh-home-list-image">
                    </span>
                    <span class="csh-home-list-aside">
                        <span class="csh-home-list-category"><span data-has-category="true"
                                class="csh-home-list-university">Environment & Agriculture</span></span>
                    </span>
                </a>
            </li>

            <li role="listitem">
                <a href="category/getting-started-z4vtrk/index.html" role="link"
                    class="csh-box csh-box-link csh-font-sans-regular">
                    <span style="
              background-image: url({{ asset('subject_icon/humanities.svg') }});
            "
                        class="csh-home-list-image">
                    </span>
                    <span class="csh-home-list-aside">
                        <span class="csh-home-list-category">
                            <span data-has-category="true" class="csh-home-list-university">Humanities</span>
                        </span>
                    </span>
                </a>
            </li>
            <li role="listitem">
                <a href="category/getting-started-z4vtrk/index.html" role="link"
                    class="csh-box csh-box-link csh-font-sans-regular">
                    <span style="
              background-image: url({{ asset('subject_icon/law.svg') }});
            "
                        class="csh-home-list-image"></span>
                    <span class="csh-home-list-aside">
                        <span class="csh-home-list-category">
                            <span data-has-category="true" class="csh-home-list-university">Law</span>
                        </span>
                    </span>
                </a>
            </li>

            <li role="listitem">
                <a href="category/getting-started-z4vtrk/index.html" role="link"
                    class="csh-box csh-box-link csh-font-sans-regular">
                    <span style="
              background-image: url({{ asset('subject_icon/medicine.svg') }});
            "
                        class="csh-home-list-image">
                    </span>
                    <span class="csh-home-list-aside">
                        <span class="csh-home-list-category">
                            <span data-has-category="true" class="csh-home-list-university">Medicine & Health</span>
                        </span>
                    </span>
                </a>
            </li>

            <li role="listitem">
                <a href="category/getting-started-z4vtrk/index.html" role="link"
                    class="csh-box csh-box-link csh-font-sans-regular">
                    <span style="
              background-image: url({{ asset('subject_icon/natural-sciences.svg') }});
            "
                        class="csh-home-list-image">
                    </span>
                    <span class="csh-home-list-aside">
                        <span class="csh-home-list-category">
                            <span data-has-category="true" class="csh-home-list-university">Natural Sciences &
                                Mathematics</span>
                        </span>
                    </span>
                </a>
            </li>
            <li role="listitem">
                <a href="category/getting-started-z4vtrk/index.html" role="link"
                    class="csh-box csh-box-link csh-font-sans-regular">
                    <span style="
              background-image: url({{ asset('subject_icon/social.svg') }});
            "
                        class="csh-home-list-image">
                    </span>
                    <span class="csh-home-list-aside">
                        <span class="csh-home-list-category">
                            <span data-has-category="true" class="csh-home-list-university custom-text">Social
                                Sciences</span>
                        </span>
                    </span>
                </a>
            </li>

        </ul>
    </section>
@endsection
