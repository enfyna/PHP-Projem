<?php
function redirectTo($page,$time) { 
    //echo "redirecting...";
    //header ("Refresh: $time;URL=$page"); 
    echo "<script> location.href='$page'; </script>";
    exit;
};
?>