<?php
	session_start();
	require_once '../classes/configdb.php';
	$lang = $_SESSION['lang'];
	if($_POST['login'] !== '') {
		if($_POST['email'] !== '') {
			$check_email = $_POST['email'];
			if(filter_var($check_email, FILTER_VALIDATE_EMAIL)) {
				if($_POST['password'] !== '') {
					if (mb_strlen($_POST['password']) > 7) {
						if($_POST['check']) {
							$login = strip_tags($_POST['login']);
							$login = htmlspecialchars($login);
							$email = strip_tags($_POST['email']);
							$email = htmlspecialchars($email);
							$password = $_POST['password'];
							$users = $db->query("SELECT * FROM users WHERE username = '$login'");
							if($users->num_rows == 0) {
								$users = $db->query("SELECT * FROM users WHERE email = '$email'");
								if($users->num_rows == 0) {
									$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
									if ($_POST['ref_id'] !== '') {
										$ref_id = intval($_POST['ref_id']);
										$ref = $db->query("SELECT * FROM users WHERE user_id = '$ref_id'");
										if($ref->num_rows == 1) {
											$db->Query("INSERT INTO users (username, password, email, ref_id) VALUES ('$login', '$password', '$email', '$ref_id')");
											$user = $db->query("SELECT * FROM users WHERE username = '$login'");
											$row = $user->fetch_assoc();
											$user_id = $row['user_id'];
											$db->Query("INSERT INTO users_b (user_id, username, silver, gold) VALUES ('$user_id', '$login', 0, 0)");
											$db->Query("INSERT INTO referrals (ref_id, user_id, deposit) VALUES ('$ref_id', '$user_id', 0)");
											$time = time() + (60 * 60 * 3);
											$db->Query("INSERT INTO trees (user_id, tree1, tree2, tree3, tree4, tree5, tree1_time, tree2_time, tree3_time, tree4_time, tree5_time) VALUES ('$user_id', 1, 0, 0, 0, 0, '$time', 0, 0, 0, 0)");
											$db->Query("INSERT INTO storage_fruits (user_id, fruit1, fruit2, fruit3, fruit4, fruit5) VALUES ('$user_id', 0, 0, 0, 0, 0)");
											$vremya = time();
											$db->Query("INSERT INTO log_trees (action, user_id, type, sum, date_trees) 
												VALUES (1, '$user_id', '1', 5000, '$vremya')");
											$db->Query("INSERT INTO tutor (user_id, tutor_id, status) VALUES ('$user_id', 1, 0)");
											$db->Query("INSERT INTO tutor (user_id, tutor_id, status) VALUES ('$user_id', 2, 0)");
										} else {
											$_SESSION['msg'] = 'Referal with this ID doesn\'t exist';
											header("Location: $lang/register.php");
											exit();
										}
									} else {
										$db->Query("INSERT INTO users (username, password, email, ref_id) VALUES ('$login', '$password', '$email', 0)");
										$user = $db->query("SELECT * FROM users WHERE username = '$login'");
										$row = $user->fetch_assoc();
										$user_id = $row['user_id'];
										$db->Query("INSERT INTO users_b (user_id, username, silver, gold) VALUES ('$user_id', '$login', 0, 0)");
										$time = time() + (60 * 60 * 3);
										$db->Query("INSERT INTO trees (user_id, tree1, tree2, tree3, tree4, tree5, tree1_time, tree2_time, tree3_time, tree4_time, tree5_time) VALUES ('$user_id', 1, 0, 0, 0, 0, '$time', 0, 0, 0, 0)");
										$db->Query("INSERT INTO storage_fruits (user_id, fruit1, fruit2, fruit3, fruit4, fruit5) VALUES ('$user_id', 0, 0, 0, 0, 0)");
										$vremya = time();
											$db->Query("INSERT INTO log_trees (action, user_id, type, sum, date_trees) 
												VALUES (1, '$user_id', '1', 5000, '$vremya')");
										$db->Query("INSERT INTO tutor (user_id, tutor_id, status) VALUES ('$user_id', 1, 0)");
										$db->Query("INSERT INTO tutor (user_id, tutor_id, status) VALUES ('$user_id', 2, 0)");
									}
									$_SESSION['msg-s'] = 'Succefully register';
									header("Location: $lang/login.php");
								} else {
									$_SESSION['msg'] = 'This email is already use';
									header("Location: $lang/register.php");
								}
							} else {
								$_SESSION['msg'] = 'This username is already use';
								header("Location: $lang/register.php");
							}
						} else {
							$_SESSION['msg'] = 'You need accept Terms and Conditions';
							header("Location: $lang/register.php");
						}
					} else {
						$_SESSION['msg'] = 'Password must be more than 8 characters';
						header("Location: $lang/register.php");
					}
				} else {
					$_SESSION['msg'] = 'Insert password';
					header("Location: $lang/register.php");
				}
			} else {
				$_SESSION['msg'] = 'Invalid email format';
				header("Location: $lang/register.php");
			}
		} else {
			$_SESSION['msg'] = 'Insert email';
			header("Location: $lang/register.php");
		}
	} else {
		$_SESSION['msg'] = 'Insert username';
		header("Location: $lang/register.php");
	}
?>