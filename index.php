</html>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<head>

    <head>
        <title>Contador Uno</title>
        <!-- Creo la navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a href="index.php" class="navbar-brand">
                    <img src="https://freepngimg.com/save/86531-10-emblem-area-onecard-phase-uno/3664x3248" alt="Logo" width="50" height="50" style="margin-left:2%" class="d-inline-block">

                </a>
                <a class="navbar-brand" href="#">Contador</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a href="aniadirpuntos.php" class="nav-link">Añadir puntuaciones</a>
                        </li>
                        <li class="nav-item">
                            <a href="aniadirjugadores.php" class="nav-link">Añadir jugadores</a>
                        </li>
                        <li class="nav-item">
                            <a href="puntuaciones.php" class="nav-link">Resultados</a>
                        </li>
                        <li class="nav-item">
                            <a href="reglas.php" class="nav-link">Reglas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </head>

<body>

<table class="table table-striped table-hover table-bordered">
<tbody>
    <td><button class="btn btn-primary">  <a href="aniadirpuntos.php"class="text-white">Añadir puntuaciones</a></button></td>
    <td><button class="btn btn-primary">    <a href="aniadirjugadores.php" class="text-white">Añadir jugadores</a></button></td>
    <td><button class="btn btn-primary">  <a href="puntuaciones.php" class="text-white">Resultados</a></button></td>
</tbody>
</table>
</body>


</html>