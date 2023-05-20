<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1); // Hata Mesajlarını Yazdır

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "db1";
$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_errno()){
    echo "Bağlantı kurulamadı!";
    exit;
};
mysqli_set_charset($db,"utf8mb4");
session_start();
