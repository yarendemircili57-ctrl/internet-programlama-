<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Paneli - MSB Library</title>
    <link rel="stylesheet" href="css/genel.css">
    <style>
        .panel-container { display:flex; flex-wrap:wrap; gap:20px; margin-top:30px; }
        .panel-card { flex:1 1 200px; padding:20px; background:rgba(255,255,255,0.8); border-radius:16px; box-shadow:0 6px 18px rgba(0,0,0,0.1); text-align:center; transition:transform 0.2s; cursor:pointer; }
        .panel-card:hover { transform:translateY(-5px); }
        .panel-card h3 { margin-bottom:15px; color:#1976d2; }
        .panel-card a { text-decoration:none; color:white; background:#1976d2; padding:10px 18px; border-radius:12px; display:inline-block; margin-top:10px; }
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
    <h2>Admin Paneli</h2>
    <div class="panel-container">
        <div class="panel-card">
            <h3>Kitap Yönetimi</h3>
            <p>Kitap ekle, sil veya güncelle</p>
            <a href="kitaplar.php">Yönet</a>
        </div>
        <div class="panel-card">
            <h3>Üye Yönetimi</h3>
            <p>Üye ekle, sil veya durumu güncelle</p>
            <a href="uyeler.php">Yönet</a>
        </div>
        <div class="panel-card">
            <h3>Raporlar</h3>
            <p>Mevcut kitap ve üye durumlarını görüntüle</p>
            <a href="raporlar.php">Görüntüle</a>
        </div>
    </div>
</div>

</body>
</html>
