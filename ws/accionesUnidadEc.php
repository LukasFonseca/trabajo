<?php
session_start();

// Conexion a la base de datos
require_once('../modelo/modelo.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$modelo = new modelo();

// Para este WS, se requiere una password
$password = "R0MN3TS4";

$url_acciones = 'https://comunidauto.net.ar/ws/accionesUnidadEc.php?password=&id_usuario_ec=&id_unidad=&accion=&valor=';

// Si la password no es correcta, no lo dejo pasar.
if (isset($_GET['password']) && $_GET['password'] == $password) {
    if (isset($_GET['id_usuario_ec']) && $_GET['id_usuario_ec'] > 0) {
        if (isset($_GET['id_unidad']) && $_GET['id_unidad'] > 0) {
            $id_usuario_ec = $modelo->sanitizar_datos_new($_GET['id_usuario_ec']);
            $id_unidad = $modelo->sanitizar_datos_new($_GET['id_unidad']);
            $accion = $modelo->sanitizar_datos_new($_GET['accion']);
            $valor  = $modelo->sanitizar_datos_new($_GET['valor']);

            $accion = $modelo->accionesUnidadEc($id_usuario_ec, $id_unidad, $accion, $valor);
            if ($accion) {
                echo '1';
            } else {
                echo '0';
            }
        }
        else{
            echo "No se recibio el id de la unidad";
        }
    }
    else {
        echo "No se recibio el id del usuario";
    }
}
else {
    echo "Password incorrecta";
}