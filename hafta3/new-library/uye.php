<?php
session_start();

// Eğer kullanıcı giriş yapmamış veya rolü "uye" değilse login sayfasına yönlendir
if (!isset($_SESSION["username"]) || $_SESSION["role"] != "uye") {
    header("Location: login.php");
    exit();
}

// Veritabanı bağlantısı
include "config.php";

// Kullanıcı bilgilerini al
$username = $_SESSION["username"];
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

if (!$user_query) {
    die("Veritabanı sorgu hatası: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($user_query);

// Örnek: Ödünç alınan kitaplar (veritabanına bağlanırsan dinamik yapılabilir)
$odunc_kitaplar = [
    ["kitap" => "Sefiller", "teslim_tarih" => "15/11/2025", "durum" => "Teslim Edilmedi"],
    ["kitap" => "Suç ve Ceza", "teslim_tarih" => "20/11/2025", "durum" => "Teslim Edildi"]
];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>MSB Library - Üye Panel</title>
  <link rel="stylesheet" href="css/genel.css">
  <style>
    .stats { display:flex; gap:20px; flex-wrap:wrap; margin-bottom:20px; }
    .stat-card { flex:1; min-width:150px; background: rgba(255,255,255,0.85); padding:20px; border-radius:16px; text-align:center; box-shadow:0 8px 20px rgba(0,0,0,0.08); }
    table { width:100%; border-collapse: collapse; margin-top:20px; background: rgba(255,255,255,0.85); border-radius:16px; overflow:hidden; }
    table th, table td { padding:12px; border-bottom:1px solid #ccc; text-align:left; }
    table th { background: #1976d2; color:white; }
    table tr:last-child td { border-bottom:none; }
  </style>
</head>
<body>

<!-- HEADER -->
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

<!-- CONTENT -->
<div id="content">
  <h2>Üye Paneli</h2>
  <p>Buradan kütüphane ile ilgili tüm bilgilere kolayca ulaşabilirsin.</p>

  <!-- İstatistik Kartları -->
  <div class="stats">
    <div class="stat-card">
      <h3>Toplam Kitap</h3>
      <p>250</p>
    </div>
    <div class="stat-card">
      <h3>Ödünç Aldığın Kitap</h3>
      <p><?php echo count($odunc_kitaplar); ?></p>
    </div>
    <div class="stat-card">
      <h3>Geciken Kitap</h3>
      <p>1</p>
    </div>
  </div>

  <!-- Hızlı Erişim -->
  <div style="display:flex; gap:16px; flex-wrap:wrap; margin-bottom:20px;">
    <a href="kitaplar.php" class="btn">Kitap Ara</a>
    <a href="profil.php" class="btn">Profilim</a>
    <a href="iletisim.html" class="btn">İletişim</a>
    <a href="duyurular.php" class="btn">Duyurular</a>
  </div>

  <!-- Ödünç Kitaplar Tablosu -->
  <h3>Ödünç Aldığın Kitaplar</h3>
  <table>
    <tr>
      <th>Kitap Adı</th>
      <th>Teslim Tarihi</th>
      <th>Durum</th>
    </tr>
    <?php foreach($odunc_kitaplar as $kitap): ?>
    <tr>
      <td><?php echo htmlspecialchars($kitap['kitap']); ?></td>
      <td><?php echo htmlspecialchars($kitap['teslim_tarih']); ?></td>
      <td><?php echo htmlspecialchars($kitap['durum']); ?></td>
    </tr>
    <?php endforeach; ?>
  </table>

</div>

</body>
</html>
