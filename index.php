<?php
	session_start();
	if ($_SESSION['user']) {
		header('Location: /pages/mylands.php');
	}
	if ($_SERVER['REQUEST_URI'] == '/ru/') {
		$_SESSION['lang'] = '/ru';
	} else if ($_SERVER['REQUEST_URI'] == '/ua/') {
		$_SESSION['lang'] = '/ua';
	} else {
		$_SESSION['lang'] = '';
	}
?>

<!DOCTYPE html>

<html lang="en">
	<head>
		<title>Gods of Rome</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="img/icons/favicon.ico">
	</head>
	
	<body>
		<div class="main">
			<div class="block1">
				<div class="block1_container">
					<div class="block1_lang">
						<select class="change_lang" onchange="location=this.value">
							<option value="/" selected>EN</option>
							<option value="/ru">RU</option>
							<option value="/ua">UA</option>
						</select>
					</div>
					<div class="block1_col1"></div>
					<div class="block1_col2">
						<div class="block1_title"></div>
						<div class="block1_play">
							<div class="btn_play">
								<a href="/register.php"><img src="/img/play_now.png" alt="Play Now" width="100%"></a>
							</div>
						</div>
					</div>
					<div class="block1_col3">
						<div class="block1_login"><a href="/login.php">LOG IN</a></div>
					</div>
				</div>
			</div>
			<div class="block2_top"></div>
			<div class="block2">
				<div class="block2_container">
					<div class="block2_text">Hi, we are the creators of this world. Did you think that the gods are above all?
						They're just entertaining us with their arena fights. Let us tell you a little bit more about this...<br>
						Gods of Rome is an economic game with <span style="color:#f7b037;-webkit-text-stroke-width: 1px;-webkit-text-stroke-color: #000;">REAL MONEY</span> earning, where you can become either the greatest gardener or a legendary warrior who cannot be defeated.
					</div>
				</div>
			</div>
			<div class="block2_line"></div>
			<div class="block3">
				<div class="block3_container">
					<div class="block3_title">God's gardens</div>
					<div class="block3_main">
						<div class="block3_island"></div>
						<div class="block3_text">
							<div>We will provide you with your own island, where you can grow trees and collect fruits in peace and harmony, earning <span style="color:#f7b037;-webkit-text-stroke-width: 1px;-webkit-text-stroke-color: #000;">PASSIVE INCOME</span>.
								Also, don’t forget to collect your harvest.
								If you don’t want to lose it, of course...
								You will have to manage your garden space to make the most profit possible for your budget.
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="block2_line"></div>
			<div class="block3">
				<div class="block4_container">
					<div class="block3_title">Heavenly arena</div>
					<div class="block3_main">
						<div class="block4_text">We will also give you the opportunity to feel yourself in our shoes and challenge the same lucky ones in the “Heavenly Arena” where you will be able to bet on fights between the so-called gods.
							And yes, about the budget... Our merchants do not accept human currencies, so we convert them into local coins.
							You will learn more as you travel around the islands, so don’t linger here and quickly go explore this previously unknown place.
						</div>
						<div class="block4_god"></div>
					</div>
				</div>
			</div>
			<div class="block2_line"></div>
			<div class="footer">
				<div class="footer_main">
					<div class="footer_top">
						<div class="footer_left">
							<div class="footer_logo"></div>
						</div>
						<div class="footer_right">
							<div class="footer_title">Follow us:</div>
							<a href="https://www.tiktok.com/@godsofrome_" class="footer_links"><img src="/img/main_skreen/tiktok.png" alt="">TikTok</a>
							<a href="https://www.youtube.com/@godsofrome." class="footer_links"><img src="/img/main_skreen/youtube.png" alt="">YouTube</a>
						</div>
					</div>
					<div class="footer_bottom">
						<div class="footer_left">
							<div class="footer_text">Support - support@godsofrome.fun</div>
						</div>
						<div class="footer_right">
							<div class="footer_text">© Copyrights 2024 GodsOfRome - All Rights Reserved</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>