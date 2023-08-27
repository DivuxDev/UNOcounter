<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="css.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    <?php if (!empty($_POST)) {
        if (isset($_POST["vaciarpuntos"])) {

            if (DB::getInstance()->vaciarPuntos()) {
                echo '<div class="alert alert-success" role="alert">Lista borrada correctamente</div> ';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error!</div>';
            }
        }
    }
    ?>

<body>
    <!-- contenido principal-->
    <div class="container-fluid mt-5">
        <!-- Container-->

        <div class="row">
            <div class="col-1">
            </div>

            <div class="col-10">

                <div class="" style="justify-content: center;">
                    <h1>Puntuaciones</h1>
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Posición</th>
                                <th scope="col">Nombre del jugador</th>
                                <th scope="col">Puntuación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $puntuaciones = DB::getInstance()->getPuntuaciones();

                            $i=0;

                            $arrayPuntuaciones = array(); //Genero el array para guardar cada arra yde puntuaciones

                            foreach ($puntuaciones as $puntuacion) {
                                echo $puntuacion->getId();
                                $arrayPuntuaciones[] = DB::getInstance()->getPuntuacionesPorID($puntuacion->getId()); //Genero un array con todas las puntuaciones de cada jugador
                                $i++;

                            ?>
                                <tr scope="col">
                                    <td scope="row"><?php echo $i ?></td>
                                    <td scope="row"><?php echo $puntuacion->getNombre(); ?></td>
                                    <td scope="row"><?php echo $puntuacion->getPuntos(); ?></td>
                                </tr>

                            <?php
                            }

                            ?>

                        </tbody>
                    </table>
                    <?php
                    if (empty($puntuaciones)) {
                        echo "<h2 style='text-align: center;'>No hay puntuaciones</h2>";
                    }
                    ?>

                    <!-- BOTON PARA VACIAR LOS RESULTADOS-->
                    <form method="POST" action="">
                        <input class="btn btn-danger" type="submit" name="vaciarpuntos" id="vaciarpuntos" value="Borrar todos los puntos.">
                    </form>


                    <!-- GRAFICOS DE LOS JUGADORES-->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <canvas id="myChart"></canvas>

                    <script>
                        // Obtener los datos del array PHP
                        var data = <?php echo json_encode($arrayPuntuaciones); ?>;

                        console.log(data);

                        // Obtener el número máximo de resultados de un jugador
                        var maxResultados = 0;
                        for (var i = 0; i < data.length; i++) {
                            var jugadorData = data[i];
                            if (jugadorData.length > maxResultados) {
                                maxResultados = jugadorData.length;
                            }
                        }

                        // Generar las etiquetas de las partidas
                        var labels = [];
                        for (var i = 1; i <= maxResultados; i++) {
                            labels.push('Ronda ' + i);
                        }

                        // Preparar los datos para el gráfico
                        var datasets = [];
                        var playerIdMap = {};
                        var palette = [
                            'red',
                            'blue',
                            'green',
                            'orange',
                            'purple',
                            'yellow',
                            'cyan',
                            'magenta',
                            'brown',
                            'gray'
                        ];

                        for (var i = 0; i < data.length; i++) {
                            var jugadorData = data[i];
                            var playerId = jugadorData[0].id;
                            var playerName = jugadorData[0].nombre;

                            // Si el jugador no está en el mapa, agregarlo con un nuevo conjunto de datos
                            if (!playerIdMap[playerId]) {
                                playerIdMap[playerId] = {
                                    label: playerName,
                                    data: [],
                                    borderColor: palette[i % palette.length],
                                    fill: false
                                };
                                datasets.push(playerIdMap[playerId]);
                            }

                            // Agregar los puntos del jugador al conjunto de datos correspondiente
                            for (var j = 0; j < jugadorData.length; j++) {
                                playerIdMap[playerId].data.push(jugadorData[j].puntos);
                            }

                            // Si el jugador tiene menos resultados que el máximo, completar con valores nulos
                            if (jugadorData.length < maxResultados) {
                                var diferencia = maxResultados - jugadorData.length;
                                for (var k = 0; k < diferencia; k++) {
                                    playerIdMap[playerId].data.push(null);
                                }
                            }
                        }

                        // Crear el gráfico con Chart.js
                        var ctx = document.getElementById('myChart').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: datasets
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>


                </div>
            </div>
            <!--col-8 -->
            <div class="col-1">
            </div>
        </div> <!-- row principal-->
    </div> <!-- Container-->
</body>


</html>