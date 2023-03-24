<head>
    <style>

        body {
            font-family: 'Verdana', sans-serif
        }
    </style>
</head>
<?php
session_start();
header("Refresh: 60");
include('dbconnection.php');


$respuesta = "SI";
$estado="Ingreso";
$compania="Segunda";

/* INICIO TABLA*/
include('tablas.inc');

?>