<?php
include_once("modelo.php");
$modelo=new Modelo();
$conectar=$modelo->conectar();

$email = $_POST['email-js'];
$suscripto = 1;
$fechareg = date("y/m/d");
$verificacion = "SELECT EXISTS(SELECT email_newsletter FROM newsletter where email_newsletter = '$email' ) as 'existe'";
$resultado = mysqli_query($conectar,$verificacion);

while ($reg=mysqli_fetch_array($resultado)) {
	if($reg['existe'] == 0 ){  
		$consulta = "INSERT INTO newsletter(email_newsletter, suscripto_newsletter, fecha_newsletter) VALUES ('$email', 1 ,'$fechareg')";
		mysqli_query($conectar,$consulta);
	}
}


?>
