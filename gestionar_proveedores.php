<?php

function consultarTodosProveedores($conexion) {
    $consulta = "SELECT OID_PROV, NombreProveedores, ApellidosProveedores, CorreoProveedores, TelefonoProveedores FROM PROVEEDORES";
    return $conexion->query($consulta);
}
function quitar_proveedor($conexion,$OID_PROV) {
	try {
		$stmt=$conexion->prepare('CALL QUITAR_PROVEEDOR(:OID_PROV)');
		$stmt->bindParam(':OID_PROV',$OID_PROV);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function modificar_proveedor($conexion,$OID_PROV,$NombreProveedores,$ApellidosProveedores,$CorreoProveedores,$TelefonoProveedores) {
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_PROVEEDOR(:OID_PROV,:NombreProveedores,:ApellidosProveedores,:CorreoProveedores,:TelefonoProveedores)');
		$stmt->bindParam(':OID_PROV',$OID_PROV);
		$stmt->bindParam(':NombreProveedores',$NombreProveedores);
		$stmt->bindParam(':ApellidosProveedores',$ApellidosProveedores);
		$stmt->bindParam(':CorreoProveedores',$CorreoProveedores);
		$stmt->bindParam(':TelefonoProveedores',$TelefonoProveedores);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function insertar_proveedor($conexion,$proveedor) {
    try {
        $consulta = "CALL NUEVO_PROVEEDOR(:NombreProveedores,:ApellidosProveedores,:CorreoProveedores,:TelefonoProveedores)";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(':NombreProveedores',$proveedor["NOMBREPROVEEDORES"]);
        $stmt->bindParam(':ApellidosProveedores',$proveedor["APELLIDOSPROVEEDORES"]);
        $stmt->bindParam(':CorreoProveedores',$proveedor["CORREOPROVEEDORES"]);
        $stmt->bindParam(':TelefonoProveedores',$proveedor["TELEFONOPROVEEDORES"]);
        $stmt->execute();

        return true;

    }catch(PDOException $e){
        return false;
    }
}


function insertar_pedido($conexion,$pedido) {
    try {
        $consulta = "CALL NUEVO_PEDIDO(:Fecha,:NombreProv,:ApellidosProv,:Producto,:Cantidad;:Precio)";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(':Fecha',$pedido["Fecha"]);
        $stmt->bindParam(':NombreProv',$pedido["NombreProv"]);
        $stmt->bindParam(':ApellidosProv',$pedido["ApellidosProv"]);
        $stmt->bindParam(':Producto',$pedido["Producto"]);
		$stmt->bindParam(':Cantidad',$pedido["Cantidad"]);
		$stmt->bindParam(':Precio',$pedido["Precio"]);
        $stmt->execute();

        return true;

    }catch(PDOException $e){
        return false;
    }
}

?>