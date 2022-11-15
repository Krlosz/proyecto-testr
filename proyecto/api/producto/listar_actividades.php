<?php
//encabezados obligatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// incluir archivos de conexion y objetos
include_once '../config/conexion.php';
include_once '../objectos/agenda.php';
// inicializar base de datos y objeto producto
$conex = new Conexion();
$db = $conex->obtenerConexion();
// inicializar objeto
$producto = new agenda($db);
// query productos
$stmt = $producto->readactivity();
$num = $stmt->rowCount();
// verificar si hay mas de 0 registros encontrados
if ($num > 0) {
    // arreglo de productos
    $products_arr = array();
    $products_arr["actividades"] = array();
    // obtiene todo el contenido de la tabla
    // fetch() es mas rapido que fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extraer fila
        // esto creara de $row['nombre'] a
        // solamente $nombre
        extract($row);
        $product_item = array(
            "id" => $id,
            "actividad" => $actividad
        );
        array_push($products_arr["actividades"], $product_item);
    }
    // asignar codigo de respuesta - 200 OK
    http_response_code(200);
    // mostrar productos en formato json
    echo json_encode($products_arr);
} else {
    // asignar codigo de respuesta - 404 No encontrado
    http_response_code(404);
    // informarle al usuario que no se encontraron productos
    echo json_encode(
        array("message" => "No hay actividades el dia de hoy.")
    );
}