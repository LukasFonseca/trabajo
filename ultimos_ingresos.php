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
    
    <?php
    if (isset($_SESSION['id_user'])) {
        $marcas_header = $modelo->selectMarcas();

        $vista->printHeaderDinamicoNew($title2, null, "", '', $marcas_header);
        $vista->div_blanco();
        ?>

        <main id="main">

            <?php
            $ultimos_ingresos = $modelo->select_ultimos_ingresos();
            $vista->printSocialMedia($ultimos_ingresos);

            ?>

        </main><!-- End #main -->

        <!-- ======= Footer ======= -->

        <?php 
        $vista->printFooter($title2);
        }
        else{
            ?>
            <script>
                window.location.href="index.php";
            </script>
            <?php
        }
        ?>
    <!-- End #footer -->

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <!-- Slick JS -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.js'></script>

    <!-- Sweet Alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>

    <!-- Script para cambiar el contenido del botón para enviar el mail de contacto -->
    <!-- <script>
    function CambiarBtnForm() {

        if ($('#name').val() != '' && $('#email').val() != '' && $('#subject').val() != '' && $('#message').val() != '') {
            var botonForm = document.getElementById('BtnForm');
            if (botonForm.innerText == 'Enviar mensaje'){
                botonForm.innerText = 'Enviando mensaje...';
                $('#BtnForm').css('background-color', '#B0053F')
                $('#BtnForm').css('cursor', 'default')
            }
        }
    }
</script> -->

    <script>
        $(document).ready(function() {

            $('.responsive-carousel').slick({
                dots: true,
                infinite: true,
                speed: 1500,
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 2500,
                slidesToScroll: 1,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });

            setTimeout(function() {
                // console.log("hola");
                // $('#divchoto').css('display', 'block');
                $('.divchoto').removeClass('d-none');
                $('.divchoto').addClass('d-block');
            }, 100);
        });
    </script>

    <script>
        $(document).ready(function() {

            //     ///////////////// fixed menu on scroll for desktop
            //     //if ($(window).width() > 992) {
            //     $(window).scroll(function(){
            //         if ($(this).scrollTop() >700) {

            //             $('#navbar_top').addClass("fixed-top");
            //             $('#navbar_top').removeClass("navbar-light");
            //             $('#navbar_top').addClass("navbar-dark");
            //             $("#img-header").attr("src","assets/img/logo-ligth.svg");

            //             // add padding top to show content behind navbar
            //             $('body').css('padding-top', $('.navbar').outerHeight() + 'px');
            //             //$('#navbar_top').css('background-color', '#000');
            //         }else{

            //             $('#navbar_top').removeClass("fixed-top");
            //             $('#navbar_top').removeClass("navbar-dark");
            //             $('#navbar_top').addClass("navbar-light");
            //             $("#img-header").attr("src","assets/img/logo-ligth.svg");

            //             // remove padding top from body
            //             $('body').css('padding-top', '0');
            //             //$('#navbar_top').css('background-color', '#fff');
            //         }
            //     });
            //     //} // end if

            // Bloqueamos el SELECT de los modelos
            $("#slt-modelos").prop('disabled', true);

            // Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
            $("#slt-marcas").change(function() {
                // Guardamos el select de modelos
                var selectModelos = $("#selectModelos");

                // Guardamos el select de marcas
                var marcas = $(this);

                if ($(this).val() != '') {
                    $.ajax({
                        data: {
                            id: marcas.val()
                        },
                        url: 'modelo/selectModelos.php',
                        type: 'POST',
                        beforeSend: function() {
                            marcas.prop('disabled', true);
                        },
                        success: function(r) {
                            marcas.prop('disabled', false);

                            selectModelos.html(r);
                        },
                        error: function() {
                            alert('Ocurrio un error en el servidor ..');
                            marcas.prop('disabled', false);
                        }
                    });
                } else {
                    modelos.find('option').remove();
                    modelos.prop('disabled', true);
                }
            })
        })
    </script>

</body>

</html>