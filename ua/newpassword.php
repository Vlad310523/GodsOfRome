<?php
	session_start();
	require_once '../classes/configdb.php';
	if ($_SESSION['user']) {
		header('Location: pages/mylands.php');
	}
	if (isset($_GET['recovery_token'])) {
		if ($_SESSION['recovery_token'] === $_GET['recovery_token']) {
			$pass_id = strip_tags($_GET['recovery_token']);
			$pass_id = htmlspecialchars($pass_id);
			$user = $db->query("SELECT * FROM users WHERE key_forgot = '$pass_id'");
			if ($user->num_rows > 0) {
				$row = $user->fetch_assoc();
			} else {
				header('Location: index.php');
			}
		} else {
			header('Location: index.php');
		}
	} else {
		header('Location: index.php');
	}
	if (isset($_POST['change'])) {
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];
		if ($password !== '') {
			if ($password === $cpassword) {
				if (mb_strlen($_POST['password']) > 7) {
					$pass_id = strip_tags($_SESSION['recovery_token']);
					$pass_id = htmlspecialchars($pass_id);
					$pass = password_hash($password, PASSWORD_DEFAULT);
					$db->query("UPDATE users SET password = '$pass', key_forgot = '' WHERE key_forgot = '$pass_id'");
					unset($_SESSION['recovery_token']);
					$_SESSION['msg-s'] = 'Пароль успішно змінено';
					header('Location: login.php');
				} else {
					$_SESSION['msg'] = 'Пароль повинен містити більше 8 символів';
				}
			} else {
				$_SESSION['msg'] = 'Пароль не збігається';
			}
		} else {
			$_SESSION['msg'] = 'Пароль не повинен бути порожнім';
		}
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
								<h1 class="h-reg">Змінити пароль</h1>
								<?if(isset($_SESSION['msg'])){?><h1 class="msg-f"><?=$_SESSION['msg']?></h1><?} unset($_SESSION['msg']);?>
								<form class="form-main" action="" method="POST">
									<p class="form-text">Пароль</p>	
									<input class="form-input" type="password" name="password" autocomplete="off" maxlength="15">
									<p class="form-text">Підтвердити пароль</p>	
									<input class="form-input" type="password" name="cpassword" autocomplete="off" maxlength="15">
									<input class="reg-submit" type="submit" name="change" value="Змінити">
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