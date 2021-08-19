<?php
    session_start();
    require_once("gestionBD.php");
    require_once("gestionar_gestion.php");

    if (isset($_SESSION["gestion"])){
        $gest = $_SESSION["gestion"];
        unset($_SESSION["gestion"]);
    }
    
    if(!isset($_SESSION['login']))
        Header("Location: login.php");
    else{
    $conexion = crearConexionBD();
    $usuario = $_SESSION['login'];
    $filas = consultarGastosFijos($conexion);
    cerrarConexionBD($conexion);
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>GASTOS FIJOS</title>
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.css">
</head>
<body style="background: #0f2027; background: linear-gradient(to right,#2c5364, #203a43, #0f2027")>
<div style="margin-top:40px; margin-bottom: 50px"><h1 style="font-size:40px; color:#5F9EA0; text-align: center">BAR LA CAMPIÑA</h1></div> 
    <?php foreach($filas as $fila) {
        ?>
        
    <article>
        <form method="post" action="controlador_gestion.php">
            <div style="margin-left:38%" class="data_and_buttons"> 
                <div class="datos_proveedores">     
                    <input id="MESAGUALUZ" name="MESAGUALUZ"
                        type="hidden" value="<?php echo $fila["MESAGUALUZ"]; ?>"/>
                    <input id="CANTIDADAGUALUZ" name="CANTIDADAGUALUZ"
                        type="hidden" value="<?php echo $fila["CANTIDADAGUALUZ"]; ?>"/>
                    <input id="ALQUILER" name="ALQUILER"
                        type="hidden" value="<?php echo $fila["ALQUILER"]; ?>"/>

                                
                    <?php
                    if ($fila["MESAGUALUZ"] != "") { ?>
                        <div><span>Mes: <?php echo $fila["MESAGUALUZ"]?></span><span style="margin-left: 20px">Gasto agua y luz: <?php echo $fila["CANTIDADAGUALUZ"]?></span>
                         <span>Gasto alquiler: <?php echo $fila["ALQUILER"]?></span>   
                        </div>

                <?php } ?>
             
            </div>
          </div>       
        </form>
    </article>
            
        <?php }
        ?>

    <div style = "float:right; margin-top: 20px; margin-right: 38%">
        <button  onclick="location.href='form_insercion_gastosfijos.php';" class="ui button">
            <i class="icon user"></i>
            Añadir Gasto Mensual
    </div> 
    <div style = "float:right; margin-top: 20px; margin-right: 10%">
        <button  onclick="location.href='form_eliminacion_gastosfijos.php';" class="ui button">
            <i class="icon user"></i>
            Eliminar Gasto Mensual
        </button>
    </div>  
    
    <div style="color:grey;padding-top:5em;clear:right;font-weight:bold;font-size:16px;text-align: center">Pulsa <a href="gestion.php">aquí</a> para regresar a Gestión.</div>

<?php
    include_once("pie.php");
?>

</body>
</html>