<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>'Contacto a través del formulario'</title>
</head>
<body>
    <p>Contacto recibido a través del formulario.</p>
    <p>Estos son los datos del usuario:</p>
    <ul>
        <li>Nombre: {{ $name }}</li>
        <li>Teléfono: {{ $email }}</li>
    </ul>
    <p>Consulta:</p>
    <p>
        {{ $user_message }}
    </p>
</body>
</html>