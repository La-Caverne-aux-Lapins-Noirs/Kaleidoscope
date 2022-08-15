<?php
if(isset($testeur) && $testeur == "lobo951")
	{
?>
<table class="contenu" style="width: 100%; height: 100%; padding: 0px;">
	<tr>
		<td class="chapitre" colspan="2" style="height: 0%;">
			<span class="h2"><?php echo $langage[93]; ?></span>
		</td>
	</tr>
	<tr> <?php //0: Reception, 1: Envoi, 2: Envoyer un message, 3: Lire un message ?>
		<td class="contenu" style="padding-left: 10px; width: 150px; vertical-align: top; height: 100%; font-size: small;" rowspan="2">
			<br />
			<a href="index.php?fichier=perso.php&amp;section=perso_messagerie.php&amp;boite=2" class="h2">
				<?php echo $langage[87]; ?>
			</a><br /><br />
			<a href="index.php?fichier=perso.php&amp;section=perso_messagerie.php&amp;boite=0" class="h2">
				<?php echo $langage[85]; ?>
			</a><br />
			<a href="index.php?fichier=perso.php&amp;section=perso_messagerie.php&amp;boite=1" class="h2">
				<?php echo $langage[86]; ?>
			</a>
			<br /><br /><br />
		</td>
		<td class="boite" style="padding-left: 20px; padding-right: 40px; vertical-align: top; height: 100%;">
			<br />
			<?php
				$j = 0;
				switch($boite)
					{
						case 0: //RECEPTION
							while($reception_array = mysql_fetch_array($reception))
								{
									$j++;
									if($reception_array['lu'] == 'F')
										{
			?>
			<b><a href="index.php?fichier=perso.php&amp;section=perso_messagerie.php&amp;boite=3&amp;message=<?php echo $reception_array['id_message']; ?>"><?php echo $reception_array['titre']; ?></a></b>
			<?php
										}
									else
										{
			?>
			<span><a href="index.php?fichier=perso.php&amp;section=perso_messagerie.php&amp;boite=3&amp;message=<?php echo $reception_array['id_message']; ?>"><?php echo $reception_array['titre']; ?></a></span>
			<?php
										}
			?>
			<br />
			<span style="width: 100px;"><?php echo $reception_array['date']; ?></span>
			<span style="width: 100px;"><?php echo $langage[11]; ?>&nbsp;<a href="index.php?fichier=perso.php&amp;camarade=<?php echo $reception_array['id_auteur']; ?>"><?php echo $reception_array['login_original']; ?></a></span>
			<a href="script.php?suppression=true&amp;message=<?php echo $reception_array['id_message']; ?>&amp;boite=0"><?php echo $langage[101]; ?></a>
			<br /><br />
			<?php
								}
							if($j == 0)
								echo "<i>".$langage[96]."</i>";
							echo "</td></tr>";
							echo "<tr><td style=\"height: 0%; text-align: right;\">";
							if($page > 0)
								echo "<a href=\"index.php?fichier=perso.php&amp;section=perso_messagerie.php&amp;boite=0&amp;page=".($page - 1)."\">".$langage[22]."</a>";
							echo "&nbsp; &nbsp; ".$langage[24]." ".$page." &nbsp; &nbsp;";
							echo "<a href=\"index.php?fichier=perso.php&amp;section=perso_messagerie.php&amp;boite=0&amp;page=".($page + 1)."\">".$langage[23]."</a>";
							echo "</td></tr>";
							break;
						case 1: //ENVOYE
							while($envoye_array = mysql_fetch_array($envoye))
								{
									$j++;
			?>
			<span><a href="index.php?fichier=perso.php&amp;section=perso_messagerie.php&amp;boite=3&amp;message=<?php echo $envoye_array['id_message']; ?>"><?php echo $envoye_array['titre']; ?></a></span>
			<br />
			<span style="width: 100px;"><?php echo $envoye_array['date']; ?></span>
			<span style="width: 100px;"><?php echo $langage[129]; ?>&nbsp;<a href="index.php?fichier=perso.php&amp;camarade=<?php echo $envoye_array['id_auteur']; ?>"><?php echo $envoye_array['login_original']; ?></a></span>
			<a href="script.php?suppression=true&amp;message=<?php echo $envoye_array['id_message']; ?>&amp;boite=0"><?php echo $langage[101]; ?></a>
			<br /><br />
			<?php
								}
							if($j == 0)
								echo "<i>".$langage[96]."</i>";
							echo "</td></tr>";
							echo "<tr><td style=\"height: 0%; text-align: right;\">";
							if($page > 0)
								echo "<a href=\"index.php?fichier=perso.php&amp;section=perso_messagerie.php&amp;boite=1&amp;page=".($page - 1)."\">".$langage[22]."</a>";
							echo "&nbsp; &nbsp; ".$langage[24]." ".$page." &nbsp; &nbsp;";
							echo "<a href=\"index.php?fichier=perso.php&amp;section=perso_messagerie.php&amp;boite=1&amp;page=".($page + 1)."\">".$langage[23]."</a>";
							echo "</td></tr>";
							break;
						case 2: //ENVOYER UN MESSAGE
			?>
			<form method="post" action="script.php">
				<input type="hidden" class="envoyer" name="envoyer" value="true" />
				<input type="hidden" class="link" name="link" value="http://<?php echo $domain."/index.php?fichier=perso.php&amp;section=perso_messagerie.php&amp;boite=1"; ?>" />
				<input type="hidden" class="id_auteur" name="id_auteur" value="<?php echo $id_membre; ?>" />
				<p>
					<label for="login_lecteur" style="width: 150px;"><?php echo $langage[94]; ?></label>
					<input type="text" name="login_lecteur" style="width: 150px;" maxlength="16" value="<?php echo $bouton_envoyer['login_original']; ?>" /><br />
					<label for="titre" style="width: 150px;"><?php echo $langage[95]; ?></label>
					<input type="text" name="titre" style="width: 300px;" maxlength="64" /><br /><br />
					<textarea name="message" cols="80" rows="10" style="width: 100%;"></textarea><br />
				</p>
				<p style="text-align: right">
					<input type="submit" value="<?php echo $langage[34]; ?>" />
				</p>
			</form>
		</td>
	</tr>
	<tr>
		<td style="height: 0%;">
		</td>
	</tr>
			<?php
							break;
						case 3: //LIRE UN MESSAGE
			?>
			<p><b><?php echo "\"".$message_array['titre']."\" ".$langage[11]." ".$message_array['login_original'].", ".$message_array['date']; ?></b></p>
			<p><?php echo $message_array['message']; ?></p>
			<p style="text-align: right;">
				<a href="index.php?fichier=perso.php&amp;lecteur=<?php echo $message_array['id_auteur']; ?>&amp;section=perso_messagerie.php&amp;boite=2">
					<?php echo $langage[91]." ".$perso_general_array['login_original']; ?>
				</a>
			</p>
		</td>
	</tr>
	<tr>
		<td style="height: 0%;">
		</td>
	</tr>
			<?php
							break;
					}
			?>
	<tr><td></td></tr>
</table>
<?php
	}
?>