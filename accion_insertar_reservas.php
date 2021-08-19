<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionar_reservas.php");
		
	if (isset($_SESSION["reserva"])) {
		$nuevaReserva = $_SESSION["reserva"];
		$_SESSION["reserva"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: form_insercion_reservas.php");	

	$conexion = crearConexionBD(); 
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Reserva añadida con éxito</title>
</head>

<body style="background: #0f2027; background: linear-gradient(to right,#2c5364, #203a43, #0f2027">

	<main>
		<div style="margin-top:40px; margin-bottom: 50px"><h1 style="font-size:40px; color:#5F9EA0; text-align: center">BAR LA CAMPIÑA</h1></div>
		<?php insertar_reservas($conexion, $nuevaReserva);?>

			<h1 style="text-align: center; color: #5F9EA0">Has añadido una nueva reserva del cliente <?php echo $nuevaReserva["NOMBRECLIENTES"].' '.$nuevaReserva["APELLIDOSCLIENTES"]?> hora: 
				<?php echo $nuevaReserva["HORARESERVA"]; ?> 
				para <?php echo $nuevaReserva["NUMEROPERSONA"];?> personas</h1>
			<div style="font-size: 18px; text-align: center; color: #5F9EA0">	
				Pulsa <a href="reservas.php">aquí</a> para acceder al listado de reserva.
			</div>
			


	</main>

	<?php
		include_once("pie.php");
	?>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>