<?php
	session_start();
	require_once('connect.php');
	if(!$_SESSION['user'])
		{
		 header('Location: index.php');
		}
	$avatar = $_POST['avatar'];
	$path = 'img/avatars/';
 	$login_session = $_SESSION['user']['login'];
	$first_name = $_POST['first_name'];
	$middle_name = $_POST['middle_name'];
	$last_name = $_POST['last_name'];
	$login = $_POST['login'];
	$email = $_POST['email'];
	$telephone = $_POST['telephone'];
	$password = $_POST['password'];
	$password_confirm = $_POST['password_confirm'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$sex = $_POST['sex'];
	if ($password === $password_confirm)
		{
		 if ($first_name)
			{
 			 mysqli_query ($connect, "UPDATE users SET first_name='$first_name' WHERE login='$login_session'");
			}
		 if ($middle_name)
			{
			 mysqli_query ($connect, "UPDATE users SET middle_name='$middle_name' WHERE login='$login_session'");
			}
		 if ($last_name)
			{
			 mysqli_query ($connect, "UPDATE users SET last_name='$last_name' WHERE login='$login_session'");
			}
		 if ($login)
			{
			 mysqli_query ($connect, "UPDATE users SET login='$login' WHERE login='$login_session'");
			 unset($_SESSION['user']);
			 session_destroy(); 
			 header('Location: index.php');
			}
		 if ($email)
			{
			 mysqli_query ($connect, "UPDATE users SET email='$email' WHERE login='$login_session'");
			}
		 if ($telephone)
			{
			 mysqli_query ($connect, "UPDATE users SET telephone='$telephone' WHERE login='$login_session'");
			}
		 if ($password)
			{
			 $password = md5($password);
			 mysqli_query ($connect, "UPDATE users SET password='$password' WHERE login='$login_session'");
			 unset($_SESSION['user']);
			 session_destroy(); 
			 header('Location: index.php');
			}
		 if ($day)
			{
			 mysqli_query ($connect, "UPDATE users SET day='$day' WHERE login='$login_session'");
			}
		 if ($month)
			{
			 mysqli_query ($connect, "UPDATE users SET month='$month' WHERE login='$login_session'");
			}
		 if ($year)
			{
			 mysqli_query ($connect, "UPDATE users SET year='$year' WHERE login='$login_session'");
			}
		 if ($sex)
			{
			 mysqli_query ($connect, "UPDATE users SET sex='$sex' WHERE login='$login_session'");
			}
		 if ($_FILES['avatar']['name'])
				{
				 if(preg_match('/[.](JPG)||(jpg)||(jpeg)||(JPEG)||(gif)||(GIF)||(png)||(PNG)$/',$_FILES['avatar']['name']))
		 			{
					 $path_to_90_directory = 'img/avatars/';
					 $filename = time() . $_FILES['avatar']['name'];
					 $target = $path_to_90_directory . $filename;
					 move_uploaded_file($_FILES['avatar']['tmp_name'], $target); 
					 if(preg_match('/[.](GIF)|(gif)$/', $filename))
			 			{
						 $im = imagecreatefromgif($path_to_90_directory . $filename) ;
			 			}
					 if(preg_match('/[.](PNG)|(png)$/', $filename))
			 			{
						 $im = imagecreatefrompng($path_to_90_directory . $filename) ;
			 			}
					 if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/', $filename))
			 			{
						 $im = imagecreatefromjpeg($path_to_90_directory . $filename);
			 			}
				 $w = 120;
				 $quality = 100;
				 $w_src = imagesx($im);
				 $h_src = imagesy($im);
				 $rezim = 1;     
				 switch ($rezim)
			 		{
					 case "1" : 
					 $dest = imagecreatetruecolor($w,$w);  
					 if ($w_src > $h_src)
				 		{ 
						 imagecopyresampled($dest, $im, 0, 0, round((max($w_src,$h_src)-min($w_src,$h_src))/2), 0, $w, $w, min($w_src,$h_src), min($w_src,$h_src));
				 		}
					 if ($w_src < $h_src)
				 		{
						 imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, min($w_src,$h_src), min($w_src,$h_src)); 
				 		}
					 if ($w_src == $h_src)
				 		{
						 imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, $w_src, $h_src); 
				 		}
					 break;
					 case "2" : 
					 $prop = $w_src/$h_src;
					 $h = $w/$prop;
					 $dest = imagecreatetruecolor($w,$h); 
					 imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $h, $w_src, $h_src); 
					 break;
			 		}
				 $random = rand(1000000, 9999999);
				 imagejpeg($dest, $path_to_90_directory.$random.".jpg", $quality);
				 $avatar = $random.".jpg";
				 $delfull = $path_to_90_directory.$filename; 
				 unlink ($delfull);
				 mysqli_query ($connect, "UPDATE users SET avatar='$avatar' WHERE login='$login_session'");
		 		}
			 else
				{
				 exit ("Аватар должен быть в формате <strong>JPG,GIF или PNG</strong>");
				}
			}
		 header('Location: profile.php');
		}
	else
		{
		 $_SESSION['settings_msg_pass_conf'] = 'Пароли не совпадают';
		 header('Location: settings.php');
		}
	$status = $_POST['status'];
	$access = $_POST['access'];
	$user_name = $_POST['user_name'];
	if ($status)
			{
			 mysqli_query ($connect, "UPDATE users SET status='$status' WHERE login='$user_name'");
			}
	if ($access)
			{
			 mysqli_query ($connect, "UPDATE users SET access='$access' WHERE login='$user_name'");
			}
?>