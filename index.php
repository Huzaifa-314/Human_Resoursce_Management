<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: user_details.php");
}else{
    header("Location: login.php");
}
?>

