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
	if(isset($_POST['deposit'])){
		$amount = floatval($_POST['deposit_amount']);
		if ($_POST['amount'] !== '') {
			if ($amount > 0.99) {
				$vremya = time();
				$val = $amount * 1000;
				$db->Query("INSERT INTO users_deposit (user_id, date_deposit, gold, status) 
					VALUES ('$user_id', '$vremya', '$val', 0)");
				// Start
				$deposit = $db->query("SELECT * FROM users_deposit ORDER BY deposit_id DESC");
				if ($deposit->num_rows > 0) {
					$rowDep = $deposit->fetch_assoc();
					$id = $rowDep['deposit_id'];
				} else {
					$id = 1;
				}
				$m_shop = '2194230410'; // id мерчанта
				$m_orderid = $id; // номер счета в системе учета мерчанта
				$m_amount = number_format($amount, 2, '.', ''); // сумма счета с двумя знаками после точки
				$m_curr = 'USD';
				$m_desc = base64_encode("GodsOfRome #$id");
				$m_key = 'A8c6#976e5b541!0415bde$';
				$arHash = array(
					$m_shop,
					$m_orderid,
					$m_amount,
					$m_curr,
					$m_desc
				);
				$arHash[] = $m_key;
				$sign = strtoupper(hash('sha256', implode(':', $arHash)));
				$arGetParams = array(
					'm_shop' => $m_shop,
					'm_orderid' => $m_orderid,
					'm_amount' => $m_amount,
					'm_curr' => $m_curr,
					'm_desc' => $m_desc,
					'm_sign' => $sign,
				);
				$url = 'https://payeer.com/merchant/?'.http_build_query($arGetParams);
				header('Location: https://payeer.com/merchant/?'.http_build_query($arGetParams));
			} else {
				$_SESSION['msgb'] = 'Кількість $ не може бути меншою ніж 1.00!';
			}
		} else {
			$_SESSION['msgb'] = 'Кількість $ не повинна бути порожньою!';
		}
	}
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<title>Gods of Rome</title>
		<link rel="stylesheet" type="text/css" href="../../css/style4.css">
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
			<div class="help_main">
				<div class="help_buttons">
					<div class="help_button3">Депозит</div>
					<a class="help_button" href="mylands.php">Назад</a>
				</div>
				<div class="help_block">
					<div class="block1">
						<div class="swap_block">
							<?if(isset($_SESSION['msgb'])){?><h2 class="msg"><?=$_SESSION['msgb']?></h2><?} unset($_SESSION['msgb']);?>
							<h1 class="h1_block">Депозит срібла</h1>
							<h2 class="h2_block">1 долар $ - 1000 срібла <img src="../../img/islands/coin_silver.png" alt="coin"></h2>
							<h2 class="h2_block">
								<label class="method">
									<input name="method" id="1" type="radio">
									<img style="" src="../../img/payeer.png" alt="">
								</label>
								<label class="method">
									<input name="method" id="2" type="radio">
									<img src="../../img/usdt.png" alt="">
								</label>
								<label class="method">
									<input name="method" id="3" type="radio">
									<img src="../../img/crypto.png" alt="">
								</label>
							</h2>
							<h2 class="h2_block">
								<form class="swap_form" action="" method="POST">
									<label for="deposit_text">Кількість $:</label>
									<input class="swap_text" type="text" name="deposit_amount" id="deposit_text">
									<input class="withdraw_input" name="deposit" type="submit" value="внести">
								</form>
							</h2>
						</div>
						<h1 class="h2_block">Останні 20 депозитів</h1>
						<div class="table_profile">
							<div class="tr_profile">
								<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Дата</span>
								<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Кількість</span>
								<span class="td_profile" style="border-bottom: 3px solid #70523e;">Статус</span>
							</div>
							<? $deposit = $db->query("SELECT * FROM users_deposit WHERE user_id = '$user_id' AND status > 0 ORDER BY date_deposit DESC LIMIT 20");
							if ($deposit->num_rows > 0) {
								for ($i = $deposit->num_rows; $i > 0; $i--) { 
									$row4 = $deposit->fetch_assoc();?>
							<div class="tr_profile">
								<span class="td_profile" style="border-right: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $row4['date_deposit'])?></span>
								<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$row4['gold']?></span>
								<span class="td_profile"><?if ($row4['status'] == 1) { echo 'Успішно'; } else { echo 'Скасовано'; }?></span>
							</div>
							<? } } else { ?>
							<div class="swap_none">
								У вас немає депозитів
							</div>
							<? } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
		<script src="../../js/main.js"></script>
	</body>
</html>