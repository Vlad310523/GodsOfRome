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
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<title>Gods of Rome</title>
		<link rel="stylesheet" type="text/css" href="../../css/style4.css">
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="../../img/icons/favicon.ico">
	</head>
	
	<body>
		<div class="main">
			<div class="header">
				<div class="panel">
					<div class="panel_nick"><?=$row['username']?></div>
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
			<div class="help_main">
				<div class="help_buttons">
					<div class="help_button3">FAQ</div>
					<a class="help_button" href="mylands.php">Назад</a>
				</div>
				<div class="help_block">
					<div class="faq_block">
						<div class="accordion">1. Как я могу начать играть?</div>
						<div class="content">После регистрации в проекте необходимо пополнить баланс или пригласить активных рефералов. Далее, на центральном острове "<a href="island.php">Сады</a>", вы можете покупать деревья и выращивать фрукты, продавая которые вы будете получать серебро. Также вы можете отправиться на "<a href="battles.php">Арену</a>", где сражаетесь за серебро и получаете золото, которое можно вывести в реальные деньги или обменять обратно на серебро.</div>
						<div class="accordion">2. Если я не пополнил баланс, могу ли я начать играть?</div>
						<div class="content">Да, вы можете! После регистрации вы получите бонусное дерево, а рефералы позволят вам собрать немного серебра, так что приглашайте друзей и зарабатывайте на их депозитах!</div>
						<div class="accordion">3. Я хочу изменить свой Email - это возможно?</div>
						<div class="content">Невозможно! И это гарантия вашей собственной безопасности. Если злоумышленники узнают пароль от вашего аккаунта и изменят его, они не смогут изменить Email, к которому привязан аккаунт, что дает вам гарантию того, что вы всегда сможете восстановить доступ к своему аккаунту, восстановив пароль с помощью Email.</div>
						<div class="accordion">4. Как сделать депозит?</div>
						<div class="content">Вы можете пополнить свой баланс в разделе "<a href="deposit.php">Пополнить баланс</a>" любым удобным для вас способом из предложенных.</div>
						<div class="accordion">5. Я пополнил свой счет, но деньги не поступили. Что мне делать?</div>
						<div class="content">Подождите, время пополнения счета зависит от выбранного вами способа оплаты. В зависимости от него время зачисления платежа может составлять от 1 минуты до 2 рабочих дней. Прежде чем совершить платеж, внимательно ознакомьтесь с условиями перевода или платежа.
<br><br>Если вы все сделали правильно и с момента оплаты прошло достаточное количество времени, но деньги так и не поступили на ваш счет, то:
<br>1. Перейдите в личный кабинет платежной системы, через которую вы совершали платеж.
<br>2. Откройте раздел с историей платежей и найдите платеж, который не поступил на ваш счет.
<br>3. Нажмите на него, чтобы все детали этого платежа стали видны на экране.
<br>4. Сделайте снимок экрана. Если вы платили через терминал, сфотографируйте платежное поручение.
<br>5. Напишите обращение в службу поддержки, указав дату, время, сумму платежа, и приложите скриншот из предыдущего пункта.</div>
						<div class="accordion">6. Как я могу вывести деньги из проекта?</div>
						<div class="content">Вы можете вывести заработанные деньги в "<a href="withdraw.php">Вывести деньги</a>" разделе. Там вы можете заказать выплату на свой кошелек Payeer.</div>
						<div class="accordion">7. Как скоро я смогу начать выводить деньги?</div>
						<div class="content">Сразу после пополнения баланса и получения первого золота, в "<a href="withdraw.php">Вывод денег</a>" разделе.</div>
						<div class="accordion">8. Чему равен 1 доллар при снятии средств?</div>
						<div class="content">Как при пополнении, так и при выводе средств из проекта действует курс $1 = 1000 монет</div>
						<div class="accordion">9. Как я могу получить рефералов?</div>
						<div class="content">Вам нужно отправить свою реферальную ссылку пользователю, которого вы хотите пригласить. Как только он пополнит баланс - он будет считаться активным рефералом, и вы будете получать за него бонусы! Вы можете отслеживать активность своих рефералов в разделе "<a href="profile.php">Рефералы</a>"</div>
						<div class="accordion">10. Я хочу изменить своего реферала или реферера, как я могу это сделать?</div>
						<div class="content">К сожалению, эти данные нельзя изменить! Если ваш друг не стал вашим рефералом после регистрации, это означает, что он зарегистрировался без использования вашей ссылки.</div>
						<div class="accordion">11. Кто является активным рефералом?</div>
						<div class="content">Активный реферал - это реферал, пополнивший баланс.</div>
						<div class="accordion">12. Мой друг зарегистрировался по моей ссылке, но не стал моим рефералом</div>
						<div class="content">Если вы дали кому-то свою реферальную ссылку, а после регистрации в профиле этого человека вместо вас отображается кто-то другой, это может означать, что:
<br><br>a) Вы допустили ошибку при копировании и отправке своей реферальной ссылки
<br>b) Пользователь, которому вы отправили ссылку, допустил ошибку при копировании или вводе вашей ссылки в адресную строку.
<br>c) Пользователь намеренно удалил окончание с вашим логином из вашей ссылки, чтобы не стать вашим рефералом.
<br>d) После перехода по вашей ссылке пользователь перешел по чужой реферальной ссылке и только потом прошел регистрацию. В этом случае он станет рефералом для того, чью ссылку он перешел последним.
<br>e) Cookies отключены в браузере пользователя
<br><br>В большинстве случаев сократить реферальную ссылку можно с помощью специальных сервисов.</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			document.querySelectorAll('.accordion').forEach(el => {
				el.addEventListener('click', () => {
					let content = el.nextElementSibling;
					if (content.style.maxHeight) {
						document.querySelectorAll('.content').forEach((el) => el.style.maxHeight = null)
						document.querySelectorAll('.accordion').forEach((el) => el.style.backgroundColor = 'transparent')
					} else {
						document.querySelectorAll('.content').forEach((el) => el.style.maxHeight = null)
						document.querySelectorAll('.accordion').forEach((el) => el.style.backgroundColor = 'transparent')
						content.style.maxHeight = content.scrollHeight + 'px'
						content.style.margin = '5px'
					}
				})
			})
		</script>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
		<script src="../../js/main.js"></script>
	</body>
</html>