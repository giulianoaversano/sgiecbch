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

<style type="text/css">
    select, option {font-size: 120%}
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
      <H1 align=center style=color:darkgray><b></b>BOMBA HUECHURABA<b></b></h1>
      <h2 align=center style=color:darkslategray><strong>Registro Tempratura Ingreso/Egreso</strong></h2>
      <p>&nbsp;</p></td>
    </tr>
  </tbody>
</table>

<h1 align="center" style="color:blue"><b>REGISTRO NUEVO BOMBERO</b></h1>
</p>
	<p><br>
</p>

<?php

session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
include('dbconnection.php');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

echo' <p align="right">Usuario Registrado: <b>' . $_SESSION["username"] . ' </b> (' . $_SESSION["nombres"] . ' ' .$_SESSION["apellido_paterno"] . ' ' . $_SESSION["apellido_materno"].')</p>';
echo '<p align="right">Nivel: <b> '. $_SESSION["nivel"].' </b></p>';

echo ' <p align="right" style="color: #d62516"> <a style="color: #d62516;" href="logout.php"> <<< Salir >>> </b></a></p>';
$cargos = $conn -> query ("SELECT * FROM cargos");
$companias = $conn -> query ("SELECT * FROM companias");

if(!isset($_SESSION["nivel"]) || $_SESSION["nivel"] >= 3) {

    echo '
  <form method="POST" action="#registrar" enctype="multipart/form-data">	

  <table width="100%">
  <tr>
  <td colspan="7" style="background-color: lightgray"><h1 align="center" style="color: #005cbf"><b><u>INFORMACIÓN PERSONAL</u></b></h1></td>
</tr>
<tr>
  <th><h1><b>RUT</b></h1> </th>
      <th> <label><h1><b>Foto Perfil</b></h1></label></th>

  </tr>
  <tr>
  <td><h1 align="center"><input name="rut"  type="value" class="epigrafes" id="rut" size="15" maxlength="8"> <input name="dv"  type="value" class="epigrafes" id="dv" maxlength="1" size="1"></h1></td>
      <td align="center"><input align="center" type="file" id="foto" name="foto">	</td>

</tr>
	 <tr>
    <th> <label><h2><b>Nombres</b></h2></label></th>
    <th> <label><h2><b>Apellido Paterno</b></h2></label></th>
    <th> <label><h2><b>Apellido Materno</b></h2></label></th>
    <th> <label><h2><b>Sexo</b></h2></label></th>
    <th> <label><h2><b>e-Mail</b></h2></label></th>
    <th> <label><h2><b>Telefono</b></h2></label></th>
	    
	 </tr>

	 <tr>
      <td><h2 align="Center"><input name="nombres" type="value" class="epigrafes" maxlength="30"></h2></td>  
	  <td><h2 align="Center"><input name="apellido_paterno" type="value" class="epigrafes"  maxlength="30"></h2></td>
	  <td><h2 align="Center"><input name="apellido_materno" type="value" class="epigrafes"  maxlength="30"></h2></td>  
      <td><h2 align="Center"><select  name="sexo" ">
  		<optgroup label="Seleccione">
	    <option value="Masculino" style="color: #005cbf">Masculino</option>
    	<option value="Femenino">Femenino</option>
		  </optgroup>
			</select></h2></td>
      <td><h2 align="Center"><input name="email" type="value" class="epigrafes" maxlength="30"></h2></td>
      <td><h2 align="Center"><input name="telefono" type="value" class="epigrafes"  maxlength="30"></h2></td>

	 </tr>
	 </table>
	 <table width="100%">	 
	 <tr>
<td colspan="6" style="background-color: lightgray"><h1 align="center" style="color: #005cbf"><b><u>DOMICILIO</u></b></h1></td>
	 </tr>
	 <tr>
    <th> <label><h2><b>Calle</b></h2></label></th>
    <th> <label><h2><b>Número</b></h2></label></th>
    <th> <label><h2><b>Condominio</b></h2></label></th>
    <th> <label><h2><b>Comuna</b></h2></label></th>
    <th> <label><h2><b>Ciudad</b></h2></label></th>
    <th> <label><h2><b>Región</b></h2></label></th>
	    
	 </tr>
	 
	 <tr>
      <td><h2 align="Center"><input name="dir_calle" type="value" class="epigrafes" maxlength="50" size="20"></h2></td>  
      <td><h2 align="Center"><input name="dir_numero" type="value" class="epigrafes" maxlength="10" size="6"></h2></td>  
      <td><h2 align="Center"><input name="dir_condominio" type="value" class="epigrafes" maxlength="50"></h2></td>  
      <td><h2 align="Center"><input name="dir_comuna" type="value" class="epigrafes" maxlength="50"></h2></td>  
      <td><h2 align="Center"><input name="dir_ciudad" type="value" class="epigrafes" maxlength="50"></h2></td>  
      <td><h2 align="Center"><input name="dir_region" type="value" class="epigrafes" maxlength="50"></h2></td>  

	 </tr>
	 
	 </table>
	 
	 <table width="100%">
	 	 <tr>
<td colspan="6" style="background-color: lightgray"><h1 align="center" style="color: #005cbf"><b><u>FICHA MÉDICA</u></b></h1></td>
	 </tr>
	 <tr>
    <th> <label><h2><b>Prestación</b></h2></label></th>
    <th> <label><h2><b>Alergias</b></h2></label></th>
    <th> <label><h2><b>Enfermedades Crónicas</b></h2></label></th>
    <th> <label><h2><b>Toma Medicamentos </b></h2></label></th>
    </tr>
    

 <tr>
      <td><h2 align="Center"><input name="prestacion" type="value" class="epigrafes" maxlength="60"></h2></td>  
      <td><h2 align="Center"><input name="alergias" type="value" class="epigrafes" maxlength="60"></h2></td>  
      <td><h2 align="Center"><input name="enfermedades" type="value" class="epigrafes" maxlength="60"></h2></td>  
      <td><h2 align="Center"><input name="medicamentos" type="value" class="epigrafes" maxlength="60"></h2></td>  
      </tr>
      
	 
	 <tr>
    <th> <label><h2><b>Grupo y Factor</b></h2></label></th>
    <th> <label><h2><b>Actividad Física</b></h2></label></th>
    <th> <label><h2><b>Consume Alcohol</b></h2></label></th>
    <th> <label><h2><b>Fuma</b></h2></label></th>
	 </tr>
	 <tr>
      <td><h2 align="Center">
      <select  name="grupo_factor">
  		<optgroup label="Seleccione">
  		    <option value="" selected disabled hidden>Seleccione</option>

    <option value="" selected disabled hidden>Seleccione</option>
    <option value="A Positivo">A Positivo</option>
    <option value="A Negativo">A Negativo</option>
    <option value="B Positivo">B Positivo</option>
    <option value="B Negativo">B Negativo</option>
    <option value="AB Positivo">AB Positivo</option>
    <option value="AB Negativo">AB Negativo</option>
    <option value="0 Positivo">0 Positivo</option>
    <option value="0 Negativo">0 Negativo</option>
		  </optgroup>
		  </select>
		  </h2></td>  
      <td><h2 align="Center"><select  name="actividad_fisica" id="actividad_fisica">
  		<optgroup label="Seleccione">
    <option value="" selected disabled hidden>Seleccione</option>
    <option value="No">No</option>
    <option value="Si - Ocasionalmente">Si - Ocasionalmente</option>
    <option value="Si - Frecuentemente">Si - Frecuentemente</option>
		  </optgroup>
		  </select></h2></td>  
      <td><h2 align="Center"><select  name="alcohol">
  		<optgroup label="Seleccione">
  		    <option value="" selected disabled hidden>Seleccione</option>

    <option value="No">No</option>
    <option value="Si - Ocasionalmente">Si - Ocasionalmente</option>
    <option value="Si - Frecuentemente">Si - Frecuentemente</option>
		  </optgroup>
		  </select></h2></td>  
      <td><h2 align="Center"><select  name="fumador">
  		<optgroup label="Seleccione">
  		    <option value="" selected disabled hidden>Seleccione</option>

    <option value="No">No</option>
    <option value="Si - Ocasionalmente">Si - Ocasionalmente</option>
    <option value="Si - Frecuentemente">Si - Frecuentemente</option>
		  </optgroup>
		  </select></h2></td>  

	 </tr>
</table>
<table width="100%">
<!--CONTACTO DE EMERGENCIA-->
 <tr>
<td colspan="6" style="background-color: lightgray"><h3 align="center" style="color: #005cbf"><b><u>CONTACTO DE EMERGENCIA</u></b></h3></td>
	 </tr>
	 <tr>
    <th> <label><h2><b>Nombre Completo</b></h2></label></th>
    <th> <label><h2><b>Parentesco</b></h2></label></th>
    <th> <label><h2><b>Teléfono</b></h2></label></th>
    <th> <label><h2><b>Observaciones </b></h2></label></th>
	 </tr>

 <tr>
      <td><h2 align="Center"><input name="contacto_emergencia" type="value" class="epigrafes" maxlength="30"></h2></td>  
      <td><h2 align="Center"><input name="parentesco" type="value" class="epigrafes" maxlength="60"></h2></td>  
      <td><h2 align="Center"><input name="telefono_emergencia" type="value" class="epigrafes" maxlength="60"></h2></td>  
      <td><h2 align="Center"><textarea name="observaciones" maxlength="500" cols="80" rows="5"></textarea></h2></td>  

	 </tr>
	 <!--FIN COTACTO EMERGENCIA--> 
</table>
	 
	 
	 	 <!--INFORMACION BOMBERIL--> 
<table width="100%">
<tr>
<td colspan="6" style="background-color: lightgray"><h1 align="center" style="color: #005cbf"><b><u>INFORMACION BOMBERIL</u></b></h1></td>

</tr>
 <tr>
 <th><label><h2>Es Civil</h2></label></th>
 <th><label><h2>Reg. Gral.</h2></label></th>
 <th><label><h2>Reg. Cia.</h2></label></th>
 <th><label><h2>Cargo</h2></label></th>
 <th><label><h2>Compania</h2></label></th>
 <th><label><h2>Clave Radial</h2></label></th>
</tr>
 
 <tr>
   <td style="color: #005cbf"><h2 align="center">
	  <select  name="civil" id="civil">
  		<optgroup label="Seleccione">
	    <option value="No" style="color: #005cbf">No</option>
    	<option value="Si">Si</option>
		  </optgroup>
			</select>
		    </h2></td>
   <td><h2 align="center"> <input name="reg_cpo"  type="value" class="epigrafes" size="12" maxlength="4"></h2></td>
   <td><h2 align="center"> <input name="reg_cia"  type="value" class="epigrafes" maxlength="4" size="12"></h2></td>
   <td><h2 align="center">
	  <select  name="cargo">
  		<label="Seleccione">
  		<option selected="selected">Bombero</option>
	    	    ';
    while ($valores = mysqli_fetch_array($cargos)) {
        echo '<option value="' . $valores["cargo"] . '">' . $valores["cargo"] . '</option>';
    }
    echo '
		  </optgroup>
			</select>
		    </h2></td>
   	<td><h1 align="center"><select  name="compania">
  		<optgroup label="Seleccione">
	    ';
    while ($setcia = mysqli_fetch_array($companias)) {
        echo '<option value="' . $setcia["compania"] . '">' . $setcia["compania"] . '</option>';
    }
    echo '
		  </optgroup>
			</select></h2></td>  
   	<td><h2 align="center"><input name="clave" type="value" class="epigrafes" id="clave" size="8"></h2></td>  

</table>




<br><hr><br>
<table width="100%">
	 <tr>
	 <td align="center"><h2>Status</h2></td>
    <td align="center"><h2>Es Oficial de Compañía </h2></td>
	  <td align="center"><h2>Es Oficial General</h2></td>
	  <td align="center"><h2>Es Oficial de Comandancia</h2></td>
	   <td align="center"><h2>Es Conductor</h2></td>
	   <td align="center"><h2>Personal de Salud</h2></td>
	   <td align="center"><h2>Jefe</h2></td>

	 
	 </tr>
	 <tr>
	<td align="center" valign="top"><h2>
	  <select  name="status" id="status">
  		<optgroup label="Seleccion llamado">
	    <option value="activo">Activo</option>
    	<option value="suspendido">Suspendido</option>
			<option value="baja">Baja</option>
		  </optgroup>
			</select>
		    </h2></td> 
		    
		    <td align="center" valign="top"><h2>
	  <select  name="oficial" id="oficial">
  		<optgroup label="Seleccione">
	   <option selected="No">No</option>
	    <option value="No">No</option>
    	<option value="Si">Si</option>
		  </optgroup>
			</select>
		    </h2></td>
		    	
  <td align="center" valign="top"><h2>
	  <select  name="ofgral" id="ofgral">
  		<optgroup label="Seleccione">
	   <option selected="No">No</option>
	    <option value="No">No</option>
    	<option value="Si">Si</option>
		  </optgroup>
			</select>
		    </h2></td>
		    
		    <td align="center" valign="top"><h2>
	  <select  name="ofcom" id="ofcom">
  		<optgroup label="Seleccione">
	    <option value="No">No</option>
    	<option value="Si">Si</option>
		  </optgroup>
			</select>
		    </h2></td>

        <td align="center" valign="top"><h2> 
	  <select  name="conductor" id="conductor">
  		<optgroup label="Seleccione">
  		 <option value="No">No</option>
    	<option value="Si">Si</option>
		  </optgroup>
			</select>
		    </h2></td>   
		    
		            <td align="center" valign="top"><h2> 
	  <select  name="personal_salud" id="personal_salud">
  		<optgroup label="Seleccione">
  		 <option value="No">No</option>
    	<option value="Si">Si</option>
		  </optgroup>
			</select>
		    </h2></td> 
		    
		    <td align="center" valign="top"><h2>
 <select  name="jefenuevo" id="jefenuevo">
  		<optgroup label="Seleccione">
	    ';
    $jefes = $conn->query("SELECT * FROM nomina,cargos WHERE esjefe='Si' AND nomina.cargo = cargos.cargo ORDER BY nomina.clave");

    echo ' <option value="">Ninguno</option>';
    while ($jefe = mysqli_fetch_array($jefes)) {
        echo '<option value="' . $jefe["reg_cpo"] . '">(' . $jefe["reg_cpo"] . ') ' . $jefe["nombres"] . ' ' . $jefe["apellido_paterno"] . ' ' . $jefe["apellido_materno"] . '</option>';
    }
    echo '
		  </optgroup>
			</select>
</h1></td>  

 </tr>
		    
	 </table>	
	
	
<input type="submit" name="registrar" value="Guardar" class="botonIN" formaction="#registrar">
<input type="submit" name="back" value="Regresar" class="botonOUT" formaction="index.php">
 
</form>
  ';


    if (isset($_POST['registrar'])) {
        //PERSONALES
        $rut = $_POST['rut'];
        $dv = $_POST['dv'];
        $nombres = $_POST['nombres'];
        $apellido_paterno = $_POST['apellido_paterno'];
        $apellido_materno = $_POST['apellido_materno'];
        $email = $_POST['email'];
        $calle = $_POST['dir_calle'];
        $numero = $_POST['dir_numero'];
        $condominio = $_POST['dir_condominio'];
        $comuna = $_POST['dir_comuna'];
        $ciudad = $_POST['dir_ciudad'];
        $region = $_POST['dir_region'];
        $telefono = $_POST['telefono'];
        $sexo = $_POST['sexo'];
        $date = new DateTime("now", new DateTimeZone('America/Santiago'));
        $timestamp = $date->format('Y-m-d H:i');


        //BOMBERILES
        $civil = $_POST['civil'];
        $reg_cpo = $_POST['reg_cpo'];
        $reg_cia = $_POST['reg_cia'];
        $compania = $_POST['compania'];
        $status = $_POST['status'];
        $oficial = $_POST['oficial'];
        $ofgral = $_POST['ofgral'];
        $ofcom = $_POST['ofcom'];
        $conductor = $_POST['conductor'];
        $clave = $_POST['clave'];
        $cargo = $_POST['cargo'];
        $personal_salud=$_POST['personal_salud'];

        //FICHA MEDICA//
        $prestacion = $_POST['prestacion'];
        $alergias = $_POST['alergias'];
        $enfermedades = $_POST['enfermedades'];
        $medicamentos = $_POST['medicamentos'];
        $grupo_factor = $_POST['grupo_factor'];
        $actividad_fisica = $_POST['actividad_fisica'];
        $alcohol = $_POST['alcohol'];
        $fumador = $_POST['fumador'];
        $contacto_emergencia = $_POST['contacto_emergencia'];
        $parentesco = $_POST['parentesco'];
        $telefono_emergencia = $_POST['telefono_emergencia'];
        $observaciones = $_POST['observaciones'];
        $creado_por = $_SESSION["username"];

        // FOTO
        $name = $_FILES['foto']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $extensions_arr = array("jpg", "jpeg", "png", "gif");


        $check = "SELECT * FROM nomina WHERE reg_cpo = '$reg_cpo' order by 1 desc limit 1";

        $sql2 = "INSERT INTO nomina 
    (rut, dv, civil, personal_salud,reg_cpo, reg_cia, compania, conductor, oficial, ofgral, ofcom, clave, cargo, status, nombres, apellido_paterno, apellido_materno, email, telefono, sexo,dir_calle, dir_numero, dir_condominio, dir_comuna, dir_ciudad, dir_region, creado_por, creado_el) 
    VALUES 
    ('$rut', '$dv', '$civil', '$personal_salud',IF('$reg_cpo'='',NULL,'$reg_cpo'),IF('$reg_cia' = '',NULL,'$reg_cia'),'$compania','$conductor','$oficial','$ofgral','$ofcom','$clave','$cargo','$status','$nombres','$apellido_paterno','$apellido_materno','$email','$telefono','$sexo','$calle', '$numero','$condominio', '$comuna', '$ciudad','$region', '$creado_por', '$timestamp')";


        $sqlficha = "INSERT INTO ficha_medica 
          (rut,dv,prestacion, alergias, enfermedades, medicamentos, grupo_factor,actividad_fisica, alcohol, fumador, contacto_emergencia, telefono_emergencia, parentesco, observaciones, creado_por)
VALUES
('$rut','$dv','$prestacion','$alergias','$enfermedades','$medicamentos','$grupo_factor','$actividad_fisica','$alcohol','$fumador', '$contacto_emergencia','$telefono_emergencia','$parentesco','$observaciones','$creado_por')
";


        if ($result = $conn->query($check) or die($conn->error)) {
            while ($row = $result->fetch_assoc()) {
                if ($row[rut] == $rut) {
                    echo '<script> alert("El RUT ' . $rut . '  ya se encuentra en la base de datos. Verifique la información y vuelva a intentarlo"); window.location = "RegistraNuevoBombero.php"; </script>';
                }
            }
        }

        if ($conn->query($sql2) === TRUE or die($conn->error)) {
            if ($conn->query($sqlficha) === TRUE or die($conn->error)) {
                if (in_array($imageFileType, $extensions_arr)) {

                    $image_base64 = base64_encode(file_get_contents($_FILES['foto']['tmp_name']));
                    $image = 'data:image/' . $imageFileType . ';base64,' . $image_base64;
                    $qfoto = "insert into foto_ficha(rut,dv,image) values('$rut','$dv','" . $image . "')";
                    mysqli_query($conn, $qfoto);
                    echo $sql2;
                    echo $sqlficha;
                    echo '<script> alert("Registro de ' . $nombres . ' ' . $apellido_paterno . ' ' . $apellido_materno . '(' . $rut . ') OK"); window.location = "../index.php"; </script>';

                }
            }
        } else {
                    echo "Error: Por Favor valide la información suministrada. <br><b>La operación no ha sido guardada</b><br>";
                }

    }
}
	$conn->close();
	?>
</body>
</html>	
