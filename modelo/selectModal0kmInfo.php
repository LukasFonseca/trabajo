<?php
include_once("modelo.php");
$modelo=new Modelo();

// echo $_POST['id'];

$info_0km = $modelo->selectInfo0km($_POST['id']);

$reg_info0km = mysqli_fetch_array($info_0km);

?>

<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <!-- <div class="modal-header">
            
        </div> -->
        <div class="modal-body">
            <div style="margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: center;">
                <div>

                </div>
                <div style="font-size: 20px;">
                    Datos del vehículo
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <table class="table table-bordered table-hover tabla-info0km">
                <tr>
                    <td>
                        <b>Marca:</b>
                    </td>
                    <td class="td-tabla-info0km">
                        <?php echo $reg_info0km['marca_descri'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Modelo:</b>
                    </td>
                    <td class="td-tabla-info0km">
                        <?php echo $reg_info0km['modelo_descri'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Versión:</b>
                    </td>
                    <td class="td-tabla-info0km">
                        <?php echo $reg_info0km['version'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Colores:</b>
                    </td>
                    <td class="td-tabla-info0km">
                        <?php if ($reg_info0km['color'] != ''){ echo $reg_info0km['color']; } else{ echo "A CONSULTAR"; } ?>
                    </td>
                </tr>
                <tr style="background: #56e481;">
                    <td>
                        <b>Precio:</b>
                    </td>
                    <td>
                        <?php if ($reg_info0km['precio'] > 0){ echo '<b>$</b>' . number_format($reg_info0km['precio'], 0, ',', '.'); } else{ echo "A CONSULTAR"; } ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Flete y formularios:</b>
                    </td>
                    <td class="td-tabla-info0km">
                        <?php if ($reg_info0km['gastos'] > 0){ echo '<b>$</b>' . number_format($reg_info0km['gastos'], 0, ',', '.'); } else{ echo "A CONSULTAR"; } ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Disponibilidad:</b>
                    </td>
                    <td class="td-tabla-info0km">
                        <?php echo $reg_info0km['disponibilidad']; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Fecha de cotización:</b>
                    </td>
                    <td>
                    <?php echo $reg_info0km['fecha']; ?>
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
                        <b><?php echo $reg_info0km['nombre'] ?></b>
                    </td>
                </tr>
                <tr style="background: #F00353; color: white;">
                    <td>
                        <b>Teléfono:</b>
                    </td>
                    <td>
                        <?php 
                        if (strpos($reg_info0km['telefono'], '+54') === true) {
                            ?>
                            <a href="tel: + <?php echo $reg_info0km['telefono'] ?>" title="Llamar a este número">
                                <img src="assets/img/phone-1.svg" alt="Whatsapp" srcset="" style="width:21px;">
                                <?php echo $reg_info0km['telefono'] ?>
                            </a>
                            <a href="https://api.whatsapp.com/send/?phone=<?php echo $reg_info0km['telefono'] ?>?&text=Vi%20tu%20auto%20en%20*Comunidauto*!%20Me%20interesa%20saber%20más." class="mx-2" target="_blank">
                                <img src="assets/img/whatsapp.svg" alt="Whatsapp" title="Enviar un Whatsapp" srcset="" style="width:21px;">
                            </a>
                            <?php
                        }
                        else{
                            ?>
                            <a href="tel: + <?php echo $reg_info0km['telefono'] ?>" title="Llamar a este número">
                                <img src="assets/img/phone-1.svg" alt="Whatsapp" srcset="" style="width:21px;">
                                <?php echo $reg_info0km['telefono'] ?>
                            </a>
                            <a href="https://api.whatsapp.com/send/?phone=+54<?php echo $reg_info0km['telefono']; ?>?&text=Vi%20este%20auto%20en%20*Comunidauto* y me interesó.%20https://www.comunidauto.net.ar/ca11/unidad_compartida.php?id=<?php echo $reg_info0km['id_cotizacion'] . '%26tipo=3'; ?>" class="mx-2" target="_blank">
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
                            if ($reg_info0km['localidad'] != '') {
                                echo $reg_info0km['provincia'] . ' | ' . $reg_info0km['localidad'];
                            } else {
                                echo $reg_info0km['provincia'];
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Dirección:</b>
                    </td>
                    <td>
                        <?php echo $reg_info0km['direccion'] ?>
                    </td>
                </tr>
            </table>
        </div>
        <!-- <div class="modal-footer">

        </div> -->
    </div>
</div>