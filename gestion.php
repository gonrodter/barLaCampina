<?php
	session_start();
	
	require_once("gestionBD.php");
	require_once("gestionar_gestion.php");
	
	if (isset($_SESSION["gestion"])){
		$gest = $_SESSION["gestion"];
		unset($_SESSION["gestion"]);
	}
	
	if(!isset($_SESSION['login']))
		Header("Location: login.php");
	else{
	$conexion = crearConexionBD();
	$usuario = $_SESSION['login'];
	$filas = consultarTodosGestion($conexion) ;
	
	cerrarConexionBD($conexion);
	}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>GESTIÓN</title>
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
        	<a class="active" href="gestion.php">GESTIÓN</a>
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
    
    <div style="margin-top:40px; margin-bottom: 30px"><h1 style="font-size:40px; color:#5F9EA0; text-align: center">BAR LA CAMPIÑA</h1></div>
    <div style="margin-bottom: 3em" class="topnav">
        <a href="gastosfijos.php">GASTOS FIJOS</a>
    </div> 
    <?php foreach($filas as $fila) {
    	$filas2 = consultarIngresos($conexion, $fila["MESLC"]);
		$filas3 = gastosPedidos($conexion, $fila["MESLC"]);
		$filas4 = gastosFijos($conexion, $fila["MESLC"]);
		$filas5 = $filas2 - $filas3 - $filas4;

		
		 ?>
	<article>
		<form method="post">
			<div class="data_and_buttons">	
				<div class="datos_proveedores">	
					<input id="MESLC" name="MESLC"
						type="hidden" value="<?php echo $fila["MESLC"]; ?>"/>	
					<input id="INGRESOS" name="INGRESOS"
						type="hidden" value="<?php echo $fila2; ?>"/>
					<input id="GASTOSPEDIDOS" name="GASTOSPEDIDOS"
						type="hidden" value="<?php echo $fila3; ?>"/>
					<input id="GASTOSFIJOS" name="GASTOSFIJOS"
						type="hidden" value="<?php echo $fila4; ?>"/>
					<input id="BENEFICIOS" name="BENEFICIOS"
						type="hidden" value="<?php echo $fila5; ?>"/>
                    <?php
                    if (!isset($gest) or ($gest["MESLC"] != $fila["MESLC"])) { ?>
                        <input id="MESLC" name="MESLC" type="hidden" value="<?php echo $fila["MESLC"]; ?>"/>
                        <div><span>En <?php echo $fila["MESLC"]?></span><span> tiene los siguientes ingresos: <?php echo $filas2?>€,</span><span>Gastos en pedidos: <?php echo $filas3?>€,</span>
                            <span>En gastos fijos: <?php echo $filas4?>€,</span>
                        </div>
	                <div style="text-align:center;margin-top:4em; font-size:19px;	font-weight: bold; color: #f2f2f2;">
	                	<p>Total de beneficio: <?php echo $filas5?>€</p>
	                </div>
                </div>						
			</div>
		</form>
	</article>
 
            
        <?php }
        } ?>
    </div>
 
<?php
	include_once("pie.php");
?>

</body>
</html>