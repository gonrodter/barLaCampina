<?php
    session_start();

    if (!isset($_SESSION['gestion'])) {
        $gestion['MESAGUALUZ'] = "";
        $gestion['CANTIDADAGUALUZ'] = "";


        $_SESSION['gestion'] = $gestion;
    }
    else
        $gestion = $_SESSION['gestion'];
            
    if (isset($_SESSION["errores"]))
        $errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/form_insercion.css" />
  <script src="validacion_formulario.js" type="text/javascript"></script>
  <title>Alta de Gastos</title>
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
    
    <form method="get" action="validacion_insercion_gastosfijos.php" <!-- onsubmit="return ValidarCuenta() -->">
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
                    <span>Gastos</span>
                  </div>
                  <div id = "barraTitle" class="app-contact">Bar La Campiña</div>
                </div>
                <div class="screen-body-item">
                  <div class="app-form">
                    <div class="app-form-group">
                      <input id="MESAGUALUZ" type="text" name="MESAGUALUZ" class="app-form-control" placeholder="Mes" value="<?php echo $gestion['MESAGUALUZ'];?>" />
                    </div>
                    <div class="app-form-group">
                      <input id="CANTIDADAGUALUZ" type="text" name="CANTIDADAGUALUZ" class="app-form-control" placeholder="Gasto mensual de agua y luz" value="<?php echo $gestion['CANTIDADAGUALUZ'];?>" />
                    </div>
                  
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
    <?php
        include_once("pie.php");
    ?>
    
    </body>
</html>