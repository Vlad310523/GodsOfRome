<?php
	session_start();
	require_once '../classes/configdb.php';
	$lang = $_SESSION['lang'];
	if (isset($_POST['swap'])) {
		$amount = intval($_POST['amount']);
		if ($_POST['amount'] !== '') {
			if ($amount > 0) {
				$user_id = intval($_SESSION['user']);
				$users_b = $db->query("SELECT * FROM users_b WHERE user_id = '$user_id'");
				$row2 = $users_b->fetch_assoc();
				if ($row2['gold'] >= $amount) {
					$db->query("UPDATE users_b SET silver = silver + '$amount', gold = gold - '$amount' WHERE user_id = '$user_id'");
					$vremya = time();
					$db->Query("INSERT INTO swap_gold (date_swap, user_id, gold, silver) 
						VALUES ('$vremya', '$user_id', '$amount', '$amount')");
					header("Location: $lang/pages/withdraw.php?1=Swap");
				} else {
					$_SESSION['msgb'] = 'You don`t have enough gold';
					header("Location: $lang/pages/withdraw.php?1=Swap");
				}
			} else {
				$_SESSION['msgb'] = 'Amount of gold can\'t be less than 1!';
				header("Location: $lang/pages/withdraw.php?1=Swap");
			}
		} else {
			$_SESSION['msgb'] = 'Amount of gold mustn\'t be empty';
			header("Location: $lang/pages/withdraw.php?1=Swap");
		}
	} else {
		header("Location: $lang/pages/withdraw.php?1=Swap");
	}
?>