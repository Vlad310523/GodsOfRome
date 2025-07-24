<?php
	session_start();
	unset($_SESSION['user']);
	$lang = $_SESSION['lang'];
	header("Location: $lang/login.php");
?>