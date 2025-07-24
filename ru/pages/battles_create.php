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
	$battle = $db->query("SELECT * FROM temp_battle WHERE user_id = '$user_id'");
	$row3 = $battle->fetch_assoc();
	if ($battle->num_rows > 0) {
		$power1 = $row3['p_god1'];
		$power2 = $row3['p_god2'];
		$power3 = $row3['p_god3'];
		$power4 = $row3['p_god4'];
		$cost = $row3['battle_cost'];
	} else {
		$power1 = random_int(900, 1100);
		$power2 = random_int(900, 1100);
		$power3 = random_int(900, 1100);
		$power4 = random_int(900, 1100);
		$cost = 0;
		$db->Query("INSERT INTO temp_battle (user_id, p_god1, p_god2, p_god3, p_god4, battle_cost) VALUES ('$user_id', '$power1', '$power2', '$power3', '$power4', '$cost')");
	}
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<title>Gods of Rome</title>
		<link rel="stylesheet" type="text/css" href="../../css/style_arena.css">
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="../../img/icons/favicon.ico">
	</head>
	
	<body>
		<div class="main">
			<div class="header">
				<div class="panel">
					<div class="panel_nick"><?=$row['username']?></div>
					<a class="panel_exit" href="mylands.php">HOME</a>
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
			<div class="battles_main">
				<div class="battles_buttons">
					<div class="battles_button2">Создать битву</div>
					<a class="battles_button" href="battles.php">Назад</a>
				</div>
				<div class="battles_block">
					<?if(isset($_SESSION['msgb'])){?><h2 class="msg"><?=$_SESSION['msgb']?></h2><?} unset($_SESSION['msgb']);?>
					<h1 class="battles_h1">
						Выбрать Бога
					</h1>
					<form class="form_create_gods" action="../../inc/battles_create.php" method="POST">
						<div class="battles_create_gods">
							<div class="battles_create_group1">
								<div class="battles_create_god">
									<div class="battles_create_name">Молния</div>
									<input class="battles_create_god1" type="radio" name="god" value="god1" id="god1"><label for="god1"></label>
									<input type="hidden" name="p_god1" value="<?=$power1?>">
									<div class="battles_create_power">
										Сила: <?=$power1?>
									</div>
								</div>
								<div class="battles_create_god">
									<div class="battles_create_name">Огонь</div>
									<input class="battles_create_god2" type="radio" name="god" value="god2" id="god2"><label for="god2"></label>
									<input type="hidden" name="p_god2" value="<?=$power2?>">
									<div class="battles_create_power">
										Сила: <?=$power2?>
									</div>
								</div>
							</div>
							<div class="battles_create_group2">
								<div class="battles_create_god">
									<div class="battles_create_name">Земля</div>
									<input class="battles_create_god3" type="radio" name="god" value="god3" id="god3"><label for="god3"></label>
									<input type="hidden" name="p_god3" value="<?=$power3?>">
									<div class="battles_create_power">
										Сила: <?=$power3?>
									</div>
								</div>
								<div class="battles_create_god">
									<div class="battles_create_name">Вода</div>
									<input class="battles_create_god4" type="radio" name="god" value="god4" id="god4"><label for="god4"></label>
									<input type="hidden" name="p_god4" value="<?=$power4?>">
									<div class="battles_create_power">
										Сила: <?=$power4?>
									</div>
								</div>
							</div>
						</div>
						<div class="battles_create_stats">
							Вода > Огонь > Земля > Молния > Вода <span class="tooltip" data-title="Элементы влияют на силу: Бог против Бога бонус или штраф (10%), как показано на рисунке.">?</span>
						</div>
						<div class="battles_create_button">
							<img class="battles_create_coin" src="../../img/islands/coin_silver.png" alt="$">
							<input class="battles_create_text" type="text" name="sum_create" value="<?=$cost?>">
							<input class="battles_create_button_confirm" type="submit" name="confirm_create" value="Создать">
						</div>
					</form>
				</div>
			</div>
		</div>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
	<script src="../../js/main.js"></script>
	</body>
</html>