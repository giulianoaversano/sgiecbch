<?php
$sql1o="SELECT * FROM registro,nomina WHERE registro.compania='$compania' AND registro.evento='$estado' AND registro.rut = nomina.rut AND civil='No' AND (nomina.cargo='Capitan' OR nomina.ofgral='Si') ORDER BY clave ASC" ;
$sql1o2="SELECT * FROM registro,nomina WHERE registro.compania='$compania' AND registro.evento='$estado' AND registro.rut = nomina.rut AND civil='No' AND nomina.oficial='Si' AND nomina.cargo <> 'Capitan' ORDER BY clave ASC" ;

$sql1v="SELECT * FROM nomina, registro WHERE registro.compania='$compania' AND registro.evento='$estado' AND registro.rut = nomina.rut AND nomina.oficial='No' AND ofgral='No' AND civil='No'  ORDER BY clave DESC" ;
$sql1c="SELECT * FROM Registro_Conductores,nomina WHERE Registro_Conductores.compania='$compania' AND Registro_Conductores.status='$estado' AND Registro_Conductores.rut = nomina.rut ORDER BY clave ASC" ;

echo '		<table border="1" style="border-collapse:collapse; border: 1px solid black" cellspacing="" width="100%" cellpadding="">
    <tr style="background-color:dodgerblue">
        <td colspan="3"><p style="text-align: center"> <a href="../'.$compania.'" style="color:white"><b>' . $compania .'</b></a></p>
    </tr>
    <tr style="color:#585858">
        <td align="center"> <font face="Arial"><b>Clave</b></font> </td>
        <td align="center"> <font face="Arial"><b>Bombero</b></font> </td>
        <td align="center"> <font face="Arial"><b>Estado</b></font> </td>
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

    </tr>';

    }
    }

    if ($result = $conn->query($sql1o2)) {
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

    </tr>';

    }
    }

    if ($result = $conn->query($sql1v)) {
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

    </tr>';

    }
    }
    echo '<tr style="background-color: palegreen">
        <td colspan="3" align="center"><b>Conductores</b></td>
    </tr>';
    if ($result = $conn->query($sql1c)) {
    while ($row = $result->fetch_assoc()) {
    $fieldclave = $row[clave];
    $fieldnombres = $row[nombres];
    $fieldpaterno = $row[apellido_paterno];
    $fieldmaterno = $row[apellido_materno];
    $fieldcargo = $row[cargo];

    echo'
    <tr>
        <td align="center">'.$fieldclave.'</td>
        <td align="center">'.$fieldnombres.' '.$fieldpaterno.' '.$fieldmaterno.'</td>
        <td align="center">Disponible</td>
    </tr>';

    }
    }
    echo '</table>';
    ?>