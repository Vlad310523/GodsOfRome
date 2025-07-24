<?php
	session_start();
	if ($_SESSION['user']) {
		header('Location: pages/mylands.php');
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
			<div class="main-god"></div>
			<div class="main-cloud1"></div>
			<div class="main-cloud2"></div>
			<div class="main-reg">
				<div class="block-reg">
					<div class="block-reg-logo"></div>
					<div class="block-reg-container">
						<div class="form-reg">
							<div class="reg">
								<h1 class="h-reg"><a href="register.php" class="but1 blur">Регистрация</a> | <a href="#" class="but1" style="cursor: default;">Войти</a></h1>
								<?if(isset($_SESSION['msg'])){?><h1 class="msg-f"><?=$_SESSION['msg']?></h1><?} unset($_SESSION['msg']);?>
								<?if(isset($_SESSION['msg-s'])){?><h1 class="msg-f msg-t"><?=$_SESSION['msg-s']?></h1><?} unset($_SESSION['msg-s']);?>
								<form class="form-main" action="/inc/login.php" method="POST">
									<p class="form-text">E-MAIL</p>
									<input class="form-input" type="email" name="email" autocomplete="off" maxlength="25">
									<p class="form-text">Пароль</p>
									<input class="form-input" type="password" name="password" autocomplete="off" maxlength="15">
									<a class="form-text-forgot" href="forgot.php">Забыли пароль?</a>
									<input class="reg-submit" type="submit" name="login" value="Войти">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
		<script src="/js/main.js"></script>
	</body>
</html>