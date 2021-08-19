<?php
	session_start();

	if (isset($_SESSION["reserva"])) {
		$nuevaReserva["NOMBRECLIENTES"] = $_REQUEST["NOMBRECLIENTES"];
		$nuevaReserva["APELLIDOSCLIENTES"] = $_REQUEST["APELLIDOSCLIENTES"];
		$nuevaReserva["TELEFONOCLIENTES"] = $_REQUEST["TELEFONOCLIENTES"];
		$nuevaReserva["NUMEROPERSONA"] = $_REQUEST["NUMEROPERSONA"];
		$nuevaReserva["HORARESERVA"] = $_REQUEST["HORARESERVA"];
	}
	else 
		Header("Location: form_insercion_reservas.php");

	$_SESSION["reserva"] = $nuevaReserva;

	$errores = validarDatosReserva($nuevaReserva);
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: form_insercion_reservas.php');
	} else
		Header('Location: accion_insertar_reservas.php');

	function validarDatosReserva($nuevaReserva){
		if($nuevaReserva["NOMBRECLIENTES"]==""){ 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
		}
		
		if($nuevaReserva["APELLIDOSCLIENTES"]==""){ 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
		}
			
		if($nuevaReserva["TELEFONOCLIENTES"]==""){ 
			$errores[] = "<p>El teléfono no puede estar vacío</p>";
		}else if(!preg_match("/[0-9]+/", $nuevaReserva["TELEFONOCLIENTES"])) {
			$errores[] = "El teléfono debe constar de 9 números";
		}
	
		if($nuevaReserva["NUMEROPERSONA"]==""){ 
			$errores[] = "<p>El número de personas no puede estar vacío</p>";
		}
		
		if($nuevaReserva["HORARESERVA"]==""){ 
			$errores[] = "<p>El campo de la fecha no puede estar vacío</p>";
		}else if(date("H:i", strtotime($nuevaReserva["HORARESERVA"])) !== $nuevaReserva["HORARESERVA"]){
			$errores[] = "No corresponde al formato de la hora de reserva. Por favor introdúzcala según se muestra en el espacio para escribirla (Hora:Minutos)";
		}
		
	
		return $errores;
	}
?>