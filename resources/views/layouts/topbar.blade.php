<?php
    $user = Auth::user();
?>

<div class="navbar-custom">
    <ul class="list-unstyled topbar-menu float-end mb-0">

        {{-- serach box for sm --}}
        <li class="dropdown notification-list d-lg-none">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-search noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                <form class="p-3">
                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                </form>
            </div>
        </li>

        {{-- lang --}}
        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                @if (app()->getLocale() == 'bn')
                    <img src="{{ asset('images/flags/bd.png') }}" alt="English" class="me-0 me-sm-1" height="12"> 
                    <span class="align-middle d-none d-sm-inline-block">Bangla</span>
                @else
                    <img src="{{ asset('images/flags/us.jpg') }}" alt="English" class="me-0 me-sm-1" height="12"> 
                    <span class="align-middle d-none d-sm-inline-block">English</span> 
                @endif
                <i class="mdi mdi-chevron-down d-none d-sm-inline-block align-middle"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu">
                
                @if (app()->getLocale() == 'en')
                    <a href="{{ route('chang.lang','bn') }}" class="dropdown-item notify-item">
                        <img src="{{ asset('images/flags/bd.png') }}" alt="Bangla" class="me-1" height="12"> 
                        <span class="align-middle">Bangla</span>
                    </a>
                @else
                    <a href="{{ route('chang.lang','en') }}" class="dropdown-item notify-item">
                        <img src="{{ asset('images/flags/us.jpg') }}" alt="English" class="me-1" height="12"> 
                        <span class="align-middle">English</span>
                    </a>
                @endif

            </div>
        </li>

        {{-- notification --}}
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-bell noti-icon"></i>
                <span class="noti-icon-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated notification-dropdown-lg">

                
                <div class="dropdown-item noti-title px-3">
                    <h5 class="m-0">
                        <span class="float-end">
                            <a href="javascript: void(0);" class="text-dark">
                                <small>Clear All</small>
                            </a>
                        </span>Notification 
                    </h5>
                </div>

                {{-- before loading  Notifications --}}
                {{-- 
                    <div class="text-center">
                        <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                    </div>
                    --}}
                {{--  --}}

                <a href="javascript:void(0);" 
                    class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-0 
                    border-start-0 
                    border-end-0"
                >
                    <div class="card-body py-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="notify-icon bg-primary">
                                    <i class="mdi mdi-comment-account-outline"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 text-truncate ms-2">
                                <h5 class="noti-item-title fw-semibold font-14 m-0">
                                    Order No. #999999999999
                                    {{-- {title} --}}
                                    <small class="fw-normal text-muted ms-1 float-end">1 min ago</small>
                                </h5>
                                <small class="noti-item-subtitle text-muted">
                                    Updated by masud. 
                                    {Description}
                                </small>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="javascript:void(0);" 
                    class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-0 
                    border-start-0 
                    border-end-0"
                >
                    <div class="card-body py-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="notify-icon bg-primary">
                                    <i class="mdi mdi-comment-account-outline"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 text-truncate ms-2">
                                <h5 class="noti-item-title fw-semibold font-14 m-0">
                                    Order No. #999999999999
                                    {{-- {title} --}}
                                    <small class="fw-normal text-muted ms-1 float-end">1 min ago</small>
                                </h5>
                                <small class="noti-item-subtitle text-muted">
                                    Updated by masud. 
                                    {Description}
                                </small>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- All-->
                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                    View All
                </a>

            </div>
        </li>

        <li class="dropdown notification-list d-none d-sm-inline-block">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-view-apps noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated social-link-dropdown-lg p-0">

                <div class="p-2">
                    <div class="row">
                        <div class="col">
                            <a class="dropdown-icon-item" href="#dynamin-url" style="border: 1px solid #d1cce4;">
                                <img src="{{ asset('images/brands/facebook.png') }}" alt="slack">
                                <span>Facebook</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#dynamin-url" style="border: 1px solid #d8c1cd;">
                                <img src="{{ asset('images/brands/instagram.png') }}" alt="slack">
                                <span>Instagram</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#dynamin-url" style="border: 1px solid #dac7c7;">
                                <img src="{{ asset('images/brands/youtube.png') }}" alt="slack">
                                <span>Youtube</span>
                            </a>
                        </div>
                        <div class="col mt-2">
                            <a class="dropdown-icon-item" href="#dynamin-url" style="border: 1px solid #c3d8d6;">
                                <img src="{{ asset('images/brands/twitter.png') }}" alt="slack">
                                <span>Twitter</span>
                            </a>
                        </div>
                        <div class="col mt-2">
                            <a class="dropdown-icon-item" href="#dynamin-url"  style="border: 1px solid #c3c5df;">
                                <img src="{{ asset('images/brands/linkedin.png') }}" alt="slack">
                                <span>Linkedin</span>
                            </a>
                        </div>
                        <div class="col mt-2">
                            <a class="dropdown-icon-item" href="https://web.whatsapp.com/"  style="border: 1px solid #cce4d2;">
                                <img src="{{ asset('images/brands/whatsapp.png') }}" alt="slack">
                                <span>Whatsapp</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false">
                <span class="account-user-avatar"> 
                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="rounded-circle">
                </span>
                <span>
                    <span class="account-user-name">{{ $user->name }}</span>
                    <span class="account-position">{{ ConvertToLang($user->role) }}</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0 text-center text-uppercase font-weight-bold" style="font-size: 13px">Welcome !</h6>
                </div>

                <a href="{{ route('profile.show') }}" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle me-1"></i>
                    <span>My Account Settings</span>
                </a>

                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-lock-outline me-1"></i>
                    <span>Lock Screen</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="dropdown-item notify-item"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        <i class="mdi mdi-logout me-1"></i>
                        {{ __('Logout') }}
                    </a>
                </form>
            </div>
        </li>

    </ul>
    <button class="button-menu-mobile open-left" id="open_left">
        <i class="mdi mdi-menu"></i>
    </button>
    <div class="app-search dropdown d-none d-lg-block">
        {{-- serach box for md --}}
        <form>
            <div class="input-group">
                <input type="text" class="form-control dropdown-toggle"  placeholder="Search..." id="top-search">
                <span class="mdi mdi-magnify search-icon"></span>
                <button class="input-group-text btn-primary" type="submit">Search</button>
            </div>
        </form>

        <div class="dropdown-menu dropdown-menu-animated search-dropdown-lg" id="search-dropdown">
            <!-- item-->
            <div class="dropdown-header noti-title">
                <h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>
            </div>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="uil-notes font-16 me-1"></i>
                <span>Analytics Report</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="uil-life-ring font-16 me-1"></i>
                <span>How can I help you?</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="uil-cog font-16 me-1"></i>
                <span>User profile settings</span>
            </a>

            <!-- item-->
            <div class="dropdown-header noti-title">
                <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
            </div>

            <div class="notification-list">

                {{-- 
                
                foreach for search item 
                it shuold be done by reactjs
                
                 --}}
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="d-flex">
                        {{-- <img class="d-flex me-2 rounded-circle" src="assets/images/users/avatar-2.jpg" alt="Generic placeholder image" height="32"> --}}
                        <div class="w-100">
                            <h5 class="m-0 font-14">Erwin Brown</h5>
                            <span class="font-12 mb-0">UI Designer</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>