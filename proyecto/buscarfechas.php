<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reportar</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container bg-light vh-100">
        <h1 class="text-center m-3">Reporte por Rango de fecha</h1>

        <div class="menu">
            <a href="formulario.php">
                <p class="botn">Crear Actividad</p>
            </a>
            <a href="reportes.php">
                <p class="botn">Volver</p>
            </a>
            <a href="index.php">
                <p class="botn">Home</p>
            </a>
        </div>
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <?php
            $desde = $_POST['desde'];
            $hasta = $_POST['hasta'];
            require_once("class/agenda.php");
            $obj_actividad = new agenda();
            $actividades = $obj_actividad->reportarFecha($desde, $hasta);
            $index = 0;
            $nactividades = count($actividades); ?>

            <h2>Mostrando actividades Desde: <?php echo $desde ?> Hasta: <?php echo $hasta ?></h2>
            <?php if ($nactividades > 0) : ?>
                <?php foreach ($actividades as $resultado) :
                    $index++; ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne<?php echo $valor = $index ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne<?php echo $valor = $index ?>" aria-expanded="false" aria-controls="flush-collapseOne<?php echo $valor = $index ?>">
                                <?php echo $resultado['titulo'];  ?>
                            </button>
                        </h2>
                        <div id="flush-collapseOne<?php echo $valor = $index ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne<?php echo $valor = $index ?>" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <h5><strong>Fecha: </strong><?php echo $resultado['fecha'] ?></h5>
                                <h5><strong>Horario:
                                    </strong><?php echo $resultado['hora_inicio'] . " - " . $resultado['hora_final']  ?></h5>
                                <h5><strong>Ubicacion: </strong><?php echo $resultado['ubicacion'] ?></h5>
                                <hr>
                                <?php echo $resultado['descripcion'] ?>
                                <hr>
                                <a class="btn btn-warning" href="editar.php?ID=<?php echo $resultado['id'] ?>">Actualizar</a>
                                <a class="btn btn-danger" href="eliminar.php?ID=<?php echo $resultado['id'] ?>">Eliminar</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
        </script>

</body>

</html>