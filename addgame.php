<?php include_once "site/head.php";include_once "site/header.php";?>
<main>
<div>
    <h1>Yeni Oyun Ekle</h1>
</div>
<?php
require_once "library/config.php";
require_once "library/functions.php";
require_once "library/kick_anon.php";
if(isset($_POST["addgame"])){
    if($_POST["addgame"] == "true"){
        $game_name = $_POST["game_name"];
        $game_developer = $_POST["game_developer"];
        $game_release_date = $_POST["game_release_date"];
        $game_genre = $_POST["game_genre"];
        $game_image = $_POST["game_image"];
        $user_id = $_SESSION["user_id"];
        $game_description = $_POST["game_description"];
        $del = "'";
        $game_description = str_replace($del,"",$game_description);

        mysqli_query($db, // Oyunu ekle
            "INSERT INTO games(game_name,user_id,game_description,game_release_date,game_developer,game_genre,game_image)
            VALUES('"."$game_name"."','"."$user_id"."','"."$game_description"."','"."$game_release_date"."','"."$game_developer"."','"."$game_genre"."','"."$game_image"."')");

        mysqli_query($db, // Kullanıcı puanını 25 arttır
            "UPDATE users SET user_point = (SELECT users.user_point FROM users WHERE user_id = '$user_id')+25 WHERE user_id = '$user_id'");
    };
    redirectTo("index.php",0);
};
?>
<div>
    <form class="form" id="gameForm" action="addgame.php" method="post">
        <label for="game_name">Oyunun Adı</label>
        <input type="text" id="game_name" name="game_name" placeholder="Oyun Adı" required>

        <label for="game_developer">Oyunun Yapımcısı</label>
        <input type="text" id="game_developer" name="game_developer" placeholder="Oyun Yapımcısı" required>

        <label for="game_image">Oyunun Kapak Fotoğrafının Linki</label>
        <input type="url" id="game_image" name="game_image" placeholder="site.com/resim.png gibi">

        <label for="game_genre">Ana Kategori</label>
        <select id="game_genre" name="game_genre" required>
            <option value="">Seçiniz</option>
            <option value="Aksiyon">Aksiyon</option>
            <option value="Macera">Macera</option>
            <option value="Strateji">Strateji</option>
            <option value="RPG">RPG</option>
            <option value="Spor">Spor</option>
            <option value="Yarış">Yarış</option>
            <option value="Savaş">Savaş</option>
            <option value="Simulasyon">Simulasyon</option>
        </select>
        <label for="game_release_date">Çıkış Tarihi</label>
        <input type="date" id="game_release_date" name="game_release_date" required>

        <label for="game_description">Açıklama</label>
        <textarea id="game_description" name="game_description" required></textarea>

        <div class="horizontal">
        <button class="btn red p1 wt" onclick="window.location.href='index.php';">Vazgeç</button>
        <button class="btn green p1 wt" type="submit" name="addgame" value="true">Kaydet</button>
        </div>
    </form>
</div>
</main>
<?php include_once "site/footer.php"; ?>
