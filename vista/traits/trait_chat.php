<?php

/**
 * 
 */
trait trait_chat
{

    public function printChat($resultado)
    {
        // $total_audios = mysqli_num_rows($audios_nro);

?>

        <!-- start chat code -->
        <script>
            $(document).ready(function() {
                // $('#flecha_volver').css('display', 'none');
                $('#mensaje').css('display', 'none');
                $('#btn-enviar').css('display', 'none');
                // $('#btn-zumbido').css('display', 'none');
            });
        </script>
        <script type="text/javascript">
            $(function() {



                chat_init();



                $("#btn-enviar").click(function() {



                    if ($("#mensaje").val().length > 0) {



                        // $.ajax({

                        //         type: 'POST',

                        //         url: "chat_ajax/mensaje_nuevo.php",

                        //         data: {

                        //             nombre: $("#nombre").val(),

                        //             mensaje: $("#mensaje").val()

                        //         }

                        //     })

                        //     .done(function(html) {

                        //         $("#mensaje").val("");

                        //         //$( "#chat" ).html(html);

                        //     });



                    }



                });



                $("#btn-historial").click(function() {



                    $.ajax({

                        type: 'POST',

                        url: "chat_ajax/chat_historial.php",
                        success: function(html) {
                            $("#chat").html(html);
                        }

                    })




                });



                $("#btn-limpiar").click(function() {

                    $.ajax({

                        type: 'POST',

                        url: "chat_ajax/eliminar_historial.php",
                        success: function(html) {
                            $("#chat").html("");
                        }

                    })
                });



                $("#cerrar-chat").click(function() {

                    $("#contenedor-chat").toggle()

                    $("#abrir-chat").toggle()

                })

                $("#abrir-chat").click(function() {

                    $("#contenedor-chat").toggle()

                    $("#abrir-chat").toggle()

                })

                // .done(function(html) {

                //     if (html != "") {



                //     }

                //     $("#chat").prepend(html);

                // });

                // }



                function chat_init() {

                    $.ajax({

                        type: 'POST',

                        url: "chat_ajax/chat_init.php",
                        success: function(html) {
                            $("#chat").html(html);
                        }
                    })
                }

            })

            function init_update() {
                if ($('#titulo_chats').text() != '') {
                    chat_init_arrow();
                }
            }

            function chat_update() {

                if ($('#id_chat').val() > 0) {
                    $.ajax({
                        type: 'POST',
                        url: "chat_ajax/chat_update.php",
                        data: {
                            id_chat: $("#id_chat").val(),
                            nombre: $('#chat_nombre').val(),
                            total_zumbidos: $("#total_zumbidos").val()
                        },
                        success: function(data) {

                            $("#chat").html(data);
                            if ($("#id_chat").val() == '') {
                                chat_init();
                            }
                        }

                    })
                }
            }


            setInterval(function() {


                chat_update();


            }, 3000);

            setInterval(function() {

                init_update();

            }, 3000);



            function chat_init_arrow() {

                $.ajax({

                    type: 'POST',

                    url: "chat_ajax/chat_init.php",
                    success: function(response) {
                        $('#mensaje').css('display', 'none');
                        $('#btn-enviar').css('display', 'none');
                        $('#btn-zumbido').css('display', 'none');
                        $('#nuevo_chat').css('display', 'inherit');
                        $('#id_chat').val('');
                        $("#chat").html(response);
                    }

                })


            }

            function nuevo_mensaje() {
                $.ajax({

                    type: 'POST',

                    url: "chat_ajax/mensaje_nuevo.php",

                    data: {

                        nombre: $("#nombre_chat").val(),

                        id_chat: $("#id_chat").val(),

                        mensaje: $("#mensaje").val()

                    },
                    success: function(response) {
                        chat_update();
                        document.querySelector('#sonido').play();
                        // console.log(response)
                        $("#mensaje").val('');
                    }

                })
            }

            function eliminar_mensaje(id) {
                $.ajax({
                    type: "POST",
                    url: "chat_ajax/eliminar_mensaje.php",
                    data: {
                        id_mensaje: id
                    },
                    success: function(response) {
                        chat_update();
                    }
                });
            }

            function insertar_chat(nombre, participante) {
                $.ajax({
                    type: "POST",
                    url: "chat_ajax/insertar_chat.php",
                    data: {
                        nombre_chat: nombre,
                        participante: participante,
                    },
                    success: function(response) {
                        chat_init_arrow();
                    }
                });
            }

            function zumbido() {
                $.ajax({
                    type: "POST",
                    url: "chat_ajax/zumbido.php",
                    data: {
                        chat: $("#id_chat").val()
                    },
                    success: function(response) {}
                });
            }

            function zumbido_efecto() {
                // $('.container-xl').hide();
                // $('.container-xl').show();
                // $('body').css('filter', 'blur(6px)');

                // setTimeout(function() {
                //     $('body').css('filter', 'blur(0px)');
                // }, 2000);

            }

            setInterval(function() {

                $.ajax({
                    type: "POST",
                    url: "chat_ajax/msj_globales.php",
                    success: function(response) {
                        $('#msj_sin_ver_global').text(response);
                    }
                });

            }, 3000);

            //press enter
            $(document).keypress(function(e) {
                if (e.which == 13 && $("#mensaje").val() != '') {
                    nuevo_mensaje();
                }
            });
        </script>

        <!-- <input type="hidden" id="total_zumbidos" value="<?php echo $total_audios ?>"> -->
        <audio id="sonido" src='chat_ajax/beep.mp3' hidden='true'></audio>
        <?php
        /*
        $k = 1;
        while ($reg = mysqli_fetch_array($audios)) {
            // if ($reg['id_zumbido'] == $nro_aleatorio) {
        ?>
            <audio id="sonido_zumbido_<?php echo $k ?>" src='chat_ajax/<?php echo $reg['nombre'] ?>' hidden='true'></audio>
        <?php
            // }
            $k++;
        }*/
        ?>


        <div id="contenedor-chat" style="z-index: 999;">

            <div class="d-flex justify-content-end mb-2 align-items-center">
                <div onclick="chat_init_arrow()" id="flecha_volver">
                    <img src="../iconos/left-arrow.png" class="mr-2" style="width:2rem; height:2rem" alt="">
                </div>
                <div id="cerrar-chat" class="border border-light bg-white" style="width:7%; height:0%">

                </div>
            </div>

            <div id="caja-chat">

                <div id="chat"></div>

            </div>

            <!-- <form method="POST" action="mensaje_nuevo.php"> -->

            <input type="hidden" id="nombre_chat" name="nombre_chat" value="<?php echo $_SESSION['name'] ?>">

            <input type="hidden" id="chat_nombre">

            <input type="hidden" id="id_chat" name="id_chat">

            <textarea id="mensaje" placeholder="Ingresa tu mensaje" style="max-height:15vh; height:7vh"></textarea>

            <?php
            // if ($_SESSION['id_usuario'] == 618 || $_SESSION['id_usuario'] == 688 || $_SESSION['id_usuario'] == 687) {
            ?>
            <!-- <input type="button" id="btn-zumbido" onclick="zumbido()" name="zumbido" value="zumbido" class="btn btn-secondary"> -->
            <?php
            // }
            ?>

            <input type="button" id="btn-enviar" onclick="nuevo_mensaje()" name="enviar" value="Enviar">



            <!-- </form> -->

        </div>

        <div id="abrir-chat" style="z-index: 999; display: none;">
            <div id="msj_sin_ver_global" style="position: absolute; inset-block-start: 0%; inset-inline-end: 9px;">
                <?php echo $resultado ?>
            </div>
            <img src="chat_ajax/charla.png" />

        </div>

        <!-- end chat code -->

<?php

    }
}
