<?php

    
function consultarClientesyReservas($conexion) {
	$consulta = "Select OIDRES, NombreClientes, ApellidosClientes, TelefonoClientes, TO_CHAR( HoraReserva, 'DD-MM-YYYY HH24:MI' ) AS HoraReserva, NumeroPersona from RESERVAS";
    return $conexion->query($consulta);
}

function quitar_reserva($conexion,$OidRes) {
	try {
		$stmt=$conexion->prepare('CALL QUITAR_RESERVA(:OidRes)');
		$stmt->bindParam(':OidRes',$OidRes);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function modificar_reservas($conexion,$OidRes,$OidCli,$NombreClientes,$ApellidosClientes,$TelefonoClientes,$NumeroPersona,$hora) {
	$hora = date('H:i', strtotime($reserva["HORARESERVA"]));	
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_RESERVA(:OidRes,:NombreClientes,:ApellidosClientes,:TelefonoClientes, :NumeroPersona, :FechaHora)');
		$stmt->bindParam(':OidRes',$OidRes);
		$stmt->bindParam(':NombreClientes',$NombreClientes);
		$stmt->bindParam(':ApellidosClientes',$ApellidosClientes);
		$stmt->bindParam(':TelefonoClientes',$TelefonoClientes);
		$stmt->bindParam(':NumeroPersona',$NumeroPersona);
		$stmt->bindParam(':FechaHora',$hora);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

 function insertar_reservas($conexion,$reserva) {
 	//$hora = date("d-m-Y H:i:s", strtotime($reserva["HORARESERVA"]));
	$hora = date('d-m-Y') .  strval($reserva["HORARESERVA"]) . ":00";
	//$hora = "12-12-2020 23:50:30";
	
	try {
		$consulta = "CALL INSERTAR_RESERVAS(:NombreClientes,:ApellidosClientes, :TelefonoClientes, :NumeroPersonas, :FechaHora)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':NombreClientes',$reserva['NOMBRECLIENTES']);
		$stmt->bindParam(':ApellidosClientes',$reserva['APELLIDOSCLIENTES']);
		$stmt->bindParam(':TelefonoClientes',$reserva['TELEFONOCLIENTES']);
		$stmt->bindParam(':NumeroPersonas',$reserva['NUMEROPERSONA']);
		$stmt->bindParam(':FechaHora',$hora);
		$stmt->execute();
		
		return true;
		
	}catch(PDOException $e){
		return false;
	}
}
 
function insertar_cliente($conexion,$cliente) {
	try {
		$consulta = "CALL INSERTAR_CLIENTE(:NombreClientes,:ApellidosClientes, :TelefonoClientes)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':NombreClientes',$cliente['NOMBRECLIENTES']);
		$stmt->bindParam(':ApellidosClientes',$cliente['APELLIDOSCLIENTES']);
		$stmt->bindParam(':TelefonoClientes',$cliente['TELEFONOCLIENTES']);
		$stmt->execute();
		
		return true;
		
	}catch(PDOException $e){
		return false;
	}
}
?>