<?php
	$testeur = "lobo951";
	include("log.php");
	include("fonctions.php");
	mysql_connect($db_adr, $db_login, $db_password) or die(mysql_error());
	mysql_select_db($db_name) or die(mysql_error());
	date_default_timezone_set('Europe/Gibraltar');
	
	if (isset($_POST['edit_news']))
		{
			mysql_query("
				UPDATE		admin_news
				SET			titre = '".mysql_real_escape_string($_POST['titre'])."',
							message = '".mysql_real_escape_string($_POST['message'])."'
				WHERE		id_news = '".$_POST['edit_news']."'
			") or die(mysql_error());
		}
	if (isset($_GET['delete_news']))
		{
			mysql_query("
				DELETE FROM	admin_news
				WHERE		id_news = '".$_GET['delete_news']."'
			") or die(mysql_error());
		}
	
	if (isset($_POST['edit_annonce']))
		{
			mysql_query("
				UPDATE		admin_annonce
				SET			message = '".mysql_real_escape_string($_POST['message'])."'
				WHERE		id_annonce = '".$_POST['edit_annonce']."'
			") or die(mysql_error());
		}
	if (isset($_GET['delete_annonce']))
		{
			mysql_query("
				DELETE FROM	admin_annonce
				WHERE		id_annonce = '".$_GET['delete_annonce']."'
			") or die(mysql_error());
		}
	
	mysql_close();
?>
<html>
	<body onLoad="javascript:window.close();">
		Cette page va être fermée.
	</body>
</html>