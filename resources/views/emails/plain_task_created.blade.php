<!-- resources/views/emails/plain_task_created.blade.php -->
Nueva tarea creada:

Título: {{ $task->title }}
Descripción: {{ $task->description }}
Fecha de vencimiento: {{ $task->expiration_date }}

Gracias,
Tu equipo de gestión de tareas
