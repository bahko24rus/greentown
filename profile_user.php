<!doctype html>
<html>
	<body class="profile_user_background">
		<div class="profile_user_block1"><?php require_once('header_personal_area.php'); ?></div>
		<div class="profile_user_block2"><?php require_once('menu_personal_area.php'); ?></div>
		<div class="profile_user_block3">
			<?php
				$login = $_SESSION['user']['login'];
				$result = mysqli_query ($connect, "SELECT * FROM users WHERE login = '$login'");
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
					{
					 $admin = $row['admin'];
					 $first_name = $row['first_name'];
					 $middle_name = $row['middle_name'];
					 $last_name = $row['last_name'];
					 $email = $row['email'];
					 $telephone = $row['telephone'];
					 $day = $row['day'];
					 $month = $row['month'];
					 $year = $row['year'];
					 $avatar = $row['avatar'];
					 $sex = $row['sex'];
					}
				$path = '../img/avatars/';
				if($avatar == '')
		 			{
					 $avatarka = 'noAvatar.jpg';
					}
				else
					{
					 $avatarka = $avatar;
					}
				$ava = $path.$avatarka;
				echo
					"<div class=profile_user_personal_info><div class=profile_user_header_personal_info>Пользовательские данные.</div>
					<div class=profile_user_avatar><img class=profile_user_avatar src={$ava}></div>
					<div class=profile_user_info>{$first_name} {$middle_name} {$last_name}</br>
					E-mail: {$email}</br>
					Моб. Телефон: {$telephone}</br>
					Дата рождения: {$day}{$month}{$year}</br>
					Пол:{$sex}</div></div>";
			?>
		</div>
		<div class="profile_user_block6">
			<?php require_once('footer.php'); ?>
		</div>
	</body>
</html>