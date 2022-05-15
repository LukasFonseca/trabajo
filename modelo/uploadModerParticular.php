<?php 

include_once("modelo.php");
$modelo=new Modelo();

if (isset($_POST['dar_alta'])){
    $modelo->updateUnidadesModerar($_POST['id_unidad'], $_POST['id_usuario_ec'], '1', $_POST['valor-calculado']);
    ?>
    <script>
        window.location.href="../moder_particular.php";
    </script>
    <?php
}

if (isset($_POST['dar_baja'])){
    $modelo->updateUnidadesModerar($_POST['id_unidad'], $_POST['id_usuario_ec'], '2', $_POST['valor-calculado']);
    // HACER WS PARA DECIRLE A ENZO QUE REPORTE AL USUARIO
    ?>
    <script>
        window.location.href="../moder_particular.php";
    </script>
    <?php
}

if (!isset($_POST['dar_baja']) && !isset($_POST['dar_alta'])){
    ?>
    <script>
        alert("No se ha seleccionado ninguna acción");
        history.back();
        // window.location.href="../moder_particular.php";
    </script>
    <?php
}

?>