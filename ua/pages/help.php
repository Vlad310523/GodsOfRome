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
						<div class="accordion">1. Як я можу почати грати?</div>
						<div class="content">Після реєстрації в проєкті необхідно поповнити баланс або запросити активних рефералів. Далі, на центральному острові "<a href="island.php">Сади</a>", ви можете купувати дерева і вирощувати фрукти, продаючи які ви будете отримувати срібло. Також ви можете вирушити на "<a href="battles.php">Арену</a>", де б'єтеся за срібло і отримуєте золото, яке можна вивести в реальні гроші або обміняти назад на срібло.</div>
						<div class="accordion">2. Якщо я не поповнив баланс, чи можу я почати грати?</div>
						<div class="content">Так, ви можете! Після реєстрації ви отримаєте бонусне дерево, а реферали дадуть вам змогу зібрати трохи срібла, тож запрошуйте друзів і заробляйте на їхніх депозитах!</div>
						<div class="accordion">3. Я хочу змінити свій Email - це можливо?</div>
						<div class="content">Неможливо! І це гарантія вашої власної безпеки. Якщо зловмисники дізнаються пароль від вашого облікового запису і змінять його, вони не зможуть змінити Email, до якого прив'язано обліковий запис, що дає вам гарантію того, що ви завжди зможете відновити доступ до свого облікового запису, відновивши пароль за допомогою Email.</div>
						<div class="accordion">4. Як зробити депозит?</div>
						<div class="content">Ви можете поповнити свій баланс у розділі "<a href="deposit.php">Поповнити баланс</a>" будь-яким зручним для вас способом із запропонованих.</div>
						<div class="accordion">5. Я поповнив свій рахунок, але гроші не надійшли. Що мені робити?</div>
						<div class="content">Зачекайте, час поповнення рахунку залежить від обраного вами способу оплати. Залежно від нього час зарахування платежу може становити від 1 хвилини до 2 робочих днів. Перш ніж здійснити платіж, уважно ознайомтеся з умовами переказу або платежу.
<br><br>Якщо ви все зробили правильно і з моменту оплати минула достатня кількість часу, але гроші так і не надійшли на ваш рахунок, то:
<br>1. Перейдіть в особистий кабінет платіжної системи, через яку ви здійснювали платіж.
<br>2. Відкрийте розділ з історією платежів і знайдіть платіж, який не надійшов на ваш рахунок.
<br>3. Натисніть на нього, щоб усі деталі цього платежу стало видно на екрані.
<br>4. Зробіть знімок екрана. Якщо ви платили через термінал, сфотографуйте платіжне доручення.
<br>5. Напишіть звернення до служби підтримки, вказавши дату, час, суму платежу, і прикладіть скріншот із попереднього пункту.</div>
						<div class="accordion">6. Як я можу вивести гроші з проекту?</div>
						<div class="content">Ви можете вивести зароблені гроші в "<a href="withdraw.php">Вивести гроші</a>" розділі. Там ви можете замовити виплату на свій гаманець Payeer.</div>
						<div class="accordion">7. Як скоро я зможу почати виводити гроші?</div>
						<div class="content">Одразу після поповнення балансу та отримання першого золота, в "<a href="withdraw.php">Виведення грошей</a>" розділі.</div>
						<div class="accordion">8. Чому дорівнює 1 долар під час зняття коштів?</div>
						<div class="content">Як під час поповнення, так і під час виведення коштів із проєкту діє курс $1 = 1000 монет</div>
						<div class="accordion">9. Як я можу отримати рефералів?</div>
						<div class="content">Вам потрібно надіслати своє реферальне посилання користувачеві, якого ви хочете запросити. Щойно він поповнить баланс - його вважатимуть активним рефералом, і ви отримуватимете за нього бонуси! Ви можете відстежувати активність своїх рефералів у розділі "<a href="profile.php">Реферали</a>"</div>
						<div class="accordion">10. Я хочу змінити свого реферала або реферера, як я можу це зробити?</div>
						<div class="content">На жаль, ці дані не можна змінити! Якщо ваш друг не став вашим рефералом після реєстрації, це означає, що він зареєструвався без використання вашого посилання.</div>
						<div class="accordion">11. Хто є активним рефералом?</div>
						<div class="content">Активний реферал - це реферал, який поповнив баланс.</div>
						<div class="accordion">12. Мій друг зареєструвався за моїм посиланням, але не став моїм рефералом</div>
						<div class="content">Якщо ви дали комусь своє реферальне посилання, а після реєстрації в профілі цієї людини замість вас відображається хтось інший, це може означати, що:
<br><br>a) Ви припустилися помилки під час копіювання та надсилання свого реферального посилання
<br>b) Користувач, якому ви надіслали посилання, припустився помилки під час копіювання або введення вашого посилання в адресний рядок.
<br>c) Користувач навмисно видалив закінчення з вашим логіном з вашого посилання, щоб не стати вашим рефералом.
<br>d) Після переходу за вашим посиланням користувач перейшов за чужим реферальним посиланням і тільки потім пройшов реєстрацію. У цьому випадку він стане рефералом для того, чиє посилання він перейшов останнім.
<br>e) Cookies вимкнено в браузері користувача
<br><br>У більшості випадків скоротити реферальне посилання можна за допомогою спеціальних сервісів.</div>
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