@extends('layouts.app')

@section('title', 'Crear Nueva Tarea')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Crear Nueva Tarea</div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title">Título</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('titulo') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Descripción</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="expiration_date">Fecha de Vencimiento</label>
                        <input type="date" name="expiration_date" id="expiration_date" class="form-control" value="{{ old('fecha_vencimiento') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Crear Tarea</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
