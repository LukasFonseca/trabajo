<?php
session_start();
include_once("modelo.php");
$modelo=new Modelo();

// echo $_POST['id_usuario'];

$upadte = $modelo->updateVaciarHistorial($_POST['id_usuario']);
echo $upadte;

?>