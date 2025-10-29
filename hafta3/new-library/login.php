<?php
session_start();
include "config.php"; 


if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin.php");
        exit();
    } else {
        header("Location: uye.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>MSB Library - Giriş</title>
  <link rel="stylesheet" href="css/genel.css">
</head>
<body>

  <div class="login-container">
    <div class="login-card">
      <h2>Giriş Yap</h2>
      <form action="login_control.php" method="POST">
        <label for="username">Kullanıcı Adı</label>
        <input type="text" name="username" placeholder="Kullanıcı adınızı girin" required>

        <label for="password">Şifre</label>
        <input type="password" name="password" placeholder="Şifrenizi girin" required>

        <button type="submit" class="login-btn">Giriş</button>
      </form>
      <p><a href="index.html">Anasayfaya Dön</a></p>
      <?php
      
      if (isset($_SESSION['error'])) {
          echo '<p style="color:red; margin-top:10px;">'.$_SESSION['error'].'</p>';
          unset($_SESSION['error']);
      }
      ?>
    </div>
  </div>

</body>
</html>
