<?php
	session_start();
	require_once '../classes/configdb.php';
	$lang = $_SESSION['lang'];
	if (isset($_POST['tree_id'])) {
		$tree_id = intval($_POST['tree_id']);
		$user_id = intval($_SESSION['user']);
		$users_b = $db->query("SELECT * FROM users_b WHERE user_id = '$user_id'");
		$row2 = $users_b->fetch_assoc();
		$trees = $db->query("SELECT * FROM trees WHERE user_id = '$user_id'");
		$tree = $trees->fetch_assoc();
		if ($tree_id === 5) {
			$check = $tree['tree5'];
		} else if ($tree_id === 4) {
			$check = $tree['tree4'];
		} else if ($tree_id === 3) {
			$check = $tree['tree3'];
		} else if ($tree_id === 2) {
			$check = $tree['tree2'];
		} else {
			$check = $tree['tree1'];
		}
		if ($check !== 0) {
			$treenum = intval($_POST['tree_num']);
			if ($_POST['tree_num'] == 5) {
				if ($row2['silver'] >= 100000) {
					$db->query("UPDATE users_b SET silver = silver - 100000 WHERE user_id = '$user_id'");
					$time = time() + (60 * 60 * 48);
					$db->query("UPDATE trees SET tree".$tree_id." = '$treenum', tree".$tree_id."_time = '$time'  WHERE user_id = '$user_id'");
					$vremya = time();
					$db->Query("INSERT INTO log_trees (action, user_id, type, sum, date_trees) 
						VALUES (1, '$user_id', '$treenum', 100000, '$vremya')");
					header("Location: $lang/pages/island.php");
				} else {
					$_SESSION['msgbtf'] = 'You don`t have enough silver';
					header("Location: $lang/pages/island.php");
				}
			} else if ($_POST['tree_num'] == 4) {
				if ($row2['silver'] >= 50000) {
					$db->query("UPDATE users_b SET silver = silver - 50000 WHERE user_id = '$user_id'");
					$time = time() + (60 * 60 * 24);
					$db->query("UPDATE trees SET tree".$tree_id." = '$treenum', tree".$tree_id."_time = '$time'  WHERE user_id = '$user_id'");
					$vremya = time();
					$db->Query("INSERT INTO log_trees (action, user_id, type, sum, date_trees) 
						VALUES (1, '$user_id', '$treenum', 50000, '$vremya')");
					header("Location: $lang/pages/island.php");
				} else {
					$_SESSION['msgbtf'] = 'You don`t have enough silver';
					header("Location: $lang/pages/island.php");
				}
			} else if ($_POST['tree_num'] == 3) {
				if ($row2['silver'] >= 20000) {
					$db->query("UPDATE users_b SET silver = silver - 20000 WHERE user_id = '$user_id'");
					$time = time() + (60 * 60 * 12);
					$db->query("UPDATE trees SET tree".$tree_id." = '$treenum', tree".$tree_id."_time = '$time'  WHERE user_id = '$user_id'");
					$vremya = time();
					$db->Query("INSERT INTO log_trees (action, user_id, type, sum, date_trees) 
						VALUES (1, '$user_id', '$treenum', 20000, '$vremya')");
					header("Location: $lang/pages/island.php");
				} else {
					$_SESSION['msgbtf'] = 'You don`t have enough silver';
					header("Location: $lang/pages/island.php");
				}
			} else if ($_POST['tree_num'] == 2) {
				if ($row2['silver'] >= 10000) {
					$db->query("UPDATE users_b SET silver = silver - 10000 WHERE user_id = '$user_id'");
					$time = time() + (60 * 60 * 6);
					$db->query("UPDATE trees SET tree".$tree_id." = '$treenum', tree".$tree_id."_time = '$time'  WHERE user_id = '$user_id'");
					$vremya = time();
					$db->Query("INSERT INTO log_trees (action, user_id, type, sum, date_trees) 
						VALUES (1, '$user_id', '$treenum', 10000, '$vremya')");
					header("Location: $lang/pages/island.php");
				} else {
					$_SESSION['msgbtf'] = 'You don`t have enough silver';
					header("Location: $lang/pages/island.php");
				}
			} else {
				if ($row2['silver'] >= 5000) {
					$db->query("UPDATE users_b SET silver = silver - 5000 WHERE user_id = '$user_id'");
					$time = time() + (60 * 60 * 3);
					$db->query("UPDATE trees SET tree".$tree_id." = '$treenum', tree".$tree_id."_time = '$time'  WHERE user_id = '$user_id'");
					$vremya = time();
					$db->Query("INSERT INTO log_trees (action, user_id, type, sum, date_trees) 
						VALUES (1, '$user_id', '$treenum', 5000, '$vremya')");
					header("Location: $lang/pages/island.php");
				} else {
					$_SESSION['msgbtf'] = 'You don`t have enough silver';
					header("Location: $lang/pages/island.php");
				}
			}
		} else {
			$_SESSION['msgbtf'] = 'Unknown error';
			header("Location: $lang/pages/island.php");
		}
	} else {
		$_SESSION['msgbtf'] = 'Unknown error';
		header("Location: $lang/pages/island.php");
	}
?>