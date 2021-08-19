<?php
	session_start();

	
	if (!isset($_SESSION['empleado'])) {
		$empleado['NOMBREEMPLEADOS'] = "";
		$empleado['APELLIDOSEMPLEADOS'] = "";
		$empleado['FECHANACIMIENTO'] = "";
		$empleado['TELEFONOEMPLEADOS'] = "";
		$empleado['CORREOEMPLEADOS'] = "";
		$empleado['SALARIO'] = "";
		$empleado['PUESTO'] = "";

		$_SESSION['empleado'] = $empleado;
	}
	else
		$empleado = $_SESSION['empleado'];
			
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/form_insercion.css" />
  <link rel="stylesheet" type="text/css" href="css/select_box.css" />
  <script src="validacion_formulario.js" type="text/javascript"></script>
  <title>Alta de Empleado</title>
</head>

<body style="background: #0f2027; background: linear-gradient(to right,#2c5364, #203a43, #0f2027">
	
	<?php 
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
	?>
	
	<form method="get" action="validacion_insercion_empleado.php" onsubmit="return ValidarEmpleado()">
		<div class="background">
		  <div class="container">
		    <div class="screen">
		      <div class="screen-header">
		        <div class="screen-header-left">
		          <div class="screen-header-button close" id="divRojo" onclick="cambiarRojo()"></div>
		          <div class="screen-header-button maximize" id="divAmarillo" onclick="cambiarAmarillo()"></div>
		          <div class="screen-header-button minimize" id="divVerde" onclick="cambiarVerde()"></div>
		        </div>
		        <div class="screen-header-right">
		          <div class="screen-header-ellipsis"></div>
		          <div class="screen-header-ellipsis"></div>
		          <div class="screen-header-ellipsis"></div>
		        </div>
		      </div>
		      <div class="screen-body">
		        <div class="screen-body-item left">
		          <div id = "titleAnnadir" class="app-title">
		            <span>AÑADIR</span>
		            <span>EMPLEADOS</span>
		          </div>
		          <div id = "barraTitle" class="app-contact">Bar La Campiña</div>
		        </div>
		        <div class="screen-body-item">
		          <div class="app-form">
		            <div class="app-form-group">
		              <input id="NOMBREEMPLEADOS" type="text" size="20" name="NOMBREEMPLEADOS" class="app-form-control" placeholder="NOMBRE" value="<?php echo $empleado['NOMBREEMPLEADOS'];?>" />
		            </div>
		            <div class="app-form-group">
		              <input id="APELLIDOSEMPLEADOS" type="text" size="20" name="APELLIDOSEMPLEADOS" class="app-form-control" placeholder="APELLIDOS" value="<?php echo $empleado['APELLIDOSEMPLEADOS'];?>" />
		            </div>
		            <div class="app-form-group">
		              <input id="FECHANACIMIENTO" type="date" name="FECHANACIMIENTO" class="app-form-control" placeholder="FECHANACIMIENTO" value="<?php echo $empleado['FECHANACIMIENTO'];?>" />
		            </div>
		            <div class="app-form-group message">
		              <input id="TELEFONOEMPLEADOS" type="text" name="TELEFONOEMPLEADOS" class="app-form-control" placeholder="TELÉFONO" value="<?php echo $empleado['TELEFONOEMPLEADOS'];?>" />
		            </div>
		            <div class="app-form-group message">
		              <input id="CORREOEMPLEADOS" type="text" name="CORREOEMPLEADOS" class="app-form-control" placeholder="CORREO" value="<?php echo $empleado['CORREOEMPLEADOS'];?>" />
		            </div>
		            <div class="app-form-group message">
		              <input id="SALARIO" type="text" name="SALARIO" class="app-form-control" placeholder="SALARIO" value="<?php echo $empleado['SALARIO'];?>" />
		            </div>
		            <!-- <div class="app-form-group message">
		              <input id="PUESTO" type="text" name="PUESTO" class="app-form-control" placeholder="PUESTO" value="<?php echo $empleado['PUESTO'];?>" />
		            </div> -->
		            
			        <select name="PUESTO" id="selectbox" data-selected="">
						<option  selected="selected" disabled="disabled">Elige el puesto</option>
						<option value="Chef">Chef</option>
						<option value="AyudanteChef">AyudanteChef</option>
						<option value="Camarero">Camarero</option>
						<option value="Lavaplatos">Lavaplatos</option>
					</select>
	            	
		            <div class="app-form-group buttons">
		              <button id="btnAnnadir" type="submit" class="app-form-button">AÑADIR</button>	              
					<script>
					var style = document.querySelector('.app-title').style;
					style.setProperty('--background', '#ea1d6f');
					
					function cambiarRojo() {
					  document.getElementById("btnAnnadir").style.color = "#ea1d6f";
					  document.getElementById("titleAnnadir").style.color = "#ea1d6f";
					  style.setProperty('--background', '#ea1d6f');
					}
					
					function cambiarAmarillo() {
					  document.getElementById("btnAnnadir").style.color = "#e8e925";
					  document.getElementById("titleAnnadir").style.color = "#e8e925";
					  style.setProperty('--background', '#e8e925');
					}
					
					function cambiarVerde() {
					  document.getElementById("btnAnnadir").style.color = "#74c54f";
					  document.getElementById("titleAnnadir").style.color = "#74c54f";
					  style.setProperty('--background', '#74c54f');
					}
					</script>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
	</form>
		<!-- <fieldset><legend>Datos</legend>
			<div></div><label for="NOMBREPROVEEDORES">Nombre</label>
			<input id="NOMBREPROVEEDORES" name="NOMBREPROVEEDORES" type="text" size="20" value="<?php echo $proveedor['NOMBREPROVEEDORES'];?>" >
			</div>

			<div><label for="APELLIDOSPROVEEDORES">Apellidos:</label>
			<input id="APELLIDOSPROVEEDORES" name="APELLIDOSPROVEEDORES" type="text" size="40" value="<?php echo $proveedor['APELLIDOSPROVEEDORES'];?>" />
			</div>

			<div><label for="CORREOPROVEEDORES">Correo Electrónico:</label>
			<input id="CORREOPROVEEDORES" type="email" name="CORREOPROVEEDORES" class="app-form-control" placeholder="CONTACT NO" value="<?php echo $proveedor['CORREOPROVEEDORES'];?>" />
			</div>

			<div><label for="TELEFONOPROVEEDORES">Teléfono:</label>
			<input id="TELEFONOPROVEEDORES" name="TELEFONOPROVEEDORES" type="text" pattern="^[0-9]{9}" value="<?php echo $proveedor['TELEFONOPROVEEDORES'];?>" /><br>
			</div>
		</fieldset> 

		<div><input type="submit" value="Añadir" /></div>-->

	
	
	<?php 
		include_once("pie.php");
	?>
	
	</body>
</html>