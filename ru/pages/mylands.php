<?php
	session_start();
	if (!$_SESSION['user']) {
		header('Location: ../index.php');
	}
	require_once '../../classes/configdb.php';
	$user_id = intval($_SESSION['user']);
	$user = $db->query("SELECT * FROM users WHERE user_id = '$user_id'");
	$row = $user->fetch_assoc();
	if ($row['ban'] == 1) {
		header('Location: ../../inc/logout.php');
	}
	$users_b = $db->query("SELECT * FROM users_b WHERE user_id = '$user_id'");
	$row2 = $users_b->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<title>Gods of Rome</title>
		<link rel="stylesheet" type="text/css" href="../../css/style2.css">
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="../../img/icons/favicon.ico">
	</head>
	
	<body>
		<div class="main">
			<div class="header">
				<div class="panel">
					<div class="panel_nick"><?=$row['username']?></div>
					<a class="panel_exit" href="../../inc/logout.php">ВЫХОД</a>
				</div>
				<div class="silver">
					<div class="silver-img"></div>
					<div class="silver-text"><?=$row2['silver']?></div>
				</div>
				<div class="gold">
					<div class="gold-img"></div>
					<div class="gold-text"><?=$row2['gold']?></div>
				</div>
			</div>
			<div class="island_shop"><div class="comming-soon">В разработке...</div></div>
			<div class="island_pve" onclick="location.href='island.php'"></div>
			<div class="island_pvp" onclick="location.href='battles.php'"></div>
			<div class="footer">
				<div class="menu_section">
					<a class="menu_profile" href="profile.php"></a>
				</div>
				<div class="menu_section">
					<a class="menu_insert" href="deposit.php"></a>
				</div>
				<div class="menu_section">
					<a class="menu_withdraw" href="withdraw.php"></a>
				</div>
				<div class="menu_section">
					<a class="menu_help" href="help.php"></a>
				</div>
			</div>
		</div>
		<script src="../../js/main.js"></script>
	</body>
</html>