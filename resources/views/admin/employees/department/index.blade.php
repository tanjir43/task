@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <x-card variant="primary" outline="true" title="{!! __('msg.department').' '.__('msg.list') !!}">
                <x-slot name="body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="department_table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 50%">{{ __('msg.name') }}</th>
                                    <th class="text-center" style="width:25%">{{ __('msg.status') }}</th>
                                    <th class="text-center" style="width: 25%">{{ __('msg.created_at') }}</th>
                                    <th style="text-align: right;width: 25%">{{ __('msg.action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </x-slot>
            </x-card>
        </div>
   
        <div class="col-sm-12 col-md-4">
            <x-form route="department.save" :update="$record->id ?? null">
                <x-slot name="body">
                    <x-card variant="primary"  title="{{__('msg.department').' '.__('msg.information')}}">
                        <x-slot name="body">
                            <div class="form-group">
                                <?php
                                    $attr = [
                                        'id'        => 'name',
                                        'class'     => 'form-control',
                                        'required'  => 'required',
                                    ];
                                ?>
                                {!! Form::label('name', __('msg.name')) !!}
                                {!! Form::text('name',$record->name ?? old('name'),$attr) !!}
                            </div>
                            <div class="form-group">
                                <?php
                                    $attr = [
                                        'id'        => 'name_l',
                                        'class'     => 'form-control',
                                    ];
                                ?>
                                {!! Form::label('name_l',__('msg.name_l')) !!}
                                {!! Form::text('name_l',$record->name_l ?? old('name_l'),$attr) !!}
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


@section('js')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(function() {
        window.LaravelDataTables=window.LaravelDataTables||{};
        window.LaravelDataTables["dataTableBuilder"]=$("#department_table").DataTable({
            "serverSide":true,
            "processing":true,
            "ajax":{
                "url" : '{{route('department.datatable')}}',
                "type": "GET"
            },
            "columns":[
                {data: 'name',"orderable":true,"searchable":true},
                {data: 'deleted_at',"orderable":false,"searchable":false},
                {data: 'created_at',"orderable":false,"searchable":false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endsection