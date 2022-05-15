<?php

/**
 * hecho por nico
 */
trait trait_modelo_chat
{
    public function formatearFecha($fecha)
    {

        return date('g:i a', strtotime($fecha));
    }

    public function traer_chats()
    {
        $this->conectar();
        $sql = "SELECT *
        from chats
        left join usuarios_chat on usuarios_chat.id_chat = chats.id_chat
        where (usuarios_chat.id_usuario = '" . $_SESSION['id_usuario'] . "' ) and activo = 1";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function mensajes($chat)
    {
        $this->conectar();
        $sql = "SELECT `id` as mensaje_id, `id_chat`, `nombre`, `mensaje`, `fecha`, `zumbido`, `eliminado`, (SELECT vista from mensaje_chat_vistas WHERE mensaje_chat_vistas.id_msj = mensaje_id and mensaje_chat_vistas.id_usuario = '" . $_SESSION['id_usuario'] . "' ) as vista, HOUR(fecha) as hora, minute(fecha) as minutos
        FROM chat_mensajes
        where eliminado='0' and id_chat = '" . $chat . "'
        order by fecha desc";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selecUsuariosActivos()

    {

        $this->conectar();

       
        $sql = "SELECT * from agencias where acceso = 1";

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));

        return $select;
    }

    public function getAudios()
    {
        $this->conectar();
        $sql = "SELECT * from zumbidos";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function actualizar_vistos($chat)
    {
        $this->conectar();
        $sql = "UPDATE mensaje_chat_vistas
        LEFT JOIN chat_mensajes on mensaje_chat_vistas.id_msj = chat_mensajes.id
        LEFT JOIN chats on chat_mensajes.id_chat = chats.id_chat
        SET `vista`= 1
        where id_usuario = '" . $_SESSION['id_usuario'] . "' and vista = 0 and chats.id_chat = '$chat'";

        $select2 =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));

        return $select2;
    }

    public function retornar_json($post)
    {
        $objeto = new stdClass();

        $objeto->evento = $post;

        return json_encode($objeto);
    }


    public function insert_msj($chat, $mensaje, $nombre)
    {
        $this->conectar();
        $sql = "INSERT INTO `chat_mensajes`( `id_chat`, `nombre`, `mensaje`, `fecha`, `eliminado`) values ('$chat','$nombre','$mensaje',now(),'0')";
        $select_1 =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        $id_msj = mysqli_insert_id($this->conexion);

        $sql = "SELECT *
                FROM `chats`
                inner JOIN usuarios_chat on chats.id_chat = usuarios_chat.id_chat
                where usuarios_chat.id_chat = '$chat'";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));


        while ($reg = mysqli_fetch_array($select)) {

            //si es un chat publico
            if ($reg['id_usuario'] == 0) {
                $usuarios = "SELECT

                            usuarios.nombre_usuario AS nombre, usuarios.usuario AS user,

                            usuarios.clave AS pass, usuarios.usuario_tel AS phone, usuarios.id_usuarios AS id_user,

                            supervisor.nombre_usuario AS nombre_supervisor, usuarios.usuario_cargo as cargo,

                            usuarios.desarrollo as desarrollo

                        from

                            usuarios

                        left join

                            usuarios as supervisor ON supervisor.id_usuarios=usuarios.id_usuario_supervisor

                        where

                            usuarios.activo='1' AND usuarios.vendedor_tipo<>'5'

                        order by

                            usuarios.nombre_usuario";

                $select_3 =  mysqli_query($this->conexion, $usuarios) or die(mysqli_error($this->conexion));

                while ($reg_usuarios = mysqli_fetch_array($select_3)) {

                    $sql = "INSERT INTO `mensaje_chat_vistas`(`id_msj`, `id_usuario`, `vista`) VALUES ('$id_msj', '" . $reg_usuarios['id_user'] . "', '0') ";
                    mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
                }
            }
            //si es un chat privado
            else {
                $sql = "INSERT INTO `mensaje_chat_vistas`(`id_msj`, `id_usuario`, `vista`) VALUES ('$id_msj', '" . $reg['id_usuario'] . "', '0') ";
                mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
            }
        }

        return $select_1;
    }

    public function ver_msj_global()
    {
        $this->conectar();
        $sql = "SELECT COUNT(*) as total
                FROM mensaje_chat_vistas
                LEFT JOIN chat_mensajes on mensaje_chat_vistas.id_msj = chat_mensajes.id
                LEFT JOIN chats on chat_mensajes.id_chat = chats.id_chat
                where id_usuario = '" . $_SESSION['id_usuario'] . "' and mensaje_chat_vistas.vista = 0 and chat_mensajes.nombre != '" . $_SESSION['username'] . "' and activo = 1 GROUP BY chats.id_chat";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        
        $suma=0;

        while ($reg = mysqli_fetch_array($select)) {
            $suma += $reg['total'];
        }
        return $suma;
    }

    public function ver_msj($chat)
    {
        $this->conectar();
        $sql = "SELECT chats.nombre, COUNT(*) as total
                FROM mensaje_chat_vistas
                LEFT JOIN chat_mensajes on mensaje_chat_vistas.id_msj = chat_mensajes.id
                LEFT JOIN chats on chat_mensajes.id_chat = chats.id_chat
                where id_usuario = '" . $_SESSION['id_usuario'] . "' and vista = 0 and chats.id_chat = '$chat' and chat_mensajes.nombre != '" . $_SESSION['username'] . "' GROUP BY chats.id_chat";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function eliminar_msj($mensaje)
    {
        $this->conectar();
        $sql = "UPDATE `chat_mensajes` SET `eliminado`='1' WHERE id='$mensaje'";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function insertar_chat($nombre_chat, $participante)
    {
        $this->conectar();

        $sql = "INSERT INTO `chats`(`nombre`, `activo`) values ('$nombre_chat','1')";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        $id_chat = mysqli_insert_id($this->conexion);


        $mi_usuario = $_SESSION['id_usuario'];
        $sql = "INSERT INTO `usuarios_chat`( `id_chat`, `id_usuario`) values ('$id_chat','$mi_usuario')";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));

        $sql = "INSERT INTO `usuarios_chat`( `id_chat`, `id_usuario`) values ('$id_chat','$participante')";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
    }
}
