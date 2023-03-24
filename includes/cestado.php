<?php
include('../dbconnection.php');
$estados = $conn -> query ('SELECT * FROM estados ORDER BY id ASC');


echo '
<h2 align="center">Cambio de estado</h2>
<form method="GET">
    <table>
        <tr>
                    <td><h3 style="color: #005cbf"><b>RUT</b></h3> </td>
            <td><h3><input name="rut"  type="value" class="epigrafes" id="rut" size="15" maxlength="8"> - <input name="dv"  type="value" class="epigrafes" id="dv" maxlength="1" size="1"></h3></td>
        </tr>
        <tr>
 <td> <label><b>Estado:</b></label></td>
                <td><p align="left">
                        <select  name="estado" id="estado">
	                    <label="Seleccione"></label>';
    while ($valores = mysqli_fetch_array($estados)) {
        echo '<option value="' . $valores["estado"] . '">' . $valores["estado"] . '</option>';
    }
    echo'
        </tr>
    </table>
    <input type="submit" name="cambioestado" value="GUARDAR" class="botonIN">
    <input type="submit" name="egreso" value="CANCELAR" class="botonOUT" formaction="index.php">
</form>
';

if (isset($_GET['cambioestado'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
    $estado=$_GET['estado'];
    $rut=$_GET['rut'];
    $lastrow = "select * from registro where rut = '$rut' order by 1 desc limit 1";
    if ($result = $conn->query($lastrow) or die($conn->error)) {
        while ($row = $result->fetch_assoc()) {
            $conn->query("UPDATE registro set estado='".$estado."' WHERE id=".$row["id"]."") or die($conn->error);
            echo '<script> alert("OK"); window.location = "index.php"; </script>';
        }
    }
}

?>