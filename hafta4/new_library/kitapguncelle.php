<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

include "config.php";

// Güncelleme formu gönderilmişse
if(isset($_POST['guncelle'])){
    $id = $_POST['id'];
    $ad = $_POST['ad'];
    $yazar = $_POST['yazar'];
    $yayin_yili = $_POST['yayin_yili'];
    $durum = $_POST['durum'];

    mysqli_query($conn, "UPDATE kitaplar SET ad='$ad', yazar='$yazar', yayin_yili='$yayin_yili', durum='$durum' WHERE id=$id");
    header("Location: kitaplar.php");
    exit();
}

// GET ile id gelmişse mevcut veriyi çek
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $kitap = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kitaplar WHERE id=$id"));
} else {
    header("Location: kitaplar.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kitap Güncelle - Admin</title>
    <link rel="stylesheet" href="css/genel.css">
    <style>
        .kitap-form { max-width:500px; margin:40px auto; background:rgba(255,255,255,0.85); padding:25px; border-radius:18px; box-shadow:0 8px 25px rgba(0,0,0,0.1); }
        .kitap-form input, .kitap-form select { width:100%; padding:12px; margin-top:15px; border-radius:10px; border:1px solid #ccc; font-size:14px; }
        .kitap-form button { margin-top:20px; width:100%; padding:12px; background:#ff9800; color:white; border:none; border-radius:12px; font-weight:600; cursor:pointer; transition:0.3s; }
        .kitap-form button:hover { background:#f57c00; transform:translateY(-2px); }
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
    <h2>Kitap Güncelle</h2>
    <div class="kitap-form">
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $kitap['id']; ?>">
            <input type="text" name="ad" value="<?php echo htmlspecialchars($kitap['ad']); ?>" placeholder="Kitap Adı" required>
            <input type="text" name="yazar" value="<?php echo htmlspecialchars($kitap['yazar']); ?>" placeholder="Yazar" required>
            <input type="number" name="yayin_yili" value="<?php echo $kitap['yayin_yili']; ?>" placeholder="Yayın Yılı" min="1000" max="2100" required>
            <select name="durum" required>
                <option value="Mevcut" <?php if($kitap['durum']=='Mevcut') echo 'selected'; ?>>Mevcut</option>
                <option value="Ödünç Verildi" <?php if($kitap['durum']=='Ödünç Verildi') echo 'selected'; ?>>Ödünç Verildi</option>
            </select>
            <button type="submit" name="guncelle">Güncelle</button>
        </form>
    </div>
</div>

</body>
</html>
