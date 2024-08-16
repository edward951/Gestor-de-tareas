@extends('layouts.app')

@section('title', 'Mis Tareas')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Mis Tareas Pendientes</h4>
            <div class="d-flex align-items-center">
                <a href="{{ route('tasks.create') }}" class="btn btn-success me-2">Agregar Tarea</a>
                <a href="{{ route('completed-tasks.index') }}" class="btn btn-info">Ver Tareas Completadas</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">Lista de Tareas Pendientes</div>
            <div class="card-body">
                <ul class="list-group" id="task-list">
                    @forelse($tasks as $task)
                        <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $task->id }}">
                            <span>
                                <input type="checkbox" class="form-check-input me-2 task-checkbox" data-id="{{ $task->id }}" {{ $task->filled ? 'checked' : '' }} style="accent-color: red;">
                                <strong>{{ $task->title }}</strong> - {{ $task->description }} <br>
                                <small class="text-muted">
                                    Fecha de vencimiento: 
                                    @if($task->expiration_date)
                                        {{ \Carbon\Carbon::parse($task->expiration_date)->format('d/m/Y') }}
                                    @else
                                        No definida
                                    @endif
                                </small>
                            </span>
                            <span>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm me-1">Editar</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </span>
                        </li>
                    @empty
                        <li class="list-group-item">No hay tareas pendientes.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="mt-3">
            {{ $tasks->links() }}
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.task-checkbox').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        var taskId = this.getAttribute('data-id');
        var completed = this.checked;

        fetch(`/tasks/${taskId}/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                completed: completed
            })
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                // Elimina la tarea completada de la lista
                if (completed) {
                    var taskItem = document.querySelector(`li[data-id="${taskId}"]`);
                    if (taskItem) {
                        taskItem.remove();
                    }
                }
            }
        });
    });
});
</script>
@endsection
