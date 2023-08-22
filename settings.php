<?php
	session_start();
	require('connect.php');
	if(!$_SESSION['user'])
		{
		 header('Location: index.php');
		}
?>
<!DOCTYPE HTML">
<html>
	<head>
		<meta charset="utf-8">
		<title>Настройки пользователя</title>
		<link rel="icon" href="img/logo-gt_50.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body class="settings_background">
		<form class="settings_form" action='save_settings.php' method='post' enctype='multipart/form-data'>
			<div class="settings_head_text"><h3>Настройки пользователя</h3></div>
			<div class="settings_text">Изменить аватар</div>
			<input class="settings_input" type="file" name="avatar">
			<div class="settings_text">Изменить Фамилию</div>
			<input class="settings_input" name='first_name' type='text'>
			<div class="settings_text">Изменить Имя</div>
			<input class="settings_input" name='middle_name' type='text'>
			<div class="settings_text">Изменить Отчество</div>
			<input class="settings_input" name="last_name" type="text">
			<div class="settings_text">Изменить логин</div>
			<input class="settings_input" name="login" type="text">
			<div class="settings_text">Изменить e-mail</div>
			<input class="settings_input" name="email" type="text">
			<div class="settings_text">Изменить номер моб.тел.</div>
			<input class="settings_input" name="telephone" type="text">
			<div class="settings_text">Изменить Пароль</div>
			<input class="settings_input" name="password" type="password">
			<div class="settings_text">Подтвердите пароль</div>
			<input class="settings_input" name="password_confirm" type="password">
				<p class='settings_msessage_pass_conf'>
					<font>
						<?php 
							echo $_SESSION['settings_msg_pass_conf'];
							unset($_SESSION['settings_msg_pass_conf']);
						?>
					</font>
				</p>
			<div class="settings_text">Изменить дату Рождения</div>
				<div>
					<select class="settings_select" name="day" id="day">
						<option value=""></option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
					</select>
					<select class="settings_select" name="month" id="month">
						<option value=""></option>
						<option value="Январь">Январь</option>
						<option value="Февраль">Февраль</option>
						<option value="Март">Март</option>
						<option value="Апрель">Апрель</option>
						<option value="Май">Май</option>
						<option value="Июнь">Июнь</option>
						<option value="Июль">Июль</option>
						<option value="Август">Август</option>
						<option value="Сентябрь">Сентябрь</option>
						<option value="Октябрь">Октябрь</option>
						<option value="Ноябрь">Ноябрь</option>
						<option value="Декабрь">Декабрь</option>
					</select>
					<input class="settings_select" name="year" type="text" size="1">
				</div>
			<div class="settings_text">Изменить пол</div>
				<select class="settings_select" name="sex" id="sex">
					<option value="0"></option>
					<option value="Мужской">Мужской</option>
					<option value="Женский">Женский</option>
				</select>
			<div>
			<button class="settings_but" type="submit">Применить</button><div class="settings_but"><a class="settings_link" href="profile.php">Отмена</a></div></div>
		</form>
	</body>
</html>