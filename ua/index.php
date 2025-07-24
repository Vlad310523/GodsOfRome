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

<html lang="ua">
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
							<option value="/ru">RU</option>
							<option value="/ua" selected>UA</option>
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
						<div class="block1_login"><a href="login.php">УВІЙТИ</a></div>
					</div>
				</div>
			</div>
			<div class="block2_top"></div>
			<div class="block2">
				<div class="block2_container">
					<div class="block2_text">Привіт, ми творці цього світу. Ви думали, що боги понад усе?
						Вони просто розважають нас своїми боями на арені. Дозвольте розповісти вам про це трохи докладніше...<br>
						Gods of Rome - це економічна гра із заробітком <span style="color:#f7b037;-webkit-text-stroke-width: 1px;-webkit-text-stroke-color: #000;">РЕАЛЬНИХ ГРОШЕЙ</span>, де ви можете стати або найкращим садівником, або легендарним воїном, якого неможливо перемогти.
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
							<div>Ми надамо вам власний острів, де ви зможете вирощувати дерева та збирати фрукти в мирі та гармонії, отримуючи <span style="color:#f7b037;-webkit-text-stroke-width: 1px;-webkit-text-stroke-color: #000;">ПАСИВНИЙ ДОХІД</span>.
								Також не забувайте збирати врожай.
								Якщо ви, звісно, не хочете його втратити...
								Вам доведеться керувати простором у саду так, щоб отримати максимальний прибуток.
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
						<div class="block4_text">Ми дамо вам можливість відчути себе в нашій шкурі і кинути виклик таким же щасливчикам на «Небесній арені», де ви зможете зробити ставку на бої між так званими богами.
							І так, щодо грошей... Наші торговці не приймають людські валюти, тому ми конвертуємо їх у місцеві монети.
							Ви дізнаєтеся більше, подорожуючи островами, тому не затримуйтеся тут і швидко вирушайте досліджувати це раніше невідоме місце.
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
							<div class="footer_title">Слідкуйте за нами:</div>
							<a href="https://www.tiktok.com/@godsofrome_" class="footer_links"><img src="/img/main_skreen/tiktok.png" alt="">TikTok</a>
							<a href="https://www.youtube.com/@godsofrome." class="footer_links"><img src="/img/main_skreen/youtube.png" alt="">YouTube</a>
						</div>
					</div>
					<div class="footer_bottom">
						<div class="footer_left">
							<div class="footer_text">Підтримка - support@godsofrome.fun</div>
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