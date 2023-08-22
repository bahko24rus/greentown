<?php
	session_start();
	require_once('connect.php');
	$user_telephone = "{$argv[1]}\n";
	$to = "bahko45k@mail.ru";
	$i = 0;
	$order = array();
	$order[$i] = array("Название", "Ингридиенты", "Кол-во", "Размер");
	$result = mysqli_query ($connect, "SELECT * FROM `orders` WHERE telephone='$user_telephone'");
	while ($row = mysqli_fetch_array($result))
		{
		 $i++;
		 $id_product = $row['id_product'];
		 $qua = $row['qua'];
		 $size = $row['size'];
		 $result2 = mysqli_query ($connect, "SELECT * FROM `products` WHERE id='$id_product'");
		 while ($row2 = mysqli_fetch_array($result2))
		 	{
			 $name = $row2['name'];
			 $ingredients = $row2['ingredients'];
		 	}
    	 $order[$i] = array($name, $ingredients, $qua, $size);
		}
	mail ($to, $user_telephone, "Новый заказ!");
?>