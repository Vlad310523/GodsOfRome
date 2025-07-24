<?php
	session_start();
	if (!$_SESSION['user']) {
		header('Location: ../index.php');
	}
	require_once '../../classes/configdb.php';
	$user_id = intval($_SESSION['user']);
	$user = $db->query("SELECT * FROM users WHERE user_id = '$user_id'");
	$row = $user->fetch_assoc();
	if ($row['ban'] == 1) {
		header('Location: ../../inc/logout.php');
	}
	$users_b = $db->query("SELECT * FROM users_b WHERE user_id = '$user_id'");
	$row2 = $users_b->fetch_assoc();
	$trees = $db->query("SELECT * FROM trees WHERE user_id = '$user_id'");
	$tree = $trees->fetch_assoc();
	$storages = $db->query("SELECT * FROM storage_fruits WHERE user_id = '$user_id'");
	$storage = $storages->fetch_assoc();
	$tutors = $db->query("SELECT * FROM tutor WHERE user_id = '$user_id' AND tutor_id = 1");
	$tutor = $tutors->fetch_assoc();
	$time = time();
	if (isset($_POST['tree'])) {
		$trees = intval($_POST['tree']);
		if ($trees == 5) {
			$_SESSION['tree'] = 5;
		} else if ($trees == 4) {
			$_SESSION['tree'] = 4;
		} else if ($trees == 3) {
			$_SESSION['tree'] = 3;
		} else if ($trees == 2) {
			$_SESSION['tree'] = 2;
		} else {
			$_SESSION['tree'] = 1;
		}
	} else {
		$_SESSION['tree'] = 0;
	}
	if (isset($_POST['tree2'])) {
		$tree_type = intval($_POST['tree_type']);
		if ($tree_type == 5) {
			$tree_name = 'Almond';
			$tree_time = '48 hours';
			$tree_amount = '960';
		} else if ($tree_type == 4) {
			$tree_name = 'Pomegranate';
			$tree_time = '24 hours';
			$tree_amount = '240';
		} else if ($tree_type == 3) {
			$tree_name = 'Cherry';
			$tree_time = '12 hours';
			$tree_amount = '48';
		} else if ($tree_type == 2) {
			$tree_name = 'Peaches';
			$tree_time = '6 hours';
			$tree_amount = '12';
		} else {
			$tree_name = 'Pear';
			$tree_time = '3 hours';
			$tree_amount = '3';
		}
		$trees = intval($_POST['tree2']);
		if ($trees == 5) {
			$_SESSION['tree2'] = 5;
		} else if ($trees == 4) {
			$_SESSION['tree2'] = 4;
		} else if ($trees == 3) {
			$_SESSION['tree2'] = 3;
		} else if ($trees == 2) {
			$_SESSION['tree2'] = 2;
		} else {
			$_SESSION['tree2'] = 1;
		}
	} else {
		$_SESSION['tree2'] = 0;
	}
	if (isset($_POST['tutor_ok'])) {
		$db->query("UPDATE tutor SET status = 1 WHERE user_id = '$user_id' AND tutor_id = 1");
		header('Location: island.php');
	}
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<title>Gods of Rome</title>
		<link rel="stylesheet" type="text/css" href="../../css/style_island.css">
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="../../img/icons/favicon.ico">
		<script defer src="../../js/slider.js"></script>
		<script>
			document.addEventListener('DOMContentLoaded', () => {
				  const slider = new ItcSimpleSlider('.itcss');
				  document.querySelector('.btn-prev').onclick = () => {
				    slider.prev();
				  }
				  document.querySelector('.btn-next').onclick = () => {
				    slider.next();
				  }
			});
		</script>
	</head>
	<body>
		<div class="main">
			<div class="main-cloud1"></div>
			<div class="main-cloud2"></div>
			<div class="main-cloud3"></div>
			<div class="main-cloud4"></div>
			<div class="header">
				<div class="panel">
					<div class="panel_nick"><?=$row['username'];?></div>
					<a class="panel_exit" href="mylands.php">HOME</a>
				</div>
				<div class="silver">
					<div class="silver-img"></div>
					<div class="silver-text"><?=$row2['silver']?></div>
				</div>
				<div class="gold">
					<div class="gold-img"></div>
					<div class="gold-text"><?=$row2['gold']?></div>
				</div>
			</div>
			<?if ($tutors->num_rows > 0) { if ($tutor['status'] == 0) {?>
			<dialog class="dialog_tutor">
				<div class="tutor_body">
					<div class="tutor_block">
						<div class="block_picture"><img class="block_img" src="../../img/garden/plant.png" alt="plant"></div>
						<div class="block_text">Всего на вашем острове пять посадочных грядок. На каждой из них вы можете посадить по одному дереву. Поэтому правильно рассчитайте посадки, чтобы потом не пришлось избавляться от дешевых деревьев.</div>
					</div>
					<div class="tutor_block">
						<div class="block_text">Существует пять видов деревьев, отличающихся друг от друга ценностью и плодовитостью. У каждого дерева свой период сбора урожая; если не собрать плоды в течение 24 часов после созревания, они сгниют, и вам придется выращивать урожай заново.</div>
						<div class="block_picture"><img class="block_img" src="../../img/garden/tree/pear.png" alt="tree"></div>
					</div>
					<div class="tutor_block">
						<div class="block_picture"><img class="block_img" src="../../img/garden/house.png" alt="house"></div>
						<div class="block_text">Это место хранения, где хранятся все собранные фрукты. Вместимость хранилища не ограничена.</div>
					</div>
					<div class="tutor_block">
						<div class="block_text">На острове также есть торговец, у которого вы можете обменять все собранные фрукты на серебро по курсу 1 фрукт за 1 серебро.</div>
						<div class="block_picture"><img class="block_img" src="../../img/garden/trader.png" alt="trader"></div>
					</div>
					<div class="tutor_block">
						<form action="island.php" method="POST">
							<input class="tutor_button" type="submit" name="tutor_ok" value="OK">
						</form>
					</div>
				</div>
			</dialog>
			<? } } ?>
			<? if (($_SESSION['tree'] !== 0) || isset($_SESSION['msgbtf'])) {?>
			<dialog class="dialog_buy">
				<input class="dialog_close" type="submit" name="dia_no" value="" id="closewindowbuy">
				<div class="div_slider">
					<div class="btn-prev"></div>
					<div class="itcss">
						<div class="itcss__wrapper">
							<div class="itcss__items">
								<div class="itcss__item">
									<div class="dialog_block1">
										<div class="block1_center">
											<?if(isset($_SESSION['msgbtf'])){?><h1 class="msg-fb"><?=$_SESSION['msgbtf']?></h1><?} unset($_SESSION['msgbtf']);?>
											<h2 class="dialog_h2">Pear</h2>
											<div class="block1_tree1"></div>
											<div class="block1_tree_cost"><h3 class="dialog_h3">5000<img class="silver_coin" src="../../img/islands/coin_silver.png" alt="$"></h3></div>
										</div>
									</div>
									<div class="dialog_block2">
										<div class="block2"><div class="block2_text">Время сбора: </div><div class="block2_amount">3 часа</div></div>
										<div class="block2"><div class="block2_text">Количество фруктов: </div><div class="block2_amount">3</div></div>
									</div>
									<form class="dialog_form" action="../../inc/buy_tree.php" method="POST">
										<input type="hidden" name="tree_num" value="1">
										<input type="hidden" name="tree_id" value="<?=$_SESSION['tree']?>">
										<input class="dialog_yes" type="submit" name="buy" value="Купить">
									</form>
								</div>
								<div class="itcss__item">
									<div class="dialog_block1">
										<div class="block1_center">
											<h2 class="dialog_h2">Peaches</h2>
											<div class="block1_tree2"></div>
											<div class="block1_tree_cost"><h3 class="dialog_h3">10000<img class="silver_coin" src="../../img/islands/coin_silver.png" alt="$"></h3></div>
										</div>
									</div>
									<div class="dialog_block2">
										<div class="block2"><div class="block2_text">Время сбора: </div><div class="block2_amount">6 часов</div></div>
										<div class="block2"><div class="block2_text">Количество фруктов: </div><div class="block2_amount">12</div></div>
									</div>
									<form class="dialog_form" action="../../inc/buy_tree.php" method="POST">
										<input type="hidden" name="tree_num" value="2">
										<input type="hidden" name="tree_id" value="<?=$_SESSION['tree']?>">
										<input class="dialog_yes" type="submit" name="buy" value="Купить">
									</form>
								</div>
								<div class="itcss__item">
									<div class="dialog_block1">
										<div class="block1_center">
											<h2 class="dialog_h2">Cherry</h2>
											<div class="block1_tree3"></div>
											<div class="block1_tree_cost"><h3 class="dialog_h3">20000<img class="silver_coin" src="../../img/islands/coin_silver.png" alt="$"></h3></div>
										</div>
									</div>
									<div class="dialog_block2">
										<div class="block2"><div class="block2_text">Время сбора: </div><div class="block2_amount">12 часов</div></div>
										<div class="block2"><div class="block2_text">Количество фруктов: </div><div class="block2_amount">48</div></div>
									</div>
									<form class="dialog_form" action="../../inc/buy_tree.php" method="POST">
										<input type="hidden" name="tree_num" value="3">
										<input type="hidden" name="tree_id" value="<?=$_SESSION['tree']?>">
										<input class="dialog_yes" type="submit" name="buy" value="Купить">
									</form>
								</div>
								<div class="itcss__item">
									<div class="dialog_block1">
										<div class="block1_center">
											<h2 class="dialog_h2">Pomegranate</h2>
											<div class="block1_tree4"></div>
											<div class="block1_tree_cost"><h3 class="dialog_h3">50000<img class="silver_coin" src="../../img/islands/coin_silver.png" alt="$"></h3></div>
										</div>
									</div>
									<div class="dialog_block2">
										<div class="block2"><div class="block2_text">Время сбора: </div><div class="block2_amount">24 часа</div></div>
										<div class="block2"><div class="block2_text">Количество фруктов: </div><div class="block2_amount">240</div></div>
									</div>
									<form class="dialog_form" action="../../inc/buy_tree.php" method="POST">
										<input type="hidden" name="tree_num" value="4">
										<input type="hidden" name="tree_id" value="<?=$_SESSION['tree']?>">
										<input class="dialog_yes" type="submit" name="buy" value="Купить">
									</form>
								</div>
								<div class="itcss__item">
									<div class="dialog_block1">
										<div class="block1_center">
											<h2 class="dialog_h2">Almond</h2>
											<div class="block1_tree5"></div>
											<div class="block1_tree_cost"><h3 class="dialog_h3">100000<img class="silver_coin" src="../../img/islands/coin_silver.png" alt="$"></h3></div>
										</div>
									</div>
									<div class="dialog_block2">
										<div class="block2"><div class="block2_text">Время сбора: </div><div class="block2_amount">48 часов</div></div>
										<div class="block2"><div class="block2_text">Количество фруктов: </div><div class="block2_amount">960</div></div>
									</div>
									<form class="dialog_form" action="../../inc/buy_tree.php" method="POST">
										<input type="hidden" name="tree_num" value="5">
										<input type="hidden" name="tree_id" value="<?=$_SESSION['tree']?>">
										<input class="dialog_yes" type="submit" name="buy" value="Купить">
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="btn-next"></div>
				</div>
			</dialog>
			<?}?>
			<?
				if(isset($_POST['sell'])) {
					$tree_id = $_POST['tree_id'];
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
			?>
				<dialog class="dialog_sell">
					<h2 class="dialog_sell_h2">Продать дерево?</h2>
					<h3 class="dialog_sell_h3">Вы получите: <?=$tree_cost?> серебра</h3>
					<form class="dialog_sell_form" action="../../inc/collect_tree.php" method="POST">
						<input type="hidden" name="tree_id" value="<?=$tree_id?>">
						<input class="dialog_sell_yes" type="submit" name="sell" value="Да">
						<input class="dialog_sell_no" type="submit" name="dia_no" value="Нет" id="closesellwindow">
					</form>
				</dialog>
			<? } ?>
			<? if ($_SESSION['tree2'] !== 0 || isset($_SESSION['msgctf'])) {?>
			<dialog class="dialog_tree">
				<input class="dialog_close" type="submit" name="dia_no" value="" id="closewindowtree">
				<div class="dialog_tree_block1">
					<div class="block1_center">
						<?if(isset($_SESSION['msgctf'])){?><h1 class="msg-f"><?=$_SESSION['msgctf']?></h1><?} unset($_SESSION['msgctf']);?>
						<h2 class="dialog_h2"><?=$tree_name?></h2>
						<div class="block1_tree<?=$tree_type?><?if(time() >= $tree['tree'.$_SESSION['tree2'].'_time'] && time() < $tree['tree'.$_SESSION['tree2'].'_time'] + 86400) { echo '_ripe'; }?><?if(time() >= $tree['tree'.$_SESSION['tree2'].'_time'] + 86400) { echo '_rotten'; }?>"></div>
					</div>
				</div>
				<div class="dialog_block2">
					<div class="block2"><div class="block2_text">Время сбора: </div><div class="block2_amount"><?=$tree_time?></div></div>
					<div class="block2"><div class="block2_text">Количество фруктов: </div><div class="block2_amount"><?=$tree_amount?></div></div>
				</div>
				<div class="dialog_tree_form">
					<form action="" method="POST">
						<input type="hidden" name="tree_id" value="<?=$_SESSION['tree2']?>">
						<input class="dialog_tree_sell" type="submit" name="sell" value="Продать">
					</form>
					<form action="../../inc/collect_tree.php" method="POST">
						<input type="hidden" name="tree_id" value="<?=$_SESSION['tree2']?>">
						<input id="time123" <?if ($tree['tree'.$_SESSION['tree2'].'_time'] > time()) { echo 'disabled'; }?> class="dialog_tree_collect" type="submit" name="collect" value="">
					</form>
				</div>
			</dialog>
			<?}?>
			<dialog class="dialog_storage none">
				<input class="dialog_storage_close" type="submit" name="dia_no" value="" id="closewindowstorage">
				<h2 class="dialog_storage_h2">Хранилище</h2>
				<div class="blocks_fruits">
					<div class="block_fruits">
						<div class="block_fruit">
							<img class="fruit1" src="../../img/garden/pear.png" alt="Pears - "><h3 class="dialog_storage_h3"><?=$storage['fruit1']?></h3>
						</div>
						<div class="block_fruit">
							<img class="fruit1" src="../../img/garden/peaches.png" alt="Peaches - "><h3 class="dialog_storage_h3"><?=$storage['fruit2']?></h3>
						</div>
						<div class="block_fruit">
							<img class="fruit1" src="../../img/garden/cherry.png" alt="Cherry - "><h3 class="dialog_storage_h3"><?=$storage['fruit3']?></h3>
						</div>
					</div>
					<div class="block_fruits">
						<div class="block_fruit">
							<img class="fruit2" src="../../img/garden/granate.png" alt="Granate - "><h3 class="dialog_storage_h3"><?=$storage['fruit4']?></h3>
						</div>
						<div class="block_fruit">
							<img class="fruit2" src="../../img/garden/almond.png" alt="Almond - "><h3 class="dialog_storage_h3"><?=$storage['fruit5']?></h3>
						</div>
					</div>
				</div>
			</dialog>
			<dialog class="dialog_trader <?if(!isset($_SESSION['msgitf']) && !isset($_SESSION['msgit'])) { echo 'none'; } ?>">
				<input class="dialog_trader_close" type="submit" name="dia_no" value="" id="closewindowtrader">
				<h2 class="dialog_trader_h2">Торговец</h2>
				<?if(isset($_SESSION['msgitf'])){?><h1 class="msg-f"><?=$_SESSION['msgitf']?></h1><?} unset($_SESSION['msgitf']);?>
				<?if(isset($_SESSION['msgit'])){?><h1 class="msg-f msg-t"><?=$_SESSION['msgit']?></h1><?} unset($_SESSION['msgit']);?>
				<h3 class="dialog_trader_h3">1 фрукт - 1 серебро</h3>
				<div class="blocks_fruits2">
					<div class="block_fruits">
						<div class="block_fruit">
							<img class="fruit1" src="../../img/garden/pear.png" alt="Pears - "><h3 class="dialog_storage_h3"><?=$storage['fruit1']?></h3>
						</div>
						<div class="block_fruit">
							<img class="fruit1" src="../../img/garden/peaches.png" alt="Peaches - "><h3 class="dialog_storage_h3"><?=$storage['fruit2']?></h3>
						</div>
						<div class="block_fruit">
							<img class="fruit1" src="../../img/garden/cherry.png" alt="Cherry - "><h3 class="dialog_storage_h3"><?=$storage['fruit3']?></h3>
						</div>
					</div>
					<div class="block_fruits">
						<div class="block_fruit">
							<img class="fruit2" src="../../img/garden/granate.png" alt="Granate - "><h3 class="dialog_storage_h3"><?=$storage['fruit4']?></h3>
						</div>
						<div class="block_fruit">
							<img class="fruit2" src="../../img/garden/almond.png" alt="Almond - "><h3 class="dialog_storage_h3"><?=$storage['fruit5']?></h3>
						</div>
					</div>
				</div>
				<form class="dialog_trader_form" action="../../inc/sell_fruits.php" method="POST">
					<h3 class="dialog_trader_h3">Вы получите - <?=$storage['fruit1']+$storage['fruit2']+$storage['fruit3']+$storage['fruit4']+$storage['fruit5']?> серебра</h3>
					<input class="dialog_trader_yes" type="submit" name="sell" value="Продать все">
				</form>
			</dialog>
			<div class="island_main">
				<div class="island_block">
					<div class="island_house"></div>
					<div class="island_trees">
						<div class="island_trees_group1">
							<div class="island_tree">
								<?if($tree['tree1'] !== '0') {?>
									<form class="island_tree_top island_tree<?=$tree['tree1']?><?if(time() >= $tree['tree1_time'] && time() < $tree['tree1_time'] + 86400) { echo '_ripe'; }?><?if(time() >= $tree['tree1_time'] + 86400) { echo '_rotten'; }?>" action="#" method="POST">
										<div class="tree_timer tree2_timer<?if(time() < $tree['tree1_time']) { echo ' none'; }?><?if(time() >= $tree['tree1_time'] + 86400) { echo ' time_rotten'; }?>"><?if(time() >= $tree['tree1_time'] + 86400) { echo 'Сгнило'; } else { echo 'Собрать'; }?></div>
										<input type="hidden" name="tree2" value="1">
										<input type="hidden" name="tree_type" value="<?=$tree['tree1']?>">
										<input class="plant_button" type="submit" value="">
									</form>
								<? } else { ?>
									<form class="island_plant1" action="#" method="POST">
										<input type="hidden" name="tree" value="1">
										<input class="plant_button" type="submit" value="">
									</form>
								<? } ?>
							</div>
							<div class="island_tree">
								<?if($tree['tree2'] !== '0') {?>
									<form class="island_tree_top island_tree<?=$tree['tree2']?><?if(time() >= $tree['tree2_time'] && time() < $tree['tree2_time'] + 86400) { echo '_ripe'; }?><?if(time() >= $tree['tree2_time'] + 86400) { echo '_rotten'; }?>" action="#" method="POST">
										<div class="tree_timer tree2_timer<?if(time() < $tree['tree2_time']) { echo ' none'; }?><?if(time() >= $tree['tree2_time'] + 86400) { echo ' time_rotten'; }?>"><?if(time() >= $tree['tree2_time'] + 86400) { echo 'Сгнило'; } else { echo 'Собрать'; }?></div>
										<input type="hidden" name="tree2" value="2">
										<input type="hidden" name="tree_type" value="<?=$tree['tree2']?>">
										<input class="plant_button" type="submit" value="">
									</form>
								<? } else { ?>
									<form class="island_plant1" action="#" method="POST">
										<input type="hidden" name="tree" value="2">
										<input class="plant_button" type="submit" value="">
									</form>
								<? } ?>
							</div>
						</div>
						<div class="island_trees_group2">
							<div class="island_tree">
								<?if($tree['tree3'] !== '0') {?>
									<form class="island_tree_bottom island_tree<?=$tree['tree3']?><?if(time() >= $tree['tree3_time'] && time() < $tree['tree3_time'] + 86400) { echo '_ripe'; }?><?if(time() >= $tree['tree3_time'] + 86400) { echo '_rotten'; }?>" action="#" method="POST">
										<div class="tree_timer tree3_timer<?if(time() < $tree['tree3_time']) { echo ' none'; }?><?if(time() >= $tree['tree3_time'] + 86400) { echo ' time_rotten'; }?>"><?if(time() >= $tree['tree3_time'] + 86400) { echo 'Сгнило'; } else { echo 'Собрать'; }?></div>
										<input type="hidden" name="tree2" value="3">
										<input type="hidden" name="tree_type" value="<?=$tree['tree3']?>">
										<input class="plant_button" type="submit" value="">
									</form>
							    <? } else { ?>
									<form class="island_plant2" action="#" method="POST">
										<input type="hidden" name="tree" value="3">
										<input class="plant_button" type="submit" value="">
									</form>
								<? } ?>
							</div>
							<div class="island_tree">
								<?if($tree['tree4'] !== '0') {?>
									<form class="island_tree_bottom island_tree<?=$tree['tree4']?><?if(time() >= $tree['tree4_time'] && time() < $tree['tree4_time'] + 86400) { echo '_ripe'; }?><?if(time() >= $tree['tree4_time'] + 86400) { echo '_rotten'; }?>" action="#" method="POST">
										<div class="tree_timer tree3_timer<?if(time() < $tree['tree4_time']) { echo ' none'; }?><?if(time() >= $tree['tree4_time'] + 86400) { echo ' time_rotten'; }?>"><?if(time() >= $tree['tree4_time'] + 86400) { echo 'Сгнило'; } else { echo 'Собрать'; }?></div>
										<input type="hidden" name="tree2" value="4">
										<input type="hidden" name="tree_type" value="<?=$tree['tree4']?>">
										<input class="plant_button" type="submit" value="">
									</form>
								<? } else { ?>
									<form class="island_plant2" action="#" method="POST">
										<input type="hidden" name="tree" value="4">
										<input class="plant_button" type="submit" value="">
									</form>
								<? } ?>
							</div>
							<div class="island_tree">
								<?if($tree['tree5'] !== '0') {?>
									<form class="island_tree_bottom island_tree<?=$tree['tree5']?><?if(time() >= $tree['tree5_time'] && time() < $tree['tree5_time'] + 86400) { echo '_ripe'; }?><?if(time() >= $tree['tree5_time'] + 86400) { echo '_rotten'; }?>" action="#" method="POST">
										<div class="tree_timer tree3_timer<?if(time() < $tree['tree5_time']) { echo ' none'; }?><?if(time() >= $tree['tree5_time'] + 86400) { echo ' time_rotten'; }?>"><?if(time() >= $tree['tree5_time'] + 86400) { echo 'Сгнило'; } else { echo 'Собрать'; }?></div>
										<input type="hidden" name="tree2" value="5">
										<input type="hidden" name="tree_type" value="<?=$tree['tree5']?>">
										<input class="plant_button" type="submit" value="">
									</form>
								<? } else { ?>
									<form class="island_plant2" action="#" method="POST">
										<input type="hidden" name="tree" value="5">
										<input class="plant_button" type="submit" value="">
									</form>
								<? } ?>
							</div>
						</div>
					</div>
					<div class="island_trader"></div>
				</div>
			</div>
			<div class="footer">
				<div class="menu_section">
					<a class="menu_profile" href="profile.php"></a>
				</div>
				<div class="menu_section">
					<a class="menu_insert" href="deposit.php"></a>
				</div>
				<div class="menu_section">
					<a class="menu_withdraw" href="withdraw.php"></a>
				</div>
				<div class="menu_section">
					<a class="menu_help" href="help.php"></a>
				</div>
			</div>
		</div>
		<script>
			var date1 = <?=$tree['tree'.$_SESSION['tree2'].'_time']?>;
			var countdownfunction = setInterval(function() {
				var now = new Date().getTime() / 1000;
				var date = date1 - now;
				var h = Math.floor(date / 60 / 60);
				h < 10 ? h = '0' + h : h;
				var m = Math.floor((date / 60) - (h * 60));
				m < 10 ? m = '0' + m : m;
				var s = Math.floor(date - (h * 60 * 60) - (m * 60));
				s < 10 ? s = '0' + s : s;
				document.getElementById("time123").value = h + ':' + m + ':' + s;
				if (date < 0) {
					clearInterval(countdownfunction);
					document.getElementById("time123").value = "Собрать";
					document.getElementById("time123").disabled = false;
				}
				if (date + 86400 < 0) {
					clearInterval(countdownfunction);
					document.getElementById("time123").value = "Очистить";
					document.getElementById("time123").disabled = false;
				}
			}, 100);
		</script>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
		<script src="../../js/main.js"></script>
	</body>
</html>