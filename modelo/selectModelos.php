<?php
include_once("modelo.php");
$modelo=new Modelo();

$result = $modelo->selectModelos($_POST['id']);
if ($_POST['id'] != "No"){ ?>

<select name="modelo" id="slt-modelos" class="main-form--select shadow-one" required >
    <option value="">MODELO</option>
    <option value="No">TODOS</option>
    <?php
    while (($fila = mysqli_fetch_array($result)) != NULL) {
        echo '<option value="'.$fila["id_modelo"].'">'.$fila["modelo_descri"].'</option>';
    }
    ?>
</select>
<?php 
}else{?>
    <select name="modelo" id="slt-modelos" required class="main-form--select shadow-one">
        <option value="No">TODOS</option>
    </select>
<?php
}
?>
<div class="validate"></div>