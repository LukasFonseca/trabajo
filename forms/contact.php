<?php

//Load Composer's autoloader
require '../assets/vendor/php-email-form/Exception.php';
require '../assets/vendor/php-email-form/PHPMailer.php';
require '../assets/vendor/php-email-form/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$nombre = $_POST['name'];
$email = $_POST['email'];
$asunto = $_POST['subject'];
$message = $_POST['message'];
$destinatario = "comentarios@lucy.net.ar";

$asunto = "Consulta sobre ComunidAUTO";
$message = '¡Hola! Mi nombre es ' . $_POST['name'] . ' y mi consulta es: '
. '. <br><br>' 
. $_POST['message']
. '<br><br>' 
. '<label style="font-weight: 600">Datos de contacto - Celular</label>' . ': <br>' . $_POST['celular'];

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=utf-8\r\n"; 

//dirección del remitente 
$headers .= "From: " . $_POST['name'] . "<" . $_POST['email'] .">\r\n"; 

mail($destinatario,$asunto,$message,$headers) 

?>
<script>
    confirm('Mensaje enviado correctamente, ¡Gracias por confiar en el equipo de ROM!');
</script>