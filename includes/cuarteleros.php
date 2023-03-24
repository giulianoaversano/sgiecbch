<head>
    <style>
        body{
            font-family: Verdana;
        }
    </style>
</head>

<?php

echo '	
		<table border="1" style="border-collapse:collapse; border: 1px solid black" cellspacing="2" width="100%" cellpadding="2"> 
      <tr style="background-color:dodgerblue">
	    <td colspan="7"><p align="center" style="color:white"><b>CUARTELEROS & CONDUCTORES</b></p>
		</tr>
	  <tr style="color:#585858"> 
        <td align="center"> <b>Reg. Gral</b></font> </td> 
        <td align="center"> <b>Compañía</b></font> </td> 
        <td align="center"> <b>Nombres</b></font> </td> 
        <td align="center"> <b>Apellido Paterno</b></font> </td> 
        <td align="center"> <b>Apellido Materno</b></font> </td> 
        <td align="center"> <b>Cargo</font> </b></td> 
        <td align="center"> <b>Ingreso</font> </b></td> 

      </tr>';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql4 = "SELECT * FROM Registro_Conductores, nomina WHERE Registro_Conductores.rut=nomina.rut AND Registro_Conductores.status='Ingreso' AND Registro_Conductores.compania='$compania' ORDER BY 1 ASC ";


if ($result = $conn->query($sql4)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row[reg_cpo];
        $field2name = $row[compania];
        $field3name = $row[nombres];
        $field4name = $row[apellido_paterno];
        $field5name = $row[apellido_materno];
        $field6name = $row[cargo];
        $field7name = $row[ingreso];

        echo '<tr style="color:#585858"> 
                 <td align="center">' . $field1name . '</td> 
                 <td align="center">' . $field2name . '</td> 
                 <td align="center">' . $field3name . '</td> 
                 <td align="center">' . $field4name . '</td> 
                 <td align="center">' . $field5name . '</td> 
                 <td align="center">' . $field6name . '</td> 
				 <td align="center">' . $field7name . '</td> 
				
             </tr>';

    }
}


$sql5 = "SELECT * FROM registro, nomina WHERE registro.evento='$estado' AND registro.rut = nomina.rut AND cargo='cuartelero' AND registro.compania='$compania'  ORDER BY 1 ASC ";

/*
if ($result = $conn->query($sql5)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row[reg_cpo];
        $field2name = $row[compania];
        $field3name = $row[nombres];
        $field4name = $row[apellido_paterno];
        $field5name = $row[apellido_materno];
        $field6name = $row[cargo];
        $field7name = $row[ingreso];

        echo '<tr style="color:#585858"> 
                 <td align="center">N/A</td> 
                 <td align="center">' . $field2name . '</td> 
                 <td align="center">' . $field3name . '</td> 
                 <td align="center">' . $field4name . '</td> 
                 <td align="center">' . $field5name . '</td> 
				 <td align="center">' . $field6name . '</td> 
				 <td align="center">' . $field7name . '</td> 
				
             </tr>';

    }
}
*/
echo '</table>';
echo '<br>';
echo '<hr class="lineaverde">';
echo '<br>';
?>