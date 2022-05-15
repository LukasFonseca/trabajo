<?php
include_once("modelo.php");
$modelo=new Modelo();

// echo $_POST['id'];

$result = $modelo->imagenesParticulares($_POST['id']);
if (mysqli_num_rows($result) > 0){
    $listaImg = array();
    while($regFotos=mysqli_fetch_array($result)){
        $img=explode(' - ', $regFotos['imagenes']);
        
        for($i=0; $i < count($img); $i++){
            array_push($listaImg, $img[$i]);
        }
    }

    for ($i=0; $i < count($listaImg) - 1; $i++) { 
        echo $listaImg[$i] . ' | ';
    }
}
else{
    echo "error";
}

?>