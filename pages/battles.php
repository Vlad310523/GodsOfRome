<?php
	session_start();
	if (!$_SESSION['user']) {
		header('Location: ../index.php');
	}
	require_once '../classes/configdb.php';
	$user_id = intval($_SESSION['user']);
	$user = $db->query("SELECT * FROM users WHERE user_id = '$user_id'");
	$row = $user->fetch_assoc();
	if ($row['ban'] == 1) {
		header('Location: /inc/logout.php');
	}
	$users_b = $db->query("SELECT * FROM users_b WHERE user_id = '$user_id'");
	$row2 = $users_b->fetch_assoc();
	$tutors = $db->query("SELECT * FROM tutor WHERE user_id = '$user_id' AND tutor_id = 2");
	$tutor = $tutors->fetch_assoc();
	$history_check = $db->query("SELECT * FROM history_battle WHERE ((user_id = '$user_id' AND check_user = 0) OR (enemy_id = '$user_id' AND check_enemy = 0)) AND winner_id = '$user_id'");
	$history = $history_check->fetch_assoc();
	if ($history_check->num_rows <= 0) {
		$history_l_check = $db->query("SELECT * FROM history_battle WHERE ((user_id = '$user_id' AND check_user = 0) OR (enemy_id = '$user_id' AND check_enemy = 0)) AND winner_id != '$user_id'");
		$history2 = $history_l_check->fetch_assoc();
	}
	if(isset($_POST['window'])){
		$battle_id = $_POST['battle_id'];
	}
	if(isset($_POST['checkBattle'])) {
		$battle_id = intval($_POST['battle_id']);
		$history2_check = $db->query("SELECT * FROM history_battle WHERE battle_id = '$battle_id' AND (user_id = '$user_id' OR enemy_id = '$user_id') AND (check_user = 0 OR check_enemy = 0)");
		$history3 = $history2_check->fetch_assoc();
		if ($history3['user_id'] == $user_id) {
			$db->query("UPDATE history_battle SET check_user = 1 WHERE user_id = '$user_id' AND battle_id = '$battle_id'");
			header('Location: ../pages/battles.php');
		} else if ($history3['enemy_id'] == $user_id) {
			$db->query("UPDATE history_battle SET check_enemy = 1 WHERE enemy_id = '$user_id' AND battle_id = '$battle_id'");
			header('Location: ../pages/battles.php');
		}	
	}
	$checks = $db->query("SELECT * FROM active_battle WHERE (user_id = '$user_id' OR enemy_id = '$user_id') AND status = 1 AND time_start != 0");
	if ($checks->num_rows > 0) {
		$check = $checks->fetch_assoc();
		if ($check['time_start'] < time()) {
			$money = $check['battle_cost'] * 1.7;
			$user_id1 = $check['user_id'];
			$battle_id1 = $check['battle_id'];
			$enemy_id1 = $check['enemy_id'];
			$battle_cost1 = $check['battle_cost'];
			$god_power1 = $check['god_power'];
			$god_type1 = $check['god_type'];
			$db->query("UPDATE users_b SET gold = gold + '$money' WHERE user_id = '$user_id1'");
			$db->Query("INSERT INTO history_battle (battle_id, user_id, enemy_id, date_battle, battle_cost, user_power, enemy_power, type_user, type_enemy, winner_id)
						VALUES ('$battle_id1', '$user_id1', '$enemy_id1', '".date("Y-m-d")."', '$battle_cost1', '$god_power1', 0, '$god_type1', 0, '$user_id1')");
			$db->Query("DELETE FROM active_battle WHERE battle_id = '$battle_id1'");
			$db->Query("DELETE FROM temp_fight WHERE enemy_id = '$enemy_id1' AND battle_id = '$battle_id1'");
			header('Location: ../pages/battles.php');
		}
	}
	if (isset($_POST['tutor_ok'])) {
		$db->query("UPDATE tutor SET status = 1 WHERE user_id = '$user_id' AND tutor_id = 2");
		header('Location: ../pages/battles.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Gods of Rome</title>
		<link rel="stylesheet" type="text/css" href="../css/style_arena.css">
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="../img/icons/favicon.ico">
	</head>
	
	<body>
		<div class="main">
			<div class="header">
				<div class="panel">
					<div class="panel_nick"><?=$row['username']?></div>
					<a class="panel_exit" href="/pages/mylands.php">HOME</a>
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
			<?if ($tutors->num_rows > 0) { if ($tutor['status'] == 0) {?>
			<dialog class="dialog_tutor">
				<div class="tutor_body">
					<div class="tutor_block">
						<div class="block_picture"><img class="block_img" src="/img/battle/upiter.png" alt="god"></div>
						<div class="block_text">Welcome to the arena, brave warrior. Here, you can fight with other players in a battle using gods. When creating a battle or joining an existing battle, you are given a choice of these four gods of different elements, namely Lightning ⇾ Fire ⇾ Earth ⇾ Water ⇾ Lightning, which randomly generate their power.</div>
					</div>
					<div class="tutor_block">
						<div class="block_text">The arrows also show the advantage of one element over another, which gives +10% to the god's power. After you and your opponent choose a god, the winner is automatically determined by who has more power with the advantage of the elements. During battles, you bet silver, and in case of victory, you get gold for your bet and your opponent minus 15%.</div>
						<div class="block_picture"><img class="block_img" src="/img/battle/neptun.png" alt="god"></div>
					</div>
					<div class="tutor_block">
						<form action="/pages/battles.php" method="POST">
							<input class="tutor_button" type="submit" name="tutor_ok" value="OK">
						</form>
					</div>
				</div>
			</dialog>
			<? } } ?>
			<?if(isset($_POST['window'])){ $battle_id = $_POST['battle_id']; $battle_cost = $_POST['battle_cost'];?>
				<dialog class="dialog">
					<h2 class="dialog_h2">Join Battle?</h2>
					<h3 class="dialog_h3">Battle cost: <?=$battle_cost?> silver</h3>
					<form class="dialog_form" action="/pages/battles_fight.php" method="POST">
						<input type="hidden" name="battle_id" value="<?=$battle_id?>">
						<input class="dialog_yes" type="submit" name="fight" value="Yes">
						<input class="dialog_no" type="submit" name="dia_no" value="No" id="closewindow">
					</form>
				</dialog>
			<? } ?>
			<?if ($history_check->num_rows > 0) {?>
				<dialog class="dialog">
					<h2 class="dialog_h2">You Win!</h2>
					<h3 class="dialog_h3">You get: <?=intval($history['battle_cost']*1.7)?> gold</h3>
					<form class="dialog_form" action="/pages/battles.php" method="POST">
						<input type="hidden" name="battle_id" value="<?=$history['battle_id']?>">
						<input class="dialog_yes" type="submit" name="checkBattle" value="OK">
					</form>
				</dialog>
			<?} else if ($history_l_check->num_rows > 0 && $history2['enemy_power'] != 0) {?>
				<dialog class="dialog">
					<h2 class="dialog_h2">You Lose!</h2>
					<h3 class="dialog_h3">You lost: <?=$history2['battle_cost']?> silver</h3>
					<form class="dialog_form" action="/pages/battles.php" method="POST">
						<input type="hidden" name="battle_id" value="<?=$history2['battle_id']?>">
						<input class="dialog_yes" type="submit" name="checkBattle" value="OK">
					</form>
				</dialog>
			<? } else if ($history_l_check->num_rows > 0 && $history2['enemy_power'] == 0) { ?>
				<dialog class="dialog">
					<h2 class="dialog_h2">Auto Lose!</h2>
					<h3 class="dialog_h3">You lost: <?=$history2['battle_cost']?> silver</h3>
					<form class="dialog_form" action="/pages/battles.php" method="POST">
						<input type="hidden" name="battle_id" value="<?=$history2['battle_id']?>">
						<input class="dialog_yes" type="submit" name="checkBattle" value="OK">
					</form>
				</dialog>
			<? } ?>
			<div class="battles_main">
				<div class="battles_buttons">
					<a class="battles_button" href="/pages/battles_history.php">History</a>
					<a class="battles_button" href="/pages/battles_create.php">Create Battle</a>
					<a class="battles_button" href="/pages/mylands.php">Back</a>
				</div>
				<div class="battles_block">
					<?if(isset($_SESSION['msgb'])){?><h2 class="msg"><?=$_SESSION['msgb']?></h2><?} unset($_SESSION['msgb']);?>
					<div class="table_header">
						Your battels
					</div>
					<div class="table_battles">
							<div class="tr_battles">
								<span class="td_battles">Date create</span>
								<span class="td_battles">Battle cost</span>
								<span class="td_battles">Status</span>
								<span class="td_battles">God</span>
							</div>
					<?
						$battle_a = $db->query("SELECT * FROM active_battle WHERE user_id = '$user_id' AND (status = 0 OR status = 1) ORDER BY date_create DESC");
						if ($battle_a->num_rows > 0) {
					?>
							<?
								for ($i = $battle_a->num_rows; $i > 0; $i--) {
									$row4 = $battle_a->fetch_assoc();
									if ($row4['god_type'] == 4) {
										$type = 'Lightning';
									} else if ($row4['god_type'] == 2) {
										$type = 'Fire';
									} else if ($row4['god_type'] == 3) {
										$type = 'Earth';
									} else if ($row4['god_type'] == 1) {
										$type = 'Water';
									}
							?>
							<div class="tr_battles">
								<span class="td_battles"><?=$row4['date_create']?></span>
								<span class="td_battles"><?=$row4['battle_cost']?> silver</span>
								<span class="td_battles"><?if ($row4['status'] == 0) { echo 'Waiting for oponent'; } else { echo 'In progress'; } ?></span>
								<span class="td_battles"><?=$type . " - " . $row4['god_power'];?> power</span>
							</div>
							<? } ?>
					<? } else { ?>
						<div class="battles_none">
							You don`t have active battles
						</div>
					<? } ?>
					</div>
					<div class="table_header">
						Available battels
					</div>
					<form class="battles_block_menu" action="" method="POST">
						<label class="label_sort" for="">Sort:</label>
						<select onchange="location=value">
							<option value="/pages/battles.php">Sort</option>
							<option <? if($_GET['sort'] == "100-1000") echo 'selected'?> value="?sort=100-1000">100 - 1000 silver</option>
							<option <? if($_GET['sort'] == "1000-5000") echo 'selected'?> value="?sort=1000-5000">1000 - 5000 silver</option>
							<option <? if($_GET['sort'] == "5000-10000") echo 'selected'?> value="?sort=5000-10000">5000 - 10000 silver</option>
							<option <? if($_GET['sort'] == "10000-50000") echo 'selected'?> value="?sort=10000-50000">10000 - 50000 silver</option>
							<option <? if($_GET['sort'] == "50000>") echo 'selected'?> value="?sort=50000>">50000 and more silver</option>
						</select>
					</form>
					<div class="table_battles">
						<div class="tr_battles">
							<span class="td_battles">Username</span>
							<span class="td_battles">Date create</span>
							<span class="td_battles">Battle cost</span>
							<span class="td_battles">Fight</span>
						</div>
						<?
							if (isset($_GET['sort'])) {
								$sort = $_GET['sort'];
								if ($sort == '100-1000') {
									$battles = $db->query("SELECT * FROM active_battle WHERE user_id != '$user_id' AND enemy_id != '$user_id' AND status = 0 AND battle_cost >= 100 AND battle_cost <= 1000");
								} else if ($sort == '1000-5000') {
									$battles = $db->query("SELECT * FROM active_battle WHERE user_id != '$user_id' AND enemy_id != '$user_id' AND status = 0 AND battle_cost >= 1000 AND battle_cost <= 5000");
								} else if ($sort == '5000-10000') {
									$battles = $db->query("SELECT * FROM active_battle WHERE user_id != '$user_id' AND enemy_id != '$user_id' AND status = 0 AND battle_cost >= 5000 AND battle_cost <= 10000");
								} else if ($sort == '10000-50000') {
									$battles = $db->query("SELECT * FROM active_battle WHERE user_id != '$user_id' AND enemy_id != '$user_id' AND status = 0 AND battle_cost >= 10000 AND battle_cost <= 50000");
								} else {
									$battles = $db->query("SELECT * FROM active_battle WHERE user_id != '$user_id' AND enemy_id != '$user_id' AND status = 0 AND battle_cost >= 50000");
								}
							} else {
								$battles = $db->query("SELECT * FROM active_battle WHERE user_id != '$user_id' AND enemy_id != '$user_id' AND status = 0 ORDER BY date_create DESC");
							}
							if ($battles->num_rows > 0) {
							for ($i = $battles->num_rows; $i > 0; $i--) {
								$row5 = $battles->fetch_assoc();
								$id = $row5['user_id'];
								$user = $db->query("SELECT username FROM users_b WHERE user_id = '$id'");
								$row6 = $user->fetch_assoc();
						?>
						<div class="tr_battles">
							<span class="td_battles"><?=$row6['username']?></span>
							<span class="td_battles"><?=$row5['date_create']?></span>
							<span class="td_battles"><?=$row5['battle_cost']?> silver</span>
							<span class="td_battles">
								<form action="" method="POST">
									<input type="hidden" name="battle_id" value="<?=$row5['battle_id']?>">
									<input type="hidden" name="battle_cost" value="<?=$row5['battle_cost']?>">
									<input class="td_battles_button openwindow" type="submit" name="window" value="Fight">
								</form>
							</span>
						</div>
						<?} } else {?>
							<div class="battles_none">
								There are currently no available battles
							</div>
						<? } ?>
					</div>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
		<script src="../js/main.js"></script>
	</body>
</html>