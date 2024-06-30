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
                                    <th style="width: 40%">{{ __('msg.information') }}</th>
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

                            @include('common.search.area_search_criteria', [
                                'mt' => 'mt-0',
                                'div' => 'col-lg-12',
                                'required' => ['country','city'],
                                'visible' => ['country', 'city'],
                                'record' => @$record

                            ])

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
                                {!! Form::label('gender', __('Gender')) !!} <span class="text-danger">*</span>
                                <div>
                                    <div class="form-check form-check-inline">
                                        {!! Form::radio('gender', 'male', isset($record) && $record->gender == 'male', ['id' => 'gender_male', 'class' => 'form-check-input']) !!}
                                        {!! Form::label('gender_male', __('Male'), ['class' => 'form-check-label']) !!}
                                    </div>
                                    <div class="form-check form-check-inline">
                                        {!! Form::radio('gender', 'female', isset($record) && $record->gender == 'female', ['id' => 'gender_female', 'class' => 'form-check-input']) !!}
                                        {!! Form::label('gender_female', __('Female'), ['class' => 'form-check-label']) !!}
                                    </div>
                                    <div class="form-check form-check-inline">
                                        {!! Form::radio('gender', 'other', isset($record) && $record->gender == 'other', ['id' => 'gender_other', 'class' => 'form-check-input']) !!}
                                        {!! Form::label('gender_other', __('Other'), ['class' => 'form-check-label']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                {!! Form::label('group_id', __('Group')) !!}
                                {!! Form::select('group_id', $groups, isset($record) ? $record->group_id : null, ['class' => 'form-control', 'placeholder' => __('Select Group')]) !!}
                            </div>
                            
                            <div class="form-group">
                                <?php
                                    $emailAttr = [
                                        'id'        => 'email',
                                        'class'     => 'form-control',
                                        'required'  => 'required',
                                    ];
                                ?>
                                {!! Form::label('email', __('msg.email')) !!} <span class="text-danger">*</span>
                                {!! Form::email('email', $record->email ?? old('email'), $emailAttr) !!}
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
                "url" : '{{route('user.datatable')}}',
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