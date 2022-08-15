<?php
if(isset($testeur) && $testeur == "lobo951")
	{
?>
<script type="javascript">
	<!--
		//function fullwin()
		//	{
		//		window.open("tube_full.php", "", "fullscreen");
		//	}
	//-->
</script>
<?php
	$tube_general_vision = mysql_fetch_array($tube_general);
	
	//CONTROLE D'UPLOAD CORRECT DE FICHIER
	if(file_exists("upload_vid/".hash("sha256", $tube_general_vision['id_video'].$tube_general_vision['sel'], false).".flv"))
		{
			if(filesize("upload_vid/".hash("sha256", $tube_general_vision['id_video'].$tube_general_vision['sel']).".flv") > 1024)
				$ready = true;
			else
				$ready = false;
		}
	else
		{
			$ready = false;
		}
	if($ban_visiteur || $tube_general_vision['censure'] == 'V')
		{
			$ready = false;
		}
	if ($admin)
		$ready = true;
?>
<table class="article" style="width: 100%; height: 100%;">
	<tr> <!--TITRE-->
		<td class="chapitre" id="titre" colspan="2" style="height: 0%;">
			<span class="h2">&nbsp;<?php echo $tube_general_vision['titre']; ?></span>
		</td>
	</tr>
	<tr> <!--VIDEO-->
		<td class="contenu" style="width: 100%; height: 0%; vertical-align: top;" colspan="2">
			<?php
				if($ready)
					{
						$is_onsite = 0;
						include("player.php");
						$is_onsite = 1;
			?>
		</td>
	</tr>
	<tr>
		<td class="chapitre" colspan="2" style="height: 0%;">
			<span class="h2"><?php echo $langage[36]; ?></span>
		</td>
	</tr>
	<tr> <!--PRESENTATION DE LA VIDEO-->
		<td class="contenu" style="width: 100%; height: 0%; vertical-align: top;" colspan="2">
			<table style="width: 100%;">
				<tr>
					<td style="padding-left: 30px;">
						<!--NOTE VIDEO-->
						<?php 
							echo $langage[27]." : ".$tube_general_vision_note."<br />";
							if(!(isset($tube_general_vision['note'])))
								{
						?>
						<form method="post" target="_blank" action="script.php" style="display: inline;">
							<input type="hidden" class="link" name="link" value="<?php echo $url."fichier=".$fichier."&amp;tube=".$tube; ?>" />
							<input type="hidden" class="id_video" name="id_video" value="<?php echo $tube_general_vision['id_video']; ?>" />
							<input type="hidden" id="id_auteur" name="id_auteur" value="<?php echo $id_membre; ?>" />
							<select name="note" id="note" style="width: 40px;">
								<?php
									for($j = 0; $j <= 20; $j++)
										{
								?>
								<option value="<?php echo $j; ?>">
									<?php echo $j; ?>
								</option>
								<?php
										}
								?>
							</select>
							<input type="submit" value="Ok" style="width: 40px;" />
						</form>
						<?php
								}
						?>
					</td>
					<td style="text-align: right; padding-right: 30px;"><!--FAVORIS-->
						<?php
							if($already_fav)
								{
									echo $langage[119];
								}
							else
								{
									if($tube_general_vision['id_auteur'] != $id_membre)
										{
						?>
						<a target="_blank" href="script.php?id_membre=<?php echo $id_membre; ?>&amp;id_video=<?php echo $tube_general_vision['id_video']; ?>&amp;favvid=true"><?php echo $langage[120]; ?></a>
						<?php 
										}
								}
						?>
						<br />
						<a target="_blank" href="script.php?id_video=<?php echo $tube_general_vision['id_video']; ?>&amp;reportvid=true"><?php echo $langage[48]; ?></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td><br /></td></tr>
	<tr>
		<td  style="width: 50%; vertical-align: top; height: 300px;">
			<table style="width: 100%; height: 100%;">
				<tr> <!--TITRE-->
					<td class="chapitre">
						<span class="h2"><?php echo $langage[28]; ?></span>
					</td>
				</tr>
				<tr>
					<td class="boite" style="height: 300px; width: 100%;">
						<div style="width: 100%; height: 100%; overflow: auto;">
<?php
	$j = 0;
	while(($tube_commentaire_array = mysql_fetch_array($tube_commentaire)) && ($j < 5))
		{
			if($tube_commentaire_array['censure'] == 'F')
				{
?>		
						<table style="width: 100%; height: 0%;">
							<tr>
								<td style="height: 0%;">
									&nbsp;<b>
									<?php
										echo "<a href=\"index.php?fichier=perso.php&amp;camarade=".$tube_commentaire_array['id_membre']."\">".$tube_commentaire_array['login_original']."</a>";
									?></b>
								</td>
								<td style="text-align: right;">
									&nbsp;
									<?php 
										$date = explode("-", $tube_commentaire_array['date']);
										echo $langage[20]." ".$date[2]."-".$date[1]."-".$date[0]; 
									?>
								</td>
							</tr>
							<tr>
								<td colspan="2" style="height: 0%; text-align: right;">
									<a target="_blank" href="script.php?id_video=<?php echo $tube_commentaire_array['id_commentaire']; ?>&amp;reportcom=true"><?php echo $langage[49]; ?></a>
								</td>
							</tr>
							<tr>
								<td colspan="2" style="height: 0%; font-size: x-small;">
									&nbsp;
									<?php
										echo $tube_commentaire_array['message'];
									?>
									<br /><br />
								</td>
							</tr>
							<?php
								if($admin > 0)
									{
							?>
							<tr>
								<td colspan="2" style="text-align: right; height: 0%;">
									<form method="post" action="script.php?censure_com=true" style="display: inline;">
										<input type="hidden" class="link" name="link" value="http://<?php echo $url."?fichier=".$fichier."&amp;tube=".$tube; ?>" />
										<input type="hidden" class="id_commentaire" name="id_commentaire" value="<?php echo $tube_commentaire_array['id_commentaire']; ?>" />
										<input type="submit" value="<?php echo $langage[124]; ?>" style="width: 100%;" />
									</form>
								</td>
							</tr>
						
						<?php
									}
						?>
						</table>
						<?php
							}
						else
							{
						?>
						<table style="width: 100%; height: 0%;">
							<?php
								if($admin == 0)
									{
							?>
							<tr>
								<td colspan="2">
									---------------------------<br />
									<?php echo $langage[29]; ?><br />
									---------------------------
								</td>
							</tr>
							<?php
								}
							else
								{
							?>
							<tr>
								<td style="height: 0%;">
									&nbsp;<i>
									<?php
										echo "<a href=\"index.php?fichier=perso.php&amp;camarade=".$tube_commentaire_array['id_membre']."\">".$tube_commentaire_array['login_original']."</a>";
									?></i>
								</td>
								<td style="text-align: right;">
									&nbsp;<i>
									<?php 
										$date = explode("-", $tube_commentaire_array['date']);
										echo $langage[20]." ".$date[2]."-".$date[1]."-".$date[0]; 
									?></i>
								</td>
							</tr>
							<tr>
								<td colspan="2" style="height: 0%;">
									&nbsp;
									<br />
									<?php
										echo "<i>".$tube_commentaire_array['message']."</i>";
									?>
									<br />
								</td>
							</tr>
							<!--tr>
								<td colspan="2" style="text-align: right; height: 0%;">
									<form method="post" action="script.php" style="display: inline;">
										<input type="hidden" class="link" name="link" value="<?php echo $url."fichier=".$fichier."&amp;tube=".$tube; ?>" />
										<input type="hidden" name="position" value="edition_commentaire" /
										<input type="hidden" id="id_comment" name="id_comment" value="<?php $tube_commentaire_array['id_commentaire']; ?>" />
										<input type="submit" value="EDIT" style="width: 100%;" />
									</form>
								</td>
							</tr-->
			<?php
								}
			?>
						</table>
			<?php
							}
						$j++;
		}
			?>
						</div>
					</td>
				</tr>
				<tr>
					<td class="contenu" style="vertical-align: bottom; height: 100%;">
						&nbsp;<a href="index.php?fichier=comment_complete.php&amp;tube=<?php echo $tube_general_vision['id_video']; ?>"><?php echo $langage[30]; ?></a>
					</td>
				</tr>
			</table>
		</td>
		<td style="width: 50%; height: 300px;"> <!--VIDEO SIMILAiRE-->
			<table style="height: 100%; width: 100%;">
				<tr>
					<td class="chapitre">
						<span class="h2"><?php echo $langage[31]; ?></span>
					</td>
				</tr>
				<tr>
					<td class="contenu" style="height: 300px; width: 100%;">
						<div style="width: 100%; height: 320px; overflow: auto;">
							<?php
								while($tube_general_similar_array = mysql_fetch_array($tube_general_similar))
									{
							?>
								<table><tr><td style="font-size: x-small;">
									<div style="float: left;">
										<a href="<?php echo "index.php?fichier=tube.php&amp;tube=".$tube_general_similar_array['id_video']."#titre"; ?>">
											<img alt="Thumb" src="upload_img/mini_<?php echo $tube_general_similar_array['id_video']; ?>.jpg" />
										</a>
									</div>
									<a href="<?php echo "index.php?fichier=tube.php&amp;tube=".$tube_general_similar_array['id_video']."#titre"; ?>" style="font-size: x-small;">
										<b><?php echo $tube_general_similar_array['titre']; ?></b>
									</a><br />
									<?php echo $langage[11]." <a href=\"index.php?fichier=perso.php&amp;camarade=".$tube_general_similar_array['id_membre']."\">".$tube_general_similar_array['login_original']."</a>"; ?>									<?php echo $tube_general_similar_array['visite']." ".$langage[25]; ?><br />
								</td></tr></table>
							<?php
									}
							?>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td><br /></td></tr>
	<tr> <!--TITRE-->
		<td class="chapitre" colspan="2" style="padding-left: 40px; padding-right: 40px; width: 100%;">
			<span class="h2">&nbsp;<?php echo $langage[32]; ?></span>
		</td>
	</tr>
	<tr>
		<td class="contenu" colspan="2" style="padding-left: 40px; padding-right: 40px; width: 100%">
			<?php
				if($connexion)
					{
			?>
			<form method="post" action="script.php">
				<input type="hidden" class="link" name="link" value="<?php echo $url."fichier=".$fichier."&amp;tube=".$tube; ?>" />
				<p>	<br />
					<?php echo $langage[11]." <b>".$login_original."</b>"; ?><br />
					<input type="hidden" class="id_video" name="id_video" value="<?php echo $tube_general_vision['id_video']; ?>" />
					<input type="hidden" class="id_auteur" name="id_auteur" value="<?php echo $id_membre; ?>" />
					<textarea name="commentaire" cols="80" rows="10" style="width: 100%;"></textarea><br />
				</p>
				<p style="text-align: right">
					<input type="submit" value="<?php echo $langage[34]; ?>" />
				</p>
			</form>
			<?php
					}
				else
					{
			?>
			<b><?php echo $langage[33]; ?>
			<?php
					}
					
				} //SI CETTE VIDEO N'EST PAS EN LIGNE, OU MEME INEXISTANTE!
			else
				{
					if($ban_visiteur)
						{
			?>
			<p style="text-align: center;r font-weight: bold; font-size: large;">
				<span class="h1"><?php echo $langage[56]." : "; ?><br /></span>
				<?php
					while($avertissement_visiteur_array = mysql_fetch_array($avertissement_visiteur))
						echo $avertissement_visiteur_array['explication']."<br />";
				?>
			</p>
			<?php
						}
					else
						{
							if($tube_general_vision['censure'] == 'F')
								echo "<p style=\" text-align: center; font-weigth: bold; font-size: large;\"><br /><br /><br /><br />".$langage[47]."</p>";
							else
								echo "<p style=\" text-align: center; font-weigth: bold; font-size: large;\"><br /><br /><br /><br />".$langage[115]."</p>";
						}
				}
			?>
		</td>
	</tr>
	<tr><td style="height: 100%;"></td></tr>
</table>
<?php
	}
?>