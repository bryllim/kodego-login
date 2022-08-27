<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'bryl');
define('DB_PASSWORD', 'bryl');
define('DB_NAME', 'demo');

// connect to MySQL Database
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>