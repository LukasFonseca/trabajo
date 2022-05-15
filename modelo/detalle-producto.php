<?php
session_start();

$title = "ComunidAUTO";
$title2 = "Comunid<b>AUTO</b>";
$description = "A la mayor comunidad online de agencias de vendedores de autos de latinoamerica.";

include_once("modelo/modelo.php");
$modelo = new Modelo();
include_once("vista/vista.php");
$vista = new Vista();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


if (isset($_SESSION['user'])) {

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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

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
        <!-- Template Main CSS File -->
        <link href="assets/css/style.css" rel="stylesheet">

    </head>

    <body>

        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WPNXDNP" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        <!-- ======= Header ======= -->
        <?php $vista->printHeaderDinamico($title2, "1145px", '') ?>
        <!-- End #header -->

        <!-- ======= CHAT ======= -->
        <?php
        // if (isset($_GET['chat'])) {
            // ini_set('display_errors', 1);
            // ini_set('display_startup_errors', 1);
            // error_reporting(E_ALL);
            // print_r($_SESSION);
            $resultado = $modelo->ver_msj_global();
            $vista->printChat($resultado);

        //   print_r($_SESSION);
        // }

        ?>

        <main id="main">

            <!-- ===== Detalle producto ===== -->
            <?php

            $unidadDetalle = $modelo->unidadDetalle($_GET['id_unidad']);
            $udetalle = $modelo->unidadDetalle($_GET['id_unidad']);
            $udetalleModal = $modelo->unidadDetalle($_GET['id_unidad']);
            $localidad = $modelo->unidadLocalidad($_GET['id_unidad']);

            // HISTORIAL REGISTRO

            if (mysqli_num_rows($unidadDetalle) > 0){
                // Verificacion si existe el mismo registro
                $select = $modelo->selectHistorialRegistro($_SESSION['id_user'], 1, $_GET['id_unidad']);
                if (mysqli_num_rows($select) > 0){
                    $update = $modelo->updateHistorialRegistroFecha($_SESSION['id_user'], 1, $_GET['id_unidad']);

                    // Logueo de errores o exitos
                    $nombreArchivo = "error_historial.txt";
                    $archivo = fopen($nombreArchivo, "r");
                    $texto = fread($archivo,filesize($nombreArchivo));
                    $archivo = fopen($nombreArchivo, "w");
                    fwrite($archivo, $texto . " \n " . "update: [id_usuario : " . $_SESSION['id_user'] . "] [tabla : 1] " . "[id_publicacion : " . $_GET['id_unidad'] . "]" . " | " . date('d-m-Y H:i'));
                    fclose($archivo);
                }
                else{
                    $insert = $modelo->insertHistorialRegistro($_SESSION['id_user'], 1, $_GET['id_unidad']);

                    // Logueo de errores o exitos
                    $nombreArchivo = "error_historial.txt";
                    $archivo = fopen($nombreArchivo, "r");
                    $texto = fread($archivo,filesize($nombreArchivo));
                    $archivo = fopen($nombreArchivo, "w");
                    fwrite($archivo, $texto . " \n " . "insert: [id_usuario : " . $_SESSION['id_user'] . "] [tabla : 1] " . "[id_publicacion : " . $_GET['id_unidad'] . "]" . " | " . date('d-m-Y H:i'));
                    fclose($archivo);
                }
            }
            else{
                // Logueo de errores o exitos
                $nombreArchivo = "error_historial.txt";
                $archivo = fopen($nombreArchivo, "r");
                $texto = fread($archivo,filesize($nombreArchivo));
                $archivo = fopen($nombreArchivo, "w");
                fwrite($archivo, $texto . " \n " . "No existe la unidad o no existe el parametro de identificación | [id_usuario : " . $_SESSION['id_user'] . "] [tabla : 1] " . "[id_publicacion : " . $_GET['id_unidad'] . "]" . " | " . date('d-m-Y H:i'));
                fclose($archivo);
            }

            // FIN | HISTORIAL REGISTRO

            // HACEMOS CONSULTA PARA VEHICULOS SIMILARES DE ACUERDO A LA UNIDAD ELEGIDA
            $detalle_similares = $modelo->unidadDetalle($_GET['id_unidad']);
            $reg_s = mysqli_fetch_array($detalle_similares);

            $tipo = $reg_s['tipo'];
            $valor = $reg_s['valor_publico_pesos'];
            $kilometros = $reg_s['kilometraje'];

            $fotos = $modelo->cant_fotos($_GET['id_unidad']);
            $reg_fotos = mysqli_fetch_array($fotos);
            $cant_fotos = explode(';i:', $reg_fotos['urls']);
            $vehiculos_similares = $modelo->consultaSimilares($tipo, $valor, $kilometros, $_GET['id_unidad']);

            $vista->printDetalleProducto($unidadDetalle, $udetalle, $udetalleModal, $localidad, $vehiculos_similares);

            ?>
            <!-- End #Detalle producto -->

        </main><!-- End #main -->

        <!-- ======= Footer ======= -->
        <?php $vista->printFooter($title2) ?>
        <!-- End #footer -->

        <!-- Vendor JS Files -->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>

        <!-- Carrusel de imágenes JS File -->
        <script src="assets/vendor/jquery/jquery.js" type="text/javascript"></script>


        <!-- Script para mover el contenido del slider con flechas -->
        <script>
            // jQuery.noConflict();
            var posicion = 0;
            var imagenes = new Array();
            $(document).ready(function() {
                // //alert(jQuery('.texto').html());
                var numeroImatges = <?php echo count($cant_fotos) ?>;
                if (numeroImatges <= 3) {
                    $('.derecha_flecha').css('display', 'none');
                    $('.izquierda_flecha').css('display', 'none');
                }

                $('.img_carrusel').click(function(e) {
                    e.preventDefault();
                    $('#imatgeGran').attr('src', $(this).attr('src'));
                    return false;
                });

                $('.izquierda_flecha').click(function(e) {
                    if (posicion > 0) {
                        posicion = posicion - 1;
                    } else {
                        posicion = numeroImatges - 5;
                    }
                    $(".carrusel").animate({
                        "left": -($('#imagen_' + posicion).position().left)
                    }, 400);
                    return false;
                });

                $('.derecha_flecha').click(function(e) {
                    if (numeroImatges > posicion + 5) {
                        posicion = posicion + 1;
                    } else {
                        posicion = 0;
                    }
                    $(".carrusel").animate({
                        "left": -($('#imagen_' + posicion).position().left)
                    }, 400);
                    return false;
                });

                // $('.img_carrusel').click(function (e) {
                //     e.preventDefault();
                //     $('#imatgeGran').attr('src',$(this).attr('src'));
                //     return false;
                // });

            });
        </script>

        <!-- Script para mover el contenido del slider con flechas - MODAL -->
        <script>
            // jQuery.noConflict();
            var posicion_modal = 0;
            var imagenes = new Array();
            $(document).ready(function() {
                //alert(jQuery('.texto').html());
                var numeroImatges_modal = <?php echo count($cant_fotos) ?>;
                if (numeroImatges_modal <= 3) {
                    $('.derecha_flecha_modal').css('display', 'none');
                    $('.izquierda_flecha_modal').css('display', 'none');
                }

                $('.img_carrusel_modal').live('click', function() {
                    $('#imatgeGran_modal').attr('src', $(this).attr('src'));
                    return false;
                });

                $('.izquierda_flecha_modal').live('click', function() {
                    if (posicion_modal > 0) {
                        posicion_modal = posicion_modal - 1;
                    } else {
                        posicion_modal = numeroImatges_modal - 5;
                    }
                    $(".carrusel_modal").animate({
                        "left": -($('#imagen_' + posicion_modal).position().left)
                    }, 400);
                    return false;
                });

                $('.derecha_flecha_modal').live('click', function() {
                    if (numeroImatges_modal > posicion_modal + 5) {
                        posicion_modal = posicion_modal + 1;
                    } else {
                        posicion_modal = 0;
                    }
                    $(".carrusel_modal").animate({
                        "left": -($('#imagen_' + posicion_modal).position().left)
                    }, 400);
                    return false;
                });
            });
        </script>


        <!-- Script para cambiar imagen grande del carrusel -->
        <script>
            var position = 0;
            var prueba = [];
            /* Rellenar array con php para obtener las imagenes de la base de datos */

            $.ajax({
                type: "POST",
                url: "modelo/selectimgDetalle.php",
                data: {
                    id: $('.item-a-detalle-imagen-grande').attr('id')
                },
                success: function(r) {
                    var pr = r.split(" | ");

                    for (i = 0; i < (pr.length - 1); i++) {
                        prueba.push(pr[i]);
                        var hola = prueba.length;

                    }

                }
            });


            $('.carousel-control-next-icon').live('click', function() {

                $('#imatgeGran').attr('src', prueba[position + 1]);

                if (position == (prueba.length - 2)) {
                    position = -1;
                } else {
                    position += 1;
                }
                return false;
            });

            $('.carousel-control-prev-icon').live('click', function() {

                if (position > 1) {
                    position -= 1;
                } else {
                    position = prueba.length;
                }
                $('#imatgeGran').attr('src', prueba[position - 1]);
                return false;
            });
        </script>

        <!-- Script para cambiar imagen grande del carrusel - MODAL -->
        <script>
            var position = 0;
            /* Rellenar array con php para obtener las imagenes de la base de datos */

            $('.carousel-control-next-icon_modal').live('click', function() {
                $('#imatgeGran_modal').attr('src', prueba[position + 1]);

                if (position == (prueba.length - 2)) {
                    position = -1;
                } else {
                    position += 1;
                }
                return false;
            });

            $('.carousel-control-prev-icon_modal').live('click', function() {

                if (position > 1) {
                    position -= 1;
                } else {
                    position = prueba.length;
                }
                $('#imatgeGran_modal').attr('src', prueba[position - 1]);
                return false;
            });
        </script>
    </body>

    </html>

<?php

}

/*esto sirve para redirigir al index si intentan entrar sin logearse*/ else {
?>
    <script>
        window.location.href = 'index.php'
    </script>
<?php

    die();
}

?>