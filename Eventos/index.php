<?php
$url_api = 'https://randomuser.me/api/?results=10';
$conexion = curl_init($url_api);
curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);
curl_setopt($conexion, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
$respuesta = curl_exec($conexion);

if (curl_errno($conexion)) {
    echo 'Error en la solicitud: ' . curl_error($conexion);
    curl_close($conexion);
    exit;
}

curl_close($conexion);

$datos = json_decode($respuesta, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo 'Error al decodificar JSON: ' . json_last_error_msg();
    exit;
}

$usuarios = $datos['results'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Género</th>
                <th>País</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><img src="<?php echo htmlspecialchars($usuario['picture']['thumbnail']); ?>" alt="Foto"></td>
                    <td><?php echo htmlspecialchars($usuario['name']['first'] . ' ' . $usuario['name']['last']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['gender']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['location']['country']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
