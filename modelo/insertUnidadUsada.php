<?php
session_start();

// Conexion a la base de datos
require_once('../modelo/modelo.php');

$modelo = new modelo();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$datosRecibidos = file_get_contents("php://input");
$unidad = json_decode($datosRecibidos);
// echo $unidad->id;
// print_r($unidad);


$tipo_agencia = $unidad->agencia_tipo;

if ($tipo_agencia == 1 || $tipo_agencia == 2){

    $select=$modelo->chequeoUnidadExistente($unidad);

    if(mysqli_num_rows($select)>0){
        
        $modelo->updateUnidadUsada($unidad);
        $reg=mysqli_fetch_array($select);
        $id_unidad_CA=$reg['id_unidad'];
        $modelo->updateImgs($unidad,$id_unidad_CA);

    }else{
        
        $id_unidad_CA=$modelo->insertUnidadUsada($unidad);
        $modelo->insertImgs($unidad,$id_unidad_CA);
    }

    echo '1';
}
else if ($tipo_agencia == 0){

    $fecha = $unidad->fecha;
    $id_modelo = $unidad->id_modelo;
    $id_agencia = $unidad->id_agencia;
    $version = $unidad->version;
    $color = $unidad->color;
    $moneda = $unidad->moneda;
    $precio = $unidad->precio;
    $gastos = $unidad->gastos;
    $disponibilidad = $unidad->disponibilidad;
    
    // echo $fecha . ' - ' . $id_modelo . ' - ' . $id_agencia . ' - ' . $version . ' - ' . $color . ' - ' . $moneda . ' - ' . $precio . ' - ' . $gastos . ' - ' . $disponibilidad;

    $modelo->insertPrecioLista($fecha, $id_modelo, $id_agencia, $version, $color, $moneda, $precio, $gastos, $disponibilidad);
    echo '1';
}
