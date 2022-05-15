<?php 

include_once("modelo.php");
$modelo=new Modelo();

if (isset($_POST['user'])){
    $modelo->insertProximamenteDato($_POST['user']);
    echo "1";
}

// echo "ANDA";

?>