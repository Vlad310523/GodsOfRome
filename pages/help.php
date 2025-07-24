<?php
	session_start();
	if (!$_SESSION['user']) {
		header('Location: ../index.php');
	}
	require_once '../classes/configdb.php';
	$user_id = intval($_SESSION['user']);
	$user = $db->query("SELECT * FROM users WHERE user_id = '$user_id'");
	$row = $user->fetch_assoc();
	if ($row['ban'] == 1) {
		header('Location: /inc/logout.php');
	}
	$users_b = $db->query("SELECT * FROM users_b WHERE user_id = '$user_id'");
	$row2 = $users_b->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Gods of Rome</title>
		<link rel="stylesheet" type="text/css" href="../css/style4.css">
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="../img/icons/favicon.ico">
	</head>
	
	<body>
		<div class="main">
			<div class="header">
				<div class="panel">
					<div class="panel_nick"><?=$row['username']?></div>
					<a class="panel_exit" href="/pages/mylands.php">HOME</a>
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
					<a class="help_button" href="/pages/mylands.php">Back</a>
				</div>
				<div class="help_block">
					<div class="faq_block">
						<div class="accordion">1. How do I start playing?</div>
						<div class="content">After registering for the project, you need to top up your balance or invite active referrals. Then, on the central island "<a href="/pages/island.php">Garden</a>", you can buy trees and grow fruit, selling which you will get silver. You can also go to the "<a href="/pages/battles.php">Arena</a>", where you can fight for silver and win gold, which you can withdraw into real money or exchange back for silver.</div>
						<div class="accordion">2. If I haven't deposited a balance, can I start playing?</div>
						<div class="content">Yes, you can! After registration, you get a bonus tree, and Referrals will allow you to collect some silver, so invite your friends and earn money from their deposits!</div>
						<div class="accordion">3. I want to change my Email - is this possible?</div>
						<div class="content">Not possible! And this is a guarantee of your own safety. In case the attackers find out the password from your account and change it, they will not be able to change the Email to which the account is linked, which gives you the guarantee that you will always be able to regain access to your account by restoring your password with the help of Email</div>
						<div class="accordion">4. How do I make a deposit?</div>
						<div class="content">You can deposit your balance in the section "<a href="/pages/deposit.php">Deposit balance</a>" by any method most convenient for you from among the offered ones.</div>
						<div class="accordion">5. I have topped up my account, but the money has not arrived. What should I do?</div>
						<div class="content">Wait, the time of top-up depends on the payment method you have chosen. Depending on it, the time of payment crediting may vary from 1 minute to 2 working days.<br>Before making a payment, please read the terms and conditions of the transfer or payment carefully.
<br><br>If you have done everything correctly and a sufficient amount of time has passed since the payment was made, but the money has not been credited to your account, then:
<br>1. Go to the personal cabinet of the payment system, which you made the payment.
<br>2. Open the section with the history of payments and find the payment that did not reach your account. 3.
<br>3. Click on it, so that all details of this payment become visible on the screen.
<br>4. Take a screenshot of the screen. If you paid through a terminal, take a photo of the payment order.
<br>5. Write an appeal to the support service, specifying the date, time, amount of payment, and attach a screenshot from the previous point.</div>
						<div class="accordion">6. How can I withdraw money from the project?</div>
						<div class="content">You can withdraw your earnings in the "<a href="/pages/withdraw.php">Withdraw funds</a>" section. There, you can order a payout to your Payeer wallet.</div>
						<div class="accordion">7. How soon can I start withdrawing money?</div>
						<div class="content">Immediately after topping up your balance and earning your first gold, in the "<a href="/pages/withdraw.php">Withdraw funds</a>" section.</div>
						<div class="accordion">8. What does $1 equal when making a withdrawal?</div>
						<div class="content">Both at deposit and withdrawal of funds from the project, there is a rate of $1 = 1000 coins</div>
						<div class="accordion">9. How can I get referrals?</div>
						<div class="content">You need to send your referral link to the user you want to invite. As soon as he or she tops up the balance - he or she will be considered an active referral, and you will receive bonuses for him or her! You can track the activity of your referrals in the "<a href="/pages/profile.php">Referrals</a>" section</div>
						<div class="accordion">10. I want to change my referral or referrer, how can I do that?</div>
						<div class="content">Unfortunately, this data cannot be changed! If your friend did not become your referral after registration, it means that he registered without using your link.</div>
						<div class="accordion">11. Who is an active referral?</div>
						<div class="content">An active referral is a referral who has topped up the balance.</div>
						<div class="accordion">12. My friend registered using my link but did not become my referral</div>
						<div class="content">If you gave your referral link to someone, and after registration, this person's profile shows someone else instead of you, it may mean that:
<br><br>a) You made a mistake when copying and sending your referral link
<br>b) The user to whom you sent the link made a mistake when copying or typing your link into the address bar.
<br>c) The user deliberately deleted the ending with your login from your link in order not to become your referral.
<br>d) After clicking on your link, the user clicked on someone else's referral link and only then passed registration. In this case, he will become a referral for the one whose link he clicked last.
<br>e) Cookies are disabled in the user's browser
<br><br>In most of the above cases, you can help to shorten your referral link with the help of special services.</div>
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
		<script src="../js/main.js"></script>
	</body>
</html>