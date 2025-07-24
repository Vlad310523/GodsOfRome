<?php
	session_start();
	require_once '../classes/configdb.php';
	$lang = $_SESSION['lang'];
	$user_id = intval($_SESSION['user']);
	$storages = $db->query("SELECT * FROM storage_fruits WHERE user_id = '$user_id'");
	$storage = $storages->fetch_assoc();
	$sum = $storage['fruit1'] + $storage['fruit2'] + $storage['fruit3'] + $storage['fruit4'] + $storage['fruit5'];
	if (isset($_POST['sell'])) {
		if ($sum > 0) {
			$vremya = time();
			$db->Query("INSERT INTO log_storage (action, user_id, date_storage, sum) 
				VALUES (2, '$user_id', '$vremya', '$sum')");
			$db->query("UPDATE storage_fruits SET fruit1 = 0, fruit2 = 0, fruit3 = 0, fruit4 = 0, fruit5 = 0 WHERE user_id = '$user_id'");
			$db->query("UPDATE users_b SET silver = silver + '$sum' WHERE user_id = '$user_id'");
			$_SESSION['msgit'] = 'You sell all fruits!';
			header("Location: $lang/pages/island.php");
		} else {
			$_SESSION['msgitf'] = 'You don`t have any fruits!';
			header("Location: $lang/pages/island.php");
		}
	} else {
		header("Location: $lang/pages/island.php");
	}
?>