<?php
if(isset($testeur) && $testeur == "lobo951")
	{
?>
<table class="contenu" style="width: 100%; height: 100%; padding: 0px; margin: 0px;">
	<tr>
		<td style="width: 0%; height: 0%; padding-left: 20px; padding-right: 20px;">
			<img alt="Avatar" src="<?php echo $perso_general_array['avatar']; ?>" />
		</td>
		<td style="vertical-align: top; width: 100%; padding-right: 20px;">
			<p style="text-align: right; font-size: small;">
				<?php
					if(($id_camarade != $id_membre) && $connexion)
						{
				?>
				<a href="index.php?fichier=perso.php&amp;lecteur=<?php echo $id_camarade; ?>&amp;section=perso_messagerie.php&amp;boite=2">
					<?php echo $langage[88]." ".$perso_general_array['login_original']; ?>
				</a>
				<?php
						}
				?>
			</p>
			<br />
			<p style="font-size: small;">
				<?php echo $perso_general_array['msg_bienvenu']; ?>
			</p>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="height: 0%; width: 100%; padding-left: 20px; padding-right: 20px; font-size: small;">
			<?php echo $perso_general_array['presentation']; ?>
			<br /><br />
			- - - - - - -<br />
			<?php echo $perso_general_array['signature']; ?>
				<br />
				<br />
				<br />
		</td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 10px; padding-right: 10px;">
			<span class="h1"><?php echo $langage[82]; ?></span>
			<table style="width: 100%; height: 100%;">
	<?php
		$j = 0;
		while($membre_video_array = mysql_fetch_array($perso_video))
			{
				if($j == 0)
					{
	?>
				<tr>
					<td style="width: 50%; height: 0%; text-align: center; vertical-align: center;">
						<a href="<?php echo "index.php?fichier=tube.php&amp;tube=".$membre_video_array['id_video']; ?>">
							<img class="thumb" src="<?php echo "upload_img/mini_".$membre_video_array['id_video'].".jpg"; ?>" /><br />
							<?php echo $membre_video_array['titre']; ?><br />
						</a>
						<?php echo $membre_video_array['date']; ?> 
					</td>
	<?php
						$j = 1;
					}
				else
					{
	?>
					<td style="width: 50%; height: 0%; text-align: center; vertical-align: center;">
						<a href="<?php echo "index.php?fichier=tube.php&amp;tube=".$membre_video_array['id_video']; ?>">
							<img class="thumb" src="<?php echo "upload_img/mini_".$membre_video_array['id_video'].".jpg"; ?>" /><br />
							<?php echo $membre_video_array['titre']; ?><br />
						</a>
						<?php echo $membre_video_array['date']; ?> 
					</td>
				</tr>
	<?php
						$j = 0;
					}
			}
		if($j == 1)
			echo "<td></td></tr>";
	?>
				<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="vertical-align: center; text-align: center; height: 0%; width: 100%; padding: 10px;">
			<a href="index.php?fichier=list.php&amp;camarade=<?php echo $id_camarade; ?>&amp;liste=list"><?php echo $langage[84]; ?></a>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="padding-left: 10px; padding-right: 10px;">
			<span class="h1"><?php echo $langage[83]; ?></span>
			<table style="width: 100%; height: 100%;">
	<?php
		$j = 0;
		while($membre_favoris_array = mysql_fetch_array($perso_favoris))
			{
				if($j == 0)
					{
	?>
				<tr>
					<td style="width: 50%; height: 0%; text-align: center; vertical-align: center;">
						<a href="<?php echo "index.php?fichier=tube.php&amp;tube=".$membre_favoris_array['id_video']; ?>">
							<img class="thumb" src="<?php echo "upload_img/mini_".$membre_favoris_array['id_video'].".jpg"; ?>" /><br />
							<?php echo $membre_favoris_array['titre']; ?><br />
							</a>
						<?php echo $membre_favoris_array['date']; ?> 
						&nbsp; &nbsp; &nbsp; &nbsp;
						<?php echo $langage[11]." <a href=\"index.php?fichier=perso.php&amp;camarade=".$membre_favoris_array['id_auteur']."\">".$membre_favoris_array['login_original']."</a>"; ?>
					</td>
	<?php
						$j = 1;
					}
				else
					{
	?>
					<td style="width: 50%; height: 0%; text-align: center; vertical-align: center;">
						<a href="<?php echo "index.php?fichier=tube.php&amp;tube=".$membre_favoris_array['id_video']; ?>">
							<img class="thumb" src="<?php echo "upload_img/mini_".$membre_favoris_array['id_video'].".jpg"; ?>" /><br />
							<?php echo $membre_favoris_array['titre']; ?><br />
						</a>
						<?php echo $membre_favoris_array['date']; ?> 
						&nbsp; &nbsp; &nbsp; &nbsp;
						<?php echo $langage[11]." <a href=\"index.php?fichier=perso.php&amp;camarade=".$membre_favoris_array['id_auteur']."\">".$membre_favoris_array['login_original']."</a>"; ?>
					</td>
				</tr>
	<?php
						$j = 0;
					}
			}
		if($j == 1)
			echo "<td></td></tr>";
	?>
				<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="vertical-align: center; text-align: center; height: 0%; width: 100%; padding: 10px;">
			<a href="index.php?fichier=list.php&amp;camarade=<?php echo $id_camarade; ?>&amp;liste=fav"><?php echo $langage[81]; ?></a>
		</td>
	</tr>
	<tr><td colspan="2" style="height: 100%;"></td></tr>
</table>
<?php
	}
?>