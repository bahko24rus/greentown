<?php
	session_start();
	require_once('connect.php');
	if(!$_SESSION['user'])
		{
		 header('Location: index.php');
		}
	$login = $_SESSION['user']['login'];
	$status = mysqli_fetch_array(mysqli_query($connect, "SELECT status FROM users WHERE login = '$login'"));
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Профиль пользователя</title>
		<link rel="icon" href="img/logo-gt_50.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?php
			if ($status['status'] == "user")
				{
				 require_once('profile_user.php');
				}
			else if ($status['status'] == "admin")
				{
				 require_once('profile_admin.php');
				}
			else if ($status['status'] == "moderator")
				{
				 require_once('profile_moderator.php');
				}
		?>
	</body>
</html>