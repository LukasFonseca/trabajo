<?php
include_once("../modelo/modelo.php");
$modelo=new Modelo();

$modelo->agregarFavorito($_POST['unidad'], $_POST['agencia']);
$unidadDetalle=$modelo->unidadDetalle($_POST['unidad']);
$reg=mysqli_fetch_array($unidadDetalle);

if(isset($_POST['moneda']) || isset($_POST['preciomin']) || isset($_POST['preciomax']) || isset($_POST['km']) || isset($_POST['anio']) || isset($_POST['ubicacion']) || isset($_POST['combustible']) || isset($_POST['transmision']) || isset($_POST['moneda'])){
    $modelo_unidad=$_POST['modelo'];
    $moneda=$_POST['moneda'];
    if ($_POST['preciomin'] == '') {
        $preciomin= 0;
    }
    else{
        $preciomin=$_POST['preciomin'];
    }

    if ($_POST['preciomax'] == '') {
        $preciomax= 10000000000000000000000000;
    }
    else{
        $preciomax=$_POST['preciomax'];
    }

    $kilometraje=$_POST['km'];
    $anio=$_POST['anio'];
    $ubicacion=$_POST['ubicacion'];
    $combustible=$_POST['combustible'];
    $transmision=$_POST['transmision'];
    $color=$_POST['color'];

    // echo $modelo_unidad .' | '. $moneda .' | '. $preciomin .' | '. $preciomax .' | '. $kilometraje .' | '. $anio .' | '. $ubicacion .' | '. $combustible .' | '. $transmision .' | '. $color;

    $unidades_favorito = $modelo->selectUnidadesbusqueda($modelo_unidad, $moneda, $_POST['tipo'] , $preciomin, $preciomax, $kilometraje, $anio, $ubicacion, $combustible, $transmision, $color);
}

$unidades=$modelo->selectUnidadesStock($_POST['modelo'], $_POST['tipo']);



if (isset($_POST['pagina']) && $_POST['pagina'] == 1) {
    $pagina='detalle';
}
else if ( isset($_POST['pagina']) && $_POST['pagina'] == 2) {
    $pagina='fav';
}
else {
    $pagina='stock';
}


switch ($pagina) {
    case 'stock':
        ?>
         <!-- Felo: Grilla de productos -->
        <!-- stock -->
         <section class="products-list seccion-stock-productos">
            <div style="min-height: 714px; width: 100%;">
            <?php
            while($reg_unidades=mysqli_fetch_array($unidades)){
                $imagenes=unserialize($reg_unidades['urls']);
                ?>
                <div class="product-item overflow-hidden div-seccion-product" style="height: auto;">
                    <div class="div-fondo-item item-stock">
                        <div class="div-fijo div-fijo-stock" style="">
                            <a href="detalle-producto.php?id_unidad=<?php echo $reg_unidades['id']; ?>">
                                <?php
                                if($imagenes[0]!=''){
                                    ?>
                                    <img class="img-fluid" src="<?php echo $imagenes[0] ?>">
                                    <?php
                                }else{
                                    ?>
                                    <img class="img-fluid" src="assets/img/producto-sin-imagen.png">
                                    <?php
                                }
                                ?>
                            </a>

                            <a href="javascript:favorito(<?php echo $reg_unidades['id']?>, <?php echo $reg_unidades['agencia']?>)"class="btn-fav btn-fav-stock">
                            <?php
                            if($reg_unidades['activo']==1){
                                ?>
                                <img src="assets/img/btn-fav-hover.png" id="click" class="btn-fav-img">
                                <?php
                            }else{
                                ?>
                                <img src="assets/img/btn-fav.png" class="btn-fav-img">
                                <?php
                            }
                            ?>

                            </a>
                        </div>
                    </div>
                    <!-- AGREGUE NUEVA CLASE -->
                    <div style="display: grid; grid-template-columns: 3.5fr 1.5fr; margin: 1em; row-gap: 10px;" class="grilla-productos">
                        <div>
                            <b><?php echo $reg_unidades['marca_descri'] ?> | <?php echo $reg_unidades['modelo_descri'] ?></b>
                        </div>
                        <div style="text-align: center; background-color: #F00353; border-radius: 15px; color: #fff;">
                            $ <?php echo $reg_unidades['valor_publico_pesos'] ?>
                        </div>
                        <div style="grid-column: 1/-1; overflow: hidden; text-overflow: ellipsis;">
                            <?php echo $reg_unidades['version'] ?> | <?php echo $reg_unidades['anio'] ?> - <?php echo $reg_unidades['kilometraje'] ?>KM
                        </div>
                    </div>
                    <!-- AGREGUE NUEVO DIV  -->
                    <div class="datos_productos">
                        <p class="p-modelo">
                            <b><?php echo $reg_unidades['marca_descri'] ?> | <?php echo $reg_unidades['modelo_descri'] ?></b>
                            <span class="span-marca">$ <?php echo $reg_unidades['valor_publico_pesos'] ?> </span>
                        </p>
                            <p class="p-marca"> <?php echo $reg_unidades['version'] ?> | <?php echo $reg_unidades['anio'] ?> - <?php echo $reg_unidades['kilometraje'] ?>KM
                        </p>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
            <!-- Paginado -->
            <?php
                $CantidadMostrar=10;
            ?>
            <div class="paginacion">
                <ul class="pagination">
                    <li><a href="#">«</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li class="nomovil"><a href="#">6</a></li>
                    <li class="nomovil"><a href="#">7</a></li>
                    <li class="nomovil"><a href="#">8</a></li>
                    <li><a href="#">»</a></li>
                </ul>
            </div>
        </section>
        <?php

        break;

    case 'fav':
        ?>
            <!-- Felo: Grilla de productos -->
            <!-- fav -->
            <section class="products-list seccion-stock-productos">
            <div style="min-height: 714px; width: 100%;">
            <?php
            while($reg_unidades=mysqli_fetch_array($unidades_favorito)){
                $imagenes=unserialize($reg_unidades['urls']);
                ?>
                <div class="product-item overflow-hidden div-seccion-product" style="height: auto;">
                    <div class="div-fondo-item item-stock">
                        <div class="div-fijo div-fijo-stock" style="">
                            <a href="detalle-producto.php?id_unidad=<?php echo $reg_unidades['id']; ?>">
                                <?php
                                if($imagenes[0]!=''){
                                    ?>
                                    <img class="img-fluid" src="<?php echo $imagenes[0] ?>">
                                    <?php
                                }else{
                                    ?>
                                    <img class="img-fluid" src="assets/img/producto-sin-imagen.png">
                                    <?php
                                }
                                ?>
                            </a>

                            <a href="javascript:favorito(<?php echo $reg_unidades['id']?>, <?php echo $reg_unidades['agencia']?>)"class="btn-fav btn-fav-stock">
                            <?php
                            if($reg_unidades['activo']==1){
                                ?>
                                <img src="assets/img/btn-fav-hover.png" id="click" class="btn-fav-img">
                                <?php
                            }else{
                                ?>
                                <img src="assets/img/btn-fav.png" class="btn-fav-img">
                                <?php
                            }
                            ?>

                            </a>
                        </div>
                    </div>
                    <!-- AGREGUE NUEVA CLASE -->
                    <div style="display: grid; grid-template-columns: 3.5fr 1.5fr; margin: 1em; row-gap: 10px;" class="grilla-productos">
                        <div>
                            <b><?php echo $reg_unidades['marca_descri'] ?> | <?php echo $reg_unidades['modelo_descri'] ?></b>
                        </div>
                        <div style="text-align: center; background-color: #F00353; border-radius: 15px; color: #fff;">
                            $ <?php echo number_format($reg_unidades['valor_publico_pesos'], 0, ',', '.'); ?>
                        </div>
                        <div style="grid-column: 1/-1; overflow: hidden; text-overflow: ellipsis;">
                            <?php echo $reg_unidades['version'] ?> | <?php echo $reg_unidades['anio'] ?> - <?php echo number_format($reg_unidades['kilometraje'], 0, ',', '.'); ?>KM
                        </div>
                    </div>
                    <!-- AGREGUE NUEVO DIV  -->
                    <div class="datos_productos">
                        <p class="p-modelo">
                            <b><?php echo $reg_unidades['marca_descri'] ?> | <?php echo $reg_unidades['modelo_descri'] ?></b>
                            <span class="span-marca">$ <?php echo number_format($reg_unidades['valor_publico_pesos'], 0, ',', '.'); ?> </span>
                        </p>
                            <p class="p-marca"> <?php echo $reg_unidades['version'] ?> | <?php echo $reg_unidades['anio'] ?> - <?php echo number_format($reg_unidades['kilometraje'], 0, ',', '.'); ?>KM
                        </p>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
            <!-- Paginado -->
            <?php
                $CantidadMostrar=10;
            ?>
            <div class="paginacion">
                <ul class="pagination">
                    <li><a href="#">«</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li class="nomovil"><a href="#">6</a></li>
                    <li class="nomovil"><a href="#">7</a></li>
                    <li class="nomovil"><a href="#">8</a></li>
                    <li><a href="#">»</a></li>
                </ul>
            </div>
        </section>
        <?php

        break;

    case 'detalle':
        ?>

            <p class="p-container-vehiculo-marca"><b><?php echo $reg['marca_descri']?> <br>
                <?php echo $reg['modelo_descri']?></b></p>
            <p class="p-container-vehiculo-año"> <?php echo $reg['anio']?>- <?php echo  number_format($reg['kilometraje'], 0, ',', '.');?> KM </p>
            <p class="p-container-vehiculo-precio">$<?php   if ($reg['valor_publico_pesos'] == 0 && $reg['valor_publico_dolar'] == 0) {
                                                                echo number_format($reg['valor_costo'], 0, ',', '.') ; 
                                                            }else{
                                                                echo number_format($reg['valor_publico_pesos'], 0, ',', '.') ; 
                                                            }
                                                            
                                                            ?></p>
            <a href="javascript:favorito(<?php echo $reg['id']?>, <?php echo $reg['agencia']?>)" class="btn-fav btn-fav-stock">

            <?php
            if($reg['activo']==1){
                ?>
                <img src="assets/img/btn-fav-hover.png" id="click" class="btn-fav-img">
                <?php
            }else{
                ?>
                <img src="assets/img/btn-fav.png" class="btn-fav-img">
                <?php
            }
            ?>
            </a>


        <?php
        break;
    }
?>



