<?php
if(isset($testeur) && $testeur == "lobo951")
	{
?>
<table class="article" style="width: 100%; height: 100%;">
	<tr> <!--METTRE EN LIGNE UNE VIDEO-->
		<td class="chapitre">
			<span class="h2"><?php echo $langage[37]; ?></span>
		</td>
	</tr>
	<tr> <!--RAPPEL DES CONDITIONS D'UTTILISATIONS-->
		<td class="contenu" style="padding-left: 30px; padding-right: 30px;">
			<textarea rows="50" cols="80" style="width: 100%; height: 400px;" readonly="readonly"><?php	echo $condition[0];?></textarea>
		</td>
	</tr>
	<tr><td><br /></td></tr>
	<tr> <!--ENTREZ ICI LES CARATERISTIQUES DE LA VIDEO-->
		<td class="chapitre">
			<span class="h2"><?php echo $langage[38]; ?></span>
		</td>
	</tr>
	<?php
		if(!$ban_visiteur && $connexion)
			{
	?>
	<tr> <!--FORMULAiRE-->
		<td class="contenu" style="padding-left: 50px; padding-right: 50px;">
			<br />
			<script language="javascript">
				function progress(point)
					{			
						alert("ok");
						var str_point = "";
						var i;
						var cible = document.getElementById("uploadgo");
						cible[0].value = "Upload" + str_point;
						if(point > 10)
							{
								point = 0;
								str_point = "";
							
						else
							{
								for(i = 0; i < point; i++)
									str_point = str_point.".";
								point++;
							}
						window.setTimeout("progress(" + point + ")", 50);
					}
			</script>
			<form method="post" action="script.php" enctype="multipart/form-data">
				<input type="hidden" name="position" value="upload" /> <!--POSITION DU FORMULAIRE-->
				<input type="hidden" name="MAX_FILE_SIZE" value="204857600" /> <!--TAiLLE MAX DU FICHIER-->
				<input type="hidden" name="id_auteur" value="<?php echo $id_membre; ?>" /> <!--ID AUTEUR-->
				<input type="hidden" name="code_bot" id="code_bot" value="<?php echo $rand; ?>" /> <!--CODE ANTI BOT-->
				<p> <!--Adresse du fichier-->
					<label class="longform" for="up_file"><?php echo $langage[39]." : "; ?></label><br />
					<input class="longform" type="file" name="up_file" id="up_file" /><br />
					<b><?php echo $langage[40]; ?></b><br />
					<?php echo $langage[41]; ?>
				</p>
				<p>
					<label class="longform" for="up_titre"><?php echo $langage[42]." : "; ?></label><br />
					<input class="longform" type="text" maxlength="64" name="up_titre" id="up_titre" /><br />
					
					<label class="longform" for="up_description"><?php echo $langage[43]." : "; ?></label><br />
					<textarea name="up_description" id="up_description" style="width: 100%;" rows="10" cols="80"></textarea><br />
					
					<label class="longform" for="up_keywords"><?php echo $langage[44]." : "; ?></label><br />
					<input class="longform" type="text" name="up_keywords" id="up_keywords" />
				</p>
				<p>
					<img src="code.php" alt="Code" /><br />
					<label for="code_bot_copie"><?php echo $langage[5].": "; //Code_bot_copie: ?></label>
					<input type="text" name="code_bot_copie" id="code_bot_copie" maxlength="8" />
				</p>
				<p>	
					<label class="longform" style="text-align: left; width: 250px;" for="up_check"><?php echo $langage[45]; ?></label>
					<input style="width: 20px;" type="checkbox" id="up_check" name="up_check" value="false" /><br />
				</p>
				<?php
					if($connexion && ($admin || !$configuration[6]))
						{
				?>
				<p style="text-align: center;">
					<input name="uploadgo" id="uploadgo" class="longform" type="submit" value="<?php echo $langage[46]; ?>" onclick="progress(0)" />
				</p>
				<?php
						}
				?>
			</form>
		</td>
	</tr>
	<?php
			}
		else
			{
	?>
	<tr>
		<td class="contenu" style="padding-left: 50px; padding-right: 50px; height: 100%;">
			<p>
				<?php
					if($connexion)
						{
							?><span class="h1"><?php echo $langage[56]." : "; ?><br /></span><?php
							while($avertissement_visiteur_array = mysql_fetch_array($avertissement_visiteur))
								echo $avertissement_visiteur_array['explication']."<br />";
						}
					else
						echo $langage[90]." ! ";
				?>
			</p>
		</td>
	</tr>
	<?php
			}
	?>
</table>
<?php
	}
?>