<?php	
	session_start();
	
	if (isset($_REQUEST["OIDPROD"])){
		$inventario["OIDPROD"] = $_REQUEST["OIDPROD"];
		$inventario["NOMBREPRODUCTOS"] = $_REQUEST["NOMBREPRODUCTOS"];
		$inventario["CANTIDAD"] = $_REQUEST["CANTIDAD"];
		$inventario["DISPONIBILIDAD"] = $_REQUEST["DISPONIBILIDAD"];
		$inventario["FECHACADUCIDAD"] = $_REQUEST["FECHACADUCIDAD"];
		$inventario["CODIGOBARRAS"] = $_REQUEST["CODIGOBARRAS"];

		
		$_SESSION["inventario"] = $inventario;
			
		if (isset($_REQUEST["borrar"])) Header("Location: accion_borrar_inventario.php");
		}
		else 
			Header("Location: inventario.php");

?>
