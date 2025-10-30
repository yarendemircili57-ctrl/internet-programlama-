<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

include "config.php";

// Form gönderilmişse
if(isset($_POST['ekle'])){
    $ad = $_POST['ad'];
    $yazar = $_POST['yazar'];
    $yayin_yili = $_POST['yayin_yili'];
    $durum = $_POST['durum'];

    mysqli_query($conn, "INSERT INTO kitaplar (ad, yazar, yayin_yili, durum) VALUES ('$ad', '$yazar', '$yayin_yili', '$durum')");
    header("Location: kitaplar.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Kitap Ekle - Admin</title>
    <link rel="stylesheet" href="css/genel.css">
    <style>
        .kitap-form { max-width:500px; margin:40px auto; background:rgba(255,255,255,0.85); padding:25px; border-radius:18px; box-shadow:0 8px 25px rgba(0,0,0,0.1); }
        .kitap-form input, .kitap-form select { width:100%; padding:12px; margin-top:15px; border-radius:10px; border:1px solid #ccc; font-size:14px; }
        .kitap-form button { margin-top:20px; width:100%; padding:12px; background:#1976d2; color:white; border:none; border-radius:12px; font-weight:600; cursor:pointer; transition:0.3s; }
        .kitap-form button:hover { background:#0d47a1; transform:translateY(-2px); }
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
    <h2>Yeni Kitap Ekle</h2>
    <div class="kitap-form">
        <form method="POST">
            <input type="text" name="ad" placeholder="Kitap Adı" required>
            <input type="text" name="yazar" placeholder="Yazar" required>
            <input type="number" name="yayin_yili" placeholder="Yayın Yılı" min="1000" max="2100" required>
            <select name="durum" required>
                <option value="Mevcut">Mevcut</option>
                <option value="Ödünç Verildi">Ödünç Verildi</option>
            </select>
            <button type="submit" name="ekle">Kitap Ekle</button>
        </form>
    </div>
</div>

</body>
</html>
