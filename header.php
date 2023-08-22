<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="Description" content="Шапка сайта">
	</head>
	<body>
		<div class="header">
			<div class="header_block1"><div class="header_working_hours">Доставка с 11:00 до 22:00</div><a class="header_telephone" href="tel:+7 (913) 555 16 00">+7(913)555-16-00</a></div>
			<div class="header_block2"><a href="index.php"><img class="header_logotip" src="img/logo-gt1.png"></a></div>
			<div class="header_block3">
				<div class="header_block_autentification_gorizontal">
					<?php 
						if(!$_SESSION['user'])
							{
							 echo "<a class=header_autentification_link href=reg.php>Регистрация</a><div class=header_autentification_link>/</div><a class=header_autentification_link href=auth.php>Вход</a>";
							}
						else
							{
							 echo
								"<a class=header_autentification_link href=profile.php>Личный кабинет</a>
								<form class=header_button_form action=logout.php>
									<button class=header_button type=submit>Выйти</button>
							 	</form>";
							}
	 				?>
				</div>
				<div class="header_block_autentification_vertical">
					<?php 
						if(!$_SESSION['user'])
							{
							 echo "<a class=header_autentification_link href=auth.php><img class=header_autentification_ico src=img/lklogo.png></a>";
							}
						else
							{
							 echo "<a class=header_autentification_link href=profile.php><img class=header_autentification_ico src=img/lklogo.png></a>";
							}
	 				?>
				</div>
				<div class="header_block_bucket">
					<?php
						$user_login = $_SESSION['user']['login'];
						$user_coocke = $_COOKIE['user'];
						if ($user_login)
							{
							 $user = $user_login;
							}
						else
							{
							 $user = $user_coocke;
							}
						$result = mysqli_query ($connect, "SELECT * FROM `bucket` WHERE id_user='$user' GROUP BY number_tovara");
						$qua = 0;
						while($row = mysqli_fetch_array($result))
							{
							 $qua += $row['qua'];
							}
						echo "<a class=header_bucket_link href=bucket.php>Корзина <img src=img/korzina1.png class=header_ico> (<span class=qua>{$qua}</span>)</a>"
					?>
				</div>
				<div class="header_promotions">
					<a class="header_promotions_link" href="promotions.php">Акции/Скидки</a>
				</div>
			</div>
		</div>
	</body>
</html>