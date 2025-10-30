<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

include "config.php";

// Form gönderilmişse
if(isset($_POST['ekle'])){
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']); // SHA256 ile şifrele
    $durum = $_POST['durum'];

    mysqli_query($conn, "INSERT INTO users (username, password, role, durum) VALUES ('$username', '$password', 'uye', '$durum')");
    header("Location: uyeler.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Üye Ekle - Admin</title>
    <link rel="stylesheet" href="css/genel.css">
    <style>
        .uye-form { max-width:400px; margin:30px auto; background:rgba(255,255,255,0.8); padding:20px; border-radius:16px; box-shadow:0 6px 18px rgba(0,0,0,0.1); }
        .uye-form input, .uye-form select { width:100%; padding:10px; margin-top:12px; border-radius:8px; border:1px solid #ccc; }
        .uye-form button { margin-top:15px; width:100%; padding:10px; background:#1976d2; color:white; border:none; border-radius:8px; cursor:pointer; }
        .uye-form button:hover { background:#0d47a1; }
    </style>
</head>
<body>

<div id="header">
  <div id="logo"><a href="index.html"><img src="images/logo.png" alt="MSB Library Logo"></a></div>
  <div id="menu">
    <span style="color:white; font-weight:600; margin-right:15px;">Hoşgeldin, <?php echo $_SESSION["username"]; ?></span>
    <a href="logout.php" style="color:white; font-weight:600;">Çıkış</a>
  </div>
</div>

<div id="content">
    <h2>Yeni Üye Ekle</h2>
    <div class="uye-form">
        <form method="POST">
            <input type="text" name="username" placeholder="Kullanıcı Adı" required>
            <input type="password" name="password" placeholder="Şifre" required>
            <select name="durum" required>
                <option value="aktif">Aktif</option>
                <option value="pasif">Pasif</option>
            </select>
            <button type="submit" name="ekle">Üye Ekle</button>
        </form>
    </div>
</div>

</body>
</html>
