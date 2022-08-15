<?php
if(file_exists("../log.php"))
{
	$testeur = "lobo951";
	include("../log.php");
	mysql_connect($db_adr, $db_login, $db_password) or die(mysql_error());
	mysql_select_db($db_name) or die(mysql_error());
	
	date_default_timezone_set('Europe/Gibraltar');
	
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
	
	if ($admin > 1)
		{
			if (isset($_POST['moderate']))
				{
					if ($level)
						mysql_query("
							UPDATE	admin_hierarchie
							SET		niveau = 0
							WHERE	id_membre = '".$_POST['moderate']."'
						") or die(mysql_error());
					else
						mysql_query("
							UPDATE	admin_hierarchie
							SET		niveau = 1
							WHERE	id_membre = '".$_POST['moderate']."'
						") or die(mysql_error());
				}
			if (isset($_POST['news']))
				{
					$desc = strip_tags(addslashes($_POST['desc']), "<a>");
					$desc = str_replace("\n", "<br />", $desc);
					mysql_query("
						INSERT INTO	admin_news
						VALUES		(
							'',
							'$id_membre',
							'".date("Y-m-d", time())."',
							'".$_POST['titre']."',
							'$desc'
									)
					") or die(mysql_error());
				}
			if (isset($_POST['annonce']))
				{
					$desc = strip_tags(addslashes($_POST['desc']), "<a>");
					$desc = str_replace("\n", "<br />", $desc);
					mysql_query("
						INSERT INTO	admin_annonce
						VALUES		(
							'',
							'$id_membre',
							'".date("Y-m-d", time())."',
							'$desc'
									)
					") or die(mysql_error());
				}
			if (isset($_POST['uncensored']))
				{
					mysql_query("
						UPDATE		tube_general
						SET			censure = 'F'
						WHERE		id_video = '".$_POST['uncensored']."'
					") or die(mysql_error());
				}
			$list_request = mysql_query("
				SELECT		*
				FROM		membre_general, admin_hierarchie
				WHERE		niveau < 2 &&
							membre_general.id_membre = admin_hierarchie.id_membre
			") or die(mysql_error());
			$unactivated_query = mysql_query("
				SELECT		*
				FROM		tube_general
				WHERE		censure = 'V'
			") or die(mysql_query());
			?>
			<html>
				<head>
					<title>
						Administration de Kaleidoscope
					</title>
					<style>
						table
							{
								width: 100%;
								height: 100%;
							}
						td
							{
								text-align: center;
								vertical-align: center;
								border-color: black;
								border-style: outset;
								border-size: 5px;
							}
						input
							{
								width: 100%;
							}
						textarea
							{
								width: 100%;
								height: 100%;
							}
					</style>
				</head>
				<body>
					<table style="width: 100%; height: 100%;">
						<tr>
							<td colspan="2"><h2>Panneau d'administration</h2></td>
						</td>
						<tr>
							<td style="width: 50%; height: 50%;">
								<p>Changer le status d'un membre:</p>
								<div style="overflow: auto;">
					<?php
						while ($list_array = mysql_fetch_array($list_request))
							{
								if ($list_array['login'] != "")
									{
					?>	
						<form action="index.php" method="post">
							<p>
								<label><?php echo $list_array['login']; ?> : </label>
								<input type="hidden" name="moderate" value="<?php echo $list_array['id_membre']; ?>" />
								<input type="submit" value="Changer" />
								Status : <?php
									if ($list_array['niveau'] == 0)
										echo "Utilisateur<input name=\"level\" type=\"hidden\" value=\"0\" />";
									else
										echo "Moderateur<input name=\"level\" type=\"hidden\" value=\"1\" />";
								?>
								<br />
								</div>
						</form>
					<?php
									}
							}
					?>
							</td>
							<td>
								<p>Lancer une news:</p>
								<form action="index.php" method="post">
									<p>
										<input type="hidden" name="news" />
										<input type="text" name="titre" /><br />
										<textarea cols="20" rows="10" name="desc"></textarea><br />
										<input type="submit" />
									</p>
								</form>
							</td>
						</tr>
						<tr>
							<td>
								<p>Lancer une annonce:</p>
								<form action="index.php" method="post">
									<p>
										<input type="hidden" name="annonce" />
										<textarea cols="20" rows="10" name="desc"></textarea><br />
										<input type="submit" />
									</p>
								</form>
							</td>
							<td>
								<p>Activer/Retirer la censure d'une video</p>
								<?php
									while ($unactivated = mysql_fetch_array($unactivated_query))
										{
								?>
								<form action="index.php" method="post">
									<p>
										<input type="hidden" name="uncensored" value="<?php echo $unactivated['id_video']; ?>" />
										<label>
											<a href="../index.php?fichier=tube.php&tube=<?php echo $unactivated['id_video']; ?>">
												<?php echo $unactivated['titre']; ?>
											</a>
										</label>
										<input type="submit" value="Activate" />
									</p>
								</form>
								<?php
										}
								?>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<a href="../">Revenir</a>
							</td>
						</tr>
					</table>
				</body>
			</html>
			<?php
		}
	else
		echo "Interdit.";
	mysql_close();
}
?>