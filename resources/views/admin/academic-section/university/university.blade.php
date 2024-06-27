@extends('layouts.admin')
@section('css')
    <style>
        .row-gap-24 {
            row-gap: 24px;
        }
        .text-right {
            text-align: right!important;
        }
        .student-add-form .nav-tabs {
            background: #ffffff;
            padding: 10px;
            border-radius: 5px 5px 0px 0px;
            border-bottom: 1px solid #415094;
        }
        .nav {
            display: flex;
            flex-wrap: wrap;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
        }
        .student-add-form .nav-tabs .nav-link.active {
            background: #cad5f3;
            border-radius: 6px;
        }

        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            color: #495057;
            background-color: #f8fafc;
            border-color: #dee2e6 #dee2e6 #f8fafc;
        }
        .primary_file_uploader {
            position: relative;
        }
        .primary_file_uploader .primary_input_field {
            padding-bottom: 1px;
        }
        .primary_file_uploader .primary_input_field {
            padding-bottom: 1px;
        }

        .primary_file_uploader input {
            border: 1px solid rgba(130, 139, 178, 0.3) !important;
            font-size: 14px;
            color: #415094;
            padding-left: 20px;
            height: 46px;
            border-radius: 4px !important;
            width: 100%;
            padding-right: 15px;
            padding-bottom: 4px;
        }
        [type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
            cursor: pointer;
        }

        .primary_file_uploader button {
            position: absolute;
            right: 0;
            border: 0;
            top: 7px;
            right: 7px;
            padding: 0;
            background: transparent;
            z-index: 99;
        }

        .primary_file_uploader button {
            z-index: 0 !important;
        }

        .primary_file_uploader button {
            top: 8px !important;
            right: 8px !important;
        }

        .primary-btn.fix-gr-bg {
            background: -webkit-linear-gradient(90deg, var(--gradient_1) 0%, var(--gradient_2) 51%, var(--gradient_3) 100%) !important;
            background: -moz-linear-gradient(90deg, var(--gradient_1) 0%, var(--gradient_2) 51%, var(--gradient_3) 100%) !important;
            background: -o-linear-gradient(90deg, var(--gradient_1) 0%, var(--gradient_2) 51%, var(--gradient_3) 100%) !important;
            background: -ms-linear-gradient(90deg, var(--gradient_1) 0%, var(--gradient_2) 51%, var(--gradient_3) 100%) !important;
            background: linear-gradient(90deg, var(--gradient_1) 0%, var(--gradient_2) 51%, var(--gradient_3) 100%) !important;
            color: #f1f1f1 !important;
            /* background-size: 200% auto !important; */
            -webkit-transition: all 0.4s ease 0s !important;
            -moz-transition: all 0.4s ease 0s !important;
            -o-transition: all 0.4s ease 0s !important;
            transition: all 0.4s ease 0s !important;
        }

        .primary-btn.fix-gr-bg {
            background:#415094 !important;
        }

        .primary-btn.small {
            letter-spacing: 1px;
            line-height: 30px;
            border-radius: 50px;
            font-weight: 600;
        }

        .primary-btn {
            display: inline-block;
            color: var(--base_color);
            letter-spacing: 1px;
            font-family: "Poppins", sans-serif;
            font-size: 12px;
            font-weight: 500;
            line-height: 40px;
            padding: 0px 20px;
            outline: none !important;
            text-align: center;
            cursor: pointer;
            text-transform: uppercase;
            border: 0;
            border-radius: 5px;
            position: relative;
            overflow: hidden;
            -webkit-transition: all 0.4s ease 0s;
            -moz-transition: all 0.4s ease 0s;
            -o-transition: all 0.4s ease 0s;
            transition: all 0.4s ease 0s;
        }

        input, .primary_select, .primary_file_uploader input, textarea, .note-editor.note-frame .note-editing-area .note-editable {
            background: #ffffff !important;
        }

        .primary_file_uploader input {
            border: 1px solid rgba(130, 139, 178, 0.3) !important;
            font-size: 14px;
            color: var(--base_color);
            padding-left: 20px;
            height: 46px;
            border-radius: 30px;
            width: 100%;
            padding-right: 15px;
            padding-bottom: 4px;
        }
        .loader_style {
            margin-top: -30px;
            padding-right: 25px;
        }

        .form-section {
            background: #f5f5f561;
            padding: 20px;
            border-radius: 5px;
            height: 100%;
        }

        .stu-sub-head {
            font-size: 13px;
            text-transform: uppercase;
            color: #415094;
            font-weight: 500;
            margin-bottom: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(65, 80, 148, 0.3);
        }

        .primary_input_label {
            font-size: 12px;
            text-transform: uppercase;
            color: #828bb2;
            margin-bottom: 0;
            display: block;
            margin-bottom: 6px;
            font-weight: 400;
        }

        .primary_select {
            width: 100%;
            border: 1px solid rgba(130, 139, 178, 0.3);
            border-radius: 3px;
            height: 46px;
            line-height: 44px;
            font-size: 13px;
            color: var(--base_color);
            padding: 0px 25px;
            padding-left: 20px;
            font-weight: 300;
            border-radius: 4px;
        }

        option {
            font-weight: normal;
            display: block;
            min-height: 1.2em;
            padding: 0px 2px 1px;
            white-space: nowrap;
        }

        .primary_select .current {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            margin-right: 16px;
        }

        .nice-select .list,
        .nice-select .nice-select-search-box,
        .nice-select,
        .nice-select .nice-select-search,
        .dropdown-menu,
        .datepicker.dropdown-menu {
            background-color: #fff;
        }

        .nice-select .list,
        .nice-select .nice-select-search-box,
        .nice-select,
        .nice-select .nice-select-search,
        .dropdown-menu,
        .datepicker.dropdown-menu {
            background-color: #fff;
        }

        .nice-select .list {
            padding: 52px 0 0 !important;
        }

        .primary_select:after {
            border-bottom: 0;
            border-right: 0;
            content: '';
            display: block;
            height: 10px;
            margin-top: 0;
            pointer-events: none;
            position: absolute;
            right: 14px;
            top: 10%;
            -webkit-transition: all 0.15s ease-in-out;
            transition: all 0.15s ease-in-out;
            width: auto;
            right: 25px;
            content: '\f0d7';
            border: 0;
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            color: #828bb2;
            font-size: 14px;
            transform: translateY(-58%) rotate(0deg);
        }
    </style>
@endsection
@section('content')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <form method="POST" action="{{route('university.store')}}" accept-charset="UTF-8"
                class="form-horizontal" enctype="multipart/form-data" id="university_form">
                @csrf
                <div class="row">
                    <div class="col-lg-12">

                        <div class="white-box">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-sm-6 col-5">
                                    <div class="main-title my-0 xs_mt_0 mt_0_sm">
                                        <h3 class="mb-15">Add Student</h3>
                                    </div>
                                </div>
                                <div class="offset-lg-3 col-lg-3 text-right col-sm-6 col-7">
                                    <a href=""
                                        class="primary-btn small fix-gr-bg">
                                        <span class="ti-plus pr-2"></span>
                                        Import University </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 student-add-form">
                                    <ul class="nav nav-tabs tabs_scroll_nav px-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#basic_info" role="tab"
                                                data-toggle="tab">Basic Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#seos_info" role="tab"
                                                data-toggle="tab">SEO's INFO</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#social_links_info" role="tab"
                                                data-toggle="tab">Social Links Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#application_fees_info" role="tab"
                                                data-toggle="tab">Application Fees Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#tution_fees_info" role="tab" data-toggle="tab">Tution Fees Info</a>
                                        </li>
                                       
                                        <li class="nav-item flex-grow-1 text-right">
                                            <div class="">
                                            </div>
                                            <button class="primary-btn fix-gr-bg submit" id="_submit_btn_admission" data-toggle="tooltip" title="" data-original-title="">
                                                <span class="ti-check"></span>
                                                Save Student 
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-12">
                                    <div class="student-add-form-container">
                                        <div class="tab-content">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane fade show active" id="basic_info">
                                                <div class="row pt-4 row-gap-24">
                                                    <div class="col-lg-6">
                                                        <div class="form-section">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="main-title">
                                                                        <h4 class="stu-sub-head">Location Information</h4>
                                                                    </div>
                                                                </div>

                                                                @include('common.search.area_search_criteria', [
                                                                    'mt' => 'mt-4',
                                                                    'div' => 'col-lg-6',
                                                                    'required' => ['country','city'],
                                                                    'visible' => ['country', 'city'],
                                                                ])

                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input " id="un_types">
                                                                        <label class="primary_input_label" for="">
                                                                            Types
                                                                            <span class="text-danger"> *</span>
                                                                        </label>
                                                                        <select class="primary_select form-control"
                                                                            name="un_type_id" id="un_type_id">
                                                                            <option data-display="Select Type * "
                                                                                value="">Select Type *
                                                                            </option>
                                                                            @foreach ($types as $id => $type)
                                                                                <option value="{{ $id }}">
                                                                                    {{ $type }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label" for="website"> Website </label>
                                                                        <input
                                                                            class="primary_input_field form-control"
                                                                            type="url" id="website" name="website"
                                                                            value="{{ isset($editData) ? $editData->website : old('website') }}"
                                                                        />
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label" for="application_website">Application Website </label>
                                                                        <input
                                                                            class="primary_input_field form-control"
                                                                            type="url" id="application_website"
                                                                            name="application_website" 
                                                                            value="{{ isset($editData) ? $editData->application_website : old('application_website') }}"
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input">
                                                                        <label class="primary_input_label"
                                                                            for="maps"> Maps
                                                                        </label>
                                                                        <input 
                                                                            class="primary_input_field  form-control" id="maps"
                                                                            type="url"  name="maps" 
                                                                            value="{{ isset($editData) ? $editData->maps : old('maps') }}"
                                                                        />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-section">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="main-title">
                                                                        <h4 class="stu-sub-head">Contact Information</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="name">Name <span
                                                                                class="text-danger"> *</span>
                                                                        </label>
                                                                        <input 
                                                                            class="primary_input_field form-control"
                                                                            type="text" name="name" id="name"
                                                                            value="{{ isset($editData) ? $editData->name : old('name') }}"
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="email">Email <span
                                                                                class="text-danger"> *</span>
                                                                        </label>
                                                                        <input 
                                                                            class="primary_input_field form-control"
                                                                            type="email" name="email" id="email"
                                                                            value="{{ isset($editData) ? $editData->email : old('email') }}"
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="common_admission_email">Admission Email
                                                                        </label>
                                                                        <input 
                                                                            class="primary_input_field form-control" id="common_admission_email"
                                                                            type="email" name="common_admission_email"
                                                                            value="{{ isset($editData) ? $editData->common_admission_email : old('common_admission_email') }}"
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="phone">Phone <span
                                                                                class="text-danger"> *</span>
                                                                        </label>
                                                                        <input 
                                                                            class="primary_input_field form-control" id="phone"
                                                                            type="text" name="phone"
                                                                            value="{{ isset($editData) ? $editData->phone : old('phone') }}"
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="alternative_phone">Alternative Phone
                                                                        </label>
                                                                        <input class="primary_input_field form-control" id="alternative_phone"
                                                                            type="text" name="alternative_phone"
                                                                            value="{{ isset($editData) ? $editData->alternative_phone : old('alternative_phone') }}"
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input">
                                                                        <label class="primary_input_label"
                                                                            for="founded">Founded <span
                                                                                class="text-danger"> *</span>
                                                                        </label>
                                                                        <input 
                                                                            class="primary_input_field  form-control" 
                                                                            type="text"  name="founded" id="founded"
                                                                            value="{{ isset($editData) ? $editData->founded : old('founded') }}"
                                                                        />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-section">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="main-title">
                                                                        <h4 class="stu-sub-head">Ranking Information</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="qs_ranking">QS Ranking
                                                                        </label>
                                                                        <input class="primary_input_field form-control" id="qs_ranking"
                                                                            type="number" name="qs_ranking"
                                                                            value="{{ isset($editData) ? $editData->founded : old('founded') }}"
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="the_world_ranking">World Ranking (THE)
                                                                        </label>
                                                                        <input class="primary_input_field form-control" id="the_world_ranking"
                                                                            type="text" name="the_world_ranking"
                                                                            value="{{ isset($editData) ? $editData->the_world_ranking : old('the_world_ranking') }}"
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input">
                                                                        <label class="primary_input_label" for="acceptance_rate">Acceptance Rate</label>
                                                                        <div class="input-group">
                                                                            <input 
                                                                                class="primary_input_field form-control" 
                                                                                id="acceptance_rate" type="number" name="acceptance_rate" 
                                                                                value="{{ isset($editData) ? $editData->acceptance_rate : old('acceptance_rate') }}">
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text">%</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-lg-12">

                                                                    <div class="row mt-40">
                                                                        <div class="col-lg-12">
                                                                            <div class="main-title">
                                                                                <h4 class="stu-sub-head">Address
                                                                                    Info </h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-6 mt-4">
                                                                            <div class="primary_input ">
                                                                                <label for="address" class="primary_input_label" for="">Address </label>
                                                                                <textarea class="primary_input_field form-control" cols="0" rows="3" name="address"
                                                                                    id="address"> {{ isset($editData) ? $editData->address : old('address') }}
                                                                                </textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 mt-4">
                                                                            <div class="primary_input">
                                                                                <label class="primary_input_label"
                                                                                    for="">Description
                                                                                </label>
                                                                                <textarea class="primary_input_field form-control" cols="0" rows="3" name="description"
                                                                                    id="description"> {{ isset($editData) ? $editData->description : old('description') }}
                                                                                </textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="col-lg-6">
                                                        <div class="form-section">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="main-title">
                                                                        <h4 class="stu-sub-head">Statistics</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="student_count">Total Students
                                                                        </label>
                                                                        <input 
                                                                            class="primary_input_field form-control" id="student_count"
                                                                            type="number" name="student_count"
                                                                            value="{{ isset($editData) ? $editData->student_count : old('student_count') }}"
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="staff_count">Total Staff
                                                                        </label>
                                                                        <input 
                                                                            class="primary_input_field form-control" id="staff_count"
                                                                            type="number" name="staff_count"
                                                                            value="{{ isset($editData) ? $editData->staff_count : old('staff_count') }}"
                                                                        />
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="alumni_count">Total Alumni
                                                                        </label>
                                                                        <input class="primary_input_field form-control" id="alumni_count"
                                                                            type="number" name="alumni_count"
                                                                            value="{{ isset($editData) ? $editData->alumni_count : old('alumni_count') }}"
                                                                        />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="international_students_count">Total Internation Student
                                                                        </label>
                                                                        <input class="primary_input_field form-control" id="international_students_count"
                                                                            type="number" name="international_students_count"
                                                                            value="{{ isset($editData) ? $editData->international_students_count : old('international_students_count') }}"
                                                                        />
                                                                    </div>
                                                                </div>
                                                               
                                                                <div class="col-lg-12">

                                                                    <div class="row mt-40">
                                                                        <div class="col-lg-12">
                                                                            <div class="main-title">
                                                                                <h4 class="stu-sub-head">Images </h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-6 mt-4">
                                                                            <div class="primary_input">
                                                                                <div class="primary_file_uploader">
                                                                                    <input class="primary_input_field form-control"
                                                                                        type="text" id="placeholderPhoto"
                                                                                        placeholder="Logo "
                                                                                        readonly="">
                                                                                    <button class="" type="button">
                                                                                        <label class="primary-btn small fix-gr-bg"
                                                                                            for="logo">Browse</label>
                                                                                        <input type="file" class="d-none"
                                                                                            name="logo" id="logo">
                                                                                    </button>
                                                                                </div>
                                                                                <div class="col-md-12 mt-15">
                                                                                    <img class="d-none previewImageSize" src=""
                                                                                        alt="" id="logoShow"
                                                                                        height="100%" width="100%">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6 mt-4">
                                                                            <div class="primary_input">
                                                                                <div class="primary_file_uploader">
                                                                                    <input class="primary_input_field form-control"
                                                                                        type="text" id="cover_photo"
                                                                                        placeholder="Cover Photo "
                                                                                        readonly="">
                                                                                    <button class="" type="button">
                                                                                        <label class="primary-btn small fix-gr-bg"
                                                                                            for="cover_photo">Browse</label>
                                                                                        <input type="file" class="d-none"
                                                                                            name="photo" id="cover_photo">
                                                                                    </button>
                                                                                </div>
                                                                                <div class="col-md-12 mt-15">
                                                                                    <img class="d-none previewImageSize" src=""
                                                                                        alt="" id="coverPhotoShow"
                                                                                        height="100%" width="100%">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div role="tabpanel" class="tab-pane fade" id="seos_info">
                                                <div class="row pt-4 row-gap-24">
                                                    <div class="col-lg-6 guardian_section">
                                                        <div class="form-section">
                                                            <div class="row m-0">
                                                                <div class="parent_details" id="parent_details">

                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="main-title">
                                                                                <h4 class="stu-sub-head">Default SEO </h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-6 mt-4">
                                                                            <div class="primary_input ">
                                                                                <label class="primary_input_label"
                                                                                    for="title">Title</label>
                                                                                <input
                                                                                    class="primary_input_field form-control"
                                                                                    type="text" name="title"
                                                                                    id="title" value="">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-lg-6 mt-4">
                                                                            <div class="primary_input ">
                                                                                <label class="primary_input_label"
                                                                                    for="keywords">Keywords</label>
                                                                                <input
                                                                                    class="primary_input_field form-control"
                                                                                    type="text" name="keywords"
                                                                                    id="keywords" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6 mt-4">
                                                                            <div class="primary_input ">
                                                                                <label class="primary_input_label"
                                                                                    for="author">Author</label>
                                                                                <input
                                                                                    class="primary_input_field form-control"
                                                                                    type="text" name="author"
                                                                                    id="author" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6 mt-4">
                                                                            <div class="primary_input ">
                                                                                <label class="primary_input_label"
                                                                                    for="canonical">Canonical</label>
                                                                                <input
                                                                                    class="primary_input_field form-control"
                                                                                    type="text" name="canonical"
                                                                                    id="canonical" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-12 mt-4">
                                                                            <div class="primary_input ">
                                                                                <label class="primary_input_label"
                                                                                    for="robots">Robots</label>
                                                                                <input
                                                                                    class="primary_input_field form-control"
                                                                                    type="text" name="robots"
                                                                                    id="robots" value="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12 mt-4">
                                                                            <div class="primary_input ">
                                                                                <label class="primary_input_label"
                                                                                    for="seo_description">Description </label>
                                                                                <textarea class="primary_input_field form-control" cols="0" rows="3" name="seo_description"
                                                                                    id="seo_description"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>

                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 guardian_section">
                                                        <div class="form-section">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="main-title">
                                                                        <h4 class="stu-sub-head">Meta SEO </h4>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="og_title">OG Title </label>
                                                                        <input class="primary_input_field form-control"
                                                                            type="text" name="og_title"
                                                                            id="og_title" value="">

                                                                    </div>
                                                                </div>
                                                                

                                                                

                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="og_url">OG URL </label>
                                                                        <input class="primary_input_field form-control"
                                                                            type="text" name="og_url"
                                                                            id="og_url" value="">

                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="og_type">OG Type </label>
                                                                        <input class="primary_input_field form-control"
                                                                            type="text" name="og_type"
                                                                            id="og_type" value="">

                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="og_site_name">OG Site Name </label>
                                                                        <input class="primary_input_field form-control"
                                                                            type="text" name="og_site_name"
                                                                            id="og_site_name" value="">

                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 mt-4">
                                                                    <div class="primary_input">
                                                                        <div class="primary_file_uploader">
                                                                            <input class="primary_input_field form-control"
                                                                                type="text" id="placeholderPhoto"
                                                                                placeholder="OG Image "
                                                                                readonly="">
                                                                            <button class="" type="button">
                                                                                <label class="primary-btn small fix-gr-bg"
                                                                                    for="og_image">Browse</label>
                                                                                <input type="file" class="d-none"
                                                                                    name="og_image" id="og_image">
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-md-12 mt-15">
                                                                            <img class="d-none previewImageSize" src=""
                                                                                alt="" id="logoShow"
                                                                                height="100%" width="100%">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 mt-4">
                                                                    <div class="primary_input">
                                                                        <label class="primary_input_label"
                                                                            for="">OG Description
                                                                        </label>
                                                                        <textarea class="primary_input_field form-control" cols="0" rows="3" name="og_description"
                                                                            id="og_description"></textarea>


                                                                    </div>
                                                                </div>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="row pt-4 row-gap-24">
                                                    <div class="col-lg-6 guardian_section">
                                                        <div class="form-section">
                                                            <div class="row m-0">
                                                                <input type="hidden" name="staff_parent"
                                                                    id="staff_parent">
                                                              
                                                                <div class="parent_details" id="parent_details">

                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="main-title">
                                                                                <h4 class="stu-sub-head">Twitter Meta Tags </h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">

                                                                        <div class="col-lg-6 mt-4">
                                                                            <div class="primary_input ">
                                                                                <label class="primary_input_label"
                                                                                    for="twitter_card">Twitter Card</label>
                                                                                <input
                                                                                    class="primary_input_field form-control"
                                                                                    type="text" name="twitter_card"
                                                                                    id="twitter_card" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6 mt-4">
                                                                            <div class="primary_input ">
                                                                                <label class="primary_input_label"
                                                                                    for="twitter_site">Twitter Site</label>
                                                                                <input
                                                                                    class="primary_input_field form-control"
                                                                                    type="text" name="twitter_site"
                                                                                    id="twitter_site" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6 mt-4">
                                                                            <div class="primary_input ">
                                                                                <label class="primary_input_label"
                                                                                    for="twitter_creator">Twitter Creator</label>
                                                                                <input
                                                                                    class="primary_input_field form-control"
                                                                                    type="text" name="twitter_creator"
                                                                                    id="twitter_creator" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6 mt-4">
                                                                            <div class="primary_input ">
                                                                                <label class="primary_input_label"
                                                                                    for="twitter_title">Twitter Title</label>
                                                                                <input
                                                                                    class="primary_input_field form-control"
                                                                                    type="text" name="twitter_title"
                                                                                    id="twitter_title" value="">
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-lg-12 mt-4">
                                                                            <div class="primary_input">
                                                                                <div class="primary_file_uploader">
                                                                                    <input class="primary_input_field form-control"
                                                                                        type="text" id="placeholderPhoto"
                                                                                        placeholder="Twitter Image "
                                                                                        readonly="">
                                                                                    <button class="" type="button">
                                                                                        <label class="primary-btn small fix-gr-bg"
                                                                                            for="twitter_image">Browser</label>
                                                                                        <input type="file" class="d-none"
                                                                                            name="twitter_image" id="twitter_image">
                                                                                    </button>
                                                                                </div>
                                                                                <div class="col-md-12 mt-15">
                                                                                    <img class="d-none previewImageSize" src=""
                                                                                        alt="" id="logoShow"
                                                                                        height="100%" width="100%">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        
                                                                       
                                                                        <div class="col-lg-12 mt-4">
                                                                            <div class="primary_input ">
                                                                                <label class="primary_input_label"
                                                                                    for="twitter_description">Twitter Description </label>
                                                                                <textarea class="primary_input_field form-control" cols="0" rows="3" name="twitter_description"
                                                                                    id="twitter_description"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>

                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 guardian_section">
                                                        <div class="form-section">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="main-title">
                                                                        <h4 class="stu-sub-head">Others Meta SEO </h4>
                                                                    </div>
                                                                </div>


                                                                
                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="linkedin_title">LinkedIn Title </label>
                                                                        <input class="primary_input_field form-control"
                                                                            type="text" name="linkedin_title"
                                                                            id="linkedin_title" value="">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="pinterest_title">Pinterest Title </label>
                                                                        <input class="primary_input_field form-control"
                                                                            type="text" name="pinterest_title"
                                                                            id="pinterest_title" value="">
                                                                    </div>
                                                                </div>
                                                                

                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input">
                                                                        <div class="primary_file_uploader">
                                                                            <input class="primary_input_field form-control"
                                                                                type="text" id="placeholderPhoto"
                                                                                placeholder="LinkedIn Image "
                                                                                readonly="">
                                                                            <button class="" type="button">
                                                                                <label class="primary-btn small fix-gr-bg"
                                                                                    for="linkedin_image">Browser</label>
                                                                                <input type="file" class="d-none"
                                                                                    name="linkedin_image" id="linkedin_image">
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-md-12 mt-15">
                                                                            <img class="d-none previewImageSize" src=""
                                                                                alt="" id="logoShow"
                                                                                height="100%" width="100%">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input">
                                                                        <div class="primary_file_uploader">
                                                                            <input class="primary_input_field form-control"
                                                                                type="text" id="placeholderPhoto"
                                                                                placeholder="Pinterest Image "
                                                                                readonly="">
                                                                            <button class="" type="button">
                                                                                <label class="primary-btn small fix-gr-bg"
                                                                                    for="pinterest_image">Browser</label>
                                                                                <input type="file" class="d-none"
                                                                                    name="pinterest_image" id="pinterest_image">
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-md-12 mt-15">
                                                                            <img class="d-none previewImageSize" src=""
                                                                                alt="" id="logoShow"
                                                                                height="100%" width="100%">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input">
                                                                        <label class="primary_input_label"
                                                                            for="linkedin_description">LinkedIn Description
                                                                        </label>
                                                                        <textarea class="primary_input_field form-control" cols="0" rows="3" name="linkedin_description"
                                                                            id="linkedin_description"></textarea>


                                                                    </div>
                                                                </div>


                                                                <div class="col-lg-6 mt-4">
                                                                    <div class="primary_input">
                                                                        <label class="primary_input_label"
                                                                            for="pinterest_description">Pinterest Description
                                                                        </label>
                                                                        <textarea class="primary_input_field form-control" cols="0" rows="3" name="pinterest_description"
                                                                            id="pinterest_description"></textarea>


                                                                    </div>
                                                                </div>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="social_links_info">
                                                <div class="row pt-4 row-gap-24">
                                                    <div class="col-lg-12">
                                                        <div class="form-section">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="main-title">
                                                                        <h4 class="stu-sub-head">Social Links</h4>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="facebook">Facebook </label>
                                                                        <input class="primary_input_field form-control"
                                                                            type="url" name="facebook"
                                                                            id="facebook" value="">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="twitter">Twitter </label>
                                                                        <input class="primary_input_field form-control"
                                                                            type="url" name="twitter"
                                                                            id="twitter" value="">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="linkedin">Linkedin </label>
                                                                        <input class="primary_input_field form-control"
                                                                            type="url" name="linkedin"
                                                                            id="linkedin" value="">
                                                                    </div>
                                                                </div>


                                                                <div class="col-lg-3 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="youtube">Youtube </label>
                                                                        <input class="primary_input_field form-control"
                                                                            type="url" name="youtube"
                                                                            id="youtube" value="">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="instagram">Instagram </label>
                                                                        <input class="primary_input_field form-control"
                                                                            type="url" name="instagram"
                                                                            id="instagram" value="">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="tiktok">Tiktok </label>
                                                                        <input class="primary_input_field form-control"
                                                                            type="url" name="tiktok"
                                                                            id="tiktok" value="">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="whatsapp">Whatsapp </label>
                                                                        <input class="primary_input_field form-control"
                                                                            type="tel" name="whatsapp"
                                                                            id="whatsapp" value="">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="telegram">Telegram </label>
                                                                        <input class="primary_input_field form-control"
                                                                            type="url" name="telegram"
                                                                            id="telegram" value="">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 mt-4">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="discord">Discord </label>
                                                                        <input class="primary_input_field form-control"
                                                                            type="url" name="discord"
                                                                            id="discord" value="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane fade" id="application_fees_info">
                                                <div class="row pt-4 row-gap-24">
                                                    <div class="col-lg-12">
                                                        <div class="form-section">
                                                            <div class="row">
                                                                {{-- <div class="col-lg-12">
                                                                    <div class="primary_input ">
                                                                        <label class="primary_input_label"
                                                                            for="">Previous School Details
                                                                        </label>
                                                                        <textarea class="primary_input_field form-control" cols="0" rows="5" name="previous_school_details"></textarea>


                                                                    </div>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="tution_fees_info">
                                                <div class="row pt-4 row-gap-24">
                                                
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>
@endsection