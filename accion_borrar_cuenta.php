<?php
session_start();    
    
    if (isset($_SESSION["cuenta"])) {
        $cuenta = $_SESSION["cuenta"];
        unset($_SESSION["cuenta"]);
        
        require_once("gestionBD.php");
        require_once("gestionar_cuentas.php");
        
        // CREAR LA CONEXIÓN A LA BASE DE DATOS
        $conexion = crearConexionBD();
        // INVOCAR "QUITAR_TITULO"
        $excepcion = quitar_cuenta($conexion,$cuenta["OIDLC"]);
        // CERRAR LA CONEXIÓN
        cerrarConexionBD($conexion);
        
        // SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
        if ($excepcion<>"") {
            $_SESSION["excepcion"] = $excepcion;
            $_SESSION["destino"] = "cuentas.php";
            Header("Location: excepcion.php");
        // EN OTRO CASO, VOLVER A "CONSULTA_LIBROS.PHP"
        } else
            Header("Location: cuentas.php");

    }
    else // Se ha tratado de acceder directamente a este PHP 
        Header("Location: cuentas.php"); 
   
?>