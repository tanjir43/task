@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <x-card variant="primary" outline="true" title="{!! __('msg.user_list') !!}">
                <x-slot name="body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="users_table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 15%">{{ __('msg.name') }}</th>
                                    <th style="width: 40%">{{ __('msg.email') }}</th>
                                    <th class="text-center" style="width:15%">{{ __('msg.status') }}</th>
                                    <th class="text-center" style="width: 15%">{{ __('msg.action_by') }}</th>
                                    <th style="text-align: right;width: 15%">{{ __('msg.action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </x-slot>
            </x-card>
        </div>
   
        <div class="col-sm-12 col-md-4">
            <x-form route="user.save" :update="$record->id ?? null">
                <x-slot name="body">
                    <x-card variant="primary"  title="{{__('msg.user').' '.__('msg.information')}}">
                        <x-slot name="body">
                            <div class="form-group">
                                <?php
                                    $attr = [
                                        'id'        => 'name',
                                        'class'     => 'form-control',
                                        'required'  => 'required',
                                    ];
                                ?>
                                {!! Form::label('name', __('msg.name')) !!} <span class="text-danger">*</span>
                                {!! Form::text('name',$record->name ?? old('name'),$attr) !!}
                            </div>
                            <div class="form-group mt-2">
                                <?php
                                    $attr = [
                                        'id'        => 'email',
                                        'class'     => 'form-control',
                                        'required'  => 'required',
                                    ];
                                ?>
                                {!! Form::label('email',__('msg.email')) !!} <span class="text-danger">*</span>
                                {!! Form::email('email',$record->email ?? old('email'),$attr) !!}
                            </div>
                            
                            <div class="form-group mt-2">
                                <?php
                                    $attr = [
                                        'id'        => 'password',
                                        'class'     => 'form-control',
                                    ];
                                ?>
                                {!! Form::label('password', __('msg.password')) !!} @if(!isset($record)) <span class="text-danger">*</span> @endif
                                {!! Form::password('password', $attr) !!}
                            </div>
                            
                            <div class="form-group mt-2">
                                <?php
                                    $attr = [
                                        'id'        => 'password_confirmation',
                                        'class'     => 'form-control',
                                    ];
                                ?>
                                {!! Form::label('password_confirmation', __('msg.confirm_password')) !!} @if(!isset($record)) <span class="text-danger">*</span> @endif
                                {!! Form::password('password_confirmation', $attr) !!}
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
        window.LaravelDataTables["dataTableBuilder"]=$("#users_table").DataTable({
            "serverSide":true,
            "processing":true,
            "ajax":{
                "url" : '{{route('user.datatablesds')}}',
                "type": "GET"
            },
            "columns":[
                {data: 'name',"orderable":true,"searchable":true},
                {data: 'email',"orderable":false,"searchable":false},
                {data: 'deleted_at',"orderable":false,"searchable":false},
                {data: 'created_at',"orderable":false,"searchable":false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endpush