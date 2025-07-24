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
					<div class="battles_button2">История</div>
					<a class="battles_button" href="battles.php">Назад</a>
				</div>
				<div class="battles_block">
					<div class="table_battles battles_history">
						<div class="tr_battles">
							<span class="td_battles">Id битвы</span>
							<span class="td_battles">Дата создания</span>
							<span class="td_battles">Стоимость</span>
							<span class="td_battles">Ваша сила</span>
							<span class="td_battles">Сила противника</span>
							<span class="td_battles">Результат</span>
						</div>
						<?
							$history = $db->query("SELECT * FROM history_battle WHERE user_id = '$user_id' OR enemy_id = '$user_id' ORDER BY battle_id DESC");
							if ($history->num_rows > 0) {
								for ($i = $history->num_rows; $i > 0; $i--) {
									$row3 = $history->fetch_assoc();
									if ($row3['user_id'] == $user_id) {
										$power1 = $row3['user_power'];
										$power2 = $row3['enemy_power'];
									} else {
										$power2 = $row3['user_power'];
										$power1 = $row3['enemy_power'];
									}
						?>
						<div class="tr_battles">
							<span class="td_battles">#<?=$row3['battle_id']?></span>
							<span class="td_battles"><?=$row3['date_battle']?></span>
							<span class="td_battles"><?=$row3['battle_cost']?></span>
							<span class="td_battles"><?=$power1?></span>
							<span class="td_battles"><?=$power2?></span>
							<span class="td_battles<? if ($row3['winner_id'] == $user_id) { echo ' battles_td_win'; } else { echo ' battles_td_lose'; }?>"><? if ($row3['winner_id'] == $user_id) { echo 'Победа'; } else if ($row3['enemy_power'] == 0) { echo 'Авто проигрыш'; } else { echo 'Проигрыш'; }?></span>
						</div>
						<? } } else { ?>
						<div class="battles_none">
							У вас нет активных битв
						</div>
						<? } ?>
					</div>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
		<script src="../../js/main.js"></script>
	</body>
</html>