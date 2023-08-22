<?php
	require_once('connect.php');
	$name = $_POST["user"];
	$result = mysqli_query ($connect, "SELECT * FROM users WHERE login='$name'");
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{
		 $login = $row['login'];
		 $email =  $row['email'];
		 $status = $row['status'];
		 $access = $row['access'];
		 echo
			"<div class=profile_admin_user>
				Логин: {$login}</br>
				Почта: {$email}</br>
				<form class=users_form action=save_settings.php method=post enctype=multipart/form-data>
					<div class=users_test>Статус: {$status}</div>
					<select class=users_select name=status id=status>
						<option value=admin>admin</option>
						<option value=moderator>moderator</option>
						<option value=user>user</option>
					</select>
					<input type=hidden name=user_name value=$name>
					<button class=settings_but type=submit>Изменить</button>
				</form>
				<form class=users_form action=save_settings.php method=post enctype=multipart/form-data>
					<div class=users_test>Доступ: {$access}</div>
					<select class=users_select name=access id=access>
						<option value=open>Открыт</option>
						<option value=block>Заблокирован</option>
					</select>
					<input type=hidden name=user_name value=$name>
					<button class=settings_but type=submit>Изменить</button>
				</form>
			</div>";
		}
?>
				