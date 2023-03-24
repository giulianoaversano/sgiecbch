

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
        <td width="11%"><img src="../img/logo_cia.png" width="148"  alt=""/></td>
        <td width="77%"><p>&nbsp;</p>
            <h1 align="center" style="color:darkgray"><b></b>BOMBA HUECHURABA<b></b></h1>
            <h2 align="center" style="color:darkslategray"><strong>Registro Temperatura Ingreso/Egreso</strong></h2>
            <p>&nbsp;</p></td>
        <td width="12%"><img src="../img/logo_cuerpo.png" width="147" height="" alt=""/></td>
    </tr>
    </tbody>
</table>
<h3 align="center">ACTUALIZAR DATOS DE NOMINA</h3>
    
<?php


session_start();
include ('dbconnection.php');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["nivel"] < 4){
    header("location: login.php");
    exit;
}

echo' <p align="right">Usuario Registrado: <b>' . $_SESSION["username"] . ' </b> (' . $_SESSION["nombres"] . ' ' .$_SESSION["apellido_paterno"] . ' ' . $_SESSION["apellido_materno"].')</p>';
echo '<p align="right">Nivel: <b> '. $_SESSION["nivel"].' </b></p>';

echo ' <p align="right" style="color: #d62516"> <a style="color: #d62516;" href="logout.php"> <<< Salir >>> </b></a></p>';

$aforos = $conn -> query ("SELECT * FROM aforo");

if(!isset($_SESSION["nivel"]) || $_SESSION["nivel"] >= 3) {


    echo '
<form method="POST" action="#buscar">
    <table>
        <tr>
            <td><p style="font-size: 22px"><b>Dependencia</b></p></td>
   <td><h1 align="left">
	  <select  style="width:100%; height:24px; font-size:20px" name="dependencia" id="dependencia">
  		< label="Seleccione">
  		<option selected="selected">Seleccione</option>
	    	    ';
    while ($valores = mysqli_fetch_array($aforos)) {
        echo '<option value="' . $valores["compania"] . '">' . $valores["compania"] . '</option>';
    }
    echo '
		  </optgroup>
			</select>
		    </h1></td>
   
            <td> <input style="width:110%; height:28px; font-size:22px; alignment: center; background-color: #4CAF50" type="submit" name="buscar" value="Buscar" formaction=#buscar></td>
   </tr>
    </table>

    </form>
    
';
    if (isset($_POST['buscar'])) {
        $dependencia = $_POST['dependencia'];
        $aforo = $_POST['aforo'];
        $sql = "SELECT * FROM aforo WHERE compania = '$dependencia' order by 1 desc limit 1";
        if ($result = $conn->query($sql) or die($conn->error)) {
            while ($row = $result->fetch_assoc()) {


                echo '
<form method="POST" action="#actualizar">
<table>
<!-- DATOS PERSONALES -->
<tr>

<td>
<div align="center">
<h1><label>Dependencia</label></h1>
<input type=value style="width:80%; height:24px; font-size:24px; background-color: lightgrey" name=compania value=' . $row["compania"] . ' readonly>
</div>
</td>
<br>
<td>
<div align="center">
<h1><label>Aforo</label></h1>
<input type=value name=aforo value=' . $row["maxaforo"] . ' maxlength="3" size="3" style="width:80%; height:24px; font-size:24px">
</div>
</td>
<br>

</table>
<br><br>

<input type="submit" name="actualizar" value="Actualizar" class="botonIN" formaction="#actualizar">
<input type="submit" name="back" value="Regresar" class="botonOUT" formaction="index.html">

</form>
';
            }
        }
    }


    if (isset($_POST['actualizar'])) {
        $dependencia = $_POST['compania'];
        $aforo = $_POST['aforo'];
$sqlaforo = "UPDATE aforo SET maxaforo='$aforo' WHERE compania = '$dependencia'";

        if ($result = $conn->query($sqlaforo)) {

           echo '<script> alert("Aforo de ' . $dependencia . ' actualizado correctamente a ' . $aforo . '"); window.location = "ModificaAforo.php"; </script>';

        }
    }
}







$conn->close();



?>




</html>
