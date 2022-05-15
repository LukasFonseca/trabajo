<?php
session_start();

// Conexion a la base de datos
require_once('../modelo/modelo.php');

$modelo = new modelo();

$datosRecibidos = file_get_contents("php://input");
$cliente = json_decode($datosRecibidos);


switch ($cliente->accion){
    case "baja_cliente":
        // print_r($cliente);

        $update = $modelo->AltaBajaCliente($cliente->id, '0');

        break;

    case "alta_cliente":
        // print_r($cliente);
    
        $update = $modelo->AltaBajaCliente($cliente->id, '1');
    
        break;
}

// $cliente->id = $cliente->id;