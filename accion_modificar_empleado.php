<?php	
	session_start();	
	
	if (isset($_SESSION["empleado"])) {
		$empleado = $_SESSION["empleado"];
		unset($_SESSION["empleado"]);
		
		require_once("gestionBD.php");
		require_once("gestionar_plantilla.php");
		
		$conexion = crearConexionBD();		
		$excepcion = modificar_empleado($conexion,$empleado["OIDEMP"],$empleado["NOMBREEMPLEADOS"],$empleado["APELLIDOSEMPLEADOS"],$empleado["FECHANACIMIENTO"],$empleado["TELEFONOEMPLEADOS"],$empleado["CORREOEMPLEADOS"], 
										$empleado["SALARIO"],$empleado["PUESTO"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "plantilla.php";
			Header("Location: excepcion.php");
		}
		else
			Header("Location: plantilla.php");
	} 
	else Header("Location: plantilla.php"); // Se ha tratado de acceder directamente a este PHP
?>
