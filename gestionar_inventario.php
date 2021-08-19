<?php

function consultarTodosInventario($conexion) {
	$consulta = "SELECT * FROM PRODUCTOS A FULL OUTER JOIN EJEMPLARES B ON A.OIDPROD = B.OIDPROD";
    return $conexion->query($consulta);
}

function consultarTapas($conexion) {
    $consulta = "SELECT * FROM TAPAS";
    return $conexion->query($consulta);
}


function insertar_tapa($conexion,$tapa) {
    try {
        $consulta = "CALL INSERTAR_TAPA(:PRECIOTAPAS, :NOMBRETAPAS)";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(':PRECIOTAPAS',$tapa['PRECIOTAPAS']);
        $stmt->bindParam(':NOMBRETAPAS',$tapa['NOMBRETAPAS']);
        $stmt->execute();
        
        return true;
        
    }catch(PDOException $e){
        return false;
    }
}

function quitar_tapa($conexion,$OIDTAP) {
    try {
        $stmt=$conexion->prepare('CALL QUITAR_TAPA(:OIDTAP)');
        $stmt->bindParam(':OIDTAP',$OIDTAP);
        $stmt->execute();
        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}

function consultarBebidas($conexion) {
    $consulta = "SELECT * FROM Bebidas";
    return $conexion->query($consulta);
}

function insertar_bebida($conexion,$bebida) {
    try {
        $consulta = "CALL INSERTAR_BEBIDA(:PRECIOBEBIDAS, :NOMBREBEBIDAS)";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(':PRECIOBEBIDAS',$bebida['PRECIOBEBIDAS']);
        $stmt->bindParam(':NOMBREBEBIDAS',$bebida['NOMBREBEBIDAS']);
        $stmt->execute();
        
        return true;
        
    }catch(PDOException $e){
        return false;
    }
}

function quitar_bebida($conexion,$OIDBEB) {
    try {
        $stmt=$conexion->prepare('CALL QUITAR_BEBIDA(:OIDBEB)');
        $stmt->bindParam(':OIDBEB',$OIDBEB);
        $stmt->execute();
        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}
function consultarProductos($conexion) {
    $consulta = "SELECT * FROM Productos";
    return $conexion->query($consulta);
}

function insertar_producto($conexion,$producto) {
    try {
        $consulta = "CALL INSERTAR_PRODUCTO(:OID_PROV, :NOMBREPRODUCTOS, :CANTIDADPRODUCTOS, :CATEGORIA)";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(':OID_PROV',$producto['OID_PROV']);
        $stmt->bindParam(':NOMBREPRODUCTOS',$producto['NOMBREPRODUCTOS']);
        $stmt->bindParam(':CANTIDADPRODUCTOS',$producto['CANTIDADPRODUCTOS']);
        $stmt->bindParam(':CATEGORIA',$producto['CATEGORIA']);
        $stmt->execute();
        
        return true;
        
    }catch(PDOException $e){
        return false;
    }
}

function quitar_producto($conexion,$OIDPROD) {
    try {
        $stmt=$conexion->prepare('CALL QUITAR_PRODUCTO(:OIDPROD)');
        $stmt->bindParam(':OIDPROD',$OIDPROD);
        $stmt->execute();
        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}

/*
		$conexion = crearConexionBD();
 *		$filas = consultarTodosInventario($conexion);
		<?php foreach($filas as $fila) { ?>
 */

/*function hayPedidos($conexion){
    $consulta= "Select count(*) from LineasPedido";
    $result = $conexion->query($consulta)->fetch();
    return $result[0];
}*/


function consultarCantidadFinalTapas($conexion){
    $consulta=    "SELECT C.OIDPROD, sum(CantidadLC), CantidadProductos, NombreProductos, b.oidtap from Lineascuenta A full outer join Tapas B on A.OIDTAP = B.OIDTAP Full outer join Productos C on B.NOMBRETAPAS=C.NOMBREPRODUCTOS where A.OIDTAP = B.OIDTAP group by C.OIDPROD, CANTIDADPRODUCTOS, NombreProductos, b.oidtap order by C.OIDPROD";
    return $conexion->query($consulta);
}


function consultarCantidadFinalBebidas($conexion){
	$consulta = "SELECT C.OIDPROD, sum(CantidadLC), CantidadProductos, NombreProductos, B.OIDBEB from Lineascuenta A full outer join Bebidas B on A.OIDBEB = B.OIDBEB Full outer join Productos C on B.NOMBREBEBIDAS=C.NOMBREPRODUCTOS where A.OIDBEB = B.OIDBEB group by C.OIDPROD, CANTIDADPRODUCTOS, NombreProductos, B.OIDBEB order by C.OIDPROD";
	return $conexion->query($consulta);
}

function consultarProductosPedidos($conexion){
	$consulta="SELECT B.OIDPROD, sum(CantidadLP), CantidadProductos, NombreProductos from Lineaspedido A Full outer join Productos B on A.OIDPROD=B.OIDPROD where A.OIDPROD = B.OIDPROD group by B.OIDPROD, CANTIDADPRODUCTOS, NombreProductos";
	return $conexion->query($consulta);	

}

function productosPedidos($conexion, $NombreProducto){


    $productos = consultarProductosPedidos($conexion);

    
    $arrayCantidad = array();
    $arrayNombre = array();

    $i1 = 0;
    $resultPROD = 0;

    foreach ($productos as $producto) {
        array_push($arrayNombre, $producto["NOMBREPRODUCTOS"]); 
        array_push($arrayCantidad, $producto["SUM(CANTIDADLP)"]);
    }
    while ($i1<count($arrayCantidad)){
        if(strcmp($NombreProducto, $arrayNombre[$i1])== 0){
            $resultPROD = $arrayCantidad[$i1];

        }
        $i1=$i1+1;
    }
        return $resultPROD;   

}
 
function tapasConsumidas($conexion, $nombreTapa){
    $tapas = consultarCantidadFinalTapas($conexion);
    
    $arrayCantidadUsada = array();
    $arrayNombre = array();

    $i1 = 0;
    $resultTap = 0;
    foreach ($tapas as $tapa) {
        array_push($arrayNombre, $tapa["NOMBREPRODUCTOS"]); 
        array_push($arrayCantidadUsada, $tapa["SUM(CANTIDADLC)"]);
    }
    
    while($i1<count($arrayCantidadUsada)){
        if(strcmp($nombreTapa, $arrayNombre[$i1])== 0){
            $resultTap = $arrayCantidadUsada[$i1];
        }
        $i1=$i1+1;
    }
    return $resultTap;
 }

        
function bebidasConsumidas($conexion, $nombreBebida){
    $bebidas = consultarCantidadFinalBebidas($conexion);
    
    $arrayCantidadUsada = array();
    $arrayNombre = array();

    $i1 = 0;
    $resultBeb = 0;
    
    foreach ($bebidas as $bebida) {
        array_push($arrayNombre, $bebida["NOMBREPRODUCTOS"]);   
        array_push($arrayCantidadUsada, $bebida["SUM(CANTIDADLC)"]);
    }
    while ($i1<count($arrayCantidadUsada)){
        if(strcmp($nombreBebida, $arrayNombre[$i1])== 0){
            $resultBeb = $arrayCantidadUsada[$i1];

        }
        $i1=$i1+1;
    }
    return $resultBeb; 
    
}
?>
