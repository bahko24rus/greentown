<?php
	session_start();
	require_once('connect.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Акции/Скидки</title>
		<link rel="icon" href="img/logo-gt_50.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="Description" content="Информация о доставке">
	</head>
	<body class="promotions_background">
		<?php require_once('header.php'); ?>
		<div class="promotions_block1"><?php require_once("category.php"); ?></div>
		<div class="promotions_block2">
			<div class="promotions_info">
      			<h1>Акции и скидки</h1></br>
      			<h2>
      				<p>Блюдо недели 20%</p>
<!--
						<?php
							$path = 'img/products/';
							$result_promo = mysqli_fetch_array(mysqli_query ($connect, "SELECT * FROM products WHERE promo='1' AND public='1'"));
							$id = $result_promo['id_product'];
							$modify = $result_promo['modify'];
							$name = $result_promo['name'];
							$ingredients = $result_promo['ingredients'];
							$img_prdct = $result_promo['img_product'];
							$img_product = "<img class='show_product_img' src='$path/$img_prdct'>";
							$img_promo = "<img class='show_product_img' src='$path/Блюдо недели.jpg'>";
							if ($modify == 'dual')
			 					{
								 $size = $result_promo['size'];
								 echo "<div class=promotions_product_block>";
			 	 					if ($user_login)
										{
										 $check_favorites = mysqli_num_rows (mysqli_query ($connect, "SELECT * FROM favorites WHERE id_user='$user_login' AND id_product='$id'"));
										 if ($check_favorites)
					 						{
											 echo "<button class=promotions_in_favorites>В избранном</button>";
					 						}
										 else
					 						{
											 echo "<button class=promotions_add_favorites id_product={$id}>В избранное</button>";
					 						}
										}
			 					 echo
									"<div class=promotions_background_promo>{$img_promo}</div>
									<div class=promotions_background_img>{$img_product}</div>
									<div class=promotions_name>{$name}</div>
									<div class=promotions_ingredients>Ингридиенты: {$ingredients}</div>
									<div class=promotions_weight_price_pizza>";
		 								$result2 = mysqli_query($connect, "SELECT * FROM products WHERE id_product='$id' AND modify='dual'");
		 								while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
		 									{
											 $public = $row2['public'];
											 $weight = $row2['weight'];
											 $size = $row2['size'];
											 $price = $row2['price'];
											 $procent = 80;
											 $price = round($price / 100 * $procent);
											 echo "<button class=promotions_size_price_pizza size='{$size}' id_size={$id}>Вес:{$weight} Цена:{$price}р.</button>";
		 									}
		 								echo "<button class=promotions_button_add_to_bucket_pizza type=submit id_product={$id}>Заказать</button>
									</div>
		 	 					 </div>";
			 					}
							 else if ($modify != 'dual' && $modify != 'biznes')
			 					{
								 $price = $result_promo['price'];
								 $procent = 80;
								 $price = round($price / 100 * $procent);
								 $weight = $result_promo['weight'];
								 echo "<div class=promotions_product_block>";
			 	 					if ($user_login)
										{
										 $check_favorites = mysqli_num_rows (mysqli_query ($connect, "SELECT * FROM favorites WHERE id_user='$user_login' AND id_product='$id'"));
										 if ($check_favorites)
												{
												 echo "<button class=promotions_in_favorites>В избранном</button>";
												}
										 else
												{
												 echo "<button class=promotions_add_favorites id_product={$id}>В избранное</button>";
												}
										}
			 					 echo
									"<div class=promotions_background_promo>{$img_promo}</div>
									<div class=promotions_background_img>{$img_product}</div>
										<div class=promotions_name>{$name}</div>
										<div class=promotions_ingredients>Ингридиенты: {$ingredients}</div>
										<div class=promotions_weight_price>
											<div class=promotions_weight>Вес:{$weight}</div>
											<div class=promotions_price>Цена:{$price}</div>
										</div>
										<button class=promotions_button_add_to_bucket type=submit id_product={$id}>Заказать</button>
									</div>";
			 					}
						?>
-->
					<p>Самовывоз 5%</p>
      				<p>День рождения 10%</p>
				</h2>
			</div>
		</div>
		<div>
			<?php
				require_once('footer.php');
			?>
		</div>
		<script src="jQuery.js"></script>
		<script>
			$(document).ready(function()
				{
				 var size;
				 $('.promotions_size_price_pizza').click(function()
					{
					 var id_pizza = $(this).attr('id_size');
					 var el = $('[id_size = '+id_pizza+']');
					 el.removeClass('promotions_size_price_pizza_active');
					 this.classList.add('promotions_size_price_pizza_active');
					 $(this).siblings('.promotions_button_add_to_bucket_pizza').addClass('promotions_button_add_to_bucket_pizza_viz');
					 size = $(this).attr('size');
	 				});
				 $('.promotions_add_favorites').click(function()
					{
					 var id = $(this).attr('id_product');
					 $.ajax(
			 			{
			 			 type: "POST",
			 			 url: "add_favorites.php",
			 			 dataType: "html",
			 			 data: ({id:id}),
						});
	 				});
				 $('.promotions_button_add_to_bucket_pizza').click(function()
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
				 $('.promotions_button_add_to_bucket_pizza').click(function()
					{
					 $('.qua').html(+$('.qua').html()+1);
					});
				 $('.promotions_button_add_to_bucket').click(function()
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
				 $('.promotions_button_add_to_bucket').click(function()
					{
					 $('.qua').html(+$('.qua').html()+1);
					});
				});
		</script>
	</body>
</html>
