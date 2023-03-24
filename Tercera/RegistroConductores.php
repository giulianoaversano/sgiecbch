<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <?php include('../includes/title.inc');?>
</head>
<style type="text/css" media="screen">
    .botonIN {
        border: 1px solid #2e518b; /*anchura, estilo y color borde*/
        padding: 10px; /*espacio alrededor texto*/
        background-color: #2E9B2F; /*color botón*/
        color: #ffffff; /*color texto*/
        text-decoration: none; /*decoración texto*/
        text-transform: uppercase; /*capitalización texto*/
        font-family: 'Helvetica', sans-serif; /*tipografía texto*/
        border-radius: 50px; /*bordes redondos*/
    }
</style>

<style>
    .botonOUT {
        border: 1px solid #2e518b; /*anchura, estilo y color borde*/
        padding: 10px; /*espacio alrededor texto*/
        background-color: #C0080B; /*color botón*/
        color: #ffffff; /*color texto*/
        text-decoration: none; /*decoración texto*/
        text-transform: uppercase; /*capitalización texto*/
        font-family: 'Helvetica', sans-serif; /*tipografía texto*/
        border-radius: 50px; /*bordes redondos*/
    }

</style>
<?php
include('dbconnection.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include ('compania.php');

include ('../header.php');
echo '
<br><br>
	<h1 align="center">Registro Conductores</h1>
<form method="POST" action="registrar">	
 <table height="130">
  <tr>
   <td width="25%"> <h1><b>RUT</b></h1></td>
   <td> <input style="font-size:30px" maxlength="8" size="8" type="value" name="rut" id="rut"></td><td><p>-</p></td><td><input style="font-size:30px" maxlength="1" size="1" type="value" name="dv" id="dv"></td>
	</tr>
	
	</table>
	<br><br>
	
	
<input type="submit" name="registrar" value="Registrar" class="botonIN" formaction="#registrar">
<input type="submit" name="regresar" value="Regresar" class="botonOUT" formaction="index.php">
    
</form>';

if (isset($_POST['registrar'])) {

    $rut = $_POST["rut"];
    $dv = $_POST["dv"];
    $date = new DateTime("now", new DateTimeZone('America/Santiago'));
    $fecha = $date->format('Y-m-d H:i');

    $existe = "select * from Registro_Conductores where rut = '$rut' AND dv = '$dv' order by 1 desc limit 1";
    $esconductor = "Select * from nomina where rut = '$rut' AND dv='$dv' AND conductor = 'Si' ";


    if ($result = $conn->query($esconductor) or die($conn->error)) {
        if (mysqli_num_rows($result) > 0) {
            if ($result = $conn->query($existe) or die($conn->error)) {
                while ($row = $result->fetch_assoc()) {
                    if ($row["status"] == 'Ingreso') {
                        $conn->query("UPDATE Registro_Conductores SET rut='$rut',egreso='$fecha',status='Egreso' WHERE id=" . $row["id"] . "") or die($conn->error);
                        echo '<script> alert("Egreso OK"); window.location = "index.php";</script>';
                    }
                    if ($row["status"] == 'Egreso') {
                        if (mysqli_num_rows($result) > 0) {
                            $conn->query("INSERT INTO Registro_Conductores(rut,dv,ingreso, status, compania) VALUES ('$rut','$dv', '$fecha', 'Ingreso', '$compania')") or die($conn->error);
                            echo '<script> alert("Ingreso OK"); window.location = "index.php"; </script>';
                        }

                    }
                }
            }
        } else {
            echo '<script> alert("No es Conductor Autorizado");  window.location = "index.php";</script>';
        }
    }
}


$conn->close();



?>




</body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<footer>
    <table width="100%">
        <tr>
            <td><p align="left">Bomba Huechuraba - 2021 - Todos los derechos reservados</p></td><h1></h1>
            <td><p align="center">Modulo FI.01</p></td>
            <td></td>
        </tr>
    </table>
</footer>


</html>
