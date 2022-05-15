<?php
session_start();

$title="ComunidAUTO";
$title2="Comunid<b>AUTO</b>";
$description="A la mayor comunidad online de agencias de vendedores de autos de latinoamerica.";

include_once("modelo/modelo.php");
$modelo = new Modelo();
include_once("vista/vista.php");
$vista=new Vista();
if(isset($_SESSION['user'])){

?>
<!DOCTYPE html>
<html lang="es">

<head>
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

<main style="width: 100vw;">
    <!-- ======= Header ======= -->
        <?php
        if (isset($_GET['token'])) {
            $select = $modelo->selectUsers($_GET['token']);
            if (mysqli_num_rows($select) > 0) {
                $user =  mysqli_fetch_array($select);
                $_SESSION['user'] = $user['usuario'];
                $_SESSION['username'] = $user['usuario'];
                // $_SESSION['email'] = $user['email'];
                $_SESSION['id_usuario'] = $user['id_agencia'];
                $_SESSION['id_user'] = $user['id_usuario'];
            }
        }
        ?>
        <!-- End #header -->

    <!-- CABECERA PERFIL -->
    <div class="home-perfil" style="background: #f3f3f3;">
        <div class="row d-flex flex-column">
            <!-- Avatar -->
            <div class="banner-perfil position-relative">
                <img class="" src="assets/img/banner-perfil1366x140.png" alt="Portada">    
            </div>
            <!-- Name -->
            <div class="banner-name d-flex flex-row position-relative">
                <img class="pic-perfil" src="assets/img/pic-perfil.png" alt="Pic">
                <div class="tittle-tittle d-flex align-self-end">
                    <h2>Rom Agencia (Oficial)</h2>
                    <h6 class="btn-link">Editar Perfil</h6>
                </div>
            </div>

        </div>
    </div>

    <!-- DASHBOARD MENU PERFIL -->
    <!-- <div class="d-lg-flex flex-lg-row" style="background: #f7f7f7;"> -->
    <div class="dashboard" style="background: #f7f7f7;">
        <!-- BOTONES -->
        <div class="scroll-y">

            <!-- Usuario --> 
            <button type="button" id="btn-info" onclick="mostrar_ocultar()" class="btn btn-primary btn-sm btn_info px-1 btn-panel d-flex">
                <img class="mx-3" src="assets/img/user.svg" style="opacity:50%;" alt="">
                    <div class="d-flex flex-column">
                        <h4 class="m-0 text-left">Usuario</h4>
                        <p>Cambiar nombre</p>
                    </div>
            </button>
            <!-- Información --> 
            <button type="button" id="btn-info" onclick="mostrar_ocultar()" class="btn btn-primary btn-sm btn_info px-1 btn-panel d-flex">
                <img class="mx-3" src="assets/img/guest.svg" alt="">
                    <div class="d-flex flex-column">
                        <h4 class="m-0 text-left">Información</h4>
                        <p>Datos de Empresa, localidad, teléfono..</p>
                    </div>
            </button>
            <!-- Mensajes -->
            <button type="button" id="" onclick="mostrar_ocultar()" class="btn btn-primary btn-sm btn_info px-1 btn-panel d-flex">
                <img class="mx-3" src="assets/img/message.svg" alt="">
                    <div class="d-flex flex-column">
                        <h4 class="m-0 text-left">Mensajes</h4>
                        <p>Texto descriptivo</p>
                    </div>
            </button>
            <!-- Item -->
            <button type="button" id="" onclick="mostrar_ocultar()" class="btn btn-primary btn-sm btn_info px-1 btn-panel d-flex">
                <img class="mx-3" src="assets/img/consultant.svg" style="opacity:50%;" alt="">
                    <div class="d-flex flex-column">
                        <h4 class="m-0 text-left">Item</h4>
                        <p>Texto descriptivo</p>
                    </div>
            </button>
            <!-- Historial -->
            <button type="button" id="" onclick="mostrar_ocultar()" class="btn btn-primary btn-sm btn_info px-1 btn-panel d-flex">
                <img class="mx-3" src="assets/img/history.svg" alt="">
                    <div class="d-flex flex-column">
                        <h4 class="m-0 text-left">Historial</h4>
                        <p>Texto descriptivo</p>
                    </div>
            </button>
            <!-- Seguidos -->
            <button type="button" id="" onclick="mostrar_ocultar()" class="btn btn-primary btn-sm btn_info px-1 btn-panel d-flex">
                <img class="mx-3" src="assets/img/favorite.svg" alt="">
                    <div class="d-flex flex-column">
                        <h4 class="m-0 text-left">Seguidos</h4>
                        <p>Texto descriptivo</p>
                    </div>
            </button>
            <!-- Novedades -->
            <button type="button" id="btn_novedades" onclick="mostrar_ocultar()" class="btn btn-primary btn-sm btn_info px-1 btn-panel d-flex">
                <img class="mx-3" src="assets/img/congrat.svg" alt="">
                    <div class="d-flex flex-column">
                        <h4 class="m-0 text-left">Novedades</h4>
                        <p>Texto descriptivo</p>
                    </div>
            </button>
        </div>
    
    <!-- <div class="row d-lg-flex flex-lg-row align-content-around flex-nowrap w-100"> -->
    <div class="row align-content-around flex-nowrap w-100">
        <div class="container-datos align-content-around w-100">
            <div id="" class="mt-1" data-bs-ride="">
                <div class="w-100 p-1">

    <!-- DASHBOARD -->
                    <div class="d-flex flex-column align-items-stretch flex-nowrap justify-content-around ">
    <!-- DATOS DE LA EMPRESA ID -->
                        <div id="caja_div" class="w-100 container-datos--perfil">
                            <table class="">
                                <thead>
                                    <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- Nombre de la Empresa -->
                                    <tr>
                                    <th scope="row">Datos de la Empresa: </th>
                                    <td>ROM S.A.</td>
                                    </tr>
                                    <!-- Correo Electrónico -->
                                    <tr>
                                        <th scope="row">Correo Electrónico: </th>
                                        <td>    
                                            <a href="mailto:info@rom.net.ar?cc=name2@rom.net.ar
                                            &bcc=name3info@rom.net.ar&subject=Me%20interesa%20lo%20que%20est%C3%A1s%20vendiendo.
                                            &body=Te%20contacto%20por: ">info@rom.net
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Teléfono -->
                                    <tr>
                                        <th scope="row">Teléfono: </th>
                                        <td colspan="2">
                                            <a href="tel:+1158382346">
                                                <img src="assets/img/phone-1.svg" alt="Whatsapp" style="width:21px;">+54 11-58382346
                                            </a>
                                            <a class="mx-2" href="https://api.whatsapp.com/send/?phone=1158382346?
                                            &text=Me%20interesa%20el%20auto%20que%20est%C3%A1s%20vendiendo.">
                                                <img src="assets/img/whatsapp.svg" alt="Whatsapp" style="width:21px;">
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Cuil / Cuit -->
                                    <tr>
                                        <th scope="row">Cuil / Cuit: </th>
                                        <td colspan="2">20-32923631-6</td>
                                                        </tr>
                                    <!-- Código Postal -->
                                    <tr>
                                        <th scope="row">Código Postal: </th>
                                        <td colspan="2">6000</td>
                                    </tr>
                                    <!-- Dirección -->
                                    <tr>
                                        <th scope="row">Dirección: </th>
                                        <td colspan="2"> R. Hernandez 1046, Junín Bs.As.</td>
                                    </tr>
                                    <!-- Redes Sociales -->
                                    <tr>
                                        <th scope="row">Redes Sociales: </th>
                                        <td colspan="2">
                                            <a href="https://www.linkedin.com/company/romnet" target="https://www.linkedin.com/company/romnet" style="font-size: 1rem; color: #4E5358; text-decoration: none;">
                                                <img src="assets/img/linkedin3.svg" alt="LinkedIn" srcset="" style="width:21px;">
                                            </a>
                                            <a href="https://www.instagram.com/rom_argentina" target="https://www.instagram.com/rom_argentina" style="font-size: 1rem; color: #4E5358; text-decoration: none;">
                                                <img src="assets/img/instagram3.svg" alt="Instagram" srcset="" style="width:21px;">
                                            </a>
                                            <a href="https://www.facebook.com/rom.argentina" target="https://www.facebook.com/rom.argentina" style="font-size: 1rem; color: #4E5358; text-decoration: none; ">
                                                <img src="assets/img/facebook3.svg" alt="Facebook" srcset="" style="width:21px;">
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Sitio Web -->
                                    <tr>
                                        <th scope="row">Sitio Web: </th>
                                        <td>    
                                            <a href="mailto:info@rom.net.ar?cc=name2@rom.net.ar
                                            &bcc=name3info@rom.net.ar&subject=Me%20interesa%20lo%20que%20est%C3%A1s%20vendiendo.
                                            &body=Te%20contacto%20por: ">https://www.rom.net.ar
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="container-datos--container">
                                    <!-- Calificación -->
                                <div class="calification">
                                    <h4>Calificación: </h4>
                                    <div class="status-wheel">
                                        <img src="assets/img/rueda.svg" style="width:21px;">
                                        <img src="assets/img/rueda.svg" style="width:21px;">
                                        <img src="assets/img/rueda.svg" style="width:21px;">
                                        <img src="assets/img/rueda.svg" style="width:21px;">
                                        <img src="assets/img/rueda.svg" style="width:21px;">
                                    </div>
                                    <p>Mejora tu publicación para lograr más consultas.</p>
                                </div>
                                        <!-- Mapa -->
                                <div class="map">
                                    <iframe
                                        width="600"
                                        height="250"
                                        style="border:0"
                                        loading="lazy"
                                        allowfullscreen
                                        referrerpolicy="no-referrer-when-downgrade"
                                        src="https://www.google.com/maps/embed/v1/place?key=API_KEY
                                        &q=Space+Needle,Seattle+WA">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
        <!-- END DATOS DE LA EMPRESA ID -->
    <!-- NOVEDADES ID -->
                        <div id="caja_novedades" class="container-datos--perfil d-lg-flex flex-lg-column">
                <!-- Banner 1 -->
                            <div class="container-datos--container my-3 w-100">
                                <picture>
                                    <source media="(min-width:768px)" srcset="assets/img/logistica.jpg" sizes="">
                                    <img class="rounded-pill w-100" src="assets/img/logistica.jpg" alt="">
                                </picture>
                                <p class="my-1">Breve descripción o <a href="" style="pointer-events: none;"> link </a>a Landing Page.
                                </p>
                            </div>
                    <!-- End Banner-->
                <!-- Banner 2 -->
                            <div class="container-datos--container my-3">
                                <picture>
                                    <source media="(min-width:768px)" srcset="assets/img/img-768x312.svg" sizes="">
                                    <img class="rounded-pill w-100" src="assets/img/logistica.jpg" alt="">
                                </picture>
                                <p class="my-1">Breve descripción o <a href="" style="pointer-events: none;">link</a> a Landing Page.
                                </p>
                            </div>
                    <!-- End Banner-->
                        </div>
        <!-- End Novedades ID -->
    <!-- VEHICULOS ID -->
                    <div id="caja_vehiculos" class="col-12 container-datos--perfil d-lg-flex flex-lg-column justify-content-around"">
                        <div class="container-datos--container align-items-stretch justify-content-around w-100">
                            <div class="list-vehicle">

                            <!-- item1 -->
                                <!-- <div class="list-vehicle-item align-items-center d-flex flex-row justify-content-around m-1"> -->
                                <div class="list-vehicle-item d-flex flex-row">
                                    <div class="align-items-center d-flex flex-row justify-content-around w-100">
                                        <!-- Check -->
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="d-none d-md-block align-self-center p-1">
                                                <input type="checkbox" name="" id="" checked autocomplete="off">
                                            </label>
                                        </div>
                                        <!-- ImgItem -->
                                        <img class="m-1 align-self-center" src="assets/img/banner.png" alt="">
                                        <!-- NameItem -->
                                        <div class="w-50 m-1 align-self-center">
                                            <h4><b>Volkswagen | Amarok V6</b></h4>
                                            <h4><b>$6.300.000</b></h4>
                                            <h4>2020 - 12000km</h4>
                                        </div>
                                        <!-- Calificación -->
                                        <div class="calification d-flex flex-column align-self-center justify-content-around">
                                            <h4 class="">Calificación: </h4>
                                            <div class="status-wheel flex-wrap w-100">
                                                <img src="assets/img/rueda.svg" style="width:19px;">
                                                </a>
                                                <img src="assets/img/rueda.svg" style="width:19px;">
                                                </a>
                                                <img src="assets/img/rueda.svg" style="width:19px;">
                                                </a>
                                                <img src="assets/img/rueda.svg" style="width:19px;">
                                                </a>
                                                <img src="assets/img/rueda.svg" style="width:19px;">
                                                </a>
                                            </div>
                                            <p class="px-2 mt-1">Mejora tu publicación para lograr más consultas.</p>
                                        </div>
                                        <!-- BotonShare -->
                                        <button class="btn btn-primary align-self-center d-none d-md-block m-2 p-1 mx-lg-5 my-2 justify-content-end" type="button" data-toggle="collapse" data-target="#contentId" aria-expanded="false"
                                                    aria-controls="contentId">
                                                Compartir
                                        </button>
                                    </div>
                                </div>
                                <!-- item --> 
        <!-- END VEHICULOS ID -->
                            </div>
                        </div>
                    </div>
        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->

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
            }
        })
    </script>

    <script type="text/javascript"> 
        function mostrar_ocultar() {
            // var caja_div = document.getElementById("caja_div");
            // var caja_novedades = document.getElementById("caja_novedades");
            if ($("#caja_div").css("display") == "flex") {
                $("#caja_div").css("display", "none");
                }else{
                $("#caja_div").css("display", "flex");
                }

            }

    </script>

    <script>
            // let currentScrollPosition = 0;
            // let scrollAmount = 320;

            // const sCont = document.querySelector(".btn-container");
            // const hScroll = document.querySelector(".horizontal-scroll");
            // const btnScrollLeft - docment.querySelector("#btn-scroll-left");
            // const btnScrollRight - docment.querySelector("#btn-scroll-right");

            // btnScrollleft.style.opacity = "0";

            // let maxScroll = -sCont.offsetWidth + hScroll.offsetWidth;

            // function scrollHorizontally( val ){
            //     currentScrollPosition += ( val * scrollAmount );

            //     if ( currentScrollPosition > 0 ){
            //             currentScrollPosition = 0
            //             btnScrollLeft.style.opacity = "0";
            //     } else {
            //         btnScrollLeft.style.opacity = "1"; 
            //     }

            //     if ( currentScrollPosition <= maxScroll ){
            //             currentScrollPosition = maxScroll;
            //             btnScrollRight.style.opacity = "0";
            //     } else {
            //             btnScrollRight.style.opacity = "1";
            //     }

            //     sCont.style.left = currentScrollPosition + "px" 

            // }
    </script>

</body>

</html>
<?php
}

/* esto sirve para redirigir al index si intentan entrar sin logearse */
else{
    ?>
    <script>
        window.location.href = 'http://comunidauto.net.ar/'
    </script>
    <?php

    die();
}

?>