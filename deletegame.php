<?php include_once "site/head.php"; ?>
<?php include_once "site/header.php"; ?>

<main>
    <div>
        <h1>Oyunu Sil</h1>
    </div>
    <?php 
require_once "library/config.php";
require_once "library/functions.php";
require_once "library/kick_anon.php";

// Kullanıcı oyunu silmişse onu ayarla
if(isset($_POST["delete"]) && $_POST["delete"] == "true"){
    $game_id = $_POST["game_id"];

    mysqli_query($db,
        "DELETE games,ratings FROM games LEFT JOIN ratings ON games.game_id = ratings.game_id WHERE games.game_id = '$game_id' ");
    redirectTo("index.php",0);
    exit;
}
else if(!isset($_POST["game_id"]))exit;//redirectTo("index.php",0);

$game_id = $_POST["game_id"];
$q = mysqli_query($db, // Oyun bilgilerini ve oyunu ekleyen kullanıcının bilgilerini al 
    "SELECT games.* FROM games WHERE games.game_id = '$game_id'");
$row_num = mysqli_num_rows($q);
if($row_num == 0) exit;//redirectTo("index.php",0); // Oyun IDsi bulunamazsa ana menuye geri dön

$game_data = mysqli_fetch_assoc($q); // Oyun bilgilerini al

$game_name = $game_data["game_name"];
$game_developer = $game_data["game_developer"];
$game_release_date = $game_data["game_release_date"];
$game_genre = $game_data["game_genre"];
$game_description = $game_data["game_description"];
$game_image = $game_data["game_image"];

?>
    <div>
        <form class="form" id="gameForm" action="deletegame.php" method="post">
            <h1><?php echo $game_name ?></h1>
            <br><br>
            <h2>Bu oyunu silmek istediğine emin misin?</h2>
            <br><br><br><br>
            <div class="fw center">
                <button class="btn green p1 wt" onclick="window.location.href='index.php';">Vazgeç</button>
                <button class="btn red p1 wt" type="submit">Sil</button>
            </div>
            <br><br><br><br>
            <h3>Bu oyuna <?php echo $_POST["comment_num"];?> yorum yapılmış. Hepsi kaybolacak .</h3>
            <br><br><br><br>
            <h3>Sonsuza kadar.😱</h3>
            <input type="hidden" name="delete" value="true">
            <input type="hidden" name="game_id" value="<?php echo $game_id ?>">
        </form>
    </div>
</main>
<?php include_once "site/footer.php"; ?>
