<?php
session_start();

$title = "ComunidAUTO";
$title2 = "Comunid<b>AUTO</b>";
$description = "A la mayor comunidad online de agencias de vendedores de autos de latinoamerica.";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("vista/vista.php");
$vista = new Vista();

include_once("modelo/modelo.php");
$modelo = new Modelo();

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
            <link href="chat_ajax/estilos2.css" rel="stylesheet">
            <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
            <!-- Template Main CSS File -->
            <!-- <link href="assets/css/style.css" rel="stylesheet"> -->
            <link href="assets/css/style-new.css" rel="stylesheet">

            <!-- Vendor JS Files -->
            <script src="assets/vendor/jquery/jquery.min.js"></script>
            <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
            <script src="assets/vendor/php-email-form/validate.js"></script>

            <!-- Template Main JS File -->
            <script src="assets/js/main.js"></script>


        </head>

        <body>

            <main>

                <!-- <div class="div-vacio-inicial">

                </div> -->

                <?php
                if (isset($_GET['tipo']) && $_GET['tipo'] == '3'){
                    if (isset($_SESSION['user'])){
                        if(isset($_GET['id']) && is_numeric($_GET['id'])){
                            $unidad = $modelo->selectUnidadCompartida($_GET['tipo'], $_GET['id']);
                            $vista->unidad_compartida($_GET['tipo'], $unidad);
                        }
                        else{
                            ?>
                            <script>
                                window.location.href = 'index.php'
                            </script>
                            <?php
                        }
                    }
                    else{
                        $vista->printLoginFormUnidadCompartida();
                        ?>
                        <script>
                            // alert("Para ver ésta unidad debes ser Usuario de Comunidauto. \nSolicite uno a través del Portal.");
                            // window.location.href = "https://rom.net.ar/comunidauto.php?idCategoria=56";
                        </script>
                        <?php
                    }
                }
                else{
                    ?>
                    <script>
                        window.location.href = 'index.php'
                    </script>
                    <?php
                }
                ?>

            </main>
            
        </body>

    </html>