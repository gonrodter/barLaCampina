<?php
    session_start();
	
	
    if (isset($_SESSION['inventario'])) {
        $nuevoProducto["OID_PROV"] = $_REQUEST["OID_PROV"];
        $nuevoProducto["NOMBREPRODUCTOS"] = $_REQUEST["NOMBREPRODUCTOS"];
        $nuevoProducto["CANTIDADPRODUCTOS"] = $_REQUEST["CANTIDADPRODUCTOS"];
        $nuevoProducto["CATEGORIA"] = $_REQUEST["CATEGORIA"];
    }
    else 
        Header("Location: form_insercion_producto.php");

    $_SESSION["inventario"] = $nuevoProducto;

    $errores = validarDatosProducto($nuevoProducto);
    
    if (count($errores)>0) {
        $_SESSION["errores"] = $errores;
        Header('Location: form_insercion_producto.php');
    } else
        Header('Location: accion_insertar_producto.php');
	
	
	$conexion = crearConexionBD();
	$filas = consultarTodosProveedores($conexion);
	cerrarConexionBD($conexion);
	$array = array();
	
	 foreach($filas as $fila) { 
			array_push($array, $fila["OID_PROV"]);
                      
                         } 
	
	
	

    function validarDatosProducto($nuevoProducto){
	    require_once("gestionBD.php");
	    require_once("gestionar_proveedores.php");
	    $conexion = crearConexionBD();
	    $filas = consultarTodosProveedores($conexion);
	    cerrarConexionBD($conexion);
	    $array = array();
	    
	    foreach($filas as $fila) { 
		        array_push($array, $fila["OID_PROV"]);
		    }
		
	        if($nuevoProducto["OID_PROV"]==""){ 
	            $errores[] = "<p>El oid del proveedor no puede estar vacío</p>";
	        }else if(!in_array($nuevoProducto["OID_PROV"], $array)){ 
		           	$errores[] = "<p>El oid_prov tiene que existir</p>";
		      	} 
	            
	        if($nuevoProducto["NOMBREPRODUCTOS"]==""){ 
	            $errores[] = "<p>El nombre del producto no puede estar vacío</p>";
	        }
	        
	        if($nuevoProducto["CANTIDADPRODUCTOS"]==""){ 
	            $errores[] = "<p>La cantidad no puede estar vacía</p>";
	        }
	        
	        if($nuevoProducto["CATEGORIA"]==""){ 
	            $errores[] = "<p>La categoría no puede estar vacía</p>";
	        }  
				
		
		        return $errores;
		    }
?>