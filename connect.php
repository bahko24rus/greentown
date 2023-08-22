<?php
$connect = mysqli_connect ($host = 'localhost', $user = 'mysql', $password = 'mysql' , $db_name = 'greentown');
mysqli_query($connect,"SET NAMES 'utf8'");
mysqli_query($connect,"SET CHARACTER SET 'utf8'");
mysqli_query($connect,"SET SESSION collation_connection = 'utf8_general_ci'");
	if (!$connect)
		{
	 	die ('Erro conn to db');
		}
?>