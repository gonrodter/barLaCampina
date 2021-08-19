<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

// APARTADO 3.1
 function alta_usuario($conexion,$usuario) {
 	// RECUERDA QUE EL FORMATO DE FECHA PARA ORACLE ES "d/m/Y"
	// BUSCA LA OPERACIÓN ALMACENADA "INSERTAR_USUARIO" EN SQL
	// 			PARA SABER CUÁLES SON SUS PARÁMETROS.
	// RECUERDA QUE SE INVOCA MEDIANTE 'CALL' EN PL/SQL
	// UTILIZA EL MÉTODO "PREPARE" DEL OBJETO PDO
	// RECUERDA EL TRY/CATCH
	try {
		$consulta = "CALL INSERTAR_USUARIO(:usuario, :pass)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':usuario',$usuario["usuario"]);
		$stmt->bindParam(':pass',$usuario["pass"]);
		
		$stmt->execute();
		
		return true;
		
	}catch(PDOException $e){
		return false;
	}
	
}

function consultarUsuario($conexion,$usuario,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM USUARIOS WHERE USUARIO=:usuario AND PASS=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':usuario',$usuario);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
	
}


 