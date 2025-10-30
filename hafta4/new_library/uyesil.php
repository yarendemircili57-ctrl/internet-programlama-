<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

include "config.php";

// GET ile id gelmişse üyeyi sil
if(isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");
}

header("Location: uyeler.php");
exit();
