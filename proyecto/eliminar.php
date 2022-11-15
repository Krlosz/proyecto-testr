<?php
include('class/agenda.php');
$id = $_GET['ID'];

$ins = new agenda();
$ins->eliminar($id);
header("Location: index.php");