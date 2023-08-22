<?php
	session_start();
	require_once('connect.php');
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title>Доставки</title>
		<link rel="icon" href="img/logo-gt_50.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="Description" content="Информация о доставке">
	</head>
	<body class="dostavka_background">
		<?php require_once('header.php'); ?>
		<div class="dostavka_block_menu"><?php require_once("category.php"); ?></div>
		<div class="dostavka_background_block">
			<div class="dostavka_block">
      			<h1>Условия доставки и оплаты</h1></br>
      			<h2><p>Заказы принимаем и обрабатываем с 11:00 до 22:00</p>
      			<p>Способы получения заказа: самовывоз или доставка.</p>
      			<p>Минимальная сумма заказа для доставки:</p></h2>
      			<h3><p>- в пределах города - 600 р.</p>
      			<p>- поселок Октябрьский, 1000 дворов, Овражное - 900 р.</p>
      			<p>- Орловка - 1100 р.</p>
      			<p>- ЭХЗ - 1200 р.</p>
      			<p>- ГРЭС - 1300 р.</p>
      			<p>- КПП, Сокаревка - 1500 р.</p>
      			<p>- Березка, Усовка - 1800 р.</p></h3>
      			<h2><p>При самовывозе сумма заказа не ограничена!</p>
      			<p>Оплата производится при получении наличным и безналичным способом.</p></h2>
			</div>
		</div>
		<div>
			<?php
				require_once('footer.php');
			?>
		</div>
	</body>
</html>
