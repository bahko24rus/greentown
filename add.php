<form class="add_category_form" action="save_category.php" method="post">
	<div class="add_category_name">Категорию</div>
	<div class="add_category_text">Название</div>
	<input class="add_category_input" type="text" name="name">
	<div class="add_category_text">Публикация</div>
	<select class="add_category_select" name="public" id="public_category">
		<option value="0">Нет</option>
		<option value="1">Да</option>
	</select>
	<button class="add_category_button" type="submit">Добавить</button>
	<p class='add_category_message'>
		<font>
			<?php 
				echo $_SESSION['add_category_message'];
				unset($_SESSION['add_category_message']);
			?>
		</font>
	</p>
</form>
<form class="add_product_form" action="save_product.php" method="post" enctype='multipart/form-data'>
	<div class="add_product_name">Блюдо</div>
	<div class="add_product_text">Категория</div>
	<select onclick="send_class();" class="add_product_select" name="class" id="class">
		<option value="2">Горячее</option>
		<option value="3">Супы</option>
		<option value="4">Салаты</option>
		<option value="5">Закуски</option>
		<option value="6">Закуски к пиву</option>
		<option value="7">Пицца/Бургеры</option>
		<option value="8">Гарниры</option>
		<option value="9">Детское</option>
		<option value="10">Блины/Выпечка</option>
		<option value="11">Соусы</option>
		<option value="12">Паста</option>
		<option value="14">Ролы</option>
		<option value="15">Ролы темпура</option>
		<option value="16">Ассорти ролы</option>
		<option value="17">Закуски</option>
		<option value="18">Лапша и рис</option>
		<option value="19">Том ям</option>
		<option value="20">Бизнес-ланч</option>
	</select>
	<div class="add_product_text add_product_none add_product_select_biznes">Бизнес день</div>
	<select class="add_product_select add_product_none add_product_select_biznes" name="biznes">
		<option value="17">Понедельник</option>
		<option value="18">Вторник</option>
		<option value="19">Среда</option>
		<option value="20">Четверг</option>
		<option value="21">Пятница</option>
	</select>
	<select class="add_product_select add_product_none add_product_select_biznes" name="bludo">
		<option value="1">Суп</option>
		<option value="2">Горячее</option>
		<option value="3">Салат</option>
		<option value="4">Гарнир</option>
	</select>
	<div class="add_product_text">Картинка</div>
	<input class="add_product_select" type="file" name="img_product">
	<div class="add_product_text">Название</div>
	<input class="add_product_input" type="text" name="name">
	<div class="add_product_text add_product_ingredients">Ингридиенты</div>
	<input class="add_product_input add_product_ingredients" type="text" name="ingredients">
	<div class="add_product_text">Цена</div>
	<input class="add_product_input" type="text" name="price">
	<div class="add_product_text">Вес</div>
	<input class="add_product_input" type="text" name="weight">
	<div class="add_product_text add_product_none add_product_pizza">Цена2</div>
	<input class="add_product_input add_product_none add_product_pizza" type="text" name="price2">
	<div class="add_product_text add_product_none add_product_pizza">Вес2</div>
	<input class="add_product_input add_product_none add_product_pizza" type="text" name="weight2">
	<div class="add_product_text">Публикация</div>
	<select class="add_product_select" name="public_product">
		<option value="0">Нет</option>
		<option value="1">Да</option>
	</select>
	<button class="add_product_button" type="submit">Добавить</button>
	<p class='add_product_message'>
		<font>
			<?php 
				echo $_SESSION['add_product_message'];
				unset($_SESSION['add_product_message']);
			?>
		</font>
	</p>
</form>
<script src="jQuery.js"></script>
<script>
	function send_class()
		{
       	 var clas = $('#class').val()
		 if (clas == 7)
			{
		 	 $('.add_product_pizza').addClass('add_product_active');
		 	 $('.add_product_select_biznes').removeClass('add_product_active');
			}
		 if (clas == 20)
			{
		 	 $('.add_product_select_biznes').addClass('add_product_active');
		 	 $('.add_product_pizza').removeClass('add_product_active');
		 	 $('.add_product_ingredients').addClass('add_product_none');
			}
		 if (clas != 7 && clas != 20)
			{
		 	 $('.add_product_pizza').removeClass('add_product_active');
		 	 $('.add_product_select_biznes').removeClass('add_product_active');
		 	 $('.add_product_ingredients').removeClass('add_product_none');
			}
		}
</script>