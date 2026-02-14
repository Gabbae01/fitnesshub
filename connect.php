<?php
// connections
$host = "localhost";
$username = "root";
$password = "";
$database = "fitnesshub_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn -> connect_error){
    die ("Connection Failed!" . $conn -> connect_error);
}
?>