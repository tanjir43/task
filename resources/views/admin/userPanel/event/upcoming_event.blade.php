@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <x-card variant="primary" outline="true" title="{!! __('Upcoming Event').' '.__('msg.list') !!}">
                <x-slot name="body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="upcoming_request_table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-left" style="width:20%">{{ __('Event') }}</th>
                                    <th class="text-center" style="width:20%">{{ __('Information') }}</th>
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
    </div>
@endsection


@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(function() {
        window.LaravelDataTables=window.LaravelDataTables||{};
        window.LaravelDataTables["dataTableBuilder"]=$("#upcoming_request_table").DataTable({
            "serverSide":true,
            "processing":true,
            "ajax":{
                "url" : '{{route('upcoming.event.datatable')}}',
                "type": "GET"
            },
            "columns":[
                {data: 'title',"orderable":true,"searchable":true},
                {data: 'information',"orderable":false,"searchable":false},
                {data: 'status',"orderable":false,"searchable":false},
                {data: 'action_by',"orderable":false,"searchable":false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endpush