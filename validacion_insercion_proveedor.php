<?php
	session_start();

	if (isset($_SESSION["proveedor"])) {
		$nuevoProveedor["NOMBREPROVEEDORES"] = $_REQUEST["NOMBREPROVEEDORES"];
		$nuevoProveedor["APELLIDOSPROVEEDORES"] = $_REQUEST["APELLIDOSPROVEEDORES"];
		$nuevoProveedor["CORREOPROVEEDORES"] = $_REQUEST["CORREOPROVEEDORES"];
		$nuevoProveedor["TELEFONOPROVEEDORES"] = $_REQUEST["TELEFONOPROVEEDORES"];
	}
	else 
		Header("Location: form_insercion_proveedor.php");

	$_SESSION["proveedor"] = $nuevoProveedor;

	$errores = validarDatosProveedor($nuevoProveedor);
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: form_insercion_proveedor.php');
	} else
		Header('Location: accion_insertar_proveedor.php');

	function validarDatosProveedor($nuevoProveedor){
		if($nuevoProveedor["NOMBREPROVEEDORES"]==""){ 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
		}
			
		if($nuevoProveedor["APELLIDOSPROVEEDORES"]==""){ 
			$errores[] = "<p>Los apellidos no pueden estar vacíos</p>";
		}
	
		if($nuevoProveedor["CORREOPROVEEDORES"]==""){ 
			$errores[] = "<p>El correo electronico no puede estar vacío</p>";
		}else if(!filter_var($nuevoProveedor["CORREOPROVEEDORES"], FILTER_VALIDATE_EMAIL)){
			$errores[] = $error . "<p>El email es incorrecto: " . $nuevoProveedor["CORREOPROVEEDORES"]. "</p>";
		}
		
		if($nuevoProveedor["TELEFONOPROVEEDORES"]==""){ 
			$errores[] = "<p>El teléfono no puede estar vacío</p>";
		}else if(!preg_match("/[0-9]+/", $nuevoProveedor["TELEFONOPROVEEDORES"])) {
			$errores[] = "El teléfono debe constar de 9 números";
		}
		
	
		return $errores;
	}
?>