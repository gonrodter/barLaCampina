<?php	
	session_start();	
	
	if (isset($_SESSION["reserva"])) {
		$reserva = $_SESSION["reserva"];
		unset($_SESSION["reserva"]);
		
		require_once("gestionBD.php");
		require_once("gestionar_reservas.php");
		
		$conexion = crearConexionBD();		
		$excepcion = modificar_reservas($conexion,$reserva["OID_RES"],$reserva["OID_CLI"],$reserva["NOMBRECLIENTES"],$reserva["APELLIDOSCLIENTES"],
		$reserva["TELEFONOCLIENTES"],$reserva["NUMEROPERSONA"],$reserva["FECHAHORA"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "reservas.php";
			Header("Location: excepcion.php");
		}
		else
			Header("Location: reservas.php");
	} 
	else Header("Location: reservas.php");
?>
