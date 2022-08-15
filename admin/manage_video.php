<?php
	if(isset($testeur) && $testeur == "lobo951")
		{
			mysql_connect($db_adr, $db_login, $db_password) or die(mysql_error());
			mysql_select_db($db_name) or die(mysql_error());
			if (isset($_GET['edit']) && isset($_GET['censored']))
				{
					if ($_GET['censored'] == 'F')
						mysql_query("
							UPDATE	tube_general
							SET		censure = 'V'
							WHERE	id_video = ".$_GET['edit']."
						") or die(mysql_error());
					else
						mysql_query("
							UPDATE	tube_general
							SET		censure = 'F'
							WHERE	id_video = ".$_GET['edit']."
						") or die(mysql_error());
				}
			if (isset($_POST['sort']))
				$order = $_POST['sort'];
			else
				$order = "titre";
			$search = "1";
			if (isset($_POST['name']) && $_POST['name'] != "")
				$search = "tube_general.titre LIKE '%".$_POST['name']."%'";
			$video_query = mysql_query("
				SELECT		*
				FROM		tube_general LEFT OUTER JOIN membre_general
							ON tube_general.id_auteur = membre_general.id_membre
				WHERE		".$search." && 1
				ORDER BY	censure DESC, ".$order."
			") or die(mysql_error());
			mysql_close();
?>
<table style="width: 100%;"><tr><td class="entete">
	<table style="width: 100%;"><tr><td>
		Perform a research in the database:
	</td></tr><tr><td class="boite" style="width: 50%;">
		<form action="index.php?page=2" method="post">
			<table style="height: 100%; width: 100%;"><tr><td class="entete" style="width: 25%;">
				<table style="height: 100%; width: 100%;"><tr><td style="vertical-align: top; width: 50%;">
					Sort entries:
				</td><td class="boite" style="height: 100%; width: 100%">
					<input type="radio" name="sort" value="titre" />Name<br />
					<input type="radio" name="sort" value="login" />Author<br />
					<input type="radio" name="sort" value="date" />Date
				</td></tr></table>
			</td><td class="boite" style="width: 50%;">
				<table style="height: 100%; width: 100%;"><tr><td class="boite" style="padding-left: 10px; text-align: center;">
					<label for="login" style="width: 30%;">Enter a name:</label><br />
					<input type="text" id="login" name="name" style="width: 30%;" />&nbsp;&nbsp;&nbsp;
					<input type="submit" value="Research" style="width: 20%;"/>
				</td></tr></table>
			</td></tr></table>
		</form>
	</td></tr></table>
</td></tr><tr><td>
	<table style="width: 100%;"><tr><td class="entete">
		Name
	</td><td class="entete">
		Author
	</td><td class="entete">
		Date
	</td><td class="entete">
		Window
	</td><td class="entete">
		(Un)Censored
	</td><td class="entete">
		Delete
	</td></tr>
	<?php
		while ($video = mysql_fetch_array($video_query))
			{
	?>
	<tr><td class="boite">
		<a href="../index.php?fichier=tube.php&amp;tube=<?php echo $video['id_video']; ?>">
			<?php echo $video['titre']; ?>
		</a>
	</td><td class="boite">
		<a href="../index.php?fichier=perso.php&amp;camarade=<?php echo $video['id_membre']; ?>">
			<?php echo $video['login_original']; ?>
		</a>
	</td><td class="boite">
		<?php echo $video['date']; ?>
	</td><td class="boite">
		<a href="../index.php?fichier=tube.php&amp;tube=<?php echo $video['id_video']; ?>">
			<img src="../upload_img/mini_<?php echo $video['id_video']; ?>.jpg" alt="Video" />
		</a>
	</td><td class="boite">
		<a href="index.php?page=2&amp;edit=<?php echo $video['id_video']; ?>&amp;censored=<?php echo $video['censure']; ?>">
			<?php
				if ($video['censure'] == "F")
					echo "Uncensored";
				else
					echo "Censored";
			?>
		</a>
	</td><td class="boite">
		<a onclick="confirme('index.php?page=1&amp;delete=<?php echo $video['id_video']; ?>')">
			Delete
		</a>
	</td></tr>
	<?php
			}
	?>
	</table>
	<?php
			}
		else
			echo "Forbidden";
	?>
</td></tr></table>