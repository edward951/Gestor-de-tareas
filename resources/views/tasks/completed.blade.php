@extends('layouts.app')

@section('title', 'Tareas Completadas')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Tareas Completadas</h1>
            <a href="{{ route('tasks.index') }}" class="btn btn-info">Volver a Tareas Pendientes</a>
        </div>

        <div class="card">
            <div class="card-header">Lista de Tareas Completadas</div>
            <div class="card-body">
                <ul class="list-group">
                    @forelse($tasks as $task)
                        <li class="list-group-item">
                            <strong>{{ $task->title }}</strong> - {{ $task->description }} <br>
                            <small class="text-muted">
                                Fecha de vencimiento: 
                                @if($task->expiration_date)
                                    {{ \Carbon\Carbon::parse($task->expiration_date)->format('d/m/Y') }}
                                @else
                                    No definida
                                @endif
                            </small>
                        </li>
                    @empty
                        <li class="list-group-item">No hay tareas completadas.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="mt-3">
            {{ $tasks->links() }}
        </div>
    </div>
</div>
@endsection
