<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Tarea Completada</title>
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
            background: linear-gradient(45deg, #1e3c72, #2a5298, #ff6e7f, #bfe9ff);
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
            <h1>Tarea Completada</h1>
        </div>
        <div class="content">
            <p>Hola,</p>
            <p>La tarea con el título <strong>{{ $taskTitle }}</strong> ha sido completada.</p>
            <div class="task-details">
                <p><strong>Descripción:</strong> {{ $taskDescription }}</p>
                <p><strong>Fecha de finalización:</strong> {{ $completionDate }}</p>
            </div>
            <p>Gracias por usar nuestra aplicación.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Tu Aplicación. Todos los derechos reservados.</p>
        </div>
    </div>
</body>

</html>
