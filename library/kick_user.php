<?php
require_once "library/functions.php";
require_once "library/config.php";
if (isset($_SESSION['user_id'])) {
  // Giriş yapan kişileri ana sayfaya at
  redirectTo("index.php",0);
};
?>
