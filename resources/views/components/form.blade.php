<?php $attributes = ''; ?>
@if(isset($attr))
    <?php foreach ($attr as $k => $v ){
        $attributes.= $k.'="'.$v.'"';
    } ?>
@endif
{!! Form::open(
    isset($route) ?
    [
        'files'=> $upload,
        'route' => [
            $route,$update ?? null
        ],
        $attributes
    ]
    : ['url' => '#',$attributes])
!!}
{{ $body ?? '' }}
{!! Form::close() !!}