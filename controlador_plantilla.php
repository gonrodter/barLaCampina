<?php	
	session_start();
	
	if (isset($_REQUEST["OIDEMP"])){
		$empleado["OIDEMP"] = $_REQUEST["OIDEMP"];
		$empleado["NOMBREEMPLEADOS"] = $_REQUEST["NOMBREEMPLEADOS"];
		$empleado["APELLIDOSEMPLEADOS"] = $_REQUEST["APELLIDOSEMPLEADOS"];
		$empleado["FECHANACIMIENTO"] = $_REQUEST["FECHANACIMIENTO"];
		$empleado["TELEFONOEMPLEADOS"] = $_REQUEST["TELEFONOEMPLEADOS"];
		$empleado["CORREOEMPLEADOS"] = $_REQUEST["CORREOEMPLEADOS"];
		$empleado["SALARIO"] = $_REQUEST["SALARIO"];
		$empleado["PUESTO"] = $_REQUEST["PUESTO"];

		
		$_SESSION["empleado"] = $empleado;

		if (isset($_REQUEST["borrar"])) Header("Location: accion_borrar_empleado.php"); 
	}
	else 
		Header("Location: plantilla.php");

?>
