<?php

include_once 'traits/trait_chat.php';
include_once 'traits/trait_perfil.php';

class Vista
{

    use trait_chat;
    use trait_perfil;

    public function printHeaderDinamico($title2, $max_with, $padding_menu)
    {
?>
        <script>
            function loginModal() {
                $.ajax({
                    type: "POST",
                    url: 'forms/notify.php',
                    timeout: 40000
                }).done(function(msg) {
                    $("#cotizaciones").html(msg);
                    $("#myModal").modal('show');
                })
            }
        </script>

        <header id="header">
            <nav id="navbar_top" class="navbar_filtro navbar-expand-lg navbar-light navbar_top <?php echo $padding_menu ?>">
                <!-- NICO modifiqué el width del logo que estaba en 10em y ahora esta en 8em -->
                <a class="navbar-brand menumobile" href="index.php"><img class="imagen-logo" src="assets/img/logo-ligth.svg" id="img-header"></a>
                <button id="navbar-toggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- NICO borre el font-size predeterminado del div para que tome el original -->
                <div class="collapse navbar-collapse menu" id="navbarSupportedContent" style="max-width: <?php echo $max_with ?> !important;">
                    <a class="navbar-brand menudesktop" href="index.php"><img class="imagen-logo" src="assets/img/logo-ligth.svg" id="img-header"></a>
                    <ul class="navbar-nav mx-auto">
                        <!-- <li class="nav-item">
                <a class="nav-link" href="index.php#about" >Sobre nosotros</a>
            </li> -->
                        <!-- <li class="nav-item">
                <a class="nav-link" href="index.php#why-us"  >¿C&oacute;mo funciona?</a>
            </li> -->
                        <!-- <li class="nav-item">
                <a class="nav-link" href="index.php#salon"  >Sal&oacute;n virtual</a>
            </li> -->
                        <!-- NICO: cambie de lugar planes por centro de ayuda -->
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#planes">Planes</a>
                        </li>
                        <!-- NICO: cambie de lugar centro de ayuda por planes -->
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#faqs">Preguntas frecuentes</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php#DudasConsultas">Dudas o consultas</a>
                        </li>

                    </ul>
                    <!-- NICO: añadi una tabla y 2 celdas -->
                    <div class="divlogos">
                        <div class="celdalogos_movil celdalogos_desktop">
                            <a href="https://www.facebook.com/rom.net.ar" target="https://www.facebook.com/rom.net.ar">
                                <img class="logosociales" src="assets/img/facebook.svg" alt="" srcset="">
                            </a>
                        </div>
                        <div class="celdalogos_movil celdalogos_desktop ">
                            <a href="https://www.instagram.com/rom_argentina/" target="https://www.instagram.com/rom_argentina/">
                                <img class="logosociales" src="assets/img/instagram.svg" alt="">
                            </a>
                        </div>
                    </div>

                    <form class="form-inline my-2 my-lg-0 formMovil formulario_login">

                        <?php

                        if (isset($_SESSION['user'])) {
                        ?>
                            <div class="dropdown nombre_usuario_form">
                                <a class="btn btn-secondary dropdown-toggle boton-salir boton-nombre-usuario" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php
                                    if (isset($_SESSION['user'])) {
                                    ?>
                                        <p class="nombre_usuario" style="overflow: hidden; text-overflow: ellipsis;" title="<?php echo ucwords(strtolower($_SESSION['user'])) ?>">
                                            <?php echo ucwords(strtolower($_SESSION['user'])) ?>
                                        </p>
                                    <?php
                                    }
                                    ?>
                                </a>
                                <?php if (isset($_SESSION['id_user']) && ($_SESSION['id_user'] == 40 || $_SESSION['id_user'] == 34)) { ?>
                                    <div class="dropdown-menu div-dropdown-headerdinamico" style="height:62px" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item dropdown-salir" href="moder_particular.php">Particular</a>
                                        <a class="dropdown-item dropdown-salir" href="login.php?out=1">Salir</a>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="dropdown-menu div-dropdown-headerdinamico" style="height:38px" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item dropdown-salir" href="login.php?out=1">Salir</a>
                                    </div>
                            </div>
                        <?php
                                }
                            } else {
                        ?>
                        <a href="javascript:loginModal()" class="boton-salir salirfiltro" id="boton-acceder">
                            Acceder
                        </a>
                    <?php
                            }
                    ?>

                    </form>
                </div>
            </nav>

        </header>
    <?php
    }

    public function printHeaderDinamicoNew($title2, $max_with, $padding_menu, $nada, $marcas_header)
    {
    ?>
        <script>
            function loginModal() {
                $.ajax({
                    url: 'forms/notify.php',
                    timeout: 40000
                }).done(function(msg) {

                    $("#cotizaciones").html(msg);
                    // $("#myModal").modal('show');
                    window.location.href = "iniciar_sesion.php";
                })
            }
        </script>

        <!-- CARGAR MODELOS HEADER -->
        <script>
            function cargarModelosHeader(id_marca) {
                $.ajax({
                    type: "POST",
                    url: "modelo/cargar_modelos_header.php",
                    data: {
                        id_marca: id_marca
                    },
                    success: function(response) {
                        // console.log(response);
                        $("#div-modelo").html(response);

                    }
                });
            }
        </script>
        <!-- FIN | CARGAR MODELOS HEADER -->

        <script>
            function MenuDropdown(numero) {
                if (numero == 1) {
                    if ($("#opciones-vehiculos").css("display") == "flex") {
                        $("#opciones-vehiculos").css("display", "none");

                        $("#cerrar-menuDesktop").css("display", "none");

                    } else {
                        $("#opciones-vehiculos").css("display", "flex");
                        $("#opciones-productos").css("display", "none");
                        $("#opciones-legales").css("display", "none");

                        $("#cerrar-menuDesktop").css("display", "block");
                    }
                } else if (numero == 2) {
                    if ($("#opciones-productos").css("display") == "flex") {
                        $("#opciones-productos").css("display", "none");

                        $("#cerrar-menuDesktop").css("display", "none");
                    } else {
                        $("#opciones-productos").css("display", "flex");
                        $("#opciones-vehiculos").css("display", "none");
                        $("#opciones-legales").css("display", "none");

                        $("#cerrar-menuDesktop").css("display", "block");
                    }
                } else if (numero == 3) {
                    if ($("#opciones-legales").css("display") == "flex") {
                        $("#opciones-legales").css("display", "none");

                        $("#cerrar-menuDesktop").css("display", "none");
                    } else {
                        $("#opciones-legales").css("display", "flex");
                        $("#opciones-vehiculos").css("display", "none");
                        $("#opciones-productos").css("display", "none");

                        $("#cerrar-menuDesktop").css("display", "block");
                    }
                }

            }

            function OpcionDropdown(numero, opcion) {
                if (sessionStorage.getItem("logeado") == 1) {
                    if (numero == 1) {
                        if (opcion == 1) {
                            location.href = "filtro-extendido.php?modelo=No&tipo=2&marca=No&categoria=AutosYCamionetas";
                        } else if (opcion == 2) {
                            location.href = "filtro-extendido.php?modelo=No&tipo=2&marca=No&categoria=Camiones";
                        } else if (opcion == 3) {
                            location.href = "filtro-extendido.php?modelo=No&tipo=2&marca=No&categoria=Motos";
                        } else if (opcion == 4) {
                            location.href = "index.php";
                        } else if (opcion == 5) {
                            location.href = "index.php";
                        } else if (opcion == 6) {
                            location.href = "index.php";
                        } else if (opcion == 7) {
                            location.href = "faqs.php";
                        } else {

                            location.href = "index.php";
                        }
                    } else if (numero == 2) {
                        if (opcion == 1) {
                            location.href = "index.php";
                        } else if (opcion == 2) {
                            location.href = "index.php";
                        } else if (opcion == 3) {
                            location.href = "index.php";
                        } else {
                            location.href = "index.php";
                        }
                    } else if (numero == 3) {
                        if (opcion == 1) {
                            location.href = "index.php";
                        } else if (opcion == 2) {
                            location.href = "index.php";
                        } else if (opcion == 3) {
                            location.href = "index.php";
                        } else {
                            location.href = "index.php";
                        }
                    }
                } else {
                    loginModal();
                }

            }
        </script>

        <!-- Script Menu Sidebar Mobile -->
        <script>
            function mostrar() {
                document.getElementById("sidebar").style.width = "300px";
                // document.getElementById("contenido").style.marginLeft = "300px";
                document.getElementById("abrir").style.display = "none";
                document.getElementById("cerrar").style.display = "inline";

                var estadoDisplay = $("#cerrar-menu").css("display");
                if (estadoDisplay == "none") {
                    $("#cerrar-menu").css("display", "block");
                }
            }

            function ocultar() {
                document.getElementById("sidebar").style.width = "0";
                document.getElementById("contenido").style.marginLeft = "0";
                document.getElementById("abrir").style.display = "inline";
                document.getElementById("cerrar").style.display = "none";

                var estadoDisplay = $("#cerrar-menu").css("display");
                if (estadoDisplay == "block") {
                    $("#cerrar-menu").css("display", "none");
                }
            }

            function CerrarMenu() {
                var estadoDisplay = $("#cerrar-menu").css("display");
                // console.log(estadoDisplay);
                if (estadoDisplay == "block") {
                    $("#cerrar-menu").css("display", "none");
                    ocultar();
                }
            }

            function CerrarMenuDesktop() {
                var estadoDisplay = $("#cerrar-menuDesktop").css("display");
                console.log(estadoDisplay);
                if (estadoDisplay == "block") {
                    $("#cerrar-menuDesktop").css("display", "none");

                    $("#opciones-legales").css("display", "none");
                    $("#opciones-vehiculos").css("display", "none");
                    $("#opciones-productos").css("display", "none");
                }
            }
        </script>

        <!-- FONDO OSCURO MOBILE -->
        <div class="cerrar-menu" id="cerrar-menu" onclick="CerrarMenu()"></div>

        <!-- FONDO OSCURO DESKTOP -->
        <div class="cerrar-menuDesktop" id="cerrar-menuDesktop" onclick="CerrarMenuDesktop()"></div>

        <div class="modal fade hero" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" id="modalHome" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <!-- <h1 class="modal-title" id="exampleModalLabel">Login</h1> -->

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">×</span>

                        </button>

                    </div>
                    <div class="modal-body" id="cotizaciones" style="padding: 0rem;">
                        ...
                    </div>
                </div>
            </div>
        </div>

        <header id="header" class="shadow-one" style="background: #f00353">
            <div id="sidebar" class="sidebar">
                <a class="" href="index.php" style="padding-bottom: 10px;">
                    <!-- Poner display none en desktop | en mobile dejarlo -->
                    <img class="imagen-logo" src="assets/img/logo-comauto.svg" id="img-header">
                </a>
                <div style="margin-top: 10px;">
                    <form action="forms/notify.php" method="post" id="buscadorDesktop" class="d-flex formDesktop">
                        <div class="d-flex">
                            <!-- MARCAS -->
                            <div id="div-marca">
                                <select name="marca" id="marca_header" class="formDesktopSelect" onchange="cargarModelosHeader(this.value)" required>
                                    <option value="" class="formDesktopOption">MARCA</option>
                                    <option value="No" class="formDesktopOption">TODAS</option>
                                    <?php
                                    while ($reg_marca = mysqli_fetch_array($marcas_header)) {
                                    ?>
                                        <option value="<?php echo $reg_marca['id_marcas'] ?>" class="formDesktopOption"><?php echo $reg_marca['marca_descri'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- MODELOS -->
                            <div id="div-modelo">
                                <select name="modelo" id="modelo_header" style="border: none; width: 10.9rem; height: 38px; text-align: center; background: white; color: grey; border: 0px; outline: none;">
                                    <option value="" class="formDesktopOption">MODELO</option>
                                </select>
                            </div>
                            <!-- TIPOS -->
                            <div>
                                <select name="tipo" id="" style="border: none; width: 10.9rem; height: 38px; text-align: center; background: white; color: grey; border: 0px; outline: none;">
                                    <option value="2" class="formDesktopOption">USADOS</option>
                                    <option value="4" class="formDesktopOption">PARTICULARES</option>
                                    <option value="3" class="formDesktopOption">0 KM</option>
                                </select>
                            </div>
                            <div class="formSubmitDesktop">
                                <button class="btn-search text-center" <?php echo (isset($_SESSION['user']) ? 'type="submit"' : 'type="button" onclick="loginModal()"') ?> type="button" id="boton-filtro">
                                    <img src="assets/img/lupa_2.svg" style="border: 0px; outline: none; width: 1.7rem;">
                                </button>
                            </div>
                        </div>
                        <div class="formUsuarioDesktop">
                            <?php if (isset($_SESSION['user'])) { ?>
                                <a class="icon-userDesktop h-auto d-inline-block shadow-one" href="">
                                    <img class="" src="assets/img/user1.svg" id="imagen-usuario">
                                </a>
                            <?php
                            }
                            ?>
                        </div>
                    </form>
                    <a href="https://comunidauto.net.ar/index.php" class="boton-cerrar" onclick="ocultar()"></a>
                    <ul class="menu d-lg-flex" style="margin-bottom: 0.5rem;">
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-container">
                            <li class="nav-item">
                                <a class="nav-title mx-1" onclick="MenuDropdown(1)" id="categoriasDropdown">
                                    <img class=" d-xg-none icon-menu mr-2" src="assets/img/autito.svg" id="">Categorías
                                    <img class=" d-xg-none icon-menu ml-2" src="assets/img/new-ico.svg" id="">
                                </a>
                                <!-- <div class="dropdown-divider"></div> -->
                            </li>
                            <div class="dropdown-opciones" id="opciones-vehiculos">
                                <span class="dropdown-opcion" onclick="OpcionDropdown(1, 1)">Autos y Camionetas</span>
                                <span class="dropdown-opcion" onclick="OpcionDropdown(1, 2)">Camiones</span>
                                <span class="dropdown-opcion" onclick="OpcionDropdown(1, 3)">Motos</span>
                                <span class="dropdown-opcion-bloq" title="Próximamente">Náutica</span>
                                <span class="dropdown-opcion-bloq" title="Próximamente">Maquinaria Agrícola</span>
                                <span class="dropdown-opcion-bloq" title="Próximamente">Planes de Ahorro</span>
                                <span class="dropdown-opcion" onclick="OpcionDropdown(1, 7)">Ayuda</span>
                            </div>
                        </div>
                        <!-- <li class="nav-item">
                            <a class="nav-title mx-1" href="#">
                                <img class=" d-xg-none icon-menu mr-2" src="assets/img/agencias.svg" id="">Marcas
                                <img class="d-none icon-menu ml-2" src="assets/img/new-ico.svg" id="">
                            </a>
                        </li> -->
                        <div class="dropdown-container">
                            <li class="nav-item">
                                <a class="nav-title mx-1" href="nueva_area.php?categoria=Productos">
                                    <!-- onclick="MenuDropdown(2)" -->
                                    <img class=" d-xg-none icon-menu mr-2" src="assets/img/productos.svg" id="">Productos
                                    <img class=" d-xg-none icon-menu ml-2" src="assets/img/new-ico.svg" id="">
                                </a>
                                <!-- <div class="dropdown-divider"></div> -->
                            </li>
                            <div class="dropdown-opciones" id="opciones-productos">
                                <span class="dropdown-opcion-bloq" title="Próximamente">Baterias</span>
                                <span class="dropdown-opcion-bloq" title="Próximamente">Gomas</span>
                                <span class="dropdown-opcion-bloq" title="Próximamente">Equipamiento</span>
                            </div>
                        </div>
                        <div class="dropdown-container">
                            <li class="nav-item">
                                <a class="nav-title mx-1" href="nueva_area.php?categoria=Profesionales">
                                    <!-- onclick="MenuDropdown(3)" -->
                                    <img class=" d-xg-none icon-menu mr-2" src="assets/img/BalanzaWhite.svg" id="">Profesionales
                                    <img class=" d-xg-none icon-menu ml-2" src="assets/img/new-ico.svg" id="">
                                </a>
                                <!-- <div class="dropdown-divider"></div> -->
                            </li>
                            <div class="dropdown-opciones" id="opciones-legales">
                                <span class="dropdown-opcion-bloq" title="Próximamente">Abogados</span>
                                <span class="dropdown-opcion-bloq" title="Próximamente">Escribanía</span>
                                <span class="dropdown-opcion-bloq" title="Próximamente">Gestoría</span>
                            </div>
                        </div>
                        <li class="nav-item">
                            <a class="nav-title mx-1" href="nueva_area.php?categoria=Logistica">
                                <img class=" d-xg-none icon-menu mr-2" src="assets/img/truck-side.svg" id="">Logística
                                <!-- <img class=" d-xg-none icon-menu ml-2" src="assets/img/new-ico.svg" id=""> -->
                            </a>
                            <!-- <div class="dropdown-divider"></div> -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-title mx-1" href="nueva_area.php?categoria=CentroInspeccion">
                                <img class=" d-xg-none icon-menu mr-2" src="assets/img/CentroInspeccion.svg" id="">Centros de Inspección
                                <!-- <img class=" d-xg-none icon-menu ml-2" src="assets/img/new-ico.svg" id=""> -->
                            </a>
                            <!-- <div class="dropdown-divider"></div> -->
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-title mx-1" href="#">
                                <img class=" d-xg-none icon-menu mr-2" src="assets/img/suscripción.svg" id="">Suscripción
                                <img class="d-none icon-menu ml-2" src="assets/img/new-ico.svg" id=""></a>
                        </li> -->
                        <li class="nav-item">
                            <!-- <a class="nav-title mx-1" href="nueva_area.php?categoria=OfertasRayo" >
                                <img class=" d-xg-none icon-menu mr-2" src="assets/img/rayito1.svg" id="">Ofertas Rayo
                            </a> -->
                            <div class="d-md-none dropdown-divider"></div>
                        </li>

                        <li class="nav-item d-flex">
                            <span>
                                <a class="icon-user h-auto d-inline-block shadow-one" href="">
                                    <img class="" src="assets/img/user1.svg" id="imagen-usuario">
                                </a>
                                <form class="form-inline formMovil formulario_login">
                                    <?php
                                    if (isset($_SESSION['user'])) {
                                    ?>
                                        <div class="dropdown nombre_usuario_form" style="width: 7.5rem;">
                                            <a class="btn btn-secondary dropdown-toggle boton-salir boton-nombre-usuario" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?php
                                                if (isset($_SESSION['user'])) {
                                                ?>
                                                    <p class="nombre_usuario" style="overflow: hidden; text-overflow: ellipsis;" title="<?php echo ucwords(strtolower($_SESSION['user'])) ?>">
                                                        <?php echo ucwords(strtolower($_SESSION['user'])) ?>
                                                    </p>
                                                <?php
                                                }
                                                ?>
                                            </a>
                                            <div class="dropdown-menu div-dropdown-headerdinamico" aria-labelledby="dropdownMenuLink">
                                                <!-- <a class="dropdown-item dropdown-mipanel" href="perfilagencia.php">Mi Panel</a>
                                                <div class="barra-dropdown" ></div> -->
                                                <?php
                                                if ($_SESSION['id_user'] == 34 || $_SESSION['id_user'] == 40) {
                                                ?>
                                                    <a class="dropdown-item-menu dropdown-salir" href="/moder_particular.php">Moderar Particulares</a>
                                                <?php
                                                }
                                                ?>
                                                <a class="dropdown-item-menu dropdown-salir" href="historial.php">Historial</a>
                                                <a class="dropdown-item-menu dropdown-salir" href="login.php?out=1">Salir</a>
                                            </div>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <!-- <a href="javascript:loginModal()" class="boton-salir salirfiltro shadow-one" id="boton-acceder"> -->
                                        <div style="width: 7.5rem; line-height: 20.8px;">
                                            <a href="javascript:loginModal()" class="btn btn-secondary btn-sm" style="border-radius: 1rem; font-size: 16px;" id="boton-acceder">
                                                Acceder
                                            </a>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </form>
                            </span>
                            <!-- <a class="nav-title mx-1" href="#">
                                    <img class="icon-menu mr-2" src="assets/img/autito.svg" id="">Vehiculos
                                    <img class="icon-menu ml-2" src="assets/img/new-ico.svg" id="">
                                </a> -->
                            <div class="dropdown-divider"></div>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="contenido">
                <a href="index.php"><img src="assets/img/trazado.svg" alt="" style="width: 2.5rem; margin-left: 8px;" /></a>
                <!-- <h1></h1> -->
                <a id="abrir" class="abrir-cerrar" href="javascript:void(0)" onclick="mostrar()">
                    <img class="img-icon icon-menu" src="assets/img/menu-burger.svg" alt="" ;></a>
                <button id="cerrar" class="abrir-cerrar" onclick="ocultar()" style="background-color: transparent; border: 0px;">
                    <img class="img-icon icon-menu " src="assets/img/arrow-button-blanca.svg" style="transform: rotate(180deg)" alt="">
                </button>
            </div>
        </header>
    <?php
    }

    // Footer Section //
    public function printFooter($title2)
    {
    ?>
        <footer class="footer-container w-100" id="footer">
            <!-- <div class="container-fluid">
                <div class="row m-4 d-flex mx-auto w-75">
                    <div class="p-2 mt-1 col-12 col-sm-6 col-md-3 col-lg-2 col-xl-2 ">
                        <h3 style=" margin:0px; text-transform: uppercase;"><b>Vehículos</b></h3></br>
                        <p>Autos y Camionetas</p></br>
                        <p>Camiones</p></br>
                        <p href="">Motos</p></br>
                    </div>
                    <div class="p-2 mt-1 col-12 col-sm-6 col-md-3 col-lg-2 col-xl-2 ">
                        <h3 style=" margin:0px; text-transform: uppercase;"><b>Náutica</b></h3></br>
                        <p>Botes y Canoas</p></br>
                        <p>Embarcaciones a Vela</p></br>
                        <p>Lanchas</p></br>
                        <p>Semirrígidos</p></br>
                        <p>Otros</p></br>
                    </div>
                    <div class="p-2 mt-1 col-12 col-sm-6 col-md-3 col-lg-2 col-xl-2 ">
                        <h3 style=" margin:0px; text-transform: uppercase;"><b>Agencias</b></h3></br>
                        <p style="margin:0px;">Oficiales</p></br>
                        <p>Multimarcas</p></br></br>
                    </div>
                    <div class="p-2 mt-1 col-12 col-sm-6 col-md-3 col-lg-2 col-xl-2">
                        <h3 style=" margin:0px; text-transform: uppercase;"><b>Productos</b></h3></br>
                        <p>Equipamiento</p></br>
                        <p>Herramientas</p></br>
                    </div>
                    <div class="p-2 mt-1 col-12 col-sm-6 col-md-3 col-lg-2 col-xl-2 ">
                        <h3 style=" margin:0px; text-transform: uppercase;"><b>Suscripción</b></h3></br>
                        <p>Planes de pago</p></br>
                        <p>Newsletter</p></br>
                    </div>
                    <div class="p-2 mt-1 col-12 col-sm-6 col-md-3 col-lg-2 col-xl-2">
                        <h3 style=" margin:0px; text-transform: uppercase;"><b>Contacto</b></h3></br>
                        <p>Preguntas frecuentes</p></br>
                        <p>Últimas noticias</p></br>
                        <p>(Blog)</p></br>
                    </div>
                </div>
            </div> -->

            <div class="container-fluid mx-auto px-3 pb-3 pt-1 text-center" style="background: #F00353; color:#fff;">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-3 mt-3 align-self-center">
                        Copyright &copy; 2016-<?php echo date("Y") . " <b>ROM S.A</b>" ?><br>
                        <span>Av. Ramon Hernández 1046, Junín, Buenos Aires</span>
                        <!-- &#174<?php echo $title2 ?> 2020 - 2022 <br>Todos los derechos reservados. -->
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mt-3 align-self-center">
                        <a href="https://romsa.lucy.net.ar/terminos_y_condiciones.html" style="color: #fff" target="_blank">Términos y condiciones | </a>
                        <a href="https://romsa.lucy.net.ar/terminos_y_condiciones.html" style="color: #fff" target="_blank"> Cómo cuidamos tu privacidad | </a>
                        <a href="https://romsa.lucy.net.ar/terminos_y_condiciones.html" style="color: #fff" target="_blank">Responsabilidades</a>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-3 mt-3 align-self-center">
                        <a href="https://www.instagram.com/rom_argentina/" target="https://www.instagram.com/rom_argentina/">
                            <img src="assets/img/instagram2.svg" alt="" style="width: 2.5rem;" srcset="">
                        </a>
                        <a href="https://www.linkedin.com/company/romnet/" target="https://www.linkedin.com/company/romnet/" class="logo-linkedin">
                            <img src="assets/img/linkedin2.svg" alt="" style="width: 2.5rem;" srcset="">
                        </a>
                        <a href="https://www.facebook.com/rom.net.ar" target="https://www.facebook.com/rom.argentina" style="font-size: 1rem; color: #4E5358;">
                            <img src="assets/img/facebook2.svg" alt="" style="width: 2.5rem;" srcset="">
                        </a>
                    </div>
                </div>
            </div>

        </footer>
    <?php
    }

    // Banner Section //
    // 2da section del home actual, con 4 img en orden.
    public function printBanner($title2)
    {
    ?>

        <!-- REDIRECCION PARA LOS BANNER -->
        <script>
            $(document).ready(function() {

                // setTimeout(function() {
                    $('.banner_imgs').removeClass('d-none');
                    $('.banner_imgs').addClass('d-block');
                    // console.log('entro');
                // }, 100);

            });

            function bannerRedirect(banner) {
                if (banner == 0) {
                    console.log("anda 0");
                } else if (banner == 1) {
                    console.log("anda 1");
                    location.href = "filtro-extendido-lista.php?modelo=No&tipo=3&marca=No";
                } else if (banner == 2) {
                    location.href = "filtro-extendido-stock.php?modelo=No&tipo=2&marca=No";
                } else if (banner == 3) {
                    // code..
                }
            }
        </script>
        <!-- FIN | REDIRECCION BANNER -->

        <section class="banner-hero">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="wrapper">
                    <div class="carousel-inner responsive-carousel" id="carousel" style="cursor: pointer;">
                        <div class="d-block">
                            <picture>
                                <source media="(min-width:768px)" srcset="assets/img/0KMactual.svg" sizes="">
                                <img loading="lazy" src="assets/img/0KMactualMobile.svg" alt="">
                            </picture>
                        </div>
                        <!-- PONER SIEMPRE ESTAS PINCHES CLASES -->
                        <div class="d-none banner_imgs">
                            <picture>
                                <source media="(min-width:768px)" srcset="assets/img/Particulares.svg" sizes="">
                                <img loading="lazy" src="assets/img/PartiMobile.svg" alt="">
                            </picture>
                        </div>
                        <div class="d-none banner_imgs">
                            <picture>
                                <source media="(min-width:768px)" srcset="assets/img/Red1.svg" sizes="">
                                <img loading="lazy" src="assets/img/RedMobile.svg" alt="">
                            </picture>
                        </div>
                        <div class="d-none banner_imgs">
                            <picture>
                                <source media="(min-width:768px)" srcset="assets/img/img-1352x312.svg" sizes="">
                                <img src="assets/img/img-768x312.svg" alt="">
                            </picture>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }

    // Category Section //
    //Iconos de categorias
    ///////////////////////////////
    public function printCategory($title2)
    {
    ?>
        <section class="mx-auto mb-3 mt-5 w-75" id="category1">
            <h2 class="text-center text-uppercase font-weight-bold color-primario mb-3">Próximamente todo lo que buscas</h2>
            <div class="row justify-content-center mt-5">
                <div class="col-6 col-sm-6 col-md-3 col-lg-2 col-xl-2" onclick="BuscarPorCategoria(1)">
                    <div class="mx-auto rounded-circle img-container shadow-one">
                        <img class="img-icon icon-category icon-category--active card-img-top p-4 " src="assets/img/autito.svg" alt="" ;>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-center text-uppercase font-weight-bold color-primario">Autos y camionetas</p>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-3 col-lg-2 col-xl-2" onclick="BuscarPorCategoria(2)">
                    <div class="mx-auto rounded-circle img-container shadow-one">
                        <img class="img-icon icon-category icon-category--active card-img-top p-4 " src="assets/img/truck-side.svg" alt="" ;>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-center text-uppercase font-weight-bold color-primario">Camiones</p>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-3 col-lg-2 col-xl-2" onclick="BuscarPorCategoria(3)">
                    <div class="mx-auto rounded-circle img-container shadow-one">
                        <img class="img-icon icon-category icon-category--active card-img-top p-4 " src="assets/img/moto-bici.svg" alt="" ;>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-center text-uppercase font-weight-bold color-primario">Motocicletas</p>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-3 col-lg-2 col-xl-2">
                    <div class="mx-auto rounded-circle img-container">
                        <img class="img-icon icon-category icon-category--deactive card-img-top p-4 " src="assets/img/ship.svg" alt="" ;>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-center text-uppercase font-weight-bold color--deactive">Proximamente</p>
                    </div>
                </div>
            </div>
        </section>

        <script>
            // FUNCION BUSCAR POR CATEGORIA

            function BuscarPorCategoria(tipo) {
                if (sessionStorage.getItem("logeado") == 1) {
                    // Tipos: 1 auto | 2 camiones | 3 motos | 4 nautica
                    if (tipo == 1) {
                        // console.log("anda");
                        window.location.href = "filtro-extendido.php?modelo=No&tipo=2&marca=No&categoria=AutosYCamionetas";
                    } else if (tipo == 2) {
                        // console.log("anda");
                        window.location.href = "filtro-extendido.php?modelo=No&tipo=2&marca=No&categoria=Camiones";
                    } else if (tipo == 3) {
                        // console.log("anda");
                        window.location.href = "filtro-extendido.php?modelo=No&tipo=2&marca=No&categoria=Motos";
                    }
                } else {
                    // Si no esta logueado abre modal:
                    loginModal();
                }
            }

            // FIN | BUSCAR POR CATEGORIA
        </script>
        <?php
    }

    public function printHeroSection($title2, $description, $marcas)
    {
        $usuario = explode(" ", $_SESSION['user']);
        $usuario = "<i>" . $usuario[0] . "</i> ";
        if (isset($_SESSION['user'])) {
        ?>
            <script>
                sessionStorage.setItem('logeado', '1');
            </script>
        <?php
        } else {
        ?>
            <script>
                sessionStorage.setItem('logeado', '0');
            </script>
        <?php
        }
        ?>
        <div class="modal fade hero" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" id="modalHome" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <!-- <h1 class="modal-title" id="exampleModalLabel">Login</h1> -->

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">×</span>

                        </button>

                    </div>
                    <div class="modal-body" id="cotizaciones" style="padding: 0rem;">
                        ...
                    </div>
                </div>
            </div>
        </div>

        <section class="align-self-start" id="hero" style="font-family:'Poppins';">
            <div class="hero-container">
                <!-- <h2 class="text-center text-uppercase font-weight-bold color-primario mx-auto mb-2">Buscá por unidad específica</h2>
                <?php
                if (isset($_SESSION['user'])) {
                ?>
                    <h2 style="visibility:hidden" ;><u><?php echo ucwords(strtolower($_SESSION['user'])) ?></u></h2>
                <?php
                }
                ?> -->
                <div class="row">
                    <form action="forms/notify.php" method="post" role="form" class="row mt-3 main-form d-flex-inline d-lg-flex justify-content-center">
                        <div class="d-flex justify-content-center">
                            <select name="marca" id="slt-marcas" class="main-form--select shadow-one" required>
                                <option value="">Marca</option>
                                <option value="No">TODAS</option>
                                <?php
                                while ($reg = mysqli_fetch_array($marcas)) {
                                ?>
                                    <option style="text-transform:uppercase" value="<?php echo $reg['id_marcas'] ?>"><?php echo $reg['marca_descri'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <div class="validate"></div>
                        </div>
                        <div class="d-flex justify-content-center" id="selectModelos">
                            <select name="" id="slt-modelos" onchange="cambiarmodelo()" class="main-form--select shadow-one" required>
                                <option value="">Modelo</option>
                            </select>
                            <div class="validate"></div>
                        </div>
                        <!-- <div class="d-flex justify-content-center" id="selectVersiones">
                  <select name="" id="slt-versiones" class="main-form--select shadow-one" required>
                    <option value="">Versión</option>
                    <option value="No">Sin especificar</option>
                  </select>
                  <div class="validate"></div>
                </div> -->
                        <div class="d-flex justify-content-center" id="selectModelos">
                            <select name="tipo" id="slt-tipo" class="main-form--select shadow-one" required>
                                <!-- <option value="1">Fisico 0KM</option> -->
                                <option value="2">Usados</option>
                                <option value="3">0 KM</option>
                            </select>
                            <div class="validate"></div>
                        </div>
                        <div class="col-0 d-flex align-items-center" style="justify-content: center;">
                            <button class="btn-search text-center shadow-one" <?php echo (isset($_SESSION['user']) ? 'type="submit"' : 'type="button" onclick="loginModal()"') ?> type="button" id="boton-filtro">
                                <img src="assets/img/search.svg" style="padding:6px">
                            </button>
                        </div>
                        <!-- <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your notification request was sent. Thank you!</div> -->
                    </form>
                </div>
            </div>
        </section>

        <script>
            // FUNCION DE ONCHANGE EN MODELOS
            function cambiarmodelo() {
                var selectVersiones = $("#selectVersiones");
                // var modelos = document.getElementById("slt-modelos");
                var modelos = $("#slt-modelos");
                // console.log(modelos);
                if ($("#slt-modelos").val() != '') {
                    // console.log(modelos.value);
                    $.ajax({
                        data: {
                            id: $("#slt-modelos").val(),
                            modelo: $("#slt-modelos :selected").text()
                        },
                        url: 'modelo/selectVersiones.php',
                        type: 'POST',
                        beforeSend: function() {
                            $("#slt-modelos").prop('disabled', true);
                        },
                        success: function(r) {
                            $("#slt-modelos").prop('disabled', false);
                            selectVersiones.html(r);
                        },
                        error: function() {
                            alert('Ocurrio un error en el servidor ..');
                            $("#slt-modelos").prop('disabled', false);
                        }
                    });
                }
            }
        </script>
    <?php
    }

    // Ads 1 Section //
    ///////////////////////////////
    public function printAds1()
    {
    ?>
        <section class="" id="">
            <div class="">
                <img class="ads rounded my-md-5 my-3" src="assets/img/suscrpicion-banner.png" alt="" srcset="">
            </div>
        </section>
    <?php
    }

    // Ads 2 Section //
    ///////////////////////////////
    public function printAds2()
    {
    ?>
        <section class="" id="">
            <div class="">
                <img class="ads rounded my-md-5 my-3" src="assets/img/suscrpicion-banner.png" alt="" srcset="">
            </div>
        </section>
    <?php
    }

    // Suscription Section //
    ///////////////////////////////
    public function printSuscription($title2)
    {
    ?>
        <section class="" id="">
            <div class="">
                <img class="ads rounded my-md-5 my-3" src="assets/img/suscrpicion-banner.png" alt="" srcset="">
            </div>
        </section>
    <?php
    }

    // Ofertas Proximamente //
    ///////////////////////////////
    public function printProximamenteOfertas($usuario, $existe)
    {
    ?>
        <section class="w-100 p-3 mx-auto" id="productos">
            <div class="container my-3">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8  mx-auto">
                        <div class="wrapper">
                            <div class="carousel responsive-carousel" id="carousel">
                                <div class="div-producto-oferta2">
                                    <img class="d-block rounded w-100" src="uploads/proximamente/1.jpg">
                                </div>
                                <div class="div-producto-oferta2">
                                    <img class="d-block rounded w-100" src="uploads/proximamente/2.jpg">
                                </div>
                                <div class="div-producto-oferta2">
                                    <img class="d-block rounded w-100" src="uploads/proximamente/3.jpg">
                                </div>
                                <div class="div-producto-oferta2">
                                    <img class="d-block rounded w-100" src="uploads/proximamente/2.jpg">
                                </div>
                            </div>
                            <?php
                            if ($existe != 1) {
                            ?>
                                <button class="d-none btn btn-primary btn-proximamente align-middle mt-2 mb-2" id="proximamente-button" onclick="DatoProximamente(<?php echo $usuario ?>)">Me interesa</button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            function DatoProximamente(usuario) {
                // console.log(usuario);
                if (usuario == undefined) {
                    alert("Por favor, accedé a tu cuenta.");
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Gracias por su interés en nuestras publicaciones.',
                        text: 'Manténgase en contacto, para más información y nuevas novedades.',
                        showConfirmButton: false,
                        showCloseButton: true
                    })

                    $.ajax({
                        type: "POST",
                        url: "modelo/insertDatoProximamente.php",
                        data: {
                            user: usuario
                        },
                        success: function(data) {
                            if (data == 1) {
                                $("#proximamente-button").css("display", "none");

                            }
                        }
                    });
                }
            }
        </script>
    <?php
    }

    // Carousel Rayo //
    ///////////////////////////////
    public function printCarouselRayo()
    {
    ?>
        <h2 class="text-center text-uppercase font-weight-bold color-primario mt-5">Ofertas Rayo <img class="m-2" src="assets/img/rayito.svg"></h2>
        <div class="container-md mx-auto ">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <!-- Diapositivas -->
                <!-- //**row 1**// -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom mx-auto round-card shadow-one" id="rayoCard">
                                <img src="assets/img/banner.png" class="card-img-top" alt="...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 1</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom mx-auto round-card shadow-one" id="rayoCard">
                                <img src="assets/img/banner.png" class="card-img-top" alt="...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 1</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom mx-auto round-card shadow-one" id="rayoCard">
                                <img src="assets/img/banner.png" class="card-img-top" alt="...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 1</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom mx-auto round-card shadow-one" id="rayoCard">
                                <img src="assets/img/banner.png" class="card-img-top" alt="...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 1</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom mx-auto round-card shadow-one" id="rayoCard">
                                <img src="assets/img/banner.png" class="card-img-top" alt="...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 1</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //**row 2**// -->
                    <div class="carousel-item">
                        <div class="row mx-auto">
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom mx-auto round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 2</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom mx-auto round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 2</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom mx-auto round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 2</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom mx-auto round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 2</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom mx-auto round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 2</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //**row 3**// -->
                    <div class="carousel-item">
                        <div class="row mx-auto">
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom mx-auto round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 3</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom mx-auto round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 3</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom mx-auto round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 3</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom mx-auto round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 3</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom mx-auto round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 3</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Controles -->
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    <?php
    }

    // Carousel Carousel Usados Mas Buscados //
    ///////////////////////////////
    public function printCarouselUsadosMasBuscados()
    {
    ?>
        <h2 class="text-center text-uppercase font-weight-bold color-primario mt-5">Ofertas Rayo <img class="m-2" src="assets/img/rayito.svg"></h2>
        <div class="container-fluid my-4">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <!-- Diapositivas -->
                <!-- //**row 1**// -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row my-4">
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one" id="rayoCard">
                                <img src="assets/img/banner.png" class="card-img-top" alt="...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 1</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one" id="rayoCard">
                                <img src="assets/img/banner.png" class="card-img-top" alt="...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 1</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one" id="rayoCard">
                                <img src="assets/img/banner.png" class="card-img-top" alt="...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 1</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one" id="rayoCard">
                                <img src="assets/img/banner.png" class="card-img-top" alt="...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 1</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>

                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one" id="rayoCard">
                                <img src="assets/img/banner.png" class="card-img-top" alt="...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 1</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //**row 2**// -->
                    <div class="carousel-item">
                        <div class="row my-4">

                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 2</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 2</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 2</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 2</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //**row 3**// -->
                    <div class="carousel-item">
                        <div class="row my-4">

                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 3</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 3</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 3</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 3</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Controles -->
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
    <?php
    }

    // Marcas Más Buscadas Section //
    ///////////////////////////////
    public function printMarcasMasBuscadas($marcas = null)
    {

    ?>

        <script>
            $(document).ready(function() {


                if ($('.bbb_viewed_slider').length) {
                    var viewedSlider = $('.bbb_viewed_slider');

                    viewedSlider.owlCarousel({
                        loop: true,
                        margin: 20,
                        autoplay: true,
                        autoplayTimeout: 6000,
                        nav: false,
                        dots: true,
                        responsive: {
                            0: {
                                items: 1
                            },
                            575: {
                                items: 2
                            },
                            768: {
                                items: 3
                            },
                            991: {
                                items: 4
                            },
                            1199: {
                                items: 6
                            }
                        }
                    });

                    if ($('.bbb_viewed_prev').length) {
                        var prev = $('.bbb_viewed_prev');
                        prev.on('click', function() {
                            viewedSlider.trigger('prev.owl.carousel');
                        });
                    }

                    if ($('.bbb_viewed_next').length) {
                        var next = $('.bbb_viewed_next');
                        next.on('click', function() {
                            viewedSlider.trigger('next.owl.carousel');
                        });
                    }
                }


            });

            function redirigir_a_unidad(id_unidad) {
                window.location.href = "detalle-producto.php?id_unidad=" + id_unidad;
            }
        </script>

        <style>
            .owl-prev,
            .owl-next {
                background: #f00353 !important;
            }

            .owl-nav {
                display: flex;
                justify-content: space-between;
            }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
        <div class="container" style="max-width:78%">
            <div class="bbb_viewed">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="bbb_main_container">
                                <!-- <div class="bbb_viewed_title_container"> -->
                                <h2 class="text-center text-uppercase font-weight-bold color-primario mb-4">Principales Marcas</h2>
                                <div class="bbb_viewed_nav_container">
                                    <div class="bbb_viewed_nav bbb_viewed_prev"><i class="fas fa-chevron-left"></i></div>
                                    <div class="bbb_viewed_nav bbb_viewed_next"><i class="fas fa-chevron-right"></i></div>
                                </div>
                                <!-- </div> -->
                                <div class="bbb_viewed_slider_container">
                                    <div class="owl-carousel owl-theme bbb_viewed_slider">
                                        <?php
                                        while ($reg = mysqli_fetch_array($marcas)) {
                                            // $precio = ($reg['valor_publico_pesos'] > 0 ? $reg['valor_publico_pesos'] : $reg['valor_publico_dolar']);
                                            // $moneda = ($reg['valor_publico_pesos'] > 0 ? '$' : 'U$S');
                                            // $imagenes = unserialize($reg['urls']);
                                            // print_r($reg);

                                            // print_r($reg['urls']);
                                        ?>
                                            <div class="owl-item">
                                                <div class="bbb_viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center" style="background: white; cursor: pointer;" title="<?php echo $reg['marca_descri'] ?>">
                                                    <div class="col-0 " onclick="BuscaPorMarca('<?php echo $reg['id_marcas'] ?>')">
                                                        <div class="rounded-circle">
                                                            <img loading="lazy" class="img-container card-img-top " src="marcas/<?php echo $reg['id_marcas'] ?>.svg" alt="" ;>
                                                        </div>
                                                        <!-- <p class="text-center text-uppercase font-weight-bold my-2 color-primario"><?php echo $reg['marca_descri'] ?></p> -->
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('.owl-prev').text('ANTERIOR');
                $('.owl-next').text('SIGUIENTE');
            });
        </script>



        <script>
            function BuscaPorMarca(marca) {
                if (sessionStorage.getItem("logeado") == 1) {
                    location.href = "filtro-extendido.php?modelo=No&tipo=2&marca=" + marca;

                } else {
                    // Si no esta logueado abre modal:
                    loginModal();
                }
            }
        </script>
    <?php
    }
    // Carousel 0Km Más Buscados //
    ///////////////////////////////
    public function printCarousel0kmMasBuscados()
    {
    ?>
        <h2 class="text-center text-uppercase font-weight-bold color-primario mt-5">Autos 0Km más buscados <img class="m-2" src="assets/img/rayito.svg"></h2>
        <div class="container-fluid my-4">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <!-- Diapositivas -->
                <!-- //**row 1**// -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row my-4">
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one" id="rayoCard">
                                <img src="assets/img/banner.png" class="card-img-top" alt="...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 1</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one" id="rayoCard">
                                <img src="assets/img/banner.png" class="card-img-top" alt="...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 1</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one" id="rayoCard">
                                <img src="assets/img/banner.png" class="card-img-top" alt="...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 1</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one" id="rayoCard">
                                <img src="assets/img/banner.png" class="card-img-top" alt="...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 1</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>

                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one" id="rayoCard">
                                <img src="assets/img/banner.png" class="card-img-top" alt="...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 1</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //**row 2**// -->
                    <div class="carousel-item">
                        <div class="row my-4">

                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 2</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 2</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 2</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 2</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //**row 3**// -->
                    <div class="carousel-item">
                        <div class="row my-4">

                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 3</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 3</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 3</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                            <div class="mx-auto col-12 col-sm-4 col-md-3 col-lg-2 m-2 card-rom round-card shadow-one">
                                <img src="assets/img/banner.png" class="card-img-top  alt=" ...">
                                <div class="card-body" id="rayoCard">
                                    <h5 class="card-title">Card Title 3</h5>
                                    <p class="card-text">Text Card Content.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Controles -->
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
    <?php
    }

    ///////////////////////////////
    public function print($title2)
    {
    ?>
        <section class="" id="">
            <div class="container-md">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">

                        <div class=""">
                    <img class="" src=" assets/img/banner-willard.png" alt="" srcset="">
                            <!-- <div class="">
                        <a href="#" type="button" class="btn btn-info">Info</a>
                    </div> -->
                        </div>

                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    public function printLoginForm()
    {
    ?>
        <script>
            // $("#myModal").modal('show');
        </script>
        <!-- ======= Contact Us Section ======= -->
        <section class="section-login-form">
            <div class="container">

                <div class="section-title">
                    <h2><b>Acced&eacute; a tu cuenta</b></h2>
                </div>

                <div class="row justify-content-center">
                    <div>
                        <form method="post" role="form" class="php-login-form">
                            <div class="form-group contact-form">
                                <input type="text" name="nombre" class="form-control" id="usuario" placeholder="Usuario" required />
                                <div class="validate"></div>
                            </div>
                            <div class="form-group contact-form">
                                <input type="password" class="form-control" name="clave" id="clave" placeholder="Clave" required />
                                <div class="validate"></div>
                            </div>
                            <div class="mb-3">
                                <div class="error-message"></div>
                            </div>
                            <div class="text-center">
                                <button onclick="ingresar()" class="btn-ingresar-modal" type="submit">INGRESAR</button>
                            </div>
                        </form>
                    </div>

                    <script>
                        function cerrar() {
                            $('#myModal').modal('hide');
                        }

                        function ingresar() {

                            $.ajax({
                                data: {
                                    usuario: $('#usuario').val(),
                                    clave: $('#clave').val(),
                                },
                                type: "POST",
                                url: 'login.php',
                                timeout: 40000
                            }).done(function(msg) {
                                location.reload();
                                // location.href = 'index.php';
                            }).fail(function(msg) {
                                alert(
                                    'error en la conexion con el servidor, por favor intente nuevamente en unos segundos')
                            })
                            event.preventDefault();
                        }
                    </script>
                </div>
                <!-- <div class="text-center"><button class="btn-cerrar-modal" onclick="cerrar()" type="submit"><b>CERRAR</b></button> -->
            </div>
            </div>
        </section><!-- End Contact Us Section -->

    <?php

    }
    public function PrintGeneral()
    {

    ?>

        <div class="container-migas">
            <ul class="miga-simple">
                <li><a href="#">ComunidAUTO</a></li>
                <li><a href="#">"FILTRO 1"</a></li>
                <li><a href="#">"FILTRO 2"</a></li>
                <li>FILTRO 3</li>
            </ul>
        </div>

    <?php

    }
    public function printAbout($title2)
    {
    ?>
        <section id="about" class="about">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="sobre-nosotros-title">
                            - <?php echo $title2 ?><br>
                            <h1>Sobre <br>Nosotros</h1>
                            <div class="linea-sobrenosotros"></div>
                            <p class="p-sobrenosotros">
                                Somos un red virtual que congrega a revendedores y agencias oficiales de venta de autos de todo el territorio argentino.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="sobre-nosotros-title">
                            <div class="sobre-nosotros-content">
                                <h2>
                                    <img class="img-mision-vision" src="assets/img/networking.svg" alt="" srcset=""> Misi&oacute;n
                                </h2>
                                <div class="linea-mision-vision"></div>
                                <p class="p-mision-vision">
                                    Unir, hermanar, crear lazos comerciales, construir una comunidad que brinde soluciones comunicacionales en tiempos donde la conectividad es un bien común.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="sobre-nosotros-title">
                            <div class="sobre-nosotros-content">
                                <h2>
                                    <img class="img-mision-vision" src="assets/img/inteligencia-artificial.svg" alt="" srcset=""> Visi&oacute;n
                                </h2>
                                <div class="linea-mision-vision"></div>
                                <p class="p-mision-vision">
                                    El ideal de construir y sumar herramientas innovadoras en un mercado competitivo. Con la premisa de integrar tecnología informatica y valor humano.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
        </section>
    <?php
    }
    public function printWhy()
    {
    ?>
        <section id="why-us" class="why-us">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch">
                        <img class="img-why" src="assets/img/image1.svg" alt="" srcset="">
                    </div>
                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch">
                        <div class="sobre-nosotros-title">
                            <h1>
                                ¿C&oacute;mo funciona?
                            </h1>
                            <div class="container-info-why"></div>
                            <p>
                                Las agencias oficiales comparten sus listas de precios. Las agencias de reventa encuentran el valor más conveniente relacionando precio con calidad de atención. La red cumple su cometido, acercar y concretar. Buenas ventas!
                            </p>
                            <!-- Comentamos la barra para ponerle play al video de presentación
                            <a href="#why-us">
                            <span class="boton-play">
                                <img src="assets/img/play.svg">
                            </span>
                            Mir&aacute; el video de presentaci&oacute;n
                            </a>-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    public function printSalonVirtual()
    {
    ?>
        <section id="salon" class="salon" style="background-color: #F1F1F9;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <span style="color: #F00353; font-size: 1rem; font-weight: 600;">Destacados</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9 col-md-6 d-flex align-items-stretch">
                        <h1>Sal&oacute;n virtual</h1>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <a href="#salon" class="boton-ver-salon salon-desktop-boton">
                            Visitar Sal&oacute;n <img src="assets/img/arrow-button.svg" style="float: right; padding: .2419rem; ">
                        </a>
                    </div>
                </div>
                <div id="carouselExampleSlidesOnly" class="carousel slide salon-movil" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="assets/img/sintitulo.png" alt="" srcset="" class="img-carousel">
                            <br>
                            <span style="font-size: .875rem;">VolksWagen</span><br>
                            <span style="font-size: 1.25rem; font-weight: 600;">Amarok Highline</span><br>
                            <span style="font-size: 1.25rem; color: #F00353;">u$s 18.540</span>
                        </div>
                        <div class="carousel-item">
                            <img src="assets/img/sintitulo.png" alt="" srcset="" class="img-carousel">
                            <br>
                            <span style="font-size: .875rem;">VolksWagen</span><br>
                            <span style="font-size: 1.25rem; font-weight: 600;">Amarok Highline</span><br>
                            <span style="font-size: 1.25rem; color: #F00353;">u$s 18.540</span>
                        </div>
                        <div class="carousel-item">
                            <img src="assets/img/sintitulo.png" alt="" srcset="" class="img-carousel">
                            <br>
                            <span style="font-size: .875rem;">VolksWagen</span><br>
                            <span style="font-size: 1.25rem; font-weight: 600;">Amarok Highline</span><br>
                            <span style="font-size: 1.25rem; color: #F00353;">u$s 18.540</span>
                        </div>
                    </div>
                </div>
                <div class="row salon-movil">
                    <div class="col-sm-12 d-flex align-items-stretch">
                        <a style="margin-left: 80%;" href="#salon" class="boton-ver-salon">
                            Visitar Sal&oacute;n <img src="assets/img/arrow-button.svg" style="float: right; padding: .2419rem; ">
                        </a>
                    </div>
                </div>
                <div class="row salon-desktop">
                    <div class="col-lg-3 col-md-6">
                        <img src="assets/img/sintitulo.png" alt="" srcset="" style="width: 100%; height: auto; object-fit: cover; object-position: center center; border-radius: .375rem;">
                        <br>
                        <span style="font-size: .875rem;">VolksWagen</span><br>
                        <span style="font-size: 1.25rem; font-weight: 600;">Amarok Highline</span><br>
                        <span style="font-size: 1.25rem; color: #F00353;">u$s 18.540</span>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <img src="assets/img/sintitulo.png" alt="" srcset="" style="width: 100%; height: auto; object-fit: cover; object-position: center center; border-radius: .375rem;">
                        <br>
                        <span style="font-size: .875rem;">VolksWagen</span><br>
                        <span style="font-size: 1.25rem; font-weight: 600;">Amarok Highline</span><br>
                        <span style="font-size: 1.25rem; color: #F00353;">u$s 18.540</span>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <img src="assets/img/sintitulo.png" alt="" srcset="" style="width: 100%; height: auto; object-fit: cover; object-position: center center; border-radius: .375rem;">
                        <br>
                        <span style="font-size: .875rem;">VolksWagen</span><br>
                        <span style="font-size: 1.25rem; font-weight: 600;">Amarok Highline</span><br>
                        <span style="font-size: 1.25rem; color: #F00353;">u$s 18.540</span>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <img src="assets/img/sintitulo.png" alt="" srcset="" style="width: 100%; height: auto; object-fit: cover; object-position: center center; border-radius: .375rem;">
                        <br>
                        <span style="font-size: .875rem;">VolksWagen</span><br>
                        <span style="font-size: 1.25rem; font-weight: 600;">Amarok Highline</span><br>
                        <span style="font-size: 1.25rem; color: #F00353;">u$s 18.540</span>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    public function printPlanes($planes)
    {
    ?>
        <section id="planes" class="planes">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 titulo-planes">
                        <h3>Sumate!</h3>
                        <h1>Animate a alcanzar tus metas</h1>
                        <h2>Finalmente, todo en un solo lugar!</h2>
                    </div>

                    <?php
                    while ($reg = mysqli_fetch_array($planes)) {
                        if ($reg['titulo_planes'] == 'base') {
                            $clase = "plan-base";
                            $check = "assets/img/check-red.svg";
                            $btn_solicitar = "boton-solicitar-white";

                            $caract = explode(",", $reg['caracteristicas']);

                    ?>

                            <div class="col-md-4">
                                <div class="<?php echo $clase ?>">
                                    <h1 class="plan">
                                        Plan <?php echo $reg['titulo_planes'] ?>
                                    </h1>

                                    <h1 class="valor-plan">
                                        $<?php echo number_format($reg['valor_planes'], 0, '', '.'); ?>
                                    </h1>

                                    <h1 class="xmes">
                                        X MES
                                    </h1>

                                    <a href="#DudasConsultas" class="<?php echo $btn_solicitar ?>">
                                        Solicitar
                                    </a>
                                    <div class="div-caracteristicas">
                                        <?php
                                        $rep = 0;
                                        while ($rep < $reg['cantidad']) {
                                        ?>
                                            <p>
                                                <img src="<?php echo $check ?>" />
                                                <?php
                                                echo $caract[$rep];
                                                echo "</br>";
                                                ?>
                                            </p>
                                        <?php
                                            $rep++;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
    <?php
    }
    public function printFaqs($title2)
    {
    ?>
        <div class="faq" id="faqs">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-10" style="margin-top: 10%;">
                        <div class="wrapper">
                            <div class="carousel responsive-carousel" id="carousel">
                                <a href="https://rom.net.ar/lucy.php?idCategoria=55" target="_blank">
                                    <div class="div-producto-oferta2">
                                        <picture>
                                            <source media="(min-width:768px)" srcset="assets/img/LUCY2.svg" sizes="">
                                            <img class="d-block rounded w-100" src="assets/img/LUCY1.svg">
                                        </picture>
                                    </div>
                                </a>
                            </div>
                            <?php
                            if ($existe != 1) {
                            ?>
                                <button class="d-none btn btn-primary btn-proximamente align-middle mt-2 mb-2" id="proximamente-button" onclick="DatoProximamente(<?php echo $usuario ?>)">Me interesa</button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg faq-items-list" style="margin-bottom: 8%;">
                        <div style="height: 6rem; display: flex; flex-direction: column; align-items: center; justify-content: space-evenly;">
                            <h1>Preguntas Frecuentes</h1>
                        </div>
                        <ul class="faq-list">
                            <li>
                                <a data-toggle="collapse" class="collapsed" href="#faq1">
                                    <i class="bx icon-show"><img src="assets/img/arrow-acordeon.svg" class="arrow"></i>
                                    <i class="bx icon-close"><img src="assets/img/arrow-acordeon-close.svg" class="arrow"></i>
                                    ¿Debo pagar comisi&oacute;n por operaci&oacute;n concretada?
                                </a>
                                <div id="faq1" class="collapse" data-parent=".faq-list">
                                    <span style="color: #4E5358; font-size: 1rem; ">
                                        En absoluto NO. <?php echo $title2 ?> no cobra ning&uacute;n tipo de comisi&oacute;n.
                                    </span>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#faq2" class="collapsed">
                                    <i class="bx icon-show"><img src="assets/img/arrow-acordeon.svg" class="arrow"></i>
                                    <i class="bx icon-close"><img src="assets/img/arrow-acordeon-close.svg" class="arrow"></i>
                                    Como agente oficial, ¿Puedo modificar mi lista de precios cuando lo desee?
                                </a>
                                <div id="faq2" class="collapse" data-parent=".faq-list">
                                    <span>
                                        Si, su lista de precios puede ser modificada cuantas veces lo crea necesario.
                                    </span>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#faq3" class="collapsed">
                                    <i class="bx icon-show"><img src="assets/img/arrow-acordeon.svg" class="arrow"></i>
                                    <i class="bx icon-close"><img src="assets/img/arrow-acordeon-close.svg" class="arrow"></i>
                                    Como agente re-venta, ¿Tengo algún limite en cuanto a la cantidad de consultas que realizo?
                                </a>
                                <div id="faq3" class="collapse" data-parent=".faq-list">
                                    <span>
                                        No, las consultas son ilimitadas en cantidad. Puede utilizar <?php echo $title2 ?> como una herramienta de consulta constante.
                                    </span>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#faq4" class="collapsed">
                                    <i class="bx icon-show"><img src="assets/img/arrow-acordeon.svg" class="arrow"></i>
                                    <i class="bx icon-close"><img src="assets/img/arrow-acordeon-close.svg" class="arrow"></i>
                                    Como agente oficial, ¿Cu&aacute;les son los datos relevantes que puedo agregar en mi lista?
                                </a>
                                <div id="faq4" class="collapse" data-parent=".faq-list">
                                    <span>
                                        Adem&aacute;s de el precio de la unidad, podr&aacute; informarse sobre disponibilidad, costos gregados y colores disponibles.
                                    </span>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#faq5" class="collapsed">
                                    <i class="bx icon-show"><img src="assets/img/arrow-acordeon.svg" class="arrow"></i>
                                    <i class="bx icon-close"><img src="assets/img/arrow-acordeon-close.svg" class="arrow"></i>
                                    Como agente re-venta, ¿A cu&aacute;ntas opciones de precios podr&eacute; acceder para un mismo modelo y versi&oacute;n?
                                </a>
                                <div id="faq5" class="collapse" data-parent=".faq-list">
                                    <span>
                                        Las opciones de precios serán tantas como consecionarios oficiales las ofrezcan. <?php echo $title2 ?> le acerca toda la informaci&oacute;n disponible en un solo click.
                                    </span>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#faq6" class="collapsed">
                                    <i class="bx icon-show"><img src="assets/img/arrow-acordeon.svg" class="arrow"></i>
                                    <i class="bx icon-close"><img src="assets/img/arrow-acordeon-close.svg" class="arrow"></i>
                                    ¿Puedo como agente re-venta recomendar a aquellos agentes oficiales con los que opero exitosamente?
                                </a>
                                <div id="faq6" class="collapse" data-parent=".faq-list">
                                    <span>
                                        Si, <?php echo $title2 ?> puntuar&aacute; de manera positiva a aquellos agentes oficiales que reciban buenas cr&iacute;ticas, y sus listas se publicar&aacute;n con prioridad.
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ///////////////////////////////
    public function printNewsleter($title2)
    {
    ?>
        <section class="w-75 p-3 mx-auto" id="new">
            <div class="row section-suscription--newsleter my-5 mx-auto shadow-one w-100">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3 mt-3 px-3 px-lg-5">
                    <h2>Suscríbete para recibir promociones</h2>
                    <form class="my-4 d-flex justify-content-center">
                        <input class="btn-input" type="email" id="newsletter" placeholder="email@example.com">
                        <button class="btn-submit" type="submit" id="submit_newsletter">Suscribete</button>
                    </form>
                    <h5>Recib&iacute; en tu correo las principales novedades de la comunidad.</h5>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="banner-suscription mb-6">
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    public function printContacto($title)
    {
    ?>
        <section id="contact" class="contact section-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-7">
                        <h3>Contáctanos</h3>
                        <h1>Asesórate con <br> nuestros especialistas.</h1>
                        <div class="row">
                            <div class="col-lg-6 contact-img">
                                <img src="assets/img/image2.svg">
                            </div>
                            <div class="col-lg-6 container-info-contacto">
                                <h5 class="tel">Tel&eacute;fono</h5>
                                <h5 class="info-tel"> (0236) 456-7896</h5>
                                <h5 class="direction"> Direcci&oacute;n</h5>
                                <h5 class="info-direction"> Ramón Hernández 1046 <br> Junín, Pcia de Buenos Aires</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 container-contact-form">
                        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nombre" data-rule="minlen:4" data-msg="Por favor, ingrese mas de 4 caracteres" required />
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Correo" data-rule="email" data-msg="Por favor, ingrese un E-mail válido" required />
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto" data-rule="minlen:8" data-msg="Por favor, ingrese mas de 8 caracteres como asunto" required />
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" id="message" rows="5" data-rule="required" data-msg="Por favor, escriba algo en el mensaje" placeholder="Mensaje" required></textarea>
                                <div class="validate"></div>
                            </div>
                            <div class="mb-3">
                                <div class="error-message"></div>
                                <div class="sent-message" id="mensaje_enviado">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center"><button type="submit" id="BtnForm">Enviar mensaje</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    public function printDudasConsultas($title)
    {
    ?>
        <section id="DudasConsultas" class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-7" style="margin-top: 2.5rem; margin-bottom: 5rem">
                        <h3>¡Consultanos por cualquier duda o consulta que tengas sobre el portal!</h3>
                        <h1>Soporte las 24HS</h1>
                    </div>
                    <div class="col-lg-5 col-md-5 container-contact-form">
                        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nombre" data-rule="minlen:4" data-msg="Por favor, ingrese mas de 4 caracteres" required />
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Correo" data-rule="email" data-msg="Por favor, ingrese un E-mail válido" required />
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="celular" id="celular" placeholder="Celular" data-rule="celular" data-msg="Por favor, ingrese un Numero de celular válido" required />
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto" data-rule="minlen:8" data-msg="Por favor, ingrese mas de 8 caracteres como asunto" required />
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" id="message" rows="5" data-rule="required" data-msg="Por favor, escriba su duda o consulta acerca del portal" placeholder="Mensaje" required></textarea>
                                <div class="validate"></div>
                            </div>
                            <div class="mb-3">
                                <div class="error-message"></div>
                            </div>
                            <div class="text-center"><button type="submit" id="BtnForm">Enviar mensaje</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }

    public function div_blanco()
    {
    ?>

        <script>
            $(document).ready(function() {

                if (screen.width >= 1024) {
                    $("#div_blanco").css('height', $("#sidebar").innerHeight() + 'px');
                } else {
                    $("#div_blanco").css('height', $("#contenido").innerHeight() + 'px');
                }


            });
        </script>

        <div id="div_blanco">

        </div>
    <?php
    }

    /*Filtro Extendido Felo*/
    public function printFiltroExtendidoStock($select, $marcas, $modelos, $unidades, $unidades_particulares)
    {

        // print_r($unidades);

        $reg = mysqli_fetch_array($select);

        if ($_GET['modelo'] == 'No') {
            $modelo_No = $_GET['modelo'];
            $marca_No = $_GET['marca'];
        }

        $tipo = $_GET['tipo'];
        switch ($tipo) {
            case '1':
                $texto = '0 KM';
                break;
            case '2':
                $texto = 'USADOS';
                break;
        }


    ?>

        <script>
            // function favorito(unidad, agencia){
            //     $.ajax({
            //         type: "POST",
            //         url: "vista/favorito.php",
            //         data: {
            //             unidad: unidad,
            //             agencia: agencia,
            //             modelo: <?php echo $modelobuscadoAJAX ?>,
            //             tipo: '<?php echo $_GET['tipo'] ?>',
            //             moneda : '<?php echo $_GET['moneda'] ?>',
            //             preciomin: '<?php echo $_GET['preciomin'] ?>',
            //             preciomax : '<?php echo $_GET['preciomax'] ?>',
            //             pagina: 2,
            //             km : '<?php echo $_GET['km'] ?>',
            //             anio:  '<?php echo $_GET['anio'] ?>',
            //             ubicacion:  '<?php echo $_GET['ubicacion'] ?>',
            //             combustible: '<?php echo  $_GET['combustible'] ?>',
            //             transmision: '<?php echo  $_GET['transmision'] ?>',
            //             color: '<?php echo  $_GET['color'] ?>'
            //         },
            //         success: function (response) {
            //             console.log(response);
            //             $('.seccion-stock-productos').html(response);
            //             //if($(.btn-fav btn-fav-stock).value(src, "assets/img/btn-fav.png");)
            //         }
            //     });
            // }
        </script>

        <section id="filtro-extendido-Stock" class="filtro-extendido-Stock">
            <div class="container-filtro row-filtro">
                <div class="container-migas">
                    <ul class="miga-simple">
                        <li><a href="index.php">ComunidAUTO</a></li>
                        <li><?php if ($reg['marca_descri'] == '') {
                                echo "SIN ESPECIFICAR";
                            } else {
                                echo $reg['marca_descri'];
                            } ?></li>
                        <li><?php if ($reg['modelo_descri'] == '') {
                                echo "SIN ESPECIFICAR";
                            } else {
                                echo $reg['modelo_descri'];
                            } ?></li>
                        <li><?php echo $texto ?></li>
                    </ul>
                </div>
                <div class="linea-header linea"></div>
                <div class="row justify-content-between">
                    <div class="linea-header lineamovil"></div>
                    <p class="selectmovil">
                        <a class="btn btn-primary selectmovilboton" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        </a>
                        <span class="btn-filtrar" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Filtrar</span>
                    </p>
                    <div class="container-filtro-stock" id="collapseExample">
                        <div class="col-md-2 selectdesktop">
                            <select name="marca" id="marca" class="select-marca" required>

                                <option id="marca-default" disabled>MARCA</option>
                                <?php if (isset($modelo_No)) { ?>
                                    <option value="No" selected>TODAS</option>
                                <?php
                                } else { ?>
                                    <option value="No">TODAS</option>
                                <?php
                                }
                                while ($regMarcas = mysqli_fetch_array($marcas)) {
                                ?>
                                    <option value="<?php echo $regMarcas['id_marcas'] ?>" <?php echo ($regMarcas['id_marcas'] == $_GET['marca']) ? 'selected' : ''; ?>>
                                        <a href=""><?php echo strtoupper($regMarcas['marca_descri']); ?></a>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                            <div id="slt-modelos">
                                <select name="modelo" id="modelo" class="select-intermedio" required>
                                    <option id="modelo-default" disabled>MODELO</option>
                                    <option value="No" selected>TODOS</option>
                                    <?php
                                    while ($regModelos = mysqli_fetch_array($modelos)) {
                                    ?>
                                        <option value="<?php echo $regModelos['id_modelo'] ?>" <?php echo ($regModelos['id_modelo'] == $_GET['modelo']) ? 'selected' : ''; ?>>
                                            <?php echo strtoupper($regModelos['modelo_descri']); ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <select name="tipo" id="tipo-unidad" class="select-inferior" required>
                                <option id="cero" value="1" <?php echo ($_GET['tipo'] == '1') ? 'selected' : ''; ?>>0 KM</option>
                                <option id="usado" value="2" <?php echo ($_GET['tipo'] == '2') ? 'selected' : ''; ?>>USADOS</option>
                            </select>

                            <button type="button" id="boton-buscar" class="btn btn-primary btn-input-superior"> BUSCAR </button>

                        </div>

                    </div>

                    <div class="wrap" id="galleria_productos">
                        <div class="store-wrapper">
                            <section class="products-list seccion-stock-productos">
                                <div style="width: 100%;">
                                    <!-- Titulo particulares -->
                                    <div class="container d-flex" style="justify-content: space-between; align-items: center;" id="titulo-seccion">
                                        <h2 id="particulares">Particulares (-10%)</h2>
                                        <span style="cursor: pointer; color: #f00353;" onclick="agencias()">Ir a Agencias</span>
                                    </div>
                                    <div style="border-bottom: solid 1px #f00353; margin-bottom: 1rem; margin-inline-start: 15px; margin-inline-end: 15px;"></div>
                                    <?php
                                    while ($reg_p = mysqli_fetch_array($unidades_particulares)) {
                                        $imagenes = explode(' - ', $reg_p['imagenes']);
                                    ?>
                                        <div class="product-item overflow-hidden div-seccion-product" style="height: auto;">
                                            <div class="div-fondo-item item-stock">
                                                <div class="div-fijo div-fijo-stock">
                                                    <a href="detalle-particulares.php?id_unidad=<?php echo $reg_p['id_unidad'] ?>">
                                                        <?php
                                                        if ($imagenes[0] != '0') {
                                                        ?>
                                                            <img loading="lazy" class="img-fluid" src="<?php echo $imagenes[0] ?>">
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <img loading="lazy" class="img-fluid" src="assets/img/producto-sin-imagen.png">
                                                        <?php
                                                        }
                                                        ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- AGREGUE NUEVA CLASE -->
                                            <div style="display: grid; grid-template-columns: 3.5fr 1.5fr; margin: 1em; row-gap: .625rem;" class="grilla-productos">
                                                <div>
                                                    <b><?php echo $reg_p['marca_descri'] ?> | <?php echo $reg_p['modelo_descri'] ?></b>
                                                </div>
                                                <div style="text-align: center; background-color: #F00353; border-radius: .9375rem; color: #fff;">
                                                    <?php
                                                    if ($reg_p['precio_moderado'] != 0 && $reg_p['precio_moderado'] != '') {
                                                        echo '$ ' . number_format($reg_p['precio_moderado'], 0, ',', '.');
                                                    } else {
                                                        echo "$ Consultar";
                                                    }
                                                    ?>
                                                </div>
                                                <div style="grid-column: 1/-1; overflow: hidden; text-overflow: ellipsis;">
                                                    <?php echo $reg_p['version'] ?> | <?php echo $reg_p['anio'] ?> - <?php echo number_format($reg_p['kilometraje'], 0, ',', '.'); ?>KM
                                                </div>
                                            </div>
                                            <!-- AGREGUE NUEVO DIV  -->
                                            <div class="datos_productos">
                                                <p class="p-modelo">
                                                    <b><?php echo $reg_p['marca_descri'] ?> | <?php echo $reg_p['modelo_descri'] ?></b>
                                                    <span class="span-marca">
                                                        <?php
                                                        if ($reg_p['precio_moderado'] != 0 && $reg_p['precio_moderado'] != '') {
                                                            echo '$ ' . number_format($reg_p['precio_moderado'], 0, ',', '.');
                                                        } else {
                                                            echo "$ Consultar";
                                                        }
                                                        ?>
                                                    </span>
                                                </p>
                                                <p class="p-marca"> <?php echo $reg_p['version'] ?> | <?php echo $reg_p['anio'] ?> - <?php echo $reg_p['kilometraje'] ?>KM
                                                </p>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </section>
                        </div>

                        <!-- Felo: Grilla de productos -->

                        <div class="linea-header lineamovil lineamovil-inferior"></div>

                        <div class="store-wrapper">
                            <section class="products-list seccion-stock-productos">
                                <div style="width: 100%;">
                                    <div class="container d-flex" style="justify-content: space-between; align-items: center;">
                                        <h2 id="agencias">Agencias</h2>
                                        <span style="cursor: pointer; color: #f00353;" onclick="particulares()">Ir a Particulares</span>
                                    </div>
                                    <div class="productos-scroll" style="border-bottom: solid 1px #f00353; margin-bottom: 1rem; margin-inline-start: 15px; margin-inline-end: 15px;"></div>

                                    <?php
                                    while ($reg = mysqli_fetch_array($unidades)) {
                                        $imagenes = unserialize($reg['urls']);
                                    ?>
                                        <div class="product-item overflow-hidden div-seccion-product" style="height: auto;">
                                            <div class="div-fondo-item item-stock">
                                                <div class="div-fijo div-fijo-stock">
                                                    <a href="detalle-producto.php?id_unidad=<?php echo $reg['id'] ?>">
                                                        <?php
                                                        if ($imagenes[0] != '') {
                                                        ?>
                                                            <img loading="lazy" class="img-fluid" src="<?php echo $imagenes[0] ?>">
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <img loading="lazy" class="img-fluid" src="assets/img/producto-sin-imagen.png">
                                                        <?php
                                                        }
                                                        ?>
                                                    </a>

                                                    <!-- <a href="javascript:favorito(<?php echo $reg['id'] ?>, <?php echo $reg['agencia'] ?>)"class="btn-fav btn-fav-stock">
                                            <?php
                                            if ($reg['activo'] == 1) {
                                            ?>
                                                <img src="assets/img/btn-fav-hover.png" id="click" class="btn-fav-img">
                                                <?php
                                            } else {
                                                ?>
                                                <img src="assets/img/btn-fav.png" class="btn-fav-img">
                                                <?php
                                            }
                                                ?>
                                            </a> -->
                                                </div>
                                            </div>
                                            <!-- AGREGUE NUEVA CLASE -->
                                            <div style="display: grid; grid-template-columns: 3.5fr 1.5fr; margin: 1em; row-gap: 10px;" class="grilla-productos">
                                                <div>
                                                    <b><?php echo $reg['marca_descri'] ?> | <?php echo $reg['modelo_descri'] ?></b>
                                                </div>
                                                <div style="text-align: center; background-color: #F00353; border-radius: 15px; color: #fff;">
                                                    <?php
                                                    if ($reg['kilometraje'] == 0) {
                                                    ?> $ <?php echo number_format($reg['valor_costo'], 0, ',', '.');
                                                        } else {
                                                            ?> $ <?php echo number_format($reg['valor_publico_pesos'], 0, ',', '.');
                                                                }
                                                                    ?>
                                                </div>
                                                <div style="grid-column: 1/-1; overflow: hidden; text-overflow: ellipsis;">
                                                    <?php echo $reg['version'] ?> | <?php echo $reg['anio'] ?> - <?php echo number_format($reg['kilometraje'], 0, ',', '.'); ?>KM
                                                </div>
                                            </div>
                                            <!-- AGREGUE NUEVO DIV  -->
                                            <div class="datos_productos">
                                                <p class="p-modelo">
                                                    <b><?php echo $reg['marca_descri'] ?> | <?php echo $reg['modelo_descri'] ?></b>
                                                    <span class="span-marca">$ <?php echo number_format($reg['valor_publico_pesos'], 0, ',', '.'); ?> </span>
                                                </p>
                                                <p class="p-marca"> <?php echo $reg['version'] ?> | <?php echo $reg['anio'] ?> - <?php echo $reg['kilometraje'] ?>KM
                                                </p>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <!-- Paginado -->
                                <?php
                                $CantidadMostrar = 10;
                                ?>
                                <!-- <div class="paginacion">
                                <ul class="pagination">
                                    <li><a href="#">«</a>
                                </li>
                                    <?php

                                    $nro_paginacion = (mysqli_num_rows($unidades) / 4);

                                    if (isset($_GET['moneda']) || isset($_GET['preciomin']) || isset($_GET['preciomax']) || isset($_GET['km']) || isset($_GET['anio']) || isset($_GET['ubicacion']) || isset($_GET['combustible']) || isset($_GET['transmision']) || isset($_GET['moneda'])) {

                                        $modelo_unidad = $_GET['modelo'];
                                        $moneda = $_GET['moneda'];
                                        if ($_GET['preciomin'] == '') {
                                            $preciomin = 0;
                                        } else {
                                            $preciomin = $_GET['preciomin'];
                                        }

                                        if ($_GET['preciomax'] == '') {
                                            $preciomax = 10000000000000000000000000;
                                        } else {
                                            $preciomax = $_GET['preciomax'];
                                        }

                                        $kilometraje = $_GET['km'];
                                        $anio = $_GET['anio'];
                                        $ubicacion = $_GET['ubicacion'];
                                        $combustible = $_GET['combustible'];
                                        $transmision = $_GET['transmision'];
                                        $color = $_GET['color'];

                                        for ($i = 1; $i < $nro_paginacion + 1; $i++) {
                                    ?>
                                                <li><a href="filtro-extendido-stock.php?modelo=<?php echo $modelo_unidad ?>&tipo=<?php echo $_GET['tipo'] ?>&marca=<?php echo $_GET['marca'] ?>&moneda=<?php echo $moneda ?>&preciomin=<?php echo $preciomin ?>&preciomax=<?php echo $preciomax ?>&km=<?php echo $kilometraje ?>&anio=<?php echo $anio ?>&ubicacion=<?php echo $ubicacion ?>&combustible=<?php echo $combustible ?>&transmision=<?php echo $transmision ?>&color=<?php echo $color ?>&pag=<?php echo $i ?>"><?php echo $i ?></a></li>
                                            <?php
                                        }
                                    } else {

                                        for ($i = 1; $i < $nro_paginacion + 1; $i++) {
                                            $modelo_unidad = $_GET['modelo'];
                                            ?>
                                                <li><a href="filtro-extendido-stock.php?modelo=<?php echo $modelo_unidad ?>&tipo=<?php echo $_GET['tipo'] ?>&marca=<?php echo $_GET['marca'] ?>&pag=<?php echo $i ?>"><?php echo $i ?></a></li>
                                            <?php
                                        }
                                    }
                                            ?>
                                    <li><a href="#">»</a></li>
                                </ul>
                            </div> -->
                            </section>
                        </div>
                    </div>
                </div>
        </section>
    <?php
    }

    public function printFiltroExtendido_lista($select, $marcas, $modelos, $provincias, $precio, $color)
    {
        $reg = mysqli_fetch_array($select);
        $tipo = $_GET['tipo'];
        switch ($tipo) {
            case '1':
                $texto = '0 KM';
                break;
            case '2':
                $texto = 'USADOS';
                break;
            case '3':
                $texto = 'LISTA 0KM';
                break;
        }
    ?>
        <section id="filtro-extendido-lista" class="filtro-extendido-lista">
            <div class="container-filtro-lista">
                <div class="container-migas">
                    <ul class="miga-simple">
                        <li><a href="index.php">ComunidAUTO</a></li>
                        <li><?php if ($reg['marca_descri']  == '') {
                                echo "SIN ESPECIFICAR";
                            } else {
                                echo $reg['marca_descri'];
                            } ?></li>
                        <li><?php if ($reg['modelo_descri'] == '') {
                                echo "SIN ESPECIFICAR";
                            } else {
                                echo $reg['modelo_descri'];
                            } ?></li>
                        <li><?php echo $texto ?></li>
                    </ul>
                </div>
                <div class="linea-header linea"></div>
                <div class="row">
                    <div class="linea-header lineamovil"></div>
                    <p class="selectmovil">
                        <a class="btn btn-primary selectmovilboton" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        </a>
                        <span class="btn-filtrar" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Filtrar</Span>
                    </p>
                    <div class="container-filtro-listaprecio" id="collapseExample">
                        <!-- filtro lista -->
                        <div class="col-md-2 selectdesktop">
                            <select class="marca" name="marca" id="slt-marcas" onchange="javascript:cambio_modelo()">
                                <!--En las opciones importamos las marcas desde la BD y su respectivos modelos y estados disponibles -->
                                <option value="">MARCA</option>
                                <?php if (isset($_GET['marca'])) { ?>
                                    <option value="No" selected>TODAS</option>
                                <?php
                                } else { ?>
                                    <option value="No">TODAS</option>
                                <?php
                                }
                                while ($regMarcas = mysqli_fetch_array($marcas)) {
                                ?>
                                    <option value="<?php echo $regMarcas['id_marcas'] ?>" <?php echo ($regMarcas['id_marcas'] == $_GET['marca']) ? 'selected' : ''; ?>>
                                        <?php echo $regMarcas['marca_descri'] ?>
                                    </option>
                                <?php
                                }
                                ?>

                            </select>

                            <select class="modelo" id="slt-modelos" name="modelo">
                                <option value="">MODELO</option>
                                <?php if (isset($_GET['modelo'])) { ?>
                                    <option value="No" selected>TODOS</option>
                                <?php
                                } else { ?>
                                    <option value="No">TODOS</option>
                                <?php
                                }
                                while ($regModelos = mysqli_fetch_array($modelos)) {
                                ?>
                                    <option value="<?php echo $regModelos['id_modelo'] ?>" <?php echo ($regModelos['id_modelo'] == $_GET['modelo']) ? 'selected' : ''; ?>>
                                        <?php echo $regModelos['modelo_descri'] ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>

                            <!-- <select class="ubicacion" id="slt-ubicacion">
                                <option value="">UBICACIÓN</option>
                                <?php
                                while ($regProv = mysqli_fetch_array($provincias)) {
                                ?>
                                    <option value="<?php echo $regProv['id'] ?>" <?php echo ($regProv['id'] == $_GET['ubicacion']) ? 'selected' : ''; ?>>
                                        <?php echo $regProv['provincia'] ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select> -->


                            <!-- <select class="color" id="slt-color">
                                <option value="">COLOR</option>
                                <?php
                                while ($color_unidad = mysqli_fetch_array($color)) {
                                ?>
                                    <option value="<?php echo $color_unidad['color_sin_genero'] ?>" <?php echo ($_GET['color'] == $color_unidad['color_sin_genero']) ? 'selected' : '' ?>>
                                        <?php echo $color_unidad['color'] ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select> -->

                            <select class="color" id="tipo-unidad">
                                <option id="cero" value="1" <?php echo ($_GET['tipo'] == '1') ? 'selected' : ''; ?>>0 KM</option>
                                <option id="usado" value="2" <?php echo ($_GET['tipo'] == '2') ? 'selected' : ''; ?>>USADOS</option>
                            </select>

                            <!-- <select class="disponibilidad" id="select-filtros">
                            <option>Disponibilidad</option>
                        </select>

                        <div class="linea-filtro"></div> -->
                            <button type="button" id="buscar_lista" class="btn btn-primary" onclick="javascript:buscar_lista()"> BUSCAR </button>
                            <!-- <button type="button" style="margin-block-start: 0px;" id="borrar_lista" class="btn btn-primary"> BORRAR FILTROS </button> -->
                        </div>
                    </div>

                    <div class="linea-header lineamovil lineamovil-inferior"></div>


                    <!-- Felo: Filas de productos -->
                    <div class="col-md-10">

                        <?php
                        $a = 0;
                        while ($reg_precio = $precio[0]->fetch_array()) {
                        ?>

                            <div class="container-vehiculos">
                                <div class="product-item-lista">
                                    <!-- <div class="btn-fav-div">
                                <a href="#" class="btn-fav btn-fav-movil"><img src="assets/img/btn-fav.png"></a>
                            </div> -->
                                    <div class="precio-info">

                                        <span class="precio-lista">
                                            <?php
                                            if ($reg_precio['precio'] == 0) {
                                                echo "Sin cotización";
                                            } else if ($reg_precio['precio'] < 150000) {
                                                echo "USD$" . number_format($reg_precio['precio'], 0, ',', '.');
                                            } else {
                                                echo "$" . number_format($reg_precio['precio'], 0, ',', '.');
                                            }
                                            ?>
                                        </span>

                                        <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#prueba_<?php echo $a ?>" aria-expanded="false" aria-controls="collapseExample">
                                            INFO
                                        </button>
                                        <!-- <a href="#" class="btn-fav"><img src="assets/img/btn-fav.png"></a> -->
                                    </div>

                                    <!-- Seccion Agencia - Marca - Version -->
                                    <p class="marca-modelo" style="text-transform: uppercase; color: #f00353;">
                                        <?php echo $reg_precio['nombre'] ?>
                                    </p>
                                    <p class="version-modelo" style="text-transform: uppercase;">
                                        <?php echo $reg_precio['marca_descri'] . ' | ' . $reg_precio['version'] ?>
                                    </p>

                                    <!-- Seccion Localidad - Provincia -->
                                    <p class="p-ciudad" style="text-transform: uppercase; ">
                                        <?php if ($reg_precio['localidad'] == '') {
                                            echo ' - ';
                                        } else {
                                            echo $reg_precio['localidad'] . ' | ';
                                        } ?>
                                        <?php if ($reg_precio['provincia'] == '') {
                                            echo ' - ';
                                        } else {
                                            echo ' ' . $reg_precio['provincia'];
                                        } ?>
                                    </p>

                                    <!-- <a href="https://web.whatsapp.com/send?text=
                                    PONER TEXTO DE ALVA PARA LOS OFICIALES
                                    "?phone=<?php echo $reg_precio['telefono'] ?> target="_blank">Enviar</a> -->
                                    <div class="collapse" id="prueba_<?php echo $a ?>">
                                        <div class="linea-vehiculos-lista"></div>
                                        <div class="table-responsive lista">
                                            <table class="table-caract table-striped">
                                                <tr>
                                                    <td class="td-1-lista" style="text-transform: uppercase;">
                                                        Agencia:
                                                    </td>
                                                    <td class="td-2-lista " style="text-transform: uppercase;">
                                                        <?php echo $reg_precio['nombre'] ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="td-1-lista " style="text-transform: uppercase;">
                                                        Ubicación:
                                                    </td>
                                                    <td class="td-2-lista " style="text-transform: uppercase;">
                                                        <?php echo $reg_precio['localidad'] . ' | ' . $reg_precio['provincia'] ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="td-1-lista " style="text-transform: uppercase;">
                                                        Telefono de agencia:
                                                    </td>
                                                    <td class="td-2-lista ">
                                                        <?php
                                                        echo $reg_precio['telefono'];
                                                        // echo $reg_precio['telefono_agenciaROM'] ;
                                                        // if($reg_precio['telefono'] != null){
                                                        //     echo '1';
                                                        // }
                                                        // else{
                                                        //     echo '0';
                                                        // }
                                                        ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="td-1-lista " style="text-transform: uppercase;">
                                                        Fecha de cotización:
                                                    </td>
                                                    <td class="td-2-lista ">
                                                        <?php echo date("d-m-Y", strtotime($reg_precio['fecha'])); ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="td-1-lista " style="text-transform: uppercase;">
                                                        Fletes y formularios:
                                                    </td>
                                                    <td class="td-2-lista ">
                                                        <?php
                                                        if ($reg_precio['gastos'] == 0) {
                                                            echo "A consultar";
                                                        } else {
                                                            echo "$" . number_format($reg_precio['gastos'], 0, ',', '.');
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="td-1-lista" style="text-transform: uppercase;">
                                                        Colores disponibles:
                                                    </td>
                                                    <td class="td-2-lista">
                                                        <?php
                                                        if ($reg_precio['color'] == '') {
                                                            echo "A consultar";
                                                        } else {
                                                            echo $reg_precio['color'];
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                            $a = $a + 1;
                        }
                        $b = $a;
                        while ($reg_precio = $precio[1]->fetch_array()) {
                        ?>

                            <div class="container-vehiculos">
                                <div class="product-item-lista">
                                    <!-- <div class="btn-fav-div">
                                <a href="#" class="btn-fav btn-fav-movil"><img src="assets/img/btn-fav.png"></a>
                            </div> -->
                                    <div class="precio-info">

                                        <span class="precio-lista">
                                            <?php
                                            if ($reg_precio['precio'] == 0) {
                                                echo "Sin cotización";
                                            } else {
                                                echo "$" . number_format($reg_precio['precio'], 0, ',', '.');
                                            }
                                            ?>
                                        </span>

                                        <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#prueba_<?php echo $b ?>" aria-expanded="false" aria-controls="collapseExample">
                                            INFO
                                        </button>
                                        <!-- <a href="#" class="btn-fav"><img src="assets/img/btn-fav.png"></a> -->
                                    </div>

                                    <!-- Seccion Agencia - Marca - Version -->
                                    <p class="marca-modelo" style="text-transform: uppercase; color: #f00353;">
                                        <?php echo $reg_precio['nombre']; ?>
                                    </p>
                                    <p class="version-modelo" style="text-transform: uppercase;">
                                        <?php echo $reg_precio['marca_descri'] . ' | ' . $reg_precio['version'] ?>
                                    </p>

                                    <!-- Seccion Localidad - Provincia -->
                                    <p class="p-ciudad" style="text-transform: uppercase; ">
                                        <?php if ($reg_precio['localidad'] == '') {
                                            echo ' - ';
                                        } else {
                                            echo $reg_precio['localidad'] . ' | ';
                                        } ?>
                                        <?php if ($reg_precio['provincia'] == '') {
                                            echo ' - ';
                                        } else {
                                            echo ' ' . $reg_precio['provincia'];
                                        } ?>
                                    </p>

                                    <!-- <a href="https://web.whatsapp.com/send?text=
                            PONER TEXTO DE ALVA PARA LOS OFICIALES
                            "?phone=<?php echo $reg_precio['telefono'] ?> target="_blank">Enviar</a> -->
                                    <div class="collapse" id="prueba_<?php echo $b ?>">
                                        <div class="linea-vehiculos-lista"></div>
                                        <div class="table-responsive lista">
                                            <table class="table-caract table-striped">
                                                <tr>
                                                    <td class="td-1-lista" style="text-transform: uppercase;">
                                                        Agencia:
                                                    </td>
                                                    <td class="td-2-lista " style="text-transform: uppercase;">
                                                        <?php echo $reg_precio['nombre'] ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="td-1-lista " style="text-transform: uppercase;">
                                                        Ubicación:
                                                    </td>
                                                    <td class="td-2-lista " style="text-transform: uppercase;">
                                                        <?php echo $reg_precio['localidad'] . ' | ' . $reg_precio['provincia'] ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="td-1-lista " style="text-transform: uppercase;">
                                                        Telefono de agencia:
                                                    </td>
                                                    <td class="td-2-lista ">
                                                        <?php echo $reg_precio['telefono'] ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="td-1-lista " style="text-transform: uppercase;">
                                                        Fecha de cotización:
                                                    </td>
                                                    <td class="td-2-lista ">
                                                        <?php echo date("d-m-Y", strtotime($reg_precio['fecha'])); ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="td-1-lista " style="text-transform: uppercase;">
                                                        Fletes y formularios:
                                                    </td>
                                                    <td class="td-2-lista ">
                                                        <?php
                                                        if ($reg_precio['gastos'] == 0) {
                                                            echo "A consultar";
                                                        } else {
                                                            echo "$" . number_format($reg_precio['gastos'], 0, ',', '.');
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="td-1-lista" style="text-transform: uppercase;">
                                                        Colores disponibles:
                                                    </td>
                                                    <td class="td-2-lista">
                                                        <?php
                                                        if ($reg_precio['color'] == '') {
                                                            echo "A consultar";
                                                        } else {
                                                            echo $reg_precio['color'];
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                            $b++;
                        }
                        ?>

                    </div>
                </div>
            </div>
            </div>
            </div>
        </section>
        <!-- cambio de modelos segun la marca -->
        <script>
            function cambio_modelo() {

                var marca = $('#slt-marcas').val();

                $.ajax({
                    url: 'modelo/selectModelos.php',
                    type: 'POST',
                    data: {
                        id: marca
                    },
                    success: function(data) {
                        $('#slt-modelos').html(data);
                        // console.log(data);
                    }
                });
            }

            function buscar_lista() {
                var marca = $('#slt-marcas').val();
                var modelo = $('#slt-modelos').val();
                var tipo = $('#tipo-unidad').val();
                // var ubicacion = $('#slt-ubicacion').val();
                // var color = $('#slt-color').val();

                if (marca == "") {
                    alert('BUSQUE POR MARCA O SELECCIONE: "TODAS LAS MARCAS"');
                } else {
                    if (tipo == 1) {
                        console.log("0 km");
                        window.location.href = "?modelo=" + modelo + "&tipo=3" + "&marca=" + marca;
                    } else {
                        console.log("usados");
                        window.location.href = 'filtro-extendido-stock.php?modelo=' + $('#slt-modelos').val() +
                            '&tipo=2' +
                            '&marca=' + $('#slt-marcas').val();
                    }
                }

            }
        </script>
    <?php
    }

    /* Perfil de la agencia */
    public function printPerfilAgencia($datosAgencia, $favoritos, $unidadPublicada)
    {

    ?>
        <script>
            function favorito(unidad, agencia) {
                $.ajax({
                    type: "POST",
                    url: "vista/favorito.php",
                    data: {
                        unidad: unidad,
                        agencia: agencia
                    },
                    success: function(response) {
                        console.log(response)


                    }
                });
            }
        </script>
        <section id="perfil-agencia" class="perfil-agencia">
            <?php
            while ($dato = mysqli_fetch_array($datosAgencia)) {


            ?>
                <div class="contenedor-perfil">
                    <div class="container-migas">
                        <ul class="miga-simple">
                            <li><a href="#">ComunidAUTO</a></li>
                            <li><a href="#">Mi Panel</a></li>
                            <li><?php echo $dato['usuario']; ?></li>
                        </ul>
                    </div>
                    <!-- Finaliza sección Header -->
                    <div class="linea-header-agencia"></div>

                    <div class="PerfilAgencia">

                        <!-- Menu mobile agencia -->
                        <div class="menu-perfil-mobile">
                            <p class="selectmovil">
                                <a class="btn btn-primary selectmovilboton" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                </a>
                                <span data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Filtrar</span>
                            </p>

                            <div class="container-menu-mobile" id="collapseExample">
                                <div class="menu-perfil">
                                    <input class="btn-fav-0km" type="button" value="Favoritos 0km/usados">
                                    <input class="btn-fav-pl" type="button" value="Favoritos precio de lista">
                                    <input class="btn-uv" type="button" value="Unidades Visitadas">
                                    <input class="btn-uc" type="button" value="Unidades consultadas">
                                    <input class="btn-up" type="button" value="Unidades Publicadas">
                                    <div class="linea-filtro"></div>
                                    <button type="button" class="btn btn-primary"> BORRAR FILTROS </button>
                                </div>
                            </div>

                            <div class="linea-header lineamovil-agencia"></div>
                        </div>
                        <!-- Fin menú mobile -->


                        <div class="infopersonal">
                            <div class="div-infopersonal">
                                <p class="titulo-info-personal">Datos Personales</p>
                                <div class="linea-datos-agencia"></div>
                                <div class="table-responsive">
                                    <div class="container-datos-agencia">
                                        <table class="table">
                                            <tr>
                                                <td class="td-datos-agencia color1">
                                                    Nombre
                                                </td>
                                                <td class="td2-datos-agencia color2">
                                                    <?php echo $dato['nombre']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="td-datos-agencia color2">
                                                    Categoría
                                                </td>
                                                <td class="td2-datos-agencia color3">
                                                    <?php
                                                    if ($dato['agencia_tipo'] == 0) {
                                                        echo 'Agencia Oficial';
                                                    } else {
                                                        echo 'Reventa';
                                                    }

                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="td-datos-agencia color1">
                                                    Marca
                                                </td>
                                                <td class="td2-datos-agencia color2">
                                                    <?php echo $dato['marca_descri'] ?>
                                                </td>
                                            </tr>
                                        </table>
                                        <table style="margin-left: 1.25rem;" class="table">
                                            <tr>
                                                <td class="td-datos-agencia color1">
                                                    Localidad
                                                </td>
                                                <td class="td2-datos-agencia color2">
                                                    <?php echo $dato['localidad'] ?> - <?php $dato['provincia'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="td-datos-agencia color2">
                                                    Dirección
                                                </td>
                                                <td class="td2-datos-agencia color3">
                                                    <?php echo $dato['direccion'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <!-- Este td tiene la clase "bl" porque agregamos el border radius abajo a la izquierda -->
                                                <td class="td-datos-agencia bl color1">
                                                    Teléfono
                                                </td>
                                                <!-- Este td tiene la clase "br" porque agregamos el border radius abajo a la derecha -->
                                                <td class="td2-datos-agencia br color2">
                                                    <?php echo $dato['telefono']; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    <?php
                                }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <div class="lineaPerfil inferior"></div>
                        </div>

                        <div class="OkU">
                            <p class="titulo-fav-usados-mobile">Favoritos 0km / Usados
                                <a href="#" class="verMas" style="float:left">Ver Mas</a>
                            </p>

                            <?php
                            $nro_favorito = 1;
                            while ($fav = mysqli_fetch_array($favoritos)) {
                                $img = unserialize($fav['urls']);
                                if ($nro_favorito < 4) {



                            ?>
                                    <div class="product-item OkU_<?php echo $nro_favorito ?>">
                                        <div class="div-fondo-item overflow-hidden">
                                            <div class="div-fijo">
                                                <?php if ($fav['urls'] == 'a:0:{}') {
                                                ?>
                                                    <a href="detalle-producto.php?id_unidad=<?php echo $fav['id']; ?>"><img class="img-fluid" src="assets/img/producto-sin-imagen.png"></a>
                                                <?php
                                                } else { ?>
                                                    <a href="detalle-producto.php?id_unidad=<?php echo $fav['id']; ?>"><img class="img-fluid" src="<?php
                                                                                                                                                    echo $img[0] ?> "></a>

                                                <?php
                                                }
                                                ?>
                                                <!-- <a href="javascript:favorito(<?php echo $fav['id'] ?>, <?php echo $fav['agencia'] ?>)" class="btn-fav">
                                                        <img src="assets/img/btn-fav.png">
                                                    </a> -->
                                            </div>
                                        </div>
                                        <div class="info-0km-agencia">
                                            <p class="p-modelo-precio"> <b><?php echo $fav['modelo_descri'] ?></b> <span>$<?php echo $fav['valor_publico_pesos'] ?></span></p>
                                            <p class="p-marca-anio"> <?php echo $fav['marca_descri'] ?> | <?php echo $fav['anio'] ?> - <?php echo $fav['kilometraje'] ?></p>
                                        </div>

                                    </div>

                            <?php

                                }

                                $nro_favorito += 1;
                            }
                            ?>


                            <div class="lineaPerfil OkU_4"></div>

                        </div>

                        <div class="precioLista">
                            <p class="titulo-precio-lista">Favoritos Precio de lista</p>

                            <div class="container-lista-agencia">
                                <div class="product-item-lista">
                                    <!-- <div class="btn-fav-div" >
                                    <a href="#" class="btn-fav btn-fav-movil"><img src="assets/img/btn-fav.png"></a>
                                </div> -->
                                    <div class="precio-info">
                                        <span class="precio-lista"> $5.423.523 </span>
                                        <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#prueba_1" aria-expanded="false" aria-controls="collapseExample">
                                            INFO
                                        </button>
                                        <!--  <a href="#" class="btn-fav"><img src="assets/img/btn-fav.png"></a> -->
                                    </div>
                                    <p class="marca-modelo"> FERRARI | P80-C 3.0 </p>
                                    <p class="p-ciudad">0KM Junín | Buenos Aires</p>
                                    <div class="collapse" id="prueba_1">
                                        <div class="linea-vehiculos-lista"></div>
                                        <div class="table-responsive lista">
                                            <table class="table-caract">
                                                <tr>
                                                    <td class="td-1-lista color1">
                                                        Datos de agencia
                                                    </td>
                                                    <td class="td-2-lista color2">
                                                        ROM | Junín, Bs As
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-1-lista color2">
                                                        Fecha de cotización
                                                    </td>
                                                    <td class="td-2-lista color3">
                                                        10/09/2021
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-1-lista color1">
                                                        Fecha tope de pago
                                                    </td>
                                                    <td class="td-2-lista color2">
                                                        12/09/2021
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-1-lista color2">
                                                        Gastos
                                                    </td>
                                                    <td class="td-2-lista color3">
                                                        $5.234.123
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-1-lista color1">
                                                        Colores disponibles
                                                    </td>
                                                    <td class="td-2-lista color2">
                                                        Rojo / Negro
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-1-lista color2">
                                                        Disponibilidad
                                                    </td>
                                                    <td class="td-2-lista color3">
                                                        Para retirar
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container-lista-agencia">
                                <div class="product-item-lista">
                                    <!-- <div class="btn-fav-div" >
                                    <a href="#" class="btn-fav btn-fav-movil"><img src="assets/img/btn-fav.png"></a>
                                </div> -->
                                    <div class="precio-info">
                                        <span class="precio-lista"> $5.423.523 </span>
                                        <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#prueba_2" aria-expanded="false" aria-controls="collapseExample">
                                            INFO
                                        </button>
                                        <!-- <a href="#" class="btn-fav"><img src="assets/img/btn-fav.png"></a> -->
                                    </div>
                                    <p class="marca-modelo"> FERRARI | P80-C 3.0 </p>
                                    <p class="p-ciudad">0KM Junín | Buenos Aires</p>
                                    <div class="collapse" id="prueba_2">
                                        <div class="linea-vehiculos-lista"></div>
                                        <div class="table-responsive lista">
                                            <table class="table-caract">
                                                <tr>
                                                    <td class="td-1-lista color1">
                                                        Datos de agencia
                                                    </td>
                                                    <td class="td-2-lista color2">
                                                        ROM | Junín, Bs As
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-1-lista color2">
                                                        Fecha de cotización
                                                    </td>
                                                    <td class="td-2-lista color3">
                                                        10/09/2021
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-1-lista color1">
                                                        Fecha tope de pago
                                                    </td>
                                                    <td class="td-2-lista color2">
                                                        12/09/2021
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-1-lista color2">
                                                        Gastos
                                                    </td>
                                                    <td class="td-2-lista color3">
                                                        $5.234.123
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-1-lista color1">
                                                        Colores disponibles
                                                    </td>
                                                    <td class="td-2-lista color2">
                                                        Rojo / Negro
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-1-lista color2">
                                                        Disponibilidad
                                                    </td>
                                                    <td class="td-2-lista color3">
                                                        Para retirar
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container-lista-agencia">
                                <div class="product-item-lista">
                                    <!-- <div class="btn-fav-div" >
                                    <a href="#" class="btn-fav btn-fav-movil"><img src="assets/img/btn-fav.png"></a>
                                </div> -->
                                    <div class="precio-info">
                                        <span class="precio-lista"> $5.423.523 </span>
                                        <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#prueba_3" aria-expanded="false" aria-controls="collapseExample">
                                            INFO
                                        </button>
                                        <!--  <a href="#" class="btn-fav"><img src="assets/img/btn-fav.png"></a> -->
                                    </div>
                                    <p class="marca-modelo"> FERRARI | P80-C 3.0 </p>
                                    <p class="p-ciudad">0KM Junín | Buenos Aires</p>
                                    <div class="collapse" id="prueba_3">
                                        <div class="linea-vehiculos-lista"></div>
                                        <div class="table-responsive lista">
                                            <table class="table-caract">
                                                <tr>
                                                    <td class="td-1-lista color1">
                                                        Datos de agencia
                                                    </td>
                                                    <td class="td-2-lista color2">
                                                        ROM | Junín, Bs As
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-1-lista color2">
                                                        Fecha de cotización
                                                    </td>
                                                    <td class="td-2-lista color3">
                                                        10/09/2021
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-1-lista color1">
                                                        Fecha tope de pago
                                                    </td>
                                                    <td class="td-2-lista color2">
                                                        12/09/2021
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-1-lista color2">
                                                        Gastos
                                                    </td>
                                                    <td class="td-2-lista color3">
                                                        $5.234.123
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-1-lista color1">
                                                        Colores disponibles
                                                    </td>
                                                    <td class="td-2-lista color2">
                                                        Rojo / Negro
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-1-lista color2">
                                                        Disponibilidad
                                                    </td>
                                                    <td class="td-2-lista color3">
                                                        Para retirar
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="lineaPerfil"></div>

                        </div>

                        <div class="unidadesVisitadas">
                            <div class="table-responsive div-pr">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <p>Unidades Visitadas</p>
                                        </td>
                                    </tr>

                                    <tr class="tr-container-uv">
                                        <td class="td-dpr-1 UV1">
                                            <div class="detalle-productos-recomendados overflow-hidden productosUV">
                                                <div class="fondocontenedor-recomendados contenedorUV">
                                                    <img src="assets/img/ferrari8.jpg">
                                                    <span class="modelo">accord P80 - C</span>
                                                    <span class="marca-km">Ferrari - 100.000 KM</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="td-dpr-2 UV2">
                                            <div class="detalle-productos-recomendados overflow-hidden productosUV">
                                                <div class="fondocontenedor-recomendados contenedorUV">
                                                    <img src="assets/img/ferrari8.jpg">
                                                    <span class="modelo">accord P80 - C</span>
                                                    <span class="marca-km">Ferrari - 100.000 KM</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="td-dpr-3 UV3">
                                            <div class="detalle-productos-recomendados overflow-hidden productosUV">
                                                <div class="fondocontenedor-recomendados contenedorUV">
                                                    <img src="assets/img/ferrari8.jpg">
                                                    <span class="modelo">accord P80 - C</span>
                                                    <span class="marca-km">Ferrari - 100.000 KM</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="td-dpr-4 UV4">
                                            <div class="detalle-productos-recomendados overflow-hidden productosUV">
                                                <div class="fondocontenedor-recomendados contenedorUV">
                                                    <img src="assets/img/ferrari8.jpg">
                                                    <span class="modelo">accord P80 - C</span>
                                                    <span class="marca-km">Ferrari - 100.000 KM</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <div class="lineaPerfil"></div>
                            </div>
                        </div>


                        <div class="unidadesConsultadas">
                            <div class="table-responsive div-pr">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <p>Unidades Consultadas</p>
                                        </td>
                                    </tr>
                                    <tr class="tr-container-uc">
                                        <td class="td-dpr-1 UC1">
                                            <div class="detalle-productos-recomendados overflow-hidden productosUV">
                                                <div class="fondocontenedor-recomendados contenedorUV">
                                                    <img src="assets/img/ferrari8.jpg">
                                                    <span class="modelo">accord P80 - C</span>
                                                    <span class="marca-km">Ferrari - 100.000 KM</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="td-dpr-2 UC2">
                                            <div class="detalle-productos-recomendados overflow-hidden productosUV">
                                                <div class="fondocontenedor-recomendados contenedorUV">
                                                    <img src="assets/img/ferrari8.jpg">
                                                    <span class="modelo">accord P80 - C</span>
                                                    <span class="marca-km">Ferrari - 100.000 KM</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="td-dpr-3 UC3">
                                            <div class="detalle-productos-recomendados overflow-hidden productosUV">
                                                <div class="fondocontenedor-recomendados contenedorUV">
                                                    <img src="assets/img/ferrari8.jpg">
                                                    <span class="modelo">accord P80 - C</span>
                                                    <span class="marca-km">Ferrari - 100.000 KM</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="td-dpr-4 UC4">
                                            <div class="detalle-productos-recomendados overflow-hidden productosUV">
                                                <div class="fondocontenedor-recomendados contenedorUV">
                                                    <img src="assets/img/ferrari8.jpg">
                                                    <span class="modelo">accord P80 - C</span>
                                                    <span class="marca-km">Ferrari - 100.000 KM</span>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                </table>
                            </div>

                            <div class="lineaPerfil"></div>

                        </div>

                        <div class="unidadesPublicadas">

                            <p class="titulo-up">Unidades Publicadas
                                <a href="#" class="verMas" style="float:left">Ver Mas</a>
                            </p>
                            <?php
                            $nro_favorito = 1;
                            while ($publicada = mysqli_fetch_array($unidadPublicada)) {
                                $img = unserialize($publicada['urls']);
                                if ($nro_favorito < 4) {
                            ?>

                                    <div class="product-item up<?php echo $nro_favorito ?>">
                                        <div class="div-fondo-item overflow-hidden">
                                            <div class="div-fijo">
                                                <?php
                                                if ($publicada['urls'] == 'a:0:{}') {
                                                ?>
                                                    <a href="detalle-producto.php?id_unidad=<?php echo $publicada['id']; ?>"><img class="img-fluid" src="assets/img/producto-sin-imagen.png"></a>
                                                <?php
                                                } else { ?>
                                                    <a href="detalle-producto.php?id_unidad=<?php echo $publicada['id']; ?>"><img class="img-fluid" src="<?php echo $img[0] ?>"></a>

                                                <?php
                                                }
                                                ?>
                                                <!-- <a href="javascript:favorito(<?php echo $publicada['id'] ?>, <?php echo $fav['agencia'] ?>)"class="btn-fav">
                                        <img src="assets/img/btn-fav.png">
                                    </a> -->
                                            </div>
                                        </div>
                                        <div class="info-0km-agencia">
                                            <p class="p-modelo-precio"> <b><?php echo $publicada['modelo_descri'] ?></b><span>$ <?php echo $publicada['valor_publico_pesos'] ?></span></p>
                                            <p class="p-marca-anio"> <?php echo $publicada['marca_descri'] ?> | <?php echo $publicada['anio'] ?> - <?php echo $publicada['kilometraje'] ?> </p>
                                        </div>
                                    </div>




                            <?php
                                }
                                $nro_favorito += 1;
                            }
                            ?>
                        </div>

                    </div>
                </div>
        </section>
        <?php
    }

    /* Detalle producto para filtro extendido */
    public function printDetalleProducto($unidades, $udetalle, $udetalleModal, $localidad, $vehiculos_similares)
    {
        /* Cambiar Nombre variable id_unidad por unidades */

        while ($reg = mysqli_fetch_array($unidades)) {
            $img = unserialize($reg['urls']);
        ?>
            <script>
                function favorito(unidad, agencia) {
                    $.ajax({
                        type: "POST",
                        url: "vista/favorito.php",
                        data: {
                            unidad: unidad,
                            agencia: agencia,
                            pagina: 1
                        },
                        success: function(response) {
                            console.log(response)
                            $('.container-producto-vehiculo').html(response);

                        }
                    });
                }
            </script>

            <!--Carrusel Modal -->
            <div class="modal fade modalfade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modalcontent">
                        <div class="dividcontent" id="content_modal">

                            <!-- Div con fondo gris para rellenar foto -->
                            <div class="div-fondo-item divfondoitem-modal">

                                <img class="imagen-grande-detalle imd-modal" id="imatgeGran_modal" src="<?php echo ($reg['urls'] != 'a:0:{}' ?  $img[0] : 'assets/img/producto-sin-imagen.png') ?>" />
                                <a class="carousel-control-prev" href="#" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon_modal" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon_modal" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                            <div class="container-carrusel_modal ccm-modal">
                                <a href="#" class="izquierda_flecha_modal aizf"><img src="assets/img/arrow-carrusel.png" /></a>
                                <div class="idcarr" id="carrusel">
                                    <div class="carrusel_modal">
                                        <!-- Para poner fotos de la BD hay que conectar y hacer un bucle de los registros o fotos y despues rellenar dinámicamente los src de las imágenes-->
                                        <?php

                                        while ($regFotos = mysqli_fetch_array($udetalleModal)) {
                                            $img = unserialize($regFotos['urls']);

                                            for ($i = 0; $i < count($img); $i++) {
                                        ?>
                                                <!-- Para poner fotos de la BD hay que conectar y hacer un bucle de los registros o fotos y despues rellenar dinámicamente los src de las imágenes-->
                                                <div id="imagen_<?php echo $i; ?>_modal"><img class="img_carrusel_modal" data="assets/img/foto1.jpg" src=<?php echo $img[$i] ?> /></div>

                                        <?php
                                            }
                                        }

                                        ?>
                                    </div>
                                </div>
                                <a href="#" class="derecha_flecha_modal aderf"><img src="assets/img/arrow-carrusel.png" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section id="detalle-producto" class="detalle-producto">
                <div class="container-detalle-producto">
                    <div class="container-migas-detalles">
                        <ul class="miga-simple">
                            <li>ComunidAUTO</li>
                            <li><?php echo $reg['marca_descri'] ?> </li>
                            <li><?php echo $reg['modelo_descri'] ?></li>
                            <li><?php echo $reg['version'] ?></li>
                            <li><?php echo number_format($reg['kilometraje'], 0, ',', '.') ?> KM</li>
                        </ul>
                        <!-- Botón para volver al filtro extendido-->
                        <a onclick="javascript:history.go(-1)" class="boton-volver-listado"> VOLVER AL LISTADO </a>
                    </div>
                    <!-- Finaliza sección Header -->
                    <div class="linea-header linea-detalle-header"></div>
                    <!-- Comienzo sección info productos -->
                    <div class="row row-movil">
                        <div class="col-md-8 col-detalle-movil">
                            <!-- Informacion del producto - MOVIL -->
                            <div class="container-info detalle-movil">
                                <div class="container-info detallemovil-container-info">
                                    <span class="p-marca-detalle-movil">
                                        <b>
                                            <?php echo $reg['marca_descri'] ?>
                                            <?php echo $reg['version'] ?>
                                        </b>
                                    </span>
                                    <span class="detalle-precio-movil">
                                        <?php
                                        if ($reg['kilometraje'] == 0) {
                                        ?> $ <?php echo number_format($reg['valor_costo'], 0, ',', '.');
                                            } else {
                                                ?> $ <?php echo number_format($reg['valor_publico_pesos'], 0, ',', '.');
                                                    }
                                                        ?>
                                    </span>
                                </div>
                                <div style="margin-bottom: 1em">
                                    <span class="p-año-detalles-movil">
                                        <?php echo $reg['anio'] ?>
                                    </span>
                                </div>
                            </div>

                            <div class="overflow-hidden div-contenedor-carrusel" id="content">

                                <!-- Div con fondo gris para rellenar foto -->
                                <div class="div-fondo-item fondo-item-detalle" id="divfondoitem-img">
                                    <!-- <div class="detalle-movil item-detalle-movil">
                                        <a href="#" class="btn-fav item-btn-fav"><img class="item-img-detalle" src="assets/img/btn-fav.png"></a>
                                    </div> -->

                                    <a class="imagen-grande-detalle item-a-detalle-imagen-grande" data-toggle="modal" id="<?php echo $reg['id'] ?>" data-target="#exampleModalCenter"><img class="imagen-grande-detalle  item-img-detalle-imagen-grande" id="imatgeGran" src="<?php echo ($reg['urls'] != 'a:0:{}' ?  $img[0] : 'assets/img/producto-sin-imagen.png') ?>" /></a>
                                    <a class="carousel-control-prev" href="#" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                                <div class="container-carrusel item-container-carrusel">
                                    <a href="#" class="izquierda_flecha"><img src="assets/img/arrow-carrusel.png" /></a>
                                    <div id="carrusel">
                                        <div class="carrusel">
                                            <?php
                                            while ($regFotos = mysqli_fetch_array($udetalle)) {
                                                $img = unserialize($regFotos['urls']);

                                                for ($i = 0; $i < count($img); $i++) {
                                            ?>
                                                    <!-- Para poner fotos de la BD hay que conectar y hacer un bucle de los registros o fotos y despues rellenar dinámicamente los src de las imágenes-->
                                                    <div id="imagen_<?php echo $i; ?>"><img class="img_carrusel" data="assets/img/foto1.jpg" src=<?php echo $img[$i] ?> /></div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <a href="#" class="derecha_flecha"><img src="assets/img/arrow-carrusel.png" /></a>
                                </div>
                            </div>

                            <!-- DATOS DEL VENDEDOR - MOVIL -->

                            <div class="container-datos detalle-movil">

                                <button class="btn btn-primary movil collapsed" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Datos del vendedor
                                </button>
                                <div class="collapse div-collapse-vendedor-datos" id="collapseExample">
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <img class="img-perfil-location" src="assets/img/perfil_user.png">
                                            <p class="texto-item-desplegable-grande p-nombre-calle" style="text-transform:uppercase"><b><?php echo $reg['nombre'] ?></b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico"><b>
                                                <?php if ($reg['agencia_tipo'] == 0) {
                                                    echo 'Agencia Oficial';
                                                } else if ($reg['agencia_tipo'] == 1) {
                                                    echo "Agencia Multimarca";
                                                }
                                                ?>
                                            </b></span>
                                    </div>

                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <img class="img-perfil-location" src="assets/img/location.png">
                                            <p class="texto-item-desplegable-grande p-nombre-calle" style="text-transform:uppercase"><b><?php echo $reg['direccion'] ?></b></p>
                                            <p class="texto-item-desplegable-grande p-telefono-detalle">
                                                <?php
                                                $number = $reg['telefono'];
                                                $result = sprintf(
                                                    "%s-%s",
                                                    substr($number, 0, 4),
                                                    substr($number, 4, 12)
                                                );
                                                echo ($result);
                                                ?>
                                            </p>
                                        </div>
                                        <span class="texto-item-desplegable-chico"><b><?php echo $reg['localidad'] ?>, <?php echo $reg['provincia'] ?></b></span>
                                    </div>

                                    <?php
                                    // if (isset($_GET['chat'])) {
                                    ?>

                                    <div class="dropdown-item div-contenedor-telefono">
                                        <div class="div-item-telefono" style="cursor:pointer" onclick="insertar_chat('<?php echo $reg['nombre'] . ' | ' . $_SESSION['nombre_agencia'] ?>', '<?php echo $reg['agencia'] ?>')">
                                            <span class="texto-item-desplegable-grande p-telefono-desktop">
                                                INICIAR CHAT
                                            </span>
                                        </div>
                                    </div>

                                    <?php
                                    // }
                                    ?>

                                </div>
                            </div>
                            <!-- Linea para dividir -->

                            <div class="linea-separadora lineaseparadora_1"></div>

                            <!-- Info vehículos -->

                            <div class="table-responsive tablacaracteristicas">
                                <table class="table">
                                    <tr class="tr-titulo-caracteristicas">
                                        <td class="td-caract">
                                            Características
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-corto td-corto-14">
                                            Marca
                                        </td>
                                        <td class="td-rgba">
                                            <?php
                                            if ($reg['marca_descri'] != '') {
                                                echo $reg['marca_descri'];
                                            } else {
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-corto td-corto-5">
                                            Modelo
                                        </td>
                                        <td class="td-hsl">
                                            <?php echo $reg['modelo_descri'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-corto td-corto-14">
                                            Versión
                                        </td>
                                        <td class="td-rgba">
                                            <?php echo $reg['version'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-corto td-corto-5">
                                            Transmisión
                                        </td>
                                        <td class="td-hs1">
                                            <?php
                                            if ($reg['transmision'] != '') {
                                                echo $reg['transmision'];
                                            } else {
                                                echo 'Sin completar';
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="td-corto td-corto-14">
                                            Kilómetros
                                        </td>
                                        <td class="td-rgba">
                                            <?php
                                            if ($reg['transmision'] != '') {
                                                echo number_format($reg['kilometraje'], 0, ',', '.');
                                            } else {
                                                echo 'Sin completar';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-corto td-corto-5">
                                            Año
                                        </td>
                                        <td class="td-hsl">
                                            <?php
                                            if ($reg['anio'] != '') {
                                                echo $reg['anio'];
                                            } else {
                                                echo 'Sin completar';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-corto td-corto-14">
                                            Ubicación
                                        </td>
                                        <td class="td-rgba">
                                            <?php
                                            if ($reg['localidad'] != '') {
                                                echo $reg['localidad'];
                                            } else {
                                                echo 'Sin completar';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-corto td-corto-5">
                                            Combustible
                                        </td>
                                        <td class="td-hsl">
                                            <?php
                                            if ($reg['combustible'] != '') {
                                                echo $reg['combustible'];
                                            } else {
                                                echo 'Sin completar';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <td class="td-corto td-corto-14">
                                        Color
                                    </td>
                                    <td class="td-rgba">
                                        <?php
                                        if ($reg['color'] != '') {
                                            echo $reg['color'];
                                        } else {
                                            echo 'Sin completar';
                                        }
                                        ?>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td class="td-corto td-corto-5">
                                            Tipo Vehiculo
                                        </td>
                                        <td class="td-hsl">
                                            <?php echo $reg['tipo']; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="linea-separadora linea-descripcion"></div>
                            <!-- Descripción vehículos -->
                            <div class="container-descripcion">
                                <!-- <div class="table-responsive tabla-responsive-descripcion">
                                        <table class="table">
                                            <tr class="tr-descripcion">
                                                <td class="td-descripcion" >
                                                    Descripción
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="td-top">
                                                    • Aire acondicionado
                                                </td>
                                                <td class="td-top2">
                                                    • Cámara de visión trasera
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="td-top">
                                                    • Computadora de a bordo
                                                </td>
                                                <td class="td-top2">
                                                    • Alarma de luces encendidas
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="td-top">
                                                    • Apertura de baúl y tapa de combustible interno y a distancia solo baúl
                                                </td>
                                                <td class="td-top2">
                                                    • Dirección asistida eléctrica progresiva
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="td-top">
                                                    •  Asientos delanteros con ajuste en altura solo conductor, con ajuste manual
                                                </td>
                                                <td class="td-top2">
                                                    • Encendido del motor con botón
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="td-top">
                                                    • Espejos exteriores eléctricos
                                                </td>
                                                <td class="td-top2">
                                                    • Asientos traseros abotibles completos
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="td-top">
                                                    • Faros antiniebla traseros
                                                </td>
                                                <td class="td-top2">
                                                    • Limitador de velocidad
                                                </td>
                                            </tr>
                                        </table>
                                    </div> -->
                            </div>
                        </div>
                        <!-- NO SE TOCA MÁS LA COL-MD-4 -->
                        <div class="col-md-4 detalle-desktop">
                            <div>
                                <div class="container-info container-producto-vehiculo">
                                    <p class="p-container-vehiculo-marca"><b><?php echo $reg['marca_descri'] ?> - <?php echo $reg['version'] ?></b></p>
                                    <p class="p-container-vehiculo-año"> <?php echo $reg['anio'] ?>- <?php echo number_format($reg['kilometraje'], 0, ',', '.'); ?> KM </p>
                                    <p class="p-container-vehiculo-precio">
                                        <?php
                                        if ($reg['kilometraje'] == 0) {
                                            echo '$' . number_format($reg['valor_costo'], 0, ',', '.');
                                        } else {
                                            echo '$' . number_format($reg['valor_publico_pesos'], 0, ',', '.');
                                        }
                                        ?>
                                    </p>
                                    <?php
                                    if (isset($_GET['calificacion'])) {
                                    ?>
                                        <span class="d-flex flex-row">
                                            <?php
                                            ?>
                                            <img src="assets/img/rueda.svg" style="height:2rem" alt="ruedas de calificacion de las unidades">
                                            <img src="assets/img/rueda.svg" style="height:2rem" alt="ruedas de calificacion de las unidades">
                                            <img src="assets/img/rueda.svg" style="height:2rem" alt="ruedas de calificacion de las unidades">
                                            <img src="assets/img/rueda.svg" style="height:2rem" alt="ruedas de calificacion de las unidades">
                                            <img src="assets/img/rueda-white.svg" style="height:2rem" alt="ruedas de calificacion de las unidades">
                                        </span>
                                    <?php
                                    }
                                    ?>

                                    <!-- <a href="javascript:favorito(<?php echo $reg['id'] ?>, <?php echo $reg['agencia'] ?>)" class="btn-fav btn-fav-stock">

                                    <?php
                                    if ($reg['activo'] == 1) {
                                    ?>
                                            <img src="assets/img/btn-fav-hover.png" id="click" class="btn-fav-img">
                                            <?php
                                        } else {
                                            ?>
                                            <img src="assets/img/btn-fav.png" class="btn-fav-img">
                                            <?php
                                        }
                                            ?>
                                    </a> -->

                                </div>
                            </div>
                            <div class="container-datos container-datos-vendedor-desktop">
                                <button class="btn btn-primary collapsed boton-datos-vendedor" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Datos del vendedor
                                </button>
                                <div class="collapse informacion-contacto-vendedor" id="collapseExample">
                                    <div class="dropdown-item div-contenedor-nombre-tipo">
                                        <div class="div-item-nombre-tipo">
                                            <img class="img-usuario-locacion-detalle-desktop" src="assets/img/perfil_user.png">
                                            <p class="texto-item-desplegable-grande p-nombre-direccion-desktop" style="text-transform:uppercase"><b><?php echo $reg['nombre']; ?></b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico tipo-de-vendedor-ciudad"><b>
                                                <?php if ($reg['agencia_tipo'] == 0) {
                                                    echo 'Agencia Oficial';
                                                } else if ($reg['agencia_tipo'] == 1) {
                                                    echo "Agencia Multimarca";
                                                }
                                                ?>
                                            </b></span>
                                    </div>

                                    <div class="dropdown-item div-contenedor-direccion">
                                        <div class="div-item-direccion">
                                            <img class="img-usuario-locacion-detalle-desktop" src="assets/img/location.png">
                                            <p class="texto-item-desplegable-grande p-nombre-direccion-desktop" style="text-transform:uppercase"><b><?php echo $reg['direccion']; ?></b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico tipo-de-vendedor-ciudad"><b><?php echo $reg['localidad'] . ' - ';
                                                                                                                echo $reg['provincia']; ?></b></span>
                                    </div>

                                    <div class="dropdown-item div-contenedor-telefono">
                                        <div class="div-item-telefono">
                                            <span class="texto-item-desplegable-grande p-telefono-desktop">
                                                <?php echo $reg['telefono']; ?>
                                            </span>
                                        </div>
                                    </div>

                                    <?php
                                    // if (isset($_GET['chat'])) {
                                    ?>

                                    <div class="dropdown-item div-contenedor-telefono">
                                        <div class="div-item-telefono" style="cursor:pointer" onclick="insertar_chat('<?php echo $reg['nombre'] . ' | ' . $_SESSION['nombre_agencia'] ?>', '<?php echo $reg['agencia'] ?>')">
                                            <span class="texto-item-desplegable-grande p-telefono-desktop">
                                                INICIAR CHAT
                                            </span>
                                        </div>
                                    </div>

                                    <?php
                                    // }

                                    ?>

                                </div>
                            </div>
                        </div>

                        <div class="table-responsive div-pr">

                            <table class="table">
                                <tr>
                                    <td class="titulo-vehiculos-similares">
                                        Vehículos similares
                                    </td>
                                </tr>
                                <tr class="tr-vehiculos-similares">
                                    <?php while ($reg_s2 = mysqli_fetch_array($vehiculos_similares)) {
                                        $imagen = unserialize($reg_s2['urls']); ?>
                                        <td class="td-dpr-1" style="cursor:pointer">
                                            <div class="detalle-productos-recomendados overflow-hidden">
                                                <div class="fondocontenedor-recomendados" onclick="javascript:window.location.href='detalle-producto.php?id_unidad=<?php echo $reg_s2['id_unidad'] ?>'">
                                                    <img src="<?php echo ($reg_s2['urls'] != 'a:0:{}' ?  $imagen[0] : 'assets/img/producto-sin-imagen.png') ?>">
                                                    <span><?php echo $reg_s2['version'] ?></span>
                                                    <span class="span-tdpr"><?php echo $reg_s2['modelo_descri'] . ' - ' . $reg_s2['kilometraje'] . 'KM' ?></span>
                                                    <span class="span-precio-similar"> $<?php echo number_format($reg_s2['valor_publico_pesos'], 0, ',', '.'); ?></span>
                                                </div>
                                            </div>
                                        </td>
                                    <?php
                                    }
                                    ?>
                                    <?php

                                    ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
    }

    public function registro()
    {
        ?>
        <h1>hola</h1>
    <?php
    }

    public function carrousel_imagenes($ultimos)
    {
    ?>
        <script>
            $(document).ready(function() {


                if ($('.bbb_viewed_slider').length) {
                    var viewedSlider = $('.bbb_viewed_slider');

                    viewedSlider.owlCarousel({
                        loop: true,
                        margin: 20,
                        autoplay: true,
                        autoplayTimeout: 6000,
                        nav: false,
                        dots: true,
                        responsive: {
                            0: {
                                items: 1
                            },
                            575: {
                                items: 2
                            },
                            768: {
                                items: 3
                            },
                            991: {
                                items: 4
                            },
                            1199: {
                                items: 6
                            }
                        }
                    });

                    if ($('.bbb_viewed_prev').length) {
                        var prev = $('.bbb_viewed_prev');
                        prev.on('click', function() {
                            viewedSlider.trigger('prev.owl.carousel');
                        });
                    }

                    if ($('.bbb_viewed_next').length) {
                        var next = $('.bbb_viewed_next');
                        next.on('click', function() {
                            viewedSlider.trigger('next.owl.carousel');
                        });
                    }
                }


            });

            function redirigir_a_unidad(id_unidad) {
                window.location.href = "detalle-producto.php?id_unidad=" + id_unidad;
            }
        </script>

        <style>
            .owl-prev,
            .owl-next {
                background: #f00353 !important;
            }

            .owl-nav {
                display: flex;
                justify-content: space-between;
            }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
        <div class="container" style="max-width:78%">
            <div class="bbb_viewed">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="bbb_main_container">
                                <div class="bbb_viewed_title_container">
                                    <h2 class="bbb_viewed_title text-center text-center text-uppercase font-weight-bold color-primario">&Uacute;ltimas unidades de agencias agregadas</h2>
                                    <div class="bbb_viewed_nav_container">
                                        <div class="bbb_viewed_nav bbb_viewed_prev"><i class="fas fa-chevron-left"></i></div>
                                        <div class="bbb_viewed_nav bbb_viewed_next"><i class="fas fa-chevron-right"></i></div>
                                    </div>
                                </div>
                                <div class="bbb_viewed_slider_container">
                                    <div class="owl-carousel owl-theme bbb_viewed_slider">
                                        <?php
                                        while ($reg = mysqli_fetch_array($ultimos)) {
                                            $precio = ($reg['valor_publico_pesos'] > 0 ? $reg['valor_publico_pesos'] : $reg['valor_publico_dolar']);
                                            $moneda = ($reg['valor_publico_pesos'] > 0 ? '$' : 'U$S');
                                            $imagenes = unserialize($reg['urls']);
                                        ?>
                                            <!-- <div class="owl-item">
                                                <div class="bbb_viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center ">
                                                    <div style="cursor:pointer" class="bbb_viewed_image" <?php echo (isset($_SESSION['id_usuario']) ? ' onclick="redirigir_a_unidad(' . $reg['id_unidad'] . ')" ' : 'onclick="javascript:loginModal()"') ?>>
                                                        <img src="<?php echo $imagenes[0] ?>" alt="">
                                                    </div>
                                                    <div style="cursor:pointer" class="bbb_viewed_content text-center" <?php echo (isset($_SESSION['id_usuario']) ? ' onclick="redirigir_a_unidad(' . $reg['id_unidad'] . ')" ' : 'onclick="javascript:loginModal()"') ?>>
                                                        <div class="bbb_viewed_price"><span><?php echo (isset($_SESSION['id_usuario']) ? $moneda . ' ' . number_format($precio, 2, ",", ".") : '') ?></span></div>
                                                        <div class="bbb_viewed_name"><a href="#"><?php echo $reg['marca_descri']  . ' ' . $reg['modelo_descri'] ?></a></div>
                                                    </div>
                                                    <ul class="item_marks">
                                                        <li class="item_mark item_discount">-25%</li>
                                                        <li class="item_mark item_new">NEW</li>
                                                    </ul>
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-md-4"> -->
                                            <!-- <h4 class="text-center"><strong>STYLE 3</strong></h4> -->
                                            <!-- <hr> -->
                                            <div class="profile-card-4 text-center" <?php echo (isset($_SESSION['id_usuario']) ? ' onclick="redirigir_a_unidad(' . $reg['id_unidad'] . ')" ' : 'onclick="javascript:loginModal()"') ?>>
                                                <img loading="lazy" src="<?php echo $imagenes[0] ?>" class="img img-responsive">
                                                <div class="profile-content">
                                                    <!-- <div class="profile-name">John Doe
                                                            <p>@johndoedesigner</p>
                                                        </div> -->
                                                    <!-- <div class="profile-description">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor.</div> -->
                                                    <div class="row justify-content-center">
                                                        <div class="col-xs-12">
                                                            <div class="profile-overview">
                                                                <p><?php echo $reg['marca_descri'] . ' ' . $reg['modelo_descri'] ?></p>
                                                                <h4><?php echo (isset($_SESSION['id_usuario']) ? $moneda . ' ' . number_format($precio, 2, ",", ".") : '') ?></h4>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-xs-6">
                                                            <div class="profile-overview">
                                                                <p><?php echo $reg['modelo_descri'] ?></p>
                                                                <h4>250</h4>
                                                            </div>
                                                        </div> -->
                                                        <!-- <div class="col-xs-4">
                                                            <div class="profile-overview">
                                                                <p>FOLLOWING</p>
                                                                <h4>168</h4>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                                <?php
                                if (isset($_SESSION['id_usuario'])) {
                                ?>
                                    <div class="w-100 text-center">
                                        <a href="https://comunidauto.net.ar/ultimos_ingresos.php">
                                            <h3 style="color: #f00353">Ver M&aacute;s</h3>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <script>
            $(document).ready(function() {
                $('.owl-prev').text('ANTERIOR');
                $('.owl-next').text('SIGUIENTE');
            });
        </script>
    <?php
    }

    public function carrousel_imagenes_particulares($ultimos)
    {
    ?>
        <script>
            $(document).ready(function() {


                if ($('.bbb_viewed_slider').length) {
                    var viewedSlider = $('.bbb_viewed_slider');

                    viewedSlider.owlCarousel({
                        loop: true,
                        margin: 20,
                        autoplay: true,
                        autoplayTimeout: 6000,
                        nav: false,
                        dots: false,
                        responsive: {
                            0: {
                                items: 1
                            },
                            575: {
                                items: 2
                            },
                            768: {
                                items: 3
                            },
                            991: {
                                items: 4
                            },
                            1199: {
                                items: 6
                            }
                        }
                    });

                    if ($('.bbb_viewed_prev').length) {
                        var prev = $('.bbb_viewed_prev');
                        prev.on('click', function() {
                            viewedSlider.trigger('prev.owl.carousel');
                        });
                    }

                    if ($('.bbb_viewed_next').length) {
                        var next = $('.bbb_viewed_next');
                        next.on('click', function() {
                            viewedSlider.trigger('next.owl.carousel');
                        });
                    }
                }


            });

            function redirigir_a_unidad_particular(id_unidad) {
                window.location.href = "detalle-particulares.php?id_unidad=" + id_unidad;
            }
        </script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
        <div class="container" style="max-width:78%">
            <div class="bbb_viewed">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="bbb_main_container">
                                <div class="bbb_viewed_title_container">
                                    <h2 class="bbb_viewed_title text-center text-center text-uppercase font-weight-bold color-primario">&Uacute;ltimas unidades Particulares agregadas</h2>
                                    <div class="bbb_viewed_nav_container">
                                        <div class="bbb_viewed_nav bbb_viewed_prev"><i class="fas fa-chevron-left"></i></div>
                                        <div class="bbb_viewed_nav bbb_viewed_next"><i class="fas fa-chevron-right"></i></div>
                                    </div>
                                </div>
                                <div class="bbb_viewed_slider_container">
                                    <div class="owl-carousel owl-theme bbb_viewed_slider">
                                        <?php
                                        while ($reg = mysqli_fetch_array($ultimos)) {
                                            $imagenes = explode(' -', $reg['imagenes']);
                                        ?>
                                            <div class="profile-card-4 text-center" <?php echo (isset($_SESSION['id_usuario']) ? ' onclick="redirigir_a_unidad_particular(' . $reg['id_unidad'] . ')" ' : 'onclick="javascript:loginModal()"') ?>>
                                                <img loading="lazy" src="<?php echo $imagenes[0] ?>" class="img img-responsive">
                                                <div class="profile-content">
                                                    <div class="row justify-content-center">
                                                        <div class="col-xs-12">
                                                            <div class="profile-overview">
                                                                <p><?php echo $reg['marca_descri'] . ' ' . $reg['modelo_descri'] ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                                <?php
                                if (isset($_SESSION['id_usuario'])) {
                                ?>
                                    <div class="w-100 text-center">
                                        <a href="https://comunidauto.net.ar/ultimos_ingresos.php">
                                            <h3 style="color: #f00353">Ver M&aacute;s</h3>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('.owl-prev').text('ANTERIOR');
                $('.owl-next').text('SIGUIENTE');
            });
        </script>
        <?php
    }

    public function printDetalleProductoParticular($unidades, $udetalle, $udetalleModal, $localidad, $vehiculos_similares)
    {

        while ($reg = mysqli_fetch_array($unidades)) {
            $img = explode(' - ', $reg['imagenes']);
        ?>

            <!--Carrusel Modal -->
            <div class="modal fade modalfade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modalcontent">
                        <div class="dividcontent" id="content_modal">

                            <!-- Div con fondo gris para rellenar foto -->
                            <div class="div-fondo-item divfondoitem-modal">

                                <img class="imagen-grande-detalle imd-modal" id="imatgeGran_modal" src="<?php echo ($reg['imagenes'] != '0' ?  $img[0] : 'assets/img/producto-sin-imagen.png') ?>" />
                                <a class="carousel-control-prev" href="#" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon_modal" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon_modal" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                            <div class="container-carrusel_modal ccm-modal">
                                <a href="#" class="izquierda_flecha_modal aizf"><img src="assets/img/arrow-carrusel.png" /></a>
                                <div class="idcarr" id="carrusel">
                                    <div class="carrusel_modal">
                                        <!-- Para poner fotos de la BD hay que conectar y hacer un bucle de los registros o fotos y despues rellenar dinámicamente los src de las imágenes-->
                                        <?php

                                        while ($regFotos = mysqli_fetch_array($udetalleModal)) {
                                            $img = explode(' - ', $reg['imagenes']);

                                            for ($i = 0; $i < count($img) - 1; $i++) {
                                                if ($img[$i] == '0') {
                                        ?>
                                                    <div id="imagen_<?php echo $i; ?>_modal"><img class="img_carrusel_modal" data="assets/img/foto1.jpg" src="assets/img/producto-sin-imagen.png" /></div>
                                                <?php
                                                } else {
                                                ?>
                                                    <!-- Para poner fotos de la BD hay que conectar y hacer un bucle de los registros o fotos y despues rellenar dinámicamente los src de las imágenes-->
                                                    <div id="imagen_<?php echo $i; ?>_modal"><img class="img_carrusel_modal" data="assets/img/foto1.jpg" src=<?php echo $img[$i] ?> /></div>

                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <a href="#" class="derecha_flecha_modal aderf"><img src="assets/img/arrow-carrusel.png" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section id="detalle-producto" class="detalle-producto">
                <div class="container-detalle-producto">
                    <div class="container-migas-detalles">
                        <ul class="miga-simple">
                            <li>ComunidAUTO</li>
                            <li><?php echo $reg['marca_descri'] ?> </li>
                            <li><?php echo $reg['modelo_descri'] ?></li>
                            <li><?php echo $reg['version'] ?></li>
                            <li><?php echo number_format($reg['kilometraje'], 0, ',', '.') ?> KM</li>
                        </ul>
                        <!-- Botón para volver al filtro extendido-->
                        <a onclick="javascript:history.go(-1)" class="boton-volver-listado"> VOLVER AL LISTADO </a>
                    </div>
                    <!-- Finaliza sección Header -->
                    <div class="linea-header linea-detalle-header"></div>
                    <!-- Comienzo sección info productos -->
                    <div class="row row-movil">
                        <div class="col-md-8 col-detalle-movil">
                            <!-- Informacion del producto - MOVIL -->
                            <div class="container-info detalle-movil">
                                <div class="container-info detallemovil-container-info">
                                    <span class="p-marca-detalle-movil">
                                        <b>
                                            <?php echo $reg['marca_descri'] ?>
                                            <?php echo $reg['version'] ?>
                                        </b>
                                    </span>
                                    <span class="detalle-precio-movil">
                                        <?php
                                        if ($reg['precio_moderado'] != '' && $reg['precio_moderado'] != '0') {
                                            echo '$' . $reg['precio_moderado'];
                                        } else {
                                            echo 'Consultar $';
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div style="margin-bottom: 1em">
                                    <span class="p-año-detalles-movil">
                                        <?php echo $reg['anio'] ?>
                                    </span>
                                </div>
                            </div>

                            <div class="overflow-hidden div-contenedor-carrusel" id="content">

                                <!-- Div con fondo gris para rellenar foto -->
                                <div class="div-fondo-item fondo-item-detalle" id="divfondoitem-img">
                                    <!-- <div class="detalle-movil item-detalle-movil">
                                    <a href="#" class="btn-fav item-btn-fav"><img class="item-img-detalle" src="assets/img/btn-fav.png"></a>
                                </div> -->

                                    <a class="imagen-grande-detalle item-a-detalle-imagen-grande" data-toggle="modal" id="<?php echo $reg['id'] ?>" data-target="#exampleModalCenter"><img class="imagen-grande-detalle  item-img-detalle-imagen-grande" id="imatgeGran" src="<?php echo ($reg['imagenes'] != '0' ?  $img[0] : 'assets/img/producto-sin-imagen.png') ?>" /></a>
                                    <a class="carousel-control-prev" href="#" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                                <div class="container-carrusel item-container-carrusel">
                                    <a href="#" class="izquierda_flecha"><img src="assets/img/arrow-carrusel.png" /></a>
                                    <div id="carrusel">
                                        <div class="carrusel">
                                            <?php
                                            while ($regFotos = mysqli_fetch_array($udetalle)) {
                                                $img = explode(' - ', $reg['imagenes']);

                                                for ($i = 0; $i < count($img) - 1; $i++) {
                                                    if ($img[$i] == '0') {
                                            ?>
                                                        <div id="imagen_<?php echo $i; ?>"><img loading="lazy" class="img_carrusel" data="assets/img/foto1.jpg" src="assets/img/producto-sin-imagen.png" /></div>
                                                    <?php
                                                    } else {

                                                    ?>
                                                        <!-- Para poner fotos de la BD hay que conectar y hacer un bucle de los registros o fotos y despues rellenar dinámicamente los src de las imágenes-->
                                                        <div id="imagen_<?php echo $i; ?>"><img loading="lazy" class="img_carrusel" data="assets/img/foto1.jpg" src=<?php echo $img[$i] ?> /></div>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <a href="#" class="derecha_flecha"><img loading="lazy" src="assets/img/arrow-carrusel.png" /></a>
                                </div>
                            </div>

                            <!-- DATOS DEL VENDEDOR - MOVIL -->

                            <div class="container-datos detalle-movil">

                                <button class="btn btn-primary movil collapsed" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Datos del vendedor
                                </button>
                                <div class="collapse div-collapse-vendedor-datos" id="collapseExample">
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <img class="img-perfil-location" src="assets/img/perfil_user.png">
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b><?php echo $reg['nombre'] ?></b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico"><b>
                                                Particular
                                            </b></span>
                                    </div>

                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <img class="img-perfil-location" src="assets/img/location.png">
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>Localidad</b></p>
                                            <p class="texto-item-desplegable-grande p-telefono-detalle">
                                                <?php
                                                $number = $reg['telefono'];
                                                $result = sprintf(
                                                    "%s-%s",
                                                    substr($number, 0, 4),
                                                    substr($number, 4, 12)
                                                );
                                                echo ($result);
                                                ?>
                                            </p>
                                        </div>
                                        <span class="texto-item-desplegable-chico"><b><?php echo $reg['localidad'] ?>, <?php echo $reg['provincia'] ?></b></span>
                                        <br> <!-- El BR se agrega para que haya un espacio al final -->
                                    </div>
                                </div>
                            </div>

                            <!-- FORMULARIO DE INSPECCION -->

                            <div class="container-datos detalle-movil">

                                <button class="btn btn-primary movil collapsed" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                                    Formulario de Inspección
                                </button>
                                <div class="collapse div-collapse-vendedor-datos" id="collapseExample2">
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿<?php echo $reg['nombre'] ?> es titular del vehículo?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['es_titular'] == "1") {
                                                    echo "Si";
                                                } else if ($reg['es_titular'] == "2") {
                                                    echo "No";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿Tiene un co-titular o figura casado/a en el título?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['co_titular'] == "1") {
                                                    echo "Si";
                                                } else if ($reg['co_titular'] == "2") {
                                                    echo "No";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿Tiene daños estructurales o de seguridad? (choque fuerte, airbags o abs sin funcionar)</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['danios'] == "1") {
                                                    echo "Si";
                                                } else if ($reg['danios'] == "2") {
                                                    echo "No";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>Cuándo el auto está en marcha ¿se prende alguna luz de advertencia en el tablero?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['motor_luz'] == "1") {
                                                    echo "Si";
                                                } else if ($reg['motor_luz'] == "2") {
                                                    echo "No";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿El parabrisas esta rajado o tiene piquete?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['parabrisas_detalle'] == "1") {
                                                    echo "Si";
                                                } else if ($reg['parabrisas_detalle'] == "2") {
                                                    echo "No";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿Cuál es el estado general de la pintura?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['pintura_estado'] == "1") {
                                                    echo "Muy bueno";
                                                } else if ($reg['pintura_estado'] == "2") {
                                                    echo "Excelente";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿Cuál es el estado del tapizado? ¿Está sano o roto?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['tapizado_estado'] == "1") {
                                                    echo "Sano";
                                                } else if ($reg['tapizado_estado'] == "2") {
                                                    echo "Roto";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿Cuál es el estado de limpieza?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['tapizado_limpio'] == "1") {
                                                    echo "Sin manchas";
                                                } else if ($reg['tapizado_limpio'] == "2") {
                                                    echo "Algo manchado";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿El aire acondicionado enfría?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['aire_frio'] == "1") {
                                                    echo "Si";
                                                } else if ($reg['aire_frio'] == "2") {
                                                    echo "No";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿La calefacción calienta?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['aire_caliente'] == "1") {
                                                    echo "Si";
                                                } else if ($reg['aire_caliente'] == "2") {
                                                    echo "No";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿Cuántos kilómetros tienen los neumáticos?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['km_neumaticos'] == "1") {
                                                    echo "De 0 a 20 mil";
                                                } else if ($reg['km_neumaticos'] == "2") {
                                                    echo "De 20 mil a 40 mil";
                                                } else if ($reg['km_neumaticos'] == "3") {
                                                    echo "Más 40 mil";
                                                } else if ($reg['km_neumaticos'] == "4") {
                                                    echo "No sé";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿Tenés todos los accesorios? (llave comando, segunda llave, rueda de auxilio,ve cruz).</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['accesorios'] == "1") {
                                                    echo "Si";
                                                } else if ($reg['accesorios'] == "2") {
                                                    echo "No";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <br> <!-- El BR se agrega para que haya un espacio al final -->
                                </div>
                            </div>

                            <!-- Linea para dividir -->

                            <div class="linea-separadora lineaseparadora_1"></div>

                            <!-- Info vehículos -->

                            <div class="table-responsive tablacaracteristicas">
                                <table class="table">
                                    <tr class="tr-titulo-caracteristicas">
                                        <td class="td-caract">
                                            Características
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-corto td-corto-14">
                                            Marca
                                        </td>
                                        <td class="td-rgba">
                                            <?php echo $reg['marca_descri']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-corto td-corto-5">
                                            Modelo
                                        </td>
                                        <td class="td-hsl">
                                            <?php echo $reg['modelo_descri'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-corto td-corto-14">
                                            Versión
                                        </td>
                                        <td class="td-rgba">
                                            <?php echo $reg['version'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-corto td-corto-5">
                                            Transmisión
                                        </td>
                                        <td class="td-hs1">
                                            <?php echo $reg['transmision'] ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="td-corto td-corto-14">
                                            Kilómetros
                                        </td>
                                        <td class="td-rgba">
                                            <?php echo number_format($reg['kilometraje'], 0, ',', '.'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-corto td-corto-5">
                                            Año
                                        </td>
                                        <td class="td-hsl">
                                            <?php echo $reg['anio']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-corto td-corto-14">
                                            Ubicación
                                        </td>
                                        <td class="td-rgba">
                                            <?php
                                            $reg_localidad = mysqli_fetch_array($localidad);
                                            echo $reg_localidad['localidad'];
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-corto td-corto-5">
                                            Combustible
                                        </td>
                                        <td class="td-hsl">
                                            <?php echo $reg['combustible']; ?>
                                        </td>
                                    </tr>
                                    <td class="td-corto td-corto-14">
                                        Color
                                    </td>
                                    <td class="td-rgba">
                                        <?php echo $reg['color']; ?>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td class="td-corto td-corto-5">
                                            Tipo Vehiculo
                                        </td>
                                        <td class="td-hsl">
                                            <?php echo $reg['tipo']; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="linea-separadora linea-descripcion"></div>
                            <!-- Descripción vehículos -->
                            <div class="container-descripcion">
                                <!-- <div class="table-responsive tabla-responsive-descripcion">
                                    <table class="table">
                                        <tr class="tr-descripcion">
                                            <td class="td-descripcion" >
                                                Descripción
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-top">
                                                • Aire acondicionado
                                            </td>
                                            <td class="td-top2">
                                                • Cámara de visión trasera
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-top">
                                                • Computadora de a bordo
                                            </td>
                                            <td class="td-top2">
                                                • Alarma de luces encendidas
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-top">
                                                • Apertura de baúl y tapa de combustible interno y a distancia solo baúl
                                            </td>
                                            <td class="td-top2">
                                                • Dirección asistida eléctrica progresiva
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-top">
                                                •  Asientos delanteros con ajuste en altura solo conductor, con ajuste manual
                                            </td>
                                            <td class="td-top2">
                                                • Encendido del motor con botón
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-top">
                                                • Espejos exteriores eléctricos
                                            </td>
                                            <td class="td-top2">
                                                • Asientos traseros abotibles completos
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-top">
                                                • Faros antiniebla traseros
                                            </td>
                                            <td class="td-top2">
                                                • Limitador de velocidad
                                            </td>
                                        </tr>
                                    </table>
                                </div> -->
                            </div>
                        </div>
                        <!-- NO SE TOCA MÁS LA COL-MD-4 -->
                        <div class="col-md-4 detalle-desktop">
                            <div>
                                <div class="container-info container-producto-vehiculo">
                                    <p class="p-container-vehiculo-marca"><b><?php echo $reg['marca_descri'] ?> - <?php echo $reg['version'] ?></b></p>
                                    <p class="p-container-vehiculo-año"> <?php echo $reg['anio'] ?>- <?php echo number_format($reg['kilometraje'], 0, ',', '.'); ?> KM </p>
                                    <p class="p-container-vehiculo-precio">
                                        <?php
                                        if ($reg['precio_moderado'] != '' && $reg['precio_moderado'] != '0') {
                                            echo '$' . $reg['precio_moderado'];
                                        } else {
                                            echo 'Consultar $';
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>

                            <div class="container-datos container-datos-vendedor-desktop">
                                <button class="btn btn-primary collapsed boton-datos-vendedor" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Datos del vendedor
                                </button>
                                <div class="collapse informacion-contacto-vendedor" id="collapseExample">
                                    <div class="dropdown-item div-contenedor-nombre-tipo">
                                        <div class="div-item-nombre-tipo">
                                            <img class="img-usuario-locacion-detalle-desktop" src="assets/img/perfil_user.png">
                                            <p class="texto-item-desplegable-grande p-nombre-direccion-desktop"><b><?php echo $reg['nombre']; ?></b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico tipo-de-vendedor-ciudad"><b>
                                                Particular
                                            </b></span>
                                    </div>

                                    <div class="dropdown-item div-contenedor-direccion">
                                        <div class="div-item-direccion">
                                            <img class="img-usuario-locacion-detalle-desktop" src="assets/img/location.png">
                                            <p class="texto-item-desplegable-grande p-nombre-direccion-desktop"><b>Localidad</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico tipo-de-vendedor-ciudad"><b><?php echo $reg['localidad'] . ' - ';
                                                                                                                echo $reg['provincia']; ?></b></span>
                                    </div>

                                    <div class="dropdown-item div-contenedor-telefono">
                                        <div class="div-item-telefono">
                                            <span class="texto-item-desplegable-grande p-telefono-desktop">
                                                <?php
                                                echo $reg['telefono'];
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-datos container-datos-vendedor-desktop">
                                <button class="btn btn-primary collapsed boton-datos-vendedor" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                                    Formulario de Inspección
                                </button>
                                <div class="collapse div-collapse-vendedor-datos" id="collapseExample2">
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿<?php echo $reg['nombre'] ?> es titular del vehículo?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['es_titular'] == "1") {
                                                    echo "Si";
                                                } else if ($reg['es_titular'] == "2") {
                                                    echo "No";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿Tiene un co-titular o figura casado/a en el título?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['co_titular'] == "1") {
                                                    echo "Si";
                                                } else if ($reg['co_titular'] == "2") {
                                                    echo "No";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿Tiene daños estructurales o de seguridad? (choque fuerte, airbags o abs sin funcionar)</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['danios'] == "1") {
                                                    echo "Si";
                                                } else if ($reg['danios'] == "2") {
                                                    echo "No";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>Cuándo el auto está en marcha ¿se prende alguna luz de advertencia en el tablero?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['motor_luz'] == "1") {
                                                    echo "Si";
                                                } else if ($reg['motor_luz'] == "2") {
                                                    echo "No";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿El parabrisas esta rajado o tiene piquete?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['parabrisas_detalle'] == "1") {
                                                    echo "Si";
                                                } else if ($reg['parabrisas_detalle'] == "2") {
                                                    echo "No";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿Cuál es el estado general de la pintura?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['pintura_estado'] == "1") {
                                                    echo "Muy bueno";
                                                } else if ($reg['pintura_estado'] == "2") {
                                                    echo "Excelente";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿Cuál es el estado del tapizado? ¿Está sano o roto?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['tapizado_estado'] == "1") {
                                                    echo "Sano";
                                                } else if ($reg['tapizado_estado'] == "2") {
                                                    echo "Roto";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿Cuál es el estado de limpieza?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['tapizado_limpio'] == "1") {
                                                    echo "Sin manchas";
                                                } else if ($reg['tapizado_limpio'] == "2") {
                                                    echo "Algo manchado";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿El aire acondicionado enfría?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['aire_frio'] == "1") {
                                                    echo "Si";
                                                } else if ($reg['aire_frio'] == "2") {
                                                    echo "No";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿La calefacción calienta?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['aire_caliente'] == "1") {
                                                    echo "Si";
                                                } else if ($reg['aire_caliente'] == "2") {
                                                    echo "No";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿Cuántos kilómetros tienen los neumáticos?</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['km_neumaticos'] == "1") {
                                                    echo "De 0 a 20 mil";
                                                } else if ($reg['km_neumaticos'] == "2") {
                                                    echo "De 20 mil a 40 mil";
                                                } else if ($reg['km_neumaticos'] == "3") {
                                                    echo "Más 40 mil";
                                                } else if ($reg['km_neumaticos'] == "4") {
                                                    echo "No sé";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="div-dropdown-item">
                                            <!-- <img class="img-perfil-location" src="assets/img/perfil_user.png"> -->
                                            <p class="texto-item-desplegable-grande p-nombre-calle"><b>¿Tenés todos los accesorios? (llave comando, segunda llave, rueda de auxilio,ve cruz)</b></p>
                                        </div>
                                        <span class="texto-item-desplegable-chico">
                                            <b>
                                                <?php if ($reg['accesorios'] == "1") {
                                                    echo "Si";
                                                } else if ($reg['accesorios'] == "2") {
                                                    echo "No";
                                                } else {
                                                    echo "Sin especificar";
                                                } ?>
                                            </b>
                                        </span>
                                    </div>
                                    <br> <!-- El BR se agrega para que haya un espacio al final -->
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive div-pr">

                            <table class="table">
                                <tr>
                                    <td class="titulo-vehiculos-similares">
                                        Vehículos similares
                                    </td>
                                </tr>
                                <tr class="tr-vehiculos-similares">
                                    <?php while ($reg_s2 = mysqli_fetch_array($vehiculos_similares)) {
                                        $imagen = explode(' - ', $reg_s2['imagenes']); ?>
                                        <td class="td-dpr-1" style="cursor:pointer">
                                            <div class="detalle-productos-recomendados overflow-hidden">
                                                <div class="fondocontenedor-recomendados" onclick="javascript:window.location.href='detalle-particulares.php?id_unidad=<?php echo $reg_s2['id_unidad'] ?>'">
                                                    <img src="<?php echo ($reg_s2['imagenes'] != '0' ?  $imagen[0] : 'assets/img/producto-sin-imagen.png') ?>" style="object-fit: cover;">
                                                    <span><?php echo $reg_s2['version'] ?></span>
                                                    <span class="span-tdpr"><?php echo $reg_s2['modelo_descri'] . ' - ' . $reg_s2['kilometraje'] . 'KM' ?></span>
                                                    <span class="span-precio-similar"> Consultar $</span>
                                                </div>
                                            </div>
                                        </td>
                                    <?php
                                    }
                                    ?>
                                    <?php

                                    ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
    }

    public function formatear_fecha($fecha)
    {
        $fsn = explode(' ', $fecha);
        $f = explode('-', $fsn['0']);
        $fecha = $f['2'] . "/" . $f['1'] . "/" . $f['0'];
        return $fecha;
    }

    public function printModerarParticulares($unidades)
    {
        // echo "anda";
        ?>

        <script>
            $(document).ready(function() {
                valorInfo = $("#valor-info").val();
                var calculo = (valorInfo - ((valorInfo * 10) / 100));
                // console.log(calculo);
                $("#valor-calculado").val(calculo);
            });

            function valorInfoCalculo(valorInfo) {
                var calculo = (valorInfo - ((valorInfo * 10) / 100));
                // console.log(calculo);
                $("#valor-calculado").val(calculo);
            }
        </script>

        <div class="container mt-3">
            <?php
            if (mysqli_num_rows($unidades) > 0) {
                while ($regModerar = mysqli_fetch_array($unidades)) {
                    if ($regModerar['imagenes'] != '0') {
                        $imagenes = explode(' - ', $regModerar['imagenes']);
            ?>
                        <div class="contenedor-moderar" style="border: 1px solid black; padding: 0.5rem; display: flex; flex-direction: column;">
                            <span>Imágenes de: <?php echo $regModerar['nombre'] . ' ' . $regModerar['apellido'] . ' | ' . 'ID: ' . $regModerar['id_usuario_ec'] ?></span>
                            <div class="imagenes-moderar" style="display: flex; justify-content: space-around; gap:2px;">
                                <?php
                                for ($i = 0; $i < count($imagenes) - 1; $i++) {
                                ?>
                                    <div class="card" style="width:600px;" id="foto_<?php echo $i ?>">
                                        <img src="<?php echo $imagenes[$i] ?>">
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <form action="modelo/uploadModerParticular.php" id="form-moderar" method="POST" class="form-moderar" style="margin-block-start: 1rem;">
                                <div>
                                    <b>Datos del vehículo:</b>
                                    <br>
                                    <span>Año: <?php echo $regModerar['anio'] ?> | </span><br>
                                    <span>Kilometraje: <?php echo $regModerar['kilometraje'] ?> | </span><br>
                                    <span>Versión: <?php echo $regModerar['version'] ?> | </span><br>
                                    <span>Contacto: </span><a href="https://wa.me/<?php echo $regModerar['telefono'] ?>?text=Hola%20<?php echo $regModerar['nombre'] ?>" target="_blank"><?php echo $regModerar['telefono'] ?></a><img src="assets/img/whatsapp.png" style="width: 1.8rem; height: auto;"><br>
                                </div>

                                <div style="display: flex; justify-content: flex-start; margin-block: 1rem; gap: 10px;">
                                    <div>
                                        <label for="valor-info">Valor de info</label>
                                        <input type="number" id="valor-info" name="valor-info" class="form-control" onkeyup="valorInfoCalculo(this.value)">
                                    </div>
                                    <div>
                                        <label for="valor-calculado">Valor -10 de info</label>
                                        <input type="number" id="valor-calculado" name="valor-calculado" class="form-control" readonly>
                                    </div>
                                </div>

                                <div style="display: flex; justify-content: space-around; margin-block: 1rem;">
                                    <div class="form-check">
                                        <input class="form-check-input" onchange="valorChecks('alta')" type="checkbox" value="1" id="dar_alta" name="dar_alta" />
                                        <label class="form-check-label" for="dar_alta">Dar de alta</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" onchange="valorChecks('baja')" type="checkbox" value="2" id="dar_baja" name="dar_baja" />
                                        <label class="form-check-label" for="dar_baja">Dar de baja</label>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: space-around;">
                                    <input type="hidden" name="id_unidad" value="<?php echo $regModerar['id_unidad'] ?>">
                                    <input type="hidden" name="id_usuario_ec" value="<?php echo $regModerar['id_usuario_ec'] ?>">
                                    <button type="submit" class="btn btn-info">Enviar</button>
                                </div>
                            </form>
                        </div>
                        <br>
                <?php
                    }
                }
            } else {
                ?>
                <div style="display: flex; justify-content: space-around; margin-block-start: 3rem;">
                    <h2>No hay unidades para moderar!</h2>
                </div>
            <?php
            }
            ?>
        </div>
        <?php
    }

    // FUNCION PARA AREAS NUEVAS (MOSTRAR "PROXIMAMENTE")

    function printNuevaAreaProximamente($area)
    {
        switch ($area) {
            case 'Productos':
                // echo "El area es Productos";
        ?>
                <div style="padding-block-start: 5.5%; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                    <div style="margin: 20px;">
                        <span style="color: #323230; text-align: center; font-size: 3rem; font-weight: bold;">¡Muy Pronto!</span>
                    </div>
                    <div class="d-flex justify-content-center">
                        <img src="assets/img/productosBanner.png" alt="" style="width: 95%; height: auto; border-radius: 30px;">
                    </div>
                    <div class="mt-3" style="margin: 30px; width: 95%; max-width: 61rem; font-size: 1.3rem; text-align: center; line-height: 1.3rem;">
                        <div style="line-height: 1.6rem;">Aquí podrás encontrar productos al <b>precio de costo</b> gracias a nuestras alianzas comerciales</div><br>
                        <div>Baterías, Herramientas, Neumáticos y más!</div>
                    </div>
                    <div class="row justify-content-center" style="max-width: 82rem; margin-bottom: 2rem;">
                        <div class="col-lg-2 col-md-3 col-sm-6 col-6 d-flex justify-content-center">
                            <img src="assets/img/Willard.png" alt="" class="w-50" style="cursor: pointer;" onclick="javascript:window.open('https://bateriaswillard.com.ar/')">
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-6 d-flex justify-content-center">
                            <img src="assets/img/Dowen_Pagio.png" alt="" class="w-50" style="cursor: pointer;" onclick="javascript:window.open('https://www.dowenpagioweb.com.ar/')">
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-6 d-flex justify-content-center">
                            <img src="assets/img/Kushiro.png" alt="" class="w-50" style="cursor: pointer;" onclick="javascript:window.open('index.php')">
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-6 d-flex justify-content-center">
                            <img src="assets/img/Lusqtoff.png" alt="" class="w-50" style="cursor: pointer;" onclick="javascript:window.open('http://www.lusqtoff.com.ar/')">
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-6 d-flex justify-content-center">
                            <img src="assets/img/Pirelli.png" alt="" class="w-50" style="cursor: pointer;" onclick="javascript:window.open('https://www.pirelli.com/tyres/es-ar/moto/all-tyres/catalog')">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-6 d-flex justify-content-center align-items-center">
                            <img src="assets/img/ROM.png" alt="" class="w-50" style="cursor: pointer;" onclick="javascript:window.open('https://rom.net.ar/')">
                        </div>

                    </div>
                </div>
            <?php
                break;

            case 'Profesionales':
                // echo "El area es Profesionales";
            ?>
                <div style="padding-block-start: 5.5%; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                    <div style="margin: 20px;">
                        <span style="color: #323230; text-align: center; font-size: 3rem; font-weight: bold;">¡Muy Pronto!</span>
                    </div>
                    <div class="d-flex justify-content-center">
                        <img src="assets/img/gestoria.jpg" alt="" style="max-width: 80%; height: auto; border-radius: 30px;">
                    </div>
                    <div class="mt-3" style="margin: 30px; width: 95%; max-width: 61rem; font-size: 1.3rem; text-align: center; line-height: 1.3rem;">
                        <div style="line-height: 1.6rem;">En esta sección se mostrarán profesionales ROM de <b>todo el país</b> para que puedas utilizar de acuerdo a tus necesidades</div><br>
                        <div>Gestores, Escribanos, Contadores, Abogados, entre otros.</div>
                    </div>
                </div>
            <?php
                break;

            case 'Logistica':
                // echo "El area es Logistica";
            ?>
                <div style="padding-block-start: 5.5%; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                    <div style="margin: 20px;">
                        <span style="color: #323230; text-align: center; font-size: 3rem; font-weight: bold;">¡Muy Pronto!</span>
                    </div>
                    <div class="d-flex justify-content-center">
                        <img src="assets/img/logistica.jpg" alt="" style="max-width: 80%; height: auto; border-radius: 30px;">
                    </div>
                    <div class="mt-3" style="margin: 30px; width: 95%; max-width: 61rem; font-size: 1.3rem; text-align: center; line-height: 1.3rem;">
                        <div style="line-height: 1.6rem;">Aquí podrás encontrar servicios de logística pertenecientes a la red ROM de <b>todo el país</b>, para brindarte una mayor agilidad y productividad.</div><br>
                        <!-- <div>Gestores, Escribanos, Contadores, Abogados, entre otros.</div> -->
                    </div>
                </div>
            <?php
                break;

            case 'CentroInspeccion':
                // echo "El area es Centro de Inspeccion";
            ?>
                <div style="padding-block-start: 5.5%; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                    <div style="margin: 20px;">
                        <div style="color: #323230; text-align: center; font-size: 3rem; font-weight: bold;">Centros de Inspección</div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="https://rom.net.ar/centro-de-inspeccion.php?idCategoria=61" target="_blank" style="text-align: center;">
                            <img src="assets/img/centro-de-inspeccion2.png" alt="" style="border-radius: 30px; width: 95%">
                        </a>
                    </div>
                    <div class="mt-3" style="margin: 30px; width: 95%; max-width: 48rem; font-size: 1.3rem; text-align: center; line-height: 1.3rem;">
                        <div style="line-height: 1.6rem;">Aquí podrás encontrar servicios de logística pertenecientes a la red ROM de <b>todo el país</b>, para brindarte una mayor agilidad y productividad.</div><br>
                        <!-- <div>Gestores, Escribanos, Contadores, Abogados, entre otros.</div> -->
                    </div>
                    <div style="text-align: center; margin-block-end: 9%">
                        <div style="font-size: 2rem;">
                            Ped&iacute; más informaci&oacute;n,
                            sumate a la familia <a href="https://rom.net.ar/" target="_blank" style="color: red"><img src="assets/img/ROM.png" alt="" style="width: 10%"></a>
                        </div>
                    </div>
                </div>

            <?php
                break;

            case 'OfertasRayo':
                echo "El area es Ofertas Rayo";
            ?>

            <?php
                break;

            default:
            ?>
                <script>
                    window.location.href = 'index.php';
                </script>
        <?php
                break;
        }
    }

    public function filtroExtendido($marcas, $tipo, $unidades, $migasdepan)
    {
        if ($tipo == '2' || $tipo == '4') {
            $reg_migas = mysqli_fetch_array($migasdepan);
        } else if ($tipo == '3') {
            $reg_migas = $migasdepan[0]->fetch_array();
        }
        ?>

        <script>
            function modelosFiltroExtendido(id_marca) {
                // console.log(id_marca);
                $.ajax({
                    url: 'modelo/selectModelosFiltroExtendido.php',
                    type: 'POST',
                    data: {
                        id: id_marca
                    },
                    success: function(response) {
                        // console.log(response);
                        $('#modelos-div-extendido').html(response);
                    }
                });
            }

            function modal0kminfo(id_cotizacion) {
                // console.log(id_cotizacion);
                $('#modal0kminfo').modal('show');
                $.ajax({
                    type: "POST",
                    url: "modelo/selectModal0kmInfo.php",
                    data: {
                        id: id_cotizacion
                    },
                    success: function(response) {
                        console.log(response);
                        $('#modal0kminfo').html(response);
                    }
                });
            }
        </script>

        <!-- MODAL 0KM -->

        <div class="modal fade" id="modal0kminfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

        <!-- FIN | MODAL 0KM -->

        <div class="container contenedor-filtro-extendido">
            <div class="row">
                <div class="col-12 migas-pan">
                    <?php
                    if ($_GET['modelo'] == 'No') {
                        if ($_GET['marca'] == 'No') {
                            if ($_GET['tipo'] == '2') {
                                echo "USADOS > TODAS LAS MARCAS > TODOS LOS MODELOS";
                            } else if ($_GET['tipo'] == '4') {
                                echo "PARTICULARES > TODAS LAS MARCAS > TODOS LOS MODELOS";
                            } else if ($_GET['tipo'] == '3') {
                                echo "0 KM > TODAS LAS MARCAS > TODOS LOS MODELOS";
                            }
                        } else {
                            if ($_GET['tipo'] == '2') {
                                echo 'USADOS > ' . $reg_migas['marca_descri'] . ' > TODOS LOS MODELOS';
                            } else if ($_GET['tipo'] == '4') {
                                echo 'PARTICULARES > ' . $reg_migas['marca_descri'] . ' > TODOS LOS MODELOS';
                            } else if ($_GET['tipo'] == '3') {
                                echo '0 KM > ' . $reg_migas['marca_descri'] . ' > TODOS LOS MODELOS';
                            }
                        }
                    } else {
                        if ($_GET['tipo'] == '2') {
                            echo 'USADOS > ' . $reg_migas['marca_descri'] . ' > ' . $reg_migas['modelo_descri'];
                        } else if ($_GET['tipo'] == '4') {
                            echo 'PARTICULARES > ' . $reg_migas['marca_descri'] . ' > ' . $reg_migas['modelo_descri'];
                        } else if ($_GET['tipo'] == '3') {
                            echo '0 KM > ' . $reg_migas['marca_descri'] . ' > ' . $reg_migas['modelo_descri'];
                        }
                    }
                    ?>
                </div>
                <div class="col-12 d-md-none controles-filtro-extendido">
                    <button title="Minimizar filtros" class="ocultar-filtro-extendido" data-toggle="collapse" data-target="#formFiltroExtendido" aria-expanded="true" aria-controls="collapseOne">
                        FILTROS
                    </button>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 collapse show form-filtro-extendido" id="formFiltroExtendido" class="collapse show" aria-labelledby="headingOne">
                    <form action="forms/notify.php" method="POST">
                        <div>
                            <select class="select-filtro-extendido" name="marca" id="" onchange="modelosFiltroExtendido(this.value)" required>
                                <option value="">MARCA</option>
                                <option value="No">TODAS</option>
                                <?php
                                while ($reg_marcas = mysqli_fetch_array($marcas)) {
                                ?>
                                    <option value="<?php echo $reg_marcas['id_marcas'] ?>"><?php echo $reg_marcas['marca_descri'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div id="modelos-div-extendido">
                            <select name="modelo" class="select-filtro-extendido" required>
                                <option value="">MODELO</option>
                            </select>
                        </div>
                        <div>
                            <select name="tipo" class="select-filtro-extendido" required>
                                <?php
                                if ($tipo == '2') {
                                ?>
                                    <option value="2" selected>USADOS</option>
                                    <option value="4">PARTICULARES</option>
                                    <option value="3">0 KM</option>
                                <?php
                                } else if ($tipo == '4') {
                                ?>
                                    <option value="2">USADOS</option>
                                    <option value="4" selected>PARTICULARES</option>
                                    <option value="3">0 KM</option>
                                <?php
                                } else if ($tipo == '3') {
                                ?>
                                    <option value="2">USADOS</option>
                                    <option value="4">PARTICULARES</option>
                                    <option value="3" selected>0 KM</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="div-submit-filtro-extendido">
                            <input class="submit-filtro-extendido" type="submit" value="BUSCAR">
                        </div>
                    </form>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9 col-xl-9" style="min-height: 35rem;">
                    <div class="row">
                        <div class="col-12 titulo-tipo">
                            <?php
                            if ($tipo == '2') {
                                echo "<b>Unidades Usadas</b>";
                            } else if ($tipo == '4') {
                                echo "<b>Unidades de Particulares</b>";
                            } else if ($tipo == '3') {
                                echo "<b>Unidades 0 KM</b>";
                            }
                            ?>
                        </div>
                        <?php
                        if ($tipo == '2' || $tipo == '4') {
                            while ($reg_unidad = mysqli_fetch_array($unidades)) {
                        ?>
                                <div class="col-12 col-sm-6 col-md-12 col-lg-6 col-xl-6">
                                    <div class="card card-auto" style="overflow: hidden;">
                                        <?php
                                        if ($tipo == '2') {
                                            $imagenes = unserialize($reg_unidad['urls']);
                                            if ($imagenes[0] != '') {
                                        ?>
                                                <img loading="lazy" class="card-img-to card-auto-img" src="<?php echo $imagenes[0] ?>" onclick="javascript:location.href='detalle-producto.php?id_unidad=<?php echo $reg_unidad['id_unidad'] ?>'">
                                            <?php
                                            } else { ?>
                                                <img loading="lazy" class="card-img-to card-auto-img" src="assets/img/producto-sin-imagen.png" onclick="javascript:location.href='detalle-producto.php?id_unidad=<?php echo $reg_unidad['id_unidad'] ?>'">
                                            <?php
                                            }
                                        } else if ($tipo == '4') {
                                            $imagenes = explode(' - ', $reg_unidad['imagenes']);
                                            if ($imagenes[0] != '0') {
                                            ?>
                                                <div class="ribbon-particulares"><b>-10%</b></div>
                                                <img loading="lazy" class="card-img-to card-auto-img" src="<?php echo $imagenes[0] ?>" onclick="javascript:location.href='detalle-particulares.php?id_unidad=<?php echo $reg_unidad['id_unidad'] ?>'">
                                            <?php
                                            } else {
                                            ?>
                                                <div class="ribbon-particulares"><b>-10%</b></div>
                                                <img loading="lazy" class="card-img-to card-auto-img" src="assets/img/producto-sin-imagen.png" onclick="javascript:location.href='detalle-particulares.php?id_unidad=<?php echo $reg_unidad['id_unidad'] ?>'">
                                            <?php
                                            }
                                        } else if ($tipo == '3') { ?>
                                            <img loading="lazy" class="card-img-to card-auto-img" src="assets/img/producto-sin-imagen.png" onclick="javascript:location.href='detalle-particulares.php?id_unidad=<?php echo $reg_unidad['id_unidad'] ?>'">
                                        <?php
                                        }
                                        ?>
                                        <div class="card-body card-auto-info">
                                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                                <div>
                                                    <b><?php echo $reg_unidad['marca_descri'] . ' - ' . $reg_unidad['modelo_descri'] ?></b>
                                                </div>
                                                <div style="background: #F00353; color: white; padding-block: 0.2rem; border-radius: 1rem; text-align: center; width: 32%;">
                                                    <?php
                                                    if ($tipo == '2') {
                                                    ?>
                                                        $ <?php echo number_format($reg_unidad['valor_publico_pesos'], 0, ',', '.');
                                                        } else if ($tipo == '4') {
                                                            if ($reg_unidad['precio_moderado'] != '' && $reg_unidad['precio_moderado'] != '0') {
                                                            ?>
                                                            $ <?php echo number_format($reg_unidad['precio_moderado'], 0, ',', '.');
                                                            } else {
                                                                echo "$ CONSULTAR";
                                                            }
                                                        } else if ($tipo == '3') {
                                                            if ($reg_unidad['precio'] != '0') {
                                                                ?>
                                                            $ <?php echo number_format($reg_unidad['precio'], 0, ',', '.');
                                                            } else {
                                                                echo "$ CONSULTAR";
                                                            }
                                                        }
                                                                ?>
                                                </div>
                                            </div>
                                            <div style="margin-bottom: 1.2rem; margin-top: 0.2rem; color: #F00353">
                                                <b><?php
                                                    if ($tipo == '3') {
                                                        if ($reg_unidad['localidad'] != '') {
                                                            echo $reg_unidad['provincia'] . ' | ' . $reg_unidad['localidad'];
                                                        } else {
                                                            echo $reg_unidad['provincia'];
                                                        }
                                                    }
                                                    ?>
                                                </b>
                                            </div>
                                            <div>
                                                <div style="margin-bottom: 0.4rem;">
                                                    <?php echo $reg_unidad['version'] ?>
                                                </div>
                                                <div>
                                                    <?php
                                                    if ($tipo == '2' || $tipo == '4') {
                                                        echo $reg_unidad['anio'] ?> - <?php echo $reg_unidad['kilometraje'] ?> KM
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        } else if ($tipo == '3') {
                            while ($reg_unidad = $unidades[0]->fetch_array()) {
                            ?>
                                <div class="col-12 col-sm-6 col-md-12 col-lg-6 col-xl-6">
                                    <div class="card card-auto">
                                        <?php
                                        $modelo_descri = str_replace('/', '-', $reg_unidad['modelo_descri']);
                                        ?>
                                        <div class="card-auto-ilustrativa">imagen meramente ilustrativa</div>
                                        <img Loading="lazy" class="card-img-to card-auto-img" onclick="modal0kminfo(<?php echo $reg_unidad['id_cotizacion'] ?>)" src="uploads/0km_ilustrativas/<?php echo $reg_unidad['marca_descri'] ?>/<?php echo $modelo_descri ?>.jpg">
                                        <div class="card-body card-auto-info">
                                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                                <div>
                                                    <b><?php echo $reg_unidad['marca_descri'] . ' - ' . $reg_unidad['modelo_descri'] ?></b>
                                                </div>
                                                <div style="background: #F00353; color: white; padding-block: 0.2rem; border-radius: 1rem; text-align: center; width: 32%;">
                                                    <?php
                                                    if ($tipo == '2') {
                                                    ?>
                                                        $ <?php echo number_format($reg_unidad['valor_publico_pesos'], 0, ',', '.');
                                                        } else if ($tipo == '4') {
                                                            if ($reg_unidad['precio_moderado'] != '') {
                                                            ?>
                                                            $ <?php echo number_format($reg_unidad['precio_moderado'], 0, ',', '.');
                                                            } else {
                                                                echo "$ CONSULTAR";
                                                            }
                                                        } else if ($tipo == '3') {
                                                            if ($reg_unidad['precio'] != '0') {
                                                                ?>
                                                            $ <?php echo number_format($reg_unidad['precio'], 0, ',', '.');
                                                            } else {
                                                                echo "$ CONSULTAR";
                                                            }
                                                        }
                                                                ?>
                                                </div>
                                            </div>
                                            <div style="margin-bottom: 1.2rem; margin-top: 0.2rem; color: #F00353">
                                                <b><?php
                                                    if ($tipo == '3') {
                                                        if ($reg_unidad['localidad'] != '') {
                                                            echo $reg_unidad['provincia'] . ' | ' . $reg_unidad['localidad'];
                                                        } else {
                                                            echo $reg_unidad['provincia'];
                                                        }
                                                    }
                                                    ?>
                                                </b>
                                            </div>
                                            <div>
                                                <div style="margin-bottom: 0.4rem;">
                                                    <?php echo $reg_unidad['version'] ?>
                                                </div>
                                                <div>
                                                    <?php
                                                    if ($tipo == '2' || $tipo == '4') {
                                                        echo $reg_unidad['anio'] ?> - <?php echo $reg_unidad['kilometraje'] ?> KM
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            while ($reg_unidad = $unidades[1]->fetch_array()) {
                            ?>
                                <div class="col-12 col-sm-6 col-md-12 col-lg-6 col-xl-6">
                                    <div class="card card-auto">
                                        <?php
                                        $modelo_descri = str_replace('/', '-', $reg_unidad['modelo_descri']);
                                        ?>
                                        <div class="card-auto-ilustrativa">imagen meramente ilustrativa</div>
                                        <img loading="lazy" class="card-img-to card-auto-img" onclick="modal0kminfo(<?php echo $reg_unidad['id_cotizacion'] ?>)" src="uploads/0km_ilustrativas/<?php echo $reg_unidad['marca_descri'] ?>/<?php echo $modelo_descri ?>.jpg">
                                        <div class="card-body card-auto-info">
                                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                                <div>
                                                    <b><?php echo $reg_unidad['marca_descri'] . ' - ' . $reg_unidad['modelo_descri'] ?></b>
                                                </div>
                                                <div style="background: #F00353; color: white; padding-block: 0.2rem; border-radius: 1rem; text-align: center; width: 32%;">
                                                    <?php
                                                    if ($tipo == '2') {
                                                    ?>
                                                        $ <?php echo number_format($reg_unidad['valor_publico_pesos'], 0, ',', '.');
                                                        } else if ($tipo == '4') {
                                                            if ($reg_unidad['precio_moderado'] != '') {
                                                            ?>
                                                            $ <?php echo number_format($reg_unidad['precio_moderado'], 0, ',', '.');
                                                            } else {
                                                                echo "$ CONSULTAR";
                                                            }
                                                        } else if ($tipo == '3') {
                                                            if ($reg_unidad['precio'] != '0') {
                                                                ?>
                                                            $ <?php echo number_format($reg_unidad['precio'], 0, ',', '.');
                                                            } else {
                                                                echo "$ CONSULTAR";
                                                            }
                                                        }
                                                                ?>
                                                </div>
                                            </div>
                                            <div style="margin-bottom: 1.2rem; margin-top: 0.2rem; color: #F00353">
                                                <b><?php
                                                    if ($tipo == '3') {
                                                        if ($reg_unidad['localidad'] != '') {
                                                            echo $reg_unidad['provincia'] . ' | ' . $reg_unidad['localidad'];
                                                        } else {
                                                            echo $reg_unidad['provincia'];
                                                        }
                                                    }
                                                    ?>
                                                </b>
                                            </div>
                                            <div>
                                                <div style="margin-bottom: 0.4rem;">
                                                    <?php echo $reg_unidad['version'] ?>
                                                </div>
                                                <div>
                                                    <?php
                                                    if ($tipo == '2' || $tipo == '4') {
                                                        echo $reg_unidad['anio'] ?> - <?php echo $reg_unidad['kilometraje'] ?> KM
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function unidad_compartida($tipo, $unidad)
    {
        if (mysqli_num_rows($unidad) > 0) {
            $reg_unidad = mysqli_fetch_array($unidad);
        ?>
            <div class="container contenedor-detalle-unidad">
                <div class="detalle-unidad">
                    <?php
                    if ($tipo == '3') {
                    ?>
                        <div class="detalle-unidad-logo">
                            <img src="assets/img/comauto-logo.svg" alt="" class="unidad-detalle-logo-img" onclick="javascript:window.open('https://comunidauto.net.ar/')">
                        </div>
                        <div style="margin-bottom: 1rem; display: flex; justify-content: center; align-items: center;">
                            <div style="font-size: 20px;">
                                Datos del vehículo
                            </div>
                        </div>
                        <table class="table table-bordered table-hover tabla-info0km">
                            <tr style="background: grey; color: white;">
                                <td>
                                    <b>Proveniencia:</b>
                                </td>
                                <td class="td-tabla-info0km">
                                    0 KM
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Marca:</b>
                                </td>
                                <td class="td-tabla-info0km">
                                    <?php echo $reg_unidad['marca_descri'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Modelo:</b>
                                </td>
                                <td class="td-tabla-info0km">
                                    <?php echo $reg_unidad['modelo_descri'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Versión:</b>
                                </td>
                                <td class="td-tabla-info0km">
                                    <?php echo $reg_unidad['version'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Colores:</b>
                                </td>
                                <td class="td-tabla-info0km">
                                    <?php if ($reg_unidad['color'] != '') {
                                        echo $reg_unidad['color'];
                                    } else {
                                        echo "A CONSULTAR";
                                    } ?>
                                </td>
                            </tr>
                            <tr style="background: #56e481;">
                                <td>
                                    <b>Precio:</b>
                                </td>
                                <td>
                                    <?php if ($reg_unidad['precio'] > 0) {
                                        echo '<b>$</b>' . number_format($reg_unidad['precio'], 0, ',', '.');
                                    } else {
                                        echo "A CONSULTAR";
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Flete y formularios:</b>
                                </td>
                                <td class="td-tabla-info0km">
                                    <?php if ($reg_unidad['gastos'] > 0) {
                                        echo '<b>$</b>' . number_format($reg_unidad['gastos'], 0, ',', '.');
                                    } else {
                                        echo "A CONSULTAR";
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Disponibilidad:</b>
                                </td>
                                <td class="td-tabla-info0km">
                                    <?php echo $reg_unidad['disponibilidad']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Fecha de cotización:</b>
                                </td>
                                <td>
                                    <?php echo $reg_unidad['fecha']; ?>
                                </td>
                            </tr>
                        </table>
                        <div style="margin-bottom: 1rem; text-align: center; font-size: 20px;">
                            Datos de la agencia
                        </div>
                        <table class="table table-bordered table-hover tabla-info0km">
                            <tr>
                                <td>
                                    <b>Nombre:</b>
                                </td>
                                <td style="color: #F00353;" class="td-tabla-info0km">
                                    <b><?php echo $reg_unidad['nombre'] ?></b>
                                </td>
                            </tr>
                            <tr style="background: #F00353; color: white;">
                                <td>
                                    <b>Teléfono:</b>
                                </td>
                                <td>
                                    <?php
                                    if (strpos($reg_unidad['telefono'], '+54') === true) {
                                    ?>
                                        <a href="tel: + <?php echo $reg_unidad['telefono'] ?>" title="Llamar a este número">
                                            <img src="assets/img/phone-1.svg" alt="Whatsapp" srcset="" style="width:21px;">
                                            <?php echo $reg_unidad['telefono'] ?>
                                        </a>
                                        <a href="https://api.whatsapp.com/send/?phone=<?php echo $reg_unidad['telefono'] ?>?&text=Vi%20tu%20auto%20en%20*Comunidauto*!%20Me%20interesa%20saber%20más." class="mx-2" target="_blank">
                                            <img src="assets/img/whatsapp.svg" alt="Whatsapp" title="Enviar un Whatsapp" srcset="" style="width:21px;">
                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="tel: + <?php echo $reg_unidad['telefono'] ?>" title="Llamar a este número">
                                            <img src="assets/img/phone-1.svg" alt="Whatsapp" srcset="" style="width:21px;">
                                            <?php echo $reg_unidad['telefono'] ?>
                                        </a>
                                        <a href="https://api.whatsapp.com/send/?phone=+54<?php echo $reg_unidad['telefono'] ?>?&text=Vi%20tu%20auto%20en%20*Comunidauto*:%20AcaVaElLinkDetalleProductoSinCuenta%20Me%20interesa%20saber%20más." class="mx-2" target="_blank">
                                            <img src="assets/img/whatsapp.svg" alt="Whatsapp" title="Enviar un Whatsapp" srcset="" style="width:21px;">
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Ubicación:</b>
                                </td>
                                <td class="td-tabla-info0km">
                                    <?php
                                    if ($reg_unidad['localidad'] != '') {
                                        echo $reg_unidad['provincia'] . ' | ' . $reg_unidad['localidad'];
                                    } else {
                                        echo $reg_unidad['provincia'];
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Dirección:</b>
                                </td>
                                <td>
                                    <?php echo $reg_unidad['direccion'] ?>
                                </td>
                            </tr>
                        </table>
                    <?php
                    }
                    ?>
                </div>
            </div>

        <?php
        } else {
        ?>
            <script>
                window.location.href = 'index.php'
            </script>
        <?php
        }
    }

    public function printLoginFormUnidadCompartida()
    {
        ?>
        <div class="container contenedor-detalle-unidad">
            <div class="detalle-unidad">
                <div class="detalle-unidad-logo">
                    <img src="assets/img/comauto-logo.svg" alt="" class="unidad-detalle-logo-img" onclick="javascript:window.open('https://comunidauto.net.ar/')">
                </div>
                <div style="text-align: center; margin-block: 1rem;">
                    <h2>Accede a tu cuenta</h2>
                </div>
                <form method="post" role="form" class="php-login-form detalle-unidad-form">
                    <div class="form-group contact-form ">
                        <input type="text" name="nombre" class="form-control" id="usuario" placeholder="Usuario" required />
                        <div class="validate"></div>
                    </div>
                    <div class="form-group contact-form">
                        <input type="password" class="form-control" name="clave" id="clave" placeholder="Clave" required />
                        <div class="validate"></div>
                    </div>
                    <div class="mb-3">
                        <div class="error-message"></div>
                    </div>
                    <div class="text-center">
                        <button onclick="ingresar()" class="btn-ingresar-modal" type="submit">INGRESAR</button>
                    </div>
                </form>
                <div style="text-align: center; margin-block: 1rem;">
                    Para ver la unidad compartida, debes tener usuario en Comunidauto. <br><br>
                    Es posible que tengas que registrarte, comunicate con nuestro soporte técnico haciendo click en el enlace de abajo.
                </div>
                <div style="text-align: center; margin-block: 1rem; color:#F00353">
                    <a href="https://rom.net.ar/comunidauto.php?idCategoria=56" target="_blank">¡Obtené tu cuenta aquí!</a>
                </div>
            </div>
        </div>

        <script>
            function ingresar() {

                $.ajax({
                    data: {
                        usuario: $('#usuario').val(),
                        clave: $('#clave').val(),
                    },
                    type: "POST",
                    url: 'login.php',
                    timeout: 40000
                }).done(function(msg) {
                    location.reload();
                    // location.href = 'index.php';
                }).fail(function(msg) {
                    alert(
                        'error en la conexion con el servidor, por favor intente nuevamente en unos segundos')
                })
                event.preventDefault();
            }
        </script>

    <?php
    }

    public function printSocialMedia($ultimos_ingresos){
    ?>

        <section id="social_media">
            <div class="row">
                <?php
                $i = 0;
                while ($reg = mysqli_fetch_array($ultimos_ingresos)) {

                    switch ($reg['tipo']) {
                        case 'Agencia':
                            $imagen = unserialize($reg['imagenes']);
                            $imagen = $imagen[0];
                            $redirect = 'detalle-producto.php?id_unidad=' . $reg['id'];
                            break;
                        case 'Particular':
                            $imagen = explode(' - ', $reg['imagenes']);
                            $imagen = $imagen[0];
                            $redirect = 'detalle-particulares.php?id_unidad=' . $reg['id'];
                            break;
                        default:
                            $imagen = 'assets/img/producto-sin-imagen.png';
                            break;
                    }

                    // print_r($imagen);

                ?>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-12">
                        <div class="container pt-5 m-auto padding-social-media">
                            <!-- <div class="row "> -->
                            <!-- <div class="col-md-6 col-lg-4 pb-3">

                                 Copy the content below until next comment
                                <div class="card card-custom bg-white border-white border-0">
                                    <div class="card-custom-img" style="background-image: url(http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg);"></div>
                                    <div class="card-custom-avatar">
                                        <img class="img-fluid" src="http://res.cloudinary.com/d3/image/upload/c_pad,g_center,h_200,q_auto:eco,w_200/bootstrap-logo_u3c8dx.jpg" alt="Avatar" />
                                    </div>
                                    <div class="card-body" style="overflow-y: auto">
                                        <h4 class="card-title">Card title</h4>
                                        <p class="card-text">Card has minimum height set but will expand if more space is needed for card body content. You can use Bootstrap <a href="https://getbootstrap.com/docs/4.0/components/card/#card-decks" target="_blank">card-decks</a> to align multiple cards nicely in a row.</p>
                                    </div>
                                    <div class="card-footer" style="background: inherit; border-color: inherit;">
                                        <a href="#" class="btn btn-primary">Option</a>
                                        <a href="#" class="btn btn-outline-primary">Other option</a>
                                    </div>
                                </div>


                            </div> -->
                            <!-- <div class="col-md-6 col-lg-4 pb-3"> -->

                            <!-- Add a style="height: XYZpx" to div.card to limit the card height and display scrollbar instead -->
                            <div class="card card-custom bg-white border-white border-0 mb-5">
                                <div class="card-custom-img">
                                    <a class="h-100" href="<?php echo $redirect ?>"><img loading="lazy" src="<?php echo $imagen ?>" class="w-100" style="height: inherit;position: relative; object-fit: cover;"></a>
                                </div>
                                <div class="card-custom-avatar">
                                    <!-- <img class="img-fluid" src="http://res.cloudinary.com/d3/image/upload/c_pad,g_center,h_200,q_auto:eco,w_200/bootstrap-logo_u3c8dx.jpg" alt="Avatar" /> -->
                                    <!-- <span class="span-fluid">
                                        agencia
                                    </span> -->
                                </div>
                                <div class="card-body" style="overflow-y: auto">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="h4 mt-1 ml-1 mr-1"><?php echo $reg['marca_descri'] . ' - ' . $reg['version'] ?></h4>
                                        <div>
                                            <span><?php echo $reg['tipo'] ?></span>
                                            <h5 class="h4 mt-1 ml-1 mr-1"><?php echo $reg['nombre'] ?></h5>
                                        </div>
                                    </div>

                                    <a style="color: blue" data-toggle="collapse" href="#ver_mas_<?php echo $i ?>" role="" aria-expanded="false" aria-controls="ver_mas_<?php echo $i ?>">
                                        Ver Descripci&oacute;n
                                    </a>
                                    <div class="collapse mt-1" id="ver_mas_<?php echo $i ?>" style="border-block: 1px solid;">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 card-body d-flex flex-column justify-content-around">
                                                <span class="card-text"><strong>ID UNIDAD:</strong> <?php echo $reg['id'] ?></span> <br>
                                                <span class="card-text"><strong>VALOR <?php echo ($reg['modenda'] == 0 ? 'PESOS' : 'USD') ?>:</strong> <?php echo $reg['precio'] ?></span> <br>
                                                <span class="card-text"><strong>ANIO:</strong> <?php echo $reg['anio'] ?></span> <br>
                                                <span class="card-text"><strong>KILOMETRAJE:</strong> <?php echo $reg['kilometraje'] ?></span> <br>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 card-body d-flex flex-column justify-content-around">
                                                <span class="card-text"><strong>CONTACTO:</strong> <?php echo $reg['telefono'] ?></span> <br>
                                                <span class="card-text"><strong>COLOR:</strong> <?php echo $reg['color'] ?></span> <br>
                                                <span class="card-text"><strong>COMBUSTIBLE</strong> <?php echo $reg['combustible'] ?></span> <br>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="card-footer" style="background: inherit; border-color: inherit;">
                                    <!-- <a href="#" class="btn btn-primary"></a> -->
                                    <a href="<?php echo $redirect ?>" class="btn btn-outline-primary">Ver Publicaci&oacute;n</a>

                                </div>
                            </div>

                            <!-- </div> -->
                            <!-- <div class="col-md-6 col-lg-4 pb-3">

                                <div class="card card-custom bg-white border-white border-0">
                                    <div class="card-body">
                                        <img src="http://res.cloudinary.com/d3/image/upload/c_scale,h_450,q_auto:best/color-cards_lorvwg.jpg" alt="Colored cards" class="img-fluid">
                                        <p>You can use this card together with standard Bootstrap 4 cards and use card features on it.</p>
                                        <p class="h5 text-center pt-3">See the card on GitHub:</p>
                                        <p class="h1 text-center"><a href="https://github.com/peterdanis/custom-bootstrap-cards" target="_blank"><i class="fa fa-github"></i></a></p>

                                    </div>
                                </div>

                            </div> -->
                            <!-- </div> -->
                        </div>
                    </div>
                <?php
                    $i++;
                }
                ?>
            </div>
        </section>

    <?php
    }

    public function printHistorial($historial_datos){
        $modelo = new Modelo();

        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        ?>

        <script>
            function rotarIcon() {
                if ($("#config-historial").hasClass('show')) {
                    $(".config-historial-button").css('transform', 'rotate(0deg)');
                } else {
                    $(".config-historial-button").css('transform', 'rotate(-180deg)');
                }
            }

            function vaciarHistorial(id_usuario) {
                if ($('.aun_no_viste_unidades').text() != '') {
                    let timerInterval
                    Swal.fire({
                        title: 'No hay Unidades para Vaciar!',
                        // html: 'I will close in <b></b> milliseconds.',
                        timer: 1500,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            // console.log('I was closed by the timer')
                        }
                    })
                } else {
                    Swal.fire({
                        title: '¿Está seguro de vaciar su historial?',
                        text: "Esta acción no se puede revertir",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '¡Estoy seguro!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "modelo/vaciar_historial.php",
                                data: {
                                    id_usuario: id_usuario
                                },
                                success: function(response) {
                                    // console.log(response);
                                    Swal.fire(
                                        '¡Listo!',
                                        'Su historial ha sido vaciado',
                                        'success'
                                    )
                                    location.reload();
                                }
                            });
                        }
                    })
                }
            }
        </script>

        <div class="container conteiner-historial">

            <div class="row">
                <div class="col-12 conteiner-header-historial">
                    <div class="header-historial">
                        <div class="titulo-historial"><b>Historial</b></div>
                        <button title="Configuración" class="config-historial-button" onclick="rotarIcon()" data-toggle="collapse" data-target="#config-historial" aria-expanded="true" aria-controls="collapseOne">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                            </svg>
                        </button>
                    </div>
                    <div class="config-historial collapse" id="config-historial" aria-labelledby="headingOne">
                        <br>
                        <button style="padding: 0.5rem; border: none; border-radius: 4px; color: #f00353" onclick="vaciarHistorial('<?php echo $_SESSION['id_user'] ?>')">Borrar historial</button>
                        <!-- <button style="padding: 0.5rem; border: none; border-radius: 4px; color: #f00353">Ayuda</button> -->
                        <br><br>
                    </div>
                </div>
            </div>

            <?php
            while ($reg_dato = mysqli_fetch_array($historial_datos)) {
                $historial = $modelo->selectHistorial($_SESSION['id_user'], $reg_dato['Mes'], $reg_dato['Fecha']);
                // echo $historial;
            ?>
                <div class="row mb-4 fila-historial">
                    <div class="col-12 fila-historial-fecha row">
                        <?php
                        $fecha_reg_mes = date("m", strtotime($reg_dato['Fecha']));
                        $fecha_reg_anio = date("Y", strtotime($reg_dato['Fecha']));
                        // echo $fecha_registro;
                        for ($i = 0; $i < count($meses); $i++) {
                            if ($fecha_reg_mes == $i + 1) {
                        ?>
                                <div class="d-flex">
                                    <span style="color: #f00353"> <?php echo $meses[$i] ?>&nbsp;</span><span>/&nbsp;<?php echo $fecha_reg_anio ?></span>
                                </div>

                                <div class="linea-divisora-historial"></div>

                        <?php
                            }
                        }
                        ?>
                    </div>
                    <?php
                    while ($reg_historial = mysqli_fetch_array($historial)) {
                    ?>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                            <div class="card card-historial" style="overflow: hidden;">
                                <?php
                                if ($reg_historial['tipo'] == 'stock') {
                                    $imagenes = unserialize($reg_historial['imagenes']);
                                    if ($imagenes[0] != '') {
                                        date("m", strtotime($reg_historial['historial_fecha']));
                                        if (date("Y-m-d", strtotime($reg_historial['historial_fecha'])) == date("Y-m-d")) {
                                ?>
                                            <div class="historial-visto-hoy">
                                                Visto hoy
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <img loading="lazy" class="card-img-to card-historial-img" src="<?php echo $imagenes[0] ?>" onclick="javascript:location.href='detalle-producto.php?id_unidad=<?php echo $reg_historial['id'] ?>'">
                                        <?php
                                    } else {
                                        date("m", strtotime($reg_historial['historial_fecha']));
                                        if (date("Y-m-d", strtotime($reg_historial['historial_fecha'])) == date("Y-m-d")) {
                                        ?>
                                            <div class="historial-visto-hoy">
                                                Visto hoy
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <img loading="lazy" class="card-img-to card-historial-img" src="assets/img/producto-sin-imagen.png" onclick="javascript:location.href='detalle-producto.php?id_unidad=<?php echo $reg_historial['id'] ?>'">
                                        <?php
                                    }
                                } else if ($reg_historial['tipo'] == 'particular') {
                                    $imagenes = explode(' - ', $reg_historial['imagenes']);
                                    if ($imagenes[0] != '') {
                                        date("m", strtotime($reg_historial['historial_fecha']));
                                        if (date("Y-m-d", strtotime($reg_historial['historial_fecha'])) == date("Y-m-d")) {
                                        ?>
                                            <div class="historial-visto-hoy">
                                                Visto hoy
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="ribbon-particulares"><b>-10%</b></div>
                                        <img loading="lazy" class="card-img-to card-historial-img" src="<?php echo $imagenes[0] ?>" onclick="javascript:location.href='detalle-particulares.php?id_unidad=<?php echo $reg_historial['id'] ?>'">
                                        <?php
                                    } else {
                                        date("m", strtotime($reg_historial['historial_fecha']));
                                        if (date("Y-m-d", strtotime($reg_historial['historial_fecha'])) == date("Y-m-d")) {
                                        ?>
                                            <div class="historial-visto-hoy">
                                                Visto hoy
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="ribbon-particulares"><b>-10%</b></div>
                                        <img loading="lazy" class="card-img-to card-historial-img" src="assets/img/producto-sin-imagen.png" onclick="javascript:location.href='detalle-particulares.php?id_unidad=<?php echo $reg_historial['id'] ?>'">
                                <?php
                                    }
                                }
                                ?>
                                <div class="card-body" style="width: 100%; background: white;">
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <div>
                                            <b><?php echo $reg_historial['marca_descri'] . ' - ' . $reg_historial['modelo_descri'] ?></b>
                                        </div>
                                        <div style="background: #F00353; color: white; padding-block: 0.2rem; border-radius: 1rem; text-align: center; width: 32%;">
                                            <?php
                                            if ($reg_historial['tipo'] == 'stock') {
                                            ?>
                                                $ <?php echo number_format($reg_historial['precio'], 0, ',', '.');
                                                } else if ($reg_historial['tipo'] == 'particular') {
                                                    if ($reg_historial['precio'] == 'Consultar') {
                                                        echo 'Consultar';
                                                    } else {
                                                        echo '$ ' . number_format($reg_historial['precio'], 0, ',', '.');
                                                    }
                                                }
                                                    ?>
                                        </div>
                                    </div>
                                    <div>
                                        <div style="margin-bottom: 0.4rem;">
                                            <?php echo $reg_historial['version'] ?>
                                        </div>
                                        <div>
                                            <?php echo $reg_historial['anio'] ?> - <?php echo $reg_historial['kilometraje'] ?> KM
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            <?php
            }
            if (mysqli_num_rows($historial_datos) == 0) {
            ?>
                <div class="linea-divisora-historial"></div>
                <div class="w-100 text-center mt-2 aun_no_viste_unidades">A&uacute;n no has visto unidades.</div>
            <?php
            }
            ?>
        </div>
    <?php
    }

    public function printIniciarSesion(){
        ?>
        <script>
            function ingresar(form) {

                if (form == 'm'){
                    $.ajax({
                    data: {
                        usuario: $('#usuario').val(),
                        clave: $('#clave').val(),
                    },
                    type: "POST",
                    url: 'login.php',
                    timeout: 40000
                    }).done(function(msg) {
                        // location.reload();
                        location.href = 'index.php';
                    }).fail(function(msg) {
                        alert(
                            'error en la conexion con el servidor, por favor intente nuevamente en unos segundos')
                    })
                    event.preventDefault();
                }
                
                if (form == 'd'){
                    $.ajax({
                    data: {
                        usuario: $('#usuarioD').val(),
                        clave: $('#claveD').val(),
                    },
                    type: "POST",
                    url: 'login.php',
                    timeout: 40000
                    }).done(function(msg) {
                        // location.reload();
                        location.href = 'index.php';
                    }).fail(function(msg) {
                        alert(
                            'error en la conexion con el servidor, por favor intente nuevamente en unos segundos')
                    })
                    event.preventDefault();
                }

                
            }
        </script>

        <!-- MODAL RECUPERAR CUENTA -->

        <div class="modal fade" id="modal-recuperar-cuenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="modelo/recuperar_cuenta_mail.php" method="POST" style="display: flex; flex-direction: column; text-align: center; justify-content: space-around; font-size: 18px; gap: 2rem;">
                            <div>
                                Para recuperar su cuenta necesitamos la siguiente información:
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="nombre" placeholder="*Nombre" style="text-align: center; width: 95%; padding-block: 0.5rem; border: solid 1px #959595; border-radius: 2rem; padding-inline: 1rem; margin-bottom: 1rem;" required>
                                    <input type="text" name="apellido" placeholder="*Apellido" style="text-align: center; width: 95%; padding-block: 0.5rem; border: solid 1px #959595; border-radius: 2rem; padding-inline: 1rem; margin-bottom: 1rem;" required>
                                    <input type="text" name="email" placeholder="*Email" style="text-align: center; width: 95%; padding-block: 0.5rem; border: solid 1px #959595; border-radius: 2rem; padding-inline: 1rem; margin-bottom: 1rem;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="telefono" placeholder="*Teléfono" style="text-align: center; width: 95%; padding-block: 0.5rem; border: solid 1px #959595; border-radius: 2rem; padding-inline: 1rem; margin-bottom: 1rem;" required>
                                    <input type="text" name="cuit" placeholder="*CUIT de su agencia" style="text-align: center; width: 95%; padding-block: 0.5rem; border: solid 1px #959595; border-radius: 2rem; padding-inline: 1rem; margin-bottom: 1rem;" required>
                                    <button type="submit" style="width: 95%; background: #f00353; color: white; padding-block: 0.7rem; padding-inline: 2rem; border: solid 1px #f00353; border-radius: 2rem;">
                                        Enviar
                                    </button>
                                </div>
                            </div>
                            <div>
                                A la brevedad se contactará con usted nuestro personal de soporte para restablecer su cuenta.
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

        <!-- FIN | MODAL RECUPERAR CUENTA -->

        <div class="iniciar-sesion-mobile">
            <div class="container" style="background: #F00353; height: 14rem; padding-inline: 10%; padding-bottom: 1rem; display: flex; justify-content: space-between; flex-direction: column; padding-top: 5rem;">
                <div style="color: white; font-size: 35px; font-weight: 600;">
                    Bienvenido
                </div>
                <div style="text-align: center; color: white; font-size: 14px;">
                    Inicia sesión para continuar
                </div>
            </div>
            <div class="container mt-2 mb-2" style="padding-inline: 10%; padding-block: 2rem;">
                <div class="row justify-content-center">
                    <div class="col-12" style="height: 14rem; display: flex; flex-direction: column; justify-content: space-between; max-width: 25rem;">
                        <form id="form-mobile"  style="display: flex; flex-direction: column; gap: 1rem;">
                            <input type="text" id="usuario" placeholder="Usuario" style="padding-block: 0.5rem; border: solid 1px #959595; border-radius: 1.2rem; padding-inline: 1rem;">
                            <input type="password" id="clave" placeholder="Contraseña" style="padding-block: 0.5rem; border: solid 1px #959595; border-radius: 1.2rem; padding-inline: 1rem;">
                        </form>
                        <div style="display: flex; justify-content: space-between; flex-direction: column; height: 4rem;">
                            <button type="submit" onclick="ingresar('m')" style="padding-block: 0.8rem; border: none; border-radius: 2rem; padding-inline: 1rem; background: #f00353; color: white;">
                                INGRESAR
                            </button>
                            <div style="display: flex; justify-content: center; padding-inline: 1rem;">
                                <a href="#" data-toggle="modal" data-target="#modal-recuperar-cuenta" style="color: #999">Olvidé mi contraseña</a>
                                <!-- <a href="planes.php" style="color: #999">Crear cuenta</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="iniciar-sesion-desktop">
            <div class="container" style="padding-inline: 10%; padding-block: 5%; max-width: 80rem;">
                <div class="row" style="justify-content: space-around;">
                    <div class="col-5">
                        <div style="color: #f00353; font-size: 44px; font-weight: 600; padding-block: 14%;">
                            Bienvenido
                        </div>
                        <form id="form-desktop" style="display: flex; flex-direction: column; justify-content: space-between; height: 16rem; color: #777;">
                            <div>
                                <input type="text" id="usuarioD" placeholder="Usuario" class="iniciar-sesion-input">
                                <input type="password" id="claveD" placeholder="Contraseña" class="iniciar-sesion-input">
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                <button type="submit" onclick="ingresar('d')" class="iniciar-sesion-btn-confirmar">INGRESAR</button>
                                <p style="text-align: center; padding-right: 5%;"><a href="#" data-toggle="modal" data-target="#modal-recuperar-cuenta">¿Olvidaste tu contraseña?</a></p>
                                <!-- <p>¿No estas registrado? <a href="planes.php" style="color: #F00353; font-weight: 800;">Crea una cuenta</a></p> -->
                            </div>
                        </form>
                    </div>
                    <div class="col-6 iniciar-sesion-banner">
                        Accedé a la comunidad de agencias más grande del país.
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}

?>