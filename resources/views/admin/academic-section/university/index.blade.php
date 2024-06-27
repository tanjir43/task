@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <x-card variant="primary" outline="true"  title="{!! __('msg.university').' '.__('msg.list') !!}"  buttonText="{{ __('msg.add') . __('msg.university') }}" buttonRoute="{{ route('university.university') }}">
                <x-slot name="body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="university_table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 25%">{{ __('msg.name') }}</th>
                                    <th class="text-center" style="width: 40%">{{ __('msg.information') }}</th>
                                    <th class="text-center" style="width:10%">{{ __('msg.total_subject') }}</th>
                                    <th class="text-center" style="width: 10%">{{ __('msg.created_at') }}</th>
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


@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(function() {
        window.LaravelDataTables=window.LaravelDataTables||{};
        window.LaravelDataTables["dataTableBuilder"]=$("#university_table").DataTable({
            "serverSide":true,
            "processing":true,
            "ajax":{
                "url" : '{{route('university.datatable')}}',
                "type": "GET"
            },
            "columns":[
                {data: 'name',"orderable":true,"searchable":true},
                {data: 'information',"orderable":false,"searchable":false},
                {data: 'deleted_at',"orderable":false,"searchable":false},
                {data: 'created_at',"orderable":false,"searchable":false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endpush