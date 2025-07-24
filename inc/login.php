<?php
	session_start();
	require_once '../classes/configdb.php';
	$lang = $_SESSION['lang'];
	$email = strip_tags($_POST['email']);
	$email = htmlspecialchars($email);
	$user = $db->query("SELECT * FROM users WHERE email = '$email'");
	$row = $user->fetch_assoc();
	if(isset($_POST['login'])) {
		if($user->num_rows > 0) {
			if(password_verify($_POST['password'], $row['password'])) {
				if($row['ban'] != 1) {
					$_SESSION["user"] = $row['user_id'];
					exit(header("Location: $lang/pages/mylands.php"));
				} else {
					$_SESSION['msg'] = 'You have been banned';
					header("Location: $lang/login.php");
				}
			} else {
				$_SESSION['msg'] = 'Incorrect email or password';
				header("Location: $lang/login.php");
			}
		} else {
			$_SESSION['msg'] = 'Incorrect email or password';
			header("Location: $lang/login.php");
		}
	}
	if(isset($_POST['forgot'])) {
		header("Location: $lang/forgot.php");
	}
?>