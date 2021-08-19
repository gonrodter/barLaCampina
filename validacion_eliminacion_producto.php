<?php
    session_start();
    
    if (isset($_SESSION['inventario'])) {
        $nuevoProducto["OIDPROD"] = $_REQUEST["OIDPROD"];
    }
    else 
        Header("Location: form_eliminacion_producto.php");

    $_SESSION["inventario"] = $nuevoProducto;

    $errores = validarDatosEliminacionBebida($nuevoProducto);
    
    if (count($errores)>0) {
        $_SESSION["errores"] = $errores;
        Header('Location: form_eliminacion_producto.php');
    } else
        Header('Location: accion_borrar_producto.php');

    function validarDatosEliminacionBebida($nuevoProducto){
        if($nuevoProducto["OIDPROD"]==""){ 
            $errores[] = "<p>El nº de producto no puede estar vacío</p>";
        } 
          
        return $errores;
    }
?>