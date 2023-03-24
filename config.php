<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'cbch');
define('DB_PASSWORD', 'B0mb3r0s!2022');
define('DB_NAME', 'cbch');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
