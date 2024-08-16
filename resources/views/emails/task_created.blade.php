<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Nueva Tarea Creada</title>
    <style>
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 0%;
            }

            50% {
                background-position: 100% 100%;
            }

            100% {
                background-position: 0% 0%;
            }
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .header {
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
            background: linear-gradient(45deg, #31669e, #49138f, #c02c9e, #5dc8ce);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
        }

        .content {
            padding: 20px;
        }

        .content p {
            margin: 0 0 10px;
        }

        .content .task-details {
            background-color: #f9f9f9;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .footer {
            text-align: center;
            font-size: 0.9em;
            color: #777;
            padding: 10px;
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Nueva Tarea Creada</h1>
        </div>
        <div class="content">
            <p>Hola,</p>
            <p>Se ha creado una nueva tarea:</p>
            <div class="task-details">
                <p><strong>Título:</strong> {{ $task->title }}</p>
                <p><strong>Descripción:</strong> {{ $task->description }}</p>
                <p><strong>Fecha de vencimiento:</strong>
                    @if ($task->expiration_date)
                        {{ \Carbon\Carbon::parse($task->expiration_date)->format('d/m/Y') }}
                    @else
                        No definida
                    @endif
                </p>
            </div>
            <p>Gracias por usar nuestra aplicación.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Tu Aplicación. Todos los derechos reservados.</p>
            </
