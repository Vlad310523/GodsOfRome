<?php
	if (!in_array($_SERVER['REMOTE_ADDR'], array('185.71.65.92', '185.71.65.189', '149.202.17.210'))) return;

	if (isset($_POST['m_operation_id']) && isset($_POST['m_sign']))
	{
		$m_key = 'A8c6#976e5b541!0415bde$';

		$arHash = array(
			$_POST['m_operation_id'],
			$_POST['m_operation_ps'],
			$_POST['m_operation_date'],
			$_POST['m_operation_pay_date'],
			$_POST['m_shop'],
			$_POST['m_orderid'],
			$_POST['m_amount'],
			$_POST['m_curr'],
			$_POST['m_desc'],
			$_POST['m_status']
		);

		if (isset($_POST['m_params']))
		{
			$arHash[] = $_POST['m_params'];
		}

		$arHash[] = $m_key;

		$sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
		session_start();
		require_once '../classes/configdb.php';
		$deposit_id = $_POST['m_orderid'];
		$deposit = $db->query("SELECT * FROM users_deposit WHERE deposit_id = '$deposit_id'");
		$rowDepos = $deposit->fetch_assoc();
		$user_id = intval($rowDepos['user_id']);
		if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success')
		{
			$amount = $_POST['m_amount'] * 1000;
			$users = $db->query("SELECT * FROM users WHERE user_id = '$user_id'");
			$row2 = $users->fetch_assoc();
			if ($row2['ref_id'] !== 0) {
				$ref_id = $row2['ref_id'];
				$amount2 = $amount * 0.02;
				$db->query("UPDATE users_b SET silver = silver + '$amount2' WHERE user_id = '$ref_id'");
				$db->query("UPDATE referrals SET deposit = deposit + '$amount' WHERE user_id = '$user_id'");
			}
			$db->query("UPDATE users_b SET silver = silver + '$amount' WHERE user_id = '$user_id'");
			$db->query("UPDATE users_deposit SET status = 1 WHERE deposit_id = '$deposit_id'");
			ob_end_clean(); exit($_POST['m_orderid'].'|success');
		}
		$db->query("UPDATE users_deposit SET status = 2 WHERE deposit_id = '$deposit_id'");
		ob_end_clean(); exit($_POST['m_orderid'].'|error');
	}
?>