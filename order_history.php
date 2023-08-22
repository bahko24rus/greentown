<?php
	session_start();
	require_once('connect.php');
	if(!$_SESSION['user'])
		{
		 header('Location: index.php');
		}
	$login = $_SESSION['user']['login'];
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>История заказов</title>
		<link rel="icon" href="img/logo-gt_50.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="Description" content="Краткое описание содержания страницы">
	</head>
	<body class="order_history_background">
		<div class="order_history_block1"><?php require_once('header_personal_area.php'); ?></div>
		<div class="order_history_block2"><?php require_once('menu_personal_area.php'); ?></div>
		<div class="order_history_block3">
			<?php
				$path = 'img/products/';
				$result = mysqli_query($connect, "SELECT number_order FROM order_history WHERE id_user='$login' GROUP BY -number_order");
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
					{
					 $totatsumm = 0;
					 $number_order = $row['number_order'];
					 echo "<div class=order_history_number_order><div>Номер заказа: {$number_order}</div>";
					 $result2 = mysqli_query($connect, "SELECT number_tovara, modify, qua FROM order_history WHERE number_order='$number_order' GROUP BY number_tovara");
					 while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
					 	{
						 $number_tovara = $row2['number_tovara'];
						 $qua = $row2['qua'];
						 $modify = $row2['modify'];
						 echo "<div class=order_history_block_order_active>";
						 if ($modify == 'biznes')
						 	{
							 $result3 = mysqli_fetch_array(mysqli_query($connect, "SELECT price FROM products WHERE modify='biznes'"));
							 $price = $result3['price'];
							 $summ = $price*$qua;
							 $totatsumm += $summ;
							 echo
								"<div class=order_history_biznes_img>
							 		<img width=100% src='$path/biznes.jpg'>
									<div class=order_history_total_info>
										<div class=order_history_price>Цена: {$price}</div>
										<div class=order_history_qua>Кол-во: {$qua}</div>
										<div class=order_history_summ>Сумма: {$summ}</div>
									</div>
								</div>
								<div class=order_history_biznes>";
							 		$result4 = mysqli_query($connect, "SELECT id_product FROM order_history WHERE number_tovara='$number_tovara'");
							 		while($row4 = mysqli_fetch_array($result4, MYSQLI_ASSOC))
							 			{
										 $id_product = $row4['id_product'];
										 $result5 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM products WHERE id_product='$id_product'"));
										 $bludo = $result5['bludo'];
										 $name = $result5['name'];
										 $ingredients = $result5['ingredients'];
										 $img_product = $result5['img_product'];
										 $img = "<img width=80% src='$path/$img_product'>";
										 if ($bludo < 5)
							 				{
											 echo
												"<div class=order_history_img_biznes>{$img}</div>
												<div class=order_history_info>
													<div class=order_history_name>{$name}</div>
													<div class=order_history_ingredients_biznes>Ингридиенты: {$ingredients}</div>
												</div>";
							 				}
										 else
							 				{
											 echo
												"<div class=order_history_info>
													<div class=order_history_name>{$name}</div>
												</div>";
							 				}
							 			}
							 echo "</div>";
						 	}
						 if ($modify == 'dual')
						 	{
							 $result6 = mysqli_query($connect, "SELECT id_product, size FROM order_history WHERE number_tovara='$number_tovara'");
							 while($row6 = mysqli_fetch_array($result6, MYSQLI_ASSOC))
						 		{
								 $id_product = $row6['id_product'];
								 $size = $row6['size'];
								 $result7 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM products WHERE id_product='$id_product'"));
								 $img_product = $result7['img_product'];
								 $name = $result7['name'];
								 $price = $result7['price'];
								 $weight = $result7['weight'];
								 $ingredients = $result7['ingredients'];
								 $img = "<img width=100% src='$path/$img_product'>";
								 if ($size == 'small')
							 		{
									 $size = 'Маленькая';
							 		}
								 else
							 		{
									 $size = 'Большая';
							 		}
								 $summ = $price*$qua;
								 $totatsumm += $summ;
								 echo
									"<div class=order_history_img>{$img}</div>
									<div class=order_history_info>
										<div class=order_history_name>{$name}</div>
										<div class=order_history_ingredients>Ингридиенты: {$ingredients}</div>
										<div class=order_history_price>Цена: {$price}</div>
										<div class=order_history_weight>Вес: {$weight}</div>
										<div class=order_history_size>Размер:{$size}</div>
										<div class=order_history_qua>Кол-во: {$qua}</div>
										<div class=order_history_summ>Сумма: {$summ}</div>
									</div>";
						 		}
					 		}
						 if ($modify == '')
						 	{
							 $result8 = mysqli_query($connect, "SELECT id_product FROM order_history WHERE number_tovara='$number_tovara'");
							 while($row8 = mysqli_fetch_array($result8, MYSQLI_ASSOC))
						 		{
								 $id_product = $row8['id_product'];
								 $result9 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM products WHERE id_product='$id_product'"));
								 $img_product = $result9['img_product'];
								 $name = $result9['name'];
								 $price = $result9['price'];
								 $weight = $result9['weight'];
								 $ingredients = $result9['ingredients'];
								 $img = "<img width=100% src='$path/$img_product'>";
								 $summ = $price*$qua;
								 $totatsumm += $summ;
								 echo
									"<div class=order_history_block_order_active>
										<div class=order_history_img>{$img}</div>
										<div class=order_history_info>
											<div class=order_history_name>{$name}</div>
											<div class=order_history_ingredients>Ингридиенты: {$ingredients}</div>
											<div class=order_history_price>Цена: {$price}</div>
											<div class=order_history_weight>Вес: {$weight}</div>
											<div class=order_history_qua>Кол-во: {$qua}</div>
											<div class=order_history_summ>Сумма: {$summ}</div>
										</div>
									</div>";
						 		}
						 	}
						 echo "</div>";
					 	}
					 echo
						 "<div class=order_history_totalsumm>Общая сумма заказа: {$totatsumm}</div>
					 	  <button class=order_history_repeat_order number_order='$number_order'>Повторить заказ</button>
						</div>";
					}
			?>
		</div>
		<div class="order_history_block6">
			<?php require_once('footer.php'); ?>
		</div>
		<script src="jQuery.js"></script>
		<script>
			$(document).ready(function()
				{
				 $('.order_history_repeat_order').click(function()
					{
					 var number_order = $(this).attr("number_order");
					 $.ajax(
			 			{
						 type: "POST",
						 url: "addtocart.php",
						 dataType: "html",
						 data: ({number_order:number_order}),
			 			});
	 				});
				});
		</script>
	</body>
</html>