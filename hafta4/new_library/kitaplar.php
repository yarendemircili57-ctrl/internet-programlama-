<?php
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit();
}

include "config.php";

// Tüm kitapları çek
$kitaplar = mysqli_query($conn, "SELECT * FROM kitaplar");
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kitap Yönetimi - Admin</title>
    <link rel="stylesheet" href="css/genel.css">
    <style>
        table { width:100%; border-collapse: collapse; margin-top:20px; }
        table th, table td { padding:12px; border-bottom:1px solid #ccc; text-align:left; }
        table th { background: #1976d2; color:white; }
        .btn-action { padding:6px 12px; border:none; border-radius:8px; cursor:pointer; color:white; margin-right:5px; text-decoration:none; display:inline-block; }
        .btn-ekle { background:#4caf50; }
        .btn-guncelle { background:#ff9800; }
        .btn-sil { background:#f44336; }
    </style>
</head>
<body>

<div id="header">
  <div id="logo">
    <a href="index.html"><img src="images/logo.png" alt="MSB Library Logo"></a>
  </div>
  <div id="menu">
    <span style="color:white; font-weight:600; margin-right:15px;">Hoşgeldin, <?php echo $_SESSION["username"]; ?></span>
    <a href="logout.php" style="color:white; font-weight:600;">Çıkış</a>
  </div>
</div>

<div id="content">
    <h2>Kitap Yönetimi</h2>

    <a href="kitapekle.php" class="btn-action btn-ekle">Yeni Kitap Ekle</a>

    <!-- Kitap Listesi -->
    <table>
        <tr>
            <th>ID</th>
            <th>Ad</th>
            <th>Yazar</th>
            <th>Yayın Yılı</th>
            <th>Durum</th>
            <th>İşlemler</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($kitaplar)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['ad']); ?></td>
            <td><?php echo htmlspecialchars($row['yazar']); ?></td>
            <td><?php echo $row['yayin_yili']; ?></td>
            <td><?php echo $row['durum']; ?></td>
            <td>
                <a href="kitapguncelle.php?id=<?php echo $row['id']; ?>" class="btn-action btn-guncelle">Güncelle</a>
                <a href="kitapsil.php?id=<?php echo $row['id']; ?>" class="btn-action btn-sil">Sil</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>

</body>
</html>
