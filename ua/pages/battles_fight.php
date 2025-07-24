<?php
	session_start();
	if (!$_SESSION['user']) {
		header('Location: ../index.php');
		exit();
	}
	require_once '../../classes/configdb.php';
	$user_id = intval($_SESSION['user']);
	$battle_id = intval($_POST['battle_id']);
	if (isset($_POST['battle_id'])) {
		$battle_id = intval($_POST['battle_id']);
	} else {
		$battle_id = $_SESSION['battle_id'];
	}
	$checks = $db->query("SELECT * FROM active_battle WHERE battle_id = '$battle_id'");
	$checks1 = $checks->fetch_assoc();
	if ($checks->num_rows <= 0) {
		header('Location: battles.php');
		exit();
	}
	$users_dep = $db->query("SELECT SUM(gold) AS sum_gold FROM users_deposit WHERE user_id = '$user_id' AND status = 1");
	$rowdep = $users_dep->fetch_assoc();
	if ($rowdep['sum_gold'] <= 4999) {
		$_SESSION['msgb'] = 'Для участі в битвах потрібно поповнити баланс мінімум на 5 доларів!';
		header('Location: battles.php');
		exit();
	}
	$user = $db->query("SELECT * FROM users WHERE user_id = '$user_id'");
	$row = $user->fetch_assoc();
	if ($row['ban'] == 1) {
		header('Location: ../../inc/logout.php');
		exit();
	}
	if (isset($_POST['dia_no'])) {
		header('Location: battles.php');
		exit();
	}
	if ($checks1['status'] != 0) {
		$_SESSION['msgb'] = 'Вибачте, битва вже почалася!';
		header('Location: battles.php');
		exit();
	}
	$users_b = $db->query("SELECT * FROM users_b WHERE user_id = '$user_id'");
	$row2 = $users_b->fetch_assoc();
	if ($row2['silver'] < $checks1['battle_cost']) {
		$_SESSION['msgb'] = 'У вас недостатньо срібла.';
		header('Location: battles.php');
		exit();
	}
	$fight = $db->query("SELECT * FROM temp_fight WHERE battle_id = '$battle_id' AND enemy_id = '$user_id'");
	$row3 = $fight->fetch_assoc();
	if ($fight->num_rows > 0) {
		$power1 = $row3['p_god1'];
		$power2 = $row3['p_god2'];
		$power3 = $row3['p_god3'];
		$power4 = $row3['p_god4'];
	} else {
		if (isset($_POST['fight'])) {
			$power1 = random_int(900, 1100);
			$power2 = random_int(900, 1100);
			$power3 = random_int(900, 1100);
			$power4 = random_int(900, 1100);
			$time = time() + 600;
			$db->Query("INSERT INTO temp_fight (battle_id, enemy_id, p_god1, p_god2, p_god3, p_god4, date_end) 
				VALUES ('$battle_id', '$user_id', '$power1', '$power2', '$power3', '$power4', '$time')");
			$ticket = $db->query("UPDATE active_battle SET status = 1, enemy_id = '$user_id', time_start = '$time' WHERE battle_id = '$battle_id'");
			$silver = $db->query("SELECT * FROM active_battle WHERE battle_id = '$battle_id' AND enemy_id = '$user_id'");
			$row4 = $silver->fetch_assoc();
			$cost = $row4['battle_cost'];
			$db->query("UPDATE users_b SET silver = silver - '$cost' WHERE user_id = '$user_id'");
			$vremya = time();
			$db->Query("INSERT INTO log_battles (action, user_id, battle_id, sum, date_battle) 
				VALUES (2, '$user_id', '$battle_id', '$cost', '$vremya')");
		} else {
			header('Location: battles.php');
		}
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
			<div class="battles_main">
				<div class="battles_buttons">
					<div class="battles_button3">Створити Битву</div>
				</div>
				<div class="battles_block">
					<?if(isset($_SESSION['msgb'])){?><h2 class="msg"><?=$_SESSION['msgb']?></h2><?} unset($_SESSION['msgb']);?>
					<h1 class="battles_h1">
						Вибрати Бога
					</h1>
					<form class="form_create_gods" action="../../inc/battles_fight.php" method="POST">
						<div class="battles_create_gods">
							<div class="battles_create_group1">
								<div class="battles_create_god">
									<div class="battles_create_name">Блискавка</div>
									<input class="battles_create_god1" type="radio" name="god" value="god1" id="god1"><label for="god1"></label>
									<input type="hidden" name="p_god1" value="<?=$power1?>">
									<div class="battles_create_power">
										Сила: <?=$power1?>
									</div>
								</div>
								<div class="battles_create_god">
									<div class="battles_create_name">Вогонь</div>
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
							Вода > Вогонь > Земля > Блискавка > Вода
						</div>
						<div class="battles_create_button">
							<input type="hidden" name="battle_id" value="<?=$battle_id?>">
							<input class="battles_create_button_confirm" type="submit" name="confirm_create" value="Створити">
						</div>
					</form>
				</div>
			</div>
		</div>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
	<script src="../../js/main.js"></script>
	</body>
</html>