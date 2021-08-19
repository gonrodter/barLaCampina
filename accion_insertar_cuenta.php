<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionar_cuentas.php");
		
	if (isset($_SESSION["cuenta"])) {
		$nuevaCuenta = $_SESSION["cuenta"];
		$_SESSION["cuenta"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: form_insercion_cuenta.php");	

	$conexion = crearConexionBD(); 
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.css">
  <title>Cuenta añadida con éxito</title>
</head>

<body style="background: #0f2027; background: linear-gradient(to right,#2c5364, #203a43, #0f2027">

	<main>
		<div style="margin-top:40px; margin-bottom: 50px"><h1 style="font-size:40px; color:#5F9EA0; text-align: center">BAR LA CAMPIÑA</h1></div>
		
		<?php insertar_cuentas($conexion, $nuevaCuenta);?>

			<h1 style="text-align: center; color: #5F9EA0">Has añadido la nueva línea de cuenta con número de cuenta <?php echo $nuevaCuenta["NCUENTA"]; ?></h1>
			<div style="font-size: 18px; text-align: center; color: #5F9EA0">	
				Pulsa <a href="cuentas.php">aquí</a> para acceder al listado de cuentas.
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