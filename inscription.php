<?php
if(isset($testeur) && $testeur == "lobo951")
	{
?>
<table class="article" style="width: 100%; height: 100%;">
	<tr> <!--TITRE-->
		<td class="chapitre">
			<span class="h2"><?php echo $langage[97]; ?></span>
		</td>
	</tr>
	<tr> <!--RAPPEL DES CONDITIONS D'UTTILISATIONS-->
		<td class="contenu" style="padding-left: 30px; padding-right: 30px; height: 0%;">
			<textarea rows="50" cols="80" style="width: 100%; height: 400px;" readonly="readonly"><?php	echo $condition[0];?></textarea>
		</td>
	</tr>
	<tr>
		<td class="boite" style="padding-left: 50px; height: 0%; vertical-align: top;">
			<br /><br />
			<form method="post" action="script.php">
				<p>
					<input type="hidden" name="code_bot" id="code_bot" value="<?php echo $rand; ?>" />
					<input type="hidden" name="link" id="link" value="http://<?php echo $url; ?>" />
				
					<label for="login" style="width: 300px;"><?php echo $langage[3]; ?></label>
					<input type="text" name="login" maxlength="16" style="width: 200px;" /><br />
					
					<label for="password" style="width: 300px;"><?php echo $langage[4]; ?></label>
					<input type="password" name="password" maxlength="16" style="width: 200px;" /><br />
					
					<label for="password_copie" style="width: 300px;"><?php echo $langage[98]; ?></label>
					<input type="password" name="password_copie" maxlength="16" style="width: 200px;" /><br />
					
					<label for="mail" style="width: 300px;"><?php echo $langage[66]; ?></label>
					<input type="mail" name="mail" maxlength="38" style="width: 200px;" /><br />
					<br />
					<label for="newsletter" style="width: 400px;"><?php echo $langage[100]; ?></label>
					<input type="checkbox" name="newsletter" style="width: 20px;" checked="yes" /><br />
					<br />
					<label for="langage" style="width: 300px;"><?php echo $langage[12]; ?> : &nbsp;</label>
					<select name="langage" id="langage" style="width: 200px;">
						<?php
							while($langage_index_array = mysql_fetch_array($langage_index))
								{
						?>
						<option value="<?php echo $langage_index_array['code']; ?>">
							<?php echo $langage_index_array['nom']; ?>
						</option>
						<?php
								}
						?>
					</select>
				</p>
				<p>
					<img src="code.php" alt="Code" /><br />
					<label for="code_bot_copie"><?php echo $langage[5].": "; //Code_bot_copie: ?></label>
					<input type="text" name="code_bot_copie" id="code_bot_copie" maxlength="8" />
					<br />
				</p>
				<p>
					<label for="condition" style="width: 300px;"><?php echo $langage[45]; ?></label>
					<input type="checkbox" name="condition" style="width: 20px;" />
				</p>
				<p style="text-align: center;">
					<input type="submit" name="inscription" value="<?php echo $langage[99]; ?>" style="width: 200px;" />
				</p>
			</form>
			<br /><br />
		</td>
		<td style="height: 100%;">
			&nbsp;
		</td>
	</tr>
</table>
<?php
	}
?>