<?php
	session_start();
	require_once('connect.php');
	$number_order = $_POST['number_order'];
	$id = $_POST['id_product'];
	$operation = $_POST['operation'];
	$user_login = $_SESSION['user']['login'];
	$user_coocke = $_COOKIE['user'];
	$new_message = $_POST['new_message'];
	if ($user_login)
		{
		 $user = $user_login;
		 $telephone = mysqli_fetch_array(mysqli_query ($connect, "SELECT telephone FROM `users` WHERE login='$user_login'"));
		 $user_telephone = $telephone['telephone'];
		}
	else
		{
		 $user = $user_coocke;
		}
	date_default_timezone_set('Asia/Irkutsk');
	$time = date("H:i:s");
	if ($number_order)
		{
		 $result = mysqli_query ($connect, "SELECT * FROM `orders` WHERE number_order='$number_order'");
		 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
			 $status_order = $row['status'];
			 $user_bucket = $row['id_user'];
			 if ($status_order == "Ожидание...")
		 		{
				 mysqli_query ($connect, "UPDATE orders SET status='Готовится...', second_time='$time' WHERE number_order='$number_order'");
		 		}
			 else if ($status_order == "Готовится...")
		 		{
				 mysqli_query ($connect, "UPDATE `orders` SET `status`='Готов', `third_time`='$time' WHERE number_order='$number_order'");
		 		}
			 else
		 		{
				 $id_user = $row['id_user'];
				 $telephone = $row['telephone'];
				 $nomber_tovara = $row['number_tovara'];
				 $id_product = $row['id_product'];
				 $qua = $row['qua'];
				 $size = $row['size'];
				 $modify = $row['modify'];
				 $first_time = $row['first_time'];
				 $second_time = $row['second_time'];
				 $third_time = $row['third_time'];
				 mysqli_query ($connect, "INSERT INTO order_history (`id`, `id_user`, `telephone`, `number_tovara`, `id_product`, `qua`, `size`, `modify`, `number_order`, `first_time`, `second_time`, `third_time`, `status`) VALUES (NULL, '$id_user', '$telephone', '$nomber_tovara', $id_product, '$qua', '$size', '$modify', '$number_order', '$first_time', '$second_time', '$third_time', 'Доставлено')");
				 mysqli_query ($connect, "DELETE FROM orders WHERE number_order='$number_order'");
		 		}
			}
		}
	if ($operation)
		{
		 $product_order = mysqli_query ($connect, "SELECT * FROM `bucket` WHERE id_product='$id' AND id_user='$user'");
		 while ($row_product_order = mysqli_fetch_array($product_order, MYSQLI_ASSOC))
		 	{
			 $id_bucket = $row_product_order['id'];
			 $id_product_bucket = $row_product_order['id_product'];
			 $qua_bucket = $row_product_order['qua'];
			 $size_bucket = $row_product_order['size'];
		 	}
		 $row_quantity = mysqli_fetch_array(mysqli_query ($connect, "SELECT qua FROM `bucket` WHERE number_tovara='$id' AND id_user='$user'"), MYSQLI_ASSOC);
		 if ($operation == "minus")
			{
			 $quantity = $row_quantity['qua'] - 1;
			 if ($quantity > 0)
			 	{
				 mysqli_query ($connect, "UPDATE `bucket` SET `qua`=$quantity WHERE number_tovara='$id' AND id_user='$user'");
			 	}
			}
		 if ($operation == "plus")
		 	{
			 $quantity = $row_quantity['qua'] + 1;
			 mysqli_query ($connect, "UPDATE `bucket` SET `qua`=$quantity WHERE number_tovara='$id' AND id_user='$user'");
		 	}
		 if ($operation == "delete")
		 	{
			 mysqli_query ($connect, "DELETE FROM `bucket` WHERE number_tovara='$id'");
		 	}
		 if ($operation == "delete_all")
		 	{
			 mysqli_query ($connect, "DELETE FROM `bucket` WHERE id_user='$id'");
		 	}
		}
	if ($new_message)
		{
		 mysqli_query ($connect, "UPDATE `orders` SET `new_message`='0' WHERE number_order='$new_message'");
		}
?>