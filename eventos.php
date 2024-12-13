<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Carlos Alberto Baquero Domínguez" />
    <meta name="author" content="David Rey Sánchez" />
    <meta name="author" content="Alejandro Aguilar Corrales" />
    <title>Desarollo Crud</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
    <?php
    include "procesar.php";


    ?>

</head>

<body>


    <?php if ($_GET) {
        $evento = obtenerEvento();
        $organizadores = mostrarOrganizadores();
        $nombre = seleccionarOrganizador();
        if (isset($_SESSION['errores'])) {
            echo "<div class='alert alert-danger'>" . $_SESSION['errores'] . "</div>";
            unset($_SESSION['errores']);
        }

    ?>

        <h1 class="my-4 p-2 text-center">EDITAR EVENTO</h1>

    <?php } else {
        $evento = "";
        $organizadores = mostrarOrganizadores();
        $nombre = "";
        if (isset($_SESSION['errores'])) {
            echo "<div class='alert alert-danger'>" . $_SESSION['errores'] . "</div>";
            unset($_SESSION['errores']);
        }



    ?>

        <h1 class="my-4 p-2 text-center">CREAR EVENTO</h1>

    <?php } ?>

    <div class="container ">
        <div class="row d-flex justify-content-center align-items-center ">
            <form class="col-4 bg-secondary-subtle p-3 rounded" action="procesar.php" method="POST">

                <input type="hidden" name="id_eventos" id="id_eventos"
                    <?php if ($evento) { ?> value="<?= $evento["id_eventos"] ?>" <?php } ?>>
                <input type="hidden" name="valorFormulario" id="valorFormulario" value="eventos">


                <div class="mb-3">
                    <label class="form-label" for="nombre_evento">Nombre del evento:</label>
                    <input class="form-control" type="text" name="nombre_evento" id="nombre_evento"
                        <?php if ($evento) { ?> value="<?= $evento["nombre_evento"] ?>" <?php } ?>>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="tipo_deporte">Tipo de deporte:</label>
                    <input class="form-control" type="text" name="tipo_deporte" id="tipo_deporte"
                        <?php if ($evento) { ?> value="<?= $evento["tipo_deporte"] ?>" <?php } ?>>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="fecha">Fecha:</label>
                    <input class="form-control" type="date" name="fecha" id="fecha"
                        <?php if ($evento) { ?> value="<?= $evento["fecha"] ?>" <?php } ?>>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="hora">Hora:</label>
                    <input class="form-control" type="time" name="hora" id="hora"
                        <?php if ($evento) { ?> value="<?= $evento["hora"] ?>" <?php } ?>>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="ubicacion">Ubicación:</label>
                    <input class="form-control" type="text" name="ubicacion" id="ubicacion"
                        <?php if ($evento) { ?> value="<?= $evento["ubicacion"] ?>" <?php } ?>>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="id_organizador">Organizador:</label>
                    <select name="id_organizador" id="id_organizador">

                        <?php foreach ($organizadores as $organizador) { ?>


                            <option

                                <?php if ($organizador['nombre'] === $nombre) { ?>
                                selected
                                <?php } ?>

                                value=" <?= $organizador['id'] ?> ">

                                <?= $organizador["nombre"] ?>


                            </option>


                        <?php } ?>



                    </select>
                </div>

                <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-dark " type="submit">ENVIAR</button>
                </div>

            </form>
        </div>

        <div class="row text-center m-4 ">
            <a href="./index.php"><button class="btn btn-dark ">VOLVER</button></a>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
    </script>
</body>

</html>