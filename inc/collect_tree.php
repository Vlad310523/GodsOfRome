<?php
	session_start();
	require_once '../classes/configdb.php';
	$lang = $_SESSION['lang'];
	if (isset($_POST['collect'])) {
		$tree_id = intval($_POST['tree_id']);
		$user_id = intval($_SESSION['user']);
		$trees = $db->query("SELECT * FROM trees WHERE user_id = '$user_id'");
		$tree = $trees->fetch_assoc();
		if ($tree['tree'.$tree_id.'_time'] < time() && time() < $tree['tree'.$tree_id.'_time'] + 86400) {
			$tree_val = $tree['tree'.$tree_id];
			if ($tree_val == 1) {
				$time = time() + (60 * 60 * 3);
				$kol = 3;
				$vremya = time();
				$db->Query("INSERT INTO log_storage (action, user_id, date_storage, sum) 
					VALUES (1, '$user_id', '$vremya', 3)");
			} else if ($tree_val == 2) {
				$time = time() + (60 * 60 * 6);
				$kol = 12;
				$vremya = time();
				$db->Query("INSERT INTO log_storage (action, user_id, date_storage, sum) 
					VALUES (1, '$user_id', '$vremya', 12)");
			} else if ($tree_val == 3) {
				$time = time() + (60 * 60 * 12);
				$kol = 48;
				$vremya = time();
				$db->Query("INSERT INTO log_storage (action, user_id, date_storage, sum) 
					VALUES (1, '$user_id', '$vremya', 48)");
			} else if ($tree_val == 4) {
				$time = time() + (60 * 60 * 24);
				$kol = 240;
				$vremya = time();
				$db->Query("INSERT INTO log_storage (action, user_id, date_storage, sum) 
					VALUES (1, '$user_id', '$vremya', 240)");
			} else {
				$time = time() + (60 * 60 * 48);
				$kol = 960;
				$vremya = time();
				$db->Query("INSERT INTO log_storage (action, user_id, date_storage, sum) 
					VALUES (1, '$user_id', '$vremya', 960)");
			}
			$db->query("UPDATE storage_fruits SET fruit".$tree_val." = fruit".$tree_val." + '$kol' WHERE user_id = '$user_id'");
			$db->query("UPDATE trees SET tree".$tree_id."_time = '$time' WHERE user_id = '$user_id'");
			header("Location: $lang/pages/island.php");
		} else if (time() > $tree['tree'.$tree_id.'_time'] + 86400) {
			$tree_val = $tree['tree'.$tree_id];
			if ($tree_val == 1) {
				$time = time() + (60 * 60 * 3);
				$kol = 3;
			} else if ($tree_val == 2) {
				$time = time() + (60 * 60 * 6);
				$kol = 12;
			} else if ($tree_val == 3) {
				$time = time() + (60 * 60 * 12);
				$kol = 48;
			} else if ($tree_val == 4) {
				$time = time() + (60 * 60 * 24);
				$kol = 240;
			} else {
				$time = time() + (60 * 60 * 48);
				$kol = 960;
			}
			$db->query("UPDATE trees SET tree".$tree_id."_time = '$time' WHERE user_id = '$user_id'");
			header("Location: $lang/pages/island.php");
		} else {
			$_SESSION['msgctf'] = 'Wait until fruits ripe';
			$_SESSION['tree2'] = $tree_id;
			header("Location: $lang/pages/island.php");
		}
	}
	if (isset($_POST['sell'])) {
		$tree_id = intval($_POST['tree_id']);
		$user_id = intval($_SESSION['user']);
		$users_b = $db->query("SELECT * FROM users_b WHERE user_id = '$user_id'");
		$row2 = $users_b->fetch_assoc();
		$trees = $db->query("SELECT * FROM trees WHERE user_id = '$user_id'");
		$tree = $trees->fetch_assoc();
		if ($tree['tree'.$tree_id] != 0) {
			if ($tree['tree'.$tree_id] == 5) {
				$tree_cost = 10000;
			} else if ($tree['tree'.$tree_id] == 4) {
				$tree_cost = 5000;
			} else if ($tree['tree'.$tree_id] == 3) {
				$tree_cost = 2000;
			} else if ($tree['tree'.$tree_id] == 2) {
				$tree_cost = 1000;
			} else if ($tree['tree'.$tree_id] == 1) {
				$tree_cost = 500;
			} else {
				$tree_cost = 0;
			}
			$treenum = $tree['tree'.$tree_id];
			$vremya = time();
			$db->Query("INSERT INTO log_trees (action, user_id, type, sum, date_trees) 
				VALUES (2, '$user_id', '$treenum', '$tree_cost', '$vremya')");
			$db->query("UPDATE trees SET tree".$tree_id." = 0, tree".$tree_id."_time = 0  WHERE user_id = '$user_id'");
			$db->query("UPDATE users_b SET silver = silver + '$tree_cost' WHERE user_id = '$user_id'");
			header("Location: $lang/pages/island.php");
		} else {
			$_SESSION['msgctf'] = 'Error';
			header("Location: $lang/pages/island.php");
		}
	}
	if (isset($_POST['dia_no'])) {
		header("Location: $lang/pages/island.php");
	}
?>