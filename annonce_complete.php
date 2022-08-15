<?php
if(isset($testeur) && $testeur == "lobo951")
	{	
?>
<table class="article" style="width: 100%; height: 100%;">
	<tr> <!--TITRE-->
		<td class="chapitre">
			<span class="h2"><?php echo $langage[125]; ?></span>
		</td>
	</tr>
	<tr>
		<td class="boite" style="padding-left: 30px; width: 100%; height: 100%; vertical-align: top;">
			<?php
				while($annonce_complete_array = mysql_fetch_array($annonce_complete))
					{
			?>
			<br />
			<table style="width: 100%; height: 0%;">
				<tr>
					<td style="height: 0%;">
						<?php echo $langage[11]." : ".'<a href="index.php?fichier=perso.php&amp;camarade='.$annonce_complete_array['id_membre'].'">'.$annonce_complete_array['login_original']."</a>"; ?>
						<?php
							if ($connexion && $admin > 0)
								{
									echo '&nbsp;&nbsp;';
									echo '<a href="index.php?fichier=annonce_complete.php&amp;edit='.$annonce_complete_array['id_annonce'].'">';
									echo 'Edit';
									echo '</a>';
									echo '&nbsp;&nbsp;';
									echo '<a target="_blank" href="script_patch.php?delete_annonce='.$annonce_complete_array['id_annonce'].'" onClick="javascript:location.reload(true)">';
									echo 'X';
									echo '</a>';
								}
						?>
						<br />
						<?php echo $annonce_complete_array['date']; ?>
					</td>
				</tr>
				<tr>
					<td style="width: 100%; height: 100%; text-align: justify; vertical-align: top; padding-left: 10px; padding-right: 10px;">
						<p>
							<?php
								if ($edit == $annonce_complete_array['id_annonce'])
									{
							?>
								<form action="script_patch.php" method="post" target="_blank">
									<p>
										<input type="hidden" name="edit_annonce" value="<?php echo $annonce_complete_array['id_annonce']; ?>" />
										<textarea name="message" cols="70" rows="20"><?php echo $annonce_complete_array['message']; ?></textarea><br />
										<br />
										<input type="submit" value="Ok" />
									</p>
								</form>
							<?php
									}
								else
									{
										echo $annonce_complete_array['message'];
									}
							?>
							<br /><br />
						</p>
					</td>
				</tr>
				<tr>
					<td style="height: 0px;">
						<p>-------------------------------------------------------------</p>
					</td>
				</tr>
			</table>
				<?php
						}
				?>
			<br /><br />
		</td>
	</tr>
	<tr>
		<td style="height: 100%;">
			<?php
				if($page > 0)
					echo "<a href=\"index.php?fichier=annonce_complete.php&amp;tube=".$tube."&amp;page=".($page - 1)."\">".$langage[22]."</a>";
					echo "&nbsp; &nbsp; ".$langage[24]." ".$page." &nbsp; &nbsp;";
					echo "<a href=\"index.php?fichier=annonce_complete.php&amp;tube=".$tube."&amp;page=".($page + 1)."\">".$langage[23]."</a>";
			?>
		</td>
	</tr>
	<tr>
		<td style="height: 100%; vertical-align: bottom;">
			&nbsp;
		</td>
	</tr>
</table>
<?php
	}
?>