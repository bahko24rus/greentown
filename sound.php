<?php
	require_once('connect.php');
	$result = mysqli_query($connect, "SELECT number_order FROM orders WHERE status='Ожидание...' AND new_message='1' GROUP BY number_order");
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{
		 $order_new += count($row);
		}
	if (!$order_new)
		{
		 $order_new = 0;
		}
	echo $order_new;
?>