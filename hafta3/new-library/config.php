<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "msblibrary";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
