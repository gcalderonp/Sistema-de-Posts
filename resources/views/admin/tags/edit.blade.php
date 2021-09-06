@extends('adminlte::page')

@section('title', 'codersfree')

@section('content_header')
    <h1>Editar Etiqueta</h1>
@stop

@section('content')



    <div class="card">
        <div class="card-body">
            {!! Form::model($tag, ['route' => ['admin.tags.update', $tag], 'method' => 'put']) !!}

            @include('admin.tags.partials.form')

            {!! Form::submit('Actualizar Etiqueta', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

    @if (session('info'))
        <div id="alerta" class="alert text-center alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });

        $('#alerta').fadeIn();
        setTimeout(() => {
            $("#alerta").fadeOut();
        }, 2000);
    </script>

@endsection
