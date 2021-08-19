<?php

function consultarPlantilla($conexion) {
	$consulta = "SELECT OIDEMP, NombreEmpleados, ApellidosEmpleados, FechaNacimiento, TelefonoEmpleados, CorreoEmpleados, Salario, Puesto FROM EMPLEADOS";
    return $conexion->query($consulta);
}

function quitar_empleado($conexion,$OidEmp) {
	try {
		$stmt=$conexion->prepare('CALL QUITAR_EMPLEADO(:OidEmp)');
		$stmt->bindParam(':OidEmp',$OidEmp);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function modificar_empleado($conexion,$OidEmp,$NombreEmp,$fechaNacimiento,$TelefonoEmp,$CorreoEmp,$SalarioEmp,$PuestoEmp) {
	$fechaNacimiento = date('d/m/Y', strtotime($empleado["FECHANACIMIENTO"]));
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_EMPLEADO(:OidEmp,:NombreEmp,:ApellidosEmp,:FNEmp,:TelefonoEmp,:CorreoEmp,:SalarioEmp,:PuestoEmp)');
		$stmt->bindParam(':OidEmp',$OidEmp);
		$stmt->bindParam(':NombreEmp',$NombreEmp);
		$stmt->bindParam(':ApellidosEmp',$ApellidosEmp);
		$stmt->bindParam(':FNEmp',$fechaNacimiento);
		$stmt->bindParam(':TelefonoEmp',$TelefonoEmp);
		$stmt->bindParam(':CorreoEmp',$CorreoEmp);
		$stmt->bindParam(':SalarioEmp',$SalarioEmp);
		$stmt->bindParam(':PuestoEmp',$PuestoEmp);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function insertar_empleado($conexion,$empleado) {
	$fechaNacimiento = date('d/m/Y', strtotime($empleado["FECHANACIMIENTO"]));
    try {
        $consulta = "CALL CONTRATAR_EMPLEADO(:NombreEmpleados,:ApellidosEmpleados,:FechaNacimiento,:TelefonoEmpleados, :CorreoEmpleados, :Salario, :Puesto)";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(':NombreEmpleados',$empleado["NOMBREEMPLEADOS"]);
        $stmt->bindParam(':ApellidosEmpleados',$empleado["APELLIDOSEMPLEADOS"]);
        $stmt->bindParam(':FechaNacimiento',$fechaNacimiento);
        $stmt->bindParam(':TelefonoEmpleados',$empleado["TELEFONOEMPLEADOS"]);
		$stmt->bindParam(':CorreoEmpleados',$empleado["CORREOEMPLEADOS"]);
		$stmt->bindParam(':Salario',$empleado["SALARIO"]);
		$stmt->bindParam(':Puesto',$empleado["PUESTO"]);
        $stmt->execute();

        return true;

    }catch(PDOException $e){
        return false;
    }
}

    
?>