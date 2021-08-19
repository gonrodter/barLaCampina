<?php

    
function consultarCuenta($conexion) {
	$consulta = "SELECT * FROM LINEASCUENTA A FULL OUTER JOIN TAPAS B ON A.OIDTAP = B.OIDTAP FULL OUTER JOIN BEBIDAS C ON A.OIDBEB = C.OIDBEB ORDER BY NCuenta";
    return $conexion->query($consulta);
}



function quitar_cuenta($conexion,$OidLC) {
	try {
		$stmt=$conexion->prepare('CALL QUITAR_CUENTA(:OidLC)');
		$stmt->bindParam(':OidLC',$OidLC);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
    

 function insertar_cuentas($conexion,$cuenta) {
	try {
		$consulta = "CALL INSERTAR_CUENTA(:OidBeb,:OidTap,:CantidadLc,:MesLc,:NCuenta)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':OidBeb',$cuenta['OIDBEB']);
		$stmt->bindParam(':OidTap',$cuenta['OIDTAP']);
		$stmt->bindParam(':CantidadLc',$cuenta['CANTIDADLC']);
		$stmt->bindParam(':MesLc',$cuenta['MESLC']);
		$stmt->bindParam(':NCuenta',$cuenta['NCUENTA']);
		$stmt->execute();
		
		return true;
		
	}catch(PDOException $e){
		return false;
	}
}
?>