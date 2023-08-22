<?php
	session_start();
	require_once('connect.php');
	if(!$_SESSION['user'])
		{
		 header('Location: index.php');
		}
	$user_login = $_SESSION['user']['login'];
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Избранное</title>
		<link rel="icon" href="img/logo-gt_50.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body class="favorites_background">
		<div class="favorites_block1"><?php require_once('header_personal_area.php'); ?></div>
		<div class="favorites_block2"><?php require_once('menu_personal_area.php'); ?></div>
		<div class="favorites_block3">
			<?php
				$path = 'img/products/';
				$result = mysqli_query($connect, "SELECT * FROM favorites WHERE id_user='$user_login' GROUP BY id_favorites");
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
					{
					 $id_favorites = $row['id_favorites'];
					 $modify = $row['modify'];
					 echo "<div class=favorites_block_product>";
						if($modify == '')
							{
							 $row_id_product = mysqli_fetch_array(mysqli_query($connect, "SELECT id_product FROM favorites WHERE id_user='$user_login' AND id_favorites='$id_favorites'"));
							 $id_product = $row_id_product['id_product'];
							 $result2 = mysqli_query ($connect, "SELECT * FROM products WHERE id_product='$id_product'");
							 while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
							 	{
								 $name = $row2['name'];
								 $img_prdct = $row2['img_product'];
								 $img_product = "<img class=favorites_img width=100% src='$path/$img_prdct'>";
								 $ingredients = $row2['ingredients'];
								 $price = $row2['price'];
								 $weight = $row2['weight'];
								 $public = $row2['public'];
								 if ($public == '1')
								 	{
									 echo
										"<div class=favorites_img>{$img_product}</div>
										<div class=favorites_name>{$name}</div>
										<div class=favorites_ingredients>{$ingredients}</div>
										<div class=favorites_weight_price>
											<div class=favorites_weight>Вес:{$weight}</div>
											<div class=favorites_price>Цена:{$price}</div>
										</div>
										<button class=favorites_button_add_to_bucket type=submit id_product={$id_product}>Заказать</button>";
								 	}
								 else
								 	{
									 echo
										"<div class=favorites_img>{$img_product}</div>
										<div class=favorites_name>{$name}</div>
										<div class=favorites_ingredients>{$ingredients}</div>
										<div class=favorites_weight_price>
											<div class=favorites_weight>Вес:{$weight}</div>
											<div class=favorites_price>Цена:{$price}</div>
										</div>
										<div class=favorites_product_none>Извините блюда нет</div>";
								 	}
							 	}
							}
						if($modify == 'dual')
							{
							 $row_id_product = mysqli_fetch_array(mysqli_query($connect, "SELECT id_product FROM favorites WHERE id_user='$user_login' AND id_favorites='$id_favorites'"));
							 $id_product = $row_id_product['id_product'];
							 $result3 = mysqli_query ($connect, "SELECT * FROM products WHERE id_product='$id_product' GROUP BY id_product");
							 while($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC))
		 						{
								 $name = $row3['name'];
								 $ingredients = $row3['ingredients'];
								 $img_prdct = $row3['img_product'];
								 $img_product = "<img class=favorites_img width=100% src='$path/$img_prdct'>";
								 echo
								 	"<div class=favorites_img>{$img_product}</div>
									<div class=favorites_name>{$name}</div>
									<div class=favorites_ingredients>{$ingredients}</div>
									<div class=favorites_weight_price_pizza>";
		 								$result4 = mysqli_query ($connect, "SELECT * FROM products WHERE id_product='$id_product'");
		 								while($row4 = mysqli_fetch_array($result4, MYSQLI_ASSOC))
		 									{
											 $public = $row4['public'];
											 $weight = $row4['weight'];
											 $size = $row4['size'];
											 $price = $row4['price'];
											 if ($public == 1)
					 							{
												 echo "<button class=favorites_size_price_pizza size={$size} id_size={$id_product}>Вес:{$weight} Цена:{$price}</button>";
					 							}
											 else
											 	{
												 echo "<button class=favorites_pizza_none>Извините блюда нет</button>";
											 	}
		 									}
		 								echo "<button class=favorites_button_add_to_bucket_pizza type=submit id_product={$id_product}>Заказать</button>
								 	</div>";
		 						}
							}
					 echo "</div>";
					}
			?>
		</div>
		<div class="favorites_block6">
			<?php require_once('footer.php'); ?>
		</div>
		<script src="jQuery.js"></script>
		<script>
			$(document).ready(function()
				{
				 var size;
				 $('.favorites_size_price_pizza').click(function()
					{
					 var id_pizza = $(this).attr('id_size');
					 var el = $('[id_size = '+id_pizza+']');
					 el.removeClass('favorites_size_price_pizza_active');
					 this.classList.add('favorites_size_price_pizza_active');
					 $(this).siblings('.favorites_button_add_to_bucket_pizza').addClass('favorites_button_add_to_bucket_pizza_viz');
					 size = $(this).attr('size');
	 				});
				 $('.favorites_button_add_to_bucket_pizza').click(function()
					{
					 var id = $(this).attr("id_product");
					 $.ajax(
			 			{
			 			 type: "POST",
			 			 url: "addtocart.php",
			 			 dataType: "html",
			 			 data: ({id:id, size:size}),
			 			});
	 				});
				 $('.favorites_button_add_to_bucket').click(function()
					{
					 var id = $(this).attr("id_product");
					 $.ajax(
			 			{
			 			 type: "POST",
			 			 url: "addtocart.php",
			 			 dataType: "html",
			 			 data: ({id:id}),
			 			});
	 				});
				});
		</script>
	</body>
</html>