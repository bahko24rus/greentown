<?php
	session_start();
	require_once('connect.php');
	$login = $_POST['login'];
	$pass = $_POST['password'];
	$password = md5($pass);
	$check_login = mysqli_query($connect, "SELECT * FROM users WHERE login='$login'");
	$check_pass = mysqli_query($connect, "SELECT * FROM users WHERE login='$login' AND password='$password'");
	$check_verification = mysqli_query($connect, "SELECT * FROM users WHERE login='$login' AND password='$password' AND verification='1'");
	$check_access = mysqli_fetch_array(mysqli_query($connect, "SELECT access FROM users WHERE login='$login'"));
	$access = $check_access['access'];
	$user_coocke = $_COOKIE['user'];
	if (!$login)
		{
		 $_SESSION['auth_message_login'] = 'Введите логин';
		 header('Location: auth.php');
		}
	if (!$pass)
		{
		 $_SESSION['auth_message_password'] = 'Введите пароль';
		 header('Location: auth.php');
		}
	if ($access == 'open')
		{
		 if ($login && $pass)
			{
			 if (mysqli_num_rows($check_login) > 0)
		 		{
				 if (mysqli_num_rows($check_pass) > 0)
					{
					 if (mysqli_num_rows($check_verification) > 0)
			 			{
						 $user = mysqli_fetch_assoc($check_pass);
						 $_SESSION['user'] = ["login" => $user['login'], "email" => $user['email']];
						 $check_order = mysqli_query($connect, "SELECT * FROM `bucket` WHERE id_user='$user_coocke'");
						 if (mysqli_num_rows($check_order) > 0)
		 					{
							 while ($row = mysqli_fetch_array($check_order))
			 					{
								 mysqli_query ($connect, "UPDATE `bucket` SET id_user='$login' WHERE id_user='$user_coocke'");
			 					}
		 					}
						 header('Location: profile.php');
			 			}
					 else
			 			{
						 $_SESSION["auth_message_password"] = 'Подтвердите свою почту';
						 header('Location: auth.php');
			 			}
					}
				 else
					{
					 $_SESSION["auth_message_password"] = 'Не верный логин или пароль';
					 header('Location: auth.php');
					}
		 		}
			 else
				{
				 $_SESSION["auth_message_password"] = 'Такого логина не существует';
				 header('Location: auth.php');
				}
			}
		}
	else
		{
		 $_SESSION["auth_message_password"] = 'Извините, ваш аккаунт заблокироват, свяжитесь с администрацией, спасибо.';
		 header('Location: auth.php');
		}
?>