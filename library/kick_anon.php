<?php
require_once "library/functions.php";
require_once "library/config.php";
if (!isset($_SESSION['user_id'])) {
  // Giriş yapmayan kişileri giriş yapma sayfasına at
  redirectTo("login.php",0);
};
?>
