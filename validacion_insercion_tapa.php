<?php
    session_start();


    if (isset($_SESSION['inventario'])) {
        $nuevaTapa["PRECIOTAPAS"] = $_REQUEST["PRECIOTAPAS"];
        $nuevaTapa["NOMBRETAPAS"] = $_REQUEST["NOMBRETAPAS"];

    }
    else 
        Header("Location: form_insercion_tapa.php");

    $_SESSION["inventario"] = $nuevaTapa;

    $errores = validarDatosTapa($nuevaTapa);
    
    if (count($errores)>0) {
        $_SESSION["errores"] = $errores;
        Header('Location: form_insercion_tapa.php');
    } else
        Header('Location: accion_insertar_tapa.php');

    function validarDatosTapa($nuevaTapa){
        
        if($nuevaTapa["PRECIOTAPAS"]==""){ 
            $errores[] = "<p>El precio de la tapa no puede estar vacío</p>";
        }
        
        if($nuevaTapa["NOMBRETAPAS"]==""){ 
            $errores[] = "<p>El nombre de la tapa no puede estar vacío</p>";
        }

        return $errores;
    }
?>