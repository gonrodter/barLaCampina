<?php
session_start();    
    
    if (isset($_SESSION["inventario"])) {
        $tapa = $_SESSION["inventario"];
        unset($_SESSION["inventario"]);
        
        require_once("gestionBD.php");
        require_once("gestionar_inventario.php");
        
        // CREAR LA CONEXIÓN A LA BASE DE DATOS
        $conexion = crearConexionBD();
        // INVOCAR "QUITAR_TITULO"
        $excepcion = quitar_tapa($conexion,$tapa["OIDTAP"]);
        // CERRAR LA CONEXIÓN
        cerrarConexionBD($conexion);
        
        // SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
        if ($excepcion<>"") {
            $_SESSION["excepcion"] = $excepcion;
            $_SESSION["destino"] = "tapas.php";
            Header("Location: excepcion.php");
        // EN OTRO CASO, VOLVER A "CONSULTA_LIBROS.PHP"
        } else
            Header("Location: tapas.php");

    }
    else // Se ha tratado de acceder directamente a este PHP 
        Header("Location: tapas.php"); 
   
?>