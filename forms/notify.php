<?php
  session_start();

  include_once("../modelo/modelo.php");
  $modelo=new Modelo();

  include_once("../vista/vista.php");
  $vista=new Vista();


  if(isset($_SESSION['user'])) {

    $tipo=$_POST['tipo'];
    $id_modelo=$_POST['modelo'];
    $id_marca=$_POST['marca'];


    switch ($tipo) {
      case '1':
        ?>
        
        <script>
          $("#myModal").modal('hide');
        </script>

        <?php
      case '2':
        $url='filtro-extendido.php?modelo='.$id_modelo.'&tipo='.$tipo.'&marca='.$id_marca;
        ?>
        
        <script>
          $("#myModal").modal('hide');
        </script>

        <?php
        break;
      case '3':
        $url='filtro-extendido.php?modelo='.$id_modelo.'&tipo='.$tipo.'&marca='.$id_marca;
        ?>
        
        <script>
          $("#myModal").modal('hide');
        </script>

        <?php
        break;
      case '4':
        $url='filtro-extendido.php?modelo='.$id_modelo.'&tipo='.$tipo.'&marca='.$id_marca;
        ?>
        
        <?php
    }

    // echo $url;

    ?>
    
    <script>
      //  $("#myModal").modal('hide');
      window.location.href ='../<?php echo $url; ?>';
    </script>

    <?php

  } else {
    
    $vista->printLoginForm();
  }

?>
