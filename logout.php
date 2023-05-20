<?php include_once "site/head.php"; ?>

<?php include_once "site/header.php"; ?>

<main>
<h1 class="hw"style="background-color: #2A271F;
border-radius:.25rem;
color: white;
padding: 5rem;
text-align:center;
height:50rem;">Çıkış Yapılıyor...</h1>
</main>

<?php include_once "site/footer.php"; ?>

<?php
require_once "library/config.php";
require_once "library/functions.php";

session_destroy();
session_unset();

redirectTo("index.php",3);