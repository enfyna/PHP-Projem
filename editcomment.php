<?php include_once "site/head.php"; ?>
<?php include_once "site/header.php"; ?>

<main>
    <div>
        <h1>Yorum Düzenle</h1>
    </div>
    <?php 
require_once "library/config.php";
require_once "library/functions.php";
require_once "library/kick_anon.php";

// Kullanıcı yorum düzenlemişse onu ayarla
if(isset($_POST["edit"])){
    if($_POST["edit"] == "true"){
        $rating_point = $_POST["rating_point"];
        $rating_comment = $_POST["rating_comment"];
        $rating_id = $_POST["rating_id"];
        mysqli_query($db,"UPDATE ratings 
            SET rating_point = '$rating_point', rating_comment = '$rating_comment'
            WHERE rating_id = '$rating_id'");
        };
    redirectTo("game.php?game_id=".$_POST["game_id"],0);
    exit;
}
else if(!isset($_POST["rating_id"]))exit;//redirectTo("index.php",0);

//print_r($_POST);
$editing_own_comment = true;
if($_POST["user_id"] == $_SESSION["user_id"]){ // Kullanıcı kendi yorumunu düzenleyecekse
// Yorum ve puanı değiştirebilir

}elseif ($_POST["user_id"] != $_SESSION["user_id"] && $_SESSION["user_is_mod"] == 1) { // Moderator baska bir kullanıcının yorumunu duzenleyecekse
// Sadece yorumu değiştirebilir
$editing_own_comment = false;

}else{ // Hatalı giriş var
    redirectTo("index.php",0);
};
?>
<div>
    <form class="form vertical" id="editcomment" action="editcomment.php" method="post">
        <input type="hidden" name="rating_id" value="<?php echo $_POST["rating_id"] ?>">
        <input type="hidden" name="game_id" value="<?php echo $_POST["game_id"] ?>">
        <?php if($editing_own_comment){?>
        <label for="rating_point">Puan</label>
            <input value="<?php echo $_POST["rating_point"] ?>" class="fh hw" type="number" id="rating" name="rating_point"min="0"max="10"step="0.5" placeholder="0-10 Aralığında Puan Ver" required>
        <?php }else{?>
            <input type="hidden" name="rating_point" value="<?php echo $_POST["rating_point"] ?>">
        <?php };
        if ($editing_own_comment || $_SESSION["user_is_mod"] == 1){?>
        <label for="rating_comment">Yorum</label>
            <textarea id="rating_comment" name="rating_comment" required><?php echo $_POST["rating_comment"];?></textarea>
            <?php if(!$editing_own_comment){?>
                <b>'<?php echo $_POST["user_name"]?>' kullanıcısının yorumunu düzenlemek üzeresin emin misin ?</b>
            <?php };?>
        <?php }else{?>
            <input type="hidden" name="rating_comment" value="rating_comment">
        <?php };?>
        <div class="horizontal">
            <button class="btn red p1 wt" type="submit" name="edit"value="false">Vazgeç</button>
            <button class="btn green p1 wt" type="submit"name="edit"value="true">Kaydet</button>
        </div>
    </form>
</div>
</main>
<?php include_once "site/footer.php"; ?>
