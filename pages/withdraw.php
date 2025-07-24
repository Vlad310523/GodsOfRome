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
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Gods of Rome</title>
		<link rel="stylesheet" type="text/css" href="../css/style4.css">
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
			<?if(isset($_POST['window'])){ $amount_gold = $_POST['amount_gold']; if(isset($amount_gold) && $amount_gold > 0){?>
				<dialog class="dialog">
					<h2 class="dialog_h2">Are you sure?</h2>
					<h3 class="dialog_h3">You swap: <?=$amount_gold?> gold</h3>
					<form class="dialog_form" action="/inc/swap_gold.php" method="POST">
						<input type="hidden" name="amount" value="<?=$amount_gold?>">
						<input class="dialog_yes" type="submit" name="swap" value="Yes">
						<input class="dialog_no" type="submit" value="No" id="closewindow">
					</form>
				</dialog>
			<? } else { $_SESSION['msgb'] = 'Amount of gold can\'t be less than 1!';} } ?>
			<?if(isset($_POST['withdraw'])){ $withdraw_gold = $_POST['withdraw_gold']; if(isset($withdraw_gold) && $withdraw_gold > 999){?>
				<dialog class="dialog">
					<h2 class="dialog_h2">Are you sure?</h2>
					<h3 class="dialog_h3">You withdraw: <?=$withdraw_gold?> gold</h3>
					<form class="dialog_form" action="/inc/withdraw_gold.php" method="POST">
						<input type="hidden" name="amount" value="<?=$withdraw_gold?>">
						<input class="dialog_yes" type="submit" name="withdraw" value="Yes">
						<input class="dialog_no" type="submit" value="No" id="closewindow">
					</form>
				</dialog>
			<? } else { $_SESSION['msgb'] = 'Amount of gold can\'t be less than 1000!';} } ?>
			<div class="help_main">
				<div class="help_buttons">
					<div class="help_button3">Withdraw</div>
					<a class="help_button" href="/pages/mylands.php">Back</a>
				</div>
				<div class="help_block">
					<div class="block1">
						<?if($_GET['1'] === "Swap") {?>
						<form class="buttons_change" action="" method="GET">
							<input class="h1_button blur" type="submit" value="Withdraw" name="1">
							<h1 class="h1_button" style="cursor:default;">|</h1>
							<h1 class="h1_button" style="cursor:default;">Swap</h1>
						</form>
						<div class="swap_block">
							<?if(isset($_SESSION['msgb'])){?><h2 class="msg"><?=$_SESSION['msgb']?></h2><?} unset($_SESSION['msgb']);?>
							<h1 class="h1_block">Swap gold</h1>
							<h2 class="h2_block">1 gold <img src="../img/islands/coin_gold.png" alt="coin"> - 1 silver <img src="../img/islands/coin_silver.png" alt="coin"></h2>
							<h2 class="h2_block">
								<form class="swap_form" action="" method="POST">
									<label for="swap_text">Amount <img src="../img/islands/coin_gold.png" alt="gold">:</label>
									<input class="swap_text" type="text" name="amount_gold" id="swap_text">
									<input class="swap_input" name="window" type="submit" value="swap">
								</form>
							</h2>
						</div>
						<h1 class="h2_block">Last 20 swaps</h1>
						<div class="table_profile">
							<div class="tr_profile">
								<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Date</span>
								<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Gold</span>
								<span class="td_profile" style="border-bottom: 3px solid #70523e;">Silver</span>
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
								You don`t have any swaps
							</div>
							<? } ?>
						</div>
						<?} else {?>
						<form class="buttons_change" action="" method="GET">
							<h1 class="h1_button" style="cursor:default;">Withdraw</h1>
							<h1 class="h1_button" style="cursor:default;">|</h1>
							<input class="h1_button blur" type="submit" value="Swap" name="1">
						</form>
						<div class="withdraw_block">
							<?if(isset($_SESSION['msgb'])){?><h2 class="msg"><?=$_SESSION['msgb']?></h2><?} unset($_SESSION['msgb']);?>
							<?if(isset($_SESSION['msgbb'])){?><h2 class="msg"><?=$_SESSION['msgbb']?><a style="margin-left: 5px; text-decoration: underline; color: #A60400;" href="/pages/profile.php?1=Withdraw">profile</a></h2><?} unset($_SESSION['msgbb']);?>
							<h1 class="h1_block">Withdraw gold</h1>
							<h2 class="h2_block" style="margin: 15px 0; color: #A60400;">You can withdraw only on your <a style="margin-left: 5px; text-decoration: underline; color: #A60400;" href="/pages/profile.php?1=Withdraw">Payeer wallet</a>!</h2>
							<h2 class="h2_block">1000 gold <img src="../img/islands/coin_gold.png" alt="coin"> - 1 dollar $</h2>
							<h2 class="h2_block">
								<form class="swap_form" action="" method="POST">
									<label for="withdraw_text">Amount <img src="../img/islands/coin_gold.png" alt="gold">:</label>
									<input class="swap_text" type="text" name="withdraw_gold" id="withdraw_text">
									<input class="withdraw_input" name="withdraw" type="submit" value="withdraw">
								</form>
							</h2>
						</div>
						<h1 class="h2_block">Last 20 withdraws</h1>
						<div class="table_profile">
							<div class="tr_profile">
								<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Wallet</span>
								<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Date</span>
								<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Gold</span>
								<span class="td_profile" style="border-bottom: 3px solid #70523e;">Status</span>
							</div>
							<? $withdraw = $db->query("SELECT * FROM users_withdraw WHERE user_id = '$user_id' ORDER BY date_withdraw DESC LIMIT 20");
							if ($withdraw->num_rows > 0) {
								for ($i = $withdraw->num_rows; $i > 0; $i--) { 
									$row4 = $withdraw->fetch_assoc();?>
							<div class="tr_profile">
								<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$row4['payeer_wallet']?></span>
								<span class="td_profile" style="border-right: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $row4['date_withdraw'])?></span>
								<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$row4['gold']?></span>
								<span class="td_profile"><?if ($row4['status'] == 0) { echo 'In Progress'; } else if ($row4['status'] == 1) { echo 'Success'; } else { echo 'Failed'; }?></span>
							</div>
							<? } } else { ?>
							<div class="swap_none">
								You don`t have any withdraws
							</div>
							<? } ?>
						</div>
						<?}?>
					</div>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
		<script src="../js/main.js"></script>
	</body>
</html>