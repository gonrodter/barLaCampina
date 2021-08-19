<?php	
	session_start();
	
	if (isset($_REQUEST["OIDLC"])){
		$cuenta["OIDLC"] = $_REQUEST["OIDLC"];

		
		$_SESSION["cuenta"] = $cuenta;
			
		if (isset($_REQUEST["borrar"])) Header("Location: accion_borrar_cuenta.php"); 
	}
	else 
		Header("Location: cuentas.php");

?>
