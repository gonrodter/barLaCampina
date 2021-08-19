<?php
	session_start();
	
	require_once("gestionBD.php");
	require_once("gestionar_carta.php");
	
	if (isset($_SESSION["carta"])){
		$proveedor = $_SESSION["carta"];
		unset($_SESSION["carta"]);
	}
	else{
	$conexion = crearConexionBD();
	$filas = consultarTapas($conexion);
	$filas1 = consultarBebidas($conexion);
	cerrarConexionBD($conexion);
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Proveedores</title>
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.css">
</head>

<body style="background: #0f2027; background: linear-gradient(to right,#2c5364, #203a43, #0f2027">
	<div class="topnav">
    	<a href="home.php">HOME</a>
    	
        <a href="inventario.php">INVENTARIO </a>
       	
       	<?php if ($usuario == "Dueño") {	?>
        	<a class="active" href="proveedores.php">PROVEEDORES</a>
        		<?php } ?>
        		
        <?php if ($usuario == "Dueño") {	?>
        	<a href="gestion.php">GESTION</a>
        		<?php } ?>
       
       	<?php if ($usuario == "Dueño") {	?>
        	<a href="plantilla.php">PLANTILLA</a>
        		<?php } ?>
        		
        <a href="reservas.php">RESERVAS</a>
        
        <a href="cuentas.php">CUENTAS</a>
        
        <a href="carta.php">CARTA</a>
        
        <?php if (isset($_SESSION['login'])) {	?>
        	<button style="display:inline-block" class="ui inverted olive basic button" onclick="window.location.href='logout.php'">Desconectar</button>
					<?php } ?>
        
    </div>

	<?php foreach($filas as $fila) { ?>
	<article>
		<form method="post" action="controlador_proveedores.php">
			<div>
				<div class="datos_proveedores">	
					<input id="NombreTapas" name="NombreTapas"
						type="hidden" value="<?php echo $fila["NombreTapas"]; ?>"/>	
					<input id="PrecioTapas" name="PrecioTapas"
						type="hidden" value="<?php echo $fila["PrecioTapas"]; ?>"/>
						
	<?php  foreach($filas1 as $fila1) { ?>
					<input id="NombreBebidas" name="NombreBebidas"
						type="hidden" value="<?php echo $fila1["NombreBebidas"]; ?>"/>
					<input id="PrecioBebidas" name="PrecioBebidas"
						type="hidden" value="<?php echo $fila1["PrecioBebidas"]; ?>"/>
				</div>
			</div>
		</form>
	</article>
			
		<?php }} ?>
	</div>

<?php
	include_once("pie.php");
?>

</body>
</html>