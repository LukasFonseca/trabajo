<?php
session_start();

$title = "ComunidAUTO";
$title2 = "Comunid<b>AUTO</b>";
$description = "A la mayor comunidad online de agencias de vendedores de autos de Latinoamérica.";

include_once("vista/vista.php");
$vista = new Vista();

include_once("modelo/modelo.php");
$modelo = new Modelo();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <!-- Google Tag Manager -->
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-WPNXDNP');
        </script>
        <!-- End Google Tag Manager -->

        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta http-equiv=”Cache-Control” content=”no-cache” />

        <title><?php echo $title ?></title>
        <meta itemprop="name" content="<?php echo $title ?>">
        <meta itemprop="description" content="<?php echo $description ?>">
        <meta itemprop="image" content="assets/img/logo-ligth.svg">

        <!-- Favicons -->
        <link href="../sistema/icon/favicon-32x32.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
        <link rel="icon" type="image/svg" href="/assets/img/logo-dark.svg" />

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <!-- <link href="assets/css/style.css" rel="stylesheet"> -->
        <link href="assets/css/style-new.css" rel="stylesheet">
        <link href="chat_ajax/estilos2.css" rel="stylesheet">

        <!-- SlickJS CSS -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick-theme.min.css'>

        <!-- Sweet Alert CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <!-- Vendor JS Files -->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
        <!-- <script src="assets/vendor/php-email-form/validate.js"></script> -->
    </head>

    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WPNXDNP" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        <div class="div-vacio-inicial">

        </div>

        <?php
        $marcas_header = $modelo->selectMarcas();

        $vista->printHeaderDinamicoNew($title2, null, "", '', $marcas_header);

        ?>

        <main id="main">

            <!-- INICIAR SESION -->

            <?php
                $vista->printIniciarSesion();
            ?>

            <!-- FIN | INICIAR SESION -->


        </main>
        <!-- End #main -->

        <!-- ======= Footer ======= -->

        <?php $vista->printFooter($title2) ?>
        <!-- End #footer -->

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>

        <!-- Slick JS -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.js'></script>

        <!-- Sweet Alert JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>

    </body>

</html>