<?php
    session_start();
    if (isset($_SESSION['pedido'])) {
        $nuevoPedido["OIDPROD"] = $_REQUEST["OIDPROD"];
        $nuevoPedido["CANTIDADLP"] = $_REQUEST["CANTIDADLP"];
        $nuevoPedido["PRECIOLP"] = $_REQUEST["PRECIOLP"];
        $nuevoPedido["MESLP"] = $_REQUEST["MESLP"];
        $nuevoPedido["NPEDIDO"] = $_REQUEST["NPEDIDO"];

    }
    else 
        Header("Location: form_insercion_pedido.php");

    $_SESSION["pedido"] = $nuevoPedido;

    $errores = validarDatosPedido($nuevoPedido);
    
    if (count($errores)>0) {
        $_SESSION["errores"] = $errores;
        Header('Location: form_insercion_pedido.php');
    } else
        Header('Location: accion_insertar_pedido.php');

    function validarDatosPedido($nuevoPedido){
    	require_once("gestionBD.php");
   		require_once("gestionar_inventario.php");
   	 	$conexion = crearConexionBD();
  		$filas = consultarProductos($conexion);
   		cerrarConexionBD($conexion);
   		$array = array();
		
		foreach($filas as $fila) { 
		    array_push($array, $fila["OIDPROD"]);
		}
        if($nuevoPedido["OIDPROD"]==""){ 
            $errores[] = "<p>El nº de producto no puede estar vacío</p>";
        }else if(!in_array($nuevoPedido["OIDPROD"], $array)){ 
           	$errores[] = "<p>El nº pedido tiene que existir</p>";
      	}      
            
        if($nuevoPedido["CANTIDADLP"]==""){ 
            $errores[] = "<p>La cantidad no puede estar vacía</p>";
        }
        
        if($nuevoPedido["PRECIOLP"]==""){ 
            $errores[] = "<p>El Precio no puede estar vacío</p>";
        }
        
        if($nuevoPedido["MESLP"]==""){ 
            $errores[] = "<p>El Mes no puede estar vacío</p>";
        }
            
        if($nuevoPedido["NPEDIDO"]==""){ 
            $errores[] = "<p>El nº del pedido no puede estar vacío</p>";
        }
        return $errores;
    }
?>