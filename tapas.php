<?php
    session_start();
    require_once("gestionBD.php");
    require_once("gestionar_inventario.php");

    if (isset($_SESSION["inventario"])){
        $inventario = $_SESSION["inventario"];
        unset($_SESSION["inventario"]);
    }
    
    if(!isset($_SESSION['login']))
        Header("Location: login.php");
    else{
    $conexion = crearConexionBD();
    $usuario = $_SESSION['login'];
    $filas = consultarTapas($conexion);
    
    cerrarConexionBD($conexion);
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>TAPAS</title>
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.css">
</head>
<body style="background: #0f2027; background: linear-gradient(to right,#2c5364, #203a43, #0f2027")>
<div style="margin-top:40px; margin-bottom: 50px"><h1 style="font-size:40px; color:#5F9EA0; text-align: center">BAR LA CAMPIÑA</h1></div> 
    <?php foreach($filas as $fila) {
        ?>
        
    <article>
        <form method="post" action="controlador_inventario.php">
            <div style="margin-left:38%" class="data_and_buttons"> 
                <div class="datos_proveedores">     
                    <input id="OIDTAP" name="OIDTAP"
                        type="hidden" value="<?php echo $fila["OIDTAP"]; ?>"/>
                    <input id="PRECIOTAPAS" name="PRECIOTAPAS"
                        type="hidden" value="<?php echo $fila["PRECIOTAPAS"]; ?>"/>
                    <input id="NOMBRETAPAS" name="NOMBRETAPAS"
                        type="hidden" value="<?php echo $fila["NOMBRETAPAS"]; ?>"/>

                                
                    <?php
                    if ($fila["OIDTAP"] != "") { ?>
                        <div><span>Nº de tapa: <?php echo $fila["OIDTAP"]?></span><span style="margin-left: 20px">Precio de la Tapa: <?php echo $fila["PRECIOTAPAS"]?></span><span>Nombre: <?php echo $fila["NOMBRETAPAS"]?></span></div>

                <?php } ?>
             
            </div>
          </div>       
        </form>
    </article>
            
        <?php }
        ?>

    <div style = "float:right; margin-top: 20px; margin-right: 38%">
        <button  onclick="location.href='form_insercion_tapa.php';" class="ui button">
            <i class="icon user"></i>
            Añadir Tapa
        </button>
    </div> 
    <div style = "float:right; margin-top: 20px; margin-right: 10%">
        <button  onclick="location.href='form_eliminacion_tapa.php';" class="ui button">
            <i class="icon user"></i>
            Eliminar Tapa
        </button>
    </div>  
    
    <div style="color:grey;padding-top:5em;clear:right;font-weight:bold;font-size:16px;text-align: center">Pulsa <a href="inventario.php">aquí</a> para regresar a Inventario.</div>

<?php
    include_once("pie.php");
?>

</body>
</html>