<?php
	session_start();
	require_once '../classes/configdb.php';
	if ($_SESSION['user']) {
		header('Location: pages/mylands.php');
	}
	if (isset($_POST['send'])) {
		$email = strip_tags($_POST['email']);
		$email = htmlspecialchars($email);
		$confirm_email = strip_tags($_POST['confirm_email']);
		$confirm_email = htmlspecialchars($confirm_email);
		if ($email === $confirm_email) {
			$checkemail1 = $_POST['email'];
			if(filter_var($checkemail1, FILTER_VALIDATE_EMAIL)) {
				$user = $db->query("SELECT * FROM users WHERE email = '$email'");
				if ($user->num_rows > 0) {
					$row = $user->fetch_assoc();
					$user_id = $row['user_id'];
					$username = $row['username'];
					$key = md5($email.rand(100, 99999));
					$db->query("UPDATE users SET key_forgot = '$key' WHERE user_id = '$user_id'");
					mail("$email", "Відновлення пароля", "Привіт, $username!\n\nВи отримали цей лист, тому що ви (або хтось, хто видає себе за вас) надіслали запит на відновлення пароля.\n\nЯкщо запит на відновлення пароля дійсно був надісланий вами, то зверніть увагу на посилання нижче:\nhttps://godsofrome.fun/newpassword.php?recovery_token=$key\n\nЯкщо ви не надсилали запит на відновлення пароля, просто проігноруйте цей лист.");
					$_SESSION['recovery_token'] = $key;
					$_SESSION['msg-s'] = 'Повідомлення успішно відправлено';
				} else {
					$_SESSION['msg'] = 'Ця електронна адреса не зареєстрована';
				}
			} else {
				$_SESSION['msg'] = 'Неправильний формат електронної пошти';
			}
		} else {
			$_SESSION['msg'] = 'Електронна пошта не збігається';
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
								<h1 class="h-reg">Відновлення пароля</h1>
								<?if(isset($_SESSION['msg'])){?><h1 class="msg-f"><?=$_SESSION['msg']?></h1><?} unset($_SESSION['msg']);?>
								<?if(isset($_SESSION['msg-s'])){?><h1 class="msg-f msg-t"><?=$_SESSION['msg-s']?></h1><?} unset($_SESSION['msg-s']);?>
								<form class="form-main" action="forgot.php" method="POST">
									<p class="form-text">E-MAIL</p>
									<input class="form-input" type="email" name="email" autocomplete="off" maxlength="25">
									<p class="form-text">Підтвердити E-MAIL</p>
									<input class="form-input" type="email" name="confirm_email" autocomplete="off" maxlength="25">
									<input class="reg-submit" type="submit" name="send" value="Відправити">
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