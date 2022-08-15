<?php
	$testeur = "lobo951";
	include("../log.php");
	mysql_connect($db_adr, $db_login, $db_password) or die(mysql_error());
	mysql_select_db($db_name) or die(mysql_error());
	
	if (isset($_POST['newsletter']))
		{
			$mail_list_query = mysql_query("
				SELECT		mail
				FROM		member
				WHERE		newsletter = 1
			") or die (mysql_error());
			while ($mail_list = mysql_fetch_array($mail_list_query))
				mail($mail_list['mail'], "HipHop World Tube: Newsletter", $_POST['newsletter'], "From: <admin@hiphopworldtube.com>\n");
		}
	if (isset($_POST['news']))
		{
			mysql_query("
				INSERT INTO		admin_news
				VALUES	(		'',
								".$id_membre.",
								".date("Y-m-d").",
								".$_POST['titre'].",
								".$_POST['txt']."
				)
			") or die(mysql_error());
		}
	if (isset($_POST['annonce']))
		{
			if (isset($_POST['show']))
				$truc = "V";
			else
				$truc = "F";
			mysql_query("
				INSERT INTO		admin_news
				VALUES	(		'',
								".$id_membre.",
								".date("Y-m-d").",
								".$_POST['txt'].",
								".$truc."
				)
			") or die(mysql_error());
		}
	if (isset($_POST['pub']))
		{
			mysql_query("
				UPDATE		admin_publicite
				SET			code = '".$_POST['txt1']."'
				WHERE		categorie = 'global'
			") or die(mysql_error());
			mysql_query("
				UPDATE		admin_publicite
				SET			code = '".$_POST['txt2']."'
				WHERE		categorie = 'news'
			") or die(mysql_error());
		}
	mysql_close();
?>
<html>
	<head>
		<meta http-equiv="refresh" content="0; url=index.php?page=3" />
	</head>
</html>