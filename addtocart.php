<?php
	session_start();
	require_once('connect.php');
	$user_login = $_SESSION['user']['login'];
	$user_coocke = $_COOKIE['user'];
	$id = $_POST["id"];
	$size = $_POST['size'];
	$number_order = $_POST['number_order'];
	if ($user_login)
		{
		 $user = $user_login;
		}
	else
		{
		 $user = $user_coocke;
		}
	$row_number_last_tovara = mysqli_fetch_array(mysqli_query ($connect, "SELECT number_tovara FROM system_table"));
	$number_last_tovara = $row_number_last_tovara['number_tovara'];
	if ($id)
		{
		 $modify_tovara = mysqli_fetch_array(mysqli_query ($connect, "SELECT modify FROM products WHERE id_product='$id'"));
		 $modify = $modify_tovara['modify'];
		 $check_user = mysqli_num_rows(mysqli_query ($connect, "SELECT id_user FROM bucket WHERE id_user='$user'"));
		 if ($check_user == 0)
			{
			 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `size`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$id', 1, '$size', '$modify', '0')");
			 $number_last_tovara++;
			 mysqli_query ($connect, "UPDATE `system_table` SET number_tovara='$number_last_tovara'");
			}
		 else
			{
			 $id_product = mysqli_num_rows(mysqli_query ($connect, "SELECT id FROM bucket WHERE id_product='$id' AND id_user='$user' AND size='$size'"));
			 if($id_product == 0)
		 		{
				 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `size`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$id', 1, '$size', '$modify', '0')");
				 $number_last_tovara++;
				 mysqli_query ($connect, "UPDATE `system_table` SET number_tovara='$number_last_tovara'");
				}
			 else
		 		{
				 $row_qua = mysqli_fetch_array(mysqli_query ($connect, "SELECT qua FROM bucket WHERE id_product='$id' AND id_user='$user' AND size='$size'"), MYSQLI_ASSOC);
				 $qua = $row_qua['qua'] + 1;
				 mysqli_query ($connect, "UPDATE bucket SET qua=$qua WHERE id_product='$id' AND id_user='$user' AND size='$size'");
		 		}
			}
		}
	else if ($number_order)
		{
		 $result_order_history = mysqli_query ($connect, "SELECT * FROM order_history WHERE number_order='$number_order' GROUP BY number_tovara");
		 while($row_order_history = mysqli_fetch_array($result_order_history, MYSQLI_ASSOC))
		 	{
			 $modify_history_order = $row_order_history['modify'];
			 $number_tovara_history_order = $row_order_history['number_tovara'];
			 $qua_history_order = $row_order_history['qua'];
			 if ($modify_history_order == '')
			 	{
				 $result = mysqli_query ($connect, "SELECT * FROM order_history WHERE number_order='$number_order' AND modify='$modify_history_order' AND number_tovara='$number_tovara_history_order'");
				 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		 			{
					 $id_product_history_order = $row['id_product'];
					 $qua_history_order = $row['qua'];
					 $result = mysqli_query ($connect, "SELECT * FROM bucket WHERE id_product='$id_product_history_order'");
					 $check_product = mysqli_num_rows ($result);
					 if ($check_product)
					 	{
						 $row = mysqli_fetch_array($result);
						 $qua = $row['qua'];
						 $qua_summ = $qua + $qua_history_order;
						 mysqli_query ($connect, "UPDATE bucket SET qua='$qua_summ' WHERE id_product='$id_product_history_order'");
					 	}
					 else
					 	{
						 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `size`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$id_product_history_order', '$qua_history_order', '$size_history_order', '$modify_history_order', '0')");
						 $number_last_tovara++;
						 mysqli_query ($connect, "UPDATE `system_table` SET number_tovara='$number_last_tovara'");
					 	}
		 			}
			 	}
			 else if ($modify_history_order == 'dual')
		 		{
				 $result = mysqli_query ($connect, "SELECT * FROM order_history WHERE number_order='$number_order' AND modify='$modify_history_order' AND number_tovara='$number_tovara_history_order'");
				 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		 			{
					 $id_product_history_order = $row['id_product'];
					 $qua_history_order = $row['qua'];
					 $size_history_order = $row['size'];
					 $result = mysqli_query ($connect, "SELECT * FROM bucket WHERE id_product='$id_product_history_order'");
					 $check_product = mysqli_num_rows ($result);
					 if ($check_product)
					 	{
						 $row = mysqli_fetch_array($result);
						 $qua = $row['qua'];
						 $qua_summ = $qua + $qua_history_order;
						 mysqli_query ($connect, "UPDATE bucket SET qua='$qua_summ' WHERE id_product='$id_product_history_order' AND size='$size_history_order'");
					 	}
					 else
					 	{
						 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `size`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$id_product_history_order', '$qua_history_order', '$size_history_order', '$modify_history_order', '0')");
						 $number_last_tovara++;
						 mysqli_query ($connect, "UPDATE `system_table` SET number_tovara='$number_last_tovara'");
					 	}
		 			}
		 		}
			 else if ($modify_history_order == 'biznes')
			 	{
				 $row_biznes_id_order_history = mysqli_fetch_array(mysqli_query ($connect, "SELECT GROUP_CONCAT(id_product) AS biznes_id_order_history FROM order_history WHERE number_order='$number_order' AND modify='$modify_history_order' AND number_tovara='$number_tovara_history_order'"));
				 $biznes_id_order_history = $row_biznes_id_order_history['biznes_id_order_history'];
				 $result = mysqli_query ($connect, "SELECT number_tovara FROM bucket WHERE modify='biznes' GROUP BY number_tovara");
				 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
				 	{
					 $number_tovara_bucket = $row['number_tovara'];
					 $row_biznes_id_bucket = mysqli_fetch_array(mysqli_query ($connect, "SELECT GROUP_CONCAT(id_product) AS biznes_id_bucket FROM bucket WHERE modify='$modify_history_order' AND number_tovara='$number_tovara_bucket'"));
					 $biznes_id_bucket = $row_biznes_id_bucket['biznes_id_bucket'];
					 if ($biznes_id_order_history == $biznes_id_bucket)
						{
						 $key2 = $biznes_id_bucket;
						 break;
						}
					 else
						{
						 $key2 = 0;

						}
				 	}
				 if ($key2 != 0)
				 	{
					 $result2 = mysqli_query ($connect, "SELECT qua FROM bucket WHERE modify='$modify_history_order' AND number_tovara='$number_tovara_bucket'");
					 while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
					 	{
						 $qua_bucket = $row2['qua'];
						 $qua = $qua_bucket + $qua_history_order;
					 	}
					 mysqli_query ($connect, "UPDATE bucket SET qua=$qua WHERE modify='$modify_history_order' AND number_tovara='$number_tovara_bucket'");
				 	}
				 else
				 	{
					 $result3 = mysqli_query ($connect, "SELECT * FROM order_history WHERE number_order='$number_order' AND modify='$modify_history_order' AND number_tovara='$number_tovara_history_order'");
					 while($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC))
				 		{
						 $id_product_history_order = $row3['id_product'];
						 $qua_history_order = $row3['qua'];
						 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$id_product_history_order', '$qua_history_order', 'biznes','0')");
				 		}
					 $number_last_tovara++;
					 mysqli_query ($connect, "UPDATE `system_table` SET number_tovara='$number_last_tovara'");
				 	}
			 	}
		 	}
		}
	else
		{
		 $first_id = $_POST['first_id'];
		 $second_id = $_POST['second_id'];
		 $third_id = $_POST['third_id'];
		 $fourth_id = $_POST['fourth_id'];
		 $biznes_id = $_POST['biznes_id'];
		 $week_day = date("w", mktime(0,0,0,date("m"),date("d"),date("Y")));
		 $week_day += 30;
		 if ($first_id && $second_id && $third_id && $fourth_id)
		 	{
			 $check_user = mysqli_num_rows (mysqli_query ($connect, "SELECT id_user FROM bucket WHERE id_user='$user'"));
			 if ($biznes_id == $week_day)
				{
				 if ($check_user == 0)
					{
					 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$first_id', 1, 'biznes', '0')");
					 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$second_id', 1, 'biznes', '0')");
					 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$third_id', 1, 'biznes', '0')");
					 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$fourth_id', 1, 'biznes', '0')");
					 $result = mysqli_query ($connect, "SELECT id_product FROM products WHERE bludo='5' AND public='1'");
					 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		 				{
						 $id_biznes_addition = $row['id_product'];
						 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$id_biznes_addition', 1, 'biznes', '0')");
		 				}
					 $number_last_tovara++;
					 mysqli_query ($connect, "UPDATE `system_table` SET number_tovara='$number_last_tovara'");
					}
				 else
					{
					 $id_product = mysqli_num_rows (mysqli_query ($connect, "SELECT id FROM bucket WHERE (id_product='$first_id' OR id_product='$second_id') AND id_user='$user'"));
					 if($id_product == 0)
		 				{
						 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$first_id', 1, 'biznes', '0')");
						 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$second_id', 1, 'biznes', '0')");
						 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$third_id', 1, 'biznes', '0')");
						 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$fourth_id', 1, 'biznes', '0')");
						 $result2 = mysqli_query ($connect, "SELECT id_product FROM products WHERE bludo='5'");
						 while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
		 					{
							 $id_biznes_addition = $row2['id_product'];
							 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$id_biznes_addition', 1, 'biznes', '0')");
		 					}
						 $number_last_tovara++;
						 mysqli_query ($connect, "UPDATE `system_table` SET number_tovara='$number_last_tovara'");
						}
					 else
		 				{
						 $result3 = mysqli_query ($connect, "SELECT number_tovara FROM bucket WHERE modify='biznes' AND id_user='$user' GROUP BY number_tovara");
						 while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC))
				 			{
							 $number_tovara = $row3['number_tovara'];
							 $first = mysqli_num_rows (mysqli_query ($connect, "SELECT id FROM bucket WHERE id_user='$user' AND id_product='$first_id' AND number_tovara='$number_tovara'"));
							 $second = mysqli_num_rows (mysqli_query ($connect, "SELECT id FROM bucket WHERE id_user='$user' AND id_product='$second_id' AND number_tovara='$number_tovara'"));
							 $third = mysqli_num_rows (mysqli_query ($connect, "SELECT id FROM bucket WHERE id_user='$user' AND id_product='$third_id' AND number_tovara='$number_tovara'"));
							 $fourth = mysqli_num_rows (mysqli_query ($connect, "SELECT id FROM bucket WHERE id_user='$user' AND id_product='$fourth_id' AND number_tovara='$number_tovara'"));
							 if ($first && $second && $third && $fourth)
					 			{
								 $key = $number_tovara;
					 			}
				 			}
						 if ($key)
				 			{
							 $result_key = mysqli_query ($connect, "SELECT qua FROM bucket WHERE modify='biznes' AND id_user='$user' AND number_tovara='$key'");
							 while ($row_key = mysqli_fetch_array($result_key, MYSQLI_ASSOC))
					 			{
								 $qua_biznes = $row_key['qua'] + 1;
								 mysqli_query ($connect, "UPDATE bucket SET qua='$qua_biznes' WHERE modify='biznes' AND id_user='$user' AND number_tovara='$key'");
					 			}
				 			}
						 else
				 			{
							 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$first_id', 1, 'biznes', '0')");
							 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$second_id', 1, 'biznes', '0')");
							 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$third_id', 1, 'biznes', '0')");
							 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$fourth_id', 1, 'biznes', '0')");
							 $result4 = mysqli_query ($connect, "SELECT id_product FROM products WHERE bludo='5'");
							 while($row4 = mysqli_fetch_array($result4, MYSQLI_ASSOC))
		 						{
								 $id_biznes_addition = $row4['id_product'];
								 mysqli_query ($connect, "INSERT INTO bucket (`id_user`, `number_tovara`, `id_product`, `qua`, `modify`, `promo`) VALUES ('$user', '$number_last_tovara', '$id_biznes_addition', 1, 'biznes', '0')");
		 						}
							 $number_last_tovara++;
							 mysqli_query ($connect, "UPDATE `system_table` SET number_tovara='$number_last_tovara'");
				 			}
						}
		 			}
				}
			}
		}
?>