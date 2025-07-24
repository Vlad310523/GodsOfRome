<?php
	session_start();
	if ($_SESSION['user']) {
		header('Location: /pages/mylands.php');
	}
	if (isset($_GET['ref'])) {
		$ref = intval($_GET['ref']);
		setcookie("ref", $ref, time()+60*60);
		header("Location: /register.php");
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
								<h1 class="msg-t">Register to get a bonus Pear tree!</h1>
								<h1 class="h-reg"><a href="#" class="but1" style="cursor: default;">Register</a> | <a href="/login.php" class="but1 blur">Login</a></h1>
								<?if(isset($_SESSION['msg'])){?><h1 class="msg-f"><?=$_SESSION['msg']?></h1><?} unset($_SESSION['msg']);?>
								<form class="form-main form-register" action="inc/register.php" method="POST">
									<p class="form-text">LOGIN</p>
									<input class="form-input" type="text" name="login" autocomplete="off" maxlength="15">
									<p class="form-text">E-MAIL</p>
									<input class="form-input" type="email" name="email" autocomplete="off" maxlength="25">
									<p class="form-text">PASSWORD</p>	
									<input class="form-input" type="password" name="password" autocomplete="off" maxlength="15">
									<p class="form-text">REFERAL ID</p>	
									<input class="form-input" type="text" name="ref_id" autocomplete="off" value="<?=$_COOKIE['ref']?>" maxlength="15">
									<label class="checkbox">
										<input name="check" type="checkbox">
										I accept the <a href="/terms.php">Terms and Conditions</a>
									</label>
									<input class="reg-submit" type="submit" value="Register">
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