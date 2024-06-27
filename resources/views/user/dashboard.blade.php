@extends('layouts.app')

@section('css')
<link rel="stylesheet" media="screen" href="{{asset('home/vendor/simplebar/dist/simplebar.min.css')}}"/>
<link rel="stylesheet" media="screen" href="{{asset('home/vendor/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css')}}"/>
<link rel="stylesheet" media="screen" href="{{asset('home/vendor/filepond/dist/filepond.min.css')}}"/>
@endsection

@section('content')
    <!-- Page content-->
    <div class="container pt-5 pb-lg-4 mt-5 mb-sm-2" style="background-color:#c1e2bf ">
    <!-- Breadcrumb-->
    <nav class="mb-4 pt-md-3" aria-label="Breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="real-estate-home-v1.html">Home</a></li>
        <li class="breadcrumb-item"><a href="real-estate-account-info.html">Account</a></li>
        <li class="breadcrumb-item active" aria-current="page">Personal Info</li>
        </ol>
    </nav>
    <!-- Page content-->
    <div class="row">
        <!-- Sidebar-->
        <aside class="col-lg-4 col-md-5 pe-xl-4 mb-5">
        <!-- Account nav-->
        <div class="card card-body border-0 shadow-sm pb-1 me-lg-1" style="background-color:#bee4bb " >
            <div class="d-flex d-md-block d-lg-flex align-items-start pt-lg-2 mb-4"><img class="rounded-circle" src="{{asset('images/rs_logo.png')}}" width="48" alt="John doe">
            <div class="pt-md-2 pt-lg-0 ps-3 ps-md-0 ps-lg-3">
                <h2 class="fs-lg mb-0">{{$current_user->name}}</h2>
                <ul class="list-unstyled fs-sm mt-3 mb-0">
                <li><a class="nav-link fw-normal p-0" href="tel:{{$current_user->phone}}"><i class="fi-phone opacity-60 me-2"></i>{{$current_user->phone ?? ''}}</a></li>
                <li><a class="nav-link fw-normal p-0" href="mailto:{{$current_user->email}}"><i class="fi-mail opacity-60 me-2"></i>{{$current_user->email ?? ''}}</a></li>
                </ul>
            </div>
            @if (!empty($attendance_detail->in_time))
                </div><a class="btn btn-primary btn-lg w-100 mb-3"  href="#"><i class="fi-plus me-2"></i>Add Today Out Time</a><a class="btn btn-outline-secondary d-block d-md-none w-100 mb-3" href="#account-nav" data-bs-toggle="collapse"><i class="fi-align-justify me-2"></i>Menu</a>

            @else
            </div><a class="btn btn-success btn-lg w-100 mb-3"  href="{{route('create.attendance')}}"><i class="fi-plus me-2"></i>Add Today In Time</a><a class="btn btn-outline-primary d-block d-md-none w-100 mb-3" href="#account-nav" data-bs-toggle="collapse"><i class="fi-align-justify me-2"></i>Menu</a>

            @endif
            
            <div class="collapse d-md-block mt-3" id="account-nav">
            <div class="card-nav">
                <a class="card-nav-link active" href="#"><i class="fi-user opacity-60 me-2"></i>Personal Info</a>
                <a class="card-nav-link" href="#"><i class="fi-lock opacity-60 me-2"></i>Password &amp; Security</a>
                <a class="card-nav-link" href="{{route('logout')}}"><i class="fi-logout opacity-60 me-2"></i>Sign Out</a></div>
            </div>
        </div>
        </aside>
        <!-- Content-->
        <div class="col-lg-8 col-md-7 mb-5">
        <h1 class="h2 pb-3 mb-4">Personal Info</h1>
       
        <label class="form-label pt-2" for="account-bio">Short bio</label>
        <div class="row pb-2">
            <div class="col-lg-9 col-sm-8 mb-4">
            <textarea class="form-control" id="account-bio" rows="6" placeholder="Write your bio here. It will be displayed on your public profile."></textarea>
            </div>
            <div class="col-lg-3 col-sm-4 mb-4">
            <input class="file-uploader bg-secondary" type="file" accept="image/png, image/jpeg" data-label-idle="&lt;i class=&quot;d-inline-block fi-camera-plus fs-2 text-muted mb-2&quot;&gt;&lt;/i&gt;&lt;br&gt;&lt;span class=&quot;fw-bold&quot;&gt;Change picture&lt;/span&gt;" data-style-panel-layout="compact" data-image-preview-height="160" data-image-crop-aspect-ratio="1:1" data-image-resize-target-width="200" data-image-resize-target-height="200">
            </div>
        </div>
        <div class="border rounded-3 p-3 mb-4" id="personal-info">
            <!-- Name-->
            <div class="border-bottom pb-3 mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="pe-2">
                <label class="form-label fw-bold">Full name</label>
                <div id="name-value">{{$current_user->name}}</div>
                </div>
                <div class="me-n3" data-bs-toggle="tooltip" title="Edit"><a class="nav-link py-0" href="#name-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
            </div>
            <div class="collapse" id="name-collapse" data-bs-parent="#personal-info">
                <input class="form-control mt-3" name="name" type="text" data-bs-binded-element="#name-value" placeholder="{{$current_user->name}}" data-bs-unset-value="Not specified" value="{{old($current_user->name)}}">
            </div>
            </div>
            <!-- Email-->
            <div class="border-bottom pb-3 mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="pe-2">
                <label class="form-label fw-bold">Email</label>
                <div id="email-value">{{$current_user->email}}</div>
                </div>
                <div class="me-n3" data-bs-toggle="tooltip" title="Edit"><a class="nav-link py-0" href="#email-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
            </div>
            <div class="collapse" id="email-collapse" data-bs-parent="#personal-info">
                <input class="form-control mt-3" name="email" type="email" data-bs-binded-element="#email-value" data-bs-unset-value="Not specified" placeholder="{{$current_user->email}}" value="{{old($current_user->email)}}">
            </div>
            </div>
            <!-- Phone number-->
            <div class="border-bottom pb-3 mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="pe-2">
                <label class="form-label fw-bold">Phone number</label>
                <div id="phone-value">{{$current_user->phone ?? ''}}</div>
                </div>
                <div class="me-n3" data-bs-toggle="tooltip" title="Edit"><a class="nav-link py-0" href="#phone-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
            </div>
            <div class="collapse" id="phone-collapse" data-bs-parent="#personal-info">
                {{-- <input class="form-control mt-3" type="text" data-bs-binded-element="#phone-value" name="phone" placeholder="{{$current_user->phone ?? ''}}" data-bs-unset-value="Not specified" value="{{old($current_user->phone)}}"> --}}
            </div>
            </div>
            <!-- Company name-->
            <div class="border-bottom pb-3 mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="pe-2">
                <label class="form-label fw-bold">Company name</label>
                <div id="company-value">Not specified</div>
                </div>
                <div class="me-n3" data-bs-toggle="tooltip" title="Edit"><a class="nav-link py-0" href="#company-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
            </div>
            <div class="collapse" id="company-collapse" data-bs-parent="#personal-info">
                <input class="form-control mt-3" type="text" data-bs-binded-element="#company-value" data-bs-unset-value="Not specified" placeholder="Enter company name">
            </div>
            </div>
            <!-- Address-->
            <div>
            <div class="d-flex align-items-center justify-content-between">
                <div class="pe-2">
                <label class="form-label fw-bold">Address</label>
                <div id="address-value">Not specified</div>
                </div>
                <div class="me-n3" data-bs-toggle="tooltip" title="Edit"><a class="nav-link py-0" href="#address-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
            </div>
            <div class="collapse" id="address-collapse" data-bs-parent="#personal-info">
                <input class="form-control mt-3" type="text" data-bs-binded-element="#address-value" data-bs-unset-value="Not specified" placeholder="Enter address">
            </div>
            </div>
        </div>
        <!-- Socials-->
        <div class="pt-2">
            <label class="form-label fw-bold mb-3">Socials</label>
        </div>
        <div class="d-flex align-items-center mb-3">
            <div class="btn btn-icon btn-light btn-xs shadow-sm rounded-circle pe-none flex-shrink-0 me-3"><i class="fi-facebook text-body"></i></div>
            <input class="form-control" type="text" placeholder="Your Facebook account">
        </div>
        <div class="d-flex align-items-center mb-3">
            <div class="btn btn-icon btn-light btn-xs shadow-sm rounded-circle pe-none flex-shrink-0 me-3"><i class="fi-linkedin text-body"></i></div>
            <input class="form-control" type="text" placeholder="Your LinkedIn account">
        </div>
        <div class="d-flex align-items-center mb-3">
            <div class="btn btn-icon btn-light btn-xs shadow-sm rounded-circle pe-none flex-shrink-0 me-3"><i class="fi-twitter text-body"></i></div>
            <input class="form-control" type="text" placeholder="Your Twitter account">
        </div>
        <div class="collapse" id="showMoreSocials">
            <div class="d-flex align-items-center mb-3">
            <div class="btn btn-icon btn-light btn-xs shadow-sm rounded-circle pe-none flex-shrink-0 me-3"><i class="fi-instagram text-body"></i></div>
            <input class="form-control" type="text" placeholder="Your Instagram account">
            </div>
            <div class="d-flex align-items-center mb-3">
            <div class="btn btn-icon btn-light btn-xs shadow-sm rounded-circle pe-none flex-shrink-0 me-3"><i class="fi-pinterest text-body"></i></div>
            <input class="form-control" type="text" placeholder="Your Pinterest account">
            </div>
        </div><a class="collapse-label collapsed d-inline-block fs-sm fw-bold text-decoration-none pt-2 pb-3" href="#showMoreSocials" data-bs-toggle="collapse" data-bs-label-collapsed="Show more" data-bs-label-expanded="Show less" role="button" aria-expanded="false" aria-controls="showMoreSocials"><i class="fi-arrow-down me-2"></i></a>
        <div class="d-flex align-items-center justify-content-between border-top mt-4 pt-4 pb-1">
            <button class="btn btn-primary px-3 px-sm-4" type="button">Save changes</button>
            <button class="btn btn-link btn-sm px-0" type="button"><i class="fi-trash me-2"></i>Delete account</button>
        </div>
        </div>
    </div>
    </div>

@endsection

@section('js')
<script src="{{asset('home/vendor/simplebar/dist/simplebar.min.js')}}"></script>
<script src="{{asset('home/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js')}}"></script>
<script src="{{asset('home/vendor/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js')}}"></script>
<script src="{{asset('home/vendor/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js')}}"></script>
<script src="{{asset('home/vendor/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.min.js')}}"></script>
<script src="{{asset('home/vendor/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.min.js')}}"></script>
<script src="{{asset('home/vendor/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.min.js')}}"></script>
<script src="{{asset('home/vendor/filepond/dist/filepond.min.js')}}"></script>
@endsection