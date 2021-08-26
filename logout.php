<?php
session_start();
//  End the session and log the user out
unset($_SESSION['username']);
header("location:login.php");

?>