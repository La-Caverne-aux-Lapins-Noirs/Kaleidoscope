<?php
	if(isset($testeur) && $testeur == "lobo951")
		{
			mysql_connect($db_adr, $db_login, $db_password) or die(mysql_error());
			mysql_select_db($db_name) or die(mysql_error());
			$request = "";
			$order = "";
			if (isset($_POST['check_admin']))
				{
					$request .= " admin_hierarchie.niveau > 0 && ";
					$order = "admin_hierarchie.niveau, ";
				}
			if (isset($_POST['banned']))
				$request .= " membre_general.banned = 1 && ";
			if (isset($_POST['sort']))
				$order = $_POST['sort'];
			else
				$order .= "login";
			if (isset($_POST['logins']) && $_POST['logins'] != "")
				$research = "membre_general.login LIKE '%".$_POST['logins']."%'";
			else
				$research = " 1 ";
			if (isset($_GET['edit']) && isset($_GET['level']))
				{
					if ($_GET['level'] == 1)
						{
							mysql_query("
								UPDATE		admin_hierarchie
								SET			niveau = 0
								WHERE		id_membre = ".$_GET['edit']."
							") or die(mysql_error());
						}
					else
						{
							mysql_query("
								UPDATE		admin_hierarchie
								SET			niveau = 1
								WHERE		id_membre = ".$_GET['edit']."
							") or die(mysql_error());
						}
				}
			if (isset($_GET['delete']))
				{
					mysql_query("
						DELETE FROM		membre_general
						WHERE			id_membre = '".$_GET["delete"]."'
					") or die(mysql_error());
				}
			$member_query = mysql_query("
				SELECT		membre_general.*,
							niveau
				FROM		membre_general LEFT OUTER JOIN admin_hierarchie
							ON membre_general.id_membre = admin_hierarchie.id_membre
				WHERE		".$request."
							".$research."
				ORDER BY	".$order." ASC
			") or die(mysql_error());
			mysql_close();
?>
<table style="width: 100%;"><tr><td class="entete">
	<table style="height: 100%; width: 100%;"><tr><td>
		Perform a research in the database:
	</td></tr><tr><td class="boite" style="height: 0px;">
		<form action="index.php?page=1" method="post">
			<table style="height: 100%; width: 100%;"><tr><td class="entete" style="width: 25%;">
				<table style="height: 100%; width: 100%;"><tr><td style="vertical-align: top; width: 50%;">
					Add filters:
				</td><td class="boite" style="height: 100%; width: 100%">
					<input type="checkbox" name="check_admin" style="width: 20px;" />Moderator<br />
					<input type="checkbox" name="banned" style="width: 20px;" />Banned
				</td></tr></table>
			</td><td class="entete" style="width: 25%;">
				<table style="height: 100%; width: 100%;"><tr><td style="vertical-align: top; width: 50%;">
					Sort entries:
				</td><td class="boite" style="height: 100%; width: 100%">
					<input type="radio" name="sort" value="login" style="width: 20px;" />Login<br />
					<input type="radio" name="sort" value="mail" style="width: 20px;" />Mail<br />
					<input type="radio" name="sort" value="id_membre" style="width: 20px;" />Date
				</td></tr></table>
			</td><td class="boite" style="width: 50%;">
				<table style="height: 100%; width: 100%;"><tr><td class="boite" style="padding-left: 10px; text-align: center;">
					<label for="login" style="width: 30%;">Enter a login:</label><br />
					<input type="text" id="login" name="logins" style="width: 30%;" />&nbsp;&nbsp;&nbsp;
					<input type="submit" value="Research" style="width: 20%;"/>
				</td></tr></table>
			</td></tr></table>
		</form>
	</td></tr></table>
</td></tr><tr><td>
	<table style="width: 100%;"><tr><td class="entete">
		Login
	</td><td class="entete">
		Email
	</td><td class="entete">
		Registration
	</td><td class="entete">
		Level
	</td><td class="entete">
		Edit
	</td><td class="entete">
		Delete
	</td></tr>
	<?php
		while ($member = mysql_fetch_array($member_query))
			{
				if ($member['login_original'] != "")
					{
						if ($member['niveau'] == "")
							$member['niveau'] = 0;
	?>
	<tr><td class="boite">
		<a href="../index.php?fichier=perso.php&amp;camarade=<?php echo $member['id_membre']; ?>" style="color: black;">
			<?php echo $member['login_original']; ?>
		</a>
	</td><td class="boite">
		<a href="mailto:<?php echo $member['email']; ?>" style="color: black;">
			<?php echo $member['mail']; ?>
		</a>
	</td><td class="boite" style="text-align: center;">
		<?php echo $member['inscription']; ?>
	</td><td class="boite" style="text-align: center;">
		<?php echo $member['niveau']; ?>
	</td><td class="boite" style="text-align: center;">
		<?php
			if ($member['niveau'] < 2)
				{
		?>
					&nbsp;&nbsp;
					<a href="index.php?page=1&amp;edit=<?php echo $member['id_membre']; ?>&amp;level=<?php echo $member['niveau']; ?>" style="color: blue;">
						Change level
					</a>
		<?php
				}
			else
				echo "&nbsp;";
		?>
	</td><td class="boite" style="text-align: center;">
		<?php
			if ($member['niveau'] < 2)
				{
		?>
		<a onclick="confirme('index.php?page=1&amp;delete=<?php echo $member['id_membre']; ?>')" style="color: red;">
			Delete
		</a>
		<?php
				}
			else
				echo "&nbsp;";
		?>
	</td></tr>
	<?php
					}
			}
	?>
	</table>
	<?php
			}
		else
			echo "Forbidden";
	?>
</td></tr></table>