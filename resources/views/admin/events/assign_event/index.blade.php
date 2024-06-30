@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<style>
    .custom-loader-style {
        margin-top: -35px !important;
        left: 77% !important;
    }
</style>
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <x-card variant="primary" outline="true" title="{!! __('Assign Event').' '.__('msg.list') !!}">
                <x-slot name="body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="assign_event_table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 20%">{{ __('msg.country') }}</th>
                                    <th class="text-center" style="width:20%">{{ __('msg.name') }}</th>
                                    <th class="text-center" style="width:20%">{{ __('msg.status') }}</th>
                                    <th class="text-center" style="width: 25%">{{ __('msg.action_by') }}</th>
                                    <th style="text-align: right;width: 25%">{{ __('msg.action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </x-slot>
            </x-card>
        </div>
   
        <div class="col-sm-12 col-md-4">
            <x-form route="event-assign.save" :update="$record->id ?? null">
                <x-slot name="body">
                    <x-card variant="primary"  title="{{__('Assign Event').' '.__('msg.information')}}">
                        <x-slot name="body">

                            @include('common.search.area_search_criteria', [
                                'mt' => 'mt-0',
                                'div' => 'col-lg-12',
                                'required' => [''],
                                'visible' => ['country', 'city'],
                                'record' => @$record
                            ])

                            <div class="form-group">
                                <?php
                                    $attr = [
                                        'class'         =>  'form-control mt-1 select_event',
                                        'id'            =>  'event_id',
                                        'required'      =>  'required',
                                    ];
                                ?>
                                {!! Form::label('event_id', __('Event')) !!} <span class="text-danger">*</span>
                                {!! Form::select('event_id', $events, $record->event_id ?? old('event_id'), $attr) !!}
                                <div class="pull-right loader loader_style custom-loader-style " id="select_event_loader">
                                    <img src="{{ asset('gif/wait.gif') }}" alt="" style="width: 28px;">
                                </div>
                            </div>


                            <div class="form-group">
                                <?php
                                    $attr = [
                                        'class'         =>  'form-control mt-1 select_user',
                                        'id'            =>  'user_id',
                                        'required'      =>  'required',
                                    ];
                                ?>
                                {!! Form::label('user_id', __('User')) !!} <span class="text-danger">*</span>
                                {!! Form::select('user_id', $users, $record->user_id ?? old('user_id'), $attr) !!}
                                <div class="pull-right loader loader_style custom-loader-style" id="select_user_loader">
                                    <img src="{{ asset('gif/wait.gif') }}" alt="" style="width: 28px;">
                                </div>
                            </div>
                    
                            <x-slot name="footer">
                                {!! Form::submit(__('msg.save'),["class"=>"btn btn-success float-right"]) !!}
                            </x-slot>
                        </x-slot>
                    </x-card>
                </x-slot>
            </x-form>
        </div>
    </div>
@endsection


@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(function() {
        window.LaravelDataTables = window.LaravelDataTables || {};
        window.LaravelDataTables["dataTableBuilder"] = $("#assign_event_table").DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": '{{ route('event-assign.datatable') }}',
                "type": "GET"
            },
            "columns": [
                { data: 'title', name: 'title', orderable: true, searchable: true },
                { data: 'total_user', name: 'total_user', orderable: false, searchable: false },
                { data: 'status', name: 'status', orderable: true, searchable: true },
                { data: 'action_by', name: 'action_by', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>

@endpush