<!DOCTYPE html>
<html lang="sp">
<head>

    <meta charset="UTF-8">
    <?php include('../includes/title.inc');?>
</head>
<style>
    tr.border-bottom td {
        border-bottom: 1pt solid #ff000d;
    }
</style>
<style type="text/css" media="screen">
    .boton {
        border: 1px solid #2e518b; /*anchura, estilo y color borde*/
        padding: 10px; /*espacio alrededor texto*/
        background-color: #2e518b; /*color botón*/
        color: #ffffff; /*color texto*/
        text-decoration: none; /*decoración texto*/
        text-transform: uppercase; /*capitalización texto*/
        font-family: 'Helvetica', sans-serif; /*tipografía texto*/
        border-radius: 50px; /*bordes redondos*/
    }
</style>

<?php include('header.php');?>


<h2 align="center" style="color:orangered"><b><u>Consulta Persona</u></b> </h2>

<?php
include ('../dbconnection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
global $conn;
echo'
<form method="GET">
<table>
<tr>
<td><label>RUT</label></td>
<td><input name="rut" id="rut" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "tel"
    maxlength = "8"
 /></td>
<td><label>-</label></td>
<td><input type="text" name="dv" id="dv" size="1" maxlength="1" /></td>

<td><input type="submit" id="consulta" name="consulta" value="Consultar" style="background-color: #2e518b; color:whitesmoke" required></td>
</tr>
</table>
</form>';

if (isset($_GET['consulta'])) {
    $rut = $_GET['rut'];
    $dv = $_GET['dv'];
    $query = "SELECT * FROM nomina WHERE rut='$rut' AND dv='$dv'";
    $qmed = "SELECT * FROM ficha_medica WHERE rut='$rut' AND dv='$dv'";
    $sql = "select * from foto_ficha where rut='$rut' AND dv='$dv'";

    $result2 = mysqli_query($conn,$sql);
    $row2 = mysqli_fetch_array($result2);
    $image_src = $row2['image'];

    if ($result = $conn->query($query) or die($conn->error)) {
        while ($row = $result->fetch_assoc()) {
            if (!empty($result)) {
                echo '

 <table width="75%" border="0"> <!-- Lo cambiaremos por CSS -->
           <tr>
			   
			   <td colspan="6" align="center" style="background-color:cornflowerblue; color: aliceblue"><b>Datos Personales</b></td>
			</tr>
			<tr>
				<td rowspan="11">
				<img src=' . $image_src . ' width="200" height="200">
				</td>
                <td colspan="3"><b>RUT: ' . $rut . '</b>-'.$dv.'</td>
                
            </tr>
			<tr><td colspan="6" height="4px"></td></tr>
            <tr>
                <td><b>Nombres:</b></td>
                <td><b>Apellido Paterno:</b> </td>
				  <td><b>Apellido Materno:</b> </td>
            </tr>
			  <tr>
                <td>' . $row['nombres'] . '</td>
                <td>' . $row['apellido_paterno'] . '</td>
				  <td>' . $row['apellido_materno'] . '</td>
            </tr>
			
			
			<tr><td colspan="6" height="40px"></td></tr>
			<tr>
                <td><b>Sexo:</b></td>
				 <td><b>Fecha Nacimiento:</b> </td>
                <td><b>Teléfono: </b></td>
                
            </tr>
				<tr>
                <td>' . $row['sexo'] . '</td>
				 <td>' . $row['fecha_nacimiento'] . '</td>
                <td>' . $row['telefono'] . '</td>
                
            </tr>
			 <tr><td colspan="6" height="40px"></td></tr>
			<tr>
                <td><b>e-mail:</b> </td>
				<td colspan="2"><b>Profesión:</b> </td>		
			<tr><td colspan="6" height="4px"></td></tr>
			<tr>
                <td>' . $row['email'] . '</td>
				<td colspan="2">' . $row['profesion'] . '</td>		
				
            </tr>
		</table>
		<br><br>
		
		
		<table width="75%" border="0"> <!-- Lo cambiaremos por CSS -->
            <tr>
			<td colspan="4" align="center" style="background-color:cornflowerblue; color: aliceblue"><b>Domicilio</b></td>
			</tr> 
			<tr>
                <td align="center" colspan="4"><b>Dirección</b></td>
            </tr>
			<tr>
				<td align="center" colspan="3">' . $row['dir_calle'] . ' ' . $row['dir_numero'] . '</td>
               
			</tr>
			<tr height="4px"></tr>
			<tr>
                <td align="center"><b>Condominio</b></td>
                <td align="center"><b>Comuna</b></td>   
				 <td align="center"><b>Ciudad</b></td>  
				 <td align="center"><b>Región</b></td>
            </tr>
			<tr>
				<td align="center">' . $row['dir_condominio'] . '</td>
                <td align="center">' . $row['dir_comuna'] . '</td>   
				 <td align="center">' . $row['dir_ciudad'] . '</td>  
				 				<td align="center">' . $row['dir_region'] . '</td>


              
			</tr>
			
        </table>
		
		<br><br>
        <table width="75%" border="0"> <!-- Lo cambiaremos por CSS -->
            <tr>
			<td colspan="5" align="center" style="background-color:cornflowerblue; color: aliceblue"><b>Información Bomberil</b></td>
			</tr> 
			<tr>
                <td align="center"><b>Compania</b></td>   
				<td align="center"><b>Estado</b></td>
				 <td align="center"><b>Reg. Cuerpo</b></td>   
				 <td align="center"><b>Reg. Compañía</b></td>
				 <td align="center"><b>Cargo</b></td>
            </tr>
			<tr>
                <td align="center">' . $row['compania'] . '</td>  
				<td align="center">' . $row['status'] . '</td>  
				 <td align="center">' . $row['reg_cpo'] . '</td>   
				 <td align="center">' . $row['reg_cia'] . '</td>  
				 <td align="center"  style="color: #005cbf">' . $row['cargo'] . '</td>  
			</tr>
			<tr height="45px"></tr>
			<tr>
                <td align="center"><b>Of. General</b></td>   
				 <td align="center"><b>Of. Comandancia</b></td>  
				 <td align="center"><b>Of. Compañía</b></td>  
				 <td align="center"><b>Personal Civil</b></td>  
				 <td align="center"><b>Conductor</b></td>  
            </tr>
			<tr>
                <td align="center">' . $row['ofgral'] . '</td>   
				 <td align="center">' . $row['ofcom'] . '</td>  
				 <td align="center">' . $row['oficial'] . '</td>  
				 <td align="center">' . $row['civil'] . '</td>  
				 <td align="center">' . $row['conductor'] . '</td>  
			</tr>
			
			</table>
			<br><br>';
            } else
                echo 'No se encontró ningún registro con RUT ' . $rut . '-' . $dv . ' en la base de datos.';

        }
    }


                if ($resultmed = $conn->query($qmed) or die($conn->error)) {
                    while ($rowmed = $resultmed->fetch_assoc()) {
                        if (!empty($resultmed)) {
                            echo '
			
			<table width="75%" border="0"> <!-- Lo cambiaremos por CSS -->
			<tr>
			<td colspan="5" align="center" style="background-color:cornflowerblue; color: aliceblue"><b>Ficha Médica</b></td>
			</tr> 
			<tr>
                <td align="center"><b>Prestación</b></td>
                <td align="center"><b>Alergias</b></td>   
				<td align="center"><b>Enfermedades</b></td>
				<td align="center"><b>Medicamentos</b></td>
				<td align="center"><b>Grupo y Factor</b></td>
            </tr>
			<tr>
				<td align="center">' . $rowmed['prestacion'] . '</td>
                <td align="center">' . $rowmed['alergias'] . '</td>  
				<td align="center">' . $rowmed['enfermedades'] . '</td>  
				<td align="center">' . $rowmed['medicamentos'] . '</td>  
				<td align="center">' . $rowmed['grupo_factor'] . '</td>  
			</tr>
			<tr height="8px"></tr>
			<tr>
                <td align="center"><b>Actividad Física</b></td>
                <td align="center"><b>Consume Alcohol?</b></td>   
				<td align="center"><b>Fuma?</b></td>
				<td align="center"><b>Contacto Emergencia</b></td>
				<td align="center"><b>Teléfono Emergencia</b></td>
            </tr>
			<tr>
				<td align="center">' . $rowmed['actividad_fisica'] . '</td>
                <td align="center">' . $rowmed['alcohol'] . '</td>  
				<td align="center">' . $rowmed['fumador'] . '</td>  
				<td align="center">' . $rowmed['contacto_emergencia'] .  ' (' . $rowmed['parentesco'] . ') </td>  
				<td align="center">' . $rowmed['telefono_emergencia'] . '</td>  
				
			</tr>
			</table>
			<br><br>';






                        }
        }
    }
}
$conn->close();
?>


</body>
<footer>
    <table width="100%">
        <tr>
            <td><p align="left">CBCH - 2022 - Todos los derechos reservados</p></td><h1></h1>
            <td><p align="center">Modulo MC.01</p></td>
            <td></td>
        </tr>
    </table>
</footer>
</html>

