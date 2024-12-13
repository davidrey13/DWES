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
        $organizador = obtenerOrganizador();
        if (isset($_SESSION['errores'])) {
            echo "<div class='alert alert-danger'>" . $_SESSION['errores'] . "</div>";
            unset($_SESSION['errores']);
        }

    ?>

        <h1 class="my-4 p-2 text-center">EDITAR ORGANIZADOR</h1>

    <?php } else {
        $organizador = "";
        if (isset($_SESSION['errores'])) {
            echo "<div class='alert alert-danger'>" . $_SESSION['errores'] . "</div>";
            unset($_SESSION['errores']);
        }
    ?>

        <h1 class="my-4 p-2 text-center">CREAR ORGANIZADOR</h1>

    <?php } ?>

    <div class="container ">
        <div class="row d-flex justify-content-center align-items-center ">
            <form class="col-4 bg-secondary-subtle p-3 rounded" action="procesar.php" method="POST">

                <input type="hidden" name="id" id="id"
                    <?php if ($organizador) { ?> value="<?= $organizador["id"] ?>" <?php } ?>>
                <input type="hidden" name="valorFormulario" id="valorFormulario" value="organizadores">


                <div class="mb-3">
                    <label class="form-label" for="nombre">Nombre del organizador:</label>
                    <input class="form-control" type="text" name="nombre" id="nombre"
                        <?php if ($organizador) { ?> value="<?= $organizador["nombre"] ?>" <?php } ?>>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Email:</label>
                    <input class="form-control" type="text" name="email" id="email"
                        <?php if ($organizador) { ?> value="<?= $organizador["email"] ?>" <?php } ?>>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="telefono">Número de teléfono:</label>
                    <input class="form-control" type="text" name="telefono" id="telefono"
                        <?php if ($organizador) { ?> value="<?= $organizador["telefono"] ?>" <?php } ?>>
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