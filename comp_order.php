<?php
	session_start();
	require_once('connect.php');
	$user_login = $_SESSION['user']['login'];
	$user_coocke = $_COOKIE['user'];
	$user_telephone = $_POST['telephone'];
	$to = "bahko45k@mail.ru";
	date_default_timezone_set('Asia/Irkutsk');
	$time1 = date("d:F:Y");
	$time2 = date("H:i:s");
	$time = $time1 + $time2;
	if ($user_login)
		{
		 $user = $user_login;
		}
	else
		{
		 $user = $user_coocke;
		}
	if (!$user_telephone)
		{
		 $telephone = mysqli_fetch_array(mysqli_query ($connect, "SELECT telephone FROM `users` WHERE login='$user_login'"));
		 $user_telephone = $telephone['telephone'];
		}
	$row_number_last_order = mysqli_fetch_array(mysqli_query ($connect, "SELECT number_order FROM `system_table`"));
	$number_last_order = $row_number_last_order['number_order'];
	$check_user = mysqli_num_rows(mysqli_query ($connect, "SELECT * FROM `orders` WHERE telephone='$user_telephone'"));
	if (!$check_user)
		{
		 $result = mysqli_query ($connect, "SELECT * FROM `bucket` WHERE id_user='$user'");
		 while ($row = mysqli_fetch_array($result))
			{
			 $number_tovara = $row['number_tovara'];
			 $id_product = $row['id_product'];
			 $qua = $row['qua'];
			 $size = $row['size'];
			 $modify = $row['modify'];
			 mysqli_query ($connect, "INSERT INTO `orders` (`id`, `id_user`, `telephone`, `number_tovara`, `id_product`, `qua`, `size`, `modify`, `number_order`, `first_time`, `second_time`, `third_time`, `status`, `new_message`) VALUES (NULL, '$user', '$user_telephone', '$number_tovara', '$id_product', '$qua', '$size', '$modify', '$number_last_order', '$time', 0, 0, 'Ожидание...', '1')");
			}
		 if ($user_login)
			{
			 mysqli_query ($connect, "DELETE FROM `bucket` WHERE id_user='$user'");
			 header('Location: profile.php');
			 mail ($to, $user_telephone, "Новый заказ! Тел. {$user_telephone}");
			}
		 else
			{
			 mysqli_query ($connect, "DELETE FROM `bucket` WHERE id_user='$user'");
			 header('Location: index.php');
			 mail ($to, $user_telephone, "Новый заказ! Тел. {$user_telephone}");
			}
		 $number_last_order++;
		 mysqli_query ($connect, "UPDATE `system_table` SET number_order='$number_last_order'");
		}
	else
		{
		 $result2 = mysqli_query ($connect, "SELECT * FROM `bucket` WHERE id_user='$user'");
		 while ($row2 = mysqli_fetch_array($result2))
			{
			 $number_tovara = $row2['number_tovara'];
			 $id_product = $row2['id_product'];
			 $qua = $row2['qua'];
			 $size = $row2['size'];
			 $modify = $row2['modify'];
			 $check_order = mysqli_num_rows(mysqli_query ($connect, "SELECT * FROM `orders` WHERE telephone='$user_telephone' AND status='Ожидание...'"));
			 if (!$check_order)
				{
				 mysqli_query ($connect, "INSERT INTO `orders` (`id`, `id_user`, `telephone`, `number_tovara`, `id_product`, `qua`, `size`, `modify`, `number_order`, `first_time`, `second_time`, `third_time`, `status`, `new_message`) VALUES (NULL, '$user', '$user_telephone', '$number_tovara', '$id_product', '$qua', '$size', '$modify', '$number_last_order', '$time', 0, 0, 'Ожидание...', '1')");
				}
			 else
			 	{
				 $row_number_order = mysqli_fetch_array(mysqli_query ($connect, "SELECT number_order FROM `orders` WHERE telephone='$user_telephone' AND status='Ожидание...'"));
		 	 	 $number_order = $row_number_order['number_order'];
				 $check_product = mysqli_num_rows(mysqli_query ($connect, "SELECT * FROM `orders` WHERE id_product='$id_product' AND telephone='$user_telephone' AND number_order='$number_order' AND size='$size'"));
				 if ($check_product)
				 	{
					 $qua_order_row = mysqli_fetch_array(mysqli_query ($connect, "SELECT qua FROM `orders` WHERE id_product='$id_product' AND telephone='$user_telephone' AND number_order='$number_order' AND size='$size'"));
					 $qua_order = $qua_order_row['qua'];
					 $qua_total = $qua + $qua_order;
					 mysqli_query ($connect, "UPDATE `orders` SET qua='$qua_total' WHERE id_product='$id_product' AND telephone='$user_telephone' AND number_order='$number_order' AND size='$size'");
				 	}
				 else
					{
					 mysqli_query ($connect, "INSERT INTO `orders` (`id`, `id_user`, `telephone`, `number_tovara`, `id_product`, `qua`, `size`, `modify`, `number_order`, `first_time`, `second_time`, `third_time`, `status`, `new_message`) VALUES (NULL, '$user', '$user_telephone', '$number_tovara', '$id_product', '$qua', '$size', '$modify', '$number_order', '$time', 0, 0, 'Ожидание...', '1')");
					}
			 	}
			}
		 if ($user_login)
			{
			 mysqli_query ($connect, "DELETE FROM `bucket` WHERE id_user='$user'");
			 header('Location: profile.php');
			 mail ($to, $user_telephone, "Новый заказ! Тел. {$user_telephone}");
			}
		 else
			{
			 mysqli_query ($connect, "DELETE FROM `bucket` WHERE id_user='$user'");
			 header('Location: index.php');
			 mail ($to, $user_telephone, "Новый заказ! Тел. {$user_telephone}");
			}
		 $number_last_order++;
		 mysqli_query ($connect, "UPDATE `system_table` SET number_order='$number_last_order'");
		}
	
?>
