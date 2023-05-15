<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery-zaver";

$spoj2 = mysqli_connect($servername, $username, $password, $dbname);

if (!$spoj2) {
    die("Chyba spojenia s databázou: " . mysqli_connect_error());
}