<?php
$server = "localhost";
$username = "root";
$password = "PubuduPamod@2014";
$db = "pdms";
try {
    $con = new mysqli($server, $username, $password, $db);
} catch (mysqli_sql_exception $e) {
    die();
}
