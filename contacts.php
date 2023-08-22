<?php
	session_start();
	require_once('connect.php');
	if(!$_SESSION['user'])
		{
		 header('Location: index.php');
		}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Контакты</title>
		<link rel="icon" href="img/logo-gt_50.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body class="contacts_background">
		<div class="contacts_block1"><?php require_once('header_personal_area.php'); ?></div>
		<div class="contacts_block2"><?php require_once('menu_personal_area.php'); ?></div>
		<div class="contacts_block3">
			В разработке...
		</div>
		<div class="contacts_block6">
			<?php require_once('footer.php'); ?>
		</div>
	</body>
</html>