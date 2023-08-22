<?php
	session_start();
	require_once("connect.php");
	$first_name = $_POST['first_name'];
	$middle_name = $_POST['middle_name'];
	$last_name = $_POST['last_name'];
	$login = $_POST['login'];
	$check_login = mysqli_query($connect, "SELECT login FROM users WHERE login='$login'");
	$email = $_POST['email'];
	$check_email = mysqli_query($connect, "SELECT email FROM users WHERE email='$email'");
	$password = $_POST['password'];
	$password_confirm = $_POST['password_confirm'];
	$token = uniqid();
	$token .= uniqid();
	$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$parse = parse_url($url);
	$url_domen = $parse['host'];
	if ($login)
		{
		 if (mysqli_num_rows($check_login) == 0)
		 	{
			 $login_key = 1;
		 	}
		 else
			{
			 $_SESSION['reg_message_login'] = 'Логин уже используется, придумайте другой';
			 header('Location: reg.php');
			}
		}
	else
		{
		 $_SESSION['reg_message_login'] = 'Введите логин';
		 header('Location: reg.php');
		}
	if ($email)
		{
		 if (mysqli_num_rows($check_email) == 0)
		 	{
			 $email_key = 1;
		 	}
		 else
			{
			 $_SESSION['reg_message_email'] = 'Email уже используется, придумайте другой';
			 header('Location: reg.php');
			}
		}
	else
		{
		 $_SESSION['reg_message_email'] = 'Введите email';
		 header('Location: reg.php');
		}
	if ($password)
		{
		 $password_key = 1;
		}
	else
		{
		 $_SESSION['reg_message_pass'] = 'Введите пароль';
		 header('Location: reg.php');
		}
	if ($password_confirm)
		{
		 if ($password === $password_confirm)
		 	{
			 $password_confirm_key = 1;
		 	}
		 else
			{
			 $_SESSION['reg_message_pass_conf'] = 'Пароли не совпадают';
			 header('Location: reg.php');
			}
		}
	else
		{
		 $_SESSION['reg_message_pass_conf'] = 'Подтвердите пароль';
		 header('Location: reg.php');
		}
	if ($login_key && $email_key && $password_key && $password_confirm_key)
		{
		 $password = md5($password);
		 mysqli_query ($connect, "INSERT INTO `users` (`status`, `access`, `login`, `email`, `token`, `password`) VALUES ('user', 'open', '$login', '$email', '$token', '$password')");
		 mail ($email, "Подтверждение почты", "https://{$url_domen}/verification.php/?token={$token}");
		 header('Location: compreg.php');
		}
?>