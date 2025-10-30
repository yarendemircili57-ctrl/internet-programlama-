<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role'] != 'uye'){
    header("Location: login.php");
    exit();
}
include "config.php";

// Üye için mevcut kitapları çek (opsiyonel)
$kitaplar = mysqli_query($conn, "SELECT * FROM kitaplar WHERE durum='Mevcut'");
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Üye Paneli - MSB Library</title>
    <link rel="stylesheet" href="css/genel.css">
    <style>
        .kitap-container { display:flex; flex-wrap:wrap; gap:20px; margin-top:30px; }
        .kitap-card { flex:1 1 200px; padding:20px; background:rgba(255,255,255,0.8); border-radius:16px; box-shadow:0 6px 18px rgba(0,0,0,0.1); text-align:center; transition:transform 0.2s; }
        .kitap-card:hover { transform:translateY(-5px); }
        .kitap-card h4 { margin-bottom:10px; color:#1976d2; }
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
    <h2>Üye Paneli</h2>
    <p>Burada mevcut kitapları görebilir ve ödünç alabilirsiniz.</p>

    <div class="kitap-container">
        <?php while($row = mysqli_fetch_assoc($kitaplar)): ?>
            <div class="kitap-card">
                <h4><?php echo htmlspecialchars($row['ad']); ?></h4>
                <p>Yazar: <?php echo htmlspecialchars($row['yazar']); ?></p>
                <p>Yayın Yılı: <?php echo $row['yayin_yili']; ?></p>
                <p>Durum: <?php echo $row['durum']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
