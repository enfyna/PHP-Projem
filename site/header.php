<header>
  <a href="index.php"><img src="images/logo-transparent.png" height="100%"></a>
  <space></space>
  <?php if(substr($_SERVER["SCRIPT_NAME"],1) == "index.php"){ //Kullanıcı ana sayfada ise ana sayfa filtresini göster?>
  <form action="index.php" method="post" class="center">
    <select class="fw" name="filter" id="filter" onchange="this.form.submit()">
      <option value="">Filtrele</option>
      <option value="newfirst">Yeni Çıkanlar</option>
      <option value="oldfirst">İlk Çıkanlar</option>
      <option value="newlyadded">Yeni Eklenenler</option>
      <option value="firstadded">İlk Eklenenler</option>
      <option value="alphabetical">Alfabetik</option>
      <option value="Aksiyon">Aksiyon</option>
      <option value="Macera">Macera</option>
      <option value="Strateji">Strateji</option>
      <option value="RPG">RPG</option>
      <option value="Spor">Spor</option>
      <option value="Yarış">Yarış</option>
      <option value="Savaş">Savaş</option>
      <option value="Simulasyon">Simulasyon</option>
    </select>
  </form>
  <?php }else if(substr($_SERVER["SCRIPT_NAME"],1) == "game.php"){ //Kullanıcı oyun sayfasında ise oyun filtresini göster?>
  <form action="game.php?game_id=<?php echo $_GET["game_id"]?>" method="post" class="center">
    <select class="fw" name="filter" id="filter" onchange="this.form.submit()">
      <option value="">Filtrele</option>
      <option value="incpoint">Artan Puan</option>
      <option value="decpoint">Azalan Puan</option>
      <option value="newfirst">Yeni Yorumlar</option>
      <option value="oldfirst">İlk Yorumlar</option>
      <option value="userpoint">Kullanıcı Puanı</option>
    </select>
  </form>
  <?php }else{// Oyun yada ana sayfada değil ise filtre gösterme?>
    <div class="fw"></div>
  <?php };
  if(isset($_SESSION["user_id"]) && substr($_SERVER["SCRIPT_NAME"],1) != "logout.php"){
    if(substr($_SERVER["SCRIPT_NAME"],1) != "addgame.php"){ //Kullanıcıya oyun ekle butonunu göster?>
      <input id="addgame" type="button" class="btn green"onclick="window.location.href='addgame.php';" value="Yeni Oyun Ekle">
      <?php }else{//Oyun ekle sayfasında ana menüye dö butonu göster?>
      <input id="returnmain" type="button" class="btn"onclick="window.location.href='index.php';" value="Geri Dön">
      <?php }; // Kullanıcıya çıkış yap butonunu göster?>
    <input id="logoff" type="button" class="btn"onclick="window.location.href='logout.php';" value="Çıkış Yap">
  <?php }else{ // Kullanıcı giriş yapmamış ise giriş yap ve kayıt ol butonunu göster?>
    <input id="login" type="button" class="btn"onclick="window.location.href='login.php';" value="Üye Girişi">
    <input id="signin" type="button" class="btn green"onclick="window.location.href='signup.php';" value="Yeni Kayıt">
  <?php };?>
</header>
