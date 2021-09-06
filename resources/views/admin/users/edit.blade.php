@extends('adminlte::page')

@section('title', 'codersfree')

@section('content_header')

<h1>Asignar Rol</h1>

<div class="position-fixed" style="z-index: 50; left:50%;">

    @if (session('info'))

        <div id="alerta" class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>

    @endif
</div>

@stop

@section('content')

<div class="card">
    <div class="card-body">
        <p class="h5">Nombre:</p>
        <p class="form-control">{{ $user->name }}</p>

        <h2 class="h5">Listado de Roles</h2>

        {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}

        @foreach ($roles as $rol)

            <div>
                <label>
                    {!! Form::checkbox('roles[]', $rol->id, null, ['class' => 'mr-1']) !!}
                    {{ $rol->name }}
                </label>
            </div>

        @endforeach

        {!! Form::submit('Asignar Rol', ['class' => 'btn btn-primary mt-2']) !!}

        {!! Form::close() !!}

    </div>
</div>

@stop


@section('js')
<script>
    $('alerta').fadeIn();
    setTimeout(() => {
        $('#alerta').fadeOut();
    }, 2000);
</script>
@stop
