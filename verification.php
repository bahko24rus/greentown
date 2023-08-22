<?php
	session_start();
	require_once("connect.php");
	$token_url = htmlspecialchars($_GET["token"]);
	mysqli_query ($connect, "UPDATE users SET verification='1', token='NULL' WHERE token='$token_url'");
	header('Location: ../auth.php');
?>