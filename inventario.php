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
	$filas = consultarTodosInventario($conexion);
	
	cerrarConexionBD($conexion);
	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>INVENTARIO</title>
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.css">
</head>
<body style="background: #0f2027; background: linear-gradient(to right,#2c5364, #203a43, #0f2027")>
	<div class="topnav">
    	<a href="home.php">HOME</a>
    	
        <a class="active" href="inventario.php">INVENTARIO </a>
       	
       	<?php if ($usuario == "Dueño") {	?>
        	<a href="proveedores.php">PROVEEDORES</a>
        		<?php } ?>
        
        <?php if ($usuario == "Dueño") {	?>
        	<a href="pedidos.php">PEDIDOS</a>
        		<?php } ?>	
        		
        <?php if ($usuario == "Dueño") {	?>
        	<a href="gestion.php">GESTIÓN</a>
        		<?php } ?>
       
       	<?php if ($usuario == "Dueño") {	?>
        	<a href="plantilla.php">PLANTILLA</a>
        		<?php } ?>
        		
        <a href="reservas.php">RESERVAS</a>
        
        <a href="cuentas.php">CUENTAS</a>
        
        <?php if (isset($_SESSION['login'])) {	?>
        	<button style="display:inline-block" class="ui inverted olive basic button" onclick="window.location.href='logout.php'">Desconectar</button>
					<?php } ?>
        
    </div>
   	<div style="margin-top:40px; margin-bottom: 50px"><h1 style="font-size:40px; color:#5F9EA0; text-align: center">BAR LA CAMPIÑA</h1>
   	
   	<div class="topnav">
        <a href="tapas.php">TAPAS</a>
        <a href="bebidas.php">BEBIDAS</a>
        <a href="productos.php">PRODUCTOS</a>
    </div>
   	</div>

    <?php foreach($filas as $fila) {
    	$filas1 = $fila["CANTIDADPRODUCTOS"];
    	$filas2 = tapasConsumidas($conexion, $fila["NOMBREPRODUCTOS"]);
    	$filas3 = bebidasConsumidas($conexion, $fila["NOMBREPRODUCTOS"]);
    	$filas4 = productosPedidos($conexion, $fila["NOMBREPRODUCTOS"]);
    	$filas5 =  $filas1 - $filas2 - $filas3 + $filas4;
    	?>
		
	<article>
		<form method="post" action="controlador_inventario.php">
			<div style="margin-left:38%" class="data_and_buttons"> 
				<div class="datos_proveedores">		
					<input id="NOMBREPRODUCTOS" name="NOMBREPRODUCTOS"
					 	type="hidden" value="<?php echo $fila["NOMBREPRODUCTOS"]; ?>"/>
					<input id="CANTIDAD" name="CANTIDAD"
						type="hidden" value="<?php echo $filas5?>"/>
					<input id="DISPONIBILIDAD" name="DISPONIBILIDAD"
						type="hidden" value="<?php echo $fila["STOCK"]; ?>"/>
					<input id="FECHACADUCIDAD" name="FECHACADUCIDAD"
						type="hidden" value="<?php echo $fila["FECHACADUCIDAD"]; ?>"/>
					<input id="CODIGOBARRAS" name="CODIGOBARRAS"
						type="hidden" value="<?php echo $fila["CODIGOBARRAS"]; ?>"/>
								
                    <?php
                    if ($fila["NOMBREPRODUCTOS"] != "") { ?>
                        <div><span>Nombre del producto: <?php echo $fila["NOMBREPRODUCTOS"]?></span><span style="margin-left: 20px">Cantidad: <?php echo $filas5?></span></div>

                <?php } ?>
				</div>
			</div>
		</form>
	</article>
			
		<?php }
	    ?>
	</div>

<?php
	include_once("pie.php");
?>

</body>
</html>