<?php include_once "site/head.php"; ?>
<?php include_once "site/header.php"; ?>
<?php
require_once "library/config.php";
require_once "library/kick_user.php";
require_once "library/functions.php";

if (isset($_POST["username"]) && strlen($_POST["username"]) >= 3 && strlen($_POST["password"]) >= 3) {
  $user_name = $_POST["username"];
  $user_pass = hash("sha256", $_POST["password"]);

  $q = mysqli_query($db, 
    "SELECT user_id,user_name,user_email,user_point,user_is_mod FROM users WHERE user_name='$user_name' and user_pass='$user_pass' LIMIT 1");
  if(mysqli_num_rows($q) == 1){
    $user = mysqli_fetch_assoc($q);
    $_SESSION = $user;
    redirectTo("index.php", 0);
  }else{
    $incorrect_login = true;
  };
};
?>
<main>
  <form class="login vertical" action="login.php" method="post">
    <h1 class="outline black">Giriş Yap</h1>
    <?php if(isset($incorrect_login)){?>
    <h3 class="login-alert">Hatalı Giriş!</h1>
    <?php }; ?>
    <label for="username">Kullanıcı Adı</label>
    <input type="text" id="username" name="username" placeholder="Kullanıcı adınızı girin"
    value="<?php echo isset($_POST["username"])?$_POST["username"]:""?>">

    <label for="password">Şifre</label>
    <input type="password" id="password" name="password" placeholder="Şifrenizi girin">

    <input class="btn green p1" type="submit" value="Giriş Yap">
    <p>Hesabın yok mu? <a href="signup.php" >Yeni hesap oluştur!</a></p>
  </form>
</main>
<?php include_once "site/footer.php"; ?>

