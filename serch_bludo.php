<?php
	require_once('connect.php');
	$serch_id = $_POST["serch_id"];
	$id_bludo = $_POST["id_bludo"];
	$path = 'img/products/';
	if ($id_bludo == '')
		{
		 $result = mysqli_query ($connect, "SELECT * FROM products");
		}
	else if ($serch_id == 1)
		{	
		 $result = mysqli_query ($connect, "SELECT * FROM products WHERE id_product LIKE '$id_bludo'");
		}
	else if ($serch_id == 2)
		{	
		 $result = mysqli_query ($connect, "SELECT * FROM products WHERE class LIKE '$id_bludo'");
		}
	else if ($serch_id == 3)
		{	
		 $result = mysqli_query ($connect, "SELECT * FROM products WHERE name LIKE '%$id_bludo%'");
		}
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{
		 $id_product = $row['id_product'];
		 $class =  $row['class'];
		 $name = $row['name'];
		 $price = $row['price'];
		 $weight = $row['weight'];
		 $size = $row['size'];
		 $ingredients = $row['ingredients'];
		 $img_product = $row['img_product'];
		 $img = "<img class=favorites_img width=100% src='$path/$img_product'>";
		 $public = $row['public'];
		 $modify = $row['modify'];
		 $result_class = mysqli_fetch_array(mysqli_query($connect, "SELECT name FROM categories WHERE id=$class"));
		 $class = $result_class['name'];
		 if ($modify == '')
		 	{
			 echo
				"<div class=serch_bludo>
					<div class=serch_bludo>{$img}</div>
					<div class=serch_bludo>Категория: {$class}</div>
					<div class=serch_bludo>Название: {$name}</div>
					<div class=serch_bludo>Ингридиенты: {$ingredients}</div>
					<div class=serch_bludo>Цена: {$price}</div>
					<div class=serch_bludo>Вес: {$weight}</div>
				</div>";
		 	}
		 if ($modify == 'dual')
		 	{
			 echo
				"<div class=serch_bludo>
					<div class=serch_bludo>{$img}</div>
					<div class=serch_bludo>Категория: {$class}</div>
					<div class=serch_bludo>Название: {$name}</div>
					<div class=serch_bludo>Ингридиенты: {$ingredients}</div>
					<div class=serch_bludo>Цена: {$price}</div>
					<div class=serch_bludo>Вес: {$weight}</div>
					<div class=serch_bludo>Размер: {$size}</div>
				</div>";
		 	}
		 if ($modify == 'biznes')
		 	{
			 echo
				"<div class=serch_bludo>
					<div class=serch_bludo>{$img}</div>
					<div class=serch_bludo>Категория: {$class}</div>
					<div class=serch_bludo>Название: {$name}</div>
					<div class=serch_bludo>Ингридиенты: {$ingredients}</div>
					<div class=serch_bludo>Цена: {$price}</div>
				</div>";
		 	}
		}
?>
				