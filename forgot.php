<?php
	session_start();
	require_once 'classes/configdb.php';
	if ($_SESSION['user']) {
		header('Location: /pages/mylands.php');
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
					mail("$email", "Recovery password", "Hello, $username!\n\nYou received this email because you (or someone pretending to be you) made a request to reset your password.\n\nIf the password recovery request was actually made by you, then pay attention to the link below:\nhttps://godsofrome.fun/newpassword.php?recovery_token=$key\n\nIf you have not sent a password recovery request, simply ignore this email.");
					$_SESSION['recovery_token'] = $key;
					$_SESSION['msg-s'] = 'The mail succeffuly send';
				} else {
					$_SESSION['msg'] = 'This email is not registered';
				}
			} else {
				$_SESSION['msg'] = 'Invalid email format';
			}
		} else {
			$_SESSION['msg'] = 'Email is not matches';
		}
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
			<div class="main-god"></div>
			<div class="main-cloud1"></div>
			<div class="main-cloud2"></div>
			<div class="main-reg">
				<div class="block-reg">
					<div class="block-reg-logo"></div>
					<div class="block-reg-container">
						<div class="form-reg">
							<div class="reg">
								<h1 class="h-reg">Password recovery</h1>
								<?if(isset($_SESSION['msg'])){?><h1 class="msg-f"><?=$_SESSION['msg']?></h1><?} unset($_SESSION['msg']);?>
								<?if(isset($_SESSION['msg-s'])){?><h1 class="msg-f msg-t"><?=$_SESSION['msg-s']?></h1><?} unset($_SESSION['msg-s']);?>
								<form class="form-main" action="/forgot.php" method="POST">
									<p class="form-text">E-MAIL</p>
									<input class="form-input" type="email" name="email" autocomplete="off" maxlength="25">
									<p class="form-text">CONFIRM E-MAIL</p>
									<input class="form-input" type="email" name="confirm_email" autocomplete="off" maxlength="25">
									<input class="reg-submit" type="submit" name="send" value="Send">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>