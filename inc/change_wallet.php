<?php
	session_start();
	require_once '../classes/configdb.php';
	$lang = $_SESSION['lang'];
	if (isset($_POST['change_wallet'])) {
		$wallet = strip_tags($_POST['wallet']);
		$wallet = htmlspecialchars($wallet);
		if ($_POST['wallet'] !== '') {
			$user_id = intval($_SESSION['user']);
			$db->query("UPDATE users SET payeer_wallet = '$wallet' WHERE user_id = '$user_id'");
			header("Location: $lang/pages/profile.php?1=Withdraw");
		} else {
			$_SESSION['msgb'] = 'Name wallet mustn\'t be empty';
			header("Location: $lang/pages/profile.php?1=Withdraw");
		}
	} else {
		header("Location: $lang/pages/profile.php?1=Withdraw");
	}
?>