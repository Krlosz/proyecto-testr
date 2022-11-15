<?php
// encabezados obligatorios
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
// incluir archivos de conexion y objetos
include_once '../config/conexion.php';
include_once '../objectos/agenda.php';
// obtener conexion a la base de datos
$conex = new Conexion();
$db = $conex->obtenerConexion();
// preparar el objeto producto
$product = new agenda($db);
// set ID property of record to read
$product->id = isset($_GET['id']) ? $_GET['id'] : die();
// leer los detalles del producto a editar
$product->readOne();
if ($product->titulo != null) {
    // creacion del arreglo
    $product_arr = array(
        "id" => $product->id,
        "titulo" => $product->titulo,
        "fecha" => $product->fecha,
        "hora_inicio" => $product->hora_inicio,
        "hora_final" => $product->hora_final,
        "estado" => $product->estado,
        "descripcion" => $product->descripcion,
        "id_actividad" => $product->id_actividad,
        "ubicacion" => $product->ubicacion,
        "actividad" => $product->actividad,
    );
    // asignar codigo de respuesta - 200 OK
    http_response_code(200);
    // mostrarlo en formato json
    echo json_encode($product_arr);
}