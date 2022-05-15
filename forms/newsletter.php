<?php
//Load Composer's autoloader
require '../assets/vendor/php-email-form/Exception.php';
require '../assets/vendor/php-email-form/PHPMailer.php';
require '../assets/vendor/php-email-form/SMTP.php';
require '../modelo/modelo.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$modelo=new Modelo();
$conectar=$modelo->conectar();
$email = $_POST['email-js'];

try {
    mail($email,'ComunidAUTO','Gracias por formar parte de nuestra comunidad, pronto recibiras nuevas novedades.','Suscripción a nuestro newsletter');
} catch (\Throwable $th) {
    
}


?>