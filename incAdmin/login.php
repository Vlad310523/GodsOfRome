<?php
	session_start();
	require_once '../classes/configdb.php';
	$admin = $db->query("SELECT * FROM adminKaa179 WHERE id = 1");
	$row = $admin->fetch_assoc();
	if(isset($_POST['login'])) {
		if($admin->num_rows > 0) {
			if(password_verify($_POST['email'], $row['admin_user971'])) {
				if(password_verify($_POST['password'], $row['admin_pass971'])) {
					$_SESSION["admin"] = $row['admin_user971'];
					exit(header('Location: /adMi3nK4aa179/mainAdminKaa.php'));
				} else {
					$_SESSION['msg'] = '!!!Incorrect!!!';
					header('Location: ../adMi3nK4aa179/loginAdmin.php');
				}
			} else {
				$_SESSION['msg'] = '!!!Incorrect!!!';
				header('Location: ../adMi3nK4aa179/loginAdmin.php');
			}
		} else {
			$_SESSION['msg'] = '!!!Incorrect!!!';
			header('Location: ../adMi3nK4aa179/loginAdmin.php');
		}
	}
?>