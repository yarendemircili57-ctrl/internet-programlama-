<?php
session_start();
include "config.php"; 


if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = hash("sha256", $_POST['password']); 

   
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        
        if ($row['role'] == 'admin') {
            header("Location: admin.php");
            exit();
        } else {
            header("Location: uye.php");
            exit();
        }
    } else {
        
        $_SESSION['error'] = "Kullanıcı adı veya şifre hatalı!";
        header("Location: login.php");
        exit();
    }
} else {
    
    header("Location: login.php");
    exit();
}
?>
