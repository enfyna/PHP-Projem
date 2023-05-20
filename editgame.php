<?php include_once "site/head.php"; ?>
<?php include_once "site/header.php"; ?>

<main>
    <div>
        <h1>Oyunu Düzenle</h1>
    </div>
    <?php 
require_once "library/config.php";
require_once "library/functions.php";
require_once "library/kick_anon.php";

// Kullanıcı oyunu düzenlemişse onu ayarla
if(isset($_POST["edit"]) && $_POST["edit"] == "true"){
    $game_id = $_POST["game_id"];
    $game_name = $_POST["game_name"];
    $game_developer = $_POST["game_developer"];
    $game_release_date = $_POST["game_release_date"];
    $game_genre = $_POST["game_genre"];
    $game_description = $_POST["game_description"];
    $game_image = $_POST["game_image"];

    mysqli_query($db,
        "UPDATE games 
        SET game_name = '$game_name', 
            game_developer = '$game_developer', 
            game_release_date = '$game_release_date',
            game_genre = '$game_genre',
            game_description = '$game_description',
            game_image = '$game_image' WHERE game_id = '$game_id'");
    redirectTo("game.php?game_id=".$game_id,0);
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
        <form class="form" id="gameForm" action="editgame.php" method="post">
            <label for="game_name">Oyunun Adı</label>
            <input type="text" id="game_name" name="game_name" 
            placeholder="Oyun Adı" required value="<?php echo $game_name;?>">

            <label for="game_developer">Oyunun Yapımcısı</label>
            <input type="text" id="game_developer" name="game_developer" 
            placeholder="Oyun Yapımcısı" required value="<?php echo $game_developer;?>">

            <label for="game_image">Oyunun Kapak Fotoğrafının Linki</label>
            <input type="url" id="game_image" name="game_image" 
            placeholder="site.com/resim.png gibi" value="<?php echo $game_image;?>">

            <label for="game_genre">Ana Kategori</label>
            <select id="game_genre" name="game_genre" required>
                <option <?php echo$game_genre=="Macera"?"selected ":"" ?>value="Macera">Macera</option>
                <option <?php echo$game_genre=="Strateji"?"selected ":"" ?>value="Strateji">Strateji</option>
                <option <?php echo$game_genre=="RPG"?"selected ":"" ?>value="RPG">RPG</option>
                <option <?php echo$game_genre=="Aksiyon"?"selected ":"" ?>value="Aksiyon">Aksiyon</option>
                <option <?php echo$game_genre=="Spor"?"selected ":"" ?>value="Spor">Spor</option>
                <option <?php echo$game_genre=="Yarış"?"selected ":"" ?>value="Yarış">Yarış</option>
                <option <?php echo$game_genre=="Savaş"?"selected ":"" ?>value="Savaş">Savaş</option>
                <option <?php echo$game_genre=="Simulasyon"?"selected ":"" ?>value="Simulasyon">Simulasyon</option>
            </select>
            <label for="game_release_date">Çıkış Tarihi</label>
            <input type="date" id="game_release_date" name="game_release_date" required
            value="<?php echo $game_release_date;?>">

            <label for="game_description">Açıklama</label>
            <textarea id="game_description" name="game_description" required><?php echo $game_description;?>
            </textarea>
            <input type="hidden" name="edit" value="true">
            <input type="hidden" name="game_id" value="<?php echo $game_id ?>">
            <div class="horizontal">
                <button class="btn red p1 wt" onclick="window.location.href='index.php';">Vazgeç</button>
                <button class="btn green p1 wt" type="submit">Kaydet</button>
            </div>
        </form>
    </div>
</main>
<?php include_once "site/footer.php"; ?>
