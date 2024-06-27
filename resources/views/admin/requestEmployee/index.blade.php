@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <x-card variant="primary" outline="true" title=" {!! __('msg.requested').' '.__('msg.employee').' '. __('msg.list') !!} ">
                <x-slot name="body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="requested_table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 25%">{{ __('msg.name') }}</th>
                                    <th style="width: 15%">{{ __('msg.phone') }}</th>
                                    <th class="text-center" style="width: 25%">{{ __('msg.information') }}</th>
                                    <th style="width: 10%">{{ __('msg.status') }}</th>
                                    <th style="width: 10%">{{ __('msg.created_at') }}</th>
                                    <th style="text-align: right;width: 15%">{{ __('msg.action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </x-slot>
            </x-card>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(function() {
        window.LaravelDataTables=window.LaravelDataTables||{};
        window.LaravelDataTables["dataTableBuilder"]=$("#requested_table").DataTable({
            "serverSide":true,
            "processing":true,
            "ajax":{
                "url" : '{{route('requested.employee.datatable')}}',
                "type": "GET"
            },
            "columns":[
                {data: 'name',"orderable":true,"searchable":true},
                {data: 'phone',"orderable":false,"searchable":true},
                {data: 'information',"orderable":false,"searchable":false},
                {data: 'deleted_at',"orderable":false,"searchable":false},
                {data: 'created_at',"orderable":false,"searchable":false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endsection