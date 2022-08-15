<?php
if(isset($testeur) && $testeur == "lobo951")
	{
	include("log.php");
	mysql_connect($db_adr, $db_login, $db_password) or die(mysql_error());
	mysql_select_db($db_name) or die(mysql_error());
	
	/*	Structure du site: 
	**	NEWS (SUR LE SITE, EN VIDEO)
	**	LISTE DE VIDEO
	**	VIDEO
	**	PAGE_PERSO
	**	CONFIGURATION PERSONELLE
	*/
	
	date_default_timezone_set('Europe/Gibraltar');
	
	if($login != "")
		{ //SI LE FICHIER EST INCLUDE DANS UNE REPONSE DE FORMULAIRE
			$membre_information = mysql_query("SELECT * FROM membre_general WHERE login = ".strtolower($cookie_login));
			
		}
	else
		{ //SI ON EST SUR UNE PAGE DU SITE
			$membre_information = mysql_query(
"SELECT membre_general.*, admin_hierarchie.niveau 
FROM membre_general, admin_hierarchie  
WHERE membre_general.login = '$cookie_login' 
&& membre_general.hash = '$cookie_hash'
&& membre_general.id_membre = admin_hierarchie.id_membre
") or die(mysql_error());
			$membre_information_array = mysql_fetch_array($membre_information);
			if(isset($membre_information_array['login_original']))
				$connexion = true;
			else
				$connexion = false;
			
			if($connexion)
				{
					$id_membre = $membre_information_array['id_membre'];
					$login_original = $membre_information_array['login_original'];
					$inscription = $membre_information_array['inscription'];
					$nom = $membre_information_array['nom'];
					$prenom = $membre_information_array['prenom'];
					$mail = $membre_information_array['mail'];
					$naissance = $membre_information_array['naissance'];
					$avatar = $membre_information_array['avatar'];
					$signature = $membre_information_array['signature'];
					$admin = $membre_information_array['niveau'];
				}
			else
				$id_membre = 1;
		}
	
	if(isset($_GET['camarade']))
		$id_camarade = $_GET['camarade'];
	else
		$id_camarade = $id_membre;
	
	$j = 0;
	$admin_configuration = mysql_query("SELECT configuration FROM admin_configuration") or die(mysql_error());
	while($admin_configuration_array = mysql_fetch_array($admin_configuration))
		{
			$configuration[$j] = $admin_configuration_array['configuration'];
			$j++;
		}
	
	$j = 0;
	$langage_source = mysql_query("SELECT ".$langage_code." FROM langue_source") or die(mysql_error());
	while($langage_source_array = mysql_fetch_array($langage_source))
		{
			$langage[$j] = $langage_source_array[$langage_code];
			$j++;
		}
	
	$j = 0;
	$langage_condition = mysql_query("SELECT ".$langage_code." FROM langue_condition") or die(mysql_error());
	while($langage_condition_array = mysql_fetch_array($langage_condition))
		{
			$condition[$j] = $langage_condition_array[$langage_code];
			$j++;
		}
	
	$langage_index = mysql_query("SELECT code, nom FROM langue_index");
	
	$admin_news = mysql_query(
"SELECT admin_news.*,  membre_general.login_original, membre_general.avatar
FROM admin_news, membre_general 
WHERE membre_general.id_membre = admin_news.id_membre 
ORDER BY admin_news.id_news DESC");

	$admin_news_limit = mysql_query(
"SELECT admin_news.*,  membre_general.login_original
FROM admin_news, membre_general 
WHERE membre_general.id_membre = admin_news.id_membre 
ORDER BY admin_news.id_news DESC LIMIT 0, 1") or die(mysql_error());
	
	$pub_rand = rand(1, $configuration[2]);
	$admin_global = mysql_query(
"SELECT code
FROM admin_publicite
WHERE id_pub = $pub_rand
&& categorie = 'global'") or die(mysql_error());

	$admin_news = mysql_query(
"SELECT code
FROM admin_publicite
WHERE id_pub = $pub_rand
&& categorie = 'news'") or die(mysql_error());

	$tube_general_latest = mysql_query(
"SELECT tube_general.id_video, tube_general.id_auteur, tube_general.titre, tube_general.date, membre_general.login_original, membre_general.id_membre
FROM tube_general, membre_general
WHERE tube_general.id_auteur = membre_general.id_membre
&& tube_general.censure = 'F'
ORDER BY id_video DESC
LIMIT 0, 8") or die(mysql_error());
	
	$last_30_day = time() - (30*24*60*60); //TEMPS - 30J * 24H * 60M * 60S
	$tube_general_month = mysql_query(
"SELECT tube_general.id_video, tube_general.titre, tube_general.date, membre_general.login_original, membre_general.id_membre, tube_general.id_auteur
FROM tube_general, membre_general
WHERE tube_general.id_auteur = membre_general.id_membre
&& tube_general.censure = 'F'
&& tube_general.date > '$last_30_day'
ORDER BY visite DESC
LIMIT 0, 8") or die(mysql_error());

	$tube_general = mysql_query(
"SELECT tube_general.id_video, tube_general.titre, tube_general.description, tube_general.date, tube_general.visite, tube_general.censure,
		membre_general.login_original, tube_general.sel, membre_general.id_membre, membre_general.avatar, tube_general.sel, tube_general.id_auteur
FROM tube_general, tube_keyword, membre_general
WHERE tube_general.id_video = '$tube'
&& tube_general.id_auteur = membre_general.id_membre
") or die(mysql_error());
	
	$tube_commentaire = mysql_query(
"SELECT membre_general.login_original, membre_general.id_membre, tube_commentaire.date, tube_commentaire.message, tube_commentaire.censure, tube_commentaire.id_commentaire
FROM membre_general, tube_commentaire
WHERE membre_general.id_membre = tube_commentaire.id_auteur
&& tube_commentaire.id_video = '$tube'
ORDER BY id_commentaire DESC
") or die(mysql_error());
	
	if($liste == "fav") 
		{
			$tube_general_list = mysql_query(
"SELECT DISTINCT tube_general.id_video, tube_general.titre, tube_general.description, tube_general.date, tube_general.visite,
membre_general.id_membre, membre_general.login_original
FROM membre_general, tube_general, membre_favoris
WHERE membre_favoris.id_membre = membre_general.id_membre 
&& membre_favoris.id_video = tube_general.id_video
&& membre_favoris.id_membre = $id_camarade
ORDER BY tube_general.id_video
LIMIT $limite_basse, $limite_haute") or die(mysql_error());
		}
	elseif($liste == "list")
		{
			$tube_general_list = mysql_query(
"SELECT DISTINCT tube_general.id_video, tube_general.titre, tube_general.description, tube_general.date, tube_general.visite,
membre_general.id_membre, membre_general.login_original
FROM membre_general, tube_general
WHERE tube_general.id_auteur = $id_camarade
&& membre_general.id_membre = tube_general.id_auteur
ORDER BY tube_general.id_video
LIMIT $limite_basse, $limite_haute") or die(mysql_error());
		}
	elseif($id_camarade == $id_membre && $liste == "")
		{
			if (isset($_GET['spec']))
				{
					$rustine = "";
					for($j = 0; $j < $nbr_keyword; $j++)
						$rustine .= "tube_keyword.keyword = '".str_replace(" ", "", $keyword[$j])."' || ";
					$tube_general_list = mysql_query(
"SELECT DISTINCT tube_general.id_video, tube_general.titre, tube_general.date, membre_general.login_original, membre_general.id_membre, tube_general.visite, tube_general.description, tube_note.note
FROM 	tube_general, membre_general, tube_keyword, tube_note
WHERE 	tube_general.id_video = tube_note.id_video
&&		tube_note.id_membre = 1
&&		tube_general.id_video = tube_keyword.id_video
&&		tube_general.id_auteur = membre_general.id_membre
&&		tube_general.censure = 'F' 
&&		tube_keyword.keyword != ''
&& 		(".$rustine." tube_keyword.keyword = '')
ORDER BY tube_general.id_video DESC
LIMIT $limite_basse, $limite_haute
") or die(mysql_error());
				}
			else
				{
					$rustine = "";
					for($j = 0; $j < $nbr_keyword; $j++)
						$rustine .= "tube_keyword.keyword = '".str_replace(" ", "", $keyword[$j])."' || ";
					$tube_general_list = mysql_query(
"SELECT DISTINCT tube_general.id_video, tube_general.titre, tube_general.date, membre_general.login_original, membre_general.id_membre, tube_general.visite, tube_general.description, tube_note.note
FROM 	tube_general, membre_general, tube_keyword, tube_note
WHERE 	tube_general.id_video = tube_note.id_video
&&		tube_note.id_membre = 1
&&		tube_general.id_video = tube_keyword.id_video
&&		tube_general.id_auteur = membre_general.id_membre
&&		tube_general.censure = 'F' 
&&		tube_keyword.keyword != ''
&& 		(".$rustine." tube_keyword.keyword = '')
ORDER BY tube_general.id_video DESC --, MATCH(tube_keyword.keyword) AGAINST ('$complete_keyword') DESC
LIMIT $limite_basse, $limite_haute
") or die(mysql_error());
				}
		}
	
	$j = 0;
	$i = 0;
	$rustine = "";
	$tube_general_keyword = mysql_query("SELECT keyword FROM tube_keyword WHERE id_video = '$tube'");
	while($tube_general_keyword_array = mysql_fetch_array($tube_general_keyword))
		{
			if($j < 3)
				$rustine .= "tube_keyword.keyword = '".$tube_general_keyword_array['keyword']."' || ";
			$j++;
		}
	/*
	$tube_general_similar = mysql_query(
"SELECT DISTINCT tube_general.id_video, tube_general.titre, tube_general.visite, membre_general.login_original, tube_general.description, membre_general.id_membre
FROM 	tube_general, membre_general, tube_keyword
WHERE 	tube_keyword.id_video = tube_general.id_video
&& tube_keyword.keyword != ''
&& (".$rustine."tube_keyword.keyword = '')
&&		tube_general.id_video != '$tube'
&&		tube_general.id_auteur = membre_general.id_membre
&&		tube_general.censure = 'F' 
ORDER BY tube_general.visite --, MATCH(tube_keyword.keyword) AGAINST ('$complete_keyword') DESC
LIMIT 0, 16
") or die(mysql_error());
	*/
	// A RETIRER POUR UNE RECHERCHE RELATIONELLE A PARTIR DE LA VIDEO COURANTE!
	// A RETIRER POUR UNE RECHERCHE RELATIONELLE A PARTIR DE LA VIDEO COURANTE!
	// A RETIRER POUR UNE RECHERCHE RELATIONELLE A PARTIR DE LA VIDEO COURANTE!
	$j = 0;
	$i = 0;
	$rustine = "";
	$tube_general_keyword = mysql_query("SELECT keyword FROM tube_keyword WHERE id_video = '$tube'");
	while($tube_general_keyword_array = mysql_fetch_array($tube_general_keyword))
		{
			if($j < 3)
				$rustine .= "tube_keyword.keyword = '".$tube_general_keyword_array['keyword']."' || ";
			$j++;
		}
	$tube_general_similar = mysql_query(
"SELECT DISTINCT tube_general.id_video, tube_general.titre, tube_general.date, membre_general.login_original, membre_general.id_membre, tube_general.visite, tube_general.description, tube_note.note
FROM 	tube_general, membre_general, tube_keyword, tube_note
WHERE 	tube_general.id_video = tube_note.id_video
&&		tube_note.id_membre = 1
&&		tube_general.id_video = tube_keyword.id_video
&&		tube_general.id_auteur = membre_general.id_membre
&&		tube_general.censure = 'F' 
&&		tube_keyword.keyword != ''
&&		tube_keyword.id_video != ".$tube."
&& 		(".$rustine." tube_keyword.keyword = '')
ORDER BY tube_general.id_video DESC --, MATCH(tube_keyword.keyword) AGAINST ('$complete_keyword') DESC
LIMIT $limite_basse, $limite_haute
") or die(mysql_error());

	if(isset($admin_sondage_array['recherche']) && $admin_sondage_array['recherche'] == $complete_keyword)
		mysql_query("UPDATE demande FROM admin_sondage SET demande = demande + 1 WHERE recherche = '$complete_keyword'");
	else
		{} // mysql_query("INSERT INTO admin_sondage VALUES('$complete_keyword', '1')");
	
	$tube_general_vision_note = mysql_query("SELECT AVG(note) FROM tube_note WHERE id_video = '$tube'");
	$tube_general_vision_note = mysql_fetch_array($tube_general_vision_note);
	$tube_general_vision_note = (float)$tube_general_vision_note['AVG(note)'];
	$tube_general_keyword = mysql_query("SELECT keyword FROM tube_keyword WHERE id_video = '$tube'");

	$perso_general = mysql_query(
"SELECT *
FROM membre_general, membre_page, membre_detail
WHERE membre_general.id_membre = $id_camarade 
&& membre_general.id_membre = membre_page.id_membre 
&& membre_general.id_membre = membre_detail.id_membre
") or die(mysql_error());

	$perso_favoris = mysql_query(
"SELECT tube_general.id_video, tube_general.titre, tube_general.date, 
		membre_general.login_original, membre_general.id_membre, tube_general.visite, 
		tube_general.description, tube_general.id_auteur
FROM membre_favoris, tube_general, membre_general 
WHERE membre_favoris.id_membre = $id_camarade
&& membre_favoris.id_video = tube_general.id_video
&& tube_general.id_auteur = membre_general.id_membre
&& tube_general.censure = 'F'
ORDER BY membre_favoris.id_favoris DESC 
LIMIT 0, 4
") or die(mysql_error());

	$perso_video = mysql_query(
"SELECT tube_general.id_video, tube_general.titre, tube_general.date, tube_general.visite
FROM tube_general
WHERE id_auteur = $id_camarade
");

	$tube_promo = mysql_query(
"SELECT tube_general.id_video, tube_general.titre, tube_general.description, tube_general.visite, tube_general.date, membre_general.login_original, membre_general.id_membre
FROM 	tube_general, tube_promo, membre_general
WHERE 	tube_promo.id_video = tube_general.id_video
&&		tube_general.id_auteur = membre_general.id_membre
&&		tube_general.censure = 'F'
ORDER BY tube_promo.id_video DESC	
") or die(mysql_error());

	$tube_promo_array = mysql_fetch_array($tube_promo);
	$tube_promo_note = mysql_query("SELECT AVG(note) as note FROM tube_note WHERE id_video = '".$tube_promo_array['id_video']."'");
	$tube_promo_note_array = mysql_fetch_array($tube_promo_note);
	$tube_promo_already = mysql_query("SELECT id_video FROM tube_promo WHERE id_video = $tube");
	$tube_promo_already_array = mysql_fetch_array($tube_promo_already);
	
	$test_visiteur = mysql_query("SELECT ip FROM admin_visiteur WHERE ip = '$ip'");
	$test_visiteur_array = mysql_fetch_array($test_visiteur);
	if(isset($test_visiteur_array['ip']))
		{
			mysql_query("UPDATE admin_visiteur SET visite = visite + 1 WHERE ip = '$ip'");
			if($connexion)
				mysql_query("INSERT IGNORE membre_ip VALUES($id_membre, '$ip', '".date("Y-m-d", time())."')");	
		}
	else
		mysql_query("INSERT INTO admin_visiteur VALUES('$ip', ".date("Y-m-d").", 1)");
	
	if($fichier == "tube.php")
		mysql_query("UPDATE tube_general SET visite = visite + 1 WHERE id_video = '$tube'");
	
	//GESTION DES BANS
	
	$ban_visiteur = false;
	$ban_camarade = false;
	$avertissement_visiteur = mysql_query("SELECT explication FROM admin_avertissement WHERE pardon = 'F' && (id_membre = $id_membre || ip = '$ip')") or die(mysql_error());
	$avertissement_visiteur_rows = mysql_num_rows($avertissement_visiteur);
	
	$bannissement_visiteur = mysql_query("SELECT explication FROM admin_avertissement WHERE ban = 'V'") or die(mysql_error());
	$bannissement_visiteur_rows = mysql_num_rows($bannissement_visiteur);
	
	$avertissement_camarade = mysql_query("SELECT * FROM admin_avertissement WHERE pardon = 'F' && id_membre = $id_camarade ") or die(mysql_error());
	$avertissement_camarade_rows = mysql_num_rows($avertissement_camarade);
	
	$bannissement_camarade = mysql_query("SELECT * FROM admin_avertissement WHERE ban = 'V'") or die(mysql_error());
	$bannissement_camarade_rows = mysql_num_rows($bannissement_camarade);
	
	if($avertissement_visiteur_rows > 2 || $bannissement_visiteur_rows > 0)
		$ban_visiteur = true;
		
	if($avertissement_camarade_rows > 2 || $bannissement_camarade_rows > 0)
		$ban_camarade= true;
	
	//MESSAGERIE
	$messagerie_compte = mysql_query(
"SELECT COUNT(lu) as lu FROM membre_messagerie WHERE id_lecteur = $id_membre && lu = 'F' && del_lec = 'F'");
	$messagerie_compte = mysql_fetch_array($messagerie_compte);
	
	$reception = mysql_query(
"SELECT  *
FROM membre_messagerie, membre_general
WHERE membre_messagerie.id_auteur = membre_general.id_membre
&& membre_messagerie.id_lecteur = $id_membre
&& membre_messagerie.del_lec = 'F'
ORDER BY id_message DESC
LIMIT $limite_basse, $limite_haute
") or die(mysql_error());

	$envoye = mysql_query(
"SELECT  *
FROM membre_messagerie, membre_general
WHERE membre_messagerie.id_lecteur = membre_general.id_membre
&& membre_messagerie.id_auteur = $id_membre
&& membre_messagerie.del_aut = 'F'
ORDER BY id_message DESC
LIMIT $limite_basse, $limite_haute
") or die(mysql_error());

	$message = mysql_query(
"SELECT  *
FROM membre_messagerie, membre_general
WHERE membre_messagerie.id_auteur = membre_general.id_membre
&& membre_messagerie.id_message = $id_message
&& (membre_messagerie.id_auteur = $id_membre || membre_messagerie.id_lecteur = $id_membre)
") or die(mysql_error());
	$message_array = mysql_fetch_array($message);
	mysql_query("UPDATE membre_messagerie SET lu = 'V' WHERE id_message = $id_message");

	if($connexion)
		mysql_query("INSERT IGNORE membre_ip VALUES($id_membre, $ip)");

	$bouton_envoyer = mysql_query("SELECT login_original FROM membre_general WHERE id_membre = $lecteur");
	$bouton_envoyer = mysql_fetch_array($bouton_envoyer);
	
	$config_array = mysql_fetch_array(mysql_query(
"SELECT * FROM membre_general, membre_detail, membre_page
WHERE membre_general.id_membre = membre_detail.id_membre
&& membre_general.id_membre = membre_page.id_membre
&& membre_general.id_membre = $id_membre
"));
	$news = mysql_query("SELECT id_news, login_original, titre, date, message FROM admin_news, membre_general WHERE admin_news.id_membre = membre_general.id_membre ORDER BY admin_news.id_news DESC");
	
	$com = mysql_query(
"SELECT date, message, censure, login_original, tube_commentaire.id_auteur as id_membre, id_commentaire, membre_general.avatar
FROM tube_commentaire, membre_general 
WHERE tube_commentaire.id_video = $tube
&& tube_commentaire.id_auteur = membre_general.id_membre
ORDER BY tube_commentaire.id_commentaire DESC
LIMIT $limite_basse, $limite_haute") or die(mysql_error());

	$annonce_index = mysql_query(
"SELECT admin_annonce.*, membre_general.login_original, membre_general.id_membre FROM admin_annonce, membre_general
WHERE admin_annonce.id_membre = membre_general.id_membre && admin_annonce.show = 'V'
ORDER BY admin_annonce.id_annonce DESC 
LIMIT 0, 2
") or die(mysql_error());

	$annonce_complete = mysql_query(
"SELECT admin_annonce.*, membre_general.login_original, membre_general.id_membre FROM admin_annonce, membre_general
WHERE admin_annonce.id_membre = membre_general.id_membre
ORDER BY admin_annonce.id_annonce DESC 
LIMIT $limite_basse, $limite_haute
") or die(mysql_error());

	$categorie = mysql_query(
"SELECT caption, keyword FROM tube_categorie
WHERE 1
ORDER BY id
") or die(mysql_error());

	if ($announce != -1)
		{
			$announce = mysql_query("
				SELECT	message,
						date
				FROM	admin_annonce
				WHERE	id_annonce = ".$announce."
			") or die(mysql_error());
			$announce = mysql_fetch_array($announce);
			$announce['msg'] = $announce['message'];
			$announce['date'] = $announce['date'];
		}

	$actual_favorite = mysql_query("SELECT id_video FROM membre_favoris WHERE id_membre = $id_membre && id_video = $tube") or die(mysql_error());
	$actual_favorite = mysql_fetch_array($actual_favorite);
	if(isset($actual_favorite['id_video']))
		$already_fav = true;
	else
		$already_fav = false;
	
	$rand1 = rand(0, 9).rand(0, 9);
	$rand2 = rand(0, 9).rand(0, 9);
	$rand3 = rand(0, 9).rand(0, 9);
	$rand4 = rand(0, 9).rand(0, 9);
	$rand = $rand1.$rand2.$rand3.$rand4;
	setcookie('code1', $rand1, time() + 365*24*3600);
	setcookie('code2', $rand2, time() + 365*24*3600);
	setcookie('code3', $rand3, time() + 365*24*3600);
	setcookie('code4', $rand4, time() + 365*24*3600);	
	setcookie('code', $rand, time() + 365*24*3600);
	
	mysql_close();
	}
?>