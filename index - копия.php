<?php
	session_start();
	require_once('connect.php');
	$key = md5(microtime(true));
	if ($_COOKIE['user'] == null)
		{
		 setcookie(user, $key, time() + 60 * 60 * 24 * 3);
		}
	$week_day = date("w", mktime(0,0,0,date("m"),date("d"),date("Y")));
	$week_day += 30;
	$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$parse = parse_url($url);
	$url_domen = $parse['host'];
	if($url == "http://{$url_domen}/")
		{
		 header("Location: http://{$url_domen}/?category=2");
		}
	if($url == "http://{$url_domen}/?category=1")
		{
		 header("Location: http://{$url_domen}/?category=2");
		}
	if($url == "http://{$url_domen}/?category=15")
		{
		 header("Location: http://{$url_domen}/?category=16");
		}
	if($url == "http://{$url_domen}/?category=22")
		{
		 header("Location: http://{$url_domen}/?category=23");
		}
	if($url == "http://{$url_domen}/?category=30")
		{
		 header("Location: http://{$url_domen}/?category={$week_day}");
		}
	if($url == "http://{$url_domen}/?category=36")
		{
		 header("Location: http://{$url_domen}/?category=37");
		}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Greentown</title>
		<link rel="icon" href="img/logo-gt_50.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="Description" content="Краткое описание содержания страницы">
	</head>
	<body class="index_background">
		<div><a id="top"/></div>
		<div><?php require_once('header.php'); ?></div>
		<div class="index_block_menu"><?php require_once("category.php"); ?></div>
		<div class="index_products_menu"><?php require_once('show_product.php'); ?></div>
		<div><?php require_once('footer.php'); ?></div>
		<div><a class="index_batton_top" href="#top"><img class="index_ico" src="img/buttonup.png"></a></div>
	</body>
</html>