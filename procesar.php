<?php
/*David Rey Sanchez*/
/*Alejandro Aguilar Coarral*/
/*Carlos Baquero Dominguez*/



if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



$servidor = "localhost";
$usuario = "root";
$password = "";
$baseDeDatps = "eventos_deportivos";

$conn = new mysqli($servidor, $usuario, $password, $baseDeDatps);

function buscarEventos($buscar) {
    global $conn;
    $sql = "SELECT * FROM eventos LEFT JOIN organizadores ON eventos.id_organizador=organizadores.id WHERE nombre_evento LIKE '%$buscar%'";
    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
      $filas = [];
      while ($fila = $resultado->fetch_assoc()) {
        $filas[] = $fila;
      }
      return $filas;
    } else {
      return false;
    }
}

function mostrarEventos($ordenarPor = 'id_eventos', $orden = 'ASC')
{
    global $conn;

    if ($conn->connect_error) {
        die("Fallo en la conexión con la base de datos: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM eventos LEFT JOIN organizadores ON eventos.id_organizador=organizadores.id ORDER BY $ordenarPor $orden";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $filas = [];
        while ($fila = $resultado->fetch_assoc()) {
            $filas[] = $fila;
        }
        return $filas;
    } else {
        return false;
    }
}

function crearEditarEvento()
{


    global $conn;

    $id = $_POST["id_eventos"];
    $nombre_evento = $_POST["nombre_evento"];
    $tipo_deporte = $_POST["tipo_deporte"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $ubicacion = $_POST["ubicacion"];
    $id_organizador = $_POST["id_organizador"];

    $errores = "";

    if (empty($nombre_evento)) {
        $errores .= "<br>" . "Porfavor rellene el nombre del evento";
    }
    if (empty($tipo_deporte)) {
        $errores .= "<br>" . "Porfavor rellene el tipo de deporte ";
    }
    if (empty($fecha)) {
        $errores .= "<br>" . "Porfavor rellene la fecha";
    }
    if (empty($hora)) {
        $errores .= "<br>" . "Porfavor rellene la hora";
    }
    if (empty($ubicacion)) {
        $errores .= "<br>" . "Porfavor rellene la ubicacion";
    }



    if (!empty($errores)) {
        if (empty($id)) {
            $_SESSION['errores'] = $errores;
            header("Location: eventos.php");
            exit();
        } else {
            $_SESSION['errores'] = $errores;
            header("Location: eventos.php?id_eventos=" . $id);

            exit();
        }
    } else {

        if (empty($id)) {

            $sql = "INSERT INTO eventos (nombre_evento,tipo_deporte,fecha,hora,ubicacion,id_organizador) VALUES ('$nombre_evento','$tipo_deporte','$fecha','$hora','$ubicacion','$id_organizador')";

            $resultado = $conn->query($sql);

            if ($resultado) {
                header("Location: index.php");
                exit();
            }
        } else {

            $sql = "UPDATE eventos SET nombre_evento = '$nombre_evento', tipo_deporte ='$tipo_deporte', fecha='$fecha',  hora='$hora', ubicacion='$ubicacion', id_organizador='$id_organizador'  WHERE id_eventos = '$id'";
            $resultado = $conn->query($sql);

            if ($resultado) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error al actualizar datos: " . $conn->error;
            }
        }
    }
}

function obtenerEvento()
{
    global $conn;
    $id = $_GET["id_eventos"];

    if ($conn->connect_error) {
        die("Fallo en la conexión con la base de datos: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM eventos WHERE id_eventos='$id' ";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        return $fila;
    } else {
        return false;
    }
}

function eliminarEventos()
{
    global $conn;
    $id = $_GET["id_eventos"];

    $sql = "DELETE FROM eventos WHERE id_eventos='$id'";
    $resultado = $conn->query($sql);

    if ($resultado) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar datos: " . $conn->error;
    }
}




function mostrarOrganizadores()
{
    global $conn;

    if ($conn->connect_error) {
        die("Fallo en la conexión con la base de datos: " . $conn->connect_error);
    }

    $sql = " SELECT * FROM organizadores";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $filas = [];

        while ($fila = $resultado->fetch_assoc()) {
            $filas[] = $fila;
        }

        return $filas;
    } else {
        return false;
    }
}

function crearEditarOrganizadores()
{
    global $conn;

    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];

    $errores = "";

    if (empty($nombre)) {
        $errores .= "<br>" . "Porfavor rellene el nombre";
    }
    if (strpos($email, '@') === false) {
        $errores .= "<br>" . "Por favor, el email debe contener '@'.";
    }
    if (empty($email)) {
        $errores .= "<br>" . "Porfavor rellene el email";
    }
    if (empty($telefono)) {
        $errores .= "<br>" . "Porfavor rellene la fecha";
    }
    if (!(is_numeric($telefono))) {
        $errores .= "<br>" . "Porfavor el teléfono debe ser tipo numérico";
    }
    if ($telefono < 100000000 || $telefono > 999999999) {
        $errores .= "<br>" . "Porfavor el numero de teléfono tiene que tener 9 digitos";
    }







    if (!empty($errores)) {
        if (empty($id)) {
            $_SESSION['errores'] = $errores;
            header("Location: organizadores.php");
            exit();
        } else {
            $_SESSION['errores'] = $errores;
            header("Location: organizadores.php?id=" . $id);

            exit();
        }
    }


    if (empty($id)) {

        $sql = "INSERT INTO organizadores (nombre, email, telefono) VALUES ('$nombre','$email','$telefono')";
        $resultado = $conn->query($sql);
        if ($resultado) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error al actualizar datos: " . $conn->error;
        }
    } else {
        $sql = "UPDATE organizadores SET nombre='$nombre', email='$email', telefono='$telefono' WHERE id=$id";
        $resultado = $conn->query($sql);
        if ($resultado) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error al actualizar datos: " . $conn->error;
        }
    }
}

function obtenerOrganizador()
{
    global $conn;
    $id = $_GET["id"];

    if ($conn->connect_error) {
        die("Fallo en la conexión con la base de datos: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM organizadores WHERE id='$id' ";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        return $fila;
    } else {
        return false;
    }
}

function eliminarOrganizador()
{
    global $conn;
    $id = $_GET["id"];

    $sql = "DELETE FROM organizadores WHERE id='$id'";
    $resultado = $conn->query($sql);

    if ($resultado) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar datos: " . $conn->error;
    }
}

function seleccionarOrganizador()
{

    global $conn;
    $id = $_GET["id_eventos"];


    $sql = "SELECT * FROM eventos JOIN organizadores ON eventos.id_organizador=organizadores.id WHERE id_eventos='$id' ";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();

        return $fila['nombre'];
    } else {
        return false;
    }
}

if ($_POST) {

    if ($_POST["valorFormulario"] === "organizadores") {
        crearEditarOrganizadores();
    } else crearEditarEvento();
}

if (isset($_GET["accion"])) {


    if ($_GET["accion"] === "borrarOrganizador") {
        eliminarOrganizador();
    } else if ($_GET["accion"] === "borrarEvento") {
        eliminarEventos();
    }
}

