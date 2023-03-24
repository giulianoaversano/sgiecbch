<!doctype html>
<html>
<head>
<meta charset="UTF-8">
    <?php include('../includes/title.inc');?>
</head>
<style>
    body {
        font-size:80%;
    }

    /* porcentaje base, solo en el body */
    p {
        font-size:0.9em;
    }
    h1 {
        font-size:2em;
    }
    h2 {
        font-size:1.4em;
    }
    #pie {
        font-size:1.2em;
    }
    .epigrafes {
        font-size:1.1em;
    }

    /* fin de zona común a todas las resoluciones */
    @media screen and (min-width:800px) {
        body {
            font-size:75%;
            /* ampliamos los textos si mide más de 800px */
        }
    }

    /* fin de la zona para más de 800px de ancho de pantalla */
    @media screen and (min-width:1200px) {
        body {
            font-size:75%;
            /* ampliamos más aún los textos si mide más de 1200px */
        }
    }

    /* fin de la zona para más de 1200px de ancho de pantalla */
</style>

<style>
    @media screen and (max-width:480px){
        body {
        h1 {
            font-size: 20px;
        }
        body {
        h2 {
            font-size: 20px;
        }

        h3 {
            font-size: 18px;
        }
    }
    }
    }

</style>

<!-- BOTONES -->
<style type="text/css" media="screen">
    .botonIN {
        border: 1px solid #2e518b; /*anchura, estilo y color borde*/
        padding: 30px; /*espacio alrededor texto*/
        background-color: #2E9B2F; /*color botón*/
        color: #ffffff; /*color texto*/
        text-decoration: none; /*decoración texto*/
        text-transform: uppercase; /*capitalización texto*/
        font-family: 'Helvetica', sans-serif; /*tipografía texto*/
        border-radius: 50px; /*bordes redondos**/
        font-size: 30px;
    }
</style>

<style>
    .botonOUT {
        border: 1px solid #2e518b; /*anchura, estilo y color borde*/
        padding: 30px; /*espacio alrededor texto*/
        background-color: #C0080B; /*color botón*/
        color: #ffffff; /*color texto*/
        text-decoration: none; /*decoración texto*/
        text-transform: uppercase; /*capitalización texto*/
        font-family: 'Helvetica', sans-serif; /*tipografía texto*/
        border-radius: 50px; /*bordes redondos*/
        font-size: 30px;
    }

</style>
<table width="100%" border="0">
  <tbody>
    <tr>
      <td width="148"><img src="../img/logo_cia.png" width="148" height="135" alt=""/></td>
      <td width=""><p>&nbsp;</p>
      <H1 align=center style=color:darkgray><b></b>BOMBA HUECHURABA<b></b></h1>
      <h2 align=center style=color:darkslategray><strong>Registro Tempratura Ingreso/Egreso</strong></h2>
      <p>&nbsp;</p></td>
      <td width="147"><img src="../img/logo_cuerpo.png" width="147" height="125" alt=""/></td>
    </tr>
  </tbody>
</table>

<h2 align="center" style="color:blue"><b>Egreso Forzado</b></h2>
</p>
	<p><br>
</p>
<p>
  <?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
echo'<p align="right">Usuario Registrado: <b>'.$_SESSION["username"].'</b></p>';
echo'<p align="right"> <a align="right" href="logout.php"><b>->salir<-</b></a></p>';

include('dbconnection.php');

	echo'
<form method="POST" action="#ejecutar">	
 <table width="1305">
  <tr>
   <td width="60%" ><b>Registro de Cuerpo</b></td>
   <td width="40%"><h3 align="left"> <input name="reg_cpo"  type="value" class="epigrafes" id="reg_cpo" size="12"></h3></td>
	</tr>
  
  <tr>
    <td width="60%"> <label>
    <h3><b>Fecha y Hora Salida:</b></h3></label></td>
	  <td width="40%"><h3 align="left"><input name="egreso" type="datetime-local" class="epigrafes" id="egreso" size="30"></h3></td>  
    </tr>

	 <tr>
    <td width="60%"> <label>
    <h3><b>Temperatura Salida</b></h3></label></td>
	  <td width="40%"><h3 align="left"><input name="temperatura" type="value" class="epigrafes" id="temperatura" size="6"></h3></td>  
	 </tr>
	 
	 <tr>
    <td width="60%"> <label>
    <h3><b>Registrado por: </b></h3></label></td>
	  <td width="40%"><h3 align="left"><input name="registra" type="value" class="epigrafes" id="registra" size="30"></h3></td>  
    </tr>
	 
  </table>
	<br>
	
	
<input type="submit" name="ejecutar" value="REGISTRAR" class="botonIN" formaction="#ejecutar">
<input type="submit" name="back" value="Regresar" class="botonOUT" formaction="index.php">
</form>';

  if (isset($_POST['ejecutar'])) {

      $query = "select * FROM nomina WHERE reg_cpo = $_POST[reg_cpo]";
      $lastrow = "select * from registro where reg_cpo = " . $_POST["reg_cpo"] . " order by 1 desc limit 1";


      $reg_cpo = $_post[reg_cpo];
      $temperatura = $_POST[temperatura];
      $temperatura = doubleval(str_replace(",", ".", $temperatura));
      $date = new DateTime("now", new DateTimeZone('America/Santiago'));
      $egreso = $date->format('Y-m-d H:i');


      if ($result = $conn->query($lastrow) or die($conn->error)) {
          while ($row = $result->fetch_assoc()) {
              if ($row["evento"] == 'Ingreso') {
                  if ($row["egreso"] == NULL) {
                      $conn->query("UPDATE registro set egreso='" . $egreso . "', temp_salida='" . $temperatura . "', evento='Egreso', registra='" . $_POST[registra] . "' WHERE id=" . $row["id"] . "") or die($conn->error);
                      echo '<script> alert("Egreso Forzado realizado correctamente"); window.location = "index.php"; </script>';
                  }
              }
              if ($row["evento"] == 'Egreso') {
                  echo '<script> alert("No se encuentra registro. Verifique información"); window.location = "index.php"; </script>';
              } else {
                  echo 'No hay acciones que realizar';
              }
          }
      }
  }

	
	$conn->close();
	
	
	
	?>
	
  
</body>
</html>	
