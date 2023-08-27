<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<head>

    <head>
        <title>Contador Uno</title>

        <?php
        require_once 'clases.php';

        ?>
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
    <!-- contenido principal-->
    <div class="container-fluid mt-5">
        <!-- Container-->
        <div class="row">
            <div class="col-1">
            </div>

            <div class="col-10">
                <?php if (!empty($_POST)) {
                    if (isset($_POST["botonaniadir"])) {
                        // Procesar el formulario enviado
                        
                        foreach ($_POST as $key => $value) {
                            // Verificar que el campo comienza con "nombre_" o "edad_" para obtener los valores correspondientes
                            if (strpos($key, 'id_') === 0) {
                                $idPost = substr($key,3); // Obtener el ID del usuario
                                $idJugador = $value; // Obtener el nombre ingresado

                                // Obtener la edad correspondiente
                                $puntuacion_key = 'puntuacion_'.$idJugador;
                                $puntuacion = $_POST[$puntuacion_key];
                                if (DB::getInstance()->aniadirPuntos($idJugador, $puntuacion)) {
                                    echo '<div class="alert alert-success" role="alert">Puntos añadidos correctamente</div> ';
                                } else {
                                    echo '<div class="alert alert-danger" role="alert">error!</div>';
                                }
                            }
                        }
                        
                        /*
                        if (isset($_POST["id"])) {
                            if (DB::getInstance()->aniadirPuntos($_POST["id"], $_POST["puntuacion"])) {
                                echo '<div class="alert alert-success" role="alert">Puntos añadidos correctamente</div> ';
                            } else {
                                echo '<div class="alert alert-danger" role="alert">error!</div>';
                            }
                        }*/
                    }
                }
                ?>
                <div class="" style="justify-content: center;">
                    <h1>Añadir puntos</h1>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre del jugador</th>
                                <th>Puntos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form method="POST" action="">
                                <?php
                                $jugadores = DB::getInstance()->getJugadores();
                                foreach ($jugadores as $jugador) {
                                ?>
                                    <tr>
                                        <td><?php echo $jugador->getNombre(); ?></td>
                                        <td>
                                            <input type="number" id="puntuacion_<?php echo $jugador->getId(); ?>" name="puntuacion_<?php echo $jugador->getId(); ?>" value="0" />
                                            <input type="hidden" id="id_<?php echo $jugador->getId(); ?>" name="id_<?php echo $jugador->getId(); ?>"  value="<?php echo $jugador->getId(); ?>" />
                                        </td>

                                    </tr>
                                <?php } ?>

                        </tbody>
                    </table>
                    <input type="submit" id="botonaniadir" name="botonaniadir" value="añadir puntuacion" />
                    </form>
                    <?php
                    if (empty($jugadores)) {
                        echo "<h1 style='text-align: center;'>No hay jugadores</h1>";
                    } ?>
                </div>
            </div>
            <!--col-8 -->
            <div class="col-1">
            </div>
        </div> <!-- row principal-->
    </div> <!-- Container-->
</body>


</html>