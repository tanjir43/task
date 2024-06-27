@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/summernote-lite.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection



@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <x-card variant="primary" outline="true" title="{!! __('msg.frontend_article').' '.__('msg.list') !!}">
                <x-slot name="body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="frontend_article_table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 30%">{{ __('msg.name') }}</th>
                                    <th style="width: 30%">{{ __('msg.information') }}</th>
                                    <th class="text-center" style="width:10%">{{ __('msg.status') }}</th>
                                    <th class="text-center" style="width: 15%">{{ __('msg.created_at') }}</th>
                                    <th style="text-align: right;width: 15%">{{ __('msg.action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </x-slot>
            </x-card>
        </div>
        <div class="col-sm-12 col-md-4">
            <x-form route="frontend-article.save" :update="$record['model']->id ?? null">
                <x-slot name="body">
                    <x-card variant="primary"  title="{{__('msg.frontend_article').' '.__('msg.information')}}">
                        <x-slot name="body">

                        @include('common.search.area_search_criteria', [
                                'mt' => 'mt-0',
                                'div' => 'col-lg-12',
                                'visible' => ['country', 'city'],
                                'model' => isset($record) ? $record : null,
                            ])
                            <div class="form-group">
                                <?php
                                    $attr = [
                                        'id'        => 'title',
                                        'class'     => 'form-control',
                                        'required'  => 'required',

                                    ];
                                ?>
                                {!! Form::label('title', __('msg.title')) !!}
                                {!! Form::text('title',$record['model']->title ?? old('title'),$attr) !!}
                            </div>
                        
                            <div class="form-group">
                                <?php
                                    $attr = [
                                        'id'            =>  'description',
                                    ];
                                ?>
                                {!! Form::label('description', __('msg.description')) !!}
                                {!! Form::textarea('description',$record['model']->description ?? old('description'),$attr) !!}
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
<script src="{{asset('js/summernote/summernote-lite.min.js')}}"></script>
<script>
    const address = $('#description');
    address.summernote({
        height     : 120,
        placeholder:'Write here...',
        toolbar: [
            ['style', ['bold']],
            ['font', [ 'fontname','fontsize']],
        ]
    });
</script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(function() {
        window.LaravelDataTables=window.LaravelDataTables||{};
        window.LaravelDataTables["dataTableBuilder"]=$("#frontend_article_table").DataTable({
            "serverSide":true,
            "processing":true,
            "ajax":{
                "url" : '{{route('frontend.article.datatable')}}',
                "type": "GET"
            },
            "columns":[
                {data: 'title',"orderable":true,"searchable":true},
                {data: 'information',"orderable":false,"searchable":false},
                {data: 'deleted_at',"orderable":false,"searchable":false},
                {data: 'created_at',"orderable":false,"searchable":false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endpush