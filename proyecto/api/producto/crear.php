<?php
// encabezados obligatorios
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Max-Age:3600");
header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With"); // obtener conexion de base de datos
include_once '../config/conexion.php';
// instanciar el objeto producto
include_once '../objectos/agenda.php';
$conex = new Conexion();
$db = $conex->obtenerConexion();
$producto = new agenda($db);
// obtener los datos
$data = json_decode(file_get_contents("php://input"));
// asegurar que los datos no esten vacios


if (
    !empty($data->titulo) &&
    !empty($data->fecha) &&
    !empty($data->hora_inicio) &&
    !empty($data->hora_final) &&
    !empty($data->estado) &&
    !empty($data->descripcion) &&
    !empty($data->actividad) &&
    !empty($data->ubicacion)
) {
    // asignar valores de propiedad a producto

    $producto->titulo = $data->titulo;
    $producto->fecha = $data->fecha;
    $producto->hora_inicio = $data->hora_inicio;
    $producto->hora_final = $data->hora_final;
    $producto->estado = $data->estado;
    $producto->descripcion = $data->descripcion;
    $producto->actividad = $data->actividad;
    $producto->ubicacion = $data->ubicacion;


    // crear el producto
    if ($producto->crear()) {
        // asignar codigo de respuesta - 201 creado
        http_response_code(201);
        // informar al usuario
        echo json_encode(array("message" => "El dia ha sido creado."));
    }
    // si no puede crear el producto, informar al usuario
    else {
        // asignar codigo de respuesta - 503 servicio no disponible
        http_response_code(503);
        // informar al usuario
        var_dump($producto);
        echo json_encode(array("message" => "No se pudo crear la activiad."));
    }
}
// informar al usuario que los datos estan incompletos
else {
    // asignar codigo de respuesta - 400 solicitud incorrecta
    http_response_code(400);
    // informar al usuario


    echo json_encode(array("message" => "No se puede crear la actividad. Los datos
   están incompletos."));
}