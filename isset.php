<?php
if(isset($testeur) && $testeur == "lobo951")
	{
//DECLARATION/RECUPERATION DE VARIABLES D'INFORMATION GENERALE
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
	
	$url = $domain.$link;
	
	if(isset($_SERVER['HTTP_REFERER']))
		$historique = $_SERVER['HTTP_REFERER'];
	else
		$historique = $url;

//DECLARATION/RECUPERATION DES VARIABLES DE POSITIONNEMENT
	if(isset($_GET['fichier']))
		$fichier = $_GET['fichier'];
	else
		$fichier = "";
	
	if(($fichier != "configuration.php") 	&& ($fichier != "list.php") 
											&& ($fichier != "perso.php") 
											&& ($fichier != "tube.php") 
											&& ($fichier != "inscription.php")
											&& ($fichier != "upload.php")
											&& ($fichier != "perso.php")
											&& ($fichier != "messagerie.php")
											&& ($fichier != "forgot.php")
											&& ($fichier != "news_complete.php")
											&& ($fichier != "comment_complete.php")
											&& ($fichier != "annonce_complete.php")
											&& ($fichier != "announce.php"))
		$fichier = "news.php";
	
	if(isset($_GET['page']))
		$page = $_GET['page'];
	else
		$page = 0;
	
	if(isset($_GET['announce']))
		$announce = $_GET['announce'];
	else
		$announce = -1;
	
	$limite_basse = $page * 20;
	$limite_haute = $page * 20 + 20;

	$nbr_keyword = 0;
	$complete_keyword = "";
	if(isset($_GET['keyword']))
		{
			$complete_keyword = strtolower($_GET['keyword']);
			if($complete_keyword == "")
				$fichier = "news.php";
			$keyword = explode(" ", $_GET['keyword'], 10);
			$nbr_keyword = count($keyword);
		}
	else
		$keyword = "";
	
	if(isset($_GET['tube']))
		$tube = $_GET['tube'];
	else
		$tube = 0;
		
	if(isset($_GET['cible']))
		$cible = $_GET['cible'];
	else
		$cible = "compte";
	
	if($cible > 2)
		$cible = 0;
	
	if(isset($_GET['section']))
		$section = $_GET['section'];
	else
		$section = "perso_presentation.php";
	
	if(($section != "perso_presentation.php") 	&& ($section != "perso_configuration.php")
												&& ($section != "perso_messagerie.php"))
		$section = "perso_presentation.php";
	
	if(isset($_GET['boite']))
		$boite = $_GET['boite'];
	else
		$boite = "0"; //0: Reception, 1: Envoi, 2: Envoyer un message, 3: Lire un message
	if($boite > 3)
		$boite = 0;
	
	if(isset($_GET['lecteur']))
		$lecteur = $_GET['lecteur'];
	else
		$lecteur = 1;
	
	if(isset($_GET['message']))
		$id_message = $_GET['message'];
	else
		$id_message = 0;
	
	if(isset($_GET['liste']))
		$liste = $_GET['liste'];
	else
		$liste = "";
	
	if(isset($_GET['edit']))
		$edit = $_GET['edit'];
	else
		$edit = -1;

	if(isset($_GET['delete']))
		$delete = $_GET['delete'];
	else
		$delete = -1;
	
	$admin = 0;

//DECLARATION/RECUPERATION DES VARIABLES DE MODIFICATION
	if(isset($_GET['modification']))
		$modification = $_GET['modification'];
	else
		$modification = 0;

	if(isset($_GET['id_change']))
		$id_change = $_GET['id_change'];
	else
		$id_change = 0;

//DECLARATION/RECUPERATION DES VARIABLES DE FORMULAIRE
	if(isset($_POST['fichier']))
		$fichier = $_POST['fichier'];
	
	if(isset($_POST['login']))
		$login = $_POST['login'];
	else
		$login = "";
	
	if(isset($_POST['password']))
		$password = $_POST['password'];
	else
		$password = "";

	if(isset($_POST['code_bot']))
		$code_bot = $_POST['code_bot'];
	else
		$code_bot = "X";

	if(isset($_POST['code_bot_copie']))
		$code_bot_copie = $_POST['code_bot_copie'];
	else
		$code_bot_copie = "";

	if(isset($_POST['keyword']))
		{
			$complete_keyword = $_POST['keyword'];
			if($complete_keyword == "")
				$fichier = "news.php";
			$keyword = explode(" ", $_POST['keyword'], 10);
			$nbr_keyword = count($keyword);
			for($j = 0; $j < $nbr_keyword; $j++)
				$keyword[$j] = strtolower($keyword[$j]);
		}
	
	//A suivre...
	
//DECLARATION/RECUPERATION DES VARIABLES DE COOKIE
	if(isset($_COOKIE['login']))
		$cookie_login = $_COOKIE['login'];
	else
		$cookie_login = "";

	if(isset($_COOKIE['hash']))
		$cookie_hash = $_COOKIE['hash'];
	else
		$cookie_hash = hash("sha256", rand(-128, 127), false);

	if(isset($_COOKIE['language']))
		$langage_code = $_COOKIE['language'];
	else
		$langage_code = "eng";
	}
	
	$offset = "";
?>