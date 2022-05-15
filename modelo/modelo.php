<?php

@include 'constantes.php';
@include '../constantes.php';
date_default_timezone_set('America/Buenos_Aires');

/**
 * Description of modelo
 *
 * @author PROGRAMACION ROM
 */

include_once 'traits/trait_modelo_chat.php';

class Modelo
{

    use trait_modelo_chat;

    public $conexion;

    public function conectar()
    {
        if ($this->conexion === NULL) {
            $this->conexion = mysqli_connect(HOST, USUARIO, PASS);
        }
        mysqli_select_db($this->conexion, DB) or die("error al conectar" . mysqli_error($this->conexion));
        mysqli_query($this->conexion, "SET time_zone = '" . date('P') . "'");
        mysqli_query($this->conexion, "SET NAMES utf8");
        return $this->conexion;
    }

    // FUNCION PARA SANEAR LOS DATOS

    public function sanitizarDatos($tipo, $dato)
    {
        // TIPOS:
        // 1: STRING | 2: NUMBER_INT | 3: EMAIL |
        if (strlen($dato) > 0) {
            if ($dato != 0) {
                switch ($tipo) {
                    case "1":
                        if (filter_var($dato, FILTER_SANITIZE_STRING)) {
                            $dato_sanitizado = filter_var($dato, FILTER_SANITIZE_STRING);
                            return $dato_sanitizado;
                            break;
                        } else {
                            return "error de tipo";
                            break;
                        }
                    case "2":
                        if (filter_var($dato, FILTER_SANITIZE_NUMBER_INT)) {
                            $dato_sanitizado = filter_var($dato, FILTER_SANITIZE_NUMBER_INT);
                            return $dato_sanitizado;
                            break;
                        } else {
                            return "error de tipo";
                            break;
                        }
                    case "3":
                        if (filter_var($dato, FILTER_SANITIZE_EMAIL)) {
                            $dato_sanitizado = filter_var($dato, FILTER_SANITIZE_EMAIL);
                            return $dato_sanitizado;
                            break;
                        } else {
                            return "error de tipo";
                            break;
                        }
                    default:
                        return "no existe tipo";
                        break;
                }
            } else {
                return $dato;
            }
        } else {
            return $dato = 0;
        }
    }

    public function sanitizar_datos_new($dato)
    {

        $this->conectar();

        $dato_2 = mysqli_real_escape_string($this->conexion, $dato);

        return $dato_2;
    }

    // FIN | FUNCION SANEAR DATOS

    public function selectMarcas($condicion = '1')
    {
        $this->conectar();
        $sql = "SELECT * from  marcas where $condicion order by marca_descri";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectMarcaYmodeloElegidos($id_modelo)
    {
        $this->conectar();
        $sql = "SELECT * from  modelos
                left join marcas on marcas.id_marcas=modelos.marcas_id_marcas
                where modelos.id_modelo='$id_modelo'";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectModelos($id_marca)
    {
        $this->conectar();
        $sql = "select * from  modelos where marcas_id_marcas='" . $id_marca . "' order by modelo_descri";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectProvincias()
    {
        $this->conectar();
        $sql = "SELECT *
                FROM provincias
                order by provincia";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectPlanes()
    {
        $this->conectar();
        $sql = "SELECT planes.titulo_planes, planes.valor_planes, GROUP_CONCAT(planes_caracteristicas.caracteristicas_planes_caracteristicas ORDER BY planes_caracteristicas.caracteristicas_planes_caracteristicas asc, ' ') as caracteristicas, COUNT(planes_caracteristicas.caracteristicas_planes_caracteristicas) as cantidad
                FROM planes
                INNER JOIN planes_caracteristicas on planes.ID_planes = planes_caracteristicas.id_planes_fk
                GROUP BY planes.titulo_planes, planes.valor_planes
                ORDER by titulo_planes DESC";
        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectUsers($token = null)
    {
        $this->conectar();
        if (isset($_POST['usuario']) && isset($_POST['clave'])) {
            $username = mysqli_real_escape_string($this->conexion, $_POST['usuario']);
            $password = mysqli_real_escape_string($this->conexion, $_POST['clave']);
        }

        if ($token != null) {
            $users = "SELECT * FROM `usuarios` WHERE usuarios.token = '$token'";
            $consulta =  mysqli_query($this->conexion, $users) or die(mysqli_error($this->conexion));
            $reg = mysqli_fetch_array($consulta);
            $username = $reg['usuario'];
            $password = $reg['clave'];
        }
        //$sql = "select * from usuarios where usuario='$username' and clave='$password' ";
        // $sql = "SELECT *, agencias.nombre as agencia_nombre from usuarios left JOIN agencias on usuarios.id_agencia = agencias.id_agencia where usuarios.usuario='$username' and usuarios.clave='$password' and usuarios.activo='1'";
        $sql = "SELECT *, usuarios.usuario as username
        from usuarios 
        LEFT JOIN agencias on usuarios.id_agencia = agencias.id_agencia
        where usuarios.usuario='$username' and usuarios.clave='$password' and activo='1' and agencias.acceso = '1'";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function ultimos_vehiculos($tipo, $cantidad)
    {
        $this->conectar();

        switch ($tipo) {
            case 'cero':
                $sql = "SELECT *
                from unidades_lista
                LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
                LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
                LEFT JOIN agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
                where agencias.acceso = 1 and activo='1' and precio > 0 and eliminada = 0 order by id_cotizacion desc limit $cantidad";
                break;

            case 'usado':
                $sql = "SELECT *
                FROM `unidades_stock`
                LEFT JOIN unidades_usadas_imgs on unidades_stock.id_unidad = unidades_usadas_imgs.id_unidad
                LEFT JOIN modelos on unidades_stock.id_modelo = modelos.id_modelo
                LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
                LEFT JOIN agencias on unidades_stock.id_agencia = agencias.id_agencia
                WHERE agencias.acceso = 1 and (valor_publico_pesos > 0 or valor_publico_dolar > 0 ) and activa = 1 and urls != 'a:0:{}' ORDER by unidades_stock.id_unidad DESC LIMIT $cantidad";
                break;
            case 'particular':
                $sql = "SELECT *
                FROM `unidades_particulares`
                LEFT JOIN modelos on unidades_particulares.id_modelo = modelos.id_modelo
                LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
                WHERE activo = 1 and moderado = 1 and imagenes != '' and imagenes != '0' ORDER by unidades_particulares.id_unidad DESC LIMIT $cantidad";
                break;
        }

        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function datos_agencia($id_usuario)
    {
        $this->conectar();
        $sql = "SELECT *
        from usuarios
        left JOIN agencias on usuarios.id_agencia = agencias.id_agencia
        where usuarios.id_usuario = '$id_usuario' and activo='1'";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function cant_fotos($unidad)
    {
        $this->conectar();
        $sql = "SELECT urls FROM `unidades_usadas_imgs` WHERE id_unidad = $unidad ";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectMarcasCotizadasPoolCompras()
    {
        $this->conectar();
        $sql = "SELECT DISTINCT(marcas.id_marcas) AS id_marca, marcas.marca_descri FROM marcas, modelos, pool_cotizaciones
            WHERE pool_cotizaciones.id_modelo=modelos.id_modelo AND modelos.marcas_id_marcas=marcas.id_marcas
            ORDER BY marcas.marca_descri";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectModelosCotizadosPoolCompras($id_marca)
    {
        $this->conectar();
        $sql = "SELECT DISTINCT(CONCAT(modelos.modelo_descri,' ',pool_cotizaciones.version)) AS modelo_version, modelos.id_modelo, pool_cotizaciones.version
        FROM marcas, modelos, pool_cotizaciones
        WHERE pool_cotizaciones.id_modelo=modelos.id_modelo AND modelos.marcas_id_marcas=marcas.id_marcas AND marcas.id_marcas='$id_marca'
        ORDER BY marcas.marca_descri";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectCotizadosPoolCompras($id_modelo)
    {
        $this->conectar();
        $sql = "SELECT * FROM pool_cotizaciones
            LEFT JOIN agencias ON agencias.id_agencia=pool_cotizaciones.id_agencia
            WHERE pool_cotizaciones.id_modelo='$id_modelo'
            ORDER BY pool_cotizaciones.fecha desc";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function contador()
    {
        $df = '!Y-m-d';
        $fechaInicio = DateTime::createFromFormat($df, '2022-02-18');

        $fechaFinal  = DateTime::createFromFormat($df, '2022-03-03');

        $fechaHoy = new DateTime('today');

        $totalDays = $fechaInicio->diff($fechaFinal)->d;   #Días totales entre las fechas dadas

        $diffDays = $fechaFinal->diff($fechaHoy)->d;       #Días que faltan para que termine
        $msgInfo = $fechaFinal == $fechaHoy ? "Terminado" : " Falta 1 día para la nueva versión de Comunidauto.";
        // $msgInfo= $fechaFinal == $fechaHoy ? "Terminado": " Faltan $diffDays días para la nueva version de Comunidauto. ";
        echo $msgInfo;
    }

    public function selectUnidadesStock($id_modelo, $tipo = 2)
    {
        $this->conectar();


        if ($tipo == 2) {
            $condicion_tipo = "AND unidades_stock.kilometraje>0";
        } else {
            $condicion_tipo = "AND unidades_stock.kilometraje=0";
        }
        $sql = "SELECT *, unidades_stock.id_unidad as id, unidades_stock.id_agencia as agencia  FROM unidades_stock
        left join modelos as m on m.id_modelo=unidades_stock.id_modelo
        left join marcas on marcas.id_marcas=m.marcas_id_marcas
        left join unidades_usadas_imgs ON unidades_stock.id_unidad=unidades_usadas_imgs.id_unidad
        LEFT JOIN favoritos on unidades_stock.id_unidad = favoritos.id_unidad
        WHERE unidades_stock.id_modelo='$id_modelo' AND activa='1' $condicion_tipo
        ORDER by unidades_stock.id_unidad ASC";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function lista_dateros()
    {
        $this->conectar();
        $sql = "SELECT unidades_lista.id_cotizacion, unidades_lista.id_agencia, unidades_lista.precio, if(agencias_rom.nombre is not null, agencias_rom.nombre, agencias.nombre) as nombre, marcas.marca_descri, unidades_lista.version, if(agencias_rom.id_provincia is not null, agencias_rom.id_provincia, agencias.id_provincia ) as id_provincia_agencia, (select provincias.provincia from provincias where provincias.id = id_provincia_agencia) as provincia, if( agencias_rom.telefono is not null, agencias_rom.telefono ,agencias.telefono) as 'telefono', unidades_lista.fecha, unidades_lista.gastos, unidades_lista.color, if(agencias_rom.id_localidad is not null, agencias_rom.id_localidad, agencias.id_localidad) as id_localidad_agencia, (select localidades.localidad from localidades where localidades.id = id_localidad_agencia) as 'localidad'
        FROM unidades_lista
        LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
        LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
        LEFT JOIN agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
        LEFT JOIN agencias on unidades_lista.id_agencia = agencias.id_agencia
        LEFT JOIN localidades on agencias_rom.id_localidad = localidades.id
        LEFT JOIN provincias on agencias_rom.id_provincia = provincias.id

        where MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
        -- and unidades_lista.id_modelo = $modelo
        -- and marcas.id_marcas = $marca
        AND agencias.acceso = 1 and unidades_lista.precio > 0
        ORDER by unidades_lista.precio ASC";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectLista($marca, $modelo, $ubicacion = '', $color = '')
    {
        $this->conectar();
        $lista_resultados = [];


        if ($marca != "") {
            if ($modelo != "") {
                $sql = "SELECT unidades_lista.id_cotizacion, unidades_lista.id_agencia, unidades_lista.precio, if(agencias_rom.nombre is not null, agencias_rom.nombre, agencias.nombre) as nombre, marcas.marca_descri, unidades_lista.version, if(agencias_rom.id_provincia is not null, agencias_rom.id_provincia, agencias.id_provincia ) as id_provincia_agencia, (select provincias.provincia from provincias where provincias.id = id_provincia_agencia) as provincia, if( agencias_rom.telefono is not null, agencias_rom.telefono ,agencias.telefono) as 'telefono', unidades_lista.fecha, unidades_lista.gastos, unidades_lista.color, if(agencias_rom.id_localidad is not null, agencias_rom.id_localidad, agencias.id_localidad) as id_localidad_agencia, (select localidades.localidad from localidades where localidades.id = id_localidad_agencia) as 'localidad'
                        FROM unidades_lista
                        LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
                        LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
                        LEFT JOIN agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
                        LEFT JOIN agencias on unidades_lista.id_agencia = agencias.id_agencia
                        LEFT JOIN localidades on agencias_rom.id_localidad = localidades.id
                        LEFT JOIN provincias on agencias_rom.id_provincia = provincias.id

                        where MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
                        and unidades_lista.id_modelo = $modelo
                        and marcas.id_marcas = $marca
                        AND unidades_lista.precio > 0
                        AND agencias.acceso = 1
                        ORDER by unidades_lista.precio ASC";

                $sql2 = "SELECT unidades_lista.id_cotizacion, unidades_lista.id_agencia, unidades_lista.precio, if(agencias_rom.nombre is not null, agencias_rom.nombre, agencias.nombre) as nombre, marcas.marca_descri, unidades_lista.version, if(agencias_rom.id_provincia is not null, agencias_rom.id_provincia, agencias.id_provincia ) as id_provincia_agencia, (select provincias.provincia from provincias where provincias.id = id_provincia_agencia) as provincia, if( agencias_rom.telefono is not null, agencias_rom.telefono ,agencias.telefono) as 'telefono', unidades_lista.fecha, unidades_lista.gastos, unidades_lista.color, if(agencias_rom.id_localidad is not null, agencias_rom.id_localidad, agencias.id_localidad) as id_localidad_agencia, (select localidades.localidad from localidades where localidades.id = id_localidad_agencia) as 'localidad'
                        FROM unidades_lista
                    -- LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
                    -- LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
                    -- LEFT JOIN agencias on unidades_lista.id_agencia = agencias.id_agencia
                    -- LEFT JOIN localidades on agencias.id_localidad = localidades.id
                    -- LEFT JOIN provincias on agencias.id_provincia = provincias.id

                    LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
                    LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
                    LEFT JOIN agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
                    LEFT JOIN agencias on unidades_lista.id_agencia = agencias.id_agencia
                    LEFT JOIN localidades on agencias_rom.id_localidad = localidades.id
                    LEFT JOIN provincias on agencias_rom.id_provincia = provincias.id

                    where MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
                    and unidades_lista.id_modelo = $modelo
                    and marcas.id_marcas = $marca
                    AND unidades_lista.precio = 0
                    AND agencias.acceso = 1
                    ORDER by unidades_lista.precio ASC";
            } else {
                $sql = "SELECT unidades_lista.id_cotizacion, unidades_lista.id_agencia, unidades_lista.precio, if(agencias_rom.nombre is not null, agencias_rom.nombre, agencias.nombre) as nombre, marcas.marca_descri, unidades_lista.version, if(agencias_rom.id_provincia is not null, agencias_rom.id_provincia, agencias.id_provincia ) as id_provincia_agencia, (select provincias.provincia from provincias where provincias.id = id_provincia_agencia) as provincia, if( agencias_rom.telefono is not null, agencias_rom.telefono ,agencias.telefono) as 'telefono', unidades_lista.fecha, unidades_lista.gastos, unidades_lista.color, if(agencias_rom.id_localidad is not null, agencias_rom.id_localidad, agencias.id_localidad) as id_localidad_agencia, (select localidades.localidad from localidades where localidades.id = id_localidad_agencia) as 'localidad'
                        FROM unidades_lista

                        -- LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
                        -- LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
                        -- LEFT JOIN agencias on unidades_lista.id_agencia = agencias.id_agencia
                        -- LEFT JOIN localidades on agencias.id_localidad = localidades.id
                        -- LEFT JOIN provincias on agencias.id_provincia = provincias.id

                        LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
                        LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
                        LEFT JOIN agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
                        LEFT JOIN agencias on unidades_lista.id_agencia = agencias.id_agencia
                        LEFT JOIN localidades on agencias_rom.id_localidad = localidades.id
                        LEFT JOIN provincias on agencias_rom.id_provincia = provincias.id

                        where MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
                        and marcas.id_marcas = $marca
                        AND unidades_lista.precio > 0
                        AND agencias.acceso = 1
                        ORDER by unidades_lista.precio ASC";

                $sql2 = "SELECT unidades_lista.id_cotizacion, unidades_lista.id_agencia, unidades_lista.precio, if(agencias_rom.nombre is not null, agencias_rom.nombre, agencias.nombre) as nombre, marcas.marca_descri, unidades_lista.version, if(agencias_rom.id_provincia is not null, agencias_rom.id_provincia, agencias.id_provincia ) as id_provincia_agencia, (select provincias.provincia from provincias where provincias.id = id_provincia_agencia) as provincia, if( agencias_rom.telefono is not null, agencias_rom.telefono ,agencias.telefono) as 'telefono', unidades_lista.fecha, unidades_lista.gastos, unidades_lista.color, if(agencias_rom.id_localidad is not null, agencias_rom.id_localidad, agencias.id_localidad) as id_localidad_agencia, (select localidades.localidad from localidades where localidades.id = id_localidad_agencia) as 'localidad'
                        FROM unidades_lista

                        -- LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
                        -- LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
                        -- LEFT JOIN agencias on unidades_lista.id_agencia = agencias.id_agencia
                        -- LEFT JOIN localidades on agencias.id_localidad = localidades.id
                        -- LEFT JOIN provincias on agencias.id_provincia = provincias.id

                        LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
                        LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
                        LEFT JOIN agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
                        LEFT JOIN agencias on unidades_lista.id_agencia = agencias.id_agencia
                        LEFT JOIN localidades on agencias_rom.id_localidad = localidades.id
                        LEFT JOIN provincias on agencias_rom.id_provincia = provincias.id

                        where MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
                        and marcas.id_marcas = $marca
                        AND unidades_lista.precio = 0
                        AND agencias.acceso = 1
                        ORDER by unidades_lista.precio ASC";
            }
        }

        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        $select2 =  mysqli_query($this->conexion, $sql2) or die(mysqli_error($this->conexion));
        $lista_resultados[] = $select;
        $lista_resultados[] = $select2;
        return $lista_resultados;
    }

    public function TodasLasUnidadesLista($ubicacion = NULL, $color = NULL)
    {
        $this->conectar();
        $lista_resultados = [];

        // if ($ubicacion != ""){
        //     if ($color != ""){
        //             //consulta para mostrar los datos de las agencias en los precios de lista
        //         $sql = "SELECT *
        //                 FROM unidades_lista

        //                 -- LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
        //                 -- LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
        //                 -- LEFT JOIN agencias on unidades_lista.id_agencia = agencias.id_agencia
        //                 -- LEFT JOIN localidades on agencias.id_localidad = localidades.id
        //                 -- LEFT JOIN provincias on agencias.id_provincia = provincias.id

        //                 LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
        //                 LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
        //                 LEFT JOIN agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
        //                 LEFT JOIN localidades on agencias_rom.id_localidad = localidades.id
        //                 LEFT JOIN provincias on agencias_rom.id_provincia = provincias.id

        //                 WHERE MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
        //                 AND provincias.id = $ubicacion
        //                 AND unidades_lista.precio > 0
        //                 AND unidades_lista.activo = 1
        //                 AND unidades_lista.color LIKE '%$color%'
        //                 ORDER BY unidades_lista.precio ASC";

        //         $sql2 = "SELECT *
        //                 FROM unidades_lista

        //                 -- LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
        //                 -- LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
        //                 -- LEFT JOIN agencias on unidades_lista.id_agencia = agencias.id_agencia
        //                 -- LEFT JOIN localidades on agencias.id_localidad = localidades.id
        //                 -- LEFT JOIN provincias on agencias.id_provincia = provincias.id

        //                 LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
        //                 LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
        //                 LEFT JOIN agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
        //                 LEFT JOIN localidades on agencias_rom.id_localidad = localidades.id
        //                 LEFT JOIN provincias on agencias_rom.id_provincia = provincias.id

        //                 WHERE MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
        //                 AND provincias.id = $ubicacion
        //                 AND unidades_lista.precio = 0
        //                 AND unidades_lista.activo = 1
        //                 AND unidades_lista.color LIKE '%$color%'
        //                 ORDER BY unidades_lista.precio ASC";

        //     }
        //     else{
        //         $sql = "SELECT *
        //                 FROM unidades_lista

        //                 -- LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
        //                 -- LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
        //                 -- LEFT JOIN agencias on unidades_lista.id_agencia = agencias.id_agencia
        //                 -- LEFT JOIN localidades on agencias.id_localidad = localidades.id
        //                 -- LEFT JOIN provincias on agencias.id_provincia = provincias.id

        //                 LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
        //                 LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
        //                 LEFT JOIN agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
        //                 LEFT JOIN localidades on agencias_rom.id_localidad = localidades.id
        //                 LEFT JOIN provincias on agencias_rom.id_provincia = provincias.id
        //                 where MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
        //                 and provincias.id = $ubicacion
        //                 AND unidades_lista.precio > 0
        //                 AND unidades_lista.activo = 1
        //                 ORDER by unidades_lista.precio ASC";

        //         $sql2 = "SELECT *
        //                 FROM unidades_lista

        //                 -- LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
        //                 -- LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
        //                 -- LEFT JOIN agencias on unidades_lista.id_agencia = agencias.id_agencia
        //                 -- LEFT JOIN localidades on agencias.id_localidad = localidades.id
        //                 -- LEFT JOIN provincias on agencias.id_provincia = provincias.id

        //                 LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
        //                 LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
        //                 LEFT JOIN agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
        //                 LEFT JOIN localidades on agencias_rom.id_localidad = localidades.id
        //                 LEFT JOIN provincias on agencias_rom.id_provincia = provincias.id
        //                 where MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
        //                 and provincias.id = $ubicacion
        //                 AND unidades_lista.precio = 0
        //                 AND unidades_lista.activo = 1
        //                 ORDER by unidades_lista.precio ASC";
        //     }
        // }else if ($color != ""){
        //     $sql = "SELECT *
        //             FROM unidades_lista

        //             -- LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
        //             -- LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
        //             -- LEFT JOIN agencias on unidades_lista.id_agencia = agencias.id_agencia
        //             -- LEFT JOIN localidades on agencias.id_localidad = localidades.id
        //             -- LEFT JOIN provincias on agencias.id_provincia = provincias.id

        //             LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
        //             LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
        //             LEFT JOIN agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
        //             LEFT JOIN localidades on agencias_rom.id_localidad = localidades.id
        //             LEFT JOIN provincias on agencias_rom.id_provincia = provincias.id
        //             where MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
        //             and unidades_lista.color like '%$color%'
        //             AND unidades_lista.precio > 0
        //             AND unidades_lista.activo = 1
        //             ORDER by unidades_lista.precio ASC";

        //     $sql2 = "SELECT *
        //             FROM unidades_lista

        //             -- LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
        //             -- LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
        //             -- LEFT JOIN agencias on unidades_lista.id_agencia = agencias.id_agencia
        //             -- LEFT JOIN localidades on agencias.id_localidad = localidades.id
        //             -- LEFT JOIN provincias on agencias.id_provincia = provincias.id

        //             LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
        //             LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
        //             LEFT JOIN agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
        //             LEFT JOIN localidades on agencias_rom.id_localidad = localidades.id
        //             LEFT JOIN provincias on agencias_rom.id_provincia = provincias.id
        //             where MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
        //             and unidades_lista.color like '%$color%'
        //             AND unidades_lista.precio = 0
        //             AND unidades_lista.activo = 1
        //             ORDER by unidades_lista.precio ASC";
        // }
        // else{
        $sql = "SELECT unidades_lista.id_cotizacion, unidades_lista.id_agencia, unidades_lista.precio, if(agencias_rom.nombre is not null, agencias_rom.nombre, agencias.nombre) as nombre, marcas.marca_descri, unidades_lista.version, if(agencias_rom.id_provincia is not null, agencias_rom.id_provincia, agencias.id_provincia ) as id_provincia_agencia, (select provincias.provincia from provincias where provincias.id = id_provincia_agencia) as provincia, if( agencias_rom.telefono is not null, agencias_rom.telefono ,agencias.telefono) as 'telefono', unidades_lista.fecha, unidades_lista.gastos, unidades_lista.color, if(agencias_rom.id_localidad is not null, agencias_rom.id_localidad, agencias.id_localidad) as id_localidad_agencia, (select localidades.localidad from localidades where localidades.id = id_localidad_agencia) as 'localidad'
            FROM unidades_lista
            LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
            LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
            LEFT JOIN agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
            LEFT JOIN agencias on unidades_lista.id_agencia = agencias.id_agencia
            LEFT JOIN localidades on agencias_rom.id_localidad = localidades.id
            LEFT JOIN provincias on agencias_rom.id_provincia = provincias.id
                    where MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
                    AND unidades_lista.precio > 0
                    AND unidades_lista.activo = 1
                    AND agencias.acceso = 1
                    ORDER by unidades_lista.precio ASC";

        $sql2 = "SELECT unidades_lista.id_cotizacion, unidades_lista.id_agencia, unidades_lista.precio, if(agencias_rom.nombre is not null, agencias_rom.nombre, agencias.nombre) as nombre, marcas.marca_descri, unidades_lista.version, if(agencias_rom.id_provincia is not null, agencias_rom.id_provincia, agencias.id_provincia ) as id_provincia_agencia, (select provincias.provincia from provincias where provincias.id = id_provincia_agencia) as provincia, if( agencias_rom.telefono is not null, agencias_rom.telefono ,agencias.telefono) as 'telefono', unidades_lista.fecha, unidades_lista.gastos, unidades_lista.color, if(agencias_rom.id_localidad is not null, agencias_rom.id_localidad, agencias.id_localidad) as id_localidad_agencia, (select localidades.localidad from localidades where localidades.id = id_localidad_agencia) as 'localidad'
        from unidades_lista
        LEFT JOIN modelos on unidades_lista.id_modelo = modelos.id_modelo
            LEFT JOIN marcas on modelos.marcas_id_marcas = marcas.id_marcas
            LEFT JOIN agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
            LEFT JOIN agencias on unidades_lista.id_agencia = agencias.id_agencia
            LEFT JOIN localidades on agencias_rom.id_localidad = localidades.id
            LEFT JOIN provincias on agencias_rom.id_provincia = provincias.id
                    where MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
                    AND unidades_lista.precio = 0
                    AND unidades_lista.activo = 1
                    AND agencias.acceso = 1
                    ORDER by unidades_lista.precio ASC";
        // }


        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        $select2 =  mysqli_query($this->conexion, $sql2) or die(mysqli_error($this->conexion));
        $lista_resultados[] = $select;
        $lista_resultados[] = $select2;

        return $lista_resultados;
    }

    public function selectUnidadesbusqueda($id_modelo, $tipo, $marcaBuscada = null)
    {
        $this->conectar();
        // $condicion_combustible = " AND combustible like '%$combustible%' ";
        // $condicion_color = " AND color like '%$color%'";
        // $condicion_ubicacion = " AND provincias.id like '%$ubicacion%' " ;

        // $condicion_agencia = "";

        // if ($id_agencia == "AGENCIA"){
        //     $condicion_agencia = "";
        // }
        // else{
        //     $condicion_agencia = " AND agencias.id_agencia = '$id_agencia'";
        // }

        if ($tipo == 2) {
            $condicion_tipo = "unidades_stock.kilometraje>0";
        } else {
            $condicion_tipo = "unidades_stock.kilometraje=0";
        }

        // if ($preciomin == '') {
        //     $preciomin =0;
        // }
        // if ($preciomax == '') {
        //     $preciomin = 999999999999999999999;
        // }

        // switch ($moneda) {
        //     case 'usd':
        //         $condicion_precio = "AND valor_publico_dolar >= $preciomin AND valor_publico_dolar < $preciomax";
        //         break;

        //     case 'peso':
        //         $condicion_precio = "AND valor_publico_pesos >= $preciomin AND valor_publico_pesos < $preciomax";
        //         break;
        //     default:
        //         $condicion_precio = "AND valor_publico_pesos > 0";
        //         break;
        // }

        // ajustar kilometraje
        // switch ($kilometraje) {
        //     case 'hasta 20.000':
        //         $kilometraje = 20000;
        //         $min_kilometraje = 0;
        //         break;

        //     case 'hasta 50.000':
        //         $kilometraje = 50000;
        //         $min_kilometraje = 0;
        //         break;

        //     case 'hasta 100.000':
        //         $kilometraje = 100000;
        //         $min_kilometraje = 0;
        //         break;

        //     case '100.000 mas':
        //         $kilometraje = 100000;
        //         $min_kilometraje = 1;
        //         $condicion_tipo = "AND unidades_stock.kilometraje>100000";
        //         break;

        //     default:

        //         $min_kilometraje = 2;
        //         break;
        // }

        // if ($min_kilometraje == 1) {

        //     $condicionkm = "AND kilometraje > " . $kilometraje;

        // }
        // else if ($min_kilometraje == 0) {

        //     $condicionkm = "AND kilometraje < " . $kilometraje;

        // }
        // else {
        //     $condicionkm = '';
        // }

        //ajustar anio
        // switch ($anio) {
        //     case 'menor a 2010':
        //         $anio = "AND anio < 2010";
        //         break;

        //     case '2011 a 2013':
        //         $anio = "AND anio >= 2011 AND anio <= 2013";
        //         break;

        //     case '2014 a 2016':
        //         $anio = "AND anio >= 2014 AND anio <= 2016";
        //         break;

        //     case '2017 a 2019':
        //         $anio = "AND anio >= 2017 AND anio <= 2019";
        //         break;

        //     case 'mayor a 2020':
        //         $anio = "AND anio >= 2020";
        //         break;

        //     default:
        //         $anio = "";
        //         break;
        // }

        if ($id_modelo != 'No') {
            $condicion_modelo = "unidades_stock.id_modelo='$id_modelo'";
        } else {
            $condicion_modelo = "unidades_stock.id_modelo <> 0";
        }

        if ($marcaBuscada != null) {
            $condicion_marca = "AND marcas.id_marcas = $marcaBuscada";
        } else {
            $condicion_marca = "";
        }

        $this->conectar();
        $sql = "SELECT *, unidades_stock.id_unidad as id, unidades_stock.id_agencia as agencia  FROM unidades_stock
                left join agencias on unidades_stock.id_agencia = agencias.id_agencia
                left join modelos as m on m.id_modelo=unidades_stock.id_modelo
                left join marcas on marcas.id_marcas=m.marcas_id_marcas
                left join unidades_usadas_imgs ON unidades_stock.id_unidad=unidades_usadas_imgs.id_unidad
                left join provincias on agencias.id_provincia = provincias.id
                LEFT JOIN favoritos on unidades_stock.id_unidad = favoritos.id_unidad
                WHERE agencias.acceso = 1 and $condicion_modelo AND $condicion_tipo AND activa='1' AND kilometraje > 0 $condicion_marca
                ORDER BY unidades_usadas_imgs.urls desc";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function TodasLasUnidadesUsadas($tipo, $tipo_vehiculo = null)
    {
        $this->conectar();

        if ($tipo == '1') {
            $sql = "SELECT *, unidades_stock.id_unidad as id, unidades_stock.id_agencia as agencia FROM unidades_stock
                left join agencias on unidades_stock.id_agencia = agencias.id_agencia
                left join modelos as m on m.id_modelo=unidades_stock.id_modelo
                left join marcas on marcas.id_marcas=m.marcas_id_marcas
                left join unidades_usadas_imgs ON unidades_stock.id_unidad=unidades_usadas_imgs.id_unidad
                left join provincias on agencias.id_provincia = provincias.id
                where agencias.acceso = 1 and  activa = 1 AND unidades_stock.kilometraje = 0
                ORDER by unidades_usadas_imgs.urls desc";
        }

        if ($tipo == '2') {

            if ($tipo_vehiculo == 1) {
                $condicion_categoria = " AND unidades_stock.tipo not like '%CAMION%' ";
            } else if ($tipo_vehiculo == 2) {
                $condicion_categoria = " AND unidades_stock.tipo like '%CAMION%' ";
            } else if ($tipo_vehiculo == 3) {
                $condicion_categoria = " AND unidades_stock.tipo like '%MOTOCICLETA%'";
            } else {
                $condicion_categoria = "";
            }

            $sql = "SELECT *, unidades_stock.id_unidad as id, unidades_stock.id_agencia as agencia FROM unidades_stock
                left join agencias on unidades_stock.id_agencia = agencias.id_agencia
                left join modelos as m on m.id_modelo=unidades_stock.id_modelo
                left join marcas on marcas.id_marcas=m.marcas_id_marcas
                left join unidades_usadas_imgs ON unidades_stock.id_unidad=unidades_usadas_imgs.id_unidad
                left join provincias on agencias.id_provincia = provincias.id
                where agencias.acceso = 1 and activa = 1 AND unidades_stock.kilometraje > 0 $condicion_categoria
                ORDER by unidades_usadas_imgs.urls desc";
        }

        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function unidades_usadas_dateros()
    {

        $this->conectar();

        $sql = "SELECT *, unidades_stock.id_unidad as id, unidades_stock.id_agencia as agencia FROM unidades_stock
        left join agencias on unidades_stock.id_agencia = agencias.id_agencia
        left join modelos as m on m.id_modelo=unidades_stock.id_modelo
        left join marcas on marcas.id_marcas=m.marcas_id_marcas
        left join unidades_usadas_imgs ON unidades_stock.id_unidad=unidades_usadas_imgs.id_unidad
        left join provincias on agencias.id_provincia = provincias.id
        where agencias.acceso = 1 and activa = 1 AND unidades_stock.kilometraje > 0
        ORDER by unidades_usadas_imgs.urls desc";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectAnio()
    {

        $this->conectar();
        $sql = "SELECT distinct anio FROM unidades_stock order by anio desc";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectCombustible()
    {

        $this->conectar();
        $sql = "SELECT distinct combustible FROM unidades_stock";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectColor()
    {

        $this->conectar();
        $sql = "SELECT * FROM colores order by color asc";
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }


    public function updateAgenciaAcceso($agencia)
    {
        $this->conectar();
        $valor = $agencia->valor;
        $id = $agencia->id;
        $sql = "UPDATE agencias set acceso='$valor' where id_lucy='$id' ";
        mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
    }

    public function insertAgencia($agencia)
    {
        $this->conectar();

        $nombre = $agencia->nombre;
        $direccion = $agencia->direccion;
        $telefono = $agencia->telefono;
        $interno = $agencia->interno;
        $vendedor = $agencia->vendedor;
        $administrativo = $agencia->administrativo;
        $correo = $agencia->nombre;
        $id_provincia = $agencia->provincia;
        $id_localidad = $agencia->localidad;
        $clave = $agencia->clave;
        $usuario = $agencia->usuario;
        $id_lucy = $agencia->id_lucy;
        $agencia_tipo = $agencia->agencia_tipo;

        $sql = "INSERT INTO
                agencias
                (nombre, direccion, telefono, interno, administrativo, vendedor, correo, id_provincia, id_localidad,
                agencia_tipo, usuario, clave, id_lucy)
                VALUES
                ('" . $nombre . "', '" . $direccion . "', '" . $telefono . "', '" . $interno . "', '" . $administrativo . "',
                '" . $vendedor . "', '" . $correo . "', '" . $id_provincia . "', '" . $id_localidad . "', '$agencia_tipo',
                '$usuario', '$clave', '$id_lucy' )";

        mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
    }

    public function chequeoUnidadExistente($unidad)
    {
        $this->conectar();
        $id_lucy = $unidad->id;
        $id_agencia = $unidad->id_agencia;
        if (isset($unidad->kilometraje) && $unidad->kilometraje > 0) {
            $sql = "SELECT
                *
            FROM
                unidades_stock
            WHERE
                id_agencia='$id_agencia' AND id_lucy='$id_lucy'";
        } else {
            $sql = "SELECT
                *
            FROM
                unidades_lista
            WHERE
                id_agencia = $id_agencia OR id_cotizacion_lucy = $id_lucy;";
        }
        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function updateUnidadUsada($unidad)
    {
        $this->conectar();
        $id_lucy = $unidad->id;
        $id_agencia = $unidad->id_agencia;
        $valor = $unidad->valor;
        $valor_pesos = $unidad->valor_pesos;
        $valor_costo = $unidad->valor_costo;
        $tipo = $unidad->tipo;
        $id_modelo = $unidad->id_modelo;
        $anio = $unidad->anio;
        $kilometraje = $unidad->kilometraje;
        $color = $unidad->color;
        $version = $unidad->version;
        $combustible = $unidad->combustible;
        $estado = $unidad->estado;
        $localidad = $unidad->localidad;
        $transmision = $unidad->transmision;

        if (isset($unidad->kilometraje) && $unidad->kilometraje > 0) {

            $sql = "UPDATE
                    unidades_stock
                set
                    valor_publico_pesos='$valor_pesos', valor_costo='$valor_costo', anio='$anio', kilometraje='$kilometraje',
                    color='$color', tipo='$tipo', version='$version', transmision = '$transmision' , combustible='$combustible',
                    estado='$estado', id_modelo='$id_modelo', id_localidad='$localidad', activa='$valor'
                where
                    id_agencia='$id_agencia' AND id_lucy='$id_lucy' ";
            $consulta = mysqli_query($this->conexion, $sql);
        } else {

            $sql = "SELECT * FROM unidades_lista
            WHERE id_agencia = $id_agencia AND id_cotizacion_lucy = $id_lucy";

            $verif = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));

            if (mysqli_num_rows($verif) == 0) {
                $sql = "INSERT INTO unidades_lista(fecha, id_modelo, id_agencia, version, color, moneda, precio, gastos, disponibilidad, activo, id_cotizacion_lucy)
                VALUES (CURDATE(), $id_modelo, $id_agencia, '$version', '$color', '0', '$valor_pesos', '0', 'INMEDIATA', '1', '$id_lucy')";
                $accion = 'INSERT';
            } else {
                $sql = "UPDATE `unidades_lista` SET `fecha` = CURDATE(), `id_modelo` = $id_modelo, `id_agencia` = $id_agencia, `version` = '$version', `color` = '$color', `moneda` = '0', `precio` = '$valor_pesos', `gastos` = '0', `disponibilidad` = 'INMEDIATA', `activo` = $valor WHERE id_agencia = $id_agencia AND id_cotizacion_lucy = $id_lucy";
                $accion = 'UPDATE';
            }
        }
        $consulta = mysqli_query($this->conexion, $sql);
        return ($consulta == 1) ? $accion . ' EJECUTADO CON EXITO - id_agencia = ' . $id_agencia . ' id_cotizacion_lucy = ' . $id_lucy : mysqli_error($this->conexion);
    }

    public function insertUnidadUsada($unidad)
    {
        $this->conectar();

        if (isset($unidad->id)) {
            $id_lucy = $unidad->id;
        } else {
            $id_lucy = $unidad->id_cotizacion;
        }

        if (isset($unidad->id_agencia)) {
            $id_agencia = $unidad->id_agencia;
        } else {
            $id_agencia = 0;
        }

        if (isset($unidad->valor)) {
            $valor = $unidad->valor;
        } else {
            $valor = 1;
        }

        if (isset($unidad->valor_pesos)) {
            $valor_pesos = $unidad->valor_pesos;
        } else {
            $valor_pesos = 0;
        }

        if (isset($unidad->valor_costo)) {
            $valor_costo = $unidad->valor_costo;
        } else {
            $valor_costo = 0;
        }

        if (isset($unidad->tipo)) {
            $tipo = $unidad->tipo;
        } else {
            $tipo = 'CONSULTAR';
        }

        if (isset($unidad->id_modelo)) {
            $id_modelo = $unidad->id_modelo;
        } else {
            $id_modelo = 0;
        }

        if (isset($unidad->anio)) {
            $anio = $unidad->anio;
        } else {
            $anio = '0000';
        }

        if (isset($unidad->kilometraje)) {
            $kilometraje = $unidad->kilometraje;
        } else {
            $kilometraje = 0;
        }

        if (isset($unidad->color)) {
            $color = $unidad->color;
        } else {
            $color = 'CONSULTAR';
        }

        if (isset($unidad->version)) {
            $version = $unidad->version;
        } else {
            $version = 'CONSULTAR';
        }

        if (isset($unidad->combustible)) {
            $combustible = $unidad->combustible;
        } else {
            $combustible = 'NAFTA';
        }

        if (isset($unidad->estado)) {
            $estado = $unidad->estado;
        } else {
            $estado = 0;
        }

        if (isset($unidad->localidad)) {
            $localidad = $unidad->localidad;
        } else {
            $localidad = 0;
        }

        if (isset($unidad->transmision)) {
            $transmision = $unidad->transmision;
        } else {
            $transmision = 'MT';
        }

        $sql = "SELECT * FROM unidades_lista
                WHERE id_agencia = $id_agencia AND id_cotizacion_lucy = $id_lucy";

        $verif = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));

        if (isset($unidad->kilometraje) && $unidad->kilometraje > 0) {

            $sql = "INSERT INTO
                        unidades_stock
                        (valor_publico_pesos, valor_costo, anio, kilometraje,
                        color, tipo, version, transmision ,combustible,
                        estado, id_modelo, id_localidad, activa, id_agencia, id_lucy)
                    values
                        ('$valor_pesos', '$valor_costo', '$anio','$kilometraje',
                        '$color', '$tipo', '$version', '$transmision' , '$combustible',
                        '$estado', '$id_modelo', '$localidad', '$valor', '$id_agencia', '$id_lucy')";
        } else {
            if (mysqli_num_rows($verif) == 0) {
                $sql = "INSERT INTO unidades_lista(fecha, id_modelo, id_agencia, version, color, moneda, precio, gastos, disponibilidad, activo, id_cotizacion_lucy)
                VALUES (CURDATE(), $id_modelo, $id_agencia, '$version', '$color', '0', '$valor_pesos', '0', 'INMEDIATA', '1', '$id_lucy')";
            } else {
                $sql = "UPDATE `unidades_lista` SET `fecha` = CURDATE(), `id_modelo` = $id_modelo, `id_agencia` = $id_agencia, `version` = '$version', `color` = '$color', `moneda` = '0', `precio` = '$valor_pesos', `gastos` = '0', `disponibilidad` = 'INMEDIATA', `activo` = $valor WHERE id_agencia = $id_agencia AND id_cotizacion_lucy = $id_lucy";
            }
        }

        $retorno = [];

        $insert = mysqli_query($this->conexion, $sql);
        $retorno[] = mysqli_insert_id($this->conexion);
        $retorno[] = mysqli_error($this->conexion);
        return $retorno;
        // return $insert;
    }

    public function insertImgs($unidad, $id_unidad_CA)
    {
        $this->conectar();
        $imgs = $unidad->imgs;
        $sql = "INSERT INTO
                    unidades_usadas_imgs
                    (id_unidad, urls)
                values
                    ('$id_unidad_CA','$imgs')";
        mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
    }

    public function updateImgs($unidad, $id_unidad_CA)
    {
        $this->conectar();
        $imgs = $unidad->imgs;
        $sql = "UPDATE
                    unidades_usadas_imgs
                SET
                    urls='$imgs'
                WHERE
                    id_unidad='$id_unidad_CA'";
        mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
    }

    public function unidadDetalle($id_unidad)
    {
        $this->conectar();
        $sql = "SELECT *, unidades_stock.id_unidad as id, unidades_stock.id_agencia as agencia
                FROM unidades_stock
                left join modelos on unidades_stock.id_modelo = modelos.id_modelo
                left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                left join agencias on unidades_stock.id_agencia = agencias.id_agencia
                left join localidades on agencias.id_localidad = localidades.id
                left join provincias on localidades.id_provincias = provincias.id
                left join unidades_usadas_imgs on unidades_stock.id_unidad = unidades_usadas_imgs.id_unidad
                left join favoritos on unidades_stock.id_unidad = favoritos.id_unidad
                WHERE agencias.acceso = 1 and unidades_stock.id_unidad = $id_unidad";
        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function unidadLocalidad($id_unidad)
    {
        $this->conectar();
        $sql = "SELECT *
        FROM `unidades_stock`
        left JOIN localidades on unidades_stock.id_localidad = localidades.id
        left JOIN provincias on provincias.id = localidades.id_provincias
        WHERE id_unidad = $id_unidad";
        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }


    public function unidadimg($id_unidad)
    {
        $this->conectar();
        $sql = "SELECT * FROM unidades_stock
                left join unidades_usadas_imgs on unidades_stock.id_unidad = unidades_usadas_imgs.id_unidad
                WHERE unidades_stock.id_unidad= $id_unidad";
        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }


    public function datosAgencia($usuario)
    {
        $this->conectar();
        $sql = "SELECT * from agencias
            left join localidades on agencias.id_localidad = localidades.id
            left join provincias on localidades.id_provincias = provincias.id
            left join marcas on agencias.id_marca = marcas.id_marcas
            WHERE usuario = '$usuario'";
        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    // PROXIMAMENTE CONSULTAS

    public function selectProximamenteDato()
    {
        $this->conectar();

        $sql = "SELECT * FROM `interacciones_proximamente`";

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion) . ' error en select proximamente dato');
        return $select;
    }

    public function insertProximamenteDato($id_usuario)
    {
        $this->conectar();

        $sql = "INSERT INTO `interacciones_proximamente`(`id_usuario`, `fecha`)
                VALUES ($id_usuario, CURDATE())";

        mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion) . ' error en insert proximamente dato');
    }

    // FIN | PROXIMAMENTE CONSULTAS

    public function favoritos($usuario)
    {
        $this->conectar();
        $sql = "SELECT * from favoritos
        left join agencias on favoritos.id_agencia = agencias.id_agencia
        left join unidades_stock on favoritos.id_unidad = unidades_stock.id_unidad
        left join modelos on unidades_stock.id_modelo = modelos.id_modelo
        left join marcas on modelos.id_modelo = marcas.id_marcas
        left join unidades_usadas_imgs on unidades_stock.id_unidad = unidades_usadas_imgs.id_unidad
        where agencias.acceso = 1 and usuario = '$usuario'";
        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function agregarFavorito($id_unidad, $id_agencia)
    {
        $this->conectar();
        $verificar = "select * from favoritos where id_agencia = $id_agencia and id_unidad = $id_unidad";
        $verificando = mysqli_query($this->conexion, $verificar) or die(mysqli_error($this->conexion));
        if (mysqli_num_rows($verificando) > 0) {
            $reg = mysqli_fetch_array($verificando);
            if ($reg['activo'] == 0) {
                $update = "UPDATE `favoritos` SET `activo`= 1  where id_agencia = $id_agencia and id_unidad = $id_unidad";
            } else {
                $update = "UPDATE `favoritos` SET `activo`= 0  where id_agencia = $id_agencia and id_unidad = $id_unidad";
            }

            mysqli_query($this->conexion, $update) or die(mysqli_error($this->conexion));
        } else {
            $sql = "INSERT INTO
            favoritos
            (id_agencia,id_unidad)
            VALUES
            ('" . $id_agencia . "','" . $id_unidad . "')";
            mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        }
    }
    public function iconoFavorito($id_usuario)
    {
        $this->conectar();
        $sql = "SELECT * FROM favoritos
        left join unidades_stock on unidades_stock.id_unidad = favoritos.id_unidad
        left join agencias on agencias.id_agencia = favoritos.id_agencia
        where usuario = '$id_usuario'";
        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function unidadesPublicada($usuario)
    {
        $this->conectar();
        $sql = "SELECT * from unidades_stock
        left join modelos on unidades_stock.id_modelo = modelos.id_modelo
        left join marcas on modelos.id_modelo = marcas.id_marcas
        left join agencias on unidades_stock.id_agencia = agencias.id_agencia
        left join unidades_usadas_imgs on unidades_usadas_imgs.id_unidad = unidades_usadas_imgs.id_unidad
        where agencias.acceso = 1 and nombre = '$usuario'";
        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function insertUnidadesVisitadas($unidad)
    {
        $this->conectar();
        $id_lucy = $unidad->id;
        $id_agencia = $unidad->id_agencia;
        $valor = $unidad->valor;
        $valor_pesos = $unidad->valor_pesos;
        $tipo = $unidad->tipo;
        $id_modelo = $unidad->id_modelo;
        $anio = $unidad->anio;
        $kilometraje = $unidad->kilometraje;
        $color = $unidad->color;
        $version = $unidad->version;
        $combustible = $unidad->combustible;
        $estado = $unidad->estado;
        $localidad = $unidad->localidad;

        $sql = "INSERT INTO
                    unidades_visitadas
                    (id_agencia,id_unidad)
                values
                    ('$valor_pesos','$anio')";
        mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return mysqli_insert_id($this->conexion);
    }

    public function consultaSimilares($tipo, $valor, $kilometros, $id_unidad_s)
    {
        $this->conectar();

        $sql = "SELECT * FROM unidades_stock
                left join agencias on unidades_stock.id_agencia = agencias.id_agencia
                left join unidades_usadas_imgs on unidades_stock.id_unidad = unidades_usadas_imgs.id_unidad
                left join modelos on unidades_stock.id_modelo = modelos.id_modelo
                left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                WHERE unidades_stock.tipo LIKE '%$tipo%'
                AND unidades_stock.valor_publico_pesos BETWEEN ($valor - 800000) AND ($valor + 800000)
                AND unidades_stock.kilometraje BETWEEN ($kilometros - 100000) AND ($kilometros + 100000)
                AND unidades_stock.id_unidad <> '$id_unidad_s'
                AND unidades_stock.activa = 1
                AND agencias.acceso = 1
                LIMIT 3";

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectProvinciaLocalidad($localidad, $provincia)
    {
        $this->conectar();

        $sql = "SELECT provincias.id as provincia, localidades.id as localidad from localidades
                left join provincias on localidades.id_provincias = provincias.id
                where localidades.localidad = '$localidad'
                and provincias.provincia = '$provincia'";

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectAgencias($id_agencia)
    {
        $this->conectar();

        $sql = "SELECT * FROM `agencias` where id_agencia = $id_agencia";

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    // CONSULTA AGENCIAS PARA SELECT DE FILTRO EXTENDIDO STOCK

    public function selectAgenciasFiltroStock()
    {
        $this->conectar();

        $sql = "SELECT * FROM agencias
                LEFT JOIN unidades_stock ON agencias.id_agencia = unidades_stock.id_agencia
                WHERE unidades_stock.activa = 1
                GROUP by agencias.id_agencia";

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }


    public function updateAgencia($id_agencia, $nombre_agencia, $direccion_agencia, $telefono_agencia, $usuario_agencia, $clave_agencia, $provincia_agencia, $localidad_agencia, $agencia_tipo, $url_membrete)
    {
        $this->conectar();

        $sql = "UPDATE agencias
                SET nombre = '$nombre_agencia',
                    direccion = '$direccion_agencia',
                    telefono = '$telefono_agencia',
                    usuario = '$usuario_agencia',
                    clave = '$clave_agencia',
                    id_provincia = $provincia_agencia,
                    id_localidad = $localidad_agencia,
                    agencia_tipo = $agencia_tipo,
                    url_membrete = '$url_membrete'

                WHERE id_agencia = $id_agencia";

        mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
    }

    // public function insertAgencia($id_agencia, $nombre_agencia, $direccion_agencia, $telefono_agencia, $usuario_agencia, $clave_agencia, $provincia_agencia, $localidad_agencia, $agencia_tipo){
    //     $this->conectar();

    //     $sql = "INSERT INTO agencias (nombre, direccion, telefono, usuario, clave, id_provincia, id_localidad, agencia_tipo)
    //             VALUES ('$nombre_agencia', '$direccion_agencia', '$telefono_agencia', '$usuario_agencia', '$clave_agencia', '$provincia_agencia', '$localidad_agencia', '$agencia_tipo')";

    //     mysqli_query($this->conexion,$sql) or die(mysqli_error($this->conexion));
    // }


    public function insertAgencia_ws($id_agencia, $nombre_agencia, $direccion_agencia, $telefono_agencia, $usuario_agencia, $clave_agencia, $provincia_agencia, $localidad_agencia, $agencia_tipo, $url_membrete)
    {
        $this->conectar();

        $sql = "INSERT INTO agencias (id_agencia, nombre, direccion, telefono, usuario, clave, id_provincia, id_localidad, agencia_tipo, url_membrete)
                VALUES ($id_agencia, '$nombre_agencia', '$direccion_agencia', '$telefono_agencia', '$usuario_agencia', '$clave_agencia', '$provincia_agencia', '$localidad_agencia', '$agencia_tipo', '$url_membrete')";

        mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
    }

    public function selectTipoAgencia_puto($id_empresa)
    {
        $this->conectar();

        $sql = "SELECT * FROM agencias WHERE id_agencia = $id_empresa";

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function verificaCotizacion($id_agencia, $id_cotizacion_lucy)
    {
        $this->conectar();

        $sql = "SELECT * FROM unidades_lista
                WHERE id_agencia = $id_agencia and id_cotizacion_lucy = $id_cotizacion_lucy";

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function insertPrecioLista($fecha, $id_modelo, $id_agencia, $version, $color, $moneda, $precio, $gastos, $disponibilidad, $activo, $id_cotizacion_lucy, $id_agencia_lucy_rom = null)
    {
        $this->conectar();

        if ($id_agencia_lucy_rom > 0) {
            $sql = "INSERT INTO unidades_lista(fecha, id_modelo, id_agencia, version, color, moneda, precio, gastos, disponibilidad, activo, id_cotizacion_lucy, id_agencia_lucy_rom)
            VALUES ('$fecha', $id_modelo, $id_agencia, '$version', '$color', '$moneda', '$precio', '$gastos', '$disponibilidad', $activo, $id_cotizacion_lucy, $id_agencia_lucy_rom)";
        } else {
            $sql = "INSERT INTO unidades_lista(fecha, id_modelo, id_agencia, version, color, moneda, precio, gastos, disponibilidad, activo, id_cotizacion_lucy)
            VALUES ('$fecha', $id_modelo, $id_agencia, '$version', '$color', '$moneda', '$precio', '$gastos', '$disponibilidad', $activo, $id_cotizacion_lucy)";
        }


        $query = mysqli_query($this->conexion, $sql);
        $retorno = "INSERT: id de agencia : $id_agencia | id de cotizacion : $id_cotizacion_lucy | ejecucion query : $query | error :" . mysqli_error($this->conexion);
        return $retorno;
    }


    public function updatePrecioLista($fecha, $id_modelo, $id_agencia, $version, $color, $moneda, $precio, $gastos, $disponibilidad, $activo, $id_cotizacion_lucy, $id_agencia_lucy_rom = null)
    {
        $this->conectar();

        $sql = "UPDATE `unidades_lista`
                SET `fecha`='$fecha', `id_modelo`=$id_modelo, `version`='$version',
                    `color`='$color', `moneda`='$moneda', `precio`='$precio', `gastos`='$gastos', `disponibilidad`='$disponibilidad',
                    `activo`=$activo, `id_agencia_lucy_rom`=$id_agencia_lucy_rom

                WHERE id_agencia = $id_agencia and id_cotizacion_lucy = $id_cotizacion_lucy";


        $query = mysqli_query($this->conexion, $sql);
        $retorno = "UPDATE: id de agencia : $id_agencia | id de cotizacion : $id_cotizacion_lucy | ejecucion query : $query | error :" . mysqli_error($this->conexion);
        return $retorno;
    }

    public function insertUsuarios($usuarios)
    {
        $this->conectar();

        $usuario = $usuarios->usuario;
        $clave = $usuarios->clave;
        $id_usuario = $usuarios->id_usuario;
        $id_agencia = $usuarios->id_agencia;
        $activo = $usuarios->activo;
        $token = $usuarios->token;

        $verificacion = "SELECT * FROM usuarios WHERE id_agencia = $id_agencia and id_usuario_lucy = $id_usuario";
        $select_verificacion = mysqli_query($this->conexion, $verificacion) or die(mysqli_error($this->conexion));

        if (mysqli_num_rows($select_verificacion) > 0) {
            $sql = "UPDATE `usuarios`
                        SET `usuario`='$usuario', `clave`='$clave', `activo`=$activo, `token`='$token'

                        WHERE id_agencia = $id_agencia and id_usuario_lucy = $id_usuario";

            mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion) . ' error en update');
        } else {
            if ($activo == 1) {
                $sql = "INSERT INTO `usuarios`(`usuario`, `clave`, `id_usuario_lucy`, `id_agencia`, `activo`, `token`)
                            VALUES ('$usuario', '$clave', $id_usuario, $id_agencia, $activo, '$token')";

                mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion) . ' error en insert');
            }
        }
    }

    // CONSULTAS PARA ECOMMERCE

    public function insertUsuarioEcommerce($nombre, $apellido, $telefono, $provincia, $localidad)
    {
        $this->conectar();

        $sql = "INSERT INTO `usuarios_ec`(`nombre`, `apellido`, `telefono`, `provincia`, `localidad`)
                    VALUES ('$nombre', '$apellido', '$telefono', '$provincia', '$localidad')";

        $insert = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion) . ' error en insert');

        $id_user = mysqli_insert_id($this->conexion);

        return $id_user;
    }

    public function insertUnidadParticular($id_usuario_ec, $anio_sa, $kilometraje_sa, $color_sa, $tipo_sa, $version_sa, $transmision_sa, $combustible_sa, $estado_sa, $id_modelo_sa, $localidad_sa, $titular_sa, $co_titular_sa, $danios_sa, $periodo_sa, $motorluz_sa, $parabrisas_sa, $pintura_sa, $tap_estado_sa, $tap_limpio_sa, $frio_sa, $caliente_sa, $neumaticos_sa, $accesorios_sa, $imagenes_sa)
    {
        $this->conectar();

        if ($imagenes_sa != '0') {
            $sql = "INSERT INTO `unidades_particulares`(`id_usuario_ec`, `anio`, `kilometraje`, `color`, `tipo`, `version`, `transmision`, `combustible`, `estado`, `id_modelo`, `localidad`, `es_titular`, `co_titular`, `danios`, `periodo_venta`, `motor_luz`, `parabrisas_detalle`, `pintura_estado`, `tapizado_estado`, `tapizado_limpio`, `aire_frio`, `aire_caliente`, `km_neumaticos`, `accesorios`, `imagenes`, `fecha_carga`, `fecha_edicion`, `moderado`, `activo`, `pausado`)
                VALUES ($id_usuario_ec, $anio_sa, $kilometraje_sa, '$color_sa', '$tipo_sa', '$version_sa', '$transmision_sa', '$combustible_sa', '$estado_sa', '$id_modelo_sa', '$localidad_sa', $titular_sa, $co_titular_sa, $danios_sa, $periodo_sa, $motorluz_sa, $parabrisas_sa, $pintura_sa, $tap_estado_sa, $tap_limpio_sa, $frio_sa, $caliente_sa, $neumaticos_sa, $accesorios_sa, '$imagenes_sa', CURDATE(), CURDATE(), '0', '1', '0')";
        } else {
            $sql = "INSERT INTO `unidades_particulares`(`id_usuario_ec`, `anio`, `kilometraje`, `color`, `tipo`, `version`, `transmision`, `combustible`, `estado`, `id_modelo`, `localidad`, `es_titular`, `co_titular`, `danios`, `periodo_venta`, `motor_luz`, `parabrisas_detalle`, `pintura_estado`, `tapizado_estado`, `tapizado_limpio`, `aire_frio`, `aire_caliente`, `km_neumaticos`, `accesorios`, `imagenes`, `fecha_carga`, `fecha_edicion`, `moderado`, `activo`, `pausado`)
                VALUES ($id_usuario_ec, $anio_sa, $kilometraje_sa, '$color_sa', '$tipo_sa', '$version_sa', '$transmision_sa', '$combustible_sa', '$estado_sa', '$id_modelo_sa', '$localidad_sa', $titular_sa, $co_titular_sa, $danios_sa, $periodo_sa, $motorluz_sa, $parabrisas_sa, $pintura_sa, $tap_estado_sa, $tap_limpio_sa, $frio_sa, $caliente_sa, $neumaticos_sa, $accesorios_sa, '$imagenes_sa', CURDATE(), CURDATE(), '1', '1', '0')";
        }

        $insert = mysqli_query($this->conexion, $sql) or die("Error datos");

        $id_vehiculo = mysqli_insert_id($this->conexion);

        return $id_vehiculo;
    }

    // FIN | CONSULTAS ECOMMERCE

    // CONSULTAS UNIDADES PARTICULARES

    public function selectUnidadParticular($id_modelo, $tipo_vehiculo = null, $marcaBuscada = null)
    {
        $this->conectar();

        if ($id_modelo != "No") {
            $sql = "SELECT * FROM `unidades_particulares`
                        left join modelos on unidades_particulares.id_modelo = modelos.id_modelo
                        left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                        left join usuarios_ec on unidades_particulares.id_usuario_ec = usuarios_ec.id_usuario_ec
                        where unidades_particulares.id_modelo = $id_modelo and unidades_particulares.activo = 1 and unidades_particulares.moderado = 1
                        ORDER BY unidades_particulares.id_unidad DESC";
        } else {

            if ($tipo_vehiculo == 1) {
                $condicion_categoria = " AND unidades_particulares.tipo not like '%CAMION%'";
            } else if ($tipo_vehiculo == 2) {
                $condicion_categoria = " AND unidades_particulares.tipo like '%CAMION%'";
            } else if ($tipo_vehiculo == 3) {
                $condicion_categoria = " AND unidades_particulares.tipo like '%MOTOCICLETA%'";
            } else {
                $condicion_categoria = "";
            }

            if ($marcaBuscada != null) {
                $condicion_marca = "AND marcas.id_marcas = $marcaBuscada";
            } else {
                $condicion_marca = "";
            }

            $sql = "SELECT * FROM `unidades_particulares`
                        left join modelos on unidades_particulares.id_modelo = modelos.id_modelo
                        left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                        left join usuarios_ec on unidades_particulares.id_usuario_ec = usuarios_ec.id_usuario_ec
                        where unidades_particulares.id_modelo <> 0
                        and unidades_particulares.activo = 1
                        and unidades_particulares.moderado = 1
                        $condicion_categoria
                        $condicion_marca
                        ORDER BY unidades_particulares.id_unidad DESC";
        }

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));

        return $select;
    }

    public function selectUnidadParticularFiltro()
    {
        $this->conectar();

        $sql = "SELECT * FROM `unidades_particulares`
                    left join modelos on unidades_particulares.id_modelo = modelos.id_modelo
                    left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                    left join usuarios_ec on unidades_particulares.id_usuario_ec = usuarios_ec.id_usuario_ec
                    where unidades_particulares.activo = 1 and unidades_particulares.moderado = 1
                    ORDER BY unidades_particulares.id_unidad DESC";

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion) . ' error en select usuarios');

        return $select;
    }

    public function unidadDetalleParticular($id_unidad)
    {
        $this->conectar();
        $sql = "SELECT * FROM `unidades_particulares`
                    left join modelos on unidades_particulares.id_modelo = modelos.id_modelo
                    left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                    left join usuarios_ec on unidades_particulares.id_usuario_ec = usuarios_ec.id_usuario_ec
                    left join colores on unidades_particulares.color = colores.id_color
                    where unidades_particulares.id_unidad = $id_unidad and unidades_particulares.moderado = 1";
        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function unidadLocalidadParticular($id_unidad)
    {
        $this->conectar();
        $sql = "SELECT localidad FROM `unidades_particulares`
                    WHERE id_unidad = $id_unidad";
        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function consultaSimilaresParticular($id_unidad_s)
    {
        $this->conectar();

        $unidad = "SELECT * FROM unidades_particulares
                        left join modelos on unidades_particulares.id_modelo = modelos.id_modelo
                        left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                        WHERE unidades_particulares.id_unidad = '$id_unidad_s'";

        $consulta = mysqli_query($this->conexion, $unidad) or die(mysqli_error($this->conexion) . ' aca');

        $reg = mysqli_fetch_array($consulta);
        $id_unidad = $reg['id_unidad'];
        $kilometraje = $reg['kilometraje'];
        $tipo = $reg['tipo'];

        $sql = "SELECT * FROM unidades_particulares
                    left join modelos on unidades_particulares.id_modelo = modelos.id_modelo
                    left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                    WHERE unidades_particulares.id_unidad <> '$id_unidad'
                    and unidades_particulares.kilometraje BETWEEN ($kilometraje - 200000) AND ($kilometraje + 200000)
                    and unidades_particulares.tipo = '$tipo'
                    AND unidades_particulares.activo = 1
                    and unidades_particulares.moderado = 1
                    ORDER BY unidades_particulares.id_unidad DESC
                    LIMIT 3";

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function imagenesParticulares($id_unidad)
    {
        $this->conectar();
        $sql = "SELECT * FROM unidades_particulares
                    WHERE id_unidad= $id_unidad";
        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function ubicacionesParticulares($ubicacion = NULL)
    {
        $this->conectar();

        if ($ubicacion == NULL) {
            $sql = "SELECT localidad FROM `unidades_particulares` GROUP BY localidad";
        } else {
            $sql = "SELECT localidad FROM `unidades_particulares` WHERE localidad = '$ubicacion' GROUP BY localidad";
        }

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectUnidadesBusquedaParticulares($id_modelo, $tipo, $kilometraje, $anio, $ubicacion, $combustible, $transmision, $color)
    {
        $this->conectar();
        $condicion_combustible = " AND combustible like '%$combustible%' ";
        $condicion_color = " AND color like '%$color%'";
        // $condicion_ubicacion = " AND provincias.id like '%$ubicacion%' " ;

        if ($tipo == 2) {
            $condicion_tipo = "AND unidades_particulares.kilometraje > 0";
        } else {
            $condicion_tipo = "AND unidades_particulares.kilometraje = 0";
        }

        // ajustar kilometraje
        switch ($kilometraje) {
            case 'hasta 20.000':
                $kilometraje = 20000;
                $min_kilometraje = 0;
                break;

            case 'hasta 50.000':
                $kilometraje = 50000;
                $min_kilometraje = 0;
                break;

            case 'hasta 100.000':
                $kilometraje = 100000;
                $min_kilometraje = 0;
                break;

            case '100.000 mas':
                $kilometraje = 100000;
                $min_kilometraje = 1;
                $condicion_tipo = "AND unidades_particulares.kilometraje > 100000";
                break;

            default:

                $min_kilometraje = 2;
                break;
        }

        if ($min_kilometraje == 1) {

            $condicionkm = "AND kilometraje > " . $kilometraje;
        } else if ($min_kilometraje == 0) {

            $condicionkm = "AND kilometraje < " . $kilometraje;
        } else {
            $condicionkm = '';
        }

        //ajustar anio
        switch ($anio) {
            case 'menor a 2010':
                $anio = "AND anio < 2010";
                break;

            case '2011 a 2013':
                $anio = "AND anio >= 2011 AND anio <= 2013";
                break;

            case '2014 a 2016':
                $anio = "AND anio >= 2014 AND anio <= 2016";
                break;

            case '2017 a 2019':
                $anio = "AND anio >= 2017 AND anio <= 2019";
                break;

            case 'mayor a 2020':
                $anio = "AND anio >= 2020";
                break;

            default:
                $anio = "";
                break;
        }

        if ($id_modelo != 'No') {
            $condicion_modelo = "unidades_particulares.id_modelo='$id_modelo' AND";
        } else {
            $condicion_modelo = "";
        }

        $this->conectar();
        $sql = "SELECT * FROM unidades_particulares
                    left join modelos as m on m.id_modelo=unidades_particulares.id_modelo
                    left join marcas on marcas.id_marcas=m.marcas_id_marcas
                    WHERE $condicion_modelo transmision like '%$transmision%' $condicionkm $anio
                    $condicion_combustible $condicion_color $condicion_tipo AND activo='1' and unidades_particulares.moderado = 1
                    ORDER BY unidades_particulares.imagenes DESC, unidades_particulares.id_unidad DESC, unidades_particulares.es_titular DESC";

        $select =  mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectUnidadesModerar()
    {
        $this->conectar();

        $sql = "SELECT * FROM `unidades_particulares`
                left join usuarios_ec on unidades_particulares.id_usuario_ec = usuarios_ec.id_usuario_ec
                left join modelos on unidades_particulares.id_modelo = modelos.id_modelo
                left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                where unidades_particulares.moderado = 0
                LIMIT 1";

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function updateUnidadesModerar($id_unidad_ec, $id_usuario_ec, $val, $valor)
    {
        $this->conectar();

        $sql = "UPDATE `unidades_particulares` SET `precio_moderado`= '$valor', `moderado` = '$val'
                    WHERE id_unidad = '$id_unidad_ec' AND id_usuario_ec = '$id_usuario_ec'";

        $update = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $update;
    }

    public function selectPerfilUnidadesEc($id_usuario, $id_unidad = NULL)
    {
        $this->conectar();

        if ($id_unidad == NULL) {
            $sql = "SELECT * FROM `unidades_particulares`
                        left join modelos on unidades_particulares.id_modelo = modelos.id_modelo
                        left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                        WHERE id_usuario_ec = '$id_usuario'";
        } else {
            $sql = "SELECT * FROM `unidades_particulares`
                        left join modelos on unidades_particulares.id_modelo = modelos.id_modelo
                        left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                        WHERE id_usuario_ec = '$id_usuario' and id_unidad = '$id_unidad'";
        }

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function updateUnidadPerfilEc($id_usuario, $id_unidad, $anio = '', $km = '', $color = '', $tipo = '', $transmision = '', $combustible = '', $imagenes = '')
    {
        $this->conectar();

        $parametros_update = '';

        if ($anio != '') {
            $parametros_update .= "anio = '$anio',";
        }
        if ($km != '') {
            $parametros_update .= "kilometraje = '$km',";
        }
        if ($color != '') {
            $parametros_update .= "color = '$color',";
        }
        if ($tipo != '') {
            $parametros_update .= "tipo = '$tipo',";
        }
        if ($transmision != '') {
            $parametros_update .= "transmision = '$transmision',";
        }
        if ($combustible != '') {
            $parametros_update .= "combustible = '$combustible',";
        }
        if ($imagenes != '') {
            $parametros_update .= "imagenes = '$imagenes',";
        }

        $parametros_update = substr($parametros_update, 0, -1);


        if ($parametros_update != '') {
            $sql = "UPDATE `unidades_particulares` 
                SET $parametros_update, fecha_edicion = CURDATE()
                WHERE unidades_particulares.id_usuario_ec = '$id_usuario' and unidades_particulares.id_unidad = '$id_unidad'";

            $update = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
            return $update;
        }
        else{
            return false;
        }

    }

    public function accionesUnidadEc($id_usuario_ec, $id_unidad, $accion, $valor){
        $this->conectar();

        if ($accion == 'pausar'){
            if (isset($valor) && $valor != ''){
                $sql = "UPDATE `unidades_particulares` 
                        SET `fecha_edicion` = CURDATE(), `pausado` = '$valor'
                        WHERE id_usuario_ec = $id_usuario_ec and id_unidad = $id_unidad";

                $update = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
                return $sql;
            }
            else{
                return false;
            }
        }
        else if ($accion == 'activo'){
            if (isset($valor) && $valor != ''){
                $sql = "UPDATE `unidades_particulares` 
                        SET `fecha_edicion` = CURDATE(), `activo` = '$valor'
                        WHERE id_usuario_ec = $id_usuario_ec and id_unidad = $id_unidad";
    
                $update = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
                return $update;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    // FIN | UNIDADES PARTICULARES

    // ALTA BAJA CLIENTES

    public function AltaBajaCliente($id_cliente, $accion)
    {
        $this->conectar();

        $sql = "UPDATE `agencias` SET `acceso` = '$accion' WHERE id_agencia = '$id_cliente'";

        $update = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
    }

    // FIN | ALTA BAJA CLIENTES

    // CONSULTAS PARA NUEVO FILTRO EXTENDIDO

    public function selectUnidadesUsadas($marca = null, $modelo = null, $categoria = null)
    {
        $this->conectar();

        if ($marca == null && $modelo == null) {
            if ($categoria != null) {
                switch ($categoria) {
                    case 'AutosYCamionetas':
                        $sql = "SELECT * FROM `unidades_stock`
                                left join unidades_usadas_imgs on unidades_stock.id_unidad = unidades_usadas_imgs.id_unidad
                                left join modelos on unidades_stock.id_modelo = modelos.id_modelo
                                left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                                where activa = 1 and kilometraje > 1 and unidades_stock.tipo != '%CAMION%'
                                order by unidades_usadas_imgs.urls DESC, unidades_stock.valor_publico_pesos ASC";
                        break;

                    case 'Camiones':
                        $sql = "SELECT * FROM `unidades_stock`
                                left join unidades_usadas_imgs on unidades_stock.id_unidad = unidades_usadas_imgs.id_unidad
                                left join modelos on unidades_stock.id_modelo = modelos.id_modelo
                                left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                                where activa = 1 and kilometraje > 1 and unidades_stock.tipo like '%CAMION%'
                                order by unidades_usadas_imgs.urls DESC, unidades_stock.valor_publico_pesos ASC";
                        break;

                    case 'Motos':
                        $sql = "SELECT * FROM `unidades_stock`
                                left join unidades_usadas_imgs on unidades_stock.id_unidad = unidades_usadas_imgs.id_unidad
                                left join modelos on unidades_stock.id_modelo = modelos.id_modelo
                                left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                                where activa = 1 and kilometraje > 1 and unidades_stock.tipo like '%MOTOCICLETA%'
                                order by unidades_usadas_imgs.urls DESC, unidades_stock.valor_publico_pesos ASC";
                        break;

                    default:
                        $sql = "SELECT * FROM `unidades_stock`
                                left join unidades_usadas_imgs on unidades_stock.id_unidad = unidades_usadas_imgs.id_unidad
                                left join modelos on unidades_stock.id_modelo = modelos.id_modelo
                                left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                                where activa = 1 and kilometraje > 1
                                order by unidades_usadas_imgs.urls DESC, unidades_stock.valor_publico_pesos ASC";
                        break;
                }
            } else {
                $sql = "SELECT * FROM `unidades_stock`
                        left join unidades_usadas_imgs on unidades_stock.id_unidad = unidades_usadas_imgs.id_unidad
                        left join modelos on unidades_stock.id_modelo = modelos.id_modelo
                        left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                        where activa = 1 and kilometraje > 1
                        order by unidades_usadas_imgs.urls DESC, unidades_stock.valor_publico_pesos ASC";
            }
        } else if ($marca != null && $modelo == null) {
            $sql = "SELECT * FROM `unidades_stock`
                    left join unidades_usadas_imgs on unidades_stock.id_unidad = unidades_usadas_imgs.id_unidad
                    left join modelos on unidades_stock.id_modelo = modelos.id_modelo
                    left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                    where activa = 1 and kilometraje > 1 and marcas.id_marcas = '$marca'
                    order by unidades_usadas_imgs.urls DESC, unidades_stock.valor_publico_pesos ASC";
        } else if ($marca != null && $modelo != null) {
            $sql = "SELECT * FROM `unidades_stock`
                    left join unidades_usadas_imgs on unidades_stock.id_unidad = unidades_usadas_imgs.id_unidad
                    left join modelos on unidades_stock.id_modelo = modelos.id_modelo
                    left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                    where activa = 1 and kilometraje > 1 and modelos.id_modelo = '$modelo'
                    order by unidades_usadas_imgs.urls DESC, unidades_stock.valor_publico_pesos ASC";
        }

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectUnidadesParticulares($marca = null, $modelo = null)
    {
        $this->conectar();

        if ($marca == null && $modelo == null) {
            $sql = "SELECT * FROM unidades_particulares
                    left join modelos on unidades_particulares.id_modelo = modelos.id_modelo
                    left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                    Where unidades_particulares.moderado = 1 and unidades_particulares.activo = 1
                    ORDER BY unidades_particulares.id_unidad DESC, unidades_particulares.imagenes DESC";
        } else if ($marca != null && $modelo == null) {
            $sql = "SELECT * FROM unidades_particulares
                    left join modelos on unidades_particulares.id_modelo = modelos.id_modelo
                    left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                    WHERE marcas.id_marcas = '$marca'
                    AND unidades_particulares.moderado = 1 and unidades_particulares.activo = 1
                    ORDER BY unidades_particulares.id_unidad DESC, unidades_particulares.imagenes DESC";
        } else if ($marca != null && $modelo != null) {
            $sql = "SELECT * FROM unidades_particulares
                    left join modelos on unidades_particulares.id_modelo = modelos.id_modelo
                    left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                    WHERE marcas.id_marcas = '$marca' and modelos.id_modelo = '$modelo'
                    AND unidades_particulares.moderado = 1 and unidades_particulares.activo = 1
                    ORDER BY unidades_particulares.id_unidad DESC, unidades_particulares.imagenes DESC";
        }
        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectUnidades0km($marca = null, $modelo = null)
    {
        $this->conectar();

        if ($marca == null && $modelo == null) {
            $sql = "SELECT * FROM `unidades_lista`
                    left join modelos on unidades_lista.id_modelo = modelos.id_modelo
                    left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                    left join agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
                    left join provincias on agencias_rom.id_provincia = provincias.id
                    left join localidades on agencias_rom.id_localidad = localidades.id
                    WHERE MONTH(unidades_lista.fecha) = MONTH(CURDATE())
                    AND unidades_lista.precio > 10000
                    ORDER BY unidades_lista.precio ASC";

            $sql2 = "SELECT * FROM `unidades_lista`
                    left join modelos on unidades_lista.id_modelo = modelos.id_modelo
                    left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                    left join agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
                    left join provincias on agencias_rom.id_provincia = provincias.id
                    left join localidades on agencias_rom.id_localidad = localidades.id
                    WHERE MONTH(unidades_lista.fecha) = MONTH(CURDATE())
                    AND unidades_lista.precio = 0
                    ORDER BY unidades_lista.precio ASC";
        } else if ($marca != null && $modelo == null) {
            $sql = "SELECT * FROM `unidades_lista`
                    left join modelos on unidades_lista.id_modelo = modelos.id_modelo
                    left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                    left join agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
                    left join provincias on agencias_rom.id_provincia = provincias.id
                    left join localidades on agencias_rom.id_localidad = localidades.id
                    WHERE MONTH(unidades_lista.fecha) = MONTH(CURDATE())
                    AND marcas.id_marcas = '$marca'
                    AND unidades_lista.precio > 10000
                    ORDER BY unidades_lista.precio ASC";

            $sql2 = "SELECT * FROM `unidades_lista`
                    left join modelos on unidades_lista.id_modelo = modelos.id_modelo
                    left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                    left join agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
                    left join provincias on agencias_rom.id_provincia = provincias.id
                    left join localidades on agencias_rom.id_localidad = localidades.id
                    WHERE MONTH(unidades_lista.fecha) = MONTH(CURDATE())
                    AND marcas.id_marcas = '$marca'
                    AND unidades_lista.precio = 0
                    ORDER BY unidades_lista.precio ASC";
        } else if ($marca != null && $modelo != null) {
            $sql = "SELECT * FROM `unidades_lista`
                    left join modelos on unidades_lista.id_modelo = modelos.id_modelo
                    left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                    left join agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
                    left join provincias on agencias_rom.id_provincia = provincias.id
                    left join localidades on agencias_rom.id_localidad = localidades.id
                    WHERE MONTH(unidades_lista.fecha) = MONTH(CURDATE())
                    AND marcas.id_marcas = '$marca' AND modelos.id_modelo = '$modelo'
                    AND unidades_lista.precio > 10000
                    ORDER BY unidades_lista.precio ASC";

            $sql2 = "SELECT * FROM `unidades_lista`
                    left join modelos on unidades_lista.id_modelo = modelos.id_modelo
                    left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                    left join agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
                    left join provincias on agencias_rom.id_provincia = provincias.id
                    left join localidades on agencias_rom.id_localidad = localidades.id
                    WHERE MONTH(unidades_lista.fecha) = MONTH(CURDATE())
                    AND marcas.id_marcas = '$marca' AND modelos.id_modelo = '$modelo'
                    AND unidades_lista.precio = 0
                    ORDER BY unidades_lista.precio ASC";
        }
        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        $select2 = mysqli_query($this->conexion, $sql2) or die(mysqli_error($this->conexion));
        $lista_resultados[] = $select;
        $lista_resultados[] = $select2;
        return $lista_resultados;
    }

    public function selectInfo0km($id_cotizacion)
    {
        $this->conectar();

        $sql = "SELECT unidades_lista.id_cotizacion, unidades_lista.fecha, unidades_lista.version, unidades_lista.precio, unidades_lista.color, unidades_lista.gastos, unidades_lista.disponibilidad, modelos.modelo_descri, marcas.marca_descri,
                if(agencias_rom.nombre is not null, agencias_rom.nombre, agencias.nombre) as 'nombre',
                if (agencias_rom.telefono is not null, agencias_rom.telefono, agencias.telefono) as 'telefono',
                if(agencias_rom.id_provincia is not null, agencias_rom.id_provincia, agencias.id_provincia ) as id_provincia_agencia, 
                (select provincias.provincia from provincias where provincias.id = id_provincia_agencia) as 'provincia',
                if(agencias_rom.id_localidad is not null, agencias_rom.id_localidad, agencias.id_localidad) as id_localidad_agencia, 
                (select localidades.localidad from localidades where localidades.id = id_localidad_agencia) as 'localidad',
                if(agencias_rom.direccion is not null, agencias_rom.direccion, agencias.direccion) as 'direccion'
                FROM `unidades_lista`
                left join modelos on unidades_lista.id_modelo = modelos.id_modelo
                left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                left join agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
                left join agencias on unidades_lista.id_agencia = agencias.id_agencia
                left join provincias on agencias_rom.id_provincia = provincias.id
                left join localidades on agencias_rom.id_localidad = localidades.id
                where unidades_lista.id_cotizacion = $id_cotizacion";

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    // FIN | CONSULTAS PARA NUEVO FILTRO EXTENDIDO

    // CONSULTAS PARA UNIDAD COMPARTIDA

    public function selectUnidadCompartida($tipo, $id)
    {
        $this->conectar();

        if ($tipo == '3') {
            $sql = "SELECT unidades_lista.id_cotizacion, unidades_lista.fecha, unidades_lista.version, unidades_lista.precio, unidades_lista.color, unidades_lista.gastos, unidades_lista.disponibilidad, modelos.modelo_descri, marcas.marca_descri,
                    if(agencias_rom.nombre is not null, agencias_rom.nombre, agencias.nombre) as 'nombre',
                    if (agencias_rom.telefono is not null, agencias_rom.telefono, agencias.telefono) as 'telefono',
                    if(agencias_rom.id_provincia is not null, agencias_rom.id_provincia, agencias.id_provincia ) as id_provincia_agencia, 
                    (select provincias.provincia from provincias where provincias.id = id_provincia_agencia) as 'provincia',
                    if(agencias_rom.id_localidad is not null, agencias_rom.id_localidad, agencias.id_localidad) as id_localidad_agencia, 
                    (select localidades.localidad from localidades where localidades.id = id_localidad_agencia) as 'localidad',
                    if(agencias_rom.direccion is not null, agencias_rom.direccion, agencias.direccion) as 'direccion'
                    FROM `unidades_lista`
                    left join modelos on unidades_lista.id_modelo = modelos.id_modelo
                    left join marcas on modelos.marcas_id_marcas = marcas.id_marcas
                    left join agencias_rom on unidades_lista.id_agencia_lucy_rom = agencias_rom.id_agencia
                    left join agencias on unidades_lista.id_agencia = agencias.id_agencia
                    left join provincias on agencias_rom.id_provincia = provincias.id
                    left join localidades on agencias_rom.id_localidad = localidades.id
                    where unidades_lista.id_cotizacion = $id";
        }

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    // FIN | CONSULTAS PARA UNIDAD COMPARTIDA

    public function select_ultimos_ingresos()
    {
        $this->conectar();

        $sql = "SELECT * 
        from (
            SELECT unidades_stock.id_unidad as id, if(unidades_stock.valor_publico_pesos > 0 , 0 , 1) as moneda ,if(unidades_stock.valor_publico_pesos > 0 , unidades_stock.valor_publico_pesos, unidades_stock.valor_publico_dolar) as precio, marcas.marca_descri, modelos.modelo_descri, unidades_stock.version, unidades_stock.anio, unidades_stock.kilometraje, unidades_stock.color, agencias.nombre, agencias.telefono , unidades_stock.combustible, unidades_usadas_imgs.urls as imagenes ,'Agencia' as tipo
            from unidades_stock, modelos, marcas, agencias, unidades_usadas_imgs
            WHERE unidades_stock.id_modelo = modelos.id_modelo and modelos.marcas_id_marcas = marcas.id_marcas and unidades_stock.id_agencia = agencias.id_agencia and unidades_stock.id_unidad = unidades_usadas_imgs.id_unidad and unidades_stock.activa = 1
            
            UNION ALL
            
            -- SELECT unidades_lista.id_cotizacion as id, unidades_lista.moneda, unidades_lista.precio, marcas.marca_descri, modelos.modelo_descri, unidades_lista.version, YEAR(CURDATE()), 0, unidades_lista.color, agencias_rom.nombre, agencias_rom.telefono, 'consultar', 'lista'
            -- from unidades_lista, modelos, marcas, agencias_rom
            -- WHERE unidades_lista.id_modelo = modelos.id_modelo and modelos.marcas_id_marcas = marcas.id_marcas and unidades_lista.id_agencia = agencias_rom.id_agencia
            
            -- UNION ALL
            
            SELECT unidades_particulares.id_unidad as id, 3, 'Consultar', marcas.marca_descri, modelos.modelo_descri, unidades_particulares.version, unidades_particulares.anio, unidades_particulares.kilometraje, colores.color, usuarios_ec.nombre, usuarios_ec.telefono , unidades_particulares.combustible, unidades_particulares.imagenes ,'Particular'
            FROM unidades_particulares, modelos, marcas, usuarios_ec, colores
            where unidades_particulares.id_modelo = modelos.id_modelo and modelos.marcas_id_marcas = marcas.id_marcas and unidades_particulares.id_usuario_ec = usuarios_ec.id_usuario_ec and unidades_particulares.color = colores.id_color and unidades_particulares.activo = 1
        ) as unidades
        WHERE imagenes != '' and imagenes != 'a:0:{}'
        ORDER by id desc";

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    // HISTORIAL CONSULTAS

    public function selectHistorialRegistroFechas($id_usuario)
    {
        $this->conectar();

        $sql = "SELECT MONTH(historial.fecha) as Mes, YEAR(historial.fecha) as Anio, historial.id_tipo_publicacion as Tipo, historial.fecha as 'Fecha' FROM historial
                WHERE historial.id_usuario = $id_usuario and historial.activo = 1
                GROUP BY Mes, Anio
                ORDER BY historial.fecha DESC";

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function selectHistorial($id_usuario, $mes, $fecha)
    {
        $this->conectar();

        $sql = "SELECT *
        FROM (
            SELECT unidades_stock.id_unidad as id, if(unidades_stock.valor_publico_pesos > 0 , 0 , 1) as moneda ,if(unidades_stock.valor_publico_pesos > 0 , unidades_stock.valor_publico_pesos, unidades_stock.valor_publico_dolar) as precio, marcas.marca_descri, modelos.modelo_descri, unidades_stock.version, unidades_stock.anio, unidades_stock.kilometraje, unidades_usadas_imgs.urls as imagenes ,'stock' as tipo, historial.fecha as historial_fecha
            from historial, unidades_stock, modelos, marcas, agencias, unidades_usadas_imgs
            WHERE unidades_stock.id_modelo = modelos.id_modelo and modelos.marcas_id_marcas = marcas.id_marcas and unidades_stock.id_agencia = agencias.id_agencia and unidades_stock.id_unidad = unidades_usadas_imgs.id_unidad and historial.id_publicacion = unidades_stock.id_unidad and historial.id_usuario = $id_usuario and historial.id_tipo_publicacion = 1 and MONTH(historial.fecha) = '$mes' and YEAR(historial.fecha) = YEAR('$fecha')  and historial.activo = 1
            
            UNION all
            
            SELECT unidades_particulares.id_unidad as id, 3, 'Consultar', marcas.marca_descri, modelos.modelo_descri, unidades_particulares.version, unidades_particulares.anio, unidades_particulares.kilometraje, unidades_particulares.imagenes ,'particular', historial.fecha as historial_fecha
            FROM historial, unidades_particulares, modelos, marcas, usuarios_ec, colores
            where unidades_particulares.id_modelo = modelos.id_modelo and modelos.marcas_id_marcas = marcas.id_marcas and unidades_particulares.id_usuario_ec = usuarios_ec.id_usuario_ec and unidades_particulares.color = colores.id_color and historial.id_publicacion = unidades_particulares.id_unidad and historial.id_usuario = $id_usuario and historial.id_tipo_publicacion = 3 and MONTH(historial.fecha) = '$mes' and YEAR(historial.fecha) = YEAR('$fecha') and historial.activo = 1
        ) as historial
        ORDER BY historial_fecha DESC";


        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function insertHistorialRegistro($id_usuario, $tipo_publicacion, $id_publicacion)
    {
        $this->conectar();

        $sql = "INSERT INTO `historial`(`id_usuario`, `id_tipo_publicacion`, `id_publicacion`, `fecha`, activo)
                VALUES ($id_usuario, $tipo_publicacion, $id_publicacion, NOW(), '1')";

        $insert = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $insert;
    }

    public function selectHistorialRegistro($id_usuario, $tipo_publicacion, $id_publicacion)
    {
        $this->conectar();

        $sql = "SELECT `id_historial`, `id_usuario`, `id_tipo_publicacion`, `id_publicacion`, `fecha` FROM `historial`
                WHERE historial.id_usuario = $id_usuario
                AND historial.id_tipo_publicacion = $tipo_publicacion
                AND historial.id_publicacion = $id_publicacion";

        $select = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $select;
    }

    public function updateHistorialRegistroFecha($id_usuario, $tipo_publicacion, $id_publicacion)
    {
        $this->conectar();

        $sql = "UPDATE `historial`
                SET `fecha` = NOW(), `activo` = 1
                WHERE historial.id_usuario = $id_usuario
                AND historial.id_tipo_publicacion = $tipo_publicacion
                AND historial.id_publicacion = $id_publicacion";

        $insert = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $insert;
    }

    public function updateVaciarHistorial($id_usuario){
        $this->conectar();

        $sql = "UPDATE `historial` SET `activo`= 0
                WHERE id_usuario = $id_usuario";

        $update = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion));
        return $update;
    }

    // FIN | HISTORIAL CONSULTAS

}
