<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reportes</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
</head>

<body>
    <div class="container bg-light vh-100">
        <h1 class="text-center m-3">Consultar Actividades</h1>
        <div class="col align-self-end">
            <a href="index.php">
                <p class="btn btn-outline-dark">Volver</p>
            </a>
        </div>
        <div class="menu2 mb-2">
            <form action="buscar.php" method="POST">
                <p>Consulta por Actividad</p>
                <span>
                    <?php
                    require_once("class/agenda.php");
                    $obj_actividad = new agenda();
                    $actividades = $obj_actividad->select_actividades();

                    $nactividades = count($actividades);

                    //inicio del select de actividades
                    if ($nactividades > 0) : ?>
                        <select class="form-select" name="ID" placeholder="Username">
                            <?php foreach ($actividades as $resultado) :
                                foreach ($resultado as $tareas) : ?>

                                    <option value=<?php print $tareas['id'] ?>><?php print $tareas['actividad'] ?></option>
                            <?php endforeach;
                            endforeach; ?>
                        </select>
                        <button class="btn btn-primary mt-3" type="submit">Consultar</button>
                </span>
            <?php endif ?>

            </form>
        </div>
        <!--Find del select-->
        <div>
            <form action="buscarfechas.php" method="POST">
                <p>Consulta por Fecha</p>
                <div>
                    <div class="input-group mb-3">
                        <label for="exampleInputEmail1" class="form-label fs-3"></label>
                        <input type="date" class="form-control" id="desde" name="desde" aria-describedby="emailHelp" />
                        <span class="input-group-text">-</span>
                        <label for="exampleInputEmail1" class="form-label fs-3"></label>
                        <input type="date" class="form-control" id="hasta" name="hasta" aria-describedby="emailHelp" />
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Consultar</button>
            </form>
        </div>

        <!--acordeon-->



</body>