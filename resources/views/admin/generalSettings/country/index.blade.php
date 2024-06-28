@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <x-card variant="primary" outline="true" title="{!! __('msg.country').' '.__('msg.list') !!}">
                <x-slot name="body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="country_table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 20%">{{ __('msg.code') }}</th>
                                    <th class="text-left" style="width:20%">{{ __('msg.name') }}</th>
                                    <th class="text-left" style="width: 20%">{{ __('msg.phone') }}</th>
                                    <th style="text-align: left;width: 20%">{{ __('msg.capital') }}</th>
                                    <th style="text-align: center;width: 20%">{{ __('msg.languages') }}</th>
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
        window.LaravelDataTables["dataTableBuilder"]=$("#country_table").DataTable({
            "serverSide":true,
            "processing":true,
            "ajax":{
                "url" : '{{route('country.datatable')}}',
                "type": "GET"
            },
            "columns":[
                {data: 'code',"orderable":true,"searchable":true},
                {data: 'name',"orderable":true,"searchable":true},
                {data: 'phone',"orderable":false,"searchable":true},
                {data: 'capital',"orderable":true,"searchable":true},
                {data: 'languages',"orderable":true,"searchable":true},
            ]
        });
    });
</script>
@endpush