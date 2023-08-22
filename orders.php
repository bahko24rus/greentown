<?php
	$result = mysqli_query ($connect, "SELECT *, count(telephone) as cnt FROM `orders` GROUP BY `telephone`, `number_order`");
	while ($row = mysqli_fetch_array($result))
		{
		 $totalsumm = 0;
		 $telephone = $row['telephone'];
		 $new_order = $row['new_message'];
		 $first_time = $row['first_time'];
		 if ($row['cnt'] > 0)
			 {
			  $status = $row['status'];
			  $number_order = $row['number_order'];
			  if ($new_order == 1)
			  	{
				 echo "<div id=hidden class=orders_user_new>";
			  	}
			  else
			  	{
				 echo "<div id=hidden class=orders_user>";
			  	}
				 $check_user = mysqli_num_rows (mysqli_query ($connect, "SELECT id FROM `users` WHERE telephone='$telephone'"));
				 if ($check_user > 0)
					{
					 $user = mysqli_query ($connect, "SELECT * FROM `users` WHERE telephone='$telephone'");
			 		 while ($user_info = mysqli_fetch_array($user, MYSQLI_ASSOC))
			  			{
						 $first_name = $user_info['first_name'];
						 $middle_name = $user_info['middle_name'];
						 $last_name = $user_info['last_name'];
			  			}
				 	 echo "<div class=orders_user_info number_order={$number_order}>{$first_name} {$middle_name} {$last_name} {$telephone} <div class=orders_status>Заказ: {$number_order} {$status}</div></div>"; 
			  		}
			 	 else
				 	{
					 echo "<div class=orders_user_info number_order={$number_order}>{$telephone} <div class=orders_status>Заказ: {$number_order} {$status}</div></div>";
				 	}
			 	 $result2 = mysqli_query ($connect, "SELECT * FROM orders WHERE telephone='$telephone' AND number_order='$number_order' GROUP BY number_tovara");
			 	 while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
			  		{
					 $id = $row2['id_product'];
			 		 $qua = $row2['qua'];
			 		 $size = $row2['size'];
					 $number_tovara = $row2['number_tovara'];
					 $modify = $row2['modify'];
					 $result3 = mysqli_query ($connect, "SELECT * FROM products WHERE id_product='$id' AND size='$size'");
					 while($row3 = mysqli_fetch_array($result3))
			 			{
						 $name = $row3['name'];
						 $compliment = $row3['compliment'];
						 $price = $row3['price'];
						 $weight = $row3['weight'];
						 $summ = $price * $qua;
			 			}
					 if ($modify == 'dual')
			 			{
						 if ($size == 'big')
					 		{
							 $size = 'Большая';
					 		 echo
				 				"<div class=orders_products><div class=orders_type_name>Пицца:</div>
									<div class=orders_name>{$name}</div>
									<div class=orders_product_price>Цена: {$price}</div>
									<div class=orders_size_product>Размер: {$size}</div>
									<div class=orders_qua_product>Колличество: {$qua}</div>
									<div class=orders_summ_product>Сумма: {$summ}</div>
				 				</div>";
					 		}
				  		 else if ($size == 'small')
				  			{
							 $size = 'Маленькая';
							 echo
				 				"<div class=orders_products><div class=orders_type_name>Пицца:</div>
									<div class=orders_name>{$name}</div>
									<div class=orders_product_price>Цена: {$price}</div>
									<div class=orders_size_product>Размер: {$size}</div>
									<div class=orders_qua_product>Колличество: {$qua}</div>
									<div class=orders_summ_product>Сумма: {$summ}</div>
				 				</div>";
			 			 	}
				 		}
					 else if ($modify == 'biznes')
						{
						 $summ = $price * $qua;
						 echo "<div class=orders_products><div class=orders_type_name>Бизнес-Ланч:</div>";
						 $result_biznes = mysqli_query ($connect, "SELECT id_product FROM orders WHERE number_tovara='$number_tovara' AND telephone='$telephone' AND number_order='$number_order'");
						 while($row_biznes = mysqli_fetch_array($result_biznes))
							{
							 $id_product = $row_biznes['id_product'];
							 $result_product = mysqli_query ($connect, "SELECT * FROM products WHERE id_product='$id_product'");
							 while($row_product = mysqli_fetch_array($result_product))
							 	{
								 $name = $row_product['name'];
								 $price = $row_product['price'];
								 echo
									 "<div class=orders_biznes>
									 	<div class=orders_name>{$name}</div>
									 </div>";
							 	}
							}
						 echo
							 	"<div class=orders_product_price>Цена: {$price}</div>
								<div class=orders_qua_product>Колличество: {$qua}</div>
								<div class=orders_summ_product>Сумма: {$summ}</div>
				 			</div>";
			 			}
					 else
						{
						 $summ = $price * $qua;
						 echo
				 			"<div class=orders_products>
								<div class=orders_name>{$name}</div>
								<div class=orders_product_price>Цена: {$price}</div>
								<div class=orders_qua_product>Колличество: {$qua}</div>
								<div class=orders_summ_product>Сумма: {$summ}</div>
				 			</div>";
			 			}
					 $totalsumm += $summ;
			  		}
			  	 if ($status == "Ожидание...")
					{
					 echo
						"<div>
				 			<div class=orders_totalsumm>Общая сумма: <span>{$totalsumm}</span></div>
							<button class=orders_process number_order={$number_order}>В готовку</button>
						</div>";
					}
				 else if ($status == "Готовится...")
					{
					 echo
						"<div>
				 			<div class=orders_totalsumm>Общая сумма: <span>{$totalsumm}</span></div>
							<button class=orders_process number_order={$number_order}>Приготовлен</button>
						</div>";
					}
			 	 else
					{
					 echo
						"<div>
				 			<div class=orders_totalsumm>Общая сумма: <span>{$totalsumm}</span></div>
							<button class=orders_process number_order={$number_order}>Завершить</button>
						</div>";
					}
				 
			 	}
			echo "</div>";
		}?>
	<script src="jQuery.js"></script>
	<script>
		$('.orders_user_info').click(function()
			{
			 $('.orders_user_new').addClass('orders_user');
			 $('.orders_user_new').removeClass('orders_user_new');
	 		});
		$(".orders_user_info").click(function ()
           {
            $(this).siblings('.orders_products').slideToggle("slow");
			var new_message = $(this).attr("number_order");
            $.ajax(
				{
                 type: "POST",
                 url: "modify_status.php",
                 dataType: "html",
                 data: ({new_message:new_message}),
				});
           }); 
        $(document).ready(function()
			{
             $('.orders_process').click(function()
				{
                 var number_order = $(this).attr("number_order");
                 $.ajax(
					{
                     type: "POST",
                     url: "modify_status.php",
                     dataType: "html",
                     data: ({number_order:number_order}),
					});
			 	});
			});
        $(document).ready(function()
			{
             $('.orders_process').click(function()
				{
				 location.reload()
			 	});
			});
		$(document).ready(function()
			{
             $('.hidden').click(function()
				{
                 event.target.classList.add('hidden');
			 	});
			});
	</script>