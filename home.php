<?php
	session_start();

	require_once("gestionBD.php");


	if (isset($_SESSION["proveedor"])){
		$proveedor = $_SESSION["proveedor"];
		unset($_SESSION["proveedor"]);
	}
	
	if(!isset($_SESSION['login']))
		Header("Location: login.php");

	else{
		$conexion = crearConexionBD();
		$usuario = $_SESSION['login'];
		cerrarConexionBD($conexion);
	}

	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>HOME</title>
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.css">
</head>
<body style="background: #0f2027; background: linear-gradient(to right,#2c5364, #203a43, #0f2027")>
<!-- ponemos este style en body en vez de hacerlo en la hoja de estilo ya que al importar la hoja de estilo externa de semantic pone como predeterminado el background color en white -->
	<div class="topnav">
    	<a class="active" href="home.php">HOME</a>
    	
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
        		
        <a href="reservas.php">RESERVAS</a>
        
        <a href="cuentas.php">CUENTAS</a>
        
        <?php if (isset($_SESSION['login'])) {	?>
        	<button style="display:inline-block" class="ui inverted olive basic button" onclick="window.location.href='logout.php'">Desconectar</button>
					<?php } ?>
        
    </div>
    
    <div style="margin-top:40px; margin-bottom: 90px "><h1 style="font-size:40px; color:#5F9EA0; text-align: center">BAR LA CAMPIÑA</h1></div>
    <div style="text-align: center; color: #5F9EA0">
    	<div class="welcome_border"><h2 style="margin-top:40px; margin-bottom:40px">Bienvenido a tu sistema de gestión un día más</h2></div>
    	<h3>Has iniciado sesión como <?php echo $usuario ?></h4>
    	
    </div>
    




<?php
	include_once("pie.php");
?>

</body>
</html>
