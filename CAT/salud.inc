<?php

$sql="SELECT * FROM nomina,registro WHERE registro.evento='Ingreso' AND registro.rut = nomina.rut AND Personal_salud='Si' ORDER BY clave ASC" ;
$cia="SELECT registro.compania FROM registro,nomina WHERE registro.evento='Ingreso' AND registro.rut = nomina.rut AND Personal_salud='Si' ORDER BY clave ASC" ;
echo '		<table border="1" style="border-collapse:collapse; border: 1px solid black" cellspacing="" width="100%" cellpadding="">
    <tr style="background-color:dodgerblue">
        <td colspan="4"><p style="text-align: center; color: White"> <b>Personal de Salud Disponible</b></a></p>
    </tr>
    <tr style="color:#585858">
        <td align="center"> <font face="Arial"><b>Clave</b></font> </td>
        <td align="center"> <font face="Arial"><b>Compañía</b></font> </td>
        <td align="center"> <font face="Arial"><b>Bombero</b></font> </td>
        <td align="center"> <font face="Arial"><b>Estado</b></font> </td>
    </tr>';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {

                $fieldclave = $row[clave];
                $fieldnombres = $row[nombres];
                $fieldpaterno = $row[apellido_paterno];
                $fieldmaterno = $row[apellido_materno];
                $fieldestado = $row[estado];

                $fieldcompania = $row[compania];

                echo '<tr style="color:#585858">
        <td align="center">' . $fieldclave . '</td>
        <td align="center">' . $fieldcompania . '</td>
        <td align="center">' . $fieldnombres . ' ' . $fieldpaterno . ' ' . $fieldmaterno . '</td>
        <td align="center">' . $fieldestado . '</td>

    </tr>';

            }
        }



echo '</table>';
?>