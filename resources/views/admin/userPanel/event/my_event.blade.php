@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <x-card variant="primary" outline="true" title="{!! __('msg.city').' '.__('msg.list') !!}">
                <x-slot name="body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="city_table" style="width: 100%">
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
            <x-form route="city.save" :update="$record->id ?? null">
                <x-slot name="body">
                    <x-card variant="primary"  title="{{__('msg.city').' '.__('msg.information')}}">
                        <x-slot name="body">
                            <div class="form-group">
                                <?php
                                    $attr = [
                                        'class'         =>  'form-control mt-1',
                                        'id'            =>  'country_id',
                                        'required'      =>  'required',
                                    ];
                                ?>
                                {!! Form::label('country_id', __('msg.country')) !!} <span class="text-danger">*</span>
                                {!! Form::select('country',$countries,$record->country_id ?? old('country'),$attr) !!}
                            </div>
                            <div class="form-group mt-3">
                                <?php
                                    $attr = [
                                        'id'        => 'name',
                                        'class'     => 'form-control mt-1',
                                    ];
                                ?>
                                {!! Form::label('name',__('msg.name')) !!}
                                {!! Form::text('name',$record->name ?? old('name'),$attr) !!}
                            </div>
                            <div class="form-group mt-3">
                                <?php
                                    $attr = [
                                        'id'        => 'is_capital',
                                        'class'     => 'mt-1',
                                    ];
                                ?>
                               {!! Form::label('is_capital', __('msg.is_capital')) !!} <br>
                               {!! Form::hidden('is_capital', 0) !!}
                               {!! Form::checkbox('is_capital', 1, $record->is_capital ?? old('is_capital', false), $attr) !!}
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
        window.LaravelDataTables=window.LaravelDataTables||{};
        window.LaravelDataTables["dataTableBuilder"]=$("#city_table").DataTable({
            "serverSide":true,
            "processing":true,
            "ajax":{
                "url" : '{{route('city.datatable')}}',
                "type": "GET"
            },
            "columns":[
                {data: 'country_id',"orderable":true,"searchable":true},
                {data: 'name',"orderable":true,"searchable":true},
                {data: 'status',"orderable":true,"searchable":true},
                {data: 'action_by',"orderable":false,"searchable":false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endpush