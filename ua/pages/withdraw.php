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
			<?if(isset($_POST['window'])){ $amount_gold = $_POST['amount_gold']; if(isset($amount_gold) && $amount_gold > 0){?>
				<dialog class="dialog">
					<h2 class="dialog_h2">Ви впевнені?</h2>
					<h3 class="dialog_h3">Ви змінюєте: <?=$amount_gold?> золота</h3>
					<form class="dialog_form" action="../../inc/swap_gold.php" method="POST">
						<input type="hidden" name="amount" value="<?=$amount_gold?>">
						<input class="dialog_yes" type="submit" name="swap" value="Так">
						<input class="dialog_no" type="submit" value="Ні" id="closewindow">
					</form>
				</dialog>
			<? } else { $_SESSION['msgb'] = 'Кількість золота не може бути меншою за 1!';} } ?>
			<?if(isset($_POST['withdraw'])){ $withdraw_gold = $_POST['withdraw_gold']; if(isset($withdraw_gold) && $withdraw_gold > 999){?>
				<dialog class="dialog">
					<h2 class="dialog_h2">Ви впевнені?</h2>
					<h3 class="dialog_h3">Ви виводите: <?=$withdraw_gold?> золота</h3>
					<form class="dialog_form" action="../../inc/withdraw_gold.php" method="POST">
						<input type="hidden" name="amount" value="<?=$withdraw_gold?>">
						<input class="dialog_yes" type="submit" name="withdraw" value="Так">
						<input class="dialog_no" type="submit" value="Ні" id="closewindow">
					</form>
				</dialog>
			<? } else { $_SESSION['msgb'] = 'Кількість золота не може бути меншою за 1000!';} } ?>
			<div class="help_main">
				<div class="help_buttons">
					<div class="help_button3">Вивід</div>
					<a class="help_button" href="mylands.php">Назад</a>
				</div>
				<div class="help_block">
					<div class="block1">
						<?if($_GET['1'] === "Обмін") {?>
						<form class="buttons_change" action="" method="GET">
							<input class="h1_button blur" type="submit" value="Вивід" name="1">
							<h1 class="h1_button" style="cursor:default;">|</h1>
							<h1 class="h1_button" style="cursor:default;">Обмін</h1>
						</form>
						<div class="swap_block">
							<?if(isset($_SESSION['msgb'])){?><h2 class="msg"><?=$_SESSION['msgb']?></h2><?} unset($_SESSION['msgb']);?>
							<h1 class="h1_block">Обміняти золото</h1>
							<h2 class="h2_block">1 золото <img src="../../img/islands/coin_gold.png" alt="coin"> - 1 срібло <img src="../../img/islands/coin_silver.png" alt="coin"></h2>
							<h2 class="h2_block">
								<form class="swap_form" action="" method="POST">
									<label for="swap_text">Кількість <img src="../../img/islands/coin_gold.png" alt="gold">:</label>
									<input class="swap_text" type="text" name="amount_gold" id="swap_text">
									<input class="swap_input" name="window" type="submit" value="обмін">
								</form>
							</h2>
						</div>
						<h1 class="h2_block">Останні 20 обмінів</h1>
						<div class="table_profile">
							<div class="tr_profile">
								<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Дата</span>
								<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Золота</span>
								<span class="td_profile" style="border-bottom: 3px solid #70523e;">Срібла</span>
							</div>
							<? $swap = $db->query("SELECT * FROM swap_gold WHERE user_id = '$user_id' ORDER BY date_swap DESC LIMIT 20");
							if ($swap->num_rows > 0) {
								for ($i = $swap->num_rows; $i > 0; $i--) { 
									$row3 = $swap->fetch_assoc();?>
							<div class="tr_profile">
								<span class="td_profile" style="border-right: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $row3['date_swap'])?></span>
								<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$row3['gold']?></span>
								<span class="td_profile"><?=$row3['silver']?></span>
							</div>
							<? } } else { ?>
							<div class="swap_none">
								У вас немає завершених обмінів
							</div>
							<? } ?>
						</div>
						<?} else {?>
						<form class="buttons_change" action="" method="GET">
							<h1 class="h1_button" style="cursor:default;">Вивід</h1>
							<h1 class="h1_button" style="cursor:default;">|</h1>
							<input class="h1_button blur" type="submit" value="Обмін" name="1">
						</form>
						<div class="withdraw_block">
							<?if(isset($_SESSION['msgb'])){?><h2 class="msg"><?=$_SESSION['msgb']?></h2><?} unset($_SESSION['msgb']);?>
							<?if(isset($_SESSION['msgbb'])){?><h2 class="msg"><?=$_SESSION['msgbb']?><a style="margin-left: 5px; text-decoration: underline; color: #A60400;" href="profile.php?1=Withdraw">profile</a></h2><?} unset($_SESSION['msgbb']);?>
							<h1 class="h1_block">Вивести золото</h1>
							<h2 class="h2_block" style="margin: 15px 0; color: #A60400;">Ви можете виводити тільки на <a style="margin-left: 5px; text-decoration: underline; color: #A60400;" href="profile.php?1=Withdraw">Payeer гаманець</a>!</h2>
							<h2 class="h2_block">1000 золота <img src="../../img/islands/coin_gold.png" alt="coin"> - 1 долар $</h2>
							<h2 class="h2_block">
								<form class="swap_form" action="" method="POST">
									<label for="withdraw_text">Кількість <img src="../../img/islands/coin_gold.png" alt="gold">:</label>
									<input class="swap_text" type="text" name="withdraw_gold" id="withdraw_text">
									<input class="withdraw_input" name="withdraw" type="submit" value="вивести">
								</form>
							</h2>
						</div>
						<h1 class="h2_block">Останні 20 виплат</h1>
						<div class="table_profile">
							<div class="tr_profile">
								<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Гаманець</span>
								<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Дата</span>
								<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Золота</span>
								<span class="td_profile" style="border-bottom: 3px solid #70523e;">Статус</span>
							</div>
							<? $withdraw = $db->query("SELECT * FROM users_withdraw WHERE user_id = '$user_id' ORDER BY date_withdraw DESC LIMIT 20");
							if ($withdraw->num_rows > 0) {
								for ($i = $withdraw->num_rows; $i > 0; $i--) { 
									$row4 = $withdraw->fetch_assoc();?>
							<div class="tr_profile">
								<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$row4['payeer_wallet']?></span>
								<span class="td_profile" style="border-right: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $row4['date_withdraw'])?></span>
								<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$row4['gold']?></span>
								<span class="td_profile"><?if ($row4['status'] == 0) { echo 'У процесі'; } else if ($row4['status'] == 1) { echo 'Успішно'; } else { echo 'Скасовано'; }?></span>
							</div>
							<? } } else { ?>
							<div class="swap_none">
								У вас немає завершених висновків
							</div>
							<? } ?>
						</div>
						<?}?>
					</div>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
		<script src="../../js/main.js"></script>
	</body>
</html>