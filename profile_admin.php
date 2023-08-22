<!doctype html>
<html>
	<body class="profile_admin_background">
		<div class="profile_admin_block1"><?php require_once('header_personal_area.php'); ?></div>
		<div class="profile_admin_block2"><?php require_once('menu_personal_area.php'); ?></div>
		<div class="profile_admin_block3">
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
					"<div class=profile_admin_personal_info><div class=profile_admin_header_personal_info>Пользовательские данные.</div>
					<div class=profile_admin_avatar><img src={$ava}></div>
					<div class=profile_admin_info>{$first_name} {$middle_name} {$last_name}</br>
					E-mail: {$email}</br>
					Моб. Телефон: {$telephone}</br>
					Дата рождения: {$day}{$month}{$year}</br>
					Пол:{$sex}</div></div>";
			?>
		</div>
		<div class="profile_admin_block4">
			<div class="profile_admin_text">Добавить</div>
			<div class="profile_admin_add"><?php require_once('add.php'); ?></div>
		</div>
		<div class="profile_admin_block5">
			<div class="profile_admin_text">Пользователи</div>
			<div class="profile_admin_users">
    			<form action="">
					<input id="user" type="text">
					<input onclick="send();" value="Отправить" type="button">
				</form>
				<div id="users"></div>
			</div>
		</div>
		<div class="profile_admin_block6">
			<?php require_once('footer.php'); ?>
		</div>
		<script src="jQuery.js"></script>
		<script>
		    $(document).ready(function()
               {
                $(".profile_admin_text").click(function ()
                   {
                    $(this).siblings(".profile_admin_add").slideToggle("slow");
                   });
               })
			$(document).ready(function()
               {
                $(".profile_admin_text").click(function ()
                   {
                    $(this).siblings(".profile_admin_users").slideToggle("slow");
                   });
               })
			function send()
				{
                 var user = $('#user').val()
                 $.ajax(
					{
                     type: "POST",
                     url: "users.php",
                     data: "user="+user,
                     success: function(html)
						{
                         $("#users").empty();
                         $("#users").append(html);
						}
					});
				}
		</script>
	</body>
</html>