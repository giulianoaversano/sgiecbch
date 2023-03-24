<head>
    <style>
        body{
            font-family: 'Verdana', sans-serif;
        }
    </style>
</head>

<?php
include('../dbconnection.php');

$estados = $conn -> query ('SELECT * FROM estados ORDER BY id ASC');
include ('compania.php');
include ('../header.php');
echo'
<br><br>

<div id="in" style="display: none;">
    <p style="color: #2e518b; font-size: large;" align="center">Registro de <b><u>INGRESO</u></b></p>
    <form action="Registro.php" method="post">

            <table>
                <tr>
                    <td><h3 style="color: #005cbf"><b>RUT</b></h3> </td>
                    <td><h3><input name="rut"  type="value" class="epigrafes" id="rut" size="15" maxlength="8"> - <input name="dv"  type="value" class="epigrafes" id="dv" maxlength="1" size="1"></h3></td>
                </tr>
           
  
     <tr style="height: 10px"></tr>
            <tr>
     <td> <label><b>Estado:</b></label></td>
                <td><p align="left">
                        <select  name="estado" id="estado">
	                    <label="Seleccione"></label>';
while ($valores = mysqli_fetch_array($estados)) {
    echo '<option value="' . $valores["estado"] . '">' . $valores["estado"] . '</option>';
}
echo'
             </select>
           
         </p></td>
     </tr>
     <tr style="height: 30px"></tr>';
?>

        <tr>
            <td colspan="4" align="Left" style="color: red"> <b><u> Declaración Jurada </u></b></td>
        </tr><tr>
        <td colspan="4">
            Al ingresar, ud declara que:<br>
            * En las últimas 24 horas ud no ha tenido síntomas de SARS CoV2 (COVID)<br>
            * Ud. No ha estado en contacto directo con ninguna persona que haya sido diagnosticada como SARS CoV 2 (COVID) <u>POSITIVO</u><br><br>

        <b><u>Posibles síntomas:</u></b><br>
        - Fiebre (>37,5°C)<br>
        - Pérdida total/parcial de Olfato<br>
        - Pérdida total/parcial de Gusto<br>
        - Tos aguda y severa<br>
        - Congestión nasal<br>
        - Taquipnea (respiración agitada)<br>
        - Dolor de garganta<br>
        - Dolor muscular<br>
        - Fatiga<br>
        - Dolor de Pecho<br>
        - Diarrea<br>
        - Pérdida de apetito, náuseas, vómitos<br>
        - Dolor de cabeza<br><br>
        En caso de presentar cualquiera de los síntomas arriba descriptos, deberá informarlos al Oficial de Guardia previo al ingreso y solicitar autorización para el ingreso.<br>
        En caso de autorizarse el ingreso, se deberá dejar constancia de dichos síntomas en libro de novedades.<br><br>

        <b>En caso de comprobarse falsedad en la declaración de la causal invocada, para requerir el presente documento, se incurrirá en las penas del artículo 210 del Código Penal y del órden del dia Nº012-2021</b><br><BR>

    </td>
    <tr><td colspan="4">
        <input type="checkbox" name="ddjj" id="ddjj" value="X"> <a style="font-size: 18px; color: blue"> He leido lo anterior y confirmo bajo declaración jurada que mi ingreso a las dependencias no representa un riesgo a la salud. </a></tr>
    <script>
        $('#ddjj').click(function(){
            //If the checkbox is checked.
            if($(this).is(':checked')){
                //Enable the submit button.
                $('#ingreso').attr("disabled", false);
            } else{
                //If it is not checked, disable the button.
                $('#ingreso').attr("disabled", true);
            }
        });   </script>

    </td></tr>

    </tr>
    </table>
    <br><br>
    <input type="submit" id="ingreso" name="ingreso" value="INGRESO" class="botonIN" formaction="#ingreso" disabled>
    <input type="submit" name="regresar" value="REGRESAR" class="botonOUT" formaction="index.php">
    </p>

    </form>


    </div>

    <div id="out" style="display: none;">
        <p style="color: #2e518b; font-size: large;" align="center">Registro de <b><u>EGRESO</u></b></p>
        <form action="Registro.php" method="post">

            <table>
                <tr>
                    <td><h3 style="color: #005cbf"><b>RUT</b></h3> </td>
                    <td><h3><input name="rut"  type="value" class="epigrafes" id="rut" size="15" maxlength="8"> - <input name="dv"  type="value" class="epigrafes" id="dv" maxlength="1" size="1"></h3></td>
                </tr>
            </table>

            <br><br>
            <input type="submit" id="egreso" name="egreso" value="EGRESO" class="botonIN" formaction="#egreso">
            <input type="submit" name="regresar" value="REGRESAR" class="botonOUT" formaction="index.php">
            </p>

        </form>
    </div>

    <div id="main">
        <form action="Registro.php" method="post">
            Estado actual:
            <select id="status" name="status" onchange="mostrar(this.value);">
                <option value="" selected disabled hidden>Seleccione</option>
                <option value="in">Ingreso</option>
                <option value="out">Egreso</option>
            </select>
        </form>
    </div>





<?php
#ini_set('display_errors', 0);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);
include('dbconnection.php');

if (isset($_POST['ingreso'])) {
    $rut = $_POST['rut'];
    $dv = $_POST['dv'];
    $temperatura = $_POST['temperatura'];
    $temperatura = doubleval(str_replace(",", ".", $temperatura));
    $date = new DateTime("now", new DateTimeZone('America/Santiago'));
    $ingreso = $date->format('Y-m-d H:i');
    $estado = $_POST['estado'];
    $hora_actual = $date->format("H:i");

    $ddjj = $_POST['ddjj'];
    $query = "select * FROM nomina WHERE rut = '$rut' AND dv='$dv'";
    $lastrow = "select * from registro where rut = '$rut' AND dv ='$dv' order by 1 desc limit 1";

    $sql = "INSERT INTO registro (compania, rut, dv, ingreso, estado, temp_ingreso, s_ddjj, evento) VALUES ('$compania','$rut', '$dv', '$ingreso', '$estado', '$temperatura', '$ddjj', 'Ingreso')";

    $changedisponible = "UPDATE registro SET estado = 'No Disponible', evento = 'Egreso', egreso = '$ingreso'  WHERE rut = '$rut' and estado = 'Disponible'";
    $fuerzasalida = "UPDATE registro SET estado = 'No Disponible', evento = 'Egreso', egreso = '$ingreso' WHERE rut = '$rut' AND evento = 'Ingreso'";
    $cuarte = "SELECT cargo FROM nomina WHERE rut='$rut'";


    if ($res = $conn->query("select * FROM nomina WHERE rut = '$rut' AND dv = '$dv' " )) {
        while ($bombero = $res->fetch_assoc()) {

            if ($existe = $conn->query($lastrow) or die($conn->error)) {
                if (mysqli_num_rows($existe) >= 1) {
                    $conn->query($fuerzasalida) or die($conn->error);
                    $conn->query($changedisponible) or die($conn->error);
                    $conn->query($sql) or die($conn->error);

                    // Ingreso Cuarteleros
                    if ($result = $conn->query($cuarte) or die($conn->error)) {
                        while ($row = $result->fetch_assoc()) {
                            if ($row['cargo']=='Cuartelero'){
                                $conn->query("INSERT into Registro_Conductores (rut, dv, ingreso, status, compania) VALUES ('$rut', '$dv', '$ingreso', 'Ingreso', '$compania')");
                            }
                        }
                    }

                    echo '<script> alert("Ingreso de ' . $bombero['nombres'] . ' ' . $bombero['apellido_paterno'] . ' ' . $bombero['apellido_materno'] . ' registrado correctamente a las ' . $hora_actual . '. [Estado:' . $estado . ']"); window.location = "index.php"; </script>';
                } else {
                    $conn->query($sql) or die($conn->error);
                    // Ingreso Cuarteleros
                    if ($result = $conn->query($cuarte) or die($conn->error)) {
                        while ($row = $result->fetch_assoc()) {
                            if ($row['cargo']=='Cuartelero'){
                                $conn->query("INSERT into Registro_Conductores (rut, dv, ingreso, status, compania) VALUES ('$rut', '$dv', '$ingreso', 'Ingreso', '$compania')");
                            }
                        }
                    }
                    echo '<script> alert("Ingreso de ' . $bombero['nombres'] . ' ' . $bombero['apellido_paterno'] . ' ' . $bombero['apellido_materno'] . ' registrado correctamente a las ' . $hora_actual . '. [Estado:' . $estado . ']"); window.location = "index.php"; </script>';

                }
            }



        }
    }

    if ($res = $conn->query("select * FROM nomina WHERE rut = '$rut' AND dv='$dv'")) {
        if (mysqli_num_rows($res) < 1) {
            echo '<script> alert("RUT ' . $rut . ' no encontrado. Verifique haberlo escrito coorectamente y vuelva a intentarlo. Si el error persiste contacte al Oficial de Guardia"); window.location = "index.php"; </script>';
        }
    }
}
/* ---------- EGRESO --------- */
if (isset($_POST['egreso'])) {
    $rut = $_POST["rut"];
    $dv = $_POST["dv"];
    $date = new DateTime("now", new DateTimeZone('America/Santiago'));
    $egreso = $date->format('Y-m-d H:i');
    $estado = 'No Disponible';
    $hora_actual = $date->format("H:i");
    $existe = "select * from Registro_Conductores where Registro_Conductores.rut = '$rut' AND dv = '$dv' order by 1 desc limit 1";
    $esconductor = "Select * from nomina where rut = '$rut' AND dv = '$dv' AND conductor = 'Si' ";

    $lastrow = "select * from registro where rut = " . $_POST["rut"] . " AND dv='$dv' AND evento='Ingreso' order by 1 desc limit 1";
    $lastrowcond = "select * from Registro_Conductores where rut = '$rut' AND status='Ingreso' order by 1 desc limit 1";

    $sql = "INSERT INTO registro (rut,dv, egreso, evento,estado, temp_salida) VALUES ('$rut', $dv,'$egreso', 'Egreso', '$estado', $temperatura)";
    $query = "select * FROM nomina WHERE rut = " . $_POST["rut"] . " ";
    $cuarte = "SELECT conductor FROM nomina WHERE rut='$rut'";

    if ($res = $conn->query("select * FROM nomina WHERE rut = " . $_POST["rut"] . " AND dv = '$dv'")) {
        if (mysqli_num_rows($res)<1){
            echo '<script> alert("RUT ' . $rut . '-'.$dv.' no encontrado. Verifique haberlo escrito coorectamente y vuelva a intentarlo. Si el error persiste contacte al Oficial de Guardia"); window.location = "index.php"; </script>';
        }
        while ($bombero = $res->fetch_assoc()) {
            if ($result = $conn->query($lastrow)) {
                while ($row = $result->fetch_assoc()) {
                    if ($row["evento"] == 'Ingreso') {
                        if ($row["ingreso"] != NULL) {

                            $conn->query("UPDATE registro set egreso='" . $egreso . "', estado='" . $estado . "', evento='Egreso' WHERE id='" . $row["id"] . "'") or die($conn->error);

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

                            echo '<script> alert("Egreso de ' . $bombero['nombres'] . ' ' . $bombero['apellido_paterno'] . ' ' . $bombero['apellido_materno'] . ' registrado OK a las ' . $hora_actual . '. [Estado Externo:' . $estado . ']"); window.location = "index.php"; </script>';
                        }
                    }
                }
            }
            if ($noexiste = $conn->query($lastrow) or die($conn->error)) {
                if (mysqli_num_rows($noexiste) < 1) {
                    echo '<script> alert("No se encontró un registro de ingreso activo para el RUT ' . $rut . ' (' . $bombero['nombres'] . ' ' . $bombero['apellido_paterno'] . ' ' . $bombero['apellido_materno'] . ') Realice su ingreso antes de realizar el egreso. "); window.location = "index.php"; </script>';
                }
            }
        }
    }
}



?>