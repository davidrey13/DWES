<?php

$servidor = "localhost";
$usuario = "root";
$password = "";
$baseDeDatos = "eventos_deportivos";

$conn = new mysqli($servidor, $usuario, $password, $baseDeDatos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}



$archivoInsertar = fopen("C:\\xampp\\htdocs\\david\\CRUDEVENTOSDEPORTIVOS\\añadirEVENTOS.csv", "r");

if ($archivoInsertar == false) {
    die("Error al abrir el archivo.");
}

fgetcsv($archivoInsertar);

while (($row = fgetcsv($archivoInsertar)) !== false) {

    $id_eventos = $row[0];
    $nombre_evento = $row[1];
    $tipo_deporte = $row[2];
    $fecha = $row[3];
    $hora = $row[4];
    $ubicacion = $row[5];
    $id_organizador = $row[6];

    $sql = $sql = "INSERT INTO eventos (id_eventos, nombre_evento, tipo_deporte, fecha, hora, ubicacion, id_organizador) 
        VALUES ('$id_eventos',  '$nombre_evento', '$tipo_deporte', '$fecha', '$hora', '$ubicacion', '$id_organizador')";
    $resultado = $conn->query($sql);

    if ($resultado) {
        echo "Evento insertado correctamente: $nombre_evento\n";
    } else {
        echo "Error al insertar el evento: " . $conn->error . "\n";
    }
}

fclose($archivoInsertar);
$conn->close();