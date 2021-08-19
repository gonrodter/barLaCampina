<?php
    session_start();
    
    if (isset($_SESSION['inventario'])) {
        $nuevaTapa["OIDTAP"] = $_REQUEST["OIDTAP"];
    }
    else 
        Header("Location: form_eliminacion_tapa.php");

    $_SESSION["inventario"] = $nuevaTapa;

    $errores = validarDatosEliminacionTapa($nuevaTapa);
    
    if (count($errores)>0) {
        $_SESSION["errores"] = $errores;
        Header('Location: form_eliminacion_tapa.php');
    } else
        Header('Location: accion_borrar_tapa.php');

    function validarDatosEliminacionTapa($nuevaTapa){
        if($nuevaTapa["OIDTAP"]==""){ 
            $errores[] = "<p>El nº de tapa no puede estar vacío</p>";
        } 
          
        return $errores;
    }
?>