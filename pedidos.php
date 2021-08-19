<?php
    session_start();
    require_once("gestionBD.php");
    require_once("gestionar_pedidos.php");
    if (isset($_SESSION["pedido"])){
        $pedido = $_SESSION["pedido"];
        unset($_SESSION["pedido"]);
    }
    
    if(!isset($_SESSION['login']))
        Header("Location: login.php");
    else{
    $conexion = crearConexionBD();
    $usuario = $_SESSION['login'];
    $filas = consultarPedido($conexion);
    cerrarConexionBD($conexion);
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>PEDIDOS</title>
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.css">
</head>

<body style="background: #0f2027; background: linear-gradient(to right,#2c5364, #203a43, #0f2027">
    <div class="topnav">
        <a href="home.php">HOME</a>
        
        <a href="inventario.php">INVENTARIO </a>
        
        <?php if ($usuario == "Dueño") {    ?>
            <a href="proveedores.php">PROVEEDORES</a>
                <?php } ?>
        
        <?php if ($usuario == "Dueño") {	?>
        	<a class="active" href="pedidos.php">PEDIDOS</a>
        		<?php } ?>
                
        <?php if ($usuario == "Dueño") {    ?>
            <a href="gestion.php">GESTIÓN</a>
                <?php } ?>
       
        <?php if ($usuario == "Dueño") {    ?>
            <a href="plantilla.php">PLANTILLA</a>
                <?php } ?>
                
        <a href="reservas.php">RESERVAS</a>
        
        <a href="cuentas.php">CUENTAS</a>
        
        <?php if (isset($_SESSION['login'])) {  ?>
            <button style="display:inline-block" class="ui inverted olive basic button" onclick="window.location.href='logout.php'">Desconectar</button>
                    <?php } ?>
        
    </div>
    
    <div style="margin-top:40px; margin-bottom: 50px"><h1 style="font-size:40px; color:#5F9EA0; text-align: center">BAR LA CAMPIÑA</h1></div>
    
    <?php foreach($filas as $fila) { ?>
    <article>
        <form method="post" action="controlador_pedidos.php">
              <div class="data_and_buttons">
                <div class="datos_cuentas>  
                    <input id="OIDLP" name="OIDLP"
                        type="hidden" value="<?php echo $fila["OIDLP"]; ?>"/>  
                    <input id="OIDPROD" name="OIDPROD"
                        type="hidden" value="<?php echo $fila["OIDPROD"]; ?>"/>
                    <input id="NOMBREPRODUCTOS" name="NOMBREPRODUCTOS"
                        type="hidden" value="<?php echo $fila["NOMBREPRODUCTOS"]; ?>"/>
                    <input id="CANTIDADLP" name="CANTIDADLP"
                        type="hidden" value="<?php echo $fila["CANTIDADLP"]; ?>"/>
                    <input id="PRECIOLP" name="PRECIOLP"
                        type="hidden" value="<?php echo $fila["PRECIOLP"]; ?>"/>
                    <input id="MESLP" name="MESLP"
                        type="hidden" value="<?php echo $fila["MESLP"]; ?>"/>
                    <input id="NPEDIDO" name="NPEDIDO"
                        type="hidden" value="<?php echo $fila["NPEDIDO"]; ?>"/>

                    <?php if($fila["OIDLP"] != "") { ?>
                        <div><span>Pedido nº <?php echo $fila["NPEDIDO"]?></span><span style="margin-left: 20px"><?php echo $fila["CANTIDADLP"]?></span><span><?php echo $fila["NOMBREPRODUCTOS"]?>,</span>
                            <span style="margin-left: 10px">Precio unidad: <?php echo $fila["PRECIOLP"]?>€,</span><span>LineaPedido nº <?php echo $fila["OIDLP"]?></span></div>

                </div>
            </div>
        </form>
    </article>
                        <?php } ?>
    <?php } ?>
    
    <div style = "float:right; margin-top: 20px; margin-right: 10%">
        <button  onclick="location.href='form_insercion_pedido.php';" class="ui button">
            <i class="icon user"></i>
            Añadir pedido
        </button>
    </div> 
    <div style = "float:right; margin-top: 20px; margin-right: 10%">
        <button  onclick="location.href='form_eliminacion_pedido.php';" class="ui button">
            <i class="icon user"></i>
            Eliminar pedido
        </button>
    </div>  

    
    

<?php
    include_once("pie.php");
?>

</body>
</html>