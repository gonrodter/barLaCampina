<?php
	session_start();
	
	require_once("gestionBD.php");
	require_once("gestionar_plantilla.php");
	
	if (isset($_SESSION["empleado"])){
		$empleado = $_SESSION["empleado"];
		unset($_SESSION["empleado"]);
	}
	
	if(!isset($_SESSION['login']))
		Header("Location: login.php");
	else{
	$conexion = crearConexionBD();
	$usuario = $_SESSION['login'];
	$filas = consultarPlantilla($conexion);
	cerrarConexionBD($conexion);
	}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>PLANTILLA</title>
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
        	<a class="active" href="plantilla.php">PLANTILLA</a>
        		<?php } ?>
        		
        <a href="reservas.php">RESERVAS</a>
        
        <a href="cuentas.php">CUENTAS</a>
        
        <?php if (isset($_SESSION['login'])) {	?>
        	<button style="display:inline-block" class="ui inverted olive basic button" onclick="window.location.href='logout.php'">Desconectar</button>
					<?php } ?>
        
    </div>
    
    <div style="margin-top:40px; margin-bottom: 50px"><h1 style="font-size:40px; color:#5F9EA0; text-align: center">BAR LA CAMPIÑA</h1></div>
    
    <?php foreach($filas as $fila) { ?>
	<article>
		<form method="post" action="controlador_plantilla.php">
			<div class="data_and_buttons">	
				<div class="datos_proveedores">	
					<input id="OIDEMP" name="OIDEMP"
						type="hidden" value="<?php echo $fila["OIDEMP"]; ?>"/>	
					<input id="NOMBREEMPLEADOS" name="NOMBREEMPLEADOS"
						type="hidden" value="<?php echo $fila["NOMBREEMPLEADOS"]; ?>"/>
					<input id="APELLIDOSEMPLEADOS" name="APELLIDOSEMPLEADOS"
						type="hidden" value="<?php echo $fila["APELLIDOSEMPLEADOS"]; ?>"/>
					<input id="FECHANACIMIENTO" name="FECHANACIMIENTO"
						type="hidden" value="<?php echo $fila["FECHANACIMIENTO"]; ?>"/>
					<input id="TELEFONOEMPLEADOS" name="TELEFONOEMPLEADOS"
						type="hidden" value="<?php echo $fila["TELEFONOEMPLEADOS"]; ?>"/>
					<input id="CORREOEMPLEADOS" name="CORREOEMPLEADOS"
						type="hidden" value="<?php echo $fila["CORREOEMPLEADOS"]; ?>"/>
					<input id="SALARIO" name="SALARIO"
						type="hidden" value="<?php echo $fila["SALARIO"]; ?>"/>
					<input id="PUESTO" name="PUESTO"
						type="hidden" value="<?php echo $fila["PUESTO"]; ?>"/>
						
				<?php
					if (isset($empleado) and ($empleado["CORREOEMPLEADOS"] == $fila["CORREOEMPLEADOS"])) { ?>
						<div class="form_prov">
							<h3><input id="NOMBREEMPLEADOS" name="NOMBREEMPLEADOS" type="text" value="<?php echo $fila["NOMBREEMPLEADOS"]; ?>"/>	</h3>
							<h3><input id="APELLIDOSEMPLEADOS" name="APELLIDOSEMPLEADOS" type="text" value="<?php echo $fila["APELLIDOSEMPLEADOS"]; ?>"/>	</h3>
							<h3><input id="FECHANACIMIENTO" name="FECHANACIMENTO" type="date" value="<?php echo $fila["FECHANACIMIENTO"]; ?>"/>	</h3>
							<h3><input id="TELEFONOEMPLEADOS" name="TELEFONOEMPLEADOS" type="text" value="<?php echo $fila["TELEFONOEMPLEADOS"]; ?>"/>	</h3>
							<h3><input id="CORREOEMPLEADOS" name="CORREOEMPLEADOS" type="email" value="<?php echo $fila["CORREOEMPLEADOS"]; ?>"/>	</h3>
							<h3><input id="SALARIO" name="SALARIO" type="text" value="<?php echo $fila["SALARIO"]; ?>"/>	</h3>
							<h3><input id="PUESTO" name="PUESTO" type="text" value="<?php echo $fila["PUESTO"]; ?>"/>	</h3>
						</div>
				<?php }	else { ?>
						<input id="NOMBREEMPLEADOS" name="NOMBREEMPLEADOS" type="hidden" value="<?php echo $fila["NOMBREEMPLEADOS"]; ?>"/>
						<div><span><?php echo $fila["NOMBREEMPLEADOS"]?></span><span><?php echo $fila["APELLIDOSEMPLEADOS"]?></span><span><?php echo $fila["FECHANACIMIENTO"]?></span><span><?php echo $fila["TELEFONOEMPLEADOS"]?>
						</span><span><?php echo $fila["CORREOEMPLEADOS"]?></span><span><?php echo $fila["SALARIO"]?>€</span><span><?php echo $fila["PUESTO"]; ?></span></div>
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
		<button  onclick="location.href='form_insercion_empleado.php';" class="ui button">
		  	<i class="icon user"></i>
		  	Añadir empleado
		</button>
	</div>
    

<?php
	include_once("pie.php");
?>

</body>
</html>