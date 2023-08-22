<?php
	session_start();
	require_once('connect.php');
	$user_login = $_SESSION['user']['login'];
	$id = $_POST["id"];
	$result = mysqli_fetch_array(mysqli_query ($connect, "SELECT id_favorites FROM system_table"));
	$id_favorites = $result['id_favorites'];
	if ($id)
		{
		 $modify_tovara = mysqli_fetch_array(mysqli_query ($connect, "SELECT modify FROM products WHERE id_product='$id'"));
		 $modify = $modify_tovara['modify'];
		 mysqli_query ($connect, "INSERT INTO favorites (`id_user`, `id_favorites`, `id_product`, `modify`) VALUES ('$user_login', '$id_favorites', '$id', '$modify')");
		 $id_favorites++;
		 mysqli_query ($connect, "UPDATE `system_table` SET id_favorites='$id_favorites'");
		}
	else
		{
		 $first_id = $_POST['first_id'];
		 $second_id = $_POST['second_id'];
		 $third_id = $_POST['third_id'];
		 $fourth_id = $_POST['fourth_id'];
		 mysqli_query ($connect, "INSERT INTO favorites (`id_user`, `id_favorites`, `id_product`, `modify`) VALUES ('$user_login', '$id_favorites', '$first_id', 'biznes')");
		 mysqli_query ($connect, "INSERT INTO favorites (`id_user`, `id_favorites`, `id_product`, `modify`) VALUES ('$user_login', '$id_favorites', '$second_id', 'biznes')");
		 mysqli_query ($connect, "INSERT INTO favorites (`id_user`, `id_favorites`, `id_product`, `modify`) VALUES ('$user_login', '$id_favorites', '$third_id', 'biznes')");
		 mysqli_query ($connect, "INSERT INTO favorites (`id_user`, `id_favorites`, `id_product`, `modify`) VALUES ('$user_login', '$id_favorites', '$fourth_id', 'biznes')");
		 $result = mysqli_query ($connect, "SELECT id_product FROM products WHERE bludo='5' AND public='1'");
		 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		 	{
			 $id_biznes_addition = $row['id_product'];
			 mysqli_query ($connect, "INSERT INTO favorites (`id_user`, `id_favorites`, `id_product`, `modify`) VALUES ('$user_login', '$id_favorites', '$id_biznes_addition', 'biznes')");
			}
		 $id_favorites++;
		 mysqli_query ($connect, "UPDATE `system_table` SET id_favorites='$id_favorites'");
		}
?>