<?php
	if(!isset($_POST['username'])){
		header("HTTP/1.1 303 See Other");
		header('Location: index.php');
		die();
	}
	require_once(dirname(__FILE__).'/includes/db_connect.php');	if(!PASS_RESET){echo "Password resets are not enabled at this time"; die();}	if(!extension_loaded('openssl')){echo "OpenSSL not installed. Password resets are not available."; die();}
	$stmt = $mysqli->prepare("SELECT id, email FROM users WHERE deleted=0 AND name=?");
	$var = $_POST['username'];
	$stmt->bind_param("s", $var);
	$stmt->execute();
	$stmt->bind_result($id, $email);
	$stmt->fetch();
	if(empty($email)){
		echo "0";
		die();
	}
	$stmt->close();
	$stmt = $mysqli->prepare("SELECT timestamp, id FROM reset_password WHERE user_id=? ORDER BY id DESC");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$stmt->bind_result($n_timestamp, $useless_id);
	$stmt->fetch();
	if(!empty($n_timestamp) && $n_timestamp > (time() - 60*60*4)){
		echo "2";
		die();
	}
	$stmt->close();
	$stmt = $mysqli->prepare("INSERT INTO reset_password (user_id, timestamp, token) VALUES (?, ?, ?)");
	echo $mysqli->error;
	$time = time();
	$token = base64_encode(openssl_random_pseudo_bytes(30));
	$stmt->bind_param("iis", $id, $time, $token);
	$stmt->execute();
	$token=urlencode($token);
	require_once('/PHPMailer/PHPMailerAutoload.php');
	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host = SMTP_HOST;
	$mail->SMTPAuth = true;
	$mail->CharSet = 'UTF-8';
	$mail->Username = SMTP_USER;
	$mail->Password = SMTP_PASS;
	$mail->SMTPSecure = SMTP_PROTOCOL;
	$mail->Port = SMTP_PORT; 
	$mail->addAddress($email);
	$mail->setFrom(SMTP_USER, SMTP_NAME);
	$mail->isHTML(false);
	$mail->Subject = 'UFA Swim password reset';
	$url = $_SERVER["HTTP_HOST"]."/reset.php?id=$id&token=$token";
	$mail->Body = "Hi there, \r\nSomeone is trying to reset the password associated with this email. If it was you, click here: \r\n$url\r\n \r\n (Please do not reply to this email)";
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}
	echo "1";
?>