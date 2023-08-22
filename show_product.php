<?php
	session_start();
	$user_login = $_SESSION['user']['login'];
	$category = htmlspecialchars($_GET["category"]);
	$size = htmlspecialchars($_GET["size"]);
	$path = 'img/products/';
	if ($category == 7)
		{
		 $result = mysqli_query ($connect, "SELECT * FROM products WHERE class=7 AND (modify='dual' OR modify='') GROUP BY id_product ORDER BY modify=''");
		 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	 		{
			 $id = $row['id_product'];
			 $name = $row['name'];
			 $ingredients = $row['ingredients'];
			 $modify = $row['modify'];
			 $img_prdct = $row['img_product'];
			 $promo = $row['promo'];
			 $img_product = "<img class='show_product_img' src='$path/$img_prdct'>";
			 if ($promo == 1)
				{
				 $img_promo = "<img class='show_product_img' src='$path/Блюдо недели.jpg'>";
				 if ($modify == 'dual')
			 		{
					 echo "<div class=show_product_block>";
			 	 		if ($user_login)
							{
							 $check_favorites = mysqli_num_rows (mysqli_query ($connect, "SELECT * FROM favorites WHERE id_user='$user_login' AND id_product='$id'"));
							 if ($check_favorites)
					 			{
								 echo "<button class=show_product_in_favorites>В избранном</button>";
					 			}
							 else
					 			{
								 echo "<button class=show_product_add_favorites id_product={$id}>В избранное</button>";
					 			}
							}
			 		 echo
						"<div class=show_product_background_promo>{$img_promo}</div>
						<div class=show_product_background_img>{$img_product}</div>
						<div class=show_product_name>{$name}</div>
						<div class=show_product_ingredients>Ингридиенты: {$ingredients}</div>
						<div class=show_product_weight_price_pizza>";
		 					$result2 = mysqli_query($connect, "SELECT * FROM products WHERE id_product='$id' AND modify='dual'");
		 					while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
		 						{
								 $public = $row2['public'];
								 $weight = $row2['weight'];
								 $size = $row2['size'];
								 $price = $row2['price'];
								 $procent = 80;
								 $price = round($price / 100 * $procent);
								 if ($public == 1)
										{
										 echo "<button class=show_product_size_price_pizza size='{$size}' id_size={$id}>Вес:{$weight} Цена:{$price}р.</button>";
										}
		 						}
		 					echo "<button class=show_product_button_add_to_bucket_pizza type=submit id_product={$id}>Заказать</button>
						</div>
		 	 		 </div>";
			 		}
				 else if ($modify == '')
			 		{
					 $result_burger = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM products WHERE id_product='$id'"));
					 $weight_burger = $result_burger['weight'];
					 $price_burger = $result_burger['price'];
					 echo "<div class=show_product_block>";
			 	 		if ($user_login)
							{
							 $check_favorites = mysqli_num_rows (mysqli_query ($connect, "SELECT * FROM favorites WHERE id_user='$user_login' AND id_product='$id'"));
							 if ($check_favorites)
					 			{
								 echo "<button class=show_product_in_favorites>В избранном</button>";
					 			}
							 else
					 			{
								 echo "<button class=show_product_add_favorites id_product={$id}>В избранное</button>";
					 			}
							}
			 		 echo
						"<div class=show_product_background_img>{$img_product}</div>
							<div class=show_product_name>{$name}</div>
							<div class=show_product_ingredients>Ингридиенты: {$ingredients}</div>
							<div class=show_product_weight_price>
								<div class=show_product_weight>Вес:{$weight_burger}</div>
								<div class=show_product_price>Цена:{$price_burger}</div>
							</div>
							<button class=show_product_button_add_to_bucket type=submit id_product={$id}>Заказать</button>
						</div>";
			 		}
			 	}
			 else
			 	{
				 if ($modify == 'dual')
			 		{
					 echo "<div class=show_product_block>";
			 	 		if ($user_login)
							{
							 $check_favorites = mysqli_num_rows (mysqli_query ($connect, "SELECT * FROM favorites WHERE id_user='$user_login' AND id_product='$id'"));
							 if ($check_favorites)
					 			{
								 echo "<button class=show_product_in_favorites>В избранном</button>";
					 			}
							 else
					 			{
								 echo "<button class=show_product_add_favorites id_product={$id}>В избранное</button>";
					 			}
							}
			 		 echo
						"<div class=show_product_background_img>{$img_product}</div>
						<div class=show_product_name>{$name}</div>
						<div class=show_product_ingredients>Ингридиенты: {$ingredients}</div>
						<div class=show_product_weight_price_pizza>";
		 				$result2 = mysqli_query($connect, "SELECT * FROM products WHERE id_product='$id' AND modify='dual'");
		 				while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
		 					{
							 $public = $row2['public'];
							 $weight = $row2['weight'];
							 $size = $row2['size'];
							 $price = $row2['price'];
							 if ($public == 1)
									{
									 echo "<button class=show_product_size_price_pizza size='{$size}' id_size={$id}>Вес:{$weight} Цена:{$price}</button>";
									}
		 					}
		 				echo "<button class=show_product_button_add_to_bucket_pizza type=submit id_product={$id}>Заказать</button>
						</div>
		 	 		 </div>";
			 		}
				 else if ($modify == '')
			 		{
					 $result_burger = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM products WHERE id_product='$id'"));
					 $weight_burger = $result_burger['weight'];
					 $price_burger = $result_burger['price'];
					 echo "<div class=show_product_block>";
			 	 		if ($user_login)
							{
							 $check_favorites = mysqli_num_rows (mysqli_query ($connect, "SELECT * FROM favorites WHERE id_user='$user_login' AND id_product='$id'"));
							 if ($check_favorites)
					 			{
								 echo "<button class=show_product_in_favorites>В избранном</button>";
					 			}
							 else
					 			{
								 echo "<button class=show_product_add_favorites id_product={$id}>В избранное</button>";
					 			}
							}
			 		 echo
						"<div class=show_product_background_img>{$img_product}</div>
							<div class=show_product_name>{$name}</div>
							<div class=show_product_ingredients>Ингридиенты: {$ingredients}</div>
							<div class=show_product_weight_price>
								<div class=show_product_weight>Вес:{$weight_burger}</div>
								<div class=show_product_price>Цена:{$price_burger}</div>
							</div>
							<button class=show_product_button_add_to_bucket type=submit id_product={$id}>Заказать</button>
						</div>";
			 		}
				}
			}
		}
	else if ($category >= 31 && $category <= 35)
		{
		 $result_class = mysqli_query ($connect, "SELECT class FROM products WHERE modify='biznes' GROUP BY class");
		 while ($row_class = mysqli_fetch_array($result_class))
	 		{
			 $category_namber = $row_class['class'];
			 if ($category == $category_namber)
		 		{
				 echo
				 "<div class=show_product_block_biznes>
	   			 	<div class=show_product_group>Суп на выбор:</div>";
					$result_biznes = mysqli_query ($connect, "SELECT * FROM products WHERE bludo='1' AND class='$category' AND public='1'");
					while($row_biznes = mysqli_fetch_array($result_biznes, MYSQLI_ASSOC))
						{
						 $id = $row_biznes['id_product'];
						 $name = $row_biznes['name'];
						 $price = $row_biznes['price'];
						 $ingredients = $row_biznes['ingredients'];
						 $img_prdct = $row_biznes['img_product'];
						 $img = "<img class='show_product_img' src='$path/$img_prdct'>";
						 echo 
							"<button class='show_product_block_biznes_tovar first' first=first first_id={$id}>
								<div class=show_product_block_biznes_info>
									<div class=show_product_block_biznes_name>{$name}</div>
								</div>
							</button>";
	 					}
				 echo
					 "</div>
					 <div class=show_product_block_biznes>
					 <div class=show_product_group>Горячее на выбор:</div>";
				 $result_biznes = mysqli_query ($connect, "SELECT * FROM products WHERE bludo='2' AND class='$category' AND public='1'");
				 while($row_biznes = mysqli_fetch_array($result_biznes, MYSQLI_ASSOC))
					{
					 $id = $row_biznes['id_product'];
					 $name = $row_biznes['name'];
					 $price = $row_biznes['price'];
					 $ingredients = $row_biznes['ingredients'];
					 $img_prdct = $row_biznes['img_product'];
					 $img = "<img class='show_product_img' src='$path/$img_prdct'>";
					 echo 
						"<button class='show_product_block_biznes_tovar second' second=second second_id={$id}>
							<div class=show_product_block_biznes_info>
								<div class=show_product_block_biznes_name>{$name}</div>
							</div>
						</button>";
	 				}
				 echo "</div>
				 <div class=show_product_block_biznes>
				 <div class=show_product_group>Салат на выбор:</div>";
		 		 $result_biznes = mysqli_query ($connect, "SELECT * FROM products WHERE bludo='3' AND class='$category' AND public='1'");
				 while($row_biznes = mysqli_fetch_array($result_biznes, MYSQLI_ASSOC))
					{
					 $id = $row_biznes['id_product'];
					 $name = $row_biznes['name'];
					 $price = $row_biznes['price'];
					 $ingredients = $row_biznes['ingredients'];
					 $img_prdct = $row_biznes['img_product'];
					 $img = "<img class='show_product_img' src='$path/$img_prdct'>";
					 echo 
						"<button class='show_product_block_biznes_tovar third' third=third third_id={$id}>
							<div class=show_product_block_biznes_info>
								<div class=show_product_block_biznes_name>{$name}</div>
							</div>
						</button>";
						}
				 echo "</div>
				 <div class=show_product_block_biznes>
				 <div class=show_product_group>Гарнир на выбор:</div>"; 
				 $result_biznes = mysqli_query ($connect, "SELECT * FROM products WHERE bludo='4' AND class='$category' AND public='1'");
				 while($row_biznes = mysqli_fetch_array($result_biznes, MYSQLI_ASSOC))
					{
					 $id = $row_biznes['id_product'];
					 $name = $row_biznes['name'];
					 $price = $row_biznes['price'];
					 $ingredients = $row_biznes['ingredients'];
					 $img_prdct = $row_biznes['img_product'];
					 $img = "<img class='show_product_img' src='$path/$img_prdct'>";
					 echo 
						"<button class='show_product_block_biznes_tovar fourth' fourth=fourth fourth_id={$id}>
							<div class=show_product_block_biznes_info>
								<div class=show_product_block_biznes_name>{$name}</div>
							</div>
						</button>";
						}
				 echo "</div>
				 <div class=show_product_block_biznes5>
					<div class=show_product_group>Дополнение:</div>";
					$result_biznes = mysqli_query ($connect, "SELECT * FROM products WHERE bludo='5' AND public='1'");
					while($row_biznes = mysqli_fetch_array($result_biznes, MYSQLI_ASSOC))
						{
						 $id = $row_biznes['id_product'];
						 $name = $row_biznes['name'];
						 $price = $row_biznes['price'];
						 echo "<div class=show_product_block_biznes_name>{$name}</div>";
						}
				 echo "</div>
				 <div class=show_product_block_biznes_price>Цена:{$price}</div>
				 <button class=show_product_button_block_biznes_add_to_bucket type=submit biznes_id={$category_namber}>Заказать</button>";
		 		}
			}
		}
	else
		{
		 $result = mysqli_query ($connect, "SELECT * FROM products WHERE class='$category' AND public='1'");
		 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
			 $id = $row['id_product'];
			 $class = $row['class'];
			 $name = $row['name'];
			 $img_prdct = $row['img_product'];
			 $img_product = "<img class='show_product_img' src='$path/$img_prdct'>";
			 $ingredients = $row['ingredients'];
			 $procent = 80;
			 $price = $row['price'];
			 $weight = $row['weight'];
			 $promo = $row['promo'];
			 if ($promo == 1)
				{
				 $price = round($row['price'] / 100 * $procent);
				 $img_promo = "<img class='show_product_img' src='$path/Блюдо недели.jpg'>";
				 echo "<div class=show_product_block>";
				 if ($user_login)
					{
					 $check_favorites = mysqli_num_rows (mysqli_query ($connect, "SELECT * FROM favorites WHERE id_user='$user_login' AND id_product='$id'"));
					 if ($check_favorites)
					 	{
						 echo "<button class=show_product_in_favorites>В избранном</button>";
					 	}
					 else
					 	{
						 echo "<button class=show_product_add_favorites id_product={$id}>В избранное</button>";
					 	}
					}
				 echo
					"<div class=show_product_background_promo>{$img_promo}</div>
					<div class=show_product_background_img>{$img_product}</div>
					<div class=show_product_name>{$name}</div>
					<div class=show_product_ingredients>Ингридиенты: {$ingredients}</div>
					<div class=show_product_weight_price>
						<div class=show_product_weight>Вес:{$weight}</div>
						<div class=show_product_price>Цена:{$price}р.</div>
					</div>
					<button class=show_product_button_add_to_bucket type=submit id_product={$id}>Заказать</button>
				 </div>";
		 		}
			 else
				{
				 echo "<div class=show_product_block>";
				 if ($user_login)
					{
					 $check_favorites = mysqli_num_rows (mysqli_query ($connect, "SELECT * FROM favorites WHERE id_user='$user_login' AND id_product='$id'"));
					 if ($check_favorites)
					 	{
						 echo "<button class=show_product_in_favorites>В избранном</button>";
					 	}
					 else
					 	{
						 echo "<button class=show_product_add_favorites id_product={$id}>В избранное</button>";
					 	}
					}
				 echo
					"<div class=show_product_background_img>{$img_product}</div>
					<div class=show_product_name>{$name}</div>
					<div class=show_product_ingredients>Ингридиенты: {$ingredients}</div>
					<div class=show_product_weight_price>
						<div class=show_product_weight>Вес:{$weight}</div>
						<div class=show_product_price>Цена:{$price}</div>
					</div>
					<button class=show_product_button_add_to_bucket type=submit id_product={$id}>Заказать</button>
				 </div>";
		 		}
			}
		}
?>
<script src="jQuery.js"></script>
<script>
$(document).ready(function()
	{
	 var first_id, second_id, third_id, fourth_id, fifth_id, size;
	 $('.show_product_size_price_pizza').click(function()
		{
		 var id_pizza = $(this).attr('id_size');
		 var el = $('[id_size = '+id_pizza+']');
		 el.removeClass('show_product_size_price_pizza_active');
		 this.classList.add('show_product_size_price_pizza_active');
		 $(this).siblings('.show_product_button_add_to_bucket_pizza').addClass('show_product_button_add_to_bucket_pizza_viz');
		 size = $(this).attr('size');
	 	});
	 $('.show_product_add_favorites').click(function()
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
	 $('.show_product_button_add_to_bucket_pizza').click(function()
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
	 $('.show_product_button_add_to_bucket_pizza').click(function()
		{
		 $('.qua').html(+$('.qua').html()+1);
		});
	 $('.first').click(function()
		{
		 first_id = $(this).attr('first_id');
		 var el = $('[first = first]');
		 el.removeClass('show_product_block_biznes_tovar_active');
		 this.classList.add('show_product_block_biznes_tovar_active');
	 	});
	 $('.second').click(function()
		{
		 second_id = $(this).attr('second_id');
		 var el = $('[second=second]');
		 el.removeClass('show_product_block_biznes_tovar_active');
		 this.classList.add('show_product_block_biznes_tovar_active');
	 	});
	 $('.third').click(function()
		{
		 third_id = $(this).attr('third_id');
		 var el = $('[third=third]');
		 el.removeClass('show_product_block_biznes_tovar_active');
		 this.classList.add('show_product_block_biznes_tovar_active');
	 	});
	 $('.fourth').click(function()
		{
		 fourth_id = $(this).attr('fourth_id');
		 var el = $('[fourth=fourth]');
		 el.removeClass('show_product_block_biznes_tovar_active');
		 this.classList.add('show_product_block_biznes_tovar_active');
	 	});
	 $('.show_product_add_biznes_favorites').click(function()
		{
		 $.ajax(
			 {
			  type: "POST",
			  url: "add_favorites.php",
			  dataType: "html",
			  data: ({first_id:first_id, second_id:second_id, third_id:third_id, fourth_id:fourth_id}),
			});
	 	});
	 $('.show_product_button_block_biznes_add_to_bucket').click(function()
		{
		 var biznes_id = $(this).attr("biznes_id");
		 $.ajax(
			 {
			  type: "POST",
			  url: "addtocart.php",
			  dataType: "html",
			  data: ({first_id:first_id, second_id:second_id, third_id:third_id, fourth_id:fourth_id, biznes_id:biznes_id}),
			});
		 window.location.reload();
	 	});
	 $('.show_product_button_block_biznes_add_to_bucket').click(function()
		{
		 $('.qua').html(+$('.qua').html()+1);
		});
	 $('.show_product_button_add_to_bucket').click(function()
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
	 $('.show_product_button_add_to_bucket').click(function()
		{
		 $('.qua').html(+$('.qua').html()+1);
		});
	});
</script>