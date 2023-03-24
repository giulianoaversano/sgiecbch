<?php
session_start();
header("Refresh: 60");
include('dbconnection.php');


$respuesta = "SI";
$estado="Ingreso";
$compania="Comandancia";

/* INICIO TABLA*/

$sql1o="SELECT * FROM registro,nomina WHERE registro.compania='$compania' AND registro.evento='$estado' AND registro.rut = nomina.rut AND civil='No' ORDER BY case when clave IS NULL then 1 else 0 end, CAST(clave as UNSIGNED ), clave asc" ;
# $sql1v="SELECT * FROM registro,nomina WHERE registro.compania='$compania' AND registro.evento='$estado' AND registro.rut = nomina.rut ORDER BY clave ASC" ;

echo '		<table border="1" style="border-collapse:collapse; border: 1px solid black" cellspacing="" width="100%" cellpadding=""> 
            <tr style="background-color:dodgerblue">
	    <td colspan="4"><p align="center" style="color:white"><b>' . $compania .'</b></p>
		</tr>
	  <tr style="color:#585858"> 
        <td align="center"> <b>Clave</b></td> 
        <td align="center"> <b>Nombres</b> </td> 
        <td align="center"> <b>Estado</b> </td> 
        <td align="center"> <b>Cargo</b> </td> 
              </tr>';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($result = $conn->query($sql1o)) {
    while ($row = $result->fetch_assoc()) {
        $fieldclave = $row[clave];
        $fieldnombres = $row[nombres];
        $fieldpaterno = $row[apellido_paterno];
        $fieldmaterno = $row[apellido_materno];
        $fieldestado = $row[estado];
        $fieldcargo = $row[cargo];

        echo '<tr style="color:#585858"> 
                 <td align="center">'.$fieldclave.'</td> 
                 <td align="center">'.$fieldnombres.' '.$fieldpaterno.' '.$fieldmaterno.'</td> 
                 <td align="center">'.$fieldestado.'</td> 
                 <td align="center">'.$fieldcargo.'</td> 
				
             </tr>';

    }
}

echo '</table>';




?>