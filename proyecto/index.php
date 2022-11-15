<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Listar</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container bg-light vh-100">
        <h1 class="text-center m-3">Agenda</h1>

        <div class="menu">
            <a href="reportes.php">
                <p class="botn">Reportes</p>
            </a>

        </div>

        <!--acordeon-->

        <div class="accordion accordion-flush" id="accordionFlushExample">
            <!--inicia el ford-->
            <?php require_once("class/agenda.php");
            $obj_actividad = new agenda();
            $actividades = $obj_actividad->listar();
            $index = 0;

            if ($actividades == null) {
                echo "No hay actividades";
            } else {
                $nactividades = count($actividades);
                //inicio del select de actividades
                if ($nactividades > 0) : ?>
            <?php foreach ($actividades as $resultado) :
                        foreach ($resultado as $dias) :
                            $index++ ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne<?php echo $valor = $index ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne<?php echo $valor = $index ?>" aria-expanded="false"
                        aria-controls="flush-collapseOne<?php echo $valor = $index ?>">
                        <?php echo $dias['titulo'] . ' Fecha:     ' .  $dias['fecha']   ?>
                    </button>
                </h2>
                <div id="flush-collapseOne<?php echo $valor = $index ?>" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingOne<?php echo $valor = $index ?>"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <h4><strong>Actividad: </strong><?php echo  $dias['actividad']  ?></h4>
                        <h5><strong>Fecha: </strong><?php echo $dias['fecha'] ?></h5>
                        <h5><strong>Horario:
                            </strong><?php echo $dias['hora_inicio'] . " - " . $dias['hora_final']  ?></h5>
                        <h5><strong>Ubicacion: </strong><?php echo $dias['ubicacion'] ?></h5>
                        <hr>
                        <?php echo $dias['descripcion'] ?>
                        <hr>
                        <a class="btn btn-warning" href="editar.php?ID=<?php echo $dias['id'] ?>">Actualizar</a>
                        <a class="btn btn-danger" href="eliminar.php?ID=<?php echo $dias['id'] ?>">Eliminar</a>
                    </div>
                </div>
            </div>
            <?php
                        endforeach;
                    endforeach; ?>
            <?php endif ?>
        </div>
        <?php } ?>

        <div class="d-grid gap-2 mt-5">
            <a href="formulario.php" class="btn btn-primary">Crear una actividad</a>
        </div>

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
        </script>
    </div>
</body>

</html>