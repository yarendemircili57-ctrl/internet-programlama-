<?php
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit();
}

include "config.php";

// Tüm üyeleri çek
$uyeler = mysqli_query($conn, "SELECT * FROM users WHERE role='uye'");
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Üye Yönetimi - Admin</title>
    <link rel="stylesheet" href="css/genel.css">
    <style>
        table { width:100%; border-collapse: collapse; margin-top:20px; }
        table th, table td { padding:12px; border-bottom:1px solid #ccc; text-align:left; }
        table th { background: #1976d2; color:white; }
        table tr:last-child td { border-bottom:none; }
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
    <h2>Üye Yönetimi</h2>

    <a href="uyeekle.php" class="btn-action btn-ekle">Yeni Üye Ekle</a>

    <!-- Üyeler Listesi -->
    <table>
        <tr>
            <th>ID</th>
            <th>Kullanıcı Adı</th>
            <th>Durum</th>
            <th>İşlemler</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($uyeler)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo $row['role']; ?></td>
            <td>
                <a href="uyeguncelle.php?id=<?php echo $row['id']; ?>" class="btn-action btn-guncelle">Güncelle</a>
                <a href="uyesil.php?id=<?php echo $row['id']; ?>" class="btn-action btn-sil">Sil</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>

</body>
</html>
