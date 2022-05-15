<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// POST Variables
$nombre = $modelo->sanitizar_datos_new($_POST['nombre']);
$apellido = $modelo->sanitizar_datos_new($_POST['apellido']);
$email = $modelo->sanitizar_datos_new($_POST['email']);
$telefono = $modelo->sanitizar_datos_new($_POST['telefono']);
$cuit = $modelo->sanitizar_datos_new($_POST['cuit']);

$to = "comentarios@lucy.net.ar";
$subject = "Comunidauto - Recuperacion de Cuenta";
$txt = "Proveniencia: Comunidauto - Recuperación de Cuenta.\n\nDatos de la agencia: \n\nNombre: $nombre \nApellido: $apellido \nEmail: $email \nTelefono: $telefono \nCuit: $cuit";
$headers = "Proveniencia: Recuperar cuenta Comunidauto.";

mail($to,$subject,$txt,$headers);

?>

<script>
    window.location.href='../iniciar_sesion.php';
</script>