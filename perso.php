<?php
if(isset($testeur) && $testeur == "lobo951")
	{
	$perso_general_array = mysql_fetch_array($perso_general);
?>
<table class="article" style="width: 100%; height: 100%;">
	<tr> <!--TITRE-->
		<td colspan="2" class="chapitre">
			<span class="h2"><?php echo $langage[59].$perso_general_array['login_original'].$langage[60]; ?></span>
		</td>
	</tr>
	<tr>
		<td style="width: 300px; height: 0%; padding-right: 5px; vertical-align: top;">
			<table style="width: 100%; height: 0%;">
				<?php
					if($id_camarade == $id_membre)
						{
				?>
				<tr>
					<td class="entete" style="width: 100%; height: 0%; padding: 0px; text-align: center;">
						<b class="h2"><?php echo $langage[61]; ?></b>
						<table class="boite" style="width: 100%; height: 0%;"><tr><td style="padding-left: 10px;">
							<br />
							<a href="index.php?fichier=perso.php&amp;section=perso_messagerie.php">
							<?php
								if($messagerie_compte['lu'] == 0)
									echo $langage[57];
								else
									echo $langage[58]." : ".$messagerie_compte['lu'];
							?>
							</a><br /><br />
							<a href="index.php?fichier=perso.php&amp;section=perso_messagerie.php&amp;boite=2">
								<?php echo $langage[92]; ?>
							</a><br />
							<a href="index.php?fichier=perso.php&amp;section=perso_messagerie.php">
								<?php echo $langage[61]; ?>
							</a>
							<br /><br />
						</td></tr></table>
					</td>
				</tr>
				<?php
						}
				?>
				<tr>
					<td class="entete" style="width: 300px; height: 0%; padding: 0px; vertical-align: top;">
						<b class="h2"><?php echo $langage[62]; ?></b>
						<table class="boite" style="width: 100%; height: 0%; text-align: left;"><tr><td style="padding-left: 10px; vertical-align: top; font-size: x-small;">
							<p>	<br />
								<?php echo "<b>".$langage[63]."</b> : ".$perso_general_array['nom']; ?><br /> 
								<?php echo "<b>".$langage[64]."</b> : ".$perso_general_array['prenom']; ?><br /> 
								<?php 
									$date = explode("-", $perso_general_array['naissance']);
									echo "<b>".$langage[65]."</b> : ".$date[2]."-".$date[1]."-".$date[0]; 
								?><br />
								<?php echo "<b>".$langage[66]."</b> : <a href=\"mailto:".$perso_general_array['mail']."\">".$perso_general_array['mail']."</a>"; ?><br /> 
								<?php echo "<b>".$langage[76]."</b> : <a href=\"".$perso_general_array['site']."\">".$perso_general_array['site']."</a>"; ?><br /> 
								<?php echo "<b>".$langage[67]."</b> : ".$perso_general_array['msn']; ?><br /> 
								<?php echo "<b>".$langage[68]."</b> : ".$perso_general_array['residence']; ?><br /> 
								<?php echo "<b>".$langage[70]."</b> : ".$perso_general_array['film']; ?><br /> 
								<?php echo "<b>".$langage[69]."</b> : ".$perso_general_array['interet']; ?><br /> 
								<!--
								<?php echo "<b>".$langage[71]."</b> : ".$perso_general_array['groupe']; ?><br /> 
								<?php echo "<b>".$langage[72]."</b> : ".$perso_general_array['musique']; ?><br /> 
								<?php echo "<b>".$langage[73]."</b> : ".$perso_general_array['artiste']; ?><br /> 
								<?php echo "<b>".$langage[74]."</b> : ".$perso_general_array['genre']; ?><br /> 
								<?php echo "<b>".$langage[75]."</b> : ".$perso_general_array['citation']; ?><br /--> 
								<br />
							</p>
						</td></tr></table>
					</td>
				</tr>
				<?php
					if($id_camarade == $id_membre)
						{
				?>
				<tr>
					<td class="entete" style="width: 100%; height: 0%; padding: 0px;">
						<b class="h2"><?php echo $langage[77]; ?></b>
						<table class="boite" style="width: 100%; height: 0%; text-align: left;"><tr><td style="padding-left: 10px;">
							<br />
							<a href="index.php?fichier=perso.php&amp;section=perso_configuration.php&amp;cible=compte"><?php echo $langage[78]; ?></a><br />
							<a href="index.php?fichier=perso.php&amp;section=perso_configuration.php&amp;cible=apparence"><?php echo $langage[79]; ?></a><br /><br />
							<a href="index.php?fichier=perso.php&amp;section=perso_configuration.php&amp;cible=detail"><?php echo $langage[80]; ?></a>
							<br /><br />
						</td></tr></table>
					</td>
				</tr>
				<tr>
					<td style="height: 100%;">
						<br />
					</td>
				</tr>
				<?php
						}
				?>
			</table>
		</td>
		<td style="height: 0%; background-repeat: repeat-y; margin: 0px; padding: 0px; padding-right: 5px; background-image: url(skin/background.png); vertical-align: top;">
			<?php
				include($section);
			?>
		</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
</table>
<?php
	}
?>