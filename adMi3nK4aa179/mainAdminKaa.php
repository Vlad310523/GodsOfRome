<?php
	session_start();
	if (!$_SESSION['admin']) {
		header('Location: /adMi3nK4aa179/loginAdmin.php');
	}
	require_once '../classes/configdb.php';
	$user = $db->query("SELECT * FROM users");
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
			<div class="profile_main" style="height: 100%">
				<div class="profile_buttons" style="margin-top: 1%">
					<div class="profile_button2">Adminka</div>
					<a class="profile_button" href="../incAdmin/logout.php">EXIT</a>
				</div>
				<div class="profile_block">
					<?if($_GET['1'] === "Deposit") {?>
					<form class="table_buttons" action="" method="GET">
						<input class="table_button" type="submit" value="All users" name="1">
						<input class="table_button" type="submit" value="User" name="1">
						<input class="table_button table_button_active" type="submit" value="Deposit" name="1">
						<input class="table_button" type="submit" value="Withdraw" name="1">
						<input class="table_button" type="submit" value="Referrals" name="1">
						<input class="table_button" type="submit" value="Battles" name="1">
						<input class="table_button" type="submit" value="BattleHist" name="1">
						<input class="table_button" type="submit" value="Trees" name="1">
						<input class="table_button" type="submit" value="Storages" name="1">
					</form>
					<div class="table_profile">
						<div class="tr_profile">
							<form action="" method="POST" style="margin: 10px 10px"><label for="input">User_ID:</label><input id="input" type="text" name="user_id" style="margin: 0 5px; padding: 5px 10px; font-size: 80%; border: 1px solid black;"><input type="submit" name="Find" value="Find" style="padding: 5px 15px; border-radius: 10%; cursor: pointer; background-color: yellow; font-size: 80%;"></form>
						</div>
						<?
							if ($_POST['user_id']) {
								$users_ids = intval($_POST['user_id']);
								$deposit = $db->query("SELECT * FROM users_deposit WHERE user_id = '$users_ids' AND status > 0 ORDER BY status DESC");
							} else {
								$deposit = $db->query("SELECT * FROM users_deposit WHERE status > 0 ORDER BY status ASC");
							}
						?>
						<div class="tr_profile">
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User_ID</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Date</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Amount</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Status</span>
						</div>
						<?
						if ($deposit->num_rows > 0) {
							for ($i = $deposit->num_rows; $i > 0; $i--) {
									$rowDeposit = $deposit->fetch_assoc();
						?>
						<div class="tr_profile">
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$rowDeposit['user_id']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $rowDeposit['date_deposit'])?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$rowDeposit['gold']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?if ($rowDeposit['status'] == 0) { echo 'In Progress'; } else if ($rowDeposit['status'] == 1) { echo 'Success'; } else { echo 'Failed'; }?></span>
						</div>
						<?} } else {?>
						<div class="tr_profile">
							<span class="td_profile">User is not found</span>
						</div>
						<? } ?>
					</div>
					<?} else if($_GET['1'] === "Withdraw") {?>
					<form class="table_buttons" action="" method="GET">
						<input class="table_button" type="submit" value="All users" name="1">
						<input class="table_button" type="submit" value="User" name="1">
						<input class="table_button" type="submit" value="Deposit" name="1">
						<input class="table_button table_button_active" type="submit" value="Withdraw" name="1">
						<input class="table_button" type="submit" value="Referrals" name="1">
						<input class="table_button" type="submit" value="Battles" name="1">
						<input class="table_button" type="submit" value="BattleHist" name="1">
						<input class="table_button" type="submit" value="Trees" name="1">
						<input class="table_button" type="submit" value="Storages" name="1">
					</form>
					<div class="table_profile">
						<div class="tr_profile">
							<form action="" method="POST" style="margin: 10px 10px"><label for="input">User_ID:</label><input id="input" type="text" name="user_id" style="margin: 0 5px; padding: 5px 10px; font-size: 80%; border: 1px solid black;"><input type="submit" name="Find" value="Find" style="padding: 5px 15px; border-radius: 10%; cursor: pointer; background-color: yellow; font-size: 80%;"></form>
						</div>
						<?
							if ($_POST['user_id']) {
								$users_ids = intval($_POST['user_id']);
								$withdraw = $db->query("SELECT * FROM users_withdraw WHERE user_id = '$users_ids' ORDER BY status DESC");
							} else {
								$withdraw = $db->query("SELECT * FROM users_withdraw ORDER BY status ASC");
							}
						?>
						<div class="tr_profile">
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User_ID</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Date</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Amount</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Status</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Change</span>
						</div>
						<?
						if (isset($_POST['change'])) {
							$withdraw_id = $_POST['withdraw_id'];
							$withdraw2 = $db->query("SELECT * FROM users_withdraw WHERE withdraw_id = '$withdraw_id'");
							if ($withdraw2->num_rows > 0) {
								$rowWithdraw2 = $withdraw2->fetch_assoc();
								if ($rowWithdraw2['status'] == 0) {
									$db->query("UPDATE users_withdraw SET status = 1 WHERE withdraw_id = '$withdraw_id'");
								} else if ($rowWithdraw2['status'] == 1){
									$db->query("UPDATE users_withdraw SET status = 2 WHERE withdraw_id = '$withdraw_id'");
								} else {
									$db->query("UPDATE users_withdraw SET status = 0 WHERE withdraw_id = '$withdraw_id'");
								}
							}
							header('Location: /adMi3nK4aa179/mainAdminKaa.php?1=Withdraw');
						}
						if ($withdraw->num_rows > 0) {
							for ($i = $withdraw->num_rows; $i > 0; $i--) {
									$rowWithdraw = $withdraw->fetch_assoc();
						?>
						<div class="tr_profile">
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$rowWithdraw['user_id']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $rowWithdraw['date_withdraw'])?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$rowWithdraw['gold']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?if ($rowWithdraw['status'] == 0) { echo 'In Progress'; } else if ($rowWithdraw['status'] == 1) { echo 'Success'; } else { echo 'Failed'; }?></span>
							<span class="td_profile">
								<form action="" method="POST">
									<input type="hidden" name="withdraw_id" value="<?=$rowWithdraw['withdraw_id']?>">
									<input class="profile_button" type="submit" value="Change" name="change" style="width: 60px; max-height: 45px; font-size: 100%;">
								</form>
							</span>
						</div>
						<?} } else {?>
						<div class="tr_profile">
							<span class="td_profile">User is not found</span>
						</div>
						<? } ?>
					</div>
					<?} else if($_GET['1'] === "Referrals") {?>
					<form class="table_buttons" action="" method="GET">
						<input class="table_button" type="submit" value="All users" name="1">
						<input class="table_button" type="submit" value="User" name="1">
						<input class="table_button" type="submit" value="Deposit" name="1">
						<input class="table_button" type="submit" value="Withdraw" name="1">
						<input class="table_button table_button_active" type="submit" value="Referrals" name="1">
						<input class="table_button" type="submit" value="Battles" name="1">
						<input class="table_button" type="submit" value="BattleHist" name="1">
						<input class="table_button" type="submit" value="Trees" name="1">
						<input class="table_button" type="submit" value="Storages" name="1">
					</form>
					<div class="table_profile">
						<div class="tr_profile">
							<form action="" method="POST" style="margin: 10px 10px"><label for="input">Ref_ID:</label><input id="input" type="text" name="user_id" style="margin: 0 5px; padding: 5px 10px; font-size: 80%; border: 1px solid black;"><input type="submit" name="Find" value="Find" style="padding: 5px 15px; border-radius: 10%; cursor: pointer; background-color: yellow; font-size: 80%;"></form>
						</div>
						<?
							if ($_POST['user_id']) {
								$users_ids = intval($_POST['user_id']);
								$refs = $db->query("SELECT * FROM referrals WHERE ref_id = '$users_ids'");
							} else {
								$refs = $db->query("SELECT * FROM referrals");
							}
						?>
						<div class="tr_profile">
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Ref_ID</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User_id</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Deposit</span>
						</div>
						<?
						if ($refs->num_rows > 0) {
							for ($i = $refs->num_rows; $i > 0; $i--) {
									$rowRefs = $refs->fetch_assoc();
						?>
						<div class="tr_profile">
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$rowRefs['ref_id']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$rowRefs['user_id']?></span>
							<span class="td_profile"><?=$rowRefs['deposit']?></span>
						</div>
						<?} } else {?>
						<div class="tr_profile">
							<span class="td_profile">User is not found</span>
						</div>
						<? } ?>
					</div>
					<?} else if($_GET['1'] === "Battles") {?>
					<form class="table_buttons" action="" method="GET">
						<input class="table_button" type="submit" value="All users" name="1">
						<input class="table_button" type="submit" value="User" name="1">
						<input class="table_button" type="submit" value="Deposit" name="1">
						<input class="table_button" type="submit" value="Withdraw" name="1">
						<input class="table_button" type="submit" value="Referrals" name="1">
						<input class="table_button table_button_active" type="submit" value="Battles" name="1">
						<input class="table_button" type="submit" value="BattleHist" name="1">
						<input class="table_button" type="submit" value="Trees" name="1">
						<input class="table_button" type="submit" value="Storages" name="1">
					</form>
					<div class="table_profile">
						<div class="tr_profile">
							<form action="" method="POST" style="margin: 10px 10px"><label for="input">User_ID:</label><input id="input" type="text" name="user_id" style="margin: 0 5px; padding: 5px 10px; font-size: 80%; border: 1px solid black;"><input type="submit" name="Find" value="Find" style="padding: 5px 15px; border-radius: 10%; cursor: pointer; background-color: yellow; font-size: 80%;"></form>
						</div>
						<?
							if ($_POST['user_id']) {
								$users_ids = intval($_POST['user_id']);
								$battlesAll = $db->query("SELECT * FROM active_battle WHERE user_id = '$users_ids' OR enemy_id = '$users_ids'");
							} else {
								$battlesAll = $db->query("SELECT * FROM active_battle");
							}
						?>
						<div class="tr_profile">
							<span class="td_profile" style="width:11%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Battle_ID</span>
							<span class="td_profile" style="width:11%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User_ID</span>
							<span class="td_profile" style="width:11%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Enemy_ID</span>
							<span class="td_profile" style="width:14%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Cost</span>
							<span class="td_profile" style="width:14%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Date Create</span>
							<span class="td_profile" style="width:15%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Status</span>
							<span class="td_profile" style="width:12%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">God Power</span>
							<span class="td_profile" style="width:12%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">God Type</span>
							<span class="td_profile" style="width:12%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Delete</span>
						</div>
						<?
						if (isset($_POST['delete'])) {
							$battle_id = $_POST['battle_id'];
							$db->Query("DELETE FROM active_battle WHERE battle_id = '$battle_id'");
							header('Location: /adMi3nK4aa179/mainAdminKaa.php?1=Battles');
						}
						if ($battlesAll->num_rows > 0) {
							for ($i = $battlesAll->num_rows; $i > 0; $i--) {
									$battles = $battlesAll->fetch_assoc();
						?>
						<div class="tr_profile">
							<span class="td_profile" style="width:11%;border-right: 3px solid #70523e;"><?=$battles['battle_id']?></span>
							<span class="td_profile" style="width:11%;border-right: 3px solid #70523e;"><?=$battles['user_id']?></span>
							<span class="td_profile" style="width:11%;border-right: 3px solid #70523e;"><?=$battles['enemy_id']?></span>
							<span class="td_profile" style="width:14%;border-right: 3px solid #70523e;"><?=$battles['battle_cost']?></span>
							<span class="td_profile" style="width:14%;border-right: 3px solid #70523e;"><?=$battles['date_create']?></span>
							<span class="td_profile" style="width:15%;border-right: 3px solid #70523e;"><?=$battles['status'] == 0 ? 'Waiting' : 'In Progress'?></span>
							<span class="td_profile" style="width:12%;border-right: 3px solid #70523e;"><?=$battles['god_power']?></span>
							<span class="td_profile" style="width:12%;border-right: 3px solid #70523e;"><?=$battles['god_type'] == 4 ? 'Lightning' : ($battles['god_type'] == 3 ? 'Earth' : ($battles['god_type'] == 3 ? 'Fire' : 'Water'))?></span>
							<span class="td_profile" style="width:12%;"><form action="" method="POST"><input type="hidden" name="battle_id" value="<?=$battles['battle_id']?>"><input class="profile_button" type="submit" value="Delete" name="delete" style="width: 60px; max-height: 45px; font-size: 100%;"></form></span>
						</div>
						<?} } else {?>
						<div class="tr_profile">
							<span class="td_profile">User is not found</span>
						</div>
						<? } ?>
					</div>
					<?} else if($_GET['1'] === "BattleHist") {?>
					<form class="table_buttons" action="" method="GET">
						<input class="table_button" type="submit" value="All users" name="1">
						<input class="table_button" type="submit" value="User" name="1">
						<input class="table_button" type="submit" value="Deposit" name="1">
						<input class="table_button" type="submit" value="Withdraw" name="1">
						<input class="table_button" type="submit" value="Referrals" name="1">
						<input class="table_button" type="submit" value="Battles" name="1">
						<input class="table_button table_button_active" type="submit" value="BattleHist" name="1">
						<input class="table_button" type="submit" value="Trees" name="1">
						<input class="table_button" type="submit" value="Storages" name="1">
					</form>
					<div class="table_profile">
						<div class="tr_profile">
							<form action="" method="POST" style="margin: 10px 10px">
								<label for="input">User_ID:</label>
								<input id="input" type="text" name="user_id" style="margin: 0 5px; padding: 5px 10px; font-size: 80%; border: 1px solid black;">
								<input type="submit" name="Find" value="Find" style="padding: 5px 15px; border-radius: 10%; cursor: pointer; background-color: yellow; font-size: 80%;">
								<label for="input" style="margin-left: 25px">Battle_ID:</label>
								<input id="input" type="text" name="battle_id" style="margin: 0 5px; padding: 5px 10px; font-size: 80%; border: 1px solid black;">
								<input type="submit" name="Find" value="Find" style="padding: 5px 15px; border-radius: 10%; cursor: pointer; background-color: yellow; font-size: 80%;">
							</form>
						</div>
						<?
							if ($_POST['user_id']) {
								$users_ids = intval($_POST['user_id']);
								$battlesHist = $db->query("SELECT * FROM history_battle WHERE user_id = '$users_ids' OR enemy_id = '$users_ids'");
							} else if ($_POST['battle_id']){
								$battles_id = intval($_POST['battle_id']);
								$battlesHist = $db->query("SELECT * FROM history_battle WHERE battle_id = '$battles_id'");
							} else {
								$battlesHist = $db->query("SELECT * FROM history_battle");
							}
						?>
						<div class="tr_profile">
							<span class="td_profile" style="width:9%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Battle ID</span>
							<span class="td_profile" style="width:9%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
							<span class="td_profile" style="width:9%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Enemy ID</span>
							<span class="td_profile" style="width:9%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Cost</span>
							<span class="td_profile" style="width:12%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Date Battle</span>
							<span class="td_profile" style="width:10%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">UserPWR</span>
							<span class="td_profile" style="width:11.5%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">EnemyPWR</span>
							<span class="td_profile" style="width:10%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">UserType</span>
							<span class="td_profile" style="width:11.5%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">EnemyType</span>
							<span class="td_profile" style="width:9%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Winner ID</span>
						</div>
						<?
						if ($battlesHist->num_rows > 0) {
							for ($i = $battlesHist->num_rows; $i > 0; $i--) {
									$battlesH = $battlesHist->fetch_assoc();
						?>
						<div class="tr_profile">
							<span class="td_profile" style="width:9%;border-right: 3px solid #70523e;"><?=$battlesH['battle_id']?></span>
							<span class="td_profile" style="width:9%;border-right: 3px solid #70523e;"><?=$battlesH['user_id']?></span>
							<span class="td_profile" style="width:9%;border-right: 3px solid #70523e;"><?=$battlesH['enemy_id']?></span>
							<span class="td_profile" style="width:9%;border-right: 3px solid #70523e;"><?=$battlesH['battle_cost']?></span>
							<span class="td_profile" style="width:12%;border-right: 3px solid #70523e;"><?=$battlesH['date_battle']?></span>
							<span class="td_profile" style="width:10%;border-right: 3px solid #70523e;"><?=$battlesH['user_power']?></span>
							<span class="td_profile" style="width:11.5%;border-right: 3px solid #70523e;"><?=$battlesH['enemy_power']?></span>
							<span class="td_profile" style="width:10%;border-right: 3px solid #70523e;"><?=$battlesH['type_user'] == 4 ? 'Lightning' : ($battlesH['type_user'] == 3 ? 'Earth' : ($battlesH['type_user'] == 3 ? 'Fire' : 'Water'))?></span>
							<span class="td_profile" style="width:11.5%;border-right: 3px solid #70523e;"><?=$battlesH['type_enemy'] == 4 ? 'Lightning' : ($battlesH['type_enemy'] == 3 ? 'Earth' : ($battlesH['type_enemy'] == 3 ? 'Fire' : 'Water'))?></span>
							<span class="td_profile" style="width:9%;"><?=$battlesH['winner_id']?></span>
						</div>
						<?} } else {?>
						<div class="tr_profile">
							<span class="td_profile">User is not found</span>
						</div>
						<? } ?>
					</div>
					<?} else if($_GET['1'] === "Trees") {?>
					<form class="table_buttons" action="" method="GET">
						<input class="table_button" type="submit" value="All users" name="1">
						<input class="table_button" type="submit" value="User" name="1">
						<input class="table_button" type="submit" value="Deposit" name="1">
						<input class="table_button" type="submit" value="Withdraw" name="1">
						<input class="table_button" type="submit" value="Referrals" name="1">
						<input class="table_button" type="submit" value="Battles" name="1">
						<input class="table_button" type="submit" value="BattleHist" name="1">
						<input class="table_button table_button_active" type="submit" value="Trees" name="1">
						<input class="table_button" type="submit" value="Storages" name="1">
					</form>
					<div class="table_profile">
						<div class="tr_profile">
							<form action="" method="POST" style="margin: 10px 10px"><label for="input">User_ID:</label><input id="input" type="text" name="user_id" style="margin: 0 5px; padding: 5px 10px; font-size: 80%; border: 1px solid black;"><input type="submit" name="Find" value="Find" style="padding: 5px 15px; border-radius: 10%; cursor: pointer; background-color: yellow; font-size: 80%;"></form>
						</div>
						<?
							if ($_POST['user_id']) {
								$users_ids = intval($_POST['user_id']);
								$trees = $db->query("SELECT * FROM trees WHERE user_id = '$users_ids'");
							} else {
								$trees = $db->query("SELECT * FROM trees");
							}
						?>
						<div class="tr_profile">
							<span class="td_profile" style="width:8%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
							<span class="td_profile" style="width:8%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Tree1</span>
							<span class="td_profile" style="width:8%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Tree2</span>
							<span class="td_profile" style="width:8%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Tree3</span>
							<span class="td_profile" style="width:8%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Tree4</span>
							<span class="td_profile" style="width:8%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Tree5</span>
							<span class="td_profile" style="width:12%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Tree1Time</span>
							<span class="td_profile" style="width:12%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Tree2Time</span>
							<span class="td_profile" style="width:12%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Tree3Time</span>
							<span class="td_profile" style="width:12%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Tree4Time</span>
							<span class="td_profile" style="width:12%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Tree5Time</span>
						</div>
						<?
						if ($trees->num_rows > 0) {
							for ($i = $trees->num_rows; $i > 0; $i--) {
									$tree = $trees->fetch_assoc();
						?>
						<div class="tr_profile">
							<span class="td_profile" style="width:8%;height:100%;border-right: 3px solid #70523e;"><?=$tree['user_id']?></span>
							<span class="td_profile" style="width:8%;height:100%;border-right: 3px solid #70523e;"><?=$tree['tree1']?></span>
							<span class="td_profile" style="width:8%;height:100%;border-right: 3px solid #70523e;"><?=$tree['tree2']?></span>
							<span class="td_profile" style="width:8%;height:100%;border-right: 3px solid #70523e;"><?=$tree['tree3']?></span>
							<span class="td_profile" style="width:8%;height:100%;border-right: 3px solid #70523e;"><?=$tree['tree4']?></span>
							<span class="td_profile" style="width:8%;height:100%;border-right: 3px solid #70523e;"><?=$tree['tree5']?></span>
							<span class="td_profile" style="width:12%;height:100%;border-right: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $tree['tree1_time'])?></span>
							<span class="td_profile" style="width:12%;height:100%;border-right: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $tree['tree2_time'])?></span>
							<span class="td_profile" style="width:12%;height:100%;border-right: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $tree['tree3_time'])?></span>
							<span class="td_profile" style="width:12%;height:100%;border-right: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $tree['tree4_time'])?></span>
							<span class="td_profile" style="width:12%;height:100%;"><?=date('Y-m-d H:i:s', $tree['tree5_time'])?></span>
						</div>
						<?} } else {?>
						<div class="tr_profile">
							<span class="td_profile">User is not found</span>
						</div>
						<? } ?>
					</div>
					<?} else if($_GET['1'] === "Storages") {?>
					<form class="table_buttons" action="" method="GET">
						<input class="table_button" type="submit" value="All users" name="1">
						<input class="table_button" type="submit" value="User" name="1">
						<input class="table_button" type="submit" value="Deposit" name="1">
						<input class="table_button" type="submit" value="Withdraw" name="1">
						<input class="table_button" type="submit" value="Referrals" name="1">
						<input class="table_button" type="submit" value="Battles" name="1">
						<input class="table_button" type="submit" value="BattleHist" name="1">
						<input class="table_button" type="submit" value="Trees" name="1">
						<input class="table_button table_button_active" type="submit" value="Storages" name="1">
					</form>
					<div class="table_profile">
						<div class="tr_profile">
							<form action="" method="POST" style="margin: 10px 10px"><label for="input">User_ID:</label><input id="input" type="text" name="user_id" style="margin: 0 5px; padding: 5px 10px; font-size: 80%; border: 1px solid black;"><input type="submit" name="Find" value="Find" style="padding: 5px 15px; border-radius: 10%; cursor: pointer; background-color: yellow; font-size: 80%;"></form>
						</div>
						<?
							if ($_POST['user_id']) {
								$users_ids = intval($_POST['user_id']);
								$treesStorage = $db->query("SELECT * FROM storage_fruits WHERE user_id = '$users_ids'");
							} else {
								$treesStorage = $db->query("SELECT * FROM storage_fruits");
							}
						?>
						<div class="tr_profile">
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Fruit1</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Fruit2</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Fruit3</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Fruit4</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Fruit5</span>
						</div>
						<?
						if ($treesStorage->num_rows > 0) {
							for ($i = $treesStorage->num_rows; $i > 0; $i--) {
									$treeSt = $treesStorage->fetch_assoc();
						?>
						<div class="tr_profile">
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$treeSt['user_id']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$treeSt['fruit1']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$treeSt['fruit2']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$treeSt['fruit3']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$treeSt['fruit4']?></span>
							<span class="td_profile"><?=$treeSt['fruit5']?></span>
						</div>
						<?} } else {?>
						<div class="tr_profile">
							<span class="td_profile">User is not found</span>
						</div>
						<? } ?>
					</div>
					<?} else if($_GET['1'] === "User") {?>
					<form class="table_buttons" action="" method="GET">
						<input class="table_button" type="submit" value="All users" name="1">
						<input class="table_button table_button_active" type="submit" value="User" name="1">
						<input class="table_button" type="submit" value="Deposit" name="1">
						<input class="table_button" type="submit" value="Withdraw" name="1">
						<input class="table_button" type="submit" value="Referrals" name="1">
						<input class="table_button" type="submit" value="Battles" name="1">
						<input class="table_button" type="submit" value="BattleHist" name="1">
						<input class="table_button" type="submit" value="Trees" name="1">
						<input class="table_button" type="submit" value="Storages" name="1">
					</form>
					<div class="table_profile">
						<div class="tr_profile">
							<form action="" method="POST" style="margin: 10px 10px"><label for="input">User_ID:</label><input id="input" type="text" name="user_id" style="margin: 0 5px; padding: 5px 10px; font-size: 80%;border: 1px solid black;"><input type="submit" name="Find" value="Find" style="padding: 5px 15px; border-radius: 10%; cursor: pointer; background-color: yellow; font-size: 80%;"></form>
							<form action="" method="POST" style="margin: 10px 10px"><label for="inputu">Username:</label><input id="inputu" type="text" name="username" style="margin: 0 5px; padding: 5px 10px; font-size: 80%;border: 1px solid black;"><input type="submit" name="FindU" value="Find" style="padding: 5px 15px; border-radius: 10%; cursor: pointer; background-color: yellow; font-size: 80%;"></form>
						</div>
						<div class="tr_profile">
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Username</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Silver</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Gold</span>
							<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Ban</span>
						</div>
						<?
						if ($_POST['ban']) {
							$user_ban_id = $_POST['user_ban_id'];
							$db->query("UPDATE users SET ban = 1 WHERE user_id = '$user_ban_id'");
							$_POST['user_id'] = $_POST['user_ban_id'];
						}
						if ($_POST['unban']) {
							$user_unban_id = $_POST['user_unban_id'];
							$db->query("UPDATE users SET ban = 0 WHERE user_id = '$user_unban_id'");
							$_POST['user_id'] = $_POST['user_unban_id'];
						}
						if ($_POST['user_id']) {
							$_SESSION['users_ids'] = intval($_POST['user_id']);
							$users_ids = $_SESSION['users_ids'];
						}
						if ($_POST['username']) {
							$user_name = strip_tags($_POST['username']);
							$user_name = htmlspecialchars($user_name);
						}
						$users_ids = $_SESSION['users_ids'];
						$userFind = $db->query("SELECT * FROM users WHERE user_id = '$users_ids'");
						$userFind2 = $db->query("SELECT * FROM users_b WHERE user_id = '$users_ids'");
						if ($userFind->num_rows > 0 && $userFind2->num_rows > 0) {
							$user = $userFind->fetch_assoc();
							$user2 = $userFind2->fetch_assoc();
						?>
						<div class="tr_profile">
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$user['user_id']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$user['username']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$user2['silver']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;"><?=$user2['gold']?></span>
							<? if ($user['ban'] == 0) {?>
								<span class="td_profile" style="color:#169a00;">Not Banned</span>
							<? } else { ?>
								<span class="td_profile" style="color:#A60400;">Banned</span>
							<? } ?>
						</div>
						<div class="tr_profile">
							<span class="td_profile" style="height: 100%;border-right: 3px solid #70523e;border-bottom: 3px solid #70523e;"></span>
							<span class="td_profile" style="height: 100%;border-right: 3px solid #70523e;border-bottom: 3px solid #70523e;"></span>
							<span class="td_profile" style="height: 100%;border-right: 3px solid #70523e;border-bottom: 3px solid #70523e;"></span>
							<span class="td_profile" style="height: 100%;border-right: 3px solid #70523e;border-bottom: 3px solid #70523e;"></span>
							<? if ($user['ban'] == 0) {?>
								<span class="td_profile" style="border-bottom: 3px solid #70523e;"><form action="" method="POST"><input class="profile_button" type="submit" name="ban" value="Ban" style="width: 60px; max-height: 45px; font-size: 100%;"><input type="hidden" name="user_ban_id" value="<?=$users_ids?>"></form></span>
							<? } else { ?>
								<span class="td_profile" style="border-bottom: 3px solid #70523e;"><form action="" method="POST"><input class="profile_button" type="submit" name="unban" value="Unban" style="width: 60px; max-height: 45px; font-size: 100%;"><input type="hidden" name="user_unban_id" value="<?=$users_ids?>"></form></span>
							<? } ?>
						</div>
						<?} else {?>
						<div class="tr_profile" style="border-bottom: 3px solid #70523e;">
							<span class="td_profile">User is not found</span>
						</div>
						<? } ?>
						<div class="tr_profile" style="margin: 20px 0; position: relative;">
							User Activity
							<form action="" method="POST" style="position: absolute; right: 0; margin-right: 25px">
								<label class="label_sort" for="">Sort:</label>
								<select onchange="location=value">
									<option value="/adMi3nK4aa179/mainAdminKaa.php?1=User">Sort</option>
									<option <? if($_GET['sort'] == "deposit") echo 'selected'?> value="?1=User&sort=deposit">Deposit</option>
									<option <? if($_GET['sort'] == "withdraw") echo 'selected'?> value="?1=User&sort=withdraw">Withdraw</option>
									<option <? if($_GET['sort'] == "create_battle") echo 'selected'?> value="?1=User&sort=create_battle">Create battle</option>
									<option <? if($_GET['sort'] == "join_battle") echo 'selected'?> value="?1=User&sort=join_battle">Join battle</option>
									<option <? if($_GET['sort'] == "buy_tree") echo 'selected'?> value="?1=User&sort=buy_tree">Buy tree</option>
									<option <? if($_GET['sort'] == "sell_tree") echo 'selected'?> value="?1=User&sort=sell_tree">Sell tree</option>
									<option <? if($_GET['sort'] == "collect_fruit") echo 'selected'?> value="?1=User&sort=collect_fruit">Collect fruit</option>
									<option <? if($_GET['sort'] == "sell_fruit") echo 'selected'?> value="?1=User&sort=sell_fruit">Sell fruit</option>
								</select>
							</form>
						</div>
						<?
							if (isset($_GET['sort'])) {
								$sort = $_GET['sort'];
								if ($sort == 'deposit') {
									$battles = $db->query("SELECT * FROM active_battle WHERE user_id != '$user_id' AND enemy_id != '$user_id' AND status = 0 AND battle_cost >= 100 AND battle_cost <= 1000");
								?>
								<div class="tr_profile">
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Amount</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Date</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Status</span>
								</div>
								<?
								} else if ($sort == 'withdraw') {
									$battles = $db->query("SELECT * FROM active_battle WHERE user_id != '$user_id' AND enemy_id != '$user_id' AND status = 0 AND battle_cost >= 1000 AND battle_cost <= 5000");
								?>
								<div class="tr_profile">
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Amount</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Date</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Status</span>
								</div>
								<?
								} else if ($sort == 'create_battle') {
									$crbattles = $db->query("SELECT * FROM log_battles WHERE user_id = '$users_ids' AND action = 1");
									?>
									<div class="tr_profile">
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Action</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Battle ID</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Sum</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Date</span>
									</div>
									<?
									if ($crbattles->num_rows > 0) {
										for ($i = $crbattles->num_rows; $i > 0; $i--) {
										$btlle = $crbattles->fetch_assoc();
										?>
										<div class="tr_profile">
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Create Battle</span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$btlle['user_id']?></span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$btlle['battle_id']?></span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$btlle['sum']?></span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $btlle['date_battle'])?></span>
										</div>
										<?
									} } else {
										?>
										<div class="tr_profile">
											<span class="td_profile">No actions</span>
										</div>
										<?
									}
								} else if ($sort == 'join_battle') {
									$crbattles = $db->query("SELECT * FROM log_battles WHERE user_id = '$users_ids' AND action = 2");
									?>
									<div class="tr_profile">
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Action</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Battle ID</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Sum</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Date</span>
									</div>
									<?
									if ($crbattles->num_rows > 0) {
										for ($i = $crbattles->num_rows; $i > 0; $i--) {
										$btlle = $crbattles->fetch_assoc();
										?>
										<div class="tr_profile">
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Join Battle</span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$btlle['user_id']?></span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$btlle['battle_id']?></span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$btlle['sum']?></span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $btlle['date_battle'])?></span>
										</div>
										<?
									} } else {
										?>
										<div class="tr_profile">
											<span class="td_profile">No actions</span>
										</div>
										<?
									}
								} else if ($sort == 'buy_tree') {
									$trees = $db->query("SELECT * FROM log_trees WHERE user_id = '$users_ids' AND action = 1");
									?>
									<div class="tr_profile">
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Action</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Type</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Sum</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Date</span>
									</div>
									<?
									if ($trees->num_rows > 0) {
										for ($i = $trees->num_rows; $i > 0; $i--) {
										$tree = $trees->fetch_assoc();
										?>
										<div class="tr_profile">
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Buy tree</span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$tree['user_id']?></span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$tree['type']?></span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$tree['sum']?></span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $tree['date_trees'])?></span>
										</div>
										<?
									} } else {
										?>
										<div class="tr_profile">
											<span class="td_profile">No actions</span>
										</div>
										<?
									}
								} else if ($sort == 'sell_tree') {
									$trees = $db->query("SELECT * FROM log_trees WHERE user_id = '$users_ids' AND action = 2");
									?>
									<div class="tr_profile">
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Action</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Type</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Sum</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Date</span>
									</div>
									<?
									if ($trees->num_rows > 0) {
										for ($i = $trees->num_rows; $i > 0; $i--) {
										$tree = $trees->fetch_assoc();
										?>
										<div class="tr_profile">
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Sell tree</span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$tree['user_id']?></span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$tree['type']?></span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$tree['sum']?></span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $tree['date_trees'])?></span>
										</div>
										<?
									} } else {
										?>
										<div class="tr_profile">
											<span class="td_profile">No actions</span>
										</div>
										<?
									}
								} else if ($sort == 'collect_fruit') {
									$storage = $db->query("SELECT * FROM log_storage WHERE user_id = '$users_ids' AND action = 1");
									?>
									<div class="tr_profile">
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Action</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Sum</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Date</span>
									</div>
									<?
									if ($storage->num_rows > 0) {
										for ($i = $storage->num_rows; $i > 0; $i--) {
										$frt = $storage->fetch_assoc();
										?>
										<div class="tr_profile">
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Collect fruits</span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$frt['user_id']?></span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$frt['sum']?></span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $frt['date_storage'])?></span>
										</div>
										<?
									} } else {
										?>
										<div class="tr_profile">
											<span class="td_profile">No actions</span>
										</div>
										<?
									}
								} else if ($sort == 'sell_fruit') {
									$storage = $db->query("SELECT * FROM log_storage WHERE user_id = '$users_ids' AND action = 2");
									?>
									<div class="tr_profile">
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Action</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Sum</span>
										<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Date</span>
									</div>
									<?
									if ($storage->num_rows > 0) {
										for ($i = $storage->num_rows; $i > 0; $i--) {
										$frt = $storage->fetch_assoc();
										?>
										<div class="tr_profile">
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Sell fruits</span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$frt['user_id']?></span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$frt['sum']?></span>
											<span class="td_profile" style="border-bottom: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $frt['date_storage'])?></span>
										</div>
										<?
									} } else {
										?>
										<div class="tr_profile">
											<span class="td_profile">No actions</span>
										</div>
										<?
									}
								} else {
									$crbattles = $db->query("SELECT * FROM log_battles WHERE user_id = '$users_ids'");
								$trees = $db->query("SELECT * FROM log_trees WHERE user_id = '$users_ids'");
								$storage = $db->query("SELECT * FROM log_storage WHERE user_id = '$users_ids'");
								?>
								<div class="tr_profile">
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Action</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Battle ID</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Sum</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Date</span>
								</div>
								<?
								if ($crbattles->num_rows > 0) {
									for ($i = $crbattles->num_rows; $i > 0; $i--) {
									$btlle = $crbattles->fetch_assoc();
									?>
									<div class="tr_profile">
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$btlle['action'] == 1 ? 'Create battle' : 'Join battle'?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$btlle['user_id']?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$btlle['battle_id']?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$btlle['sum']?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $btlle['date_battle'])?></span>
									</div>
									<?
								} } else {
									?>
									<div class="tr_profile">
										<span class="td_profile">No actions</span>
									</div>
									<?
								}
								?>
								<div class="tr_profile" style="margin-top: 10px">
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Action</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Type</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Sum</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Date</span>
								</div>
								<?
								if ($trees->num_rows > 0) {
									for ($i = $trees->num_rows; $i > 0; $i--) {
									$tree = $trees->fetch_assoc();
									?>
									<div class="tr_profile">
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$tree['action'] == 1 ? 'Buy tree' : 'Sell tree'?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$tree['user_id']?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$tree['type']?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$tree['sum']?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $tree['date_trees'])?></span>
									</div>
									<?
								} } else {
									?>
									<div class="tr_profile">
										<span class="td_profile">No actions</span>
									</div>
									<?
								}
								?>
								<div class="tr_profile" style="margin-top: 10px">
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Action</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Sum</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Date</span>
								</div>
								<?
								if ($storage->num_rows > 0) {
									for ($i = $storage->num_rows; $i > 0; $i--) {
									$frt = $storage->fetch_assoc();
									?>
									<div class="tr_profile">
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$frt['action'] == 1 ? 'Collect fruit' : 'Sell fruits'?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$frt['user_id']?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$frt['sum']?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $frt['date_storage'])?></span>
									</div>
									<?
								} } else {
									?>
									<div class="tr_profile">
										<span class="td_profile">No actions</span>
									</div>
									<?
								}
								}
							} else {
								$crbattles = $db->query("SELECT * FROM log_battles WHERE user_id = '$users_ids'");
								$trees = $db->query("SELECT * FROM log_trees WHERE user_id = '$users_ids'");
								$storage = $db->query("SELECT * FROM log_storage WHERE user_id = '$users_ids'");
								?>
								<div class="tr_profile">
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Action</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Battle ID</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Sum</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Date</span>
								</div>
								<?
								if ($crbattles->num_rows > 0) {
									for ($i = $crbattles->num_rows; $i > 0; $i--) {
									$btlle = $crbattles->fetch_assoc();
									?>
									<div class="tr_profile">
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$btlle['action'] == 1 ? 'Create battle' : 'Join battle'?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$btlle['user_id']?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$btlle['battle_id']?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$btlle['sum']?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $btlle['date_battle'])?></span>
									</div>
									<?
								} } else {
									?>
									<div class="tr_profile">
										<span class="td_profile">No actions</span>
									</div>
									<?
								}
								?>
								<div class="tr_profile" style="margin-top: 10px">
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Action</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Type</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Sum</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Date</span>
								</div>
								<?
								if ($trees->num_rows > 0) {
									for ($i = $trees->num_rows; $i > 0; $i--) {
									$tree = $trees->fetch_assoc();
									?>
									<div class="tr_profile">
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$tree['action'] == 1 ? 'Buy tree' : 'Sell tree'?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$tree['user_id']?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$tree['type']?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$tree['sum']?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $tree['date_trees'])?></span>
									</div>
									<?
								} } else {
									?>
									<div class="tr_profile">
										<span class="td_profile">No actions</span>
									</div>
									<?
								}
								?>
								<div class="tr_profile" style="margin-top: 10px">
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Action</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User ID</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Sum</span>
									<span class="td_profile" style="border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Date</span>
								</div>
								<?
								if ($storage->num_rows > 0) {
									for ($i = $storage->num_rows; $i > 0; $i--) {
									$frt = $storage->fetch_assoc();
									?>
									<div class="tr_profile">
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$frt['action'] == 1 ? 'Collect fruit' : 'Sell fruits'?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$frt['user_id']?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;"><?=$frt['sum']?></span>
										<span class="td_profile" style="border-bottom: 3px solid #70523e;"><?=date('Y-m-d H:i:s', $frt['date_storage'])?></span>
									</div>
									<?
								} } else {
									?>
									<div class="tr_profile">
										<span class="td_profile">No actions</span>
									</div>
									<?
								}
							}
						?>
					</div>
					<?} else {?>
					<form class="table_buttons" action="" method="GET">
						<input class="table_button table_button_active" type="submit" value="All users" name="1">
						<input class="table_button" type="submit" value="User" name="1">
						<input class="table_button" type="submit" value="Deposit" name="1">
						<input class="table_button" type="submit" value="Withdraw" name="1">
						<input class="table_button" type="submit" value="Referrals" name="1">
						<input class="table_button" type="submit" value="Battles" name="1">
						<input class="table_button" type="submit" value="BattleHist" name="1">
						<input class="table_button" type="submit" value="Trees" name="1">
						<input class="table_button" type="submit" value="Storages" name="1">
					</form>
					<div class="table_profile">
						<?
							$users_b2 = $db->query("SELECT SUM(silver) AS silverSum, SUM(gold) AS goldSum FROM users_b;");
							$rows2 = $users_b2->fetch_assoc();
						?>
						<div class="tr_profile">
							<span style="margin: 10px 15px">All silver - <?=$rows2['silverSum']?></span>
							<span style="margin: 10px 15px">All gold - <?=$rows2['goldSum']?></span>
						</div>
						<div class="tr_profile">
							<span class="td_profile" style="width:8%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">User_ID</span>
							<span class="td_profile" style="width:12%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Username</span>
							<span class="td_profile" style="width:30%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Email</span>
							<span class="td_profile" style="width:15%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Silver</span>
							<span class="td_profile" style="width:15%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Gold</span>
							<span class="td_profile" style="width:8%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;border-right: 3px solid #70523e;">Ref_ID</span>
							<span class="td_profile" style="width:12%;border-top: 3px solid #70523e;border-bottom: 3px solid #70523e;">Ban</span>
						</div>
						<?if ($user->num_rows > 0) {
							for ($i = $user->num_rows; $i > 0; $i--) {
									$row = $user->fetch_assoc();
									$user_id = $row['user_id'];
									$users_b = $db->query("SELECT * FROM users_b WHERE user_id = '$user_id'");
									$row2 = $users_b->fetch_assoc();
						?>
						<div class="tr_profile">
							<span class="td_profile" style="border-right: 3px solid #70523e;width:8%;"><?=$row['user_id']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;width:12%;"><?=$row['username']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;width:30%;"><?=$row['email']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;width:15%;"><?=$row2['silver']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;width:15%;"><?=$row2['gold']?></span>
							<span class="td_profile" style="border-right: 3px solid #70523e;width:8%;"><?=$row['ref_id']?></span>
							<? if ($row['ban'] == 0) {?>
								<span class="td_profile" style="border-right: 3px solid #70523e;width:12%;color:#169a00;">Not Banned</span>
							<? } else { ?>
								<span class="td_profile" style="border-right: 3px solid #70523e;width:12%;color:#A60400;">Banned</span>
							<? } ?>
						</div>
						<?} } }?>
					</div>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
		<script src="../js/main.js"></script>
	</body>
</html>