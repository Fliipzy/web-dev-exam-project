<?php
session_start();

if (!isset($_SESSION["email"])) 
{
    header("Location: views/login.php", true, 302);
}
else
{
    header("Location: views/home.php", true, 302);
}
?>
