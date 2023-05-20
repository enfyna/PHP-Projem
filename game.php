<?php 
include_once "site/head.php";
include_once "site/header.php"; 
?>
<main>
<?php 
require_once "library/config.php";
require_once "library/functions.php";

if (!isset($_GET['game_id'])){ // Oyun IDsi alınamazsa ana menuye geri dön
  //redirectTo("index.php",0); 
};
$game_id = $_GET['game_id']; 

$query = "SELECT games.*,users.user_name,users.user_point,users.user_is_mod FROM games JOIN users ON games.user_id = users.user_id WHERE games.game_id = '$game_id'";
$q = mysqli_query($db, $query); // Oyun bilgilerini ve oyunu ekleyen kullanıcının bilgilerini al 
 
$row_num = mysqli_num_rows($q);
if($row_num == 0){ // Oyun IDsi bulunamazsa ana menuye geri dön
  //redirectTo("index.php",0); 
};
$game_data = mysqli_fetch_assoc($q); // Oyun bilgilerini al

if(isset($_POST["comment"])){ // Kullanıcı yorum bıraktıysa onu ekle
  $user_id = $_SESSION["user_id"];
  $comment = $_POST["comment"];
  $rating = $_POST["rating"];
  mysqli_query($db, // Yorumu ekle 
    "INSERT INTO ratings(game_id,user_id,rating_comment,rating_point) VALUES('" . "$game_id" . "','" . "$user_id" . "','" . "$comment" . "','" . "$rating" . "')"); 
  mysqli_query($db, // Kullanıcı puanını 1 arttır
    "UPDATE users SET user_point = (SELECT users.user_point FROM users WHERE user_id = '$user_id')+1 WHERE user_id = '$user_id'");
};

// Yorumları al ve oyunun puanını hesapla
if(isset($_POST["filter"])){
  if($_POST["filter"] == "incpoint"){
    $query = "SELECT ratings.rating_id,ratings.rating_comment,ratings.rating_point,users.user_id, users.user_name, users.user_point, users.user_is_mod FROM ratings JOIN users ON ratings.user_id = users.user_id WHERE game_id = '$game_id' ORDER BY ratings.rating_point ASC";
  }
  elseif ($_POST["filter"] == "decpoint") {
    $query = "SELECT ratings.rating_id,ratings.rating_comment,ratings.rating_point,users.user_id, users.user_name, users.user_point, users.user_is_mod FROM ratings JOIN users ON ratings.user_id = users.user_id WHERE game_id = '$game_id' ORDER BY ratings.rating_point DESC";
  }
  elseif ($_POST["filter"] == "newfirst") {
    $query = "SELECT ratings.rating_id,ratings.rating_comment,ratings.rating_point,users.user_id, users.user_name, users.user_point, users.user_is_mod FROM ratings JOIN users ON ratings.user_id = users.user_id WHERE game_id = '$game_id' ORDER BY ratings.rating_id DESC";
  }
  elseif ($_POST["filter"] == "oldfirst") {
    $query = "SELECT ratings.rating_id,ratings.rating_comment,ratings.rating_point,users.user_id, users.user_name, users.user_point, users.user_is_mod FROM ratings JOIN users ON ratings.user_id = users.user_id WHERE game_id = '$game_id' ORDER BY ratings.rating_id ASC";
  }
  elseif ($_POST["filter"] == "userpoint") {
    $query = "SELECT ratings.rating_id,ratings.rating_comment,ratings.rating_point,users.user_id, users.user_name, users.user_point, users.user_is_mod FROM ratings JOIN users ON ratings.user_id = users.user_id WHERE game_id = '$game_id' ORDER BY users.user_point DESC";
  }
}else{
  $query = "SELECT ratings.rating_id,ratings.rating_comment,ratings.rating_point,users.user_id, users.user_name, users.user_point, users.user_is_mod FROM ratings JOIN users ON ratings.user_id = users.user_id WHERE game_id = '$game_id'";
};
$comment_q = mysqli_query($db, $query);
$comment_num = mysqli_num_rows($comment_q);
if($comment_num > 0){
  $comments = [];
  $game_rating_point = 0;
  for ($i=0; $i < $comment_num ; $i++) { 
    $comment = mysqli_fetch_assoc($comment_q);
    $comments[] = $comment;
    $game_rating_point += $comment["rating_point"];
  };
  $game_rating_point = $game_rating_point / $comment_num;
}else{
  $game_rating_point = 5;
};
?>
<div class="card blue horizontal m2 fw">
  <div class="game_profile_image" style="background-image: url('<?php echo $game_data['game_image']; ?>');">
  </div>
  <div class="game_profile_details hw" >
    <b>
    <div class="horizontal"><h1><?php echo $game_data['game_name']; ?></h1>&emsp;|&emsp;<div class="point_container <?php echo $comment_num <= 0 ? "" :($game_rating_point >= 7 ? "green":($game_rating_point <= 3 ? "red":"orange")) ?>"><?php echo $comment_num > 0 ? round($game_rating_point,1) : "-" ; ?></div></div>
    <hr class="line hw white">
    <br>
    Geliştirici<h3><?php echo $game_data['game_developer']; ?></h3>
    Kategori<h3><?php echo $game_data['game_genre']; ?></h3>
    Çıkış Tarihi<h3><?php echo $game_data['game_release_date']; ?></h3>
    <hr class="line hw white">
    <br>
    <?php echo $game_data['game_description']; ?>
    </b>
  </div>
</div>
<?php 
if(isset($_SESSION["user_is_mod"]) && $_SESSION["user_is_mod"] == true){
// Kullanıcı moderator ise oyunu kimin eklediğini ve düzenleme, silme gibi ayarları göster.
?>
<div class="card comment_size vertical">
  <h3>
    <b>Bu oyun <?php echo $game_data["user_name"]; ?>(<?php echo $game_data["user_point"];?>)(<?php echo $game_data["user_is_mod"]?"Moderatör":"Kullanıcı";?>) tarafından eklenmiştir.</b>
  </h3>
  <form action="editgame.php" method="post">
      <input type="hidden" name="game_id" value="<?php echo $game_id; ?>">
      <input type="submit" value="Oyunu düzenlemek için tıkla."class="btn fh fw"/>
  </form>
  <form action="deletegame.php" method="post">
      <input type="hidden" name="game_id" value="<?php echo $game_id; ?>">
      <input type="hidden" name="game_name" value="<?php echo $game_data['game_name']; ?>">
      <input type="hidden" name="comment_num" value="<?php echo $comment_num; ?>">
      <input type="submit" value="Oyunu silmek için tıkla." class="btn red fh fw"/>
  </form>
</div>
<?php
};
// Kullanıcı bu oyuna yorum bırakmamıs ise yorum kutusu ekle
if(isset($_SESSION["user_id"]) && !isset($_POST["comment"])){ 
  $user_id = $_SESSION["user_id"];
  $q = mysqli_query($db, "SELECT users.*, ratings.* FROM users 
    LEFT JOIN ratings ON users.user_id = ratings.user_id
    WHERE users.user_id = '$user_id' AND ratings.game_id = '$game_id'
    LIMIT 1");
  $rows = mysqli_num_rows($q);
  if($rows == 0){
?>
<form id="comment"class="card comment_size horizontal"  action="" method="post">
  <textarea form="comment"name="comment" class="comment_size hh hw comment-text-box" id="comment" type="text"placeholder="Oyun hakkında düşüncelerini yaz. (Maks 500 karakter)" required></textarea>
  <div class="vertical">    
    <input class="hh" type="number" id="rating" name="rating"min="0"max="10"step="0.5" placeholder="0-10 Aralığında Puan Ver" required>
    <input class="btn green p1" type="submit" value="Gönder">
  </div>
</form>
<?php
    };
};
// Yorumları yazdır
for ($i=0; $i < $comment_num ; $i++) {     
?>
<div class="card vertical comment_size <?php echo $comments[$i]["rating_point"] >= 7 ? "green":($comments[$i]["rating_point"] <= 3 ? "red":"orange") ?> ">
  <div class="fw fh"style="min-width: 0px; min-height: 0px;">
    <?php echo $comments[$i]["user_is_mod"]?"<b>Moderatör</b>":"Kullanıcı";?> : <b><?php echo $comments[$i]["user_name"]; ?> </b> (<?php echo $comments[$i]["user_point"]; ?>)
    <br>
    Verdiği puan : <b><?php echo $comments[$i]["rating_point"] ?></b>
    <br>
    Yorumu : <br>
    &emsp;<b><?php echo $comments[$i]["rating_comment"]; ?></b>
  </div>
  <?php if(isset($_SESSION["user_id"]) && ($_SESSION["user_id"] == $comments[$i]["user_id"] || $_SESSION["user_is_mod"] == 1)){?>
  <div class="horizontal gap1 fw">
    <form action="editcomment.php" method="post" >
      <input type="hidden" name="rating_id" value="<?php echo $comments[$i]["rating_id"];?>">
      <input type="hidden" name="rating_comment" value="<?php echo $comments[$i]["rating_comment"];?>">
      <input type="hidden" name="rating_point" value="<?php echo $comments[$i]["rating_point"];?>">
      <input type="hidden" name="user_name" value="<?php echo $comments[$i]["user_name"];?>">
      <input type="hidden" name="user_id" value="<?php echo $comments[$i]["user_id"];?>">
      <input type="hidden" name="game_id" value="<?php echo $game_id;?>">
      <input type="hidden" name="game_name" value="<?php echo $game_data["game_name"];?>">
      <input class="btn p1 fw fh" type="submit" value="Düzenle">
    </form>
    <form action="deletecomment.php" method="post" >
      <input type="hidden" name="rating_id" value="<?php echo $comments[$i]["rating_id"];?>">
      <input type="hidden" name="rating_comment" value="<?php echo $comments[$i]["rating_comment"];?>">
      <input type="hidden" name="rating_point" value="<?php echo $comments[$i]["rating_point"];?>">
      <input type="hidden" name="user_name" value="<?php echo $comments[$i]["user_name"];?>">
      <input type="hidden" name="user_id" value="<?php echo $comments[$i]["user_id"];?>">
      <input type="hidden" name="game_id" value="<?php echo $game_id;?>">
      <input type="hidden" name="game_name" value="<?php echo $game_data["game_name"];?>">
      <input class="btn p1 red fw fh" type="submit" value="Sil">
    </form>
  </div>
    <?php }; ?>
</div>
<?php };?>
</main>
<?php include_once "site/footer.php"; ?>

