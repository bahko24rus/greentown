<?php
	session_start();
	require_once("connect.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Корзина</title>
		<link rel="icon" href="img/logo-gt_50.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="Description" content="Краткое описание содержания страницы">
	</head>
	<body class="bucket_background">
		<div><?php require_once('header.php'); ?></div>
		<div class="bucket_block_menu"><?php require_once("category.php"); ?></div>
		<form class="bucket_gorizontal" action="comp_order.php" method="post">
			<div class="bucket_products_panel">
				<?php
					$totalsumm = 0;
					$user_login = $_SESSION['user']['login'];
					$user_coocke = $_COOKIE['user'];
					$path = 'img/products/';
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
					echo
						"<div class=bucket_header_table>
							<div class=bucket_header_name_ingredients>Название/Ингридиенты</div>
							<div class=bucket_header_product_weight>Вес</div>
							<div class=bucket_header_product_price>Цена</div>
							<div class=bucket_header_size>Размер</div>
							<div class=bucket_header_qua>Кол-во</div>
							<div class=bucket_header_summ>Сумма</div>
						</div>";
					$result = mysqli_query ($connect, "SELECT * FROM bucket WHERE id_user='$user' GROUP BY number_tovara");
					while($row = mysqli_fetch_array($result))
						{
						 $id = $row['number_tovara'];
						 $id_product = $row['id_product'];
						 $id_order = $row['id'];
						 $qua = $row['qua'];
						 $size = $row['size'];
						 $modify = $row['modify'];
						 $result2 = mysqli_query ($connect, "SELECT * FROM products WHERE id_product='$id_product' AND size='$size'");
						 while($row2 = mysqli_fetch_array($result2))
						 	{
							 $name = $row2['name'];
							 $img_prdct = $row2['img_product'];
							 $img_product = "<img width=100% src='$path/$img_prdct'>";
							 $modify = $row2['modify'];
							 $ingredients = $row2['ingredients'];
							 $compliment = $row2['compliment'];
							 $price = $row2['price'];
							 $weight = $row2['weight'];
						 	}
						 if ($modify == 'dual')
						 	{
							 if ($size == 'big')
						 		{
								 $summ = $price * $qua;
								 $size = 'Большая';
								 echo
							 		"<div class=bucket_table_product>
							 			<div class=bucket_table_img>{$img_product}</div>
										<div class=bucket_table_name_ingredients>{$name}</br></br>{$ingredients}</br></br>{$compliment}</div>
							 			<div class=bucket_table_weight>{$weight}</div>
										<div class=bucket_table_price>{$price}</div>
										<div class=bucket_table_size>{$size}</div>
										<div class=bucket_table_qua><a class='bucket_table_minus bucket_table_operation' href=javascript:void(0) operation=minus id_product={$id}>-</a><span class=bucket_table_quantity>{$qua}</span><a class='bucket_table_plus bucket_table_operation' href=javascript:void(0) operation=plus id_product={$id}>+</a></div>
										<div class=bucket_table_summ id={$id_order}>{$summ} р.</div>
										<a class='bucket_table_delete bucket_table_operation' href=javascript:void(0) operation=delete id_product={$id}>Удалить</a>
									</div>";
						 		}
							 else if ($size == 'small')
								{
								 $summ = $price * $qua;
								 $size = 'Маленькая';
								 echo
							 		"<div class=bucket_table_product>
							 			<div class=bucket_table_img>{$img_product}</div>
										<div class=bucket_table_name_ingredients>{$name}</br></br>{$ingredients}</br></br>{$compliment}</div>
							 			<div class=bucket_table_weight>{$weight}</div>
										<div class=bucket_table_price>{$price}</div>
										<div class=bucket_table_size>{$size}</div>
										<div class=bucket_table_qua><a class='bucket_table_minus bucket_table_operation' href=javascript:void(0) operation=minus id_product={$id}>-</a><span class=bucket_table_quantity>{$qua}</span><a class='bucket_table_plus bucket_table_operation' href=javascript:void(0) operation=plus id_product={$id}>+</a></div>
										<div class=bucket_table_summ id={$id_order}>{$summ} р.</div>
										<a class='bucket_table_delete bucket_table_operation' href=javascript:void(0) operation=delete id_product={$id}>Удалить</a>
									</div>";
						 		}
						 	}
						 else if ($modify == 'biznes')
							{
							 $img_product = "<img width=100% src='$path/biznes.jpg'>";
							 echo "<div class=bucket_table_product>
							 	<div class=bucket_table_img>{$img_product}</div>
							 	<div class=bucket_table_biznes_group>$number_tovara";
									$result_biznes = mysqli_query ($connect, "SELECT id_product FROM bucket WHERE number_tovara='$id' AND id_user='$user'");
									while($row_biznes = mysqli_fetch_array($result_biznes))
										{
										 $id_product = $row_biznes['id_product'];
										 $result_product = mysqli_query ($connect, "SELECT * FROM products WHERE id_product='$id_product'");
										 while($row_product = mysqli_fetch_array($result_product))
								 			{
											 $bludo = $row_product['bludo'];
											 $name = $row_product['name'];
											 $price = $row_product['price'];
											 $ingredients = $row_product['ingredients'];
											 $img_prdct = $row_product['img_product'];
											 $img = "<img class='show_product_img' src='$path/$img_prdct'>";
											 if ($bludo < 5)
									 			{
												 echo
												 "<div class=bucket_table_biznes_name>{$name}</div>";
									 			}
											 else
									 			{
												 echo
												 "<div class=bucket_table_biznes_name>{$name}</div>";
									 			}
								 			}
										}
							 		$summ = $price * $qua;
							 		echo "</div>
							 	<div class=bucket_table_weight></div>
								<div class=bucket_table_price>{$price}</div>
								<div class=bucket_table_size></div>
								<div class=bucket_table_qua><a class='bucket_table_minus bucket_table_operation' href=javascript:void(0) operation=minus id_product={$id}>-</a><span class=bucket_table_quantity>{$qua}</span><a class='bucket_table_plus bucket_table_operation' href=javascript:void(0) operation=plus id_product={$id}>+</a></div>
								<div class=bucket_table_summ>{$summ} р.</div>
								<a class='bucket_table_delete bucket_table_operation' href=javascript:void(0) operation=delete id_product={$id}>Удалить</a>";
							 echo "</div>";
						 	}
						 else if ($size == '' && $modify == '')
							{
							 $summ = $price * $qua;
							 echo
							 	"<div class=bucket_table_product>
							 		<div class=bucket_table_img>{$img_product}</div>
									<div class=bucket_table_name_ingredients>{$name}</br></br>{$ingredients}</br></br>{$compliment}</div>
							 		<div class=bucket_table_weight>{$weight}</div>
									<div class=bucket_table_price>{$price}</div>
									<div class=bucket_table_size></div>
									<div class=bucket_table_qua><a class='bucket_table_minus bucket_table_operation' href=javascript:void(0) operation=minus id_product={$id}>-</a><span class=bucket_table_quantity>{$qua}</span><a class='bucket_table_plus bucket_table_operation' href=javascript:void(0) operation=plus id_product={$id}>+</a></div>
									<div class=bucket_table_summ>{$summ} р.</div>
									<a class='bucket_table_delete bucket_table_operation' href=javascript:void(0) operation=delete id_product={$id}>Удалить</a>
								</div>";
						 	}
						 $totalsumm += $summ;
						 $totalqua += $qua;
						}
					echo "<a class='bucket_table_delete_all bucket_table_operation' href=javascript:void(0) operation=delete_all id_product={$user}>Очистить корзину</a>";
				?>
			</div>
			<div class="bucket_total_info_panel">
				<?php
					if ($user_login && $user_telephone)
						{
						 echo
							"<label class=bucket_text>Номер телефона</label></br>
							<div class=bucket_telephone>{$user_telephone}</div>
							<div class=bucket_totalsumm>Общая сумма: <span id=totalsumm>{$totalsumm} р.</span></div>
							<button class=bucket_button_order type=submit>Оформить заказ</button>";
						}
					else
						{
						 echo
							"<label class=bucket_text>Номер телефона</label></br>
							<input class=bucket_input type=text name=telephone placeholder='Введите телефон'></br>
							<div class=bucket_totalsumm>Общая сумма: <span id=totalsumm>{$totalsumm} р.</span></div>
							<button class=bucket_button_order type=submit>Оформить заказ</button>";
						}
					
				?>
			</div>
		</form>
		<div class="bucket_gorizontal">
			<?php
				$totalsumm = 0;
				$check_user = mysqli_num_rows (mysqli_query ($connect, "SELECT id_user FROM orders WHERE id_user='$user' AND status='Ожидание...'"));
				if ($check_user)
					{
					 $result = mysqli_query ($connect, "SELECT *, count(telephone) as cnt FROM orders WHERE id_user='$user' AND status='Ожидание...' GROUP BY 'telephone', 'number_order'");
					 while ($row = mysqli_fetch_array($result))
				 		{
						 $status = $row['status'];
						 $number_order = $row['number_order'];
				 		}
					 echo "<div class=bucket_products_panel>
					 <div class=bucket_products_weit><div class=bucket_status id={$number_order}>Заказ: {$number_order} {$status}</div></div>";
					 $user_login = $_SESSION['user']['login'];
					 $user_coocke = $_COOKIE['user'];
					 $path = 'img/products/';
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
					 $result = mysqli_query ($connect, "SELECT * FROM orders WHERE id_user='$user' AND status='Ожидание...' GROUP BY number_tovara");
					 while($row = mysqli_fetch_array($result))
						{
						 $id = $row['number_tovara'];
						 $id_product = $row['id_product'];
						 $id_order = $row['id'];
						 $qua = $row['qua'];
						 $size = $row['size'];
						 $modify = $row['modify'];
						 $result2 = mysqli_query ($connect, "SELECT * FROM products WHERE id_product='$id_product' AND size='$size'");
						 while($row2 = mysqli_fetch_array($result2))
					 		{
							 $name = $row2['name'];
							 $img_prdct = $row2['img_product'];
							 $img_product = "<img width=100% src='$path/$img_prdct'>";
							 $modify = $row2['modify'];
							 $ingredients = $row2['ingredients'];
							 $compliment = $row2['compliment'];
							 $price = $row2['price'];
							 $weight = $row2['weight'];
					 		}
						 if ($size == 'big')
					 		{
							 $summ = $price * $qua;
							 $size = 'Большая';
							 echo
						 		"<div class=bucket_table_product_weit>
						 			<div class=bucket_table_img>{$img_product}</div>
									<div class=bucket_table_name_ingredients>{$name}</div>
						 			<div class=bucket_table_weight>{$weight}</div>
									<div class=bucket_table_price>{$price}</div>
									<div class=bucket_table_size>{$size}</div>
									<div class=bucket_table_qua>{$qua}</div>
									<div class=bucket_table_summ>{$summ} р.</div>
									<a class=bucket_table_delete></a>
								</div>";
					 		}
						 else if ($size == 'small')
							{
							 $summ = $price * $qua;
							 $size = 'Маленькая';
							 echo
						 		"<div class=bucket_table_product_weit>
						 			<div class=bucket_table_img>{$img_product}</div>
									<div class=bucket_table_name_ingredients>{$name}</div>
						 			<div class=bucket_table_weight>{$weight}</div>
									<div class=bucket_table_price>{$price}</div>
									<div class=bucket_table_size>{$size}</div>
									<div class=bucket_table_qua>{$qua}</div>
									<div class=bucket_table_summ>{$summ} р.</div>
									<a class=bucket_table_delete></a>
								</div>";
					 		}
						 else if ($size == '' && $modify == '')
							{
							 $summ = $price * $qua;
							 echo
						 		"<div class=bucket_table_product_weit>
						 			<div class=bucket_table_img>{$img_product}</div>
									<div class=bucket_table_name_ingredients>{$name}</div>
						 			<div class=bucket_table_weight>{$weight}</div>
									<div class=bucket_table_price>{$price}</div>
									<div class=bucket_table_size></div>
									<div class=bucket_table_qua>{$qua}</div>
									<div class=bucket_table_summ>{$summ} р.</div>
									<a class=bucket_table_delete></a>
								</div>";
					 		}
						 else if ($modify != '')
							{
							 $img_product = "<img width=100% src='$path/biznes.jpg'>";
							 echo "<div class=bucket_table_product_weit>
							 <div class=bucket_table_img>{$img_product}</div>
							 <div class=bucket_table_biznes_group>$number_tovara";
							 $result_biznes = mysqli_query ($connect, "SELECT id_product FROM orders WHERE number_tovara='$id' AND id_user='$user'");
							 while($row_biznes = mysqli_fetch_array($result_biznes))
								{
								 $id_product = $row_biznes['id_product'];
								 $result_product = mysqli_query ($connect, "SELECT * FROM products WHERE id_product='$id_product'");
								 while($row_product = mysqli_fetch_array($result_product))
							 		{
									 $name = $row_product['name'];
									 $price = $row_product['price'];
									 echo
										 "<div class=bucket_table_biznes_name>{$name}</div>";
							 		}
								}
							 $summ = $price * $qua;
							 echo "</div>
							 <div class=bucket_table_weight></div>
							 <div class=bucket_table_price>{$price}</div>
							 <div class=bucket_table_size></div>
							 <div class=bucket_table_qua>{$qua}</div>
							 <div class=bucket_table_summ>{$summ} р.</div>
							 <a class=bucket_table_delete></a>
							 </div>";
							}
						 $totalsumm += $summ;
						 $totalqua += $qua;
						}
					 echo "<div class=bucket_totalsumm>Общая сумма: <span>{$totalsumm} р.</span></div>
					 </div>";
					}
			?>
		</div>
		<form class="bucket_vertical" action="comp_order.php" method="post">
			<div class="bucket_products_panel">
				<?php
					$totalsumm = 0;
					$user_login = $_SESSION['user']['login'];
					$user_coocke = $_COOKIE['user'];
					$path = 'img/products/';
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
					$result = mysqli_query ($connect, "SELECT * FROM bucket WHERE id_user='$user' GROUP BY number_tovara");
					while($row = mysqli_fetch_array($result))
						{
						 $id = $row['number_tovara'];
						 $id_product = $row['id_product'];
						 $id_order = $row['id'];
						 $qua = $row['qua'];
						 $size = $row['size'];
						 $modify = $row['modify'];
						 $result2 = mysqli_query ($connect, "SELECT * FROM products WHERE id_product='$id_product' AND size='$size'");
						 while($row2 = mysqli_fetch_array($result2))
						 	{
							 $name = $row2['name'];
							 $img_prdct = $row2['img_product'];
							 $img_product = "<img width=100% src='$path/$img_prdct'>";
							 $modify = $row2['modify'];
							 $price = $row2['price'];
							 $weight = $row2['weight'];
						 	}
						 if ($size == 'big')
						 	{
							 $summ = $price * $qua;
							 $size = 'Большая';
							 echo
							 	"<div class=bucket_table_vertikal>
									<div class=bucket_table_img>{$img_product}</div>
									<div class=bucket_table_product>
										<div class=bucket_table_name>{$name}</div>
										<div class=bucket_table_weight_price>
							 				<div class=bucket_table_weight>Вес: {$weight}</div>
											<div class=bucket_table_price>Цена: {$price}</div>
										</div>
										<div class=bucket_table_size>Размер: {$size}</div>
										<div class=bucket_table_qua>Кол-во: <a class='bucket_table_minus bucket_table_operation' href=javascript:void(0) operation=minus id_product={$id}>-</a><span class=bucket_table_quantity>{$qua}</span><a class='bucket_table_plus bucket_table_operation' href=javascript:void(0) operation=plus id_product={$id}>+</a></div>
										<div class=bucket_table_summ id={$id_order}>Сумма: {$summ} р.</div>
										<a class='bucket_table_delete bucket_table_operation' href=javascript:void(0) operation=delete id_product={$id}>Удалить</a>
									</div>
								</div>";
						 	}
						 else if ($size == 'small')
							{
							 $summ = $price * $qua;
							 $size = 'Маленькая';
							 echo
							 	"<div class=bucket_table_vertikal>
									<div class=bucket_table_img>{$img_product}</div>
									<div class=bucket_table_product>
										<div class=bucket_table_name>{$name}</div>
										<div class=bucket_table_weight_price>
							 				<div class=bucket_table_weight>Вес: {$weight}</div>
											<div class=bucket_table_price>Цена: {$price}</div>
										</div>
										<div class=bucket_table_size>Размер: {$size}</div>
										<div class=bucket_table_qua>Кол-во: <a class='bucket_table_minus bucket_table_operation' href=javascript:void(0) operation=minus id_product={$id}>-</a><span class=bucket_table_quantity>{$qua}</span><a class='bucket_table_plus bucket_table_operation' href=javascript:void(0) operation=plus id_product={$id}>+</a></div>
										<div class=bucket_table_summ id={$id_order}>Сумма: {$summ} р.</div>
										<a class='bucket_table_delete bucket_table_operation' href=javascript:void(0) operation=delete id_product={$id}>Удалить</a>
									</div>
								</div>";
						 	}
						 else if ($size == '' && $modify == '')
							{
							 $summ = $price * $qua;
							 echo
							 	"<div class=bucket_table_vertikal>
									<div class=bucket_table_img>{$img_product}</div>
									<div class=bucket_table_product>
										<div class=bucket_table_name>{$name}</div>
										<div class=bucket_table_weight_price>
							 				<div class=bucket_table_weight>Вес: {$weight}</div>
											<div class=bucket_table_price>Цена: {$price}</div>
										</div>
										<div class=bucket_table_size></div>
										<div class=bucket_table_qua>Кол-во: <a class='bucket_table_minus bucket_table_operation' href=javascript:void(0) operation=minus id_product={$id}>-</a><span class=bucket_table_quantity>{$qua}</span><a class='bucket_table_plus bucket_table_operation' href=javascript:void(0) operation=plus id_product={$id}>+</a></div>
										<div class=bucket_table_summ id={$id_order}>Сумма: {$summ} р.</div>
										<a class='bucket_table_delete bucket_table_operation' href=javascript:void(0) operation=delete id_product={$id}>Удалить</a>
									</div>
								</div>";
						 	}
						 else if ($modify != '')
							{
							 $img_product = "<img width=100% src='$path/biznes.jpg'>";
							 echo "<div class=bucket_table_vertikal>
							 <div class=bucket_table_img>{$img_product}</div>
							 <div class=bucket_table_biznes_group>";
							 $result_biznes = mysqli_query ($connect, "SELECT id_product FROM bucket WHERE number_tovara='$id' AND id_user='$user'");
							 while($row_biznes = mysqli_fetch_array($result_biznes))
								{
								 $id_product = $row_biznes['id_product'];
								 $result_product = mysqli_query ($connect, "SELECT * FROM products WHERE id_product='$id_product'");
								 while($row_product = mysqli_fetch_array($result_product))
								 	{
									 $name = $row_product['name'];
									 $price = $row_product['price'];
									 echo
										 "<div class=bucket_table_biznes>
										 	<div class=bucket_table_name_biznes>{$name}</div>
										 </div>";
								 	}
								}
							 $summ = $price * $qua;
							 echo "</div>
							 	<div class=bucket_table_info_biznes>
							 		<div class=bucket_table_price_biznes>Цена: {$price}</div>
							 		<div class=bucket_table_qua_biznes>Кол-во: <a class='bucket_table_minus bucket_table_operation' href=javascript:void(0) operation=minus id_product={$id}>-</a><span class=bucket_table_quantity>{$qua}</span><a class='bucket_table_plus bucket_table_operation' href=javascript:void(0) operation=plus id_product={$id}>+</a></div>
							 		<div class=bucket_table_summ_biznes>Сумма: {$summ} р.</div>
							 		<a class='bucket_table_delete_biznes bucket_table_operation' href=javascript:void(0) operation=delete id_product={$id}>Удалить</a>
							 	</div>
							 </div>";
							}
						 $totalsumm += $summ;
						 $totalqua += $qua;
						}
					echo "<a class='bucket_table_delete_all bucket_table_operation' href=javascript:void(0) operation=delete_all id_product={$user}>Очистить корзину</a>";
				?>
			</div>
			<div class="bucket_total_info_panel_biznes">
				<?php
					if ($user_login && $user_telephone)
						{
						 echo
							"<label class=bucket_text>Номер телефона</label></br>
							<div class=bucket_telephone>{$user_telephone}</div>
							<div class=bucket_totalsumm>Общая сумма: <span id=totalsumm>{$totalsumm} р.</span></div>
							<button class=bucket_button_order_biznes type=submit>Оформить заказ</button>";
						}
					else
						{
						 echo
							"<label class=bucket_text>Номер телефона</label></br>
							<input class=bucket_input type=text name=telephone placeholder='Введите телефон'></br>
							<div class=bucket_totalsumm>Общая сумма: <span id=totalsumm>{$totalsumm} р.</span></div>
							<button class=bucket_button_order_biznes type=submit>Оформить заказ</button>";
						}
					
				?>
			</div>
		</form>
		<div class="bucket_vertical">
			<?php
				$totalsumm = 0;
				$check_user = mysqli_num_rows (mysqli_query ($connect, "SELECT id_user FROM orders WHERE id_user='$user' AND status='Ожидание...'"));
				if ($check_user)
					{
					 $result = mysqli_query ($connect, "SELECT *, count(telephone) as cnt FROM orders WHERE id_user='$user' AND status='Ожидание...' GROUP BY 'telephone', 'number_order'");
					 while ($row = mysqli_fetch_array($result))
				 		{
						 $status = $row['status'];
						 $number_order = $row['number_order'];
				 		}
					 echo "<div class=bucket_products_panel>
						<div class=bucket_products_weit><div class=bucket_status id={$number_order}>Заказ: {$number_order} {$status}</div></div>";
							$user_login = $_SESSION['user']['login'];
							$user_coocke = $_COOKIE['user'];
							$path = 'img/products/';
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
							$result = mysqli_query ($connect, "SELECT * FROM orders WHERE id_user='$user' AND status='Ожидание...' GROUP BY number_tovara");
							while($row = mysqli_fetch_array($result))
								{
								 $id = $row['number_tovara'];
								 $id_product = $row['id_product'];
								 $id_order = $row['id'];
								 $qua = $row['qua'];
								 $size = $row['size'];
								 $modify = $row['modify'];
								 $result2 = mysqli_query ($connect, "SELECT * FROM products WHERE id_product='$id_product' AND size='$size'");
								 while($row2 = mysqli_fetch_array($result2))
						 			{
									 $name = $row2['name'];
									 $img_prdct = $row2['img_product'];
									 $img_product = "<img width=100% src='$path/$img_prdct'>";
									 $modify = $row2['modify'];
									 $ingredients = $row2['ingredients'];
									 $compliment = $row2['compliment'];
									 $price = $row2['price'];
									 $weight = $row2['weight'];
						 			}
								 if ($size == 'big')
						 			{
									 $summ = $price * $qua;
									 $size = 'Большая';
									 echo
							 			"<div class=bucket_table_product_weit>
											<div class=bucket_table_img>{$img_product}</div>
											<div class=bucket_table_product>
												<div class=bucket_table_name>{$name}</div>
												<div class=bucket_table_weight_price>
							 						<div class=bucket_table_weight>Вес: {$weight}</div>
													<div class=bucket_table_price>Цена: {$price}</div>
												</div>
												<div class=bucket_table_size>Размер: {$size}</div>
												<div class=bucket_table_qua>Кол-во: {$qua}</div>
												<div class=bucket_table_summ>Сумма: {$summ} р.</div>
											</div>
										</div>";
						 			}
								 else if ($size == 'small')
									{
									 $summ = $price * $qua;
									 $size = 'Маленькая';
									 echo
							 			"<div class=bucket_table_product_weit>
											<div class=bucket_table_img>{$img_product}</div>
											<div class=bucket_table_product>
												<div class=bucket_table_name>{$name}</div>
												<div class=bucket_table_weight_price>
							 						<div class=bucket_table_weight>Вес: {$weight}</div>
													<div class=bucket_table_price>Цена: {$price}</div>
												</div>
												<div class=bucket_table_size>Размер: {$size}</div>
												<div class=bucket_table_qua>Кол-во: {$qua}</div>
												<div class=bucket_table_summ>Сумма: {$summ} р.</div>
											</div>
										</div>";
						 			}
								 else if ($size == '' && $modify == '')
									{
									 $summ = $price * $qua;
									 echo
							 			"<div class=bucket_table_product_weit>
											<div class=bucket_table_img>{$img_product}</div>
											<div class=bucket_table_product>
												<div class=bucket_table_name>{$name}</div>
												<div class=bucket_table_weight_price>
							 						<div class=bucket_table_weight>Вес: {$weight}</div>
													<div class=bucket_table_price>Цена: {$price}</div>
												</div>
												<div class=bucket_table_size>Размер: {$size}</div>
												<div class=bucket_table_qua>Кол-во: {$qua}</div>
												<div class=bucket_table_summ>Сумма: {$summ} р.</div>
											</div>
										</div>";
						 			}
								 else if ($modify != '')
									{
									 $img_product = "<img width=100% src='$path/biznes.jpg'>";
									 echo "<div class=bucket_table_product_weit>
									 <div class=bucket_table_img>{$img_product}</div>
									 <div class=bucket_table_biznes_group>$number_tovara";
									 $result_biznes = mysqli_query ($connect, "SELECT id_product FROM orders WHERE number_tovara='$id' AND id_user='$user'");
									 while($row_biznes = mysqli_fetch_array($result_biznes))
										{
										 $id_product = $row_biznes['id_product'];
										 $result_product = mysqli_query ($connect, "SELECT * FROM products WHERE id_product='$id_product'");
										 while($row_product = mysqli_fetch_array($result_product))
								 			{
											 $name = $row_product['name'];
											 $price = $row_product['price'];
											 echo
										 		"<div class=bucket_table_name_biznes>{$name}</div>";
								 			}
										}
									 $summ = $price * $qua;
									 echo "</div>
							 		 <div class=bucket_table_info_biznes>
							 			<div class=bucket_table_price_biznes>Цена: {$price}</div>
							 			<div class=bucket_table_qua_biznes>Кол-во: {$qua}</div>
							 			<div class=bucket_table_summ_biznes>Сумма: {$summ} р.</div>
							 		 </div>";
									}
								 $totalsumm += $summ;
								 $totalqua += $qua;
								}
				echo "</div>
					 <div class=bucket_totalsumm>Общая сумма: <span>{$totalsumm} р.</span></div>";
					}
			?>
		</div>
		<div><?php require_once('footer.php'); ?></div>
	</body>
	<script src="jQuery.js"></script>
	<script>
	$(document).ready(function()
		{
		 $('.bucket_table_operation').click(function operation()
			{
             var operation = $(this).attr('operation');
			 var id_product = $(this).attr('id_product');
             $.ajax(
            	{
                 type: "POST",
                 url: "modify_status.php",
                 dataType: "html",
                 data: ({operation:operation, id_product:id_product}),
				});
			 setTimeout(function() {window.location.reload();}, 500);
        	});
		$(".bucket_products_weit").click(function ()
           {
            $(this).siblings('.bucket_table_product_weit').slideToggle("slow");
           });
		});
	</script>
</html>