<?php
include_once("modelo.php");
$modelo=new Modelo();

$modelo_unidad = $_POST['modelo'];
$condicionkm = $_POST['condicionkm'];
$moneda = $_POST['moneda'];
$preciomin = $_POST['preciomin'];
$preciomax = $_POST['preciomax'];
$anio = $_POST['anio'];
$ubicacion = $_POST['ubicacion'];
$combustible = $_POST['combustible'];
$color = $_POST['color'];


$result = $modelo->selectUnidadesbusqueda($modelo_unidad, $moneda, $condicionkm, $preciomin, $preciomax, $anio, $ubicacion, $combustible, $color);
?>

        <div class="store-wrapper" >
            <section class="products-list seccion-stock-productos">
                <div style="min-height: 714px; width: 100%;">
                <?php
                while($reg=mysqli_fetch_array($result)){
                    $imagenes=unserialize($reg['urls']);
                    ?>
                    <div class="product-item overflow-hidden div-seccion-product" style="height: auto;">
                        <div class="div-fondo-item item-stock">
                            <div class="div-fijo div-fijo-stock" style="">
                                <a href="detalle-producto.php">
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
                                <a href="#" class="btn-fav btn-fav-stock">
                                    <img src="assets/img/btn-fav.png" class="btn-fav-img">
                                </a>
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 3.5fr 1.5fr; margin: 1em; row-gap: 10px;">
                            <div>
                                <b><?php echo $reg['marca_descri'] ?> | <?php echo $reg['modelo_descri'] ?></b>
                            </div>
                            <div style="text-align: center; background-color: #F00353; border-radius: 15px; color: #fff;">
                                $ <?php echo $reg['valor_publico_pesos'] ?>
                            </div>
                            <div style="grid-column: 1/-1; overflow: hidden; text-overflow: ellipsis;">
                                <?php echo $reg['version'] ?> | <?php echo $reg['anio'] ?> - <?php echo $reg['kilometraje'] ?>KM
                            </div>
                        </div>

                        <p class="p-modelo">
                            <b><?php echo $reg['marca_descri'] ?> | <?php echo $reg['modelo_descri'] ?></b>
                            <span class="span-marca">$ <?php echo $reg['valor_publico_pesos'] ?> </span>
                        </p>
                            <p class="p-marca"> <?php echo $reg['version'] ?> | <?php echo $reg['anio'] ?> - <?php echo $reg['kilometraje'] ?>KM </p>
                    </div>
                    <?php
                }
                ?>
                </div>
                 <!-- Paginado -->
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
        </div>
