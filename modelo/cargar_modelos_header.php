<?php
include_once("modelo.php");
$modelo=new Modelo();

// echo $_POST['id_marca'];
// echo "anda";

if ($_POST['id_marca'] != "No"){
    $modelos = $modelo->selectModelos($_POST['id_marca']);
    ?>
    <select name="modelo" id="modelo_header" required style="border: none; width: 10.9rem; height: 38px; text-align: center; background: white; color: grey; border: 0px; outline: none;" >
        <option value="" class="formDesktopOption" >MODELO</option>
        <option value="No" class="formDesktopOption" >TODOS</option>
        <?php 
            while($reg_modelo = mysqli_fetch_array($modelos)){
                ?>
                <option value="<?php echo $reg_modelo['id_modelo']; ?>" class="formDesktopOption" ><?php echo $reg_modelo['modelo_descri']; ?></option>
                <?php
            }
        ?>
    </select>
    <?php
}else{
    ?>
    <select name="modelo" id="modelo_header" style="border: none; width: 10.9rem; height: 38px; text-align: center; background: white; color: grey; border: 0px; outline: none;" >
        <option value="" class="formDesktopOption" >MODELO</option>
        <option value="No" class="formDesktopOption" selected >TODOS</option>
    </select>
    <?php
}
