<?php
	session_start();
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	require_once '../classes/configdb.php';
	$lang = $_SESSION['lang'];
	$god = $_POST['god'];
	$battle_id = intval($_POST['battle_id']);
	$enemy_id = intval($_SESSION['user']);
	$checks = $db->query("SELECT * FROM active_battle WHERE enemy_id = '$enemy_id' AND battle_id = '$battle_id'");
	$check = $checks->fetch_assoc();
	if ($check['time_start'] >= time()) {
		if (!$god) {
			$_SESSION['msgb'] = 'Choose any god';
			$_SESSION['battle_id'] = $battle_id;
			header("Location: $lang/pages/battles_fight.php");
		} else {
			$battle = $db->query("SELECT * FROM temp_fight WHERE enemy_id = '$enemy_id' AND battle_id = '$battle_id'");
			if ($battle->num_rows > 0) {
				$row = $battle->fetch_assoc();
				if ($_POST['god'] == 'god1') {
					$power = intval($_POST['p_god1']);
					$type = 4;
				} else if ($_POST['god'] == 'god2') {
					$power = intval($_POST['p_god2']);
					$type = 2;
				} else if ($_POST['god'] == 'god3') {
					$power = intval($_POST['p_god3']);
					$type = 3;
				} else if ($_POST['god'] == 'god4') {
					$power = intval($_POST['p_god4']);
					$type = 1;
				} else {
					$_SESSION['msgb'] = 'Error';
					header("Location: $lang/pages/battles.php");
				}
				$battles = $db->query("SELECT * FROM active_battle WHERE enemy_id = '$enemy_id' AND battle_id = '$battle_id'");
				$row2 = $battles->fetch_assoc();
				$user_id = $row2['user_id'];
				$cost = $row2['battle_cost'];
				$type_user = $row2['god_type'];
				if (($row2['god_type'] == 1 && $type == 2) || ($row2['god_type'] == 2 && $type == 3) || ($row2['god_type'] == 3 && $type == 4) || ($row2['god_type'] == 4 && $type == 1)) {
					$power_user = $row2['god_power'] * 1.1;
					$power_enemy = $power;
				} else if (($type == 1 && $row2['god_type'] == 2) || ($type == 2 && $row2['god_type'] == 3) || ($type == 3 && $row2['god_type'] == 4) || ($type == 4 && $row2['god_type'] == 1)) {
					$power_user = $row2['god_power'];
					$power_enemy = $power * 1.1;
				} else {
					$power_user = $row2['god_power'];
					$power_enemy = $power;
				}
				$gold = intval($cost * 1.7);
				if ($power_user > $power_enemy) {
					$winner_id = $user_id;
					$db->query("UPDATE users_b SET gold = gold + '$gold' WHERE user_id = '$user_id'");
				} else if ($power_user < $power_enemy) {
					$winner_id = $enemy_id;
					$db->query("UPDATE users_b SET gold = gold + '$gold' WHERE user_id = '$enemy_id'");
				} else {
					$winner_id = 0;
					$db->query("UPDATE users_b SET silver = silver + '$cost' WHERE user_id = '$user_id'");
					$db->query("UPDATE users_b SET silver = silver + '$cost' WHERE user_id = '$enemy_id'");
				}
				$db->Query("INSERT INTO history_battle (battle_id, user_id, enemy_id, date_battle, battle_cost, user_power, enemy_power, type_user, type_enemy, winner_id)
							VALUES ('$battle_id', '$user_id', '$enemy_id', '".date("Y-m-d")."', '$cost', '$power_user', '$power_enemy', '$type_user', '$type', '$winner_id')");
				$db->Query("DELETE FROM active_battle WHERE battle_id = '$battle_id'");
				$db->Query("DELETE FROM temp_fight WHERE enemy_id = '$enemy_id' AND battle_id = '$battle_id'");
				header("Location: $lang/pages/battles.php");
			} else {
				$_SESSION['msgb'] = 'Error';
				header("Location: $lang/pages/battles.php");
			}
		}
	} else {
		header("Location: $lang/pages/battles.php");
	}
?>