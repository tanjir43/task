@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{asset('backEnd/flatpickr/dist/flatpickr.min.css')}}">

@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <x-card variant="primary" outline="true" title="{!! __('msg.city').' '.__('msg.list') !!}">
                <x-slot name="body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="reminder_table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:33%">{{ __('Reminder ID') }}</th>
                                    <th class="text-center" style="width:33%">{{ __('Event Title') }}</th>
                                    <th class="text-center" style="width: 34%">{{ __('Reminder Time') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </x-slot>
            </x-card>
        </div>
   
        <div class="col-sm-12 col-md-4">
            <x-form route="reminder-csv.save" :update="$record->id ?? null" upload="true">
                <x-slot name="body">
                    <x-card variant="primary"  title="{{__('IMPORT CSV FILE')}}">
                        <x-slot name="body">
                            <input type="file" name="file">
                            <x-slot name="footer">
                                {!! Form::submit(__('msg.save'),["class"=>"btn btn-success float-right"]) !!}
                            </x-slot>
                        </x-slot>
                    </x-card>
                </x-slot>
            </x-form>

            <x-form route="event.reminder.save" :update="$record->id ?? null" upload="true">
                <x-slot name="body">
                    <x-card variant="primary"  title="{{__('Event').' '.__('msg.information')}}">
                        <x-slot name="body">

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

                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <?php
                                    $attr = [
                                        'class'         =>  'form-control',
                                        'id'            =>  'reminder_time',
                                        'required'      =>  'required',
                                        'readonly'      =>  'readonly',
                                    ];
                                    ?>
                                    {!! Form::label('reminder_time', __('Reminder Time')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('reminder_time', $record->reminder_time ?? (old('reminder_time') ?? date('Y-m-d H:i:s')), $attr) !!}
                                </div>
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
<script src="{{asset('backEnd/flatpickr/dist/flatpickr.min.js')}}"></script>


<script>
$(document).ready(function() {
    const reminder_time = $('#reminder_time');

    reminder_time.flatpickr({
        enableTime: true,
        dateFormat: 'Y-m-d H:i:s',
    });
});

    $(function() {
        window.LaravelDataTables=window.LaravelDataTables||{};
        window.LaravelDataTables["dataTableBuilder"]=$("#reminder_table").DataTable({
            "serverSide":true,
            "processing":true,
            "ajax":{
                "url" : '{{route('event.reminder.datatable')}}',
                "type": "GET"
            },
            "columns":[
                {data: 'reminder_id',"orderable":true,"searchable":true},
                {data: 'event_id',"orderable":false,"searchable":false},
                {data: 'reminder_time',"orderable":false,"searchable":false},
            ]
        });
    });
</script>
@endpush