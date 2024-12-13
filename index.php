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

  $ordenarPor = isset($_GET['ordenarPor']) ? $_GET['ordenarPor'] : 'id_eventos';
  $orden = isset($_GET['orden']) ? $_GET['orden'] : 'ASC';
  $buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';
  
  $filasOrganizadores = mostrarOrganizadores();
  
  if ($buscar) {
      $filasEventos = buscarEventos($buscar);
  } else {
      $filasEventos = mostrarEventos($ordenarPor, $orden);
  }
  ?>

</head>

<body>
  <div class="container">
    <h1 class="text-center m-5 p-3">GESTIÓN DE EVENTOS DEPORTIVOS</h1>
    <div class="container bg-secondary-subtle p-4">
      <div class="row">
        <div class="container col-xl-6">
          <div class="container mb-3">

            <div class="row">
              <a href="eventos.php" class="col-2 "><button type="button" class="btn btn-dark ">CREAR</button></a>
              <h3 class="text-center col-10">EVENTOS</h3>
            </div>
          </div>
          <form action="index.php" method="get">
            <input type="text" name="buscar" placeholder="Buscar evento...">
            <button type="submit">Buscar</button>
          </form>
          <table class="table text-center table-striped table-bordered">
            <thead class="align-middle">
            <tr>
              
            <th><a href="index.php?ordenarPor=id_eventos&orden=<?= $orden === 'ASC' ? 'DESC' : 'ASC' ?>">ID <?= $orden === 'ASC' ? '↑' : '↓' ?></a></th>
            <th><a href="index.php?ordenarPor=nombre_evento&orden=<?= $orden === 'ASC' ? 'DESC' : 'ASC' ?>">Nombre del evento <?= $orden === 'ASC' ? '↑' : '↓' ?></a></th>
            <th><a href="index.php?ordenarPor=tipo_deporte&orden=<?= $orden === 'ASC' ? 'DESC' : 'ASC' ?>">Tipo de deporte <?= $orden === 'ASC' ? '↑' : '↓' ?></a></th>
            <th><a href="index.php?ordenarPor=fecha&orden=<?= $orden === 'ASC' ? 'DESC' : 'ASC' ?>">Fecha <?= $orden === 'ASC' ? '↑' : '↓' ?></a></th>
            <th><a href="index.php?ordenarPor=hora&orden=<?= $orden === 'ASC' ? 'DESC' : 'ASC' ?>">Hora <?= $orden === 'ASC' ? '↑' : '↓' ?></a></th>
            <th><a href="index.php?ordenarPor=ubicacion&orden=<?= $orden === 'ASC' ? 'DESC' : 'ASC' ?>">Ubicación <?= $orden === 'ASC' ? '↑' : '↓' ?></a></th>
            <th>Organizador</th>
        </tr>
            </thead>

            <tbody class="align-middle">
        <?php if ($filasEventos) {
            foreach ($filasEventos as $filaEvento) { ?>
                <tr>
                    <th> <?= $filaEvento["id_eventos"] ?> </th>
                    <td> <?= $filaEvento["nombre_evento"] ?> </td>
                    <td> <?= $filaEvento["tipo_deporte"] ?> </td>
                    <td> <?= $filaEvento["fecha"] ?> </td>
                    <td> <?= $filaEvento["hora"] ?> </td>
                    <td> <?= $filaEvento["ubicacion"] ?> </td>
                    <td> <?= $filaEvento["nombre"] ?> </td>
                    <td>
                        <a href="eventos.php?id_eventos=<?= $filaEvento["id_eventos"] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 a.5l-1.5 1.5-1-1 1.5-1.5a.5.5 0 0 1 .5 0zM1 13.5V15h1.5l9-9-1.5-1.5-9 9H1z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
            <?php }
        } ?>
    </tbody>
</table>
        </div>


        <div class="container col-xl-6">
          <div class="container mb-3">

            <div class="row">
              <a href="organizadores.php" class="col-2 "><button type="button" class="btn btn-dark ">CREAR</button></a>
              <h3 class="text-center col-10">ORGANIZADORES</h3>
            </div>
          </div>
          <table class="table text-center table-striped table-bordered">
            <thead class="align-middle">
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
              </tr>
            </thead>

            <tbody class="align-middle">

              <?php if ($filasOrganizadores) {
                  foreach ($filasOrganizadores as $filaOrganizador) { ?>
                  <tr>
                    <th> <?= $filaOrganizador["id"] ?> </th>
                    <td> <?= $filaOrganizador["nombre"] ?> </td>
                    <td> <?= $filaOrganizador["email"] ?> </td>
                    <td> <?= $filaOrganizador["telefono"] ?> </td>
                    <td>
                      <a href="organizadores.php?id=<?= $filaOrganizador[
                          "id"
                      ] ?>">
                        <svg xmlns="htdttp://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                      </a>
                    </td>
                    <td>
                      <a class="text-danger" onclick=" return confirm('¿Seguro que quieres eliminar el organizador?')" href="procesar.php?id=<?= $filaOrganizador[
                          "id"
                      ] ?>&accion=borrarOrganizador">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                          <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                        </svg>
                      </a>
                    </td>


                  </tr>
              <?php }
              } ?>
            </tbody>

          </table>

        </div>
      </div>

    </div>
  </div>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>