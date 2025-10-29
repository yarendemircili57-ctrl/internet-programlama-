<?php
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit();
}
include "config.php";
$username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>MSB Library - Admin Panel</title>
  <link rel="stylesheet" href="css/genel.css">
</head>
<body>


<div id="header">
  <div id="logo">
    <a href="index.html"><img src="images/logo.png" alt="MSB Library Logo"></a>
  </div>
  <div id="menu">
    <span style="color:white; font-weight:600; margin-right:15px;">
      Hoşgeldin, <?php echo htmlspecialchars($username); ?>
    </span>
    <a href="logout.php" style="color:white; font-weight:600;">Çıkış</a>
  </div>
</div>

<div id="content">
  <h2>Admin Paneli</h2>
  <p>Burada kütüphane yönetimi ile ilgili tüm işlemleri gerçekleştirebilirsiniz.</p>

 
  <div class="admin-container">

    <div class="card">
      <h3>Kitap Yönetimi</h3>
      <p>Kitap ekle, düzenle veya sil.</p>
      <a href="kitaplar.php" class="btn">Yönet</a>
    </div>

    <div class="card">
      <h3>Üye Yönetimi</h3>
      <p>Üye ekle, düzenle veya sil.</p>
      <a href="uyeler.php" class="btn">Yönet</a>
    </div>

    <div class="card">
      <h3>Ödünç Takip</h3>
      <p>Ödünç verilen kitapları görüntüle ve yönet.</p>
      <a href="odunc.php" class="btn">Yönet</a>
    </div>

    <div class="card">
      <h3>Duyurular</h3>
      <p>Kütüphane duyurularını ekle veya güncelle.</p>
      <a href="duyurular.php" class="btn">Yönet</a>
    </div>

  </div>
</div>

</body>
</html>
