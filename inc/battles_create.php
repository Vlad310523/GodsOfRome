<?php
	session_start();
	require_once '../classes/configdb.php';
	$lang = $_SESSION['lang'];
	if ($_POST['sum_create'] !== '') {
		$cost = intval($_POST['sum_create']);
		$user_id = intval($_SESSION['user']);
		$users_b = $db->query("SELECT * FROM users_b WHERE user_id = '$user_id'");
		$row2 = $users_b->fetch_assoc();
		$users_dep = $db->query("SELECT SUM(gold) AS sum_gold FROM users_deposit WHERE user_id = '$user_id' AND status = 1");
		$rowdep = $users_dep->fetch_assoc();
		if ($row2['silver'] >= $cost) {
			if ($cost > 99) {
				if ($rowdep['sum_gold'] > 4999) {
					$god = $_POST['god'];
					if (!$god) {
						$_SESSION['msgb'] = 'Choose any god';
						header("Location: $lang/pages/battles_create.php");
					} else {
						$battle = $db->query("SELECT * FROM temp_battle WHERE user_id = '$user_id'");
						if ($battle->num_rows > 0) {
							$row = $battle->fetch_assoc();
							$battle_id = $row['battle_id'];
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
								$_SESSION['msgb'] = 'Error when creating battle';
								header("Location: $lang/pages/battles_create.php");
							}
							$db->Query("INSERT INTO active_battle (battle_id, user_id, enemy_id, date_create, battle_cost, status, god_power, god_type)
								VALUES ('$battle_id', '$user_id', '0', '".date("Y-m-d")."', '$cost', '0', '$power', '$type')");
							$vremya = time();
							$db->Query("INSERT INTO log_battles (action, user_id, battle_id, sum, date_battle) 
								VALUES (1, '$user_id', '$battle_id', '$cost', '$vremya')");
							$db->query("UPDATE users_b SET silver = silver - '$cost' WHERE user_id = '$user_id'");
							$db->Query("DELETE FROM temp_battle WHERE user_id = '$user_id'");
							header("Location: $lang/pages/battles.php");
						} else {
							$_SESSION['msgb'] = 'Error when creating battle';
							header("Location: $lang/pages/battles_create.php");
						}
					}
				} else {
					$_SESSION['msgb'] = 'You need to deposit at least 5 dollars to create battle!';
					header("Location: $lang/pages/battles_create.php");
				}
			} else {
				$_SESSION['msgb'] = 'Battle cost must be more > 100 silver';
				header("Location: $lang/pages/battles_create.php");
			}
		} else {
			$_SESSION['msgb'] = 'You don`t have enough silver';
			header("Location: $lang/pages/battles_create.php");
		}
	} else {
		$_SESSION['msgb'] = 'Battle cost mustn\'t be empty';
		header("Location: $lang/pages/battles_create.php");
	}
?>