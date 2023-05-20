<?php include_once "site/head.php";include_once "site/header.php"; ?>
<?php
require_once "library/config.php";
require_once "library/functions.php";
require_once "library/kick_user.php";
do {
  if (isset($_POST["username"]) && isset($_POST["password"])) {
    if (strlen($_POST["username"]) < 3) {
      $shortname = true;
      break;
    };
    if (strlen($_POST["password"]) < 3) {
      $shortpass = true;
      break;
    };
    $user_name = $_POST["username"];
    $user_pass = $_POST["password"];
    $user_mail = $_POST["email"];
  
    $q = mysqli_query($db,
     "SELECT users.user_name FROM users WHERE user_name = '$user_name'");
    if(mysqli_num_rows($q) >= 1){  
      $nametaken = true;
      break;
    };
    $user_pass = hash("sha256", $user_pass);
  
    mysqli_query($db, 
      "INSERT INTO users(user_name,user_email,user_pass) VALUES('" . "$user_name" . "','" . "$user_mail" . "','" . "$user_pass" . "')");
  
    $q = mysqli_query($db, 
      "SELECT user_id,user_name,user_email,user_point,user_is_mod FROM users WHERE user_name='$user_name' and user_pass='$user_pass' LIMIT 1");
    if(mysqli_num_rows($q) == 1){  
      $user = mysqli_fetch_assoc($q);
      // oturum bilgilerini sakla
      $_SESSION = $user;
      session_start();
      redirectTo("index.php", 0);
    };
  };
} while (0);
?>
<main>
  <form class="login vertical" action="signup.php" method="post">
    <h1 class="outline black">Kayıt Ol!</h1>
    <?php if(isset($shortname)){?>
    <h3  class="login-alert">Kullanıcı Adı 3 harften uzun olmalı!</h1>
    <?php }; ?>
    <?php if(isset($shortpass)){?>
    <h3  class="login-alert">Şifreniz 3 karakterden uzun olmalı!</h1>
    <?php }; ?>
    <?php if(isset($nametaken)){?>
    <h3  class="login-alert">Bu kullanıcı adı alınmış!</h1>
    <?php }; ?>
    <label for="username">Kullanıcı Adı</label>
    <input type="text" id="username" name="username" placeholder="Kullanıcı adınızı girin">

    <label for="email">E-Posta</label>
    <input type="email" id="email" name="email" placeholder="E-postanızı girin">

    <label for="password">Şifre</label>
    <input type="password" id="password" name="password" placeholder="Şifrenizi girin">

    <input class="btn green p1" type="submit" value="Kayıt Ol">
    <p>Hesabın var mı? <a href="login.php">Giriş Yap!</a></p>
  </form>
</main>
<?php include_once "site/footer.php"; ?>
