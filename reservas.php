<?php
	session_start();
	
	require_once("gestionBD.php");
	require_once("gestionar_reservas.php");
	
	if (isset($_SESSION["reserva"])){
		$reserva = $_SESSION["reserva"];
		unset($_SESSION["reserva"]);
	}
	
	if(!isset($_SESSION['login']))
		Header("Location: login.php");
	else{
	$conexion = crearConexionBD();
	$usuario = $_SESSION['login'];
	$filas = consultarClientesyReservas($conexion);
	cerrarConexionBD($conexion);
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>RESERVAS</title>
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.css">
</head>

<body style="background: #0f2027; background: linear-gradient(to right,#2c5364, #203a43, #0f2027")>
	<div class="topnav">
    	<a href="home.php">HOME</a>
    	
        <a href="inventario.php">INVENTARIO </a>
       	
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
        		
        <a class="active" href="reservas.php">RESERVAS</a>
        
        <a href="cuentas.php">CUENTAS</a>
        
        <?php if (isset($_SESSION['login'])) {	?>
        	<button style="display:inline-block" class="ui inverted olive basic button" onclick="window.location.href='logout.php'">Desconectar</button>
					<?php } ?>
        
    </div>

    <div style="margin-top:40px; margin-bottom: 50px"><h1 style="font-size:40px; color:#5F9EA0; text-align: center">BAR LA CAMPIÑA</h1></div>

	<?php foreach($filas as $fila)  { ?>
	<article>
		<form method="post" action="controlador_reserva.php">
			<div style = "margin-left: 25%" class="data_and_buttons">	
				<div class="datos_proveedores">
					<input id="OIDRES" name="OIDRES"
						type="hidden" value="<?php echo $fila["OIDRES"]; ?>"/>	
					<input id="NOMBRECLIENTES" name="NOMBRECLIENTES"
						type="hidden" value="<?php echo $fila["NOMBRECLIENTES"]; ?>"/>
					<input id="APELLIDOSCLIENTES" name="APELLIDOSCLIENTES"
						type="hidden" value="<?php echo $fila["APELLIDOSCLIENTES"]; ?>"/>
					<input id="TELEFONOCLIENTES" name="TELEFONOCLIENTES"
						type="hidden" value="<?php echo $fila["TELEFONOCLIENTES"]; ?>"/>
					<input id="NUMEROPERSONA" name="NUMEROPERSONA"
						type="hidden" value="<?php echo $fila["NUMEROPERSONA"]; ?>"/>
					<input id="HORARESERVA" name="HORARESERVA"
						type="hidden" value="<?php echo $fila["HORARESERVA"]; ?>"/>
								
					<?php
					if (isset($reserva) and ($reserva["TELEFONOCLIENTES"] == $fila["TELEFONOCLIENTES"])) { ?>
						<div class="form_prov">
							<h3><input id="NOMBRECLIENTES" name="NOMBRECLIENTES" type="text" value="<?php echo $fila["NOMBRECLIENTES"]; ?>"/>	</h3>
							<h3><input id="APELLIDOSCLIENTES" name="APELLIDOSCLIENTES" type="text" value="<?php echo $fila["APELLIDOSCLIENTES"]; ?>"/>	</h3>
							<h3><input id="TELEFONOCLIENTES" name="TELEFONOCLIENTES" type="text" value="<?php echo $fila["TELEFONOCLIENTES"]; ?>"/>	</h3>
							<h3><input id="NUMEROPERSONA" name="NUMEROPERSONA" type="text" value="<?php echo $fila["NUMEROPERSONA"]; ?>"/>	</h3>
							<h3><input id="HORARESERVA" placeholder="HH:mm" name="HORARESERVA" type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" value="<?php echo $fila["HORARESERVA"]; ?>"/>	</h3>
						</div>
				<?php }	else {  ?>
						
						<input id="NOMBRECLIENTES" name="NOMBRECLIENTES" type="hidden" value="<?php echo $fila["NOMBRECLIENTES"]; ?>"/>
						<div><span>Nombre: <?php echo $fila["NOMBRECLIENTES"]?></span><span><?php echo $fila["APELLIDOSCLIENTES"]?>,</span><span>Teléfono: <?php echo $fila["TELEFONOCLIENTES"]?>,</span>
							<span><?php echo $fila["NUMEROPERSONA"]?> personas.</span><span><?php echo "Hora de reserva -> " . $fila["HORARESERVA"]; ?></span></div>
				<?php } ?>
				</div>
				
				<div id="botones_fila">
						<button id="borrar" name="borrar" type="submit" class="ui icon button">
							<i class="close icon"></i>
						</button>
				</div>
				
			</div>
		</form>
	</article>
			
		<?php } ?>
		<div style = "float:right; margin-top: 20px; margin-right: 10%">
		<button  onclick="location.href='form_insercion_reservas.php';" class="ui button">
		  	<i class="icon user"></i>
		  	Añadir reserva
		</button>
	</div>	
<?php
	include_once("pie.php");
?>

</body>
</html>