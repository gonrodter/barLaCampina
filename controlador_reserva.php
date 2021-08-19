<?php	
	session_start();
	
	if (isset($_REQUEST["OIDRES"])){
		$reserva["OIDRES"] = $_REQUEST["OIDRES"];
		$reserva["NOMBRECLIENTES"] = $_REQUEST["NOMBRECLIENTES"];
		$reserva["APELLIDOSCLIENTES"] = $_REQUEST["APELLIDOSCLIENTES"];
		$reserva["TELEFONOCLIENTES"] = $_REQUEST["TELEFONOCLIENTES"];
		$reserva["NUMEROPERSONA"] = $_REQUEST["NUMEROPERSONA"];
		$reserva["HORARESERVA"] = $_REQUEST["HORARESERVA"];

		
		$_SESSION["reserva"] = $reserva;
			
		if (isset($_REQUEST["borrar"])) Header("Location: accion_borrar_reserva.php"); 
	}
	else 
		Header("Location: reservas.php");

?>
