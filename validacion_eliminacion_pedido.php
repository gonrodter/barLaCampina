<?php
    session_start();
    if (isset($_SESSION['pedido'])) {
        $nuevoPedido["OIDLP"] = $_REQUEST["OIDLP"];
    }
    else 
        Header("Location: form_eliminacion_pedido.php");

    $_SESSION["pedido"] = $nuevoPedido;

    $errores = validarDatosEliminacionPedido($nuevoPedido);
    
    if (count($errores)>0) {
        $_SESSION["errores"] = $errores;
        Header('Location: form_eliminacion_pedido.php');
    } else
        Header('Location: accion_borrar_pedido.php');

    function validarDatosEliminacionPedido($nuevoPedido){
        if($nuevoPedido["OIDLP"]==""){ 
            $errores[] = "<p>El nº de linea de pedido no puede estar vacío</p>";
        } 
          
        return $errores;
    }
?>