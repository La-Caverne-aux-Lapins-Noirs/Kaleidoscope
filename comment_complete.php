<?php
if(isset($testeur) && $testeur == "lobo951")
	{	
?>
<table class="article" style="width: 100%; height: 100%;">
	<tr> <!--TITRE-->
		<td class="chapitre">
			<span class="h2"><?php echo $langage[122]; ?></span>
		</td>
	</tr>
	<tr>
		<td class="boite" style="padding-left: 30px; width: 100%;">
			<br /><br />
			<?php
				$j = 0;
				while(($com_array = mysql_fetch_array($com)) && ($j < 5))
					{
						if($com_array['censure'] == 'F')
							{
			?>		
			<table style="width: 75%; height: 0%;">
				<tr>
					<td style="height: 0%; width: 0%;" rowspan="3">
						<img alt="Avatar" src="<?php echo $com_array['avatar']; ?>" />
					</td>
					<td style="text-align: left; padding-left: 20px;">
						<b><?php
							echo "<a href=\"index.php?fichier=perso.php&amp;camarade=".$com_array['id_membre']."\">".$com_array['login_original']."</a>";
						?></b>
					</td>
					<td style="text-align: right;">
						<?php
							echo $com_array['date'];
						?>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<a target="_blank" href="script.php?id_video=<?php echo $com_array['id_commentaire']; ?>&amp;reportcom=true"><?php echo $langage[49]; ?></a>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="height: 0%; padding-left: 20px;">
						&nbsp;
						<?php
							echo $com_array['message'];
						?>
						<br /><br />
					</td>
				</tr>
				<?php
						if($admin > 0)
							{
				?>
				<tr>
					<td colspan="3" style="text-align: right; height: 0%;">
						<form method="post" action="script.php" style="display: inline;">
							<input type="hidden" class="link" name="link" value="<?php echo $url."fichier=".$fichier."&amp;tube=".$tube; ?>" />
							<input type="hidden" name="position" value="edition_commentaire" /> <!--POSITION DU FORMULAIRE-->
							<input type="hidden" id="id_comment" name="id_comment" value="<?php $com_array['id_commentaire']; ?>" />
							<input type="submit" value="EDIT" style="width: 100%;" />
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
				<tr>
					<td colspan="2">
						<?php echo $langage[29]; ?>
					</td>
				</tr>
				<?php
						if($admin > 0)
							{
				?>
				<tr>
					<td style="height: 0%;">
						&nbsp;
						<b>
							<?php
								echo "<a href=\"index.php?fichier=perso.php&amp;camarade=".$com_array['id_membre']."\">".$com_array['login_original']."</a>";
							?>
						</b>
					</td>
					<td style="text-align: right;">
						&nbsp;
						<?php
							echo $com_array['date'];
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="height: 0%;">
						&nbsp;
						<br />
						<?php
							echo $com_array['message'];
						?>
						<br />
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: right; height: 0%;">
						<form method="post" action="script.php" style="display: inline;">
							<input type="hidden" class="link" name="link" value="<?php echo $url."fichier=".$fichier."&amp;tube=".$tube; ?>" />
							<input type="hidden" name="position" value="edition_commentaire" /> <!--POSITION DU FORMULAIRE-->
							<input type="hidden" id="id_comment" name="id_comment" value="<?php $com_array['id_commentaire']; ?>" />
							<input type="submit" value="EDIT" style="width: 100%;" />
						</form>
					</td>
				</tr>
					<?php
							}
					?>
			</table>
				<?php
						}
					}
					?>
			<br /><br />
		</td>
	</tr>
	<tr>
		<td style="height: 100%;">
			<?php
				if($page > 0)
					echo "<a href=\"index.php?fichier=comment_complete.php&amp;tube=".$tube."&amp;page=".($page - 1)."\">".$langage[22]."</a>";
					echo "&nbsp; &nbsp; ".$langage[24]." ".$page." &nbsp; &nbsp;";
					echo "<a href=\"index.php?fichier=comment_complete.php&amp;tube=".$tube."&amp;page=".($page + 1)."\">".$langage[23]."</a>";
			?>
		</td>
	</tr>
</table>
<?php
	}
?>