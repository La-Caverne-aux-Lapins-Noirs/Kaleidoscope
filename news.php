<?php
if(isset($testeur) && $testeur == "lobo951")
	{
?>
<table class="article" style="width: 100%; height: 100%;">
	<!--tr> <!--TITRE-|->
		<td class="chapitre">
			<span class="h2"><?php echo $langage[13]; ?></span>
		</td>
	</tr-->
	<tr>
		<td class="chapitre">
			<span class="h2"><?php echo $langage[14]." : "; ?></span>
		</td>
	</tr>
	<tr> <!--DERNIERES VIDEOS EN LIGNE-->
		<td style="height: 50%;">
			<table style="width: 100%; height: 100%">
				<?php
					$j = 0;
					while($tube_general_latest_array = mysql_fetch_array($tube_general_latest))
						{
							switch($j)
								{
									case 0: //DEBUT
				?>
				<tr>
					<td style="text-align: left; width: 25%; vertical-align: top;">
						<table><tr><td style="background-color: black; width: 150px; height:150px; text-align: center; vertical-align: center;">
							<a href="<?php echo "index.php?fichier=tube.php&amp;tube=".$tube_general_latest_array['id_video']; ?>">
								<img class="thumb" src="<?php echo "upload_img/mini_".$tube_general_latest_array['id_video'].".jpg"; ?>" />	
							</a>
						</td></tr></table>
						<a class="petit" href="<?php echo "index.php?fichier=tube.php&amp;tube=".$tube_general_latest_array['id_video']; ?>">
							<?php echo $tube_general_latest_array['titre']; ?><br />
						</a>
						<span class="petit">
						<?php 
							$date = explode("-", $tube_general_latest_array['date']);
							echo $langage[20]." ".$date[2]."-".$date[1]."-".$date[0]; 
						?>
						<br />
						</span>
						<?php echo $langage[11]." <a class=\"petit\" href=\"index.php?fichier=perso.php&amp;camarade=".$tube_general_latest_array['id_auteur']."\">".$tube_general_latest_array['login_original']."</a>"; ?>
					</td>
				<?php
										$j++;
										break;
									case 3: //FIN
				?>
					<td style="text-align: left; width: 25%; vertical-align: top;">
						<table><tr><td style="background-color: black; width: 150px; height:150px; text-align: center; vertical-align: center;">
							<a href="<?php echo "index.php?fichier=tube.php&amp;tube=".$tube_general_latest_array['id_video']; ?>">
								<img class="thumb" src="<?php echo "upload_img/mini_".$tube_general_latest_array['id_video'].".jpg"; ?>" />	
							</a>
						</td></tr></table>
						<a class="petit" href="<?php echo "index.php?fichier=tube.php&amp;tube=".$tube_general_latest_array['id_video']; ?>">
							<?php echo $tube_general_latest_array['titre']; ?><br />
						</a>
						<span class="petit">
						<?php 
							$date = explode("-", $tube_general_latest_array['date']);
							echo $langage[20]." ".$date[2]."-".$date[1]."-".$date[0]; 
						?>
						<br />
						</span>
						<?php echo $langage[11]." <a class=\"petit\" href=\"index.php?fichier=perso.php&amp;camarade=".$tube_general_latest_array['id_auteur']."\">".$tube_general_latest_array['login_original']."</a>"; ?>
					</td>
				</tr>
				<?php
										$j = 0;
										break;
									default: //ENTRE
				?>
					<td style="text-align: left; width: 25%; vertical-align: top;">
						<table><tr><td style="background-color: black; width: 150px; height:150px; text-align: center; vertical-align: center;">
							<a href="<?php echo "index.php?fichier=tube.php&amp;tube=".$tube_general_latest_array['id_video']; ?>">
								<img class="thumb" src="<?php echo "upload_img/mini_".$tube_general_latest_array['id_video'].".jpg"; ?>" />	
							</a>
						</td></tr></table>
						<a class="petit" href="<?php echo "index.php?fichier=tube.php&amp;tube=".$tube_general_latest_array['id_video']; ?>">
							<?php echo $tube_general_latest_array['titre']; ?><br />
						</a>
						<span class="petit">
						<?php 
							$date = explode("-", $tube_general_latest_array['date']);
							echo $langage[20]." ".$date[2]."-".$date[1]."-".$date[0]; 
						?>
						<br />
						</span>
						<?php echo $langage[11]." <a class=\"petit\" href=\"index.php?fichier=perso.php&amp;camarade=".$tube_general_latest_array['id_auteur']."\">".$tube_general_latest_array['login_original']."</a>"; ?>
					</td>
				<?php
										$j++;
										break;
								}
						}
					switch($j)
						{
							case 0:
								echo "<tr><td></td><td></td><td></td><td></td></tr>";
								break;
							case 1:
								echo "<td></td><td></td><td></td></tr>";
								break;
							case 2:
								echo "<td></td><td></td></tr>";
								break;
							case 3:
								echo "<td></td></tr>";
								break;
						}
				?>
			</table>
		</td>
	</tr>
	<tr><td><br /></td></tr>
	<tr>
		<td class="chapitre">
			<span class="h2"><?php echo $langage[15]." : "; ?></span>
		</td>
	</tr>
	<tr> <!--TOP VIDEO DU MOIS-->
		<td style="height: 50%;">
			<table style="width: 100%; height: 100%">
				<?php
					$j = 0;
					while($tube_general_month_array = mysql_fetch_array($tube_general_month))
						{
							switch($j)
								{
									case 0:
				?>
				<tr>
					<td style="text-align: left; width: 25%;">
						<table><tr><td style="background-color: black; width: 150px; height:150px; text-align: center; vertical-align: center;">
							<a href="<?php echo "index.php?fichier=tube.php&amp;tube=".$tube_general_month_array['id_video']; ?>">
								<img class="thumb" src="<?php echo "upload_img/mini_".$tube_general_month_array['id_video'].".jpg"; ?>" />
							</a>
						</td></tr></table>
						<a class="petit" href="<?php echo "index.php?fichier=tube.php&amp;tube=".$tube_general_month_array['id_video']; ?>">
							<?php echo $tube_general_month_array['titre']; ?><br />
						</a>
						<span class="petit">
						<?php 
							$date = explode("-", $tube_general_month_array['date']);
							echo $langage[20]." ".$date[2]."-".$date[1]."-".$date[0]; 
						?>
						<br />
						</span>
						<?php echo $langage[11]." <a class=\"petit\" href=\"index.php?fichier=perso.php&amp;camarade=".$tube_general_month_array['id_auteur']."\">".$tube_general_month_array['login_original']."</a>"; ?>
					</td>
				<?php
										$j++;
										break;
									default:
				?>
					<td style="text-align: left; width: 25%;">
						<table><tr><td style="background-color: black; width: 150px; height:150px; text-align: center; vertical-align: center;">
							<a href="<?php echo "index.php?fichier=tube.php&amp;tube=".$tube_general_month_array['id_video']; ?>">
								<img class="thumb" src="<?php echo "upload_img/mini_".$tube_general_month_array['id_video'].".jpg"; ?>" />
							</a>
						</td></tr></table>
						<a class="petit" href="<?php echo "index.php?fichier=tube.php&amp;tube=".$tube_general_month_array['id_video']; ?>">
							<?php echo $tube_general_month_array['titre']; ?><br />
						</a>
						<span class="petit">
						<?php 
							$date = explode("-", $tube_general_month_array['date']);
							echo $langage[20]." ".$date[2]."-".$date[1]."-".$date[0]; 
						?>
						<br />
						</span>
						<?php echo $langage[11]." <a class=\"petit\" href=\"index.php?fichier=perso.php&amp;camarade=".$tube_general_month_array['id_auteur']."\">".$tube_general_month_array['login_original']."</a>"; ?>
					</td>
				<?php
										$j++;
										break;
									case 3:
				?>
					<td style="text-align: left; width: 25%;">
						<table><tr><td style="background-color: black; width: 150px; height:150px; text-align: center; vertical-align: center;">
							<a href="<?php echo "index.php?fichier=tube.php&amp;tube=".$tube_general_month_array['id_video']; ?>">
								<img class="thumb" src="<?php echo "upload_img/mini_".$tube_general_month_array['id_video'].".jpg"; ?>" />
							</a>
						</td></tr></table>
						<a class="petit" href="<?php echo "index.php?fichier=tube.php&amp;tube=".$tube_general_month_array['id_video']; ?>">
							<?php echo $tube_general_month_array['titre']; ?><br />
						</a>
						<span class="petit">
						<?php 
							$date = explode("-", $tube_general_month_array['date']);
							echo $langage[20]." ".$date[2]."-".$date[1]."-".$date[0]; 
						?>
						<br />
						</span>
						<?php echo $langage[11]." <a class=\"petit\" href=\"index.php?fichier=perso.php&amp;camarade=".$tube_general_month_array['id_auteur']."\">".$tube_general_month_array['login_original']."</a>"; ?>
					</td>
				</tr>
				<?php
										$j = 0;
										break;
								}
						}
					switch($j)
						{
							case 0:
								echo "<tr><td></td><td></td><td></td><td></td></tr>";
								break;
							case 1:
								echo "<td></td><td></td><td></td></tr>";
								break;
							case 2:
								echo "<td></td><td></td></tr>";
								break;
							case 3:
								echo "<td></td></tr>";
								break;
						}
				?>
			</table>
		</td>
	</tr>
	<?php
		if(isset($tube_promo_array['id_video']))
			{
	?>
	<tr><td><br /></td></tr>
	<tr>
		<td class="chapitre">
			<span class="h2"><?php echo $langage[118]." : "; ?></span>
		</td>
	</tr>
	<tr> <!--PUB-->
		<td style="text-align: center; vertical-align: top; height: 0%;">
			<table style="width: 100%; height: 100%;">
				<tr>
					<td rowspan="3" style="width: 0%; height: 0%; vertical-align: top; text-align: left;">
						<a href="index.php?fichier=tube.php&amp;tube=<?php echo $tube_promo_array['id_video']; ?>">
							<img src="upload_img/big_<?php echo $tube_promo_array['id_video']; ?>.jpg" alt="Thumb" />
						</a>
					</td>
					<td style="padding-left: 20px; padding-right: 20px;">
						<a href="index.php?fichier=tube.php&amp;tube=<?php echo $tube_promo_array['id_video']; ?>">
							<span class="h1"><?php echo $tube_promo_array['titre']; ?></span>
						</a>
						<p class="petit" style="text-align: justify;">
							<?php echo substr($tube_promo_array['description'], 0, 512)."..."; ?>
						</p>
					</td>
				</tr>
				<tr>
					<td style="padding-left: 20px; padding-right: 40px;">
						<?php echo $langage[11]." <a href=\"index.php?fichier=perso.php&amp;camarade=".$tube_promo_array['id_membre']."\">".$tube_promo_array['login_original']."</a>"; ?><br />
						<?php echo $langage[27]." : ".(float)$tube_promo_note_array['note']." / 20"; ?><br />
						<?php echo $tube_promo_array['visite']." ".$langage[25]; ?><br />
						<?php 
							$date = explode("-", $tube_promo_array['date']);
							echo $langage[20]." ".$date[2]."-".$date[1]."-".$date[0]; 
						?>
						<br />
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: right; padding-right: 40px; vertical-align: center; height: 0px;">
						<a class="h1" href="index.php?fichier=tube.php&amp;tube=<?php echo $tube_promo_array['id_video']; ?>">
							<?php echo $langage[26]; ?>
						</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php
			}
	?>
</table>
<?php
	}
?>