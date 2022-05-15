<?php
session_start();

// Conexion a la base de datos
require_once('../modelo/modelo.php');

$modelo = new modelo();

$datosRecibidos = file_get_contents("php://input");
$agencia = json_decode($datosRecibidos);

$modelo->updateAgenciaAcceso($agencia);