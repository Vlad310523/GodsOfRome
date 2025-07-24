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
	$referrals = $db->query("SELECT * FROM referrals WHERE ref_id = '$user_id'");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Gods of Rome</title>
		<link rel="stylesheet" type="text/css" href="../css/style3.css">
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
			<div class="profile_main">
				<div class="profile_buttons">
					<div class="profile_button2">Profile</div>
					<a class="profile_button" href="/pages/mylands.php">Back</a>
				</div>
				<div class="profile_block">
					<?if($_GET['1'] === "Deposit") {?>
					<form class="table_buttons" action="" method="GET">
						<input class="table_button" type="submit" value="Referrals" name="1">
						<input class="table_button table_button_active" type="submit" value="Deposit" name="1">
						<input class="table_button" type="submit" value="Withdraw" name="1">
					</form>
					<div class="table_profile">
						<div class="tr_profile">
							<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Date</span>
							<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Amount</span>
							<span class="td_profile" style="border-bottom: 3px solid #70523e;">Status</span>
						</div>
						<? $deposit = $db->query("SELECT * FROM users_deposit WHERE user_id = '$user_id' AND status > 0 ORDER BY date_deposit DESC LIMIT 20");
							if ($deposit->num_rows > 0) {
								for ($i = $deposit->num_rows; $i > 0; $i--) { 
									$row5 = $deposit->fetch_assoc();?>
						<div class="tr_profile">
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $row5['date_deposit'])?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$row5['gold']?></span>
							<span class="td_profile"><?if ($row5['status'] == 1) { echo 'Success'; } else { echo 'Failed'; }?></span>
						</div>
						<? } } else { ?>
							<div class="swap_none">
								You don`t have any deposits
							</div>
						<? } ?>
					</div>
					<?} else if($_GET['1'] === "Withdraw") {?>
					<form class="table_buttons" action="" method="GET">
						<input class="table_button" type="submit" value="Referrals" name="1">
						<input class="table_button" type="submit" value="Deposit" name="1">
						<input class="table_button table_button_active" type="submit" value="Withdraw" name="1">
					</form>
					<div class="table_profile">
						<div class="table_ref">Your Payeer wallet: <?if(isset($row['payeer_wallet'])) { echo $row['payeer_wallet'];} else { echo 'None';}?></div>
						<div class="table_ref" style="margin: 2% 0;">
							<form class="change_form" action="/inc/change_wallet.php" method="POST">
								<label for="wallet_text">Insert wallet (P12345678):</label>
								<input class="change_text" type="text" name="wallet" id="wallet_text">
								<input class="change_input" name="change_wallet" type="submit" value="change">
							</form>
						</div>
						<div class="tr_profile">
							<span class="td_profile" style="border-top: 3px solid #70523e; border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Wallet</span>
							<span class="td_profile" style="border-top: 3px solid #70523e; border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Date</span>
							<span class="td_profile" style="border-top: 3px solid #70523e; border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Amount $</span>
							<span class="td_profile" style="border-top: 3px solid #70523e; border-bottom: 3px solid #70523e;">Status</span>
						</div>
						<? $withdraw = $db->query("SELECT * FROM users_withdraw WHERE user_id = '$user_id' ORDER BY date_withdraw DESC LIMIT 20");
						if ($withdraw->num_rows > 0) {
							for ($i = $withdraw->num_rows; $i > 0; $i--) { 
								$row4 = $withdraw->fetch_assoc();?>
						<div class="tr_profile">
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$row4['payeer_wallet']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $row4['date_withdraw'])?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$row4['gold']/1000?></span>
							<span class="td_profile"><?if ($row4['status'] == 0) { echo 'In Progress'; } else if ($row4['status'] == 1) { echo 'Success'; } else { echo 'Rejected'; }?></span>
						</div>
						<? } } else { ?>
						<div class="swap_none">
							You don`t have any withdraws
						</div>
						<? } ?>
					</div>
					<?} else {?>
					<form class="table_buttons" action="" method="GET">
						<input class="table_button table_button_active" type="submit" value="Referrals" name="1">
						<input class="table_button" type="submit" value="Deposit" name="1">
						<input class="table_button" type="submit" value="Withdraw" name="1">
					</form>
					<div class="table_profile">
						<div class="table_ref">Receive 2% for each deposit from your referral</div>
						<div class="table_ref" style="margin-bottom: 2%; margin-top: 1%"><h2>Invite Code: <span><?=$user_id?></span></h2><h2>Invite link: <span style="text-decoration: underline">https://godsofrome.fun/register.php?ref=<?=$user_id?></span></h2></div>
						<div class="tr_profile">
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Username</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Deposit</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">You get</span>
						</div>
						<?if ($referrals->num_rows > 0) {
							for ($i = $referrals->num_rows; $i > 0; $i--) {
									$referral = $referrals->fetch_assoc();
									$id = $referral['user_id'];
									$user = $db->query("SELECT username FROM users_b WHERE user_id = '$id'");
									$row6 = $user->fetch_assoc();
						?>
						<div class="tr_profile">
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$row6['username']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$referral['deposit']?> silver</span>
							<span class="td_profile"><?=round($referral['deposit']*0.02)?> silver</span>
						</div>
						<?}} else {?>
							<div class="tr_profile" style="padding: 0.5% 0;">You don`t have referrals</div>
						<? } ?>
					</div>
					<?}?>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
		<script src="../js/main.js"></script>
	</body>
</html>