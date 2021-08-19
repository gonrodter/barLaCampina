<?php
session_start();    
    
    if (isset($_SESSION["gestion"])) {
        $gasto = $_SESSION["gestion"];
        unset($_SESSION["gestion"]);
        
        require_once("gestionBD.php");
        require_once("gestionar_gestion.php");
        
        // CREAR LA CONEXIÓN A LA BASE DE DATOS
        $conexion = crearConexionBD();
        // INVOCAR "QUITAR_TITULO"
        $excepcion = quitar_gasto($conexion, $gasto["OIDAL"]);
        // CERRAR LA CONEXIÓN
        cerrarConexionBD($conexion);
        
        // SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
        if ($excepcion<>"") {
            $_SESSION["excepcion"] = $excepcion;
            $_SESSION["destino"] = "gastosfijos.php";
            Header("Location: excepcion.php");
        // EN OTRO CASO, VOLVER A "CONSULTA_LIBROS.PHP"
        } else
            Header("Location: gastosfijos.php");

    }
    else // Se ha tratado de acceder directamente a este PHP 
        Header("Location: gastosfijos.php"); 
   
?>