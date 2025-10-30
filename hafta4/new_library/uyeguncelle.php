<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

include "config.php";

// Form gönderilmişse güncelle
if(isset($_POST['guncelle'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $durum = $_POST['durum'];

    mysqli_query($conn, "UPDATE users SET username='$username', durum='$durum' WHERE id=$id");
    header("Location: uyeler.php");
    exit();
}

// GET ile id gelmişse mevcut veriyi çek
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $uye = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));
} else {
    header("Location: uyeler.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Üye Güncelle - Admin</title>
    <link rel="stylesheet" href="css/genel.css">
    <style>
        .uye-form { max-width:400px; margin:30px auto; background:rgba(255,255,255,0.8); padding:20px; border-radius:16px; box-shadow:0 6px 18px rgba(0,0,0,0.1); }
        .uye-form input, .uye-form select { width:100%; padding:10px; margin-top:12px; border-radius:8px; border:1px solid #ccc; }
        .uye-form button { margin-top:15px; width:100%; padding:10px; background:#ff9800; color:white; border:none; border-radius:8px; cursor:pointer; }
        .uye-form button:hover { background:#f57c00; }
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
    <h2>Üye Güncelle</h2>
    <div class="uye-form">
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $uye['id']; ?>">
            <input type="text" name="username" value="<?php echo htmlspecialchars($uye['username']); ?>" required>
            <select name="durum" required>
                <option value="aktif" <?php if($uye['durum']=='aktif') echo 'selected'; ?>>Aktif</option>
                <option value="pasif" <?php if($uye['durum']=='pasif') echo 'selected'; ?>>Pasif</option>
            </select>
            <button type="submit" name="guncelle">Güncelle</button>
        </form>
    </div>
</div>

</body>
</html>
