<?php	
	session_start();
	
	if (isset($_REQUEST["OID_PROV"])){
		$proveedor["OID_PROV"] = $_REQUEST["OID_PROV"];
		$proveedor["NOMBREPROVEEDORES"] = $_REQUEST["NOMBREPROVEEDORES"];
		$proveedor["APELLIDOSPROVEEDORES"] = $_REQUEST["APELLIDOSPROVEEDORES"];
		$proveedor["CORREOPROVEEDORES"] = $_REQUEST["CORREOPROVEEDORES"];
		$proveedor["TELEFONOPROVEEDORES"] = $_REQUEST["TELEFONOPROVEEDORES"];

		
		$_SESSION["proveedor"] = $proveedor;
			
		if (isset($_REQUEST["editar"])) Header("Location: proveedores.php"); 
		else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_proveedor.php");
		else if (isset($_REQUEST["borrar"])) Header("Location: accion_borrar_proveedor.php"); 
	}
	else 
		Header("Location: proveedores.php");

?>
