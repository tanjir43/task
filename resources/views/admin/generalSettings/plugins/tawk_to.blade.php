@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <x-form route="tawk.to.update">
                <x-slot name="body">
            <x-card variant="primary " outline="true" title="{!! __('msg.tawk_to').' '.__('msg.configuration') !!}">
                <x-slot name="body">

                        <div class="row">
                            <div class="col-md-3">
                                <label for="">@lang('msg.tawk_to') @lang('msg.chat')</label>
                            </div>
                            <div class="col-md-9">
                                <div class="d-flex gap-2">
                                    <input type="radio" name="is_enable" value="1" id="is_enable_yes" {{ (isset($tawk_to) && $tawk_to->is_enable == 1) ? 'checked' : (old('is_enable') == 1 ? 'checked' : '') }}> @lang('msg.enable')
                                    <input type="radio" name="is_enable" value="0" id="is_enable_no" {{ (isset($tawk_to) && $tawk_to->is_enable == 0) ? 'checked' : (old('is_enable') == 0 ? 'checked' : '') }}> @lang('msg.disable')
                                </div>
                            </div>
                        </div>
                    
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <label for="">@lang('msg.applicable_for')</label>
                            </div>
                            <div class="col-md-9">
                                <div class="d-flex gap-2">
                                    @php
                                        $selectedRoles = json_decode($tawk_to->applicable_for, true) ?? old('roles', []);
                                    @endphp
                                    <input type="checkbox" name="roles[]" value="0" id="all" {{ in_array("0", $selectedRoles) ? 'checked' : '' }}> @lang('msg.all')
                                    @foreach ($roles as $id => $name)
                                        <input type="checkbox" name="roles[]" value="{{ $id }}" class="role-checkbox" id="role_{{ $id }}" {{ in_array((string)$id, $selectedRoles) ? 'checked' : '' }}> {{ $name }}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <label for="">@lang('msg.show_on_admin_panel')</label>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex gap-2">
                                    <input type="radio" name="show_admin_panel" value="1" id="show_admin_panel_yes" {{ (isset($tawk_to) && $tawk_to->show_admin_panel == true) ? 'checked' : '' }}> @lang('msg.yes')
                                    <input type="radio" name="show_admin_panel" value="0" id="show_admin_panel_no" {{ (isset($tawk_to) && $tawk_to->show_admin_panel == false) ? 'checked' : '' }}> @lang('msg.no')
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">@lang('msg.availability')</label>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex gap-2">
                                    <input type="radio" name="availability" value="mobile" id="availability_mobile" {{ (isset($tawk_to) && $tawk_to->availability == 'mobile') ? 'checked' : (old('availability') == 'mobile' ? 'checked' : '') }}> @lang('msg.mobile')
                                    <input type="radio" name="availability" value="desktop" id="availability_desktop" {{ (isset($tawk_to) && $tawk_to->availability == 'desktop') ? 'checked' : (old('availability') == 'desktop' ? 'checked' : '') }}> @lang('msg.desktop')
                                    <input type="radio" name="availability" value="both" id="availability_both" {{ (isset($tawk_to) && $tawk_to->availability == 'both') ? 'checked' : (old('availability') == 'both' ? 'checked' : '') }}> @lang('msg.both')
                                </div>
                            </div>
                        </div>
                    
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <label for="">@lang('msg.show_on_frontend')</label>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex gap-2">
                                    <input type="radio" name="show_website" id="show_website_yes" value="1" {{ (isset($tawk_to) && $tawk_to->show_website == true) ? 'checked' : '' }}> @lang('msg.yes')
                                    <input type="radio" name="show_website" id="show_website_no" value="0" {{ (isset($tawk_to) && $tawk_to->show_website == false) ? 'checked' :  '' }}> @lang('msg.no')
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="showing_page">@lang('msg.showing_page')</label>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex gap-2">
                                    <input type="radio" name="showing_page" id="showing_page_home" value="home" {{ (isset($tawk_to) && $tawk_to->showing_page == 'home') ? 'checked' : (old('showing_page') == 'home' ? 'checked' : '') }}> @lang('msg.only_home_page')
                                    <input type="radio" name="showing_page" id="showing_page_all" value="all" {{ (isset($tawk_to) && $tawk_to->showing_page == 'all') ? 'checked' : (old('showing_page') == 'all' ? 'checked' : '') }}> @lang('msg.all_page')
                                </div>
                            </div>
                        </div>
                                          
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <label for="">@lang('msg.position')</label>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex gap-2">
                                    <input type="radio" name="position" value="left" id="position_left" {{ (isset($tawk_to) && $tawk_to->position == 'left') ? 'checked' : (old('position') == 'left' ? 'checked' : '') }}> @lang('msg.left')
                                    <input type="radio" name="position" value="right" id="position_right" {{ (isset($tawk_to) && $tawk_to->position == 'right') ? 'checked' : (old('position') == 'right' ? 'checked' : '') }}> @lang('msg.right')
                                </div>
                            </div>
                        </div>
                    
                        <div class="row mt-4 d-flex">
                            <div class="col-md-3">
                                <label for="">@lang('msg.short_code')</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="short_code" class="form-control" value="{{ isset($tawk_to) ? $tawk_to->short_code : old('short_code') }}">
                            </div>
                        </div>
                    </x-slot>
                    <x-slot name="footer">
                        {!! Form::submit(__('msg.save'),["class"=>"btn btn-success float-right"]) !!}
                    </x-slot>
                    </x-card>
                </x-slot>
            </x-form>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $('#all').change(function() {
                if($(this).is(':checked')) {
                    $('.role-checkbox').prop('checked', true);
                } else {
                    $('.role-checkbox').prop('checked', false);
                }
            });

            $('.role-checkbox').change(function() {
                if ($('.role-checkbox:checked').length === $('.role-checkbox').length) {
                    $('#all').prop('checked', true);
                } else {
                    $('#all').prop('checked', false);
                }
            });

            $('input[name="show_website"]').change(function() {
                if ($('#show_website_no').is(':checked')) {
                    $('input[name="showing_page"]').prop('disabled', true);
                } else {
                    $('input[name="showing_page"]').prop('disabled', false);
                }
            });

            $('input[name="show_website"]:checked').trigger('change');
        });

    </script>
@endsection