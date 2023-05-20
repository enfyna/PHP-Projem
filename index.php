<?php
include_once "site/head.php";
include_once "site/header.php";
?>
<main>
<?php
require_once "library/config.php";
require_once "library/functions.php";

if(isset($_POST["filter"])){
    if($_POST["filter"] == "newfirst"){
        $query = "SELECT game_id,game_name,game_description,game_release_date,game_developer,game_genre,game_image FROM games ORDER BY game_release_date DESC";
    }
    elseif ($_POST["filter"] == "oldfirst") {
        $query = "SELECT game_id,game_name,game_description,game_release_date,game_developer,game_genre,game_image FROM games ORDER BY game_release_date ASC";
    }
    elseif ($_POST["filter"] == "alphabetical") {
        $query = "SELECT game_id,game_name,game_description,game_release_date,game_developer,game_genre,game_image FROM games ORDER BY game_name ASC";
    }
    elseif ($_POST["filter"] == "newlyadded") {
        $query = "SELECT game_id,game_name,game_description,game_release_date,game_developer,game_genre,game_image FROM games ORDER BY game_id DESC";
    }
    elseif ($_POST["filter"] == "firstadded") {
        $query = "SELECT game_id,game_name,game_description,game_release_date,game_developer,game_genre,game_image FROM games ORDER BY game_id ASC";
    }
    else{
        $game_genre = $_POST["filter"];
        $query = "SELECT game_id,game_name,game_description,game_release_date,game_developer,game_genre,game_image FROM games WHERE game_genre='$game_genre' ORDER BY game_release_date DESC";
    }
}else{
    $query = "SELECT game_id,game_name,game_description,game_release_date,game_developer,game_genre,game_image FROM games";
};

$q = mysqli_query($db, $query); // Oyunları al
$row_num = mysqli_num_rows($q);

if($row_num > 0){
  for ($i = 0; $i < $row_num; $i++) {
    $data = mysqli_fetch_assoc($q);

    if (strlen($data['game_description']) > 220) { // Oyun açılaması çok uzunsa kes
        $desc = substr($data['game_description'], 0, 220). " ... ";
    }else{
        $desc = $data['game_description'];
    }?>
    <a class="nounderline" href="game.php?game_id=<?php echo $data['game_id']; ?>">
        <div class="game_container_main"  style="background-image: url('<?php echo $data['game_image']; ?>');">
            <div class="game_details_main">
                <h1><?php echo $data['game_name']; ?></h1>
                <h2><?php echo $data['game_developer']; ?></h2>
                <h2><?php echo $data['game_genre']; ?></h2>
                <h3><?php echo $data['game_release_date']; ?></h3>
                <p><?php echo $desc; ?></p>
            </div>
        </div>
    </a>
    <?php
  };
}else{ // Herhangi bir oyun eklenmemişse kullanıcıya yeni oyun eklemesini söyle
?>
<div class="card vertical hw hh"> 
  <h2>Herhangi bir oyun eklenmemiş.<br><hr><br>Yeni bir oyun eklemeye ne dersin?</h2>
  <?php if(!$_SESSION){?>
      <input id="login"type="button"class="btn p1"onclick="window.location.href='login.php';"value="Üye Girişi">
      <input id="signin"type="button"class="btn green p1"onclick="window.location.href='signup.php';"value="Yeni Kayıt">
  <?php }else{?>
      <input id="addgame"type="button"class="btn green p1"onclick="window.location.href='addgame.php';"value="Yeni Oyun Ekle">
  <?php }?>
</div>
<?php };?>
</main>
<?php include_once "site/footer.php";?>