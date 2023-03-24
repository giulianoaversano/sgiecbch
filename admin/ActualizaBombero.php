

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
            font-size:100%;
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
            font-size: 18px;
        }

        h3 {
            font-size: 16px;
        }
    }
    }
    }

</style>

<!-- BOTONES -->
<style type="text/css" media="screen">
    .botonIN {
        border: 1px solid #2e518b; /*anchura, estilo y color borde*/
        padding: 10px; /*espacio alrededor texto*/
        background-color: #2E9B2F; /*color botón*/
        color: #ffffff; /*color texto*/
        text-decoration: none; /*decoración texto*/
        text-transform: uppercase; /*capitalización texto*/
        font-family: 'Helvetica', sans-serif; /*tipografía texto*/
        border-radius: 50px; /*bordes redondos**/
        font-size: 15px;
    }

    .botonOUT {
        border: 1px solid #2e518b; /*anchura, estilo y color borde*/
        padding: 10px; /*espacio alrededor texto*/
        background-color: #C0080B; /*color botón*/
        color: #ffffff; /*color texto*/
        text-decoration: none; /*decoración texto*/
        text-transform: uppercase; /*capitalización texto*/
        font-family: 'Helvetica', sans-serif; /*tipografía texto*/
        border-radius: 50px; /*bordes redondos*/
        font-size: 15px;
    }

</style>


<table width="100%" border="0">
    <tbody>
    <tr>
        <td width="12%"><img src="../img/logo_cuerpo.png" width="147" height="" alt=""/></td>
        <td width="77%"><p>&nbsp;</p>
            <h1 align="center" style="color:darkgray"><b></b>Cuerpo Bomberos Conchalí-Huechuraba<b></b></h1>
            <h2 align="center" style="color:darkslategray"><strong>Registro Temperatura Ingreso/Egreso</strong></h2>
            <p>&nbsp;</p></td>
    </tr>
    </tbody>
</table>
<h3 align="center">ACTUALIZAR DATOS DE NOMINA</h3>
    
<?php


session_start();
include ('dbconnection.php');
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo' <p align="right">Usuario Registrado: <b>' . $_SESSION["username"] . ' </b> (' . $_SESSION["nombres"] . ' ' .$_SESSION["apellido_paterno"] . ' ' . $_SESSION["apellido_materno"].')</p>';
echo '<p align="right">Nivel: <b> '. $_SESSION["nivel"].' </b></p>';

echo ' <p align="right" style="color: #d62516"> <a style="color: #d62516;" href="logout.php"> <<< Salir >>> </b></a></p>';

$cargos = $conn -> query ("SELECT * FROM cargos");
$jefes = $conn -> query ("SELECT * FROM nomina,cargos WHERE esjefe='Si' AND nomina.cargo = cargos.cargo ORDER BY nomina.clave");
$companias = $conn -> query ("SELECT * FROM companias");


if(!isset($_SESSION["nivel"]) || $_SESSION["nivel"] >= 3) {


    echo '
<form method="POST" action="#buscar" enctype="multipart/form-data">
    <table>
        <tr>
            <td > <label><h3><b>Registro de Cuerpo</b></h3></label></td>
            <td><h1 align="left"> <input name="reg_cpo"  type="value" class="epigrafes" id="reg_cpo" size="4"></h1></td>
            <td> <input type="submit" name="buscar" value="Buscar" formaction=#buscar></td>
   </tr>
    </table>

    </form>
    
    <form method="POST" action="#buscarut">
    <table>
        <tr>
            <td > <label><h3><b>RUT</b></h3></label></td>
            <td><h1 align="left"> <input name="rut"  type="value" class="epigrafes" id="rut" size="8">-<input name="dv"  type="value" class="epigrafes" id="dv" size="1"></h1></td>
            <td> <input type="submit" name="buscarut" value="Buscar" formaction=#buscarut></td>
   </tr>
    </table>

    </form>
    
';
    if (isset($_POST['buscar'])) {
        $reg_cpo = $_POST['reg_cpo'];
        $sql = "SELECT * FROM nomina WHERE reg_cpo = '$reg_cpo' order by 1 desc limit 1";


        if ($result = $conn->query($sql) or die($conn->error)) {
            if (mysqli_num_rows($result) > 0) {

                while ($row = $result->fetch_assoc()) {
                    $sqlfoto = "select * from foto_ficha where rut='$row[rut]'";
                    $resfoto = mysqli_query($conn, $sqlfoto);
                    $rfoto = mysqli_fetch_array($resfoto);
                    $image_src = $rfoto['image'];

                    echo '
<form method="POST" action="#actualizar" enctype="multipart/form-data">
<table width="100%">
<!-- DATOS PERSONALES -->
<tr>
<br><br><hr><br><br>
<h1 align="center" style="color: #005cbf"><b><u>INFORMACIÓN PERSONAL</u></b></h1>
<td>
<div align="center">
<h3><label>RUT</label></h3>
<input type=value name=rut value=' . $row["rut"] . ' size="8" maxlength="8">-<input type=value name=dv value=' . $row["dv"] . ' size="1" maxlength="1"></div>
</td>
<br>
<td>
<div align="center">
<h3><label>Nombres</label></h3>
<input type=value name=nombres value="' . $row["nombres"] . '">
</div>
</td>
<br>

<td>
<div align="center">
<h3><label>Apellido Paterno</label></h3>
<input size="20" type=value name=apellido_paterno value="' . $row["apellido_paterno"] . '">
</div>
</td>

<td>
<div align="center">
<h3><label>Apellido Materno</label></h3>
<input size="20" type=value name=apellido_materno value="' . $row["apellido_materno"] . '">
</div>
</td>

<td>
<div align="center">
<h3><label>e-Mail</label></h3>
<input size="30" type=value name=email value="' . $row["email"] . '">
</div>
</td>

<td>
<div align="center">
<h3><label>Telefono</label></h3>
<input size="30" type=value name=telefono value="' . $row["telefono"] . '">
</div>
</td>

<td>
<div align="center">
<h3><label>Profesion</label></h3>
<input size="30" type=value name=profesion value="' . $row["profesion"] . '">
</div>
</td>

<td>
<div align="center">
<h3><label>Foto Perfil</label></h3>
<img src=' . $image_src . ' width="130" height="130"><br>
<input type="file" id="foto" name="foto">	
</td>
</tr>
</div>
</td>
</tr>
</table>
<br><br>
<table width="100%">
<tr>
<td colspan="6"><h2 align="center" style="color: #005cbf">Dirección</h2></td>
</tr>

<td>
<div align="center">
<h3><label>Calle</label></h3>
<input maxlength="50" type=value name=dir_calle value="' . $row["dir_calle"] . '">
</div>
</td>

<td>
<div align="center">
<h3><label>Número</label></h3>
<input maxlength="10" type=value name=dir_numero value="' . $row["dir_numero"] . '">
</div>
</td>


<td>
<div align="center">
<h3><label>Condominio</label></h3>
<input maxlength="50" type=value name=dir_condominio value="' . $row["dir_condominio"] . '">
</div>
</td>

<td>
<div align="center">
<h3><label>Comuna</label></h3>
<input maxlength="50" type=value name=dir_comuna value="' . $row["dir_comuna"] . '">
</div>
</td>

<td>
<div align="center">
<h3><label>Ciudad</label></h3>
<input maxlength="50" type=value name=dir_ciudad value="' . $row["dir_ciudad"] . '">
</div>
</td>

<td>
<div align="center">
<h3><label>Región</label></h3>
<input maxlength="50" type=value name=dir_region value="' . $row["dir_region"] . '">
</div>
</td>
</tr>

</table>
<br><br><hr><br><br>

';


                    echo '
<br><hr><br>

<!-- DATOS COMPAÑÍA -->
<h1 align="center" style="color: #005cbf"><b><u>INFORMACIÓN BOMBERIL</u></b></h1>

<table width="100%">

<tr>
<td>
<div align="center">
<h3 align="center"><label>Reg. <br>de Cpo.</label></h3>
<input size="10" type=text name=reg_cpo readonly value=' . $row["reg_cpo"] . '>
</div>
</td>

<td>
<div align="center">
<h3 align="center"><label>Reg. <br>de Cia.</label></h3>
<input size="10" type=value name=reg_cia value=' . $row["reg_cia"] . '>
</div>
</td>

<td>
<div align="center">
<h3 align="center"><label>Compañía</label></h3><br>
<select  name="compania" id="compania">
  		<optgroup label="Seleccione">
	    ';
                    echo '<option Selected>' . $row["compania"] . '</option>';

                    while ($setcia = mysqli_fetch_array($companias)) {
                        echo '<option value="' . $setcia["compania"] . '">' . $setcia["compania"] . '</option>';
                    }
                    echo '
		  </optgroup>
			</select></div>
</td>

<td>
<div align="center">
<h3 align="center"><label>Status</label></h3><br>
<select  name="status" id="status">
  		<optgroup label="Seleccione">
	    <option value=' . $row["status"] . '>' . $row["status"] . '</option>
	    <option value="activo">Activo</option>
    	<option value="suspendido">Suspendido</option>
			<option value="baja">Baja</option>
		  </optgroup>
			</select>
</div>
</td>

<td>
<div align="center">
<h3 align="center"><label>Es Oficial<br>General</label></h3>
<select  name="ofgral" id="ofgral">
  		<optgroup label="Seleccione">
	    <option value=' . $row["ofgral"] . '>' . $row["ofgral"] . '</option>
	    <option value="No">No</option>
    	<option value="Si">Si</option>
		  </optgroup>
			</select>
</div>
</td>

<td>
<div align="center">
<h3 align="center"><label>Es Oficial<br>de Comandancia</label></h3>
<select  name="ofcom" id="ofcom">
  		<optgroup label="Seleccione">
	    <option value=' . $row["ofcom"] . '>' . $row["ofcom"] . '</option>
	    <option value="No">No</option>
    	<option value="Si">Si</option>
		  </optgroup>
			</select>
</div>
</td>

<td>
<div align="center">
<h3 align="center"><label>Es Oficial<br>de Cia</label></h3>
<select style="alignment: center" name="oficial" id="oficial">
  		<optgroup label="Seleccione">
	    <option value=' . $row["oficial"] . '>' . $row["oficial"] . '</option>
	    <option value="No">No</option>
    	<option value="Si">Si</option>
		  </optgroup>
			</select>
</div>
</td>
</tr>
<tr style="height: 150%"></tr>
<tr>
<td>
<div align="center">
<h3 align="center"><label>Cargo</label></h3><br>
 <select  name="cargo" id="cargo">
  		<optgroup label="Seleccione">
	    ';
                    echo '<option Selected>' . $row["cargo"] . '</option>';

                    while ($valores = mysqli_fetch_array($cargos)) {
                        echo '<option value="' . $valores["cargo"] . '">' . $valores["cargo"] . '</option>';
                    }
                    echo '
		  </optgroup>
			</select>
</div>
</td>   

<td>
<div align="center">
<h3 align="center"><label>Clave<br> Radial</label></h3>
<input size="10" type=value name=clave value=' . $row["clave"] . '>
</div>
</td>

<td>
<div align="center">

<h3 align="center"><label>Es <br>Conductor</label></h3>
<select  name="conductor" id="conductor">
  		<optgroup label="Seleccione">
	    <option value=' . $row["conductor"] . '>' . $row["conductor"] . '</option>
	    <option value="No">No</option>
    	<option value="Si">Si</option>
		  </optgroup>
			</select>
</div>
</td>

<td>
<div align="center">

<h3 align="center"><label>Personal <br>De Salud</label></h3>
<select  name="personal_salud" id="personal_salud">
  		<optgroup label="Seleccione">
	    <option value=' . $row["personal_salud"] . '>' . $row["personal_salud"] . '</option>
	    <option value="No">No</option>
    	<option value="Si">Si</option>
		  </optgroup>
			</select>
</div>
</td>


<td>
<div align="center">
<h3 align="center"><label>Jefe</label></h3><br>
 <select  name="jefenuevo" id="jefenuevo">
  		<optgroup label="Seleccione">
	    ';
                    $jefeactual = $conn->query("SELECT * FROM nomina WHERE reg_cpo = '$row[jefe]'");
                    while ($jactual = mysqli_fetch_array($jefeactual)) {
                        echo '<option value="' . $row["jefe"] . '" Selected>(' . $row["jefe"] . ') ' . $jactual["nombres"] . ' ' . $jactual["apellido_paterno"] . ' ' . $jactual["appelido_materno"] . '</option>';
                    }
                    echo ' <option value="">Ninguno</option>';
                    while ($jefe = mysqli_fetch_array($jefes)) {
                        echo '<option value="' . $jefe["reg_cpo"] . '">(' . $jefe["reg_cpo"] . ') ' . $jefe["nombres"] . ' ' . $jefe["apellido_paterno"] . ' ' . $jefe["apellido_materno"] . '</option>';
                    }
                    echo '
		  </optgroup>
			</select>
</div>
</td>  
</tr>
</table>
<br><br>

<input type="submit" name="actualizar" value="Actualizar" class="botonIN" formaction="#actualizar">
<input type="submit" name="back" value="Regresar" class="botonOUT" formaction="index.html">

</form>
';
                }
            } else {
                echo '<script> alert("Reg. Gral. no existe. Verifique haberlo escrito bien y vuelva a intentalo.");  window.location = "ActualizaBombero.php";</script>';
            }
        }
    }

    /* BUSCARUT */
    if (isset($_POST['buscarut'])) {
        $rut = $_POST['rut'];
        $dv = $_POST['dv'];
        $sql = "SELECT * FROM nomina WHERE rut = '$rut' AND dv = '$dv' order by 1 desc limit 1";

        if ($result = $conn->query($sql) or die($conn->error)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = $result->fetch_assoc()) {
                    $sqlfoto = "select * from foto_ficha where rut='$row[rut]'";
                    $resfoto = mysqli_query($conn, $sqlfoto);
                    $rfoto = mysqli_fetch_array($resfoto);
                    $image_src = $rfoto['image'];


                    echo '
<form method="POST" action="#actualizar" enctype="multipart/form-data">
<table width="100%">
<!-- DATOS PERSONALES -->
<tr>
<br><br><hr><br><br>
<h1 align="center" style="color: #005cbf"><b><u>INFORMACIÓN PERSONAL</u></b></h1>
<td>
<div align="center">
<h3><label>RUT</label></h3>
<input type=value name=rut value="' . $row['rut'] . '" size="8" maxlength="8">-<input type=value name=dv value=' . $row['dv'] . ' size="1" maxlength="1"></div>
</td>
<br>
<td>
<div align="center">
<h3><label>Nombres</label></h3>
<input type=value name=nombres value="' . $row["nombres"] . '">
</div>
</td>
<br>

<td>
<div align="center">
<h3><label>Apellido Paterno</label></h3>
<input size="20" type=value name=apellido_paterno value="' . $row["apellido_paterno"] . '">
</div>
</td>

<td>
<div align="center">
<h3><label>Apellido Materno</label></h3>
<input size="20" type=value name=apellido_materno value="' . $row["apellido_materno"] . '">
</div>
</td>

<td>
<div align="center">
<h3><label>e-Mail</label></h3>
<input size="30" type=value name=email value=' . $row["email"] . '>
</div>
</td>

<td>
<div align="center">
<h3><label>Telefono</label></h3>
<input size="30" type=value name=telefono value="' . $row["telefono"] . '">
</div>
</td>

<td>
<div align="center">
<h3><label>Profesion</label></h3>
<input size="30" type=value name=profesion value="' . $row["profesion"] . '">
</div>
</td>

<td>
<div align="center">
<h3><label>Foto Perfil</label></h3>
<img src=' . $image_src . ' width="130" height="130"><br>
<input type="file" id="foto" name="foto">	
</td>
</tr>
</div>
</td>
</tr>
</table>
<br><br>
<table width="100%">
<tr>
<td colspan="6"><h2 align="center" style="color: #005cbf">Dirección</h2></td>
</tr>

<td>
<div align="center">
<h3><label>Calle</label></h3>
<input maxlength="50" type=value name=dir_calle value="' . $row["dir_calle"] . '">
</div>
</td>

<td>
<div align="center">
<h3><label>Número</label></h3>
<input maxlength="10" type=value name=dir_numero value=' . $row["dir_numero"] . '>
</div>
</td>



<td>
<div align="center">
<h3><label>Condominio</label></h3>
<input maxlength="50" type=value name=dir_condominio value="' . $row["dir_condominio"] . '">
</div>
</td>

<td>
<div align="center">
<h3><label>Comuna</label></h3>
<input maxlength="50" type=value name=dir_comuna value="' . $row["dir_comuna"] . '">
</div>
</td>

<td>
<div align="center">
<h3><label>Ciudad</label></h3>
<input maxlength="50" type=value name=dir_ciudad value="' . $row["dir_ciudad"] . '">
</div>
</td>

<td>
<div align="center">
<h3><label>Región</label></h3>
<input maxlength="50" type=value name=dir_region value="' . $row["dir_region"] . '">
</div>
</td>


</tr>






</table>
<br><br><hr><br><br>
';



                    echo '
<br><br><br>

<br><hr><br>
<!-- DATOS COMPAÑÍA -->
<h1 align="center" style="color: #005cbf"><b><u>INFORMACIÓN BOMBERIL</u></b></h1>

<table width="100%">

<tr>
<td>
<div align="center">
<h3 align="center"><label>Reg. <br>de Cpo.</label></h3>
<input size="10" type=text name=reg_cpo readonly value=' . $row["reg_cpo"] . '>
</div>
</td>

<td>
<div align="center">
<h3 align="center"><label>Reg. <br>de Cia.</label></h3>
<input size="10" type=value name=reg_cia value=' . $row["reg_cia"] . '>
</div>
</td>

<td>
<div align="center">
<h3 align="center"><label>Compañía</label></h3><br>
<select  name="compania" id="compania">
  		<optgroup label="Seleccione">
	    ';
                    echo '<option Selected>' . $row["compania"] . '</option>';

                    while ($setcia = mysqli_fetch_array($companias)) {
                        echo '<option value="' . $setcia["compania"] . '">' . $setcia["compania"] . '</option>';
                    }
                    echo '
		  </optgroup>
			</select></div>
</td>

<td>
<div align="center">
<h3 align="center"><label>Status</label></h3><br>
<select  name="status" id="status">
  		<optgroup label="Seleccione">
	    <option value=' . $row["status"] . '>' . $row["status"] . '</option>
	    <option value="activo">Activo</option>
    	<option value="suspendido">Suspendido</option>
			<option value="baja">Baja</option>
		  </optgroup>
			</select>
</div>
</td>

<td>
<div align="center">
<h3 align="center"><label>Es Oficial<br>General</label></h3>
<select  name="ofgral" id="ofgral">
  		<optgroup label="Seleccione">
	    <option value=' . $row["ofgral"] . '>' . $row["ofgral"] . '</option>
	    <option value="No">No</option>
    	<option value="Si">Si</option>
		  </optgroup>
			</select>
</div>
</td>

<td>
<div align="center">
<h3 align="center"><label>Es Oficial<br>de Comandancia</label></h3>
<select  name="ofcom" id="ofcom">
  		<optgroup label="Seleccione">
	    <option value=' . $row["ofcom"] . '>' . $row["ofcom"] . '</option>
	    <option value="No">No</option>
    	<option value="Si">Si</option>
		  </optgroup>
			</select>
</div>
</td>

<td>
<div align="center">
<h3 align="center"><label>Es Oficial<br>de Cia</label></h3>
<select style="alignment: center" name="oficial" id="oficial">
  		<optgroup label="Seleccione">
	    <option value=' . $row["oficial"] . '>' . $row["oficial"] . '</option>
	    <option value="No">No</option>
    	<option value="Si">Si</option>
		  </optgroup>
			</select>
</div>
</td>
</tr>
<tr style="height: 150%"></tr>
<tr>
<td>
<div align="center">
<h3 align="center"><label>Cargo</label></h3><br>
 <select  name="cargo" id="cargo">
  		<optgroup label="Seleccione">
	    ';
                    echo '<option Selected>' . $row["cargo"] . '</option>';

                    while ($valores = mysqli_fetch_array($cargos)) {
                        echo '<option value="' . $valores["cargo"] . '">' . $valores["cargo"] . '</option>';
                    }
                    echo '
		  </optgroup>
			</select>
</div>
</td>   

<td>
<div align="center">
<h3 align="center"><label>Clave<br> Radial</label></h3>
<input size="10" type=value name=clave value=' . $row["clave"] . '>
</div>
</td>

<td>
<div align="center">

<h3 align="center"><label>Es <br>Conductor</label></h3>
<select  name="conductor" id="conductor">
  		<optgroup label="Seleccione">
	    <option value=' . $row["conductor"] . '>' . $row["conductor"] . '</option>
	    <option value="No">No</option>
    	<option value="Si">Si</option>
		  </optgroup>
			</select>
</div>
</td>

<td>
<div align="center">

<h3 align="center"><label>Personal <br>de Salud</label></h3>
<select  name="personal_salud" id="personal_salud">
  		<optgroup label="Seleccione">
	    <option value=' . $row["personal_salud"] . '>' . $row["personal_salud"] . '</option>
	    <option value="No">No</option>
    	<option value="Si">Si</option>
		  </optgroup>
			</select>
</div>
</td>

<td>
<div align="center">
<h3 align="center"><label>Jefe</label></h3><br>
 <select  name="jefenuevo" id="jefenuevo">
  		<optgroup label="Seleccione">
	    ';

                    echo '<option Selected>' . $row["jefe"] . '</option>';

                    while ($jefe = mysqli_fetch_array($jefes)) {
                        echo '<option value="' . $jefe["reg_cpo"] . '">' . $jefe["nombres"] . ' ' . $jefe["apellido_paterno"] . ' ' . $jefe["apellido_materno"] . '</option>';
                    }
                    echo '
		  </optgroup>
			</select>
</div>
</td>  
</tr>
</table>
<br><br>

<input type="submit" name="actualizar" value="Actualizar" class="botonIN" formaction="#actualizar">
<input type="submit" name="back" value="Regresar" class="botonOUT" formaction="index.html">

</form>
';
                }
            } else {
                echo '<script> alert("RUT ' . $rut . '-' . $dv . ' no existe. Verifique haberlo escrito bien y vuelva a intentalo.");  window.location = "ActualizaBombero.php";</script>';
            }
        }
    }


    if (isset($_POST['actualizar'])) {
        $rut = $_POST['rut'];
        $dv = $_POST['dv'];


        // PERSONALES
        $nombres = $_POST['nombres'];
        $apellido_paterno = $_POST['apellido_paterno'];
        $apellido_materno = $_POST['apellido_materno'];
        $email = $_POST['email'];
        $profesion = $_POST['profesion'];
        $telefono = $_POST['telefono'];

        //DIRECCION
        $dir_calle = $_POST['dir_calle'];
        $dir_numero = $_POST['dir_numero'];
        $dir_condominio = $_POST['dir_condominio'];
        $dir_comuna = $_POST['dir_comuna'];
        $dir_ciudad = $_POST['dir_ciudad'];
        $dir_region = $_POST['dir_region'];

        // INFO BOMBERIL
        $jefenuevo = $_POST['jefenuevo'];
        $reg_cpo = $_POST['reg_cpo'];
        $reg_cia = $_POST['reg_cia'];
        $compania = $_POST['compania'];
        $cargo = $_POST['cargo'];
        $status = $_POST['status'];
        $fumador = $_POST['fumador'];
        $oficial = $_POST['oficial'];
        $ofgral = $_POST['ofgral'];
        $ofcom = $_POST['ofcom'];
        $clave = $_POST['clave'];
        $conductor = $_POST['conductor'];
        $personal_salud = $_POST['personal_salud'];

        //FICHA MEDICA
        $prestacion = $_POST['prestacion'];
        $alergias = $_POST['alergias'];
        $enfermedades = $_POST['enfermedades'];
        $medicamentos = $_POST['medicamentos'];
        $grupo_factor = $_POST['grupo_factor'];
        $actividad_fisica = $_POST['actividad_fisica'];
        $alcohol = $_POST['alcohol'];
        $contacto_emergencia = $_POST['contacto_emergencia'];
        $telefono_emergencia = $_POST['telefono_emergencia'];
        $parentesco = $_POST['parentesco'];
        $observaciones = $_POST['observaciones'];


        // FOTO
        $name = $_FILES['foto']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $extensions_arr = array("jpg", "jpeg", "png", "gif");
        // FIN FOTO


        $update = "UPDATE nomina SET 
                  nombres='$nombres',
                  apellido_paterno='$apellido_paterno',
                  apellido_materno='$apellido_materno',
                  reg_cia=IF('$reg_cia' = '', NULL, '$reg_cia'),
                  compania='$compania',
                  conductor='$conductor',
                  oficial='$oficial',
                  ofgral='$ofgral',
                  ofcom='$ofcom',
                  cargo='$cargo',
                  clave='$clave',
                  status='$status',
                  telefono='$telefono',
                  email='$email',
                  dir_calle='$dir_calle',
                  dir_numero='$dir_numero',
                  dir_condominio='$dir_condominio',
                  dir_comuna='$dir_comuna',
                  dir_ciudad='$dir_ciudad',
                  dir_region='$dir_regio',
                  personal_salud='$personal_salud',
                  
                  jefe=IF('$jefenuevo'='',NULL,'$jefenuevo') 
WHERE rut = '$rut'";




            if ($result = $conn->query($update) or die($conn->error)) {
                if (empty($image)) {


                    echo '<script> alert("Registro de ' . $nombres . ' ' . $apellido_paterno . ' ' . $apellido_materno . ' actualizado correctamente"); window.location = "ActualizaBombero.php"; </script>';
                } else {
                    if (in_array($imageFileType, $extensions_arr)) {

                        $image_base64 = base64_encode(file_get_contents($_FILES['foto']['tmp_name']));
                        $image = 'data:image/' . $imageFileType . ';base64,' . $image_base64;

                        // Inserta foto
                        $qfoto = "insert into foto_ficha(rut,dv,image) values('$rut','$dv','" . $image . "')";
                        mysqli_query($conn, $qfoto);
                        echo '<script> alert("Registro de ' . $nombres . ' ' . $apellido_paterno . ' ' . $apellido_materno . ' actualizado correctamente"); window.location = "ActualizaBombero.php"; </script>';



                }
            }
        }
    }
}





$conn->close();



?>




</html>
