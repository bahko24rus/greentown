<?php
	session_start();
	require('connect.php');
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Регистрация</title>
		<link rel="icon" href="img/logo-gt_50.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body class="reg_background">
<!--Форма регистрации-->
		<form class="reg_form" action="singup.php" method="post">
			<div class="reg_text">Логин</div>
			<input class="reg_input" type="text" name="login" placeholder="Введите логин">
			<p class='reg_message_login'>
				<font>
					<?php 
						echo $_SESSION['reg_message_login'];
						unset($_SESSION['reg_message_login']);
					?>
				</font>
			</p>
			<div class="reg_text">Почта</div>
			<input class="reg_input" type="text" name="email" placeholder="Введите свой email">
			<p class='reg_message_email'>
				<font>
					<?php 
						echo $_SESSION['reg_message_email'];
						unset($_SESSION['reg_message_email']);
					?>
				</font>
			</p>
			<div class="reg_text">Пароль</div>
			<input class="reg_input" type="password" name="password" placeholder="Введите пароль">
			<p class='reg_message_pass'>
				<font>
					<?php 
						echo $_SESSION['reg_message_pass'];
						unset($_SESSION['reg_message_pass']);
					?>
				</font>
			</p>
			<div class="reg_text">Подтвердите пароль</div>
			<input class="reg_input" type="password" name="password_confirm" placeholder="Повторите пароль">
			<p class='reg_message_pass_conf'>
				<font>
					<?php 
						echo $_SESSION['reg_message_pass_conf'];
						unset($_SESSION['reg_message_pass_conf']);
					?>
				</font>
			</p>
			<div class="reg_slip"><button class="reg_but" type="submit">Зарегистрироватья</button><div class="reg_but"><a class="reg_link" href="/">Отмена</a></div></div>
			<div class="reg_autentification">Уже есть акаунт?<a class="reg_link_autentification" href="auth.php">Авторизируйся</a></div>
		</form>
	</body>
</html>