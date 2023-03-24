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
        <td width="147"><img src="../img/logo_cuerpo.png" width="147" height="125" alt=""/></td>
      <td width=""><p>&nbsp;</p>
      <H1 align=center style=color:darkgray><b></b>CUERPO DE BOMBEROS DE CONCHALÍ-HUECHURABA<b></b></h1>
      <h2 align=center style=color:darkslategray><strong>Registro Tempratura Ingreso/Egreso</strong></h2>
      <p>&nbsp;</p></td>
    </tr>
  </tbody>
</table>

<h2 align="center" style="color:blue"><b>Egreso Forzado</b></h2>
</p>
	<p><br>
</p>

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

  $user = "SELECT compania FROM Users where username='$_SESSION[username]'";
  if ($resuser = $conn->query($user)) {
      while ($ruser = $resuser->fetch_assoc()) {
          $usrcia = $ruser['compania'];
      }
  }


  if(!isset($_SESSION["nivel"]) || ($_SESSION["nivel"] < 2 )) {
      echo '
<p> <b>Permiso Denegado</b>. 
Esta actividad ha sido registrada y reportada</p>';
  }
  if(!isset($_SESSION["nivel"]) || ($_SESSION["nivel"] > 1 ) & ($_SESSION["nivel"] < 4 )) {
      // RETRIEVE DATA ///
      $sqlin = $conn->query("SELECT * from nomina, registro where evento='Ingreso' AND registro.rut = nomina.rut AND registro.compania='$usrcia' order by registro.compania");
      $sqlcuarteleros = $conn->query("SELECT * from nomina, Registro_Conductores where Registro_Conductores.status='Ingreso' AND Registro_Conductores.rut = nomina.rut AND Registro_Conductores.compania='$usrcia' order by Registro_Conductores.compania");


      echo ' 
<form method="POST" action="#ejecutar">	
 <table width="1305">
  <tr>
   <td width="60%" ><b>Forzar salida de:</b></td>
   <td>
   <select  name="rut" id="rut">
  		<optgroup label="Seleccione">
	    ';


      while ($rowin = mysqli_fetch_array($sqlin)) {
          echo '<option value="' . $rowin["rut"] . '">' . $rowin["rut"] . ' - ' . $rowin["nombres"] . ' ' . $rowin["apellido_paterno"] . ' ' . $rowin["apellido_materno"] . '</option>';
      }
      while ($rowcond = mysqli_fetch_array($sqlcuarteleros)) {
          echo '<option value="' . $rowcond["rut"] . '">' . $rowcond["rut"] . ' - ' . $rowcond["nombres"] . ' ' . $rowcond["apellido_paterno"] . ' ' . $rowcond["apellido_materno"] . '</option>';
      }
      echo '
    </optgroup>
			</select>
   
</td>
	</tr>
  
  <tr>
    <td width="60%"> <label>
    <h3><b>Fecha y Hora Salida:</b></h3></label></td>
	  <td width="40%"><h3 align="left"><input name="egreso" type="datetime-local" class="epigrafes" id="egreso" size="30"></h3></td>  
    </tr>
	 
  </table>
	<br>
	
	
<input type="submit" name="ejecutar" value="REGISTRAR" class="botonIN" formaction="#ejecutar">
<input type="submit" name="back" value="Regresar" class="botonOUT" formaction="index.php">
</form>';
  }

  if(!isset($_SESSION["nivel"]) || ($_SESSION["nivel"] === 4 )) {

// RETRIEVE DATA ///
      $sqlin = $conn->query("SELECT * from nomina, registro where evento='Ingreso' AND registro.rut = nomina.rut order by registro.compania");
      $sqlcuarteleros = $conn->query("SELECT * from nomina, Registro_Conductores where Registro_Conductores.status='Ingreso' AND Registro_Conductores.rut = nomina.rut order by Registro_Conductores.compania");


      echo ' 
<form method="POST" action="#ejecutar">	
 <table width="1305">
  <tr>
   <td width="60%" ><b>Forzar salida de:</b></td>
   <td>
   <select  name="rut" id="rut">
  		<optgroup label="Seleccione Bombero">
	    ';

      while ($rowin = mysqli_fetch_array($sqlin)) {
          echo '<option value="' . $rowin["rut"] . '">' . $rowin["rut"] . ' - ' . $rowin["nombres"] . ' ' . $rowin["apellido_paterno"] . ' ' . $rowin["apellido_materno"] . '</option>';
      }
      echo '
    </optgroup>
      		<optgroup label="Seleccione Cuartelero">';

      while ($rowcond = mysqli_fetch_array($sqlcuarteleros)) {
          echo '<option value="' . $rowcond["rut"] . '">' . $rowcond["rut"] . ' - ' . $rowcond["nombres"] . ' ' . $rowcond["apellido_paterno"] . ' ' . $rowcond["apellido_materno"] . '</option>';
      }

      echo '
    </optgroup>
			</select>
   
</td>
	</tr>
  
  <tr>
    <td width="60%"> <label>
    <h3><b>Fecha y Hora Salida:</b></h3></label></td>
	  <td width="40%"><h3 align="left"><input name="egreso" type="datetime-local" class="epigrafes" id="egreso" size="30"></h3></td>  
    </tr>
	 
  </table>
	<br>
	
	
<input type="submit" name="ejecutar" value="REGISTRAR" class="botonIN" formaction="#ejecutar">
<input type="submit" name="back" value="Regresar" class="botonOUT" formaction="index.php">
</form>';
  }


  if (isset($_POST['ejecutar'])) {
      $rut = $_POST['rut'];

      $query = "select * FROM nomina WHERE rut = '$rut'";
      $lastrow = "select * from registro where rut = '$rut' AND evento='Ingreso' order by 1 desc limit 1";
      $lastrowcond = "select * from Registro_Conductores where rut = '$rut' AND status='Ingreso' order by 1 desc limit 1";
      $registra = $_SESSION['username'];
      $estado = 'No Disponible';


      $dateOLD = new DateTime("now", new DateTimeZone('America/Santiago'));
      $date = new DateTime("now", new DateTimeZone('America/Santiago'));
      $hora_actual = $date->format("H:i");

      $egreso = $date->format('Y-m-d H:i');
      $disponible = 'No Disponible';

      $cuarte = "SELECT conductor FROM nomina WHERE rut='$rut'";

      if ($res = $conn->query("select * FROM nomina WHERE rut = '" . $rut . "'")) {
          if (mysqli_num_rows($res) < 1) {
              echo '<script> alert("RUT ' . $rut . ' no encontrado. Verifique haberlo escrito coorectamente y vuelva a intentarlo. Si el error persiste contacte al Oficial de Guardia"); window.location = "index.php"; </script>';
          }

          while ($bombero = $res->fetch_assoc()) {
              if ($result = $conn->query($lastrow)) {
                  while ($row = $result->fetch_assoc()) {
                      if ($row["evento"] == 'Ingreso') {
                          if ($row["ingreso"] != NULL) {
                              $conn->query("UPDATE registro set egreso='" . $egreso . "', estado='" . $estado . "', evento='Egreso', registra='" . $registra . "' WHERE id='" . $row["id"] . "'") or die($conn->error);
                          }
                      }
                  }
              }


// EGRESO CONDUCTORES
              if ($result = $conn->query($lastrowcond)) {
                  while ($rowcond = $result->fetch_assoc()) {
                      if ($rowcond["status"] == 'Ingreso') {
                          if ($rowcond["ingreso"] != NULL) {
                              $conn->query("UPDATE Registro_Conductores set egreso='" . $egreso . "', status='Egreso' WHERE id='" . $rowcond["id"] . "'") or die($conn->error);
                          }
                      }
                  }
              }
// FIN EGRESO CONDUCTORES


              echo '<script> alert("Egreso FORZADO de ' . $bombero['nombres'] . ' ' . $bombero['apellido_paterno'] . ' ' . $bombero['apellido_materno'] . ' registrado OK a las ' . $hora_actual . '. [Estado Externo:' . $estado . ']"); window.location = "index.php"; </script>';
          }
      }
  }


	
	$conn->close();
	
	
	
	?>
	
  
</body>
</html>	
