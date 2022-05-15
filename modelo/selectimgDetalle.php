<?php
include_once("modelo.php");
$modelo=new Modelo();

$result = $modelo->unidadimg($_POST['id']);
$listaImg = array();
while($regFotos=mysqli_fetch_array($result)){
    $img=unserialize($regFotos['urls']);
    
    for($i=0; $i < count($img); $i++){
        array_push($listaImg, $img[$i]);
    }
}

for ($i=0; $i < count($listaImg); $i++) { 
    echo $listaImg[$i] . ' | ';
}


?>
