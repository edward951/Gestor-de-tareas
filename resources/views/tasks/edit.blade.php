@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Tarea</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tareas.update', $tarea) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo', $tarea->titulo) }}" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion', $tarea->descripcion) }}</textarea>
            </div>
            <div class="form-group">
                <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" value="{{ old('fecha_vencimiento', $tarea->fecha_vencimiento) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
        </form>
    </div>
@endsection
