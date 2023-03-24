<html>
<head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        function mostrar(id) {
            if (id == "in") {
                $("#in").show();
                $("#out").hide();
                $("#main").hide();
            }
            if (id == "out") {
                $("#in").hide();
                $("#out").show();
                $("#main").hide();
            }

        }
    </script>
    <meta charset="UTF-8">
    <?php include('../includes/title.inc');?>
</head>

<link rel="stylesheet" href="dist/kioskboard-1.4.0.min.css" /><script src="dist/kioskboard-1.4.0.min.js"></script>

<Script>
    KioskBoard.Init({
        keysArrayOfObjects: null,
        keysJsonUrl: null,
        specialCharactersObject: null,
        language: 'en', // Language Code (ISO 639-1) for custom keys (for language support) => e.g. "en" || "tr" || "es" || "de" || "fr" etc.
        theme: 'light', // The theme of keyboard => "light" || "dark" || "flat" || "material" || "oldschool"
        capsLockActive: true, // Uppercase or lowercase to start. Uppercase when "true"
        allowRealKeyboard: false, // Allow or prevent real/physical keyboard usage. Prevented when "false"
        cssAnimations: true, // CSS animations for opening or closing the keyboard
        cssAnimationsDuration: 360, // CSS animations duration as millisecond
        cssAnimationsStyle: 'slide', // CSS animations style for opening or closing the keyboard => "slide" || "fade"
        keysAllowSpacebar: true, // Allow or deny Spacebar on the keyboard. The keyboard is denied when "false"
        keysSpacebarText: 'Space', // Text of the space key (spacebar). Without text => " "
        keysFontFamily: 'sans-serif', // Font family of the keys
        keysFontSize: '22px', // Font size of the keys
        keysFontWeight: 'normal', // Font weight of the keys
        keysIconSize: '25px', // Size of the icon keys
        KioskBoard.Run('.js-kioskboard-input');
</script>

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
include('../dbconnection.php');
include ('compania.php');
include ('../header.php');

echo' 
<br><br>

<div id="in" style="display: none;">
    <p style="color: #2e518b; font-size: large;" align="center">Registro de <b><u>INGRESO</u></b></p>
    <form action="visitas.php" method="POST">

        <table width="100%">
            <tr>
                <td width="20%"><h3><b>RUT</b></h3> </td>
                <td width="80%"><h3><input name="rut"  type="value" class="epigrafes" id="rut" size="15" maxlength="8"> - <input name="dv"  type="value" class="epigrafes" id="dv" maxlength="1" size="1"></h3></td>
            </tr>
        </table>

        <table width="100%">

            <tr>
                <td width="20%"> <label>
                        <h3><b>Nombres:</b></h3></label></td>
                <td width="80%"><h3 align="left"><input name="nombres" type="value" class="epigrafes" id="nombres" size="30"></h3></td>
            </tr>

            <tr>
                <td width="20%"> <label>
                        <h3><b>Apellido Paterno:</b></h3></label></td>
                <td width="80%"><h3 align="left"><input name="apellido_paterno" type="value" class="epigrafes" id="apellido_paterno" size="30"></h3></td>
            </tr>

            <tr>
                <td width="20%"> <label>
                        <h3><b>Apellido Materno:</b></h3></label></td>
                <td width="80%"><h3 align="left"><input name="apellido_materno" type="value" class="epigrafes" id="apellido_materno" size="30"></h3></td>
            </tr>

            <tr>
                <td width="20%"> <label>
                        <h3><b>Teléfono:</b></h3></label></td>
                <td width="80%"><h3 align="left"><input name="telefono" type="value" class="epigrafes" id="telefono" size="30"></h3></td>
            </tr>

            <tr>
                <td width="20%"> <label>
                        <h3><b>e-mail:</b></h3></label></td>
                <td width="80%"><h3 align="left"><input name="email" type="value" class="epigrafes" id="email" size="30"></h3></td>
            </tr>


            <tr>
                <td width="20%"> <label>
                        <h3><b>Motivo Ingreso:</b></h3></label></td>
                <td width="80%"><h3 align="left">
                        <select  name="motivo" id="motivo">
                            <optgroup label="Seleccion Motivo">
                                <option value="Retira Material">Retirar Material</option>
                                <option value="Deja Material">Dejar Material</option>
                                <option value="Revision Guardia">Revisión de Guardia</option>
                                <option value="Visita Tecnica">Visita Técnica</option>
                                <option value="Capacitaciones">Cursos y Capacitaciones</option>
                                <option value="Aspirante">Aspirante</option>
                                <option value="Proveedores">Proveedores</option>
                                <option value="Otros">Otros</option>

                            </optgroup>
                        </select>
                    </h3></td>
            </tr>

            <tr>
                <td width="20%"> <label>
                        <h3><b>Autoriza:</b></h3></label></td>
                <td width="80%"><h3 align="left"><input name="autoriza" type="value" class="epigrafes" id="autoriza" size="30"></h3></td>
            </tr>';
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

if (isset($_POST['ingreso'])) {

    $rut = $_POST['rut'];
    $dv = $_POST['dv'];
    $nombres = $_POST['nombres'];
    $apaterno = $_POST['apellido_paterno'];
    $amaterno = $_POST['apellido_materno'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $motivo = $_POST['motivo'];
    $autoriza = $_POST['autoriza'];
    $date = new DateTime("now", new DateTimeZone('America/Santiago'));
    $ingreso = $date->format('Y-m-d H:i');
    $hora_actual = $date->format("H:i");
    $ddjj = $_POST['ddjj'];

    $query = "select * FROM Registro_Visitas WHERE rut = '$rut'";
    $lastrow = "select * from Registro_Visitas where rut = '$rut' order by 1 desc limit 1";

    $sql = "INSERT INTO Registro_Visitas (rut, dv, nombres, apellido_paterno, apellido_materno, email, telefono, compania, motivo, autoriza, ingreso, s_ddjj, evento
)VALUES (
'$rut', '$dv', '$nombres', '$apaterno', '$amaterno', '$email', '$telefono', '$compania','$motivo', '$autoriza', '$ingreso', '$ddjj', 'Ingreso')";
    $conn->query($sql) or die($conn->error);
    if ($res = $conn->query("select * FROM Registro_Visitas WHERE rut = " . $_POST["rut"] . " ")) {
        while ($visitante = $res->fetch_assoc()) {


            echo '<script> alert("Ingreso de ' . $visitante['nombres'] . ' ' . $visitante['apellido_paterno'] . ' ' . $visitante['apellido_materno'] . ' registrado OK a las ' . $hora_actual . '"); window.location = "index.php"; </script>';
        }
    }
}



/* ---------- EGRESO --------- */
if (isset($_POST['egreso'])) {
    $rut = $_POST["rut"];
    $dv = $_POST["dv"];
    $date = new DateTime("now", new DateTimeZone('America/Santiago'));
    $egreso = $date->format('Y-m-d H:i');
    $hora_actual = $date->format("H:i");
    $existe = "select * from Registro_Conductores where Registro_Conductores.rut = '$rut' order by 1 desc limit 1";

    $lastrow = "select * from Registro_Visitas where rut = " . $_POST["rut"] . " AND evento='Ingreso' order by 1 desc limit 1";
    $query = "select * FROM Registro_Visitas WHERE rut = " . $_POST["rut"] . " ";

    if ($res = $conn->query("select * FROM Registro_Visitas WHERE rut = " . $_POST["rut"] . " ")) {
        if (mysqli_num_rows($res) < 1) {
            echo '<script> alert("RUT ' . $rut . ' no encontrado. Verifique haberlo escrito coorectamente y vuelva a intentarlo. Si el error persiste contacte al Oficial de Guardia"); window.location = "index.php"; </script>';
        }
        while ($visitante = $res->fetch_assoc()) {
            if ($result = $conn->query($lastrow)) {
                while ($row = $result->fetch_assoc()) {
                    $conn->query("UPDATE Registro_Visitas set egreso='" . $egreso . "', evento='Egreso' WHERE id=" . $row["id"]) or die($conn->error);
                    echo '<script> alert("Egreso de ' . $visitante['nombres'] . ' ' . $visitante['apellido_paterno'] . ' ' . $visitante['apellido_materno'] . ' registrado OK a las ' . $hora_actual . '"); window.location = "index.php"; </script>';
                }
            }
        }
    }
    if ($noexiste = $conn->query($lastrow) or die($conn->error)) {
        if (mysqli_num_rows($noexiste) < 1) {
            echo '<script> alert("No se encontró un registro de ingreso activo para el RUT ' . $rut . '-' . $dv .'"; window.location = "index.php"; </script>';
        }
    }
}



?>

</html>
