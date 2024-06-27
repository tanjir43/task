@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <x-card variant="primary" outline="true" title="{!! __('msg.company').' '.__('msg.list') !!}">
                <x-slot name="body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="company_table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 15%">{{ __('msg.name') }}</th>
                                    <th class="text-center" style="width: 35%">{{ __('msg.information') }}</th>
                                    <th class="text-center" style="width:10%">{{ __('msg.status') }}</th>
                                    <th class="text-center" style="width: 20%">{{ __('msg.created_at') }}</th>
                                    <th style="text-align: right;width: 20%">{{ __('msg.action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </x-slot>
            </x-card>
        </div>
   
        <div class="col-sm-12 col-md-4">
            <x-form route="company.save" :update="$record->id ?? null">
                <x-slot name="body">
                    <x-card variant="primary"  title="{{__('msg.company').' '.__('msg.information')}}">
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

                            <div class="form-group">
                                <?php
                                    $attr = [
                                        'id'            =>  'address',
                                    ];
                                ?>
                                {!! Form::label('address', __('msg.address')) !!}
                                {!! Form::textarea('address',$record->address ?? old('address'),$attr) !!}
                            </div>

                            <div class="form-group">
                                <?php 
                                    $attr = [
                                        'id'            => 'email',
                                        'placeholder'   => 'johndoe@gmail.com',
                                        'class'         => 'form-control',
                                    ];
                                ?>
                                {!! Form::label('email', __('msg.email')) !!}
                                {!! Form::email('email',$record->email ?? old('email'),$attr) !!}
                            </div>

                            <div class="form-group">
                                <?php 
                                    $attr = [
                                        'id'            => 'phone',
                                        'class'         => 'form-control',
                                    ];
                                ?>
                                {!! Form::label('phone', __('msg.phone')) !!}
                                {!! Form::text('phone',$record->phone ?? old('phone'),$attr) !!}
                            
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                            $attr = [
                                                'id'                => 'trade_license',
                                                'class'             => 'form-control'
                                            ];
                                        ?>
                                        {!! Form::label('trade_license', __('msg.trade_license')) !!}
                                        {!! Form::text('trade_license',$record->trade_license ?? old('trade_license'),$attr) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('vat', __('msg.vat')) !!}
                                        <div class="input-group">
                                            <?php 
                                                $attr = [
                                                    'id'            => 'vat',
                                                    'class'         => 'form-control',
                                                    'min'           => 0,
                                                    'max'           => 100,
                                                ];
                                                ?>
                                            {!! Form::number('vat',$record->vat ?? old('vat'),$attr) !!}
                                            <span class="input-group-text">
                                                <i class="fa fa-percent"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                            $attr = [
                                                'id'                => 'vat_area_code',
                                                'class'             => 'form-control'
                                            ];
                                        ?>
                                        {!! Form::label('vat_area_code', __('msg.vat_area_code')) !!}
                                        {!! Form::text('vat_area_code',$record->vat_area_code ?? old('vat_area_code'),$attr) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                            $attr = [
                                                'id'                => 'mashuk_no',
                                                'class'             => 'form-control'
                                            ];
                                        ?>
                                        {!! Form::label('mashuk_no', __('msg.mashuk_no')) !!}
                                        {!! Form::text('mashuk_no',$record->mashuk_no ?? old('mashuk_no'),$attr) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                            $attr = [
                                                'id'                => 'tin',
                                                'class'             => 'form-control'
                                            ];
                                        ?>
                                        {!! Form::label('tin', __('msg.tin')) !!}
                                        {!! Form::text('tin',$record->tin ?? old('tin'),$attr) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                            $attr = [
                                                'id'                => 'registration_no',
                                                'class'             => 'form-control'
                                            ];
                                        ?>
                                        {!! Form::label('registration_no', __('msg.registration_no')) !!}
                                        {!! Form::text('registration_no',$record->registration_no ?? old('registration_no'),$attr) !!}
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


@section('js')
 <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    const address = $('#address');
    address.summernote({
        height     : 120,
        placeholder:'Dhaka,Bangladesh',
        toolbar: [
            ['style', ['bold']],
            ['font', [ 'fontname','fontsize']],
        ]
    });
</script>

<script>
    $(function() {
        window.LaravelDataTables=window.LaravelDataTables||{};
        window.LaravelDataTables["dataTableBuilder"]=$("#company_table").DataTable({
            "serverSide":true,
            "processing":true,
            "ajax":{
                "url" : '{{route('company.datatable')}}',
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
@endsection