<?php	
	session_start();	
	
	if (isset($_SESSION["reserva"])) {
		$reserva = $_SESSION["reserva"];
		unset($_SESSION["reserva"]);
		
		require_once("gestionBD.php");
		require_once("gestionar_reservas.php");
		
		$conexion = crearConexionBD();		
		$excepcion = quitar_reserva($conexion,$reserva["OIDRES"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "reservas.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: reservas.php");
	}
	else Header("Location: reservas.php"); // Se ha tratado de acceder directamente a este PHP
?>