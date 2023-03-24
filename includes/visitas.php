<head>
    <style>
        body{
            font-family: Verdana;
        }
    </style>
</head>

<?php

echo '	
		<table border="1" style="border-collapse:collapse; border: 1px solid black" cellspacing="1" width="100%" cellpadding="2"> 
            <tr style="background-color:lightgrey">
	    <td colspan="8" style="color:black"><p align="center"><b>VISITAS & EXTERNOS</b></p>
		</tr>
	  <tr style="color:#585858"> 
        <td align="center" > <b>RUT</b></font> </td> 
        <td align="center" > <b>Nombres</b></font> </td> 
        <td align="center" > <b>Apellido Paterno</b></font> </td> 
        <td align="center" > <b>Apellido Materno</b></font> </td> 
        <td align="center" > <b>Motivo de Ingreso</font> </b></td> 
        <td align="center" > <b>Autorizado Por</font> </b></td> 
        <td align="center" > <b>Fecha/Hora Ingreso</font> </b></td> 
      </tr>';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql5 = "SELECT * FROM Registro_Visitas WHERE Registro_Visitas.evento='$estado' AND compania='$compania' ORDER BY ingreso ASC ";


if ($result = $conn->query($sql5)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row[rut];
        $field2name = $row[dv];
        $field3name = $row[nombres];
        $field4name = $row[apellido_paterno];
        $field5name = $row[apellido_materno];
        $field6name = $row[motivo];
        $field7name = $row[autoriza];
        $field8name = $row[ingreso];
       # $field9name = $row[temp_ingreso];
        echo '<tr style="color:#585858"> 
                 <td align=center>' . $field1name . '-' . $field2name . '</td> 
                 <td>' . $field3name . '</td> 
                 <td>' . $field4name . '</td> 
                 <td>' . $field5name . '</td> 
                 <td align="center">' . $field6name . '</td> 
				 <td align="center">' . $field7name . '</td> 
				 <td align="center">' . $field8name . '</td> 
				
             </tr>';

    }
}
echo '</table>';
echo '<br>';
echo '<hr class="lineaverde">';
echo '<br>';

?>