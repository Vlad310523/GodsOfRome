<?php
	session_start();
	if ($_SESSION['user']) {
		header('Location: pages/mylands.php');
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

<html lang="ru">
	<head>
		<title>Gods of Rome</title>
		<link rel="stylesheet" type="text/css" href="/css/style.css">
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="/img/icons/favicon.ico">
	</head>
	
	<body>
		<div class="main">
			<div class="block1">
				<div class="block1_container">
					<div class="block1_lang">
						<select class="change_lang" onchange="location=this.value">
							<option value="/">EN</option>
							<option value="/ru" selected>RU</option>
							<option value="/ua">UA</option>
						</select>
					</div>
					<div class="block1_col1"></div>
					<div class="block1_col2">
						<div class="block1_title"></div>
						<div class="block1_play">
							<div class="btn_play">
								<a href="register.php"><img src="/img/play_now.png" alt="Play Now" width="100%"></a>
							</div>
						</div>
					</div>
					<div class="block1_col3">
						<div class="block1_login"><a href="login.php">ВОЙТИ</a></div>
					</div>
				</div>
			</div>
			<div class="block2_top"></div>
			<div class="block2">
				<div class="block2_container">
					<div class="block2_text">Привет, мы создатели этого мира. Вы думали, что боги превыше всего?
						Они просто развлекают нас своими боями на арене. Позвольте рассказать вам об этом немного подробнее…<br>
						Gods of Rome – это экономическая игра с заработком <span style="color:#f7b037;-webkit-text-stroke-width: 1px;-webkit-text-stroke-color: #000;">РЕАЛЬНЫХ ДЕНЕГ</span>, где вы можете стать либо величайшим садовником, либо легендарным воином, которого невозможно победить.
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
							<div>Мы предоставим вам собственный остров, где вы сможете выращивать деревья и собирать фрукты в мире и гармонии, получая <span style="color:#f7b037;-webkit-text-stroke-width: 1px;-webkit-text-stroke-color: #000;">ПАССИВНЫЙ ДОХОД</span>.
								Также не забывайте собирать урожай.
								Если вы, конечно, не хотите его потерять…
								Вам придется управлять пространством в саду так, чтобы получить максимальную прибыль.
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
						<div class="block4_text">Мы дадим вам возможность почувствовать себя в нашей шкуре и бросить вызов таким же счастливчикам на «Небесной арене», где вы сможете сделать ставку на бои между так называемыми богами.
							И да, насчет денег... Наши торговцы не принимают человеческие валюты, поэтому мы конвертируем их в местные монеты.
							Вы узнаете больше, путешествуя по островам, поэтому не задерживайтесь здесь и быстро отправляйтесь исследовать это ранее неизвестное место.
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
							<div class="footer_title">Следите за нами:</div>
							<a href="https://www.tiktok.com/@godsofrome_" class="footer_links"><img src="/img/main_skreen/tiktok.png" alt="">TikTok</a>
							<a href="https://www.youtube.com/@godsofrome." class="footer_links"><img src="/img/main_skreen/youtube.png" alt="">YouTube</a>
						</div>
					</div>
					<div class="footer_bottom">
						<div class="footer_left">
							<div class="footer_text">Поддержка - support@godsofrome.fun</div>
						</div>
						<div class="footer_right">
							<div class="footer_text">© Copyrights 2024 GodsOfRome - All Rights Reserved</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
		<script src="/js/main.js"></script>
	</body>
</html>