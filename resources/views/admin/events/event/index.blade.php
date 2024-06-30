@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('backEnd/flatpickr/dist/flatpickr.min.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 
            @if (checkUserRole())
                col-md-12
            @else
                col-md-8
            @endif
        ">
            <x-card variant="primary" outline="true" title="{!! __('Event').' '.__('msg.list') !!}">
                <x-slot name="body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="event_table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:15%">{{ __('Title') }}</th>
                                    <th class="text-center" style="width:15%">{{ __('Image') }}</th>
                                    <th class="text-center" style="width:25%">{{ __('Information') }}</th>
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
   
        @if (!checkUserRole())
            <div class="col-sm-12 col-md-4">
                <x-form route="events.import" :update="$record->id ?? null" upload="true">
                    <x-slot name="body">
                        <x-card variant="primary"  title="{{__('Import Event')}}">
                            <x-slot name="body">
                                <input type="file" name="file">
                            </x-slot>
                            <x-slot name="footer">
                                {!! Form::submit(__('msg.save'),["class"=>"btn btn-success float-right"]) !!}
                            </x-slot>
                        </x-card>
                    </x-slot>
                </x-form>

                <x-form route="event.save" :update="$record->id ?? null" upload="true">
                    <x-slot name="body">
                        <x-card variant="primary"  title="{{__('Event').' '.__('msg.information')}}">
                            <x-slot name="body">

                                <div class="form-group mt-3">
                                    <?php
                                        $attr = [
                                            'id'        => 'title',
                                            'class'     => 'form-control mt-1',
                                        ];
                                    ?>
                                    {!! Form::label('title',__('msg.title')) !!}
                                    {!! Form::text('title',$record->title ?? old('title'),$attr) !!}
                                </div>


                                <div class="form-group mt-3">
                                    {!! Form::label('gender', __('For Whom')) !!}
                                    <div>
                                        <div class="form-check form-check-inline">
                                            {!! Form::radio('for_whom', 'all', isset($record) && $record->for_whom == 'all', ['id' => 'gender_all', 'class' => 'form-check-input']) !!}
                                            {!! Form::label('gender_all', __('All'), ['class' => 'form-check-label']) !!}
                                        </div>
                                        <div class="form-check form-check-inline">
                                            {!! Form::radio('for_whom', 'male', isset($record) && $record->for_whom == 'male', ['id' => 'gender_male', 'class' => 'form-check-input']) !!}
                                            {!! Form::label('gender_male', __('Male'), ['class' => 'form-check-label']) !!}
                                        </div>
                                        <div class="form-check form-check-inline">
                                            {!! Form::radio('for_whom', 'female', isset($record) && $record->for_whom == 'female', ['id' => 'gender_female', 'class' => 'form-check-input']) !!}
                                            {!! Form::label('gender_female', __('Female'), ['class' => 'form-check-label']) !!}
                                        </div>
                                        <div class="form-check form-check-inline">
                                            {!! Form::radio('for_whom', 'other', isset($record) && $record->for_whom == 'other', ['id' => 'gender_other', 'class' => 'form-check-input']) !!}
                                            {!! Form::label('gender_other', __('Other'), ['class' => 'form-check-label']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <?php
                                        $attr = [
                                            'id'        => 'description',
                                            'class'     => 'mt-1',
                                        ];
                                    ?>
                                {!! Form::label('description', __('msg.description')) !!} <br>
                                {!! Form::textarea('description',$record->description ?? old('description'),$attr) !!}

                                </div>

                                <div class="form-group mt-3">
                                    <?php
                                        $attr = [
                                            'id'        => 'location',
                                            'class'     => 'mt-1',
                                        ];
                                    ?>
                                {!! Form::label('location', __('Location')) !!} <br>
                                {!! Form::textarea('location',$record->location ?? old('location'),$attr) !!}

                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <?php
                                                $attr = [
                                                    'class'         =>  'form-control',
                                                    'id'            =>  'from_date',
                                                    'required'      =>  'required',
                                                    'readonly'      =>  'readonly',
                                                ];
                                            ?>
                                            {!! Form::label('from_date', __('From Date')) !!} <span class="text-danger">*</span>
                                            {!! Form::text('from_date', $record->from_date ?? (old('from_date') ?? date('Y-m-d')), $attr) !!}
                                        </div>
                                    </div>
                            
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <?php
                                                $attr = [
                                                    'class'         =>  'form-control',
                                                    'id'            =>  'to_date',
                                                    'required'      =>  'required',
                                                    'readonly'      =>  'readonly',
                                                ];
                                            ?>
                                            {!! Form::label('to_date', __('To Date')) !!} <span class="text-danger">*</span>
                                            {!! Form::text('to_date', $record->to_date ?? (old('to_date') ?? date('Y-m-d')), $attr) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-1 mt-3">
                                    {!! Form::label('file', __('msg.picture') ) !!} <br />
                                    @if(!empty($record->media))
                                        <img src="{{ $record->media->attachment }}" class="img-thumbnail"  width="250px">
                                        <a href="{{ route('delete.event.media',$record->id) }}" class="btn btn-danger">{{ __('Delete') }}</a>
                                    @else
                                        <input type="file" name="file">
                                    @endif
                                </div>

                                <div class="form-group mt-3">
                                    <?php
                                        $attr = [
                                            'id'        => 'is_specific',
                                            'class'     => 'mt-1',
                                        ];
                                    ?>
                                {!! Form::label('is_specific', __('Is Specific')) !!} <br>
                                {!! Form::checkbox('is_specific', 1, $record->is_specific ?? old('is_specific', false), $attr) !!}
                                </div>
                                <div id="activity_change" class="{{ @$record->is_specific ==1 ? '' : 'd-none' }}">
                                    @include('common.search.area_search_criteria', [
                                        'mt' => 'mt-0',
                                        'div' => 'col-lg-12',
                                        'required' => ['country','city'],
                                        'visible' => ['country', 'city'],
                                        'record' => @$record
                                    ])
                                </div>
                                <x-slot name="footer">
                                    {!! Form::submit(__('msg.save'),["class"=>"btn btn-success float-right"]) !!}
                                </x-slot>
                            </x-slot>
                        </x-card>
                    </x-slot>
                </x-form>
            </div>
        @endif
      
    </div>
@endsection

@push('scripts')
    <script src="{{asset('backEnd/flatpickr/dist/flatpickr.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            // Flatpickr
            const from_date = $('#from_date');
            const to_date = $('#to_date');

            from_date.flatpickr({
                dateFormat: 'Y-m-d',
            });


            to_date.flatpickr({
                dateFormat: 'Y-m-d',
            });

            // Summernote
            const address = $('#description, #location');
            address.summernote({
                height: 120,
                placeholder: 'Text here...',
                toolbar: [
                    ['style', ['bold']],
                    ['font', ['fontname', 'fontsize']],
                ]
            });

            // Toggle visibility
            toggleActivityChange();

            $('#is_specific').change(function() {
                toggleActivityChange();
            });

            function toggleActivityChange() {
                if ($('#is_specific').is(':checked')) {
                    $('#activity_change').removeClass('d-none');
                } else {
                    $('#activity_change').addClass('d-none');
                }
            }
        });

        $(function() {
            // DataTable
            window.LaravelDataTables = window.LaravelDataTables || {};
            window.LaravelDataTables["dataTableBuilder"] = $("#event_table").DataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": '{{route('event.datatable')}}',
                    "type": "GET"
                },
                "columns": [
                    { data: 'title', "orderable": true, "searchable": true },
                    { data: 'image', "orderable": true, "searchable": true },
                    { data: 'information', "orderable": true, "searchable": true },
                    { data: 'status', "orderable": true, "searchable": true },
                    { data: 'action_by', "orderable": false, "searchable": false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endpush

