<?php
	$testeur = "lobo951";
	include("../log.php");
	mysql_connect($db_adr, $db_login, $db_password) or die(mysql_error());
	mysql_select_db($db_name) or die(mysql_error());
	
	if(isset($_COOKIE['login']))
		$cookie_login = $_COOKIE['login'];
	else
		$cookie_login = "";

	if(isset($_COOKIE['hash']))
		$cookie_hash = $_COOKIE['hash'];
	else
		$cookie_hash = hash("sha256", rand(-128, 127), false);
	
	$check = mysql_query("
		SELECT membre_general.*, admin_hierarchie.niveau 
		FROM membre_general, admin_hierarchie  
		WHERE membre_general.login = '$cookie_login' 
		&& membre_general.hash = '$cookie_hash'
		&& membre_general.id_membre = admin_hierarchie.id_membre
	") or die(mysql_error());
	
	$membre_information_array = mysql_fetch_array($check);
	if(isset($membre_information_array['login_original']))
		$connexion = true;
	else
		$connexion = false;
			
	if($connexion)
		{
			$id_membre = $membre_information_array['id_membre'];
			$login_original = $membre_information_array['login_original'];
			$mail = $membre_information_array['mail'];
			$admin = $membre_information_array['niveau'];
		}
	else
		$id_membre = 1;
	
	$j = 0;
	$admin_configuration = mysql_query("
		SELECT		configuration
		FROM		admin_configuration
	") or die(mysql_error());
	while($admin_configuration_array = mysql_fetch_array($admin_configuration))
		{
			$configuration[$j] = $admin_configuration_array['configuration'];
			$j++;
		}
	mysql_close();
	if (!isset($admin))
		$admin = 0;
	if ($admin > 1)
		{
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<title><?php echo $configuration[0]; ?>: Secteur d'administration</title>
		<link 	rel="stylesheet" 
			media="screen" 
			type="text/css" 
			title="Design" 
			href= "../<?php echo $configuration[4]; ?>" 
		/>
		<script language="javascript">
			<!--
				function confirme (adr)
					{
						if (confirm('Please, confirm'))
							{
								document.location = adr;
							}
					}
			//-->
		</script>
	</head>
	<body style="background-color: black; height: 100%;">
		<table style="width: 100%; height: 100%;"><tr><td style="height: 0%; text-align: center;"><!-- EN-TETE MENU-->
			<h2 style="color: white; padding-top: 10px;">Administrator's panel</h2>
			<table style="width: 100%;"><tr><td class="entete" style="text-align: center;">
				<a href="index.php">Home</a>
				<table style="width: 100%; height: 0%;"><tr><td class="boite" style="text-align: center; font-size: x-small;">
					Statistics
				</td></tr></table>
			</td><td class="entete" style="text-align: center;">
				<a href="index.php?page=1">Manage members</a>
				<table style="width: 100%; height: 0%;"><tr><td class="boite" style="text-align: center; font-size: x-small;">
					Edit profile, delete members, etc.
				</td></tr></table>
			</td><td class="entete" style="text-align: center;">
				<a href="index.php?page=2">Manage video</a>
				<table style="width: 100%; height: 0%;"><tr><td class="boite" style="text-align: center; font-size: x-small;">
					Edit video, delete video, hide video, etc.
				</td></tr></table>
			</td><td class="entete" style="text-align: center;">
				<a href="index.php?page=3">Post on website</a>
				<table style="width: 100%; height: 0%;"><tr><td class="boite" style="text-align: center; font-size: x-small;">
					Send a news, an announce, a newsletter, etc.
				</td></tr></table>
			</td><td class="entete" style="text-align: center;">
				<a href="../">
					Exit
				</a>
			</td></tr></table>
		</td></tr><tr><td class="boite" style="text-align: center; vertical-align: top; height: 100%;"><!--CONTENU-->
			<table style="height: 100%; width: 100%;"><tr><td style="text-align: center; vertical-align: top;">
				<?php
					if (isset($_GET['page']))
						if ($_GET['page'] == 1)
							include ("manage_member.php");
						else if ($_GET['page'] == 2)
							include ("manage_video.php");
						else if ($_GET['page'] == 3)
							include ("send_message.php");
						else
							include ("home.php");
					else
						include ("home.php");
				?>
			</td></tr></table>
		</td></tr><tr><td class="entete" style="height: 0%;"><!--PIED DE PAGE-->
			<p style="text-align: center; vertical-align: center; font-size: x-small;">
				"Kaleidoscope": Powered by Pentacle Technologie 2009-2011<br />
				<a href="mailto:damdoshi@pentacle-technologie.net">
					damdoshi@pentacle-technologie.net
				</a>
				&nbsp;
				<a href="http://pentacle-technologie.net">
					http://pentacle-technologie.net
				</a>
			</p>
		</td></tr></table>
	</body>
</html>
<?php
		}
?>