<?php
	session_start();
	
	require_once("gestionBD.php");
	require_once("gestionar_cuentas.php");
	
	if (isset($_SESSION["cuenta"])){
		$cuenta = $_SESSION["cuenta"];
		unset($_SESSION["cuenta"]);
	}
	
	if(!isset($_SESSION['login']))
		Header("Location: login.php");
	else{
	$conexion = crearConexionBD();
	$usuario = $_SESSION['login'];
	$filas = consultarCuenta($conexion);
	cerrarConexionBD($conexion);
	}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>CUENTAS</title>
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.css">
</head>

<body style="background: #0f2027; background: linear-gradient(to right,#2c5364, #203a43, #0f2027">
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
        		
        <a href="reservas.php">RESERVAS</a>
        
        <a class="active" href="cuentas.php">CUENTAS</a>
        
        <?php if (isset($_SESSION['login'])) {	?>
        	<button style="display:inline-block" class="ui inverted olive basic button" onclick="window.location.href='logout.php'">Desconectar</button>
					<?php } ?>
        
    </div>
    
    <div style="margin-top:40px; margin-bottom: 50px"><h1 style="font-size:40px; color:#5F9EA0; text-align: center">BAR LA CAMPIÑA</h1></div>
    
    <?php foreach($filas as $fila) { ?>
	<article>
		<form method="post" action="controlador_cuentas.php">
			<div style = "margin-left: 32%" class="data_and_buttons">	
				<div class="datos_cuentas>	
					<input id="OIDLC" name="OIDLC"
						type="hidden" value="<?php echo $fila["OIDLC"]; ?>"/>	
					<input id="OIDTAP" name="OIDTAP"
						type="hidden" value="<?php echo $fila["OIDTAP"]; ?>"/>
					<input id="OIDBEB" name="OIDBEB"
						type="hidden" value="<?php echo $fila["OIDBEB"]; ?>"/>
					<input id="NOMBRETAPAS" name="NOMBRETAPAS"
						type="hidden" value="<?php echo $fila["NOMBRETAPAS"]; ?>"/>
					<input id="NOMBREBEBIDAS" name="NOMBREBEBIDAS"
						type="hidden" value="<?php echo $fila["NOMBREBEBIDAS"]; ?>"/>
					<input id="CANTIDADLC" name="CANTIDADLC"
						type="hidden" value="<?php echo $fila["CANTIDADLC"]; ?>"/>
					<input id="PRECIOTAPAS" name="PRECIOTAPAS"
						type="hidden" value="<?php echo $fila["PRECIOTAPAS"]; ?>"/>
					<input id="PRECIOBEBIDAS" name="PRECIOBEBIDAS"
						type="hidden" value="<?php echo $fila["PRECIOBEBIDAS"]; ?>"/>
					<input id="MESLC" name="MESLC"
						type="hidden" value="<?php echo $fila["MESLC"]; ?>"/>
					<input id="NCUENTA" name="NCUENTA"
						type="hidden" value="<?php echo $fila["NCUENTA"]; ?>"/>
					
				
						<input id="NCUENTA" name="NCUENTA" type="hidden" value="<?php echo $fila["NCUENTA"]; ?>"/>
					<?php if($fila["NCUENTA"] != "") { ?>
						<div><span>Cuenta nº <?php echo $fila["NCUENTA"]?></span><span style="margin-left: 20px"><?php echo $fila["CANTIDADLC"]?></span><span><?php echo $fila["NOMBRETAPAS"]?></span><span style="margin-left: -10px"><?php echo $fila["NOMBREBEBIDAS"]?></span>
							<span style="margin-left: 20px">Precio unidad: <?php echo $fila["PRECIOTAPAS"]?></span><span><?php echo $fila["PRECIOBEBIDAS"]?>€</span><span>Con línea de cuenta: <?php echo $fila["OIDLC"]?></span></div>
					<?php } ?>
				</div>
		</form>
	</article>
	
	<?php } ?>
	
	<div style = "float:right; margin-top: 20px; margin-right: 10%">
		<button  onclick="location.href='form_insercion_cuenta.php';" class="ui button">
		  	<i class="icon user"></i>
		  	Añadir cuenta
		</button>
	</div>	
	
	<div style = "float:right; margin-top: 20px; margin-right: 10%">
        <button  onclick="location.href='form_eliminacion_cuenta.php';" class="ui button">
            <i class="icon user"></i>
            Eliminar Cuenta
        </button>
    </div>  

    
    

<?php
	include_once("pie.php");
?>