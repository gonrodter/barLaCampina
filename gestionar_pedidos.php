<?php
function consultarPedido($conexion) {
    $consulta = "SELECT * FROM LINEASPEDIDO A LEFT OUTER JOIN PRODUCTOS B ON A.OIDPROD = B.OIDPROD order by OIDLP";
    return $conexion->query($consulta);
}

function insertar_pedidos($conexion,$pedido) {
    try {
        $consulta = "CALL INSERTAR_PEDIDO(:OIDPROD, :CANTIDADLP, :PRECIOLP, :MesLP, :NPEDIDO)";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(':OIDPROD',$pedido['OIDPROD']);
        $stmt->bindParam(':NPEDIDO',$pedido['NPEDIDO']);
        $stmt->bindParam(':CANTIDADLP',$pedido['CANTIDADLP']);
        $stmt->bindParam(':PRECIOLP',$pedido['PRECIOLP']);
        $stmt->bindParam(':MesLP',$pedido['MESLP']);
        $stmt->execute();
        
        return true;
        
    }catch(PDOException $e){
        return false;
    }
}

function quitar_pedido($conexion,$OIDLP) {
    try {
        $stmt=$conexion->prepare('CALL QUITAR_PEDIDO(:OIDLP)');
        $stmt->bindParam(':OIDLP',$OIDLP);
        $stmt->execute();
        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}
?>