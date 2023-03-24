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

    $existe = "select * from Registro_Conductores where rut = '$rut' AND dv = '$dv' order by 1 desc LIMIT 1";
    $esconductor = "Select * from nomina where rut = '$rut' AND dv='$dv' AND conductor = 'Si' ";
    $checkstatus = "SELECT * FROM Registro_Conductores WHERE rut =  '$rut' AND dv = '$dv' AND status = 'Ingreso'";

    if ($result = $conn->query($esconductor) or die($conn->error)) {
        if (mysqli_num_rows($result) > 0) {
            while ($persona = $result->fetch_assoc()) {
                if ($resexiste = $conn->query($existe) or die($conn->error)) {
                    if (mysqli_num_rows($resexiste) < 1) {
                        $conn->query("INSERT INTO Registro_Conductores(rut,dv,ingreso, status, compania) VALUES ('$rut','$dv', '$fecha', 'Ingreso', '$compania')") or die($conn->error);
                        echo '<script> alert("Conductor  ' . $persona['nombres'] . ' ' . $persona['apellido_paterno'] . ' ' . $persona['apellido_materno'] . '  Ingresa OK"); window.location = "index.php"; </script>';
#               echo '<script> alert("Ingreso de ' . $bombero['nombres'] . ' ' . $bombero['apellido_paterno'] . ' ' . $bombero['apellido_materno'] . ' registrado correctamente a las ' . $hora_actual . '. [Estado:' . $estado . ']"); window.location = "index.php"; </script>';
                    }

                    if (mysqli_num_rows($resexiste) >= 1) {
                        while ($row = $resexiste->fetch_assoc()) {
                            if ($row["status"] == 'Ingreso') {
                                $conn->query("UPDATE Registro_Conductores SET rut='$rut',egreso='$fecha',status='Egreso' WHERE id=" . $row["id"] . "") or die($conn->error);
                                echo '<script> alert("EGRESO de Conductor  ' . $persona['nombres'] . ' ' . $persona['apellido_paterno'] . ' ' . $persona['apellido_materno'] . ' OK"); window.location = "index.php"; </script>';
                            }
                            if ($row["status"] == 'Egreso') {
                                $conn->query("INSERT INTO Registro_Conductores(rut,dv,ingreso, status, compania) VALUES ('$rut','$dv', '$fecha', 'Ingreso', '$compania')") or die($conn->error);
                                echo '<script> alert("INGRESO de Conductor  ' . $persona['nombres'] . ' ' . $persona['apellido_paterno'] . ' ' . $persona['apellido_materno'] . '  OK"); window.location = "index.php"; </script>';
                            }
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