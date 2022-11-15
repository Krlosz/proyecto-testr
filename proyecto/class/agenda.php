<?php
require_once('modelo.php');

class agenda extends modeloCredencialesBD
{
    protected $titulo;
    protected $fecha;
    protected $hora_inicio;
    protected $hora_final;
    protected $ubicacion;
    protected $actividades;
    protected $descripcion;
    protected $estado;

    public function __construct()
    {
        parent::__construct();
    }

    public function insert(
        $titulo,
        $fecha,
        $hora_inicio,
        $hora_final,
        $estado,
        $descripcion,
        $actividades,
        $ubicacion
    ) {
        $fields = array(
            "titulo" => "${titulo}",
            "fecha" => "${fecha}",
            "hora_inicio" => "${hora_inicio}",
            "hora_final" => "${hora_final}",
            "estado" => $estado,
            "descripcion" => "${descripcion}",
            "actividad" => "${actividades}",
            "ubicacion" => "${ubicacion}"

        );

        $fields_string = json_encode($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/proyecto/api/producto/crear.php");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        $data = curl_exec($ch);

        curl_close($ch);
    }

    public function listar()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/proyecto/api/producto/leer.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resultado = curl_exec($ch);

        $valores = json_decode($resultado, true);
        /////////////////
        if (!$valores) {
            echo "Fallo al consultar las actividades";
        } else {
            return $valores;
        }
        curl_close($ch);
    }

    public function select_actividades()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/proyecto/api/producto/listar_actividades.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resultado = curl_exec($ch);

        $valores = json_decode($resultado, true);

        if (!$valores) {
            echo "Fallo al consultar las actividades";
        } else {
            return $valores;
        }
        curl_close($ch);
    }

    public function select_byid($ID)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/proyecto/api/producto/leer_uno.php?id=$ID");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resultado = curl_exec($ch);

        $valores = json_decode($resultado, true);

        if (!$valores) {
            echo "Fallo al consultar las actividades";
        } else {
            return $valores;

            $this->_db->close();
        }
    }

    public function eliminar($ID)
    {
        $fields = array(
            "id" => "${ID}"
        );

        $fields_string = json_encode($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/proyecto/api/producto/eliminar.php");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        $data = curl_exec($ch);

        curl_close($ch);
    }

    public function update(

        $titulo,
        $fecha,
        $hora_inicio,
        $hora_final,
        $estado,
        $descripcion,
        $actividades,
        $ubicacion,
        $ID
    ) {
        $fields = array(
            "titulo" => "${titulo}",
            "fecha" => "${fecha}",
            "hora_inicio" => "${hora_inicio}",
            "hora_final" => "${hora_final}",
            "estado" => $estado,
            "descripcion" => "${descripcion}",
            "actividad" => "${actividades}",
            "ubicacion" => "${ubicacion}",
            "id" => "${ID}"

        );

        $fields_string = json_encode($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/proyecto/api/producto/editar.php");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        $data = curl_exec($ch);

        curl_close($ch);
    }

    public function reportar($ID)
    {

        $fields = array(
            "id" => "${ID}"
        );
        $fields_string = json_encode($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/proyecto/api/producto/buscar.php?id=$ID");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        $data = curl_exec($ch);

        curl_close($ch);
        return $data;
    }

    //$instruccion = "CALL registro_por_actividad('" . $ID . "')";
    //echo $instruccion;
    //$consulta = $this->_db->query($instruccion);
    //$resultado = $consulta->fetch_all(MYSQLI_ASSOC);

    //if (!$resultado) {
    //  echo "Fallo al consultar las actividades por dia";
    //} else {
    //  return $resultado;
    //$resultado->close();
    //$this->_db->close();
    //}

    public function reportarFecha($desde, $hasta)
    {

        $instruccion = "CALL FiltrarPorFecha('" . $desde . "','" . $hasta . "')";
        //echo $instruccion;
        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);

        if (!$resultado) {
            echo "Fallo al consultar las actividades por dia";
        } else {
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }
}
