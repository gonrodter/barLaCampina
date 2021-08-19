<?php


function consultarTodosGestion($conexion){
	$consulta = "SELECT DISTINCT MesLC from Lineascuenta ";
	return $conexion->query($consulta);
}

function consultarGastosFijos($conexion){
    $consulta = "Select * FROM AGUALUZ A FULL OUTER JOIN LOCALES B ON A.OIDLOC = B.OIDLOC";
    return $conexion->query($consulta);
}

function insertar_gastosfijos($conexion,$gasto) {
    try {
        $consulta = "CALL INSERTAR_GASTOSFIJOS(:MESAGUALUZ, :CANTIDADAGUALUZ)";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(':MESAGUALUZ',$gasto['MESAGUALUZ']);
        $stmt->bindParam(':CANTIDADAGUALUZ',$gasto['CANTIDADAGUALUZ']);
        $stmt->execute();
        return true;
        
    }catch(PDOException $e){
        return false;
    }
}

function quitar_gasto($conexion,$GASTO) {
    try {
        $stmt=$conexion->prepare('CALL QUITAR_GASTO(:OIDAL)');
        $stmt->bindParam(':OIDAL',$GASTO);
        $stmt->execute();
        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}

function consultarIngresosBebidas($conexion){
	$consulta = "SELECT A.OIDBEB, sum(CantidadLC), PrecioBebidas, MesLC from Bebidas A full outer Join LineasCuenta B on A.OIDBEB = B.OIDBEB where A.OIDBEB = B.OIDBEB group by A.OIDBEB, PrecioBebidas, MesLC order by A.OIDBEB";
    return $conexion->query($consulta);
}
function consultarIngresosTapas($conexion){
	$consulta = "SELECT A.OIDTAP, sum(CantidadLC), PrecioTapas, MesLC from Tapas A full outer Join LineasCuenta B on A.OIDTAP = B.OIDTAP where A.OIDTAP = B.OIDTAP group by A.OIDTAP, PrecioTapas, MesLC order by A.OIDTAP";
    return $conexion->query($consulta);
}
function consultarIngresos($conexion, $mes){
	
	$bebidas = consultarIngresosBebidas($conexion);
	$tapas = consultarIngresosTapas($conexion);
	
	
	$arrayBEB = array();
	$arraySUMBEB = array();
	$arrayPREBEB = array();
	$arrayTAP = array();
	$arraySUMTAP = array();
	$arrayPRETAP = array();
	$arrayMESBEB = array();
	$arrayMESTAP = array();
	
	$i1 = 0;
	$i2 = 0;
	$resultBEB = 0;
	$resultTAP = 0;
	$coma = ",";
	$punto = ".";
	
	foreach ($bebidas as $bebida) {
		array_push($arrayBEB, $bebida["OIDBEB"]);
		array_push($arraySUMBEB, $bebida["SUM(CANTIDADLC)"]);
		array_push($arrayPREBEB, str_replace($coma, $punto, $bebida["PRECIOBEBIDAS"]));
		array_push($arrayMESBEB, $bebida["MESLC"]);
	}
	foreach ($tapas as $tapa) {
		array_push($arrayTAP, $tapa["OIDTAP"]);
		array_push($arraySUMTAP, $tapa["SUM(CANTIDADLC)"]);
		array_push($arrayPRETAP, str_replace($coma, $punto, $tapa["PRECIOTAPAS"]));
		array_push($arrayMESTAP, $tapa["MESLC"]);	
	}
	
	while ($i1<count($arrayBEB)){
		if(strcmp($arrayMESBEB[$i1], $mes)==0){
			$multiplicacion = $arrayPREBEB[$i1] * $arraySUMBEB[$i1];
			$resultBEB = $resultBEB + $multiplicacion;	
		}
		$i1=$i1+1;
	}
	while ($i2<count($arrayTAP)){
		if(strcmp($arrayMESTAP[$i2], $mes)==0){
			$multiplicacion1 = $arrayPRETAP[$i2] * $arraySUMTAP[$i2];
			$resultTAP = $resultTAP + $multiplicacion1;			
		}	
		$i2=$i2+1;
	}
	$result = $resultTAP + $resultBEB;
	return $result;
	
}

function consultarGastosPedidos($conexion){
	$consulta = "SELECT A.OIDPROD, sum(CantidadLP), PrecioLP, MesLP from Lineaspedido A Full outer join Productos B on A.OIDPROD=B.OIDPROD where A.OIDPROD = B.OIDPROD group by A.OIDPROD, PRECIOLP, MesLP";
    return $conexion->query($consulta);
}

function gastosPedidos($conexion, $mes){
	
	$productos = consultarGastosPedidos($conexion);
	
	
	$arrayProductos = array();
	$arrayPrecios = array();
	$arrayCantidad = array();
	$arrayMes = array();
	$i1 = 0;
	$result = 0;
	$coma = ",";
	$punto = ".";
	
	foreach ($productos as $producto) {
		array_push($arrayProductos, $producto["OIDPROD"]);
		array_push($arrayCantidad, $producto["SUM(CANTIDADLP)"]);
		array_push($arrayPrecios, str_replace($coma, $punto, $producto["PRECIOLP"]));
		array_push($arrayMes, $producto["MESLP"]);
	}
	while ($i1<count($arrayProductos)){
		if(strcmp($arrayMes[$i1], $mes)==0){
			$multiplicacion = $arrayPrecios[$i1] * $arrayCantidad[$i1];
			$result = $result + $multiplicacion;	
		}
		$i1=$i1+1;
	}
	return $result;
}


function consultarGastoAlquiler($conexion){
    $consulta = "Select * from Locales";
    return $conexion->query($consulta);
}

function gastoAlquileres($conexion, $mes){
    $gastoAlquileres = consultarGastoAlquiler($conexion);
    
    $arrayGastoAlquiler = array();
    $arrayMes = array();
    $i1 = 0;
    $resultGastoAlquiler = 0;
    
    foreach ($gastoAlquileres as $gastoAlquiler) {
        array_push($arrayGastoAlquiler, $gastoAlquiler["ALQUILER"]);
        array_push($arrayMes, $gastoAlquiler["MESLOCAL"]);
    }
    while($i1<count($arrayGastoAlquiler)){
        if(strcmp($arrayMes[$i1], $mes)==0){
            $resultGastoAlquiler = $arrayGastoAlquiler[$i1];
        }
        $i1=$i1+1;
    }
    return $resultGastoAlquiler;
}

function consultarGastoAgua($conexion){
    $consulta = "Select * from Agua";
    return $conexion->query($consulta);
}

function gastoAguas($conexion, $mes){
    $gastoAguas = consultarGastoAgua($conexion);
    
    $arrayGastoAgua = array();
    $arrayMes = array();
    $i1 = 0;
    $resultGastoAgua = 0;
    
    foreach ($gastoAguas as $gastoAgua) {
        array_push($arrayGastoAgua, $gastoAgua["CANTIDADAGUA"]);
        array_push($arrayMes, $gastoAgua["MESAGUA"]);
    }
    while($i1<count($arrayGastoAgua)){
        if(strcmp($arrayMes[$i1], $mes)==0){
            $resultGastoAgua = $arrayGastoAgua[$i1];
        }
        $i1=$i1+1;
    }
    return $resultGastoAgua;
}

function consultarGastoLuz($conexion){
    $consulta = "Select * from Luz";
    return $conexion->query($consulta);
}

function gastoLuces($conexion, $mes){
    $gastoLuces = consultarGastoLuz($conexion);
    
    $arrayGastoLuz = array();
    $arrayMes = array();
    $i1 = 0;
    $resultGastoLuz = 0;
    
    foreach ($gastoLuces as $gastoLuz) {
        array_push($arrayGastoLuz, $gastoLuz["CANTIDADLUZ"]);
        array_push($arrayMes, $gastoLuz["MESLUZ"]);
    }
    while($i1<count($arrayGastoLuz)){
        if(strcmp($arrayMes[$i1], $mes)==0){
            $resultGastoLuz = $arrayGastoLuz[$i1];
        }
        $i1=$i1+1;
    }
    return $resultGastoLuz;
}

function gastosFijos($conexion, $mes){
    return gastoAguas($conexion, $mes) + gastoAlquileres($conexion, $mes) + gastoLuces($conexion, $mes) + gastosEmpleadosMes($conexion);
}

function consultarEmpleados($conexion){
    $consulta = "Select * from empleados";
    return $conexion->query($consulta);
}

function gastosEmpleadosMes($conexion){
    $gastosEmpleados = consultarEmpleados($conexion);
    
    $arraySueldoEmpleados = array();
    
    foreach($gastosEmpleados as $gastoEmpleado) {
        array_push($arraySueldoEmpleados, $gastoEmpleado["SALARIO"]);
    }
    return array_sum($arraySueldoEmpleados);
}

?>