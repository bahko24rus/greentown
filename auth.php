<?php
	session_start();
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Авторизация</title>
		<link rel="icon" href="img/logo-gt_50.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="style.css">
			  </head>
	<body class="auth_background">
<!--Форма авторизации-->
		<form class="auth_form" action="singin.php" method="post">
			<div class="auth_text">Логин</div><input class="auth_input" type="text" name="login" placeholder="Введите свой логин">
			<p class="auth_message_login">
				<font>
					<?php 
						echo $_SESSION['auth_message_login'];
						unset($_SESSION['auth_message_login']);
					?>
				</font>
			<div class="auth_text">Пароль</div><input class="auth_input" type="password" name="password" placeholder="Введите свой пароль">
			<p class="auth_message_password">
				<font>
					<?php 
						echo $_SESSION['auth_message_password'];
						unset($_SESSION['auth_message_password']);
					?>
				</font>
			</p>
			<button class="auth_but" type="submit">Войти</button><div class="auth_but"><a class="auth_link" href="/">Отмена</a></div>
			<div class="auth_registration">Нет акаунта?<a href="reg.php" class="auth_link_registration">Зарегистрируйя</a></div>
		</form>
	</body>
</html>