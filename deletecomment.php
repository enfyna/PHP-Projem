<?php include_once "site/head.php"; ?>
<?php include_once "site/header.php"; ?>

<main>
  <div>
    <h1>Yorum Sil</h1>
  </div>
  <?php 
require_once "library/config.php";
require_once "library/functions.php";
require_once "library/kick_anon.php";

// Kullanıcı yorum silmişse onu ayarla
if(isset($_POST["edit"])){
  if($_POST["edit"]=="true"){
    $rating_point = $_POST["rating_point"];
    $rating_comment = $_POST["rating_comment"];
    $rating_id = $_POST["rating_id"];
    ?>
    <h1><b>Yorum Siliniyor...</b></h1>
    <?php
    mysqli_query($db,"DELETE ratings FROM ratings
        WHERE rating_id = '$rating_id'");
    };
  redirectTo("game.php?game_id=".$_POST["game_id"],0);
  exit;
}
else if(!isset($_POST["rating_id"]))exit;//redirectTo("index.php",0);

//print_r($_POST);
$deleting_own_comment = true;
if($_POST["user_id"] == $_SESSION["user_id"]){ // Kullanıcı kendi yorumunu silecekse

}elseif ($_POST["user_id"] != $_SESSION["user_id"] && $_SESSION["user_is_mod"] == 1) { // Moderator baska bir kullanıcının yorumunu silecekse
$deleting_own_comment = false;

}else{ // Hatalı giriş var
    redirectTo("index.php",0);
};
?>
<div>
  <form class="form vertical" id="deletecomment" action="deletecomment.php" method="post">
    <input type="hidden" name="rating_point" value="<?php echo $_POST["rating_point"] ?>">
    <input type="hidden" name="rating_comment" value="<?php echo $_POST["rating_comment"] ?>">
    <input type="hidden" name="rating_id" value="<?php echo $_POST["rating_id"] ?>">
    <input type="hidden" name="game_id" value="<?php echo $_POST["game_id"] ?>">
    <br>
    <h2>
    <?php if(!$deleting_own_comment){?>
        '<?php echo $_POST["user_name"]?>' kullanıcısının yorumunu silmek üzeresin emin misin ?
    <?php }else{?>
        Yorumunu silmek üzeresin emin misin ? 
    <?php }; ?>
    </h2>
    <br> 
    <div class="horizontal">
      <button class="btn p1 green wt" type="submit" name="edit"value="false">Vazgeç</button>
      <button class="btn p1 red wt" type="submit"name="edit"value="true">Sil</button>
    </div>
    <br>
    <h3>Sonsuza kadar.😱</h3>
  </form>
</div>
</main>
<?php include_once "site/footer.php"; ?>
