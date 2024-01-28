<?php

// $host = "localhost";
// $dbname = "digisell_db";
// $username = "root";
// $password = "";

$host = "localhost";
$dbname = "ahnaf_digisel";
$username = "ahnaf_root";
$password = "8CsBbDGRndNh";

$mysqli = new mysqli(hostname: $host,
                     username: $username,
                     password: $password,
                     database: $dbname);

if ($mysqli->connect_error) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;

?>


