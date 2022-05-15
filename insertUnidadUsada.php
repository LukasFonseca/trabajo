<?php
session_start();

// Conexion a la base de datos
require_once('../modelo/modelo.php');

$modelo = new modelo();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


$datosRecibidos = file_get_contents("php://input");
$unidad = json_decode($datosRecibidos);
// echo $unidad->id;
// print_r($unidad);


$tipo_agencia = $unidad->agencia_tipo;
$filtro_stock = $unidad->filtro_stock;

if ($tipo_agencia == 1 || $tipo_agencia == 2 || $filtro_stock == 1) {

    $select=$modelo->chequeoUnidadExistente($unidad);
 
    if(mysqli_num_rows($select)>0){

        $modelo->updateUnidadUsada($unidad);
        $reg=mysqli_fetch_array($select);
        $id_unidad_CA=$reg['id_unidad'];
        $modelo->updateImgs($unidad,$id_unidad_CA);

    }else{

        $unidad_CA=$modelo->insertUnidadUsada($unidad);
        $modelo->insertImgs($unidad,$unidad_CA[0]);

        $nombreArchivo = "logueo_errores_ca.txt";
        $archivo = fopen('../' . $nombreArchivo, "r");
        $texto = fread($archivo,filesize($nombreArchivo));
        $archivo = fopen($nombreArchivo, "w");
        fwrite($archivo, $texto . "\n" . $unidad_CA[1] . " | " . date('d-m-Y H:i'));
        fclose($archivo);
    }

    echo '1';
}
else if ($tipo_agencia == 0){

     $id_empresa = $unidad[0]->id_empresa;


    // $modelo->deletePrecioLista($id_empresa);

    for ($i=0; $i < count($unidad); $i++) {

        $fecha = $unidad[$i]->fecha;
        $id_modelo = $unidad[$i]->id_modelo;
        $version = $unidad[$i]->version;
        $color = $unidad[$i]->color;
        $moneda = $unidad[$i]->moneda;
        $precio = $unidad[$i]->precio;
        $gastos = $unidad[$i]->gastos;
        $disponibilidad = $unidad[$i]->disponibilidad;
        $activo = $unidad[$i]->activo;
        $id_cotizacion_lucy = $unidad[$i]->id_cotizacion;
        $id_agencia_lucy_rom = $unidad[$i]->id_agencia;


        $verificacion = $modelo->verificaCotizacion($id_empresa, $id_cotizacion_lucy);
        echo mysqli_num_rows($verificacion);
        if (mysqli_num_rows($verificacion) > 0){
            if ($id_agencia_lucy_rom > 0) {
                $modelo->updatePrecioLista($fecha, $id_modelo, $id_empresa, $version, $color, $moneda, $precio, $gastos, $disponibilidad, $activo, $id_cotizacion_lucy, $id_agencia_lucy_rom);
            }
            else {
                $modelo->updatePrecioLista($fecha, $id_modelo, $id_empresa, $version, $color, $moneda, $precio, $gastos, $disponibilidad, $activo, $id_cotizacion_lucy);
            }
            echo 'Updateado';
        }
        else{
            if ($id_agencia_lucy_rom > 0){
                $modelo->insertPrecioLista($fecha, $id_modelo, $id_empresa, $version, $color, $moneda, $precio, $gastos, $disponibilidad, $activo, $id_cotizacion_lucy, $id_agencia_lucy_rom);
            }
            else {
                $modelo->insertPrecioLista($fecha, $id_modelo, $id_empresa, $version, $color, $moneda, $precio, $gastos, $disponibilidad, $activo, $id_cotizacion_lucy);
            }
            echo 'Insertado';
        }

    }


}
