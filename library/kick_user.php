<?php
require_once "library/functions.php";
require_once "library/config.php";
//echo json_encode($_SESSION);
if (isset($_SESSION['user_id'])) {
  redirectTo("index.php",0);
};
?>