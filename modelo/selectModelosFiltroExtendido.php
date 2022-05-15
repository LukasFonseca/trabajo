<?php
include_once("modelo.php");
$modelo=new Modelo();

// echo $_POST['id'];
// echo "anda";

if ($_POST['id'] != "No"){
    $modelos = $modelo->selectModelos($_POST['id']);
    ?>
    <select name="modelo" class="select-filtro-extendido" required>
        <option value="" >MODELO</option>
        <option value="No" >TODOS</option>
        <?php 
            while($reg_modelo = mysqli_fetch_array($modelos)){
                ?>
                <option value="<?php echo $reg_modelo['id_modelo']; ?>" ><?php echo $reg_modelo['modelo_descri']; ?></option>
                <?php
            }
        ?>
    </select>
    <?php
}else{
    ?>
    <select name="modelo" class="select-filtro-extendido" required>
        <option value="" >MODELO</option>
        <option value="No" selected >TODOS</option>
    </select>
    <?php
}
