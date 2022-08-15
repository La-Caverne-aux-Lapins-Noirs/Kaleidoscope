<?php
if(isset($testeur) && $testeur == "lobo951")
	{
?>
<table class="article" style="width: 100%; height: 100%;">
	<tr> <!--TITRE-->
		<td colspan="2" class="chapitre">
			<span class="h2"><?php echo $langage[116]; ?></span>
		</td>
	</tr>
	<tr>
		<td class="boite" style="padding-left: 30px; width: 100%;">
			<br />
			<?php
				while($news_array = mysql_fetch_array($news))
					{
						if ($edit != $news_array['id_news'])
							{
								echo "<b>".$news_array['login_original']."</b> &nbsp; &nbsp; ".$news_array['date'];
								if ($connexion && $admin > 0)
									{
										echo '&nbsp;&nbsp;';
										echo '<a href="index.php?fichier=news_complete.php&amp;edit='.$news_array['id_news'].'">';
										echo 'Edit';
										echo '</a>';
										echo '&nbsp;&nbsp;';
										echo '<a target="_blank" href="script_patch.php?delete_news='.$news_array['id_news'].'" onClick="javascript:location.reload(true)">';
										echo 'X';
										echo '</a>';
									}
								echo "<p>".$news_array['titre']."<br />".$news_array['message']."</p>";
								echo "<p>-------------------------------------------------------------</p>";
							}
						else
							{
			?>
								<form action="script_patch.php" method="post" target="_blank">
									<p>
										<input type="hidden" name="edit_news" value="<?php echo $news_array['id_news']; ?>" />
										<input type="text" name="titre" value="<?php echo $news_array['message']; ?>" /><br />
										<textarea name="message" cols="70" rows="20"><?php echo $news_array['message']; ?></textarea><br />
										<br />
										<input type="submit" value="Ok" />
									</p>
									<p>-------------------------------------------------------------</p>
								</form>
			<?php
							}
					}
			?>
			<br /><br />
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