<?php
session_start();    
    
    if (isset($_SESSION["pedido"])) {
        $pedido = $_SESSION["pedido"];
        unset($_SESSION["pedido"]);
        
        require_once("gestionBD.php");
        require_once("gestionar_pedidos.php");
        
        // CREAR LA CONEXIÓN A LA BASE DE DATOS
        $conexion = crearConexionBD();
        // INVOCAR "QUITAR_PEDIDO"
        $excepcion = quitar_pedido($conexion,$pedido["OIDLP"]);
        // CERRAR LA CONEXIÓN
        cerrarConexionBD($conexion);
        
        // SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
        if ($excepcion<>"") {
            $_SESSION["excepcion"] = $excepcion;
            $_SESSION["destino"] = "pedidos.php";
            Header("Location: excepcion.php");
        // EN OTRO CASO, VOLVER A "PEDIDOS.PHP"
        } else
            Header("Location: pedidos.php");
    }
    else // Se ha tratado de acceder directamente a este PHP 
        Header("Location: pedidos.php"); 

?>