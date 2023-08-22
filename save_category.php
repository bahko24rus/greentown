<?php
	session_start();
	require_once('connect.php');
	$name = $_POST['name'];
	$public = $_POST['public'];
	if($name)
		{
		 mysqli_query ($connect, "INSERT INTO `categories` (`name`, `public`) VALUES ('$name', '$public')");
		 header('Location: profile.php');
		}
	else
		{
		 $_SESSION['message_add_product'] = 'Заполните все поля';
		 header('Location: profile.php');
		}
?>