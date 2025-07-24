<?php
	session_start();
	require_once '../classes/configdb.php';
	$lang = $_SESSION['lang'];
	if (isset($_POST['withdraw'])) {
		$amount = intval($_POST['amount']);
		if ($_POST['amount'] !== '') {
			if ($amount > 999) {
				$user_id = intval($_SESSION['user']);
				$users_b = $db->query("SELECT * FROM users_b WHERE user_id = '$user_id'");
				$row2 = $users_b->fetch_assoc();
				$users = $db->query("SELECT * FROM users WHERE user_id = '$user_id'");
				$row1 = $users->fetch_assoc();
				$users_dep = $db->query("SELECT SUM(gold) AS sum_gold FROM users_deposit WHERE user_id = '$user_id' AND status = 1");
				$rowdep = $users_dep->fetch_assoc();
				if (isset($row1['payeer_wallet'])) {
					if ($rowdep['sum_gold'] > 4999) {
						if ($row2['gold'] >= $amount) {
							$db->query("UPDATE users_b SET gold = gold - '$amount' WHERE user_id = '$user_id'");
							$vremya = time();
							$wallet = $row1['payeer_wallet'];
							$db->Query("INSERT INTO users_withdraw (date_withdraw, user_id, gold, payeer_wallet, status) 
								VALUES ('$vremya', '$user_id', '$amount', '$wallet', 0)");
							header("Location: $lang/pages/withdraw.php?1=Withdraw");
						} else {
							$_SESSION['msgb'] = 'You don`t have enough gold';
							header("Location: $lang/pages/withdraw.php?1=Withdraw");
						}
					} else {
						$_SESSION['msgb'] = 'You need to deposit at least 5 dollars to start withdraw!';
						header("Location: $lang/pages/withdraw.php?1=Withdraw");
					}
				} else {
					$_SESSION['msgbb'] = 'Insert your wallet in ';
					header("Location: $lang/pages/withdraw.php?1=Withdraw");
				}
			} else {
				$_SESSION['msgb'] = 'Amount of gold can\'t be less than 1000!';
				header("Location: $lang/pages/withdraw.php?1=Withdraw");
			}
		} else {
			$_SESSION['msgb'] = 'Amount of gold mustn\'t be empty';
			header("Location: $lang/pages/withdraw.php?1=Withdraw");
		}
	} else {
		header("Location: $lang/pages/withdraw.php?1=Withdraw");
	}
?>