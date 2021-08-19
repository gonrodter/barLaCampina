<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionar_proveedores.php");
	include_once("paginacion_consulta.php");
	
	if (isset($_SESSION["proveedor"])){
		$proveedor = $_SESSION["proveedor"];
		unset($_SESSION["proveedor"]);
	}
	
	if(!isset($_SESSION['login']))
		Header("Location: login.php");
	else{

	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	if (isset($_SESSION["paginacion"])) $paginacion = $_SESSION["paginacion"]; 
	$pagina_seleccionada = isset($_GET["PAG_NUM"])? (int)$_GET["PAG_NUM"]:
												(isset($paginacion)? (int)$paginacion["PAG_NUM"]: 1);
	$pag_tam = isset($_GET["PAG_TAM"])? (int)$_GET["PAG_TAM"]:
										(isset($paginacion)? (int)$paginacion["PAG_TAM"]: 3);
	if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;
	if ($pag_tam < 1) $pag_tam = 3;
		
	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();
	$usuario = $_SESSION['login'];
	
	// La consulta que ha de paginarse
	$query = 'SELECT * FROM PROVEEDORES';
	
	// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
	// En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1
	$total_registros = total_consulta($conexion,$query);
	$total_paginas = (int) ($total_registros / $pag_tam);
	if ($total_registros % $pag_tam > 0) $total_paginas++; 
	if ($pagina_seleccionada > $total_paginas) $pagina_seleccionada = $total_paginas;
	
	// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;
	
	$filas = consulta_paginada($conexion,$query,$pagina_seleccionada,$pag_tam);
	
	cerrarConexionBD($conexion);
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>PROVEEDORES</title>
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
    
    <div style="margin-top:40px; margin-bottom: 50px"><h1 style="font-size:40px; color:#5F9EA0; text-align: center">BAR LA CAMPIÑA</h1></div>

	<?php foreach($filas as $fila) { ?>
	<article>
		<form method="post" action="controlador_proveedores.php">
			<div class="data_and_buttons">
				<div class="datos_proveedores">	
					<input id="OID_PROV" name="OID_PROV"
						type="hidden" value="<?php echo $fila["OID_PROV"]; ?>"/>	
					<input id="NOMBREPROVEEDORES" name="NOMBREPROVEEDORES"
						type="hidden" value="<?php echo $fila["NOMBREPROVEEDORES"]; ?>"/>
					<input id="APELLIDOSPROVEEDORES" name="APELLIDOSPROVEEDORES"
						type="hidden" value="<?php echo $fila["APELLIDOSPROVEEDORES"]; ?>"/>
					<input id="CORREOPROVEEDORES" name="CORREOPROVEEDORES"
						type="hidden" value="<?php echo $fila["CORREOPROVEEDORES"]; ?>"/>
					<input id="TELEFONOPROVEEDORES" name="TELEFONOPROVEEDORES"
						type="hidden" value="<?php echo $fila["TELEFONOPROVEEDORES"]; ?>"/>
								
					<?php
					if (isset($proveedor) and ($proveedor["CORREOPROVEEDORES"] == $fila["CORREOPROVEEDORES"])) { ?>
						<div class="form_prov">
							<!-- Editando título -->
							<h3><input id="NOMBREPROVEEDORES" name="NOMBREPROVEEDORES" type="text" value="<?php echo $fila["NOMBREPROVEEDORES"]; ?>"/>	</h3>
							<h3><input id="APELLIDOSPROVEEDORES" name="APELLIDOSPROVEEDORES" type="text" value="<?php echo $fila["APELLIDOSPROVEEDORES"]; ?>"/>	</h3>
							<h3><input id="CORREOPROVEEDORES" name="CORREOPROVEEDORES" type="email" value="<?php echo $fila["CORREOPROVEEDORES"]; ?>"/>	</h3>
							<h3><input id="TELEFONOPROVEEDORES" name="TELEFONOPROVEEDORES" type="text" value="<?php echo $fila["TELEFONOPROVEEDORES"]; ?>"/>	</h3>
						</div>
				<?php }	else { ?>
						<!-- mostrando título -->
						<input id="OID_PROV" name="OID_PROV" type="hidden" value="<?php echo $fila["OID_PROV"]; ?>"/>
						<div><span><?php echo $fila["NOMBREPROVEEDORES"]?></span><span><?php echo $fila["APELLIDOSPROVEEDORES"]?></span><span><?php echo $fila["CORREOPROVEEDORES"]?></span><span><?php echo $fila["TELEFONOPROVEEDORES"]; ?></span></div>
				<?php } ?>
				</div>
				
				<div id="botones_fila">
				<?php if (isset($proveedor) and ($proveedor["CORREOPROVEEDORES"] == $fila["CORREOPROVEEDORES"])) { ?>
						<button id="grabar" name="grabar" type="submit" class="ui icon button">
							<i class="save outline icon"></i>
						</button>
				<?php } else {?>
						<button id="editar" name="editar" type="submit" class="ui icon button">
							<i class="pencil alternate icon"></i>
						</button>
				<?php } ?>
						<button id="borrar" name="borrar" type="submit" class="ui icon button">
							<i class="close icon"></i>
						</button>
				</div>
			</div>
		</form>
		
		
						
			<?php } ?>
		
	</article>
	
	<div style = "float:right; margin-top: 20px; margin-right: 10%">
		<button  onclick="location.href='form_insercion_proveedor.php';" class="ui button">
		  	<i class="icon user"></i>
		  	Añadir Proveedor
		</button>
	</div>	
	
	<!-- /////PAGINACION	-->		
		<div style="float:right; clear:right; margin-right: 10%; margin-top: 30px; font-family: 'Verdana'; font-size:15px; color:#5F9EA0;">	
			<div>
				<!-- Código para poner los enlaces a las páginas -->
				<?php
	
					for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )
	
						if ( $pagina == $pagina_seleccionada) { 	?>
	
							<span class="current"><?php echo $pagina; ?></span>
	
				<?php }	else { ?>
	
							<a style="color:#5F9EA0;" href="proveedores.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
	
				<?php } ?>
	
			</div>
			
			<form method="get" action="proveedores.php">
				<div style="font-weight: bold">
					<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>
		
					Mostrando
		
					<input id="PAG_TAM" name="PAG_TAM" type="number"
		
						min="1" max="<?php echo $total_registros; ?>"
		
						value="<?php echo $pag_tam?>" />
		
					entradas de <?php echo $total_registros?>
		
					<button style=" font-size: 12px; display:inline-block" class="ui button" type="submit">Cambiar</button>
					
				</div>
			</form>
		</div>
			

<?php
	include_once("pie.php");
?>

</body>
</html>