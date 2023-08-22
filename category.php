<a class="category_link_podmenu category_main-item" href="javascript:void(0)">Меню</a>
<div class="category_podmenu category_sub-menu">
	<div class="category_gorizontal_menu">
		<div class="category_gorizontal_first_menu">
			<?php
				$path = 'img/';
				$category = htmlspecialchars($_GET["category"]);
				$result_id_categories = mysqli_fetch_array(mysqli_query ($connect, "SELECT id_categories FROM categories WHERE id='$category' AND public='1'"));
				$id_categories = $result_id_categories['id_categories'];
				$result = mysqli_query ($connect, "SELECT * FROM categories WHERE type='first' AND public='1' GROUP BY id_categories");
				while($row = mysqli_fetch_array($result))
					{
					 $name = $row['name'];
					 $id_first_categories = $row['id_categories'];
					 if ($id_categories == $id_first_categories)
				 		{
						 echo "<a class='category_gorizontal_link_first category_gorizontal_link_first_active' href=# id_categories='$id_first_categories'><div class=category_link_first_name>{$name}</div></a>";
						}
					 else
				 		{
						 echo "<a class='category_gorizontal_link_first' href=# id_categories='$id_first_categories'><div class=category_gorizontal_link_first_name>{$name}</div></a>";
						}
					}
			?>
		</div>
		<?php
			$result2 = mysqli_query ($connect, "SELECT * FROM categories WHERE type='second' GROUP BY id_categories");
			while($row2 = mysqli_fetch_array($result2))
				{
				 $id_categories2 = $row2['id_categories'];
				 if ($id_categories2 == $id_categories)
				 	{
					 echo "<div class='category_gorizontal_second_menu {$id_categories2} category_gorizontal_second_menu_active'>";
					 $result3 = mysqli_query ($connect, "SELECT * FROM categories WHERE type='second' AND id_categories='$id_categories2' AND public='1'");
					 while($row3 = mysqli_fetch_array($result3))
						{
						 $id3 = $row3['id'];
						 $name3 = $row3['name'];
						 if ($id3 == $category)
			 				{
							 echo "<div class=category_gorizontal_link_second_block><a class='category_gorizontal_link_second category_gorizontal_link_second_active' href=../?category={$id3}>{$name3}</a></div>";
			 				}
						 else
			 				{
							 echo "<div class=category_gorizontal_link_second_block><a class='category_gorizontal_link_second' href=../?category={$id3}>{$name3}</a></div>";
			 				}
						}
					 echo "</div>";
				 	}
				 else
				 	{
					 echo "<div class='category_gorizontal_second_menu {$id_categories2}'>";
					 $result4 = mysqli_query ($connect, "SELECT * FROM categories WHERE type='second' AND id_categories='$id_categories2' AND public='1'");
					 while($row4 = mysqli_fetch_array($result4))
						{
						 $id4 = $row4['id'];
						 $name4 = $row4['name'];
						 if ($id4 == $category)
			 				{
							 echo "<div class=category_gorizontal_link_second_block><a class='category_gorizontal_link_second category_gorizontal_link_second_active' href=../?category={$id4}>{$name4}</a></div>";
			 				}
						 else
			 				{
							 echo "<div class=category_gorizontal_link_second_block><a class='category_gorizontal_link_second' href=../?category={$id4}>{$name4}</a></div>";
			 				}
						}
					 echo "</div>";
				 	}
				 
				}
		?>
	</div>
	<div class="category_vertical_menu">
		<div class="category_vertical_first_menu">
			<?php
				$path = 'img/';
				$category = htmlspecialchars($_GET["category"]);
				$result_id_categories = mysqli_fetch_array(mysqli_query ($connect, "SELECT id_categories FROM categories WHERE id='$category' AND public='1'"));
				$id_categories = $result_id_categories['id_categories'];
				$result5 = mysqli_query ($connect, "SELECT * FROM categories WHERE type='first' AND public='1' GROUP BY id_categories");
				while($row5 = mysqli_fetch_array($result5))
					{
					 $name5 = $row5['name'];
					 $id_first_categories5 = $row5['id_categories'];
					 if ($id_categories == $id_first_categories5)
				 		{
						 echo "<div class='category_vertical_link_first category_vertical_link_first_active' id_categories='$id_first_categories5'><div class=category_vertical_link_first_name>{$name5}</div><div class=category_vertical_arrow><img width=100% src='$path/arrow.png'></div></div>";
						}
					 else
				 		{
						 echo "<div class='category_vertical_link_first' id_categories='$id_first_categories5'><div class=category_vertical_link_first_name>{$name5}</div><img class=category_vertical_arrow src='$path/arrow.png'></div>";
						}
					}
			?>
		</div>
		<?php
			$result6 = mysqli_query ($connect, "SELECT * FROM categories WHERE type='second' GROUP BY id_categories");
			while($row6 = mysqli_fetch_array($result6))
				{
				 $id_categories6 = $row6['id_categories'];
				 if ($id_categories6 == $id_categories)
				 	{
					 echo "<div class='category_vertical_second_menu {$id_categories6} category_vertical_second_menu_active'>";
					 $result7 = mysqli_query ($connect, "SELECT * FROM categories WHERE type='second' AND id_categories='$id_categories6' AND public='1'");
					 while($row7 = mysqli_fetch_array($result7))
						{
						 $id7 = $row7['id'];
						 $name7 = $row7['name'];
						 if ($id7 == $category)
			 				{
							 echo "<div class=category_vertical_link_second_block><a class='category_vertical_link_second category_vertical_link_second_active' href=../?category={$id7}>{$name7}</a></div>";
			 				}
						 else
			 				{
							 echo "<div class=category_vertical_link_second_block><a class='category_vertical_link_second' href=../?category={$id7}>{$name7}</a></div>";
			 				}
						}
					 echo "</div>";
				 	}
				 else
				 	{
					 echo "<div class='category_vertical_second_menu {$id_categories6}'>";
					 $result8 = mysqli_query ($connect, "SELECT * FROM categories WHERE type='second' AND id_categories='$id_categories6' AND public='1'");
					 while($row8 = mysqli_fetch_array($result8))
						{
						 $id8 = $row8['id'];
						 $name8 = $row8['name'];
						 if ($id8 == $category)
			 				{
							 echo "<div class=category_vertical_link_second_block><a class='category_vertical_link_second category_vertical_link_second_active' href=../?category={$id8}>{$name8}</a></div>";
			 				}
						 else
			 				{
							 echo "<div class=category_vertical_link_second_block><a class='category_vertical_link_second' href=../?category={$id8}>{$name8}</a></div>";
			 				}
						}
					 echo "</div>";
				 	}
				}
		?>
	</div>
</div>
<script src="jQuery.js"></script>
<script>
	$(document).ready(function()
		{
		 $('.category_gorizontal_link_first').click(function()
			{
			 var id_categories = $(this).attr('id_categories');
			 $('.category_gorizontal_second_menu_active').removeClass('category_gorizontal_second_menu_active');
			 $('.'+id_categories).addClass('category_gorizontal_second_menu_active');
			 $('.category_gorizontal_link_first').removeClass('category_gorizontal_link_first_active');
			 $(this).addClass('category_gorizontal_link_first_active');
			});
		 $('.category_vertical_link_first').click(function()
			{
			 var id_categories = $(this).attr('id_categories');
			 $('.category_vertical_second_menu_active').removeClass('category_vertical_second_menu_active');
			 $('.'+id_categories).addClass('category_vertical_second_menu_active');
			 $('.category_vertical_link_first').removeClass('category_vertical_link_first_active');
			 $(this).addClass('category_vertical_link_first_active');
			});
		});
</script>