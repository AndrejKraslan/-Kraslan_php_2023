<?php
$serverName = 'localhost';
$dBUserName = 'root';
$dBPassword = '';
$dBName = 'zaver';

$spoj = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);

if (!$spoj) {
    die("Chyba spojenia s databázou: " . mysqli_connect_error());
}
if (empty($spoj)){
    $spoj = new stdClass();
}