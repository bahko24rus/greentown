<?php
	session_start();
	require_once('connect.php');
	$class = $_POST['class'];
	$biznes = $_POST['biznes'];
	$bludo = $_POST['bludo'];
	$name = $_POST['name'];
	$price = $_POST['price'];
	$weight = $_POST['weight'];
	$price2 = $_POST['price2'];
	$weight2 = $_POST['weight2'];
	$ingredients = $_POST['ingredients'];
	$compliment = $_POST['compliment'];
	$img_product = $_POST['img_product'];
	$img_name = $_FILES['img_product']['name'];
	$public_product = $_POST['public_product'];
	$lastid = mysqli_query ($connect, "SELECT MAX(id) as lastid FROM products");
	while($row = mysqli_fetch_array($lastid, MYSQLI_ASSOC))
	 	{
		 $id_product = $row['lastid'] + 1;
		}
	if($_FILES['img_product']['name'])
		{
		 if(preg_match('/[.](JPG)||(jpg)||(jpeg)||(JPEG)||(gif)||(GIF)||(png)||(PNG)$/',$_FILES['img_product']['name']))
	 		 {
			  if ($name && $price && $weight)
			  	{
			 	 if ($class == 7)
			  		{
					 if ($price2 && $weight2)
					 	{
						 $path = 'img/products/';
						 $filename = $_FILES['img_product']['name'];
						 $target = $path . $filename;
						 move_uploaded_file($_FILES['img_product']['tmp_name'], $target);
						 mysqli_query ($connect, "INSERT INTO products (`id_product`, `class`, `modify`, `name`, `price`, `weight`, `size`, `ingredients`, `img_product`, `public`) VALUES ('$id_product', '$class', 'dual', '$name', '$price', '$weight', 'small', '$ingredients', '$img_name', '$public_product')");
						 mysqli_query ($connect, "INSERT INTO products (`id_product`, `class`, `modify`, `name`, `price`, `weight`, `size`, `ingredients`, `img_product`, `public`) VALUES ('$id_product', '$class', 'dual', '$name', '$price2', '$weight2', 'big', '$ingredients', '$img_name', '$public_product')");
						 header('Location: profile.php');
					 	}
			 		 else
			  			{
						 $path = 'img/products/';
						 $filename = $_FILES['img_product']['name'];
						 $target = $path . $filename;
						 move_uploaded_file($_FILES['img_product']['tmp_name'], $target);
						 mysqli_query ($connect, "INSERT INTO products (`id_product`, `class`, `modify`, `name`, `price`, `weight`, `ingredients`, `img_product`, `public`) VALUES ('$id_product', '$class', '', '$name', '$price', '$weight', '$ingredients', '$img_name', '$public_product')");
						 header('Location: profile.php');
			  			}
			  		}
			 	 else if ($class == 20)
			  		{
					 $path = 'img/products/';
					 $filename = $_FILES['img_product']['name'];
					 $target = $path . $filename;
					 move_uploaded_file($_FILES['img_product']['tmp_name'], $target);
					 mysqli_query ($connect, "INSERT INTO products (`id_product`, `class`, `modify`, `day`, `bludo`, `name`, `price`, `img_product`, `public`) VALUES ('$id_product', '$biznes', 'biznes', '$biznes', '$bludo', '$name', '$price', '$img_name', '$public_product')");
					 header('Location: profile.php');
			  		}
			 	 else if ($class != 7 && $class != 20)
			  		{
					 $path = 'img/products/';
			    	 $target = $path . $img_name;
			  		 move_uploaded_file($_FILES['img_product']['tmp_name'], $target);
					 mysqli_query ($connect, "INSERT INTO products (`id_product`, `class`, `name`, `price`, `weight`, `ingredients`, `img_product`, `public`) VALUES ('$id_product', '$class', '$name', '$price', '$weight', '$ingredients', '$img_name', '$public_product')");
			  		 header('Location: profile.php');
			  		}
			 	 else
			  		{
					 $_SESSION['add_product_message'] = 'Заполните все поля';
					 header('Location: profile.php');
			  		}
			  	}
			  else
			  	{
				 $_SESSION['add_product_message'] = 'Заполните все поля';
				 header('Location: profile.php');
			  	}
	 		 }
		 else
			 {
			  $_SESSION['add_product_message'] = 'Картинка должен быть в формате <strong>JPG,GIF или PNG</strong>';
			  header('Location: profile.php');
			 }
	 	}
	else
		{
		 $_SESSION['add_product_message'] = 'Выберите картинку';
		 header('Location: profile.php');
		}
?>