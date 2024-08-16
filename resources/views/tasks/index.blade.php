@extends('layouts.app')

@section('title', 'Mis Tareas')

@section('content')
    <style>
        .page-title {
            color: white;
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0 page-title">Mis Tareas Pendientes</h4>
                <div class="d-flex align-items-center">
                    <a href="{{ route('tasks.create') }}" class="btn btn-success me-2">Agregar Tarea</a>
                    <a href="{{ route('completed-tasks.index') }}" class="btn btn-info">Ver Tareas Completadas</a>
                </div>
            </div>

            @if (session('success'))
                <div id="success-message" class="alert alert-success" style="display: none;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <ul class="list-group" id="task-list">
                        @forelse($tasks as $task)
                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                data-id="{{ $task->id }}">
                                <span>
                                    <input type="checkbox" class="form-check-input me-2 task-checkbox"
                                        data-id="{{ $task->id }}" {{ $task->filled ? 'checked' : '' }}
                                        style="accent-color: red;">
                                    <strong>{{ $task->title }}</strong> - {{ $task->description }} <br>
                                    <small class="text-muted">
                                        Fecha de vencimiento:
                                        @if ($task->expiration_date)
                                            {{ \Carbon\Carbon::parse($task->expiration_date)->format('d/m/Y') }}
                                        @else
                                            No definida
                                        @endif
                                    </small>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Mostrar y ocultar el mensaje de éxito
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'block';
                setTimeout(function() {
                    successMessage.style.opacity = 0;
                    setTimeout(function() {
                        successMessage.style.display = 'none';
                    }, 500); // Espera a que la transición de opacidad termine
                }, 3000); // Tiempo en milisegundos para mostrar el mensaje
            }

            // Manejo del cambio de estado de la tarea
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
                                    var taskItem = document.querySelector(
                                        `li[data-id="${taskId}"]`);
                                    if (taskItem) {
                                        taskItem.remove();
                                    }
                                }
                            }
                        });
                });
            });
        });
    </script>
@endsection
