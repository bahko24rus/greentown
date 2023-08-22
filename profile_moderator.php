<!doctype html>
<html>
	<body class="profile_moderator_background">
		<div class="profile_moderator_block1"><?php require_once('header_personal_area.php'); ?></div>
		<div class="profile_moderator_block2"><?php require_once('menu_personal_area.php'); ?></div>
		<div class="profile_moderator_block3">
			<?php
				$login = $_SESSION['user']['login'];
				$result = mysqli_query ($connect, "SELECT * FROM users WHERE login = '$login'");
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
					{
					 $admin = $row['admin'];
					 $first_name = $row['first_name'];
					 $middle_name = $row['middle_name'];
					 $last_name = $row['last_name'];
					 $email = $row['email'];
					 $telephone = $row['telephone'];
					 $day = $row['day'];
					 $month = $row['month'];
					 $year = $row['year'];
					 $avatar = $row['avatar'];
					 $sex = $row['sex'];
					}
				$path = '../img/avatars/';
				if($avatar == '')
		 			{
					 $avatarka = 'noAvatar.jpg';
					}
				else
					{
					 $avatarka = $avatar;
					}
				$ava = $path.$avatarka;
				echo
					"<div class=profile_moderator_personal_info><div class=profile_moderator_header_personal_info>Пользовательские данные.</div>
					<div class=profile_moderator_avatar><img src={$ava}></div>
					<div class=profile_moderator_info>{$first_name} {$middle_name} {$last_name}</br>
					E-mail: {$email}</br>
					Моб. Телефон: {$telephone}</br>
					Дата рождения: {$day}{$month}{$year}</br>
					Пол:{$sex}</div></div>";
				$result2 = mysqli_query($connect, "SELECT number_order FROM orders GROUP BY number_order");
				while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
					{
					 $order_new += count($row2);
					}
				if (!$order_new)
					{
					 $order_new = 0;
					}
			?>
		</div>
		<div class="profile_moderator_block4">
			<div class="profile_moderator_block_add">
				<div class="profile_moderator_text">Добавить</div>
				<div class="profile_moderator_add"><?php require_once('add.php'); ?></div>
			</div>
			<div class="profile_moderator_search_product">
				<div class="profile_moderator_text">Поиск блюд</div>
				<div class="profile_moderator_bludo">Искать по:
					<select class="profile_moderator_select" name="serch_id" id="serch_id">
						<option value="1">ид блюда</option>
						<option value="2">категории</option>
						<option value="3">названию</option>
					</select>
				</div>
				<div class="profile_moderator_bludo">
    				<form action="">
						<input class="profile_moderator_text" id="id_bludo" type="text">
						<input class="profile_moderator_button" onclick="serch_bludo();" value="Отправить" type="button">
					</form>
				<div id="bludo"></div>
				</div>
			</div>
		</div>
		<div class="profile_moderator_block5">
			<div class="profile_moderator_text">Заказы<?php echo "(<span class=order_new id=order_new>{$order_new}</span>)"; ?></div>
			<div class="profile_moderator_orders">
    			<?php require_once('orders.php'); ?>
			</div>
		</div>
		<div class="profile_moderator_block6">
			<?php require_once('footer.php'); ?>
		</div>
		<script src="jQuery.js"></script>
		<script>
		    $(document).ready(function()
               {
				var audio = new Audio();
				audio.src = '../8405-uvedomlenij-novogo-zakaza-v-prilozhenii-jandekstaksi.wav';
				var check_new_order;
                $(".profile_moderator_text").click(function ()
                   {
                    $(this).siblings(".profile_moderator_add").slideToggle("slow");
                   });
				$(".profile_moderator_text").click(function ()
                   {
                    $(this).siblings(".profile_moderator_bludo").slideToggle("slow");
                   });
				setInterval(function()
					{
    				 $.post('order_new.php',function(data_new_order)
						{
						 var event = new Event(["click"]);
						 check_new_order = data_new_order;
						 if (check_new_order > 0)
						 	{
							 audio.play();
						 	}
    					});
  					},3000);
               })
			function serch_bludo()
				{
                 var serch_id = $('#serch_id').val()
                 var id_bludo = $('#id_bludo').val()
                 $.ajax(
					{
                     type: "POST",
                     url: "serch_bludo.php",
					 dataType: "html",
					 data: ({serch_id:serch_id, id_bludo:id_bludo}),
                     success: function(html)
						{
                         $("#bludo").empty();
                         $("#bludo").append(html);
						}
					});
				}
		</script>
	</body>
</html>