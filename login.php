<?php
session_start();
if($_GET['out']=='1'){
    session_destroy();
    header("location: index.php");
}
include_once("modelo/modelo.php");
$modelo=new Modelo();

include_once("vista/vista.php");
$vista=new Vista();

$select = $modelo->selectUsers();
if (mysqli_num_rows($select) > 0) {
    $user =  mysqli_fetch_array($select);
    $_SESSION['user'] = $user['username'];
    $_SESSION['username'] = $user['username'];
    // $_SESSION['email'] = $user['email'];
    $_SESSION['id_usuario'] = $user['id_agencia'];
    $_SESSION['id_user'] = $user['id_usuario'];
    $_SESSION['agencia'] = $user['id_agencia'];

    
    $agencia = $modelo->datos_agencia($user['id_agencia']);
    $reg = mysqli_fetch_array($agencia);

    $_SESSION['nombre_agencia'] = $reg['nombre'];
}

?>