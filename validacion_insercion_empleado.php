<?php
	session_start();

	if (isset($_SESSION["empleado"])) {
		$nuevoEmpleado["NOMBREEMPLEADOS"] = $_REQUEST["NOMBREEMPLEADOS"];
		$nuevoEmpleado["APELLIDOSEMPLEADOS"] = $_REQUEST["APELLIDOSEMPLEADOS"];
		$nuevoEmpleado["FECHANACIMIENTO"] = $_REQUEST["FECHANACIMIENTO"];
		$nuevoEmpleado["TELEFONOEMPLEADOS"] = $_REQUEST["TELEFONOEMPLEADOS"];
		$nuevoEmpleado["CORREOEMPLEADOS"] = $_REQUEST["CORREOEMPLEADOS"];
		$nuevoEmpleado["SALARIO"] = $_REQUEST["SALARIO"];
		$nuevoEmpleado["PUESTO"] = $_REQUEST["PUESTO"];
	}
	else 
		Header("Location: form_insercion_empleado.php");

	$_SESSION["empleado"] = $nuevoEmpleado;

	$errores = validarDatosEmpleado($nuevoEmpleado);
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: form_insercion_empleado.php');
	} else
		Header('Location: accion_insertar_empleado.php');

	function validarDatosEmpleado($nuevoEmpleado){
		if($nuevoEmpleado["NOMBREEMPLEADOS"]==""){ 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
		}
			
		if($nuevoEmpleado["APELLIDOSEMPLEADOS"]==""){ 
			$errores[] = "<p>Los apellidos no pueden estar vacíos</p>";
		}
		
		if($nuevoEmpleado["FECHANACIMIENTO"]==""){ 
			$errores[] = "<p>La fecha de nacimiento no pueden estar vacía</p>";
		}
	
		if($nuevoEmpleado["TELEFONOEMPLEADOS"]==""){ 
			$errores[] = "<p>El teléfono no puede estar vacío</p>";
		}else if(!preg_match("/^[0-9]{9}$/", $nuevoEmpleado["TELEFONOEMPLEADOS"])) {
			$errores[] = "El teléfono debe constar de 9 números";
		}
		
		if($nuevoEmpleado["CORREOEMPLEADOS"]==""){ 
			$errores[] = "<p>El correo electronico no puede estar vacío</p>";
		}else if(!filter_var($nuevoEmpleado["CORREOEMPLEADOS"], FILTER_VALIDATE_EMAIL)){
			$errores[] = $error . "<p>El email es incorrecto: " . $nuevoEmpleado["CORREOEMPLEADOS"]. "</p>";
		}
		
		if($nuevoEmpleado["SALARIO"]==""){ 
			$errores[] = "<p>El salario no puede estar vacío</p>";
		}
		
		if($nuevoEmpleado["PUESTO"]==""){ 
            $errores[] = "<p>El puesto no puede estar vacío</p>";
        }else if($nuevoEmpleado["PUESTO"] != "Chef" && $nuevoEmpleado["PUESTO"] != "Lavaplatos" && $nuevoEmpleado["PUESTO"] != "Camarero" && $nuevoEmpleado["PUESTO"] != "AyudanteChef"){
            $errores[] = "<p>No es un puesto válido</p>";
            }
	
		return $errores;
	}
?>