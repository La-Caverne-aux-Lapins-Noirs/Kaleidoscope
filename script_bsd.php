<?php
	$testeur = "lobo951";
	include("log.php");
	include("fonctions.php");
	mysql_connect($db_adr, $db_login, $db_password) or die(mysql_error());
	mysql_select_db($db_name) or die(mysql_error());
	
	date_default_timezone_set('Europe/Gibraltar');
	
	if(isset($_SERVER['SERVER_NAME']))
		$domain = $_SERVER['SERVER_NAME'];
	else
		$domain = "";
	
	if(isset($_SERVER['PHP_SELF']))
		$link = $_SERVER['PHP_SELF'];
	else
		$link = "";
	
	if(isset($_SERVER['REMOTE_ADDR']))
		$ip = $_SERVER['REMOTE_ADDR'];
	else
		$ip = "255.255.255.255";
	
	$j = 0;
	$admin_configuration = mysql_query("SELECT configuration FROM admin_configuration") or die(mysql_error());
	while($admin_configuration_array = mysql_fetch_array($admin_configuration))
		{
			$configuration[$j] = $admin_configuration_array['configuration'];
			$j++;
		}
	
	if(isset($_COOKIE['language']))
		$langage_code = $_COOKIE['language'];
	else
		$langage_code = "eng";
	
	$j = 0;
	$langage_source = mysql_query("SELECT ".$langage_code." FROM langue_source") or die(mysql_error());
	while($langage_source_array = mysql_fetch_array($langage_source))
		{
			$langage[$j] = $langage_source_array[$langage_code];
			$j++;
		}
	
	$url = $domain.$link;
	
	$last_vid = mysql_query("SELECT id_video FROM tube_general ORDER BY id_video DESC LIMIT 0, 1") or die(mysql_error());
	$last_vid_array = mysql_fetch_array($last_vid);
	if(isset($last_vid_array['id_video']))
		$last_vid = $last_vid_array['id_video'];
	else
		$last_vid = 0;
	
	if(isset($_COOKIE['login']))
		$cookie_login = $_COOKIE['login'];
	else
		$cookie_login = "";

	if(isset($_COOKIE['hash']))
		$cookie_hash = $_COOKIE['hash'];
	else
		$cookie_hash = hash("sha256", rand(-128, 127), false);
	
	$membre_information = mysql_query(
"SELECT membre_general.*, admin_hierarchie.niveau 
FROM membre_general, admin_hierarchie  
WHERE membre_general.login = '".strtolower($cookie_login)."' 
&& membre_general.hash = '$cookie_hash'
&& membre_general.id_membre = admin_hierarchie.id_membre
") or die(mysql_error());

	$membre_information_array = mysql_fetch_array($membre_information);
	if(isset($membre_information_array['login_original']))
		$id_auteur = $membre_information_array['id_membre'];
	else
		$id_auteur = 1;
	
	$link = "index.php";
	$_blank = false;
	$baratin = "<b>TASK:</b> <br />";
	
	$file_error = "";
	//ISSET GENERAL
	if(isset($_POST['MAX_FILE_SIZE']))
		$up_plafond = $_POST['MAX_FILE_SIZE'];
	else
		$up_plafond = 0;
		
	if(isset($_GET['id_video']))
		$id_video = $_GET['id_video'];
	else
		$id_video = 0;
	
	if(isset($_POST['id_video']))
		$id_video = $_POST['id_video'];
	else
		$id_video = 0;
	
		$date = date("Y-m-j");
		
	if(isset($_POST['code_bot']))
		$code_bot = $_POST['code_bot'];
	else
		$code_bot = 1;
	
	if(isset($_POST['code_bot_copie']))
		$code_bot_copie = $_POST['code_bot_copie'];
	else	
		$code_bot_copie = 0;
	
	if(isset($_GET['logout']) && $_GET['logout'] == true)
		{
			setcookie("login", "", time() - 1);
			setcookie("hash", "", time() - 1);
			$file_error = "Logout, please wait...";
		}
	
	if(isset($_POST['deconnexion']))
		{
			setcookie("login", "", time() - 1);
			setcookie("hash", "", time() - 1);
			$file_error = "Logout, please wait...";
		}
	
	if(isset($_POST['login']) && isset($_POST['connect']))
		{
			if($_POST['code_bot'] == $_POST['code_bot_copie'])
				{
					setcookie("login", strtolower($_POST['login']), time() + 365 * 24 * 60 * 60);
					$verification = mysql_query("SELECT hash FROM membre_general WHERE login = '".strtolower($_POST['login'])."'");
					$verification = mysql_fetch_array($verification);
					if(isset($verification['hash']))
						{
							$baratin .= "LOGIN CHECKED!";
							if($verification['hash'] == hash("sha256", $_POST['password'], false))
								{
									setcookie("hash", hash("sha256", $_POST['password'], false), time() + 365 * 24 * 60 * 60);
									$link = "http://".$domain."/index.php";
									$file_error = "Please wait during identification...";
								}
							else
								$file_error = "Wrong password!";
						}
					else
						$file_error = "Login error";
				}
			else
				$file_error = "Restranscription error";
		}
	
	if(isset($_POST['langage']))
		{
			setcookie('language', $_POST['langage'], time() + 365 * 24 * 60 * 60);
			$baratin .= "LANGUAGE SELECTED!<br />";
		}

	if(isset($_FILES['up_file']['name']))
		{
			$baratin .=  "FILE IS SET<br />";
			flush();
			$file_up = true;
			$file_name = $_FILES['up_file']['name'];
			$file_type = strtolower(substr($_FILES['up_file']['name'], -3, 3));
			$file_link = $_FILES['up_file']['tmp_name'];
			$file_error = $_FILES['up_file']['error'];
			$file_size = $_FILES['up_file']['size'];
		}
	else
		$file_up = false;
		
	if(isset($_POST['up_titre']))
		$up_titre = $_POST['up_titre'];
	else
		$up_titre = 0;
	
	if(isset($_POST['up_description']))
		$up_description = clean_form((string)$_POST['up_description']);
	else
		$up_description = 0;
	
	if(isset($_POST['up_check']))
		$up_check = $_POST['up_check'];
	else
		$up_check = false;
	
	if(isset($_POST['up_keywords']))
		{
			$keyword = explode(" ", $_POST['up_keywords'], 10);
			$nbr_keyword = count($keyword);
			$baratin .=  "KEYWORDS : ".$nbr_keyword." <br />";
			flush();
			for($j = 0; $j < $nbr_keyword; $j++)
				$keyword[$j] = strtolower($keyword[$j]);
		}
	else
		$keywords[0] = "";
	
	if(isset($_POST['sel']))
		$sel = $_POST['sel'];
	else
		$sel = "";

	if(isset($_POST['link']))
		$link = $_POST['link'];
	else
		$link = "index.php";

	//UPLOAD SECTION
	if($file_up == true)
		{
			if($up_check)
				{
					if($code_bot == $code_bot_copie)
						{
							$baratin .=  "CHECK OK<br />";
							if($file_error > 0)
								$file_error = "Upload error! ($file_error)";
							else
								{
									if($keyword == "")
										$file_error = "No keywords entry!";
									else
										{
											$baratin .=  "UPLOAD SUCCESS<br />";
											if($file_size > $up_plafond)
												{
													$file_error = "Your file does not meet the maximum size allowed. ($file_size > $up_plafond)";
												}
											else
												{
													$baratin .=  "KEYWORDS CORRECTED<br />";
													$baratin .=  "SIZE ACCEPTED<br />";
													$ext_allowed = array('mov', 'avi', 'wmv', 'mpg', 'flv', 'mp4', '3gp', 'm4v'); 
													if(in_array($file_type, $ext_allowed))
														{
															$baratin .=  "EXTENSION RECONIZED<br />";
															$last_vid++;
															$sel = rand(0, 127);
															$final_name = hash("sha256", $last_vid.$sel, false);
															$file_transfer = move_uploaded_file($file_link, "upload_vid/".$final_name.".".$file_type);
															if($file_transfer)
																{
																	$baratin .=  "FILE COPY SUCCESSED<br />";
																	$fichier = fopen("upload_vid/log/".$final_name.".txt", "a");
																	if($file_type != "flv")
																		{
																			$instruction = "/usr/local/bin/ffmpeg -i upload_vid/".$final_name.".".$file_type." -y -ar 11025 -b 2400000 -f flv upload_vid/".$final_name.".flv";
																			passthru($instruction, $temp);
																		}
																	$baratin .=  "CONVERSION ACHIEVED<br />";
																	$file_error = "Upload successful";
																}
															else
																{
																	$file_error = "Internal server error(".$file_transfer.")";
																}
														}
													else
														$file_error = "Unallowed file type($file_type)";
												}
										}
								}
						}
					else
						{
							$file_error = "Codes does not match";
						}
				}
			else
				{
					$file_error = "You must accept the Terms Of Services";
				}
		}

	//SQL SECTION	
	if($file_error == "Upload successful")
		{
			$baratin .=  "UPLOAD SUCCESSFUL<br />";
			$verif = 'F';
			if ($configuration[7] == true)
				$verif = 'V';
			mysql_query("INSERT INTO tube_general VALUES($last_vid, $id_auteur, '$up_titre', '".upload_clean($up_description)."', '".date("Y-m-d")."', 0, '$verif', $sel)") or die(mysql_error());
			mysql_query("INSERT INTO tube_note VALUES($last_vid, 1, 10)");
			$j = 0;
			for($j = 0; $j < $nbr_keyword; $j++)
				mysql_query("INSERT INTO tube_keyword VALUES('$last_vid', '".$keyword[$j]."', '')") or die(mysql_error());
			
			$video = new ffmpeg_movie("upload_vid/".$final_name.".flv");
			$baratin .=  "OBJECT CREATED<br />";
			$duration = $video->getDuration() / 2;
			$baratin .=  "DURATION READED<br />";
			$point_miniature = $video->getFrame($duration);
			if($point_miniature)
				{
					$baratin .=  "FRAME ACQUIRED<br />";
					$instruction = "/usr/local/bin/ffmpegthumbnailer -i upload_vid/".$final_name.".flv -s 150 -q 5 -o upload_img/mini_".$last_vid.".jpg";
					passthru($instruction, $error);
					//echo "<br />".$error."<br />";
					$baratin .=  "FILE CREATED<br />";
					if($file_type != "flv")
						unlink("upload_vid/".$final_name.".".$file_type);
					$baratin .=  "MEMORY CLEANED<br />";
					$link = "index.php?fichier=tube.php&amp;tube=".$last_vid;
				}
			else
				$file_error = $file_error + "<br />Mini frame creation failed!";
		}
	
	if(isset($_POST['commentaire']))
		{
			$id_video = $_POST['id_video'];
			$commentaire = $_POST['commentaire'];
			mysql_query("INSERT INTO tube_commentaire VALUES('', '$id_video', '$id_auteur', '".date("Y-m-j")."', '".upload_clean($commentaire)."', 'F')") or die(mysql_error());
			$baratin .= "COMMENT SAVED!";
			$link = "http://".$domain."/index.php?fichier=tube.php&amp;tube=".$id_video;
		}
	
	if(isset($_POST['note']))
		{
			$test_note = mysql_query("SELECT note FROM tube_note WHERE id_video = $id_video && id_membre = $id_auteur");
			$test_note_array = mysql_fetch_array($test_note);
			mysql_query("INSERT IGNORE tube_note VALUES('$id_video', '$id_auteur', '".$_POST['note']."')") or die(mysql_error());
			if(isset($test_note_array['note']))
				if($id_auteur == 1)
					$baratin .= "YOU HAVE TO LOG IN!";
				else
					$baratin .= "YOU ALREADY NOTE THIS VIDEO!";
			else
				$baratin .= "NOTE SUCESSED!";
			$_blank = true;
		}
	
	if(isset($_GET['reportvid']))
		{
			mysql_query("INSERT INTO tube_report VALUES ('$id_video', '$id_auteur', 'V', '".date("Y-m-j")."')");
			$baratin .= "REPORT SUCESSED!";
			$_blank = true;
		}
	
	if(isset($_GET['reportcom']))
		{
			mysql_query("INSERT INTO tube_report VALUES ('$id_video', '$id_auteur', 'C', '".date("Y-m-j")."')");
			$baratin .= "REPORT SUCESSED!";
			$_blank = true;
		}
	
	if(isset($_GET['promotional']))
		{
			$name = hash("sha256", $id_video.$sel, false);
			$instruction = "/usr/local/bin/ffmpegthumbnailer -i upload_vid/".$name.".flv -s 400 -q 10 -o upload_img/big_".$id_video.".jpg";
			passthru($instruction, $error);
			mysql_query("INSERT INTO tube_promo VALUES('', $id_video)");
			$baratin .= "VIDEO SELECTED AS PROMO VIDEO!";
		}
	
	if(isset($_GET['censure_vid']))
		{
			mysql_query("UPDATE tube_general SET censure = 'V' WHERE id_video = ".$_POST['id_video']);
			$baratin .= "CENSURE USED!";
		}
	
	if(isset($_GET['censure_com']))
		{
			mysql_query("UPDATE tube_commentaire SET censure = 'V' WHERE id_commentaire = ".$_POST['id_commentaire']);
			$baratin .= "CENSURE USED!";
		}
		
	if(isset($_GET['delete']))
		{
			$name = hash("sha256", $id_video.$sel, false);
			mysql_query("DELETE FROM tube_general WHERE id_video = ".$_POST['id_video']);
			mysql_query("DELETE FROM tube_keyword WHERE id_video = ".$_POST['id_video']);
			mysql_query("DELETE FROM tube_note WHERE id_video = ".$_POST['id_video']);
			mysql_query("DELETE FROM tube_promo WHERE id_video = ".$_POST['id_video']);
			mysql_query("DELETE FROM tube_commentaire WHERE id_video = ".$_POST['id_video']);
			unlink("upload_vid/".$name.".flv");
			unlink("upload_img/mini_".$_POST['id_video'].".jpg");
			$baratin .= "VIDEO DELETED!";
		}
	
	if(isset($_POST['envoyer']))
		{
			$verification = mysql_query("SELECT id_membre FROM membre_general WHERE login = '".strtolower($_POST['login_lecteur'])."'");
			$titre = $_POST['titre'];
			$message = $_POST['message'];
			$verification = mysql_fetch_array($verification);
			if(isset($verification))
				{
					mysql_query("INSERT INTO membre_messagerie VALUES('', $id_auteur, ".$verification['id_membre'].", '$titre', '$message', '".date("Y-m-d")."', 'F', 'F', 'F')") or die(mysql_error());
					$baratin .= "MESSAGE SENT!";
				}
			else
				$file_error = "Target member does not exist!";
		}
	
	if(isset($_GET['suppression']))
		{
			$id_message = $_GET['message'];
			if($_GET['boite'] == 0)
				{
					$verification = mysql_fetch_array(mysql_query("SELECT id_lecteur FROM membre_messagerie WHERE id_message = $id_message"));
					if($verification['id_lecteur'] == $id_auteur)
						{
							mysql_query("UPDATE membre_messagerie SET del_lec = 'V' WHERE id_message = $id_message");
						}
				}
			else
				{
					$verification = mysql_fetch_array(mysql_query("SELECT id_auteur FROM membre_messagerie WHERE id_message = $id_message"));
					if($verification['id_auteur'] == $id_auteur)
						{
							mysql_query("UPDATE membre_messagerie SET del_aut = 'V' WHERE id_message = $id_message");
						}
				}
			$baratin .= "MESSAGE DELETED!";
			$link = "http://".$domain."/index.php?fichier=perso.php&amp;section=perso_messagerie.php";
		}
	
	if(isset($_POST['inscription']))
		{
			$login = $_POST['login'];
			$password = $_POST['password'];
			$password_copie = $_POST['password_copie'];
			$password_longueur = strlen($_POST['password']);
			$mail = $_POST['mail'];
			if($code_bot == $code_bot_copie)
				{
					if($password_longueur > 4)
						{
							if($password == $password_copie)
								{
									if(strlen($login) > 0)
										{
											$mail = strtolower($mail);
											if(validate_email($mail))
												{
													$password = hash("sha256", $password, false);
													$lowlogin = strtolower($login);
													$news = "F";
													if(isset($_POST['newsletter']))
														$news = "V";
													if($_POST['condition'])
														{
															$verifier_login = mysql_query("SELECT login FROM membre_general WHERE login = '$lowlogin'") or die(mysql_error());
															$verifier_login = mysql_fetch_array($verifier_login);
															if(isset($verifier_login['login']))
																$file_error = "Login not avaible";
															else
																{
																	mysql_query("INSERT INTO membre_general VALUES('', '$lowlogin', '$login', '$password', '$mail', '".date("Y-m-d")."', '', '', '', 'upload_img/avat_null.png', '', '$news')") or die(mysql_error());
																	$prise_id = mysql_fetch_array(mysql_query("SELECT id_membre FROM membre_general WHERE login = '$login'"));
																	$id_membre = $prise_id['id_membre'];
																	mysql_query("INSERT INTO admin_hierarchie VALUES('$id_membre', 0)");
																	mysql_query("INSERT INTO membre_detail(id_membre) VALUES('$id_membre')");
																	mysql_query("INSERT INTO membre_page VALUES('$id_membre', '', '')");
																	setcookie("login", strtolower($_POST['login']), time() + 365 * 24 * 60 * 60);
																	setcookie("hash", hash("sha256", $_POST['password'], false), time() + 365 * 24 * 60 * 60);
																	$baratin .= "ADDED INTO DATABASE!";
																	//PREPARER L'ENVOI DU MAiL A L'INSCRIPTION!
																	$to = $mail;
																	$subject = $langage[117]." ".$configuration[0];
																	$message = $langage[113];
																	$message .= "\n\n".$langage[3]." : ".$_POST['login'];
																	$message .= "\n\n".$langage[4]." : ".$_POST['password'];
																	$message .= "\n\n".$langage[114]."\n\n";
																	$message .= $configuration[0];
																	$admin = mysql_query("SELECT mail FROM membre_general WHERE id_membre = 0") or die(mysql_error());
																	$admin = mysql_fetch_array($admin);
																	$from = "From: <".$admin['mail'].">\n";
																	mail($to, $subject, $message, $from);
																}
														}
													else
														$file_error = "You must accept the Terms Of Services";
												}
											else
												$file_error = "Invalid mail";
										}
									else
										$file_error = "Login too short (Min: 1 char)";
								}
							else
								$file_error = "Password and copy does not match";
						}
					else
						$file_error = "Password too short (Min: 5 char)";
				}
			else
				$file_error = "Codes does not match";
		}
	
	if(isset($_POST['newlog']))
		{
			$link = "http://".$domain."/index.php?fichier=perso.php&section=perso_configuration.php&cible=compte";
			if($_POST['pass'] == $_POST['pass_copie'])
				{
					if(strlen($_POST['newlog']) > 0)
						{
							if((strlen($_POST['pass']) > 4) || (strlen($_POST['pass']) == 0))
								{
									$lowlogin = strtolower($_POST['newlog']);
									$verifier_login = mysql_fetch_array(mysql_query("SELECT login FROM membre_general WHERE login = '$lowlogin' && id_membre != $id_auteur"));
									if(isset($verifier_login['login']))
										$file_error = "Login not avaible";
									else
										{
											$news = "F";
											$password = hash("sha256", $_POST['pass'], false);
											if(isset($_POST['newsletter']))
												$news = "V";
											
											$baratin .= "MODIFICATION APPLIED!";
											if(strlen($_POST['pass']) > 0)
												{
													mysql_query("UPDATE membre_general SET login = '$lowlogin', login_original = '".$_POST['newlog']."', hash = '$password', mail = '".$_POST['mail']."', newsletter = '$news' WHERE id_membre = $id_auteur") or die(mysql_error());
													setcookie("hash", $password, time() + 365 * 24 * 60 * 60);
												}
											else
												mysql_query("UPDATE membre_general SET login = '$lowlogin', login_original = '".$_POST['newlog']."', mail = '".$_POST['mail']."', newsletter = '$news' WHERE id_membre = $id_auteur");
											setcookie("login", strtolower($_POST['newlog']), time() + 365 * 24 * 60 * 60);
										}
								}
							else
								$file_error = "Password too short (Min: 5 char)";
						}
					else
						$file_error = "Login too short (Min: 1 char)";
				}
			else
				$file_error = "Password and copy does not match";
		}
	
	if(isset($_POST['avatar']))
		{
			$link = "http://".$domain."/index.php?fichier=perso.php&section=perso_configuration.php&cible=apparence";
			$signature = clean_form($_POST['signature']);
			if($_POST['avatar'] != "")
				$avatar = $_POST['avatar'];
			else
				$avatar = "upload_img/avat_null.png";
			mysql_query("UPDATE membre_general SET avatar = '$avatar', signature = '$signature' WHERE id_membre = $id_auteur");
			$baratin .= "MODIFICATION APPLIED!";
		}
	
	if(isset($_POST['site']))
		{
			$link = "http://".$domain."/index.php?fichier=perso.php&section=perso_configuration.php&cible=detail";
			$date = explode("-", $_POST['naissance']);
			$date = $date[2]."-".$date[1]."-".$date[0]; 
			mysql_query("UPDATE membre_general SET nom = '".$_POST['nom']."', prenom = '".$_POST['prenom']."', naissance = '$date' WHERE id_membre = $id_auteur");
			mysql_query(
"UPDATE membre_detail SET residence = '".$_POST['residence']."', interet = '".$_POST['interet']."', film = '".$_POST['film']."',
msn = '".$_POST['msn']."', site = '".$_POST['site']."' WHERE id_membre = $id_auteur");
			mysql_query("UPDATE membre_page SET msg_bienvenu = '".$_POST['msg_bienvenu']."', presentation = '".$_POST['presentation']."' WHERE id_membre = $id_auteur");
			$baratin .= "MODIFICATION APPLIED!";
		}
	
	if(isset($_POST['request']))
		{
			$new = rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
			$verification = mysql_fetch_array(mysql_query("SELECT mail, hash FROM membre_general WHERE mail = '".$_POST['request']."'"));
			if(isset($verification['mail']))
				{
					$to = $_POST['mail'];
					$subject = $langage[110];
					$message = $langage[111];
					$message .= "\n\n".$langage[4]." : ".$new;
					$message .= "\n\n http://".$domain."/script.php?reponse=597a21c45f41r2z5s47245ensjd4&amp;hash=".$verification['hash']."&amp;password=".$new;
					$message .= $langage[112]."\n\n";
					$message .= $configuration[0];
					$admin = mysql_fetch_array(mysql_query("SELECT mail FROM membre_general WHERE id_membre = 0"));
					$from = "From: ".$admin['mail'];
					mail($to, $subject, $message, $from);
				}
			$link = "http://".$domain."/index.php";
		}
		
	if(isset($_GET['reponse']) && $_GET['reponse'] = "597a21c45f41r2z5s47245ensjd4")
		{
			$hash_precedent = $_GET['hash'];
			$password = $_GET['password'];
		}
	
	if(isset($_GET['favvid']))
		{
			$actual_favorite = mysql_query("SELECT id_video FROM membre_favoris WHERE id_membre = '$id_auteur' && id_video = '".$_GET['id_video']."'") or die(mysql_error());
			$actual_favorite = mysql_fetch_array($actual_favorite);
			if(!(isset($actual_favorite['id_video'])))
				{
					mysql_query("INSERT INTO membre_favoris VALUES('$id_auteur', '".$_GET['id_video']."', '')") or die(mysql_error());
					$baratin .= "Favorite added!";
				}
			else
				$baratin .= "Already favorite!";
			$_blank = true;
		}
		
	mysql_close();
?>
<!--"KALEIDOSCOPE" by Pentacle Technologie 2009-2010-->
<!--HTML/CSS/SQL/PHP/JS by BRILLANTE Jason Damdoshi - Norme du Chaos-->
<!--Thanks to MONPIERRE LISA about her help for JScript-->
<!--Thanks to Liberty Rock Studio htt://libertyrockstudio.com for being the company host-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="eng">
	<head>
		<title>Request device</title>
		<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252" />
		<meta http-equiv="refresh" content="5; url=<?php echo $link; ?>" />
		<script type="javascript">
			function close()
				{
					setTimeout(window.close, 3000);
				}

		</script>
		<style>
			a, p, b
			{
				color: #000000;
			}
		</style>
	</head>
	<?php
				if($_blank)
					{
			?>
	<body bgcolor="#FFFFFF" background="skin/background.png" style="background-repeat: repeat-y; margin: 0px; padding: 5px;" onload="close()">
			<?php
					}
				else
					{
			?>
	<body bgcolor="#FFFFFF" background="skin/background.png" style="background-repeat: repeat-y; margin: 0px; padding: 5px;">
			<?php
					}
			?>
		<img src="skin/logo.png" alt="Logo" />
		<div style="width: 100%; height: 100%; text-align: left; vertical-align: center; padding-left: 50px; padding-top: 10px;">
			<p><?php echo $baratin."<br />"; ?></p>
			<p><?php echo $file_error; ?></p>
			<br /><br /><br />
			<?php
				if($_blank)
					{
			?>
			<b onload="close()" style="text-align: center;">This page will be close soon.</b>
			<?php
					}
				else
					{
			?>
			<b style="text-align: center;">You will be redirected soon.</b>
			<?php
					}
			?>
		</div>
	</body>
</html>