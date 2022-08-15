<?php
if(isset($testeur) && $testeur == "lobo951")
	{
?>
<table class="contenu" style="width: 100%; height: 100%; padding: 0px;">
	<tr>
		<td class="chapitre" colspan="2" style="height: 0px;">
			<span class="h2"><?php echo $langage[102]; ?></span>
		</td>
	</tr>
	<tr>
		<td style="vertical-align: top; padding-left: 20px; padding-right: 20px; height: 100%;">
		<br />
	<?php
		switch($cible)
			{
				case "compte":
	?>
			<form method="post" action="script.php">
				<p>
					<label style="width: 300px;" for="newlog"><?php echo $langage[103]; ?></label>
					<input style="width: 300px;" type="text" name="newlog" maxlength="16" value="<?php echo $config_array['login_original']; ?>" /><br />
					<br />
					<label style="width: 300px;" for="pass"><?php echo $langage[104]." : "; ?></label>
					<input style="width: 300px;" type="password" name="pass" maxlength="16" /><br />
					<label style="width: 300px;" for="pass_copie"><?php echo $langage[105]." : "; ?></label>
					<input style="width: 300px;" type="password" name="pass_copie" maxlength="16" /><br />
					<br />
					<label style="width: 300px;" for="mail"><?php echo $langage[106]." : "; ?></label>
					<input style="width: 300px;" type="text" name="mail" maxlength="38" value="<?php echo $config_array['mail']; ?>" /><br />
					<br />
					<?php
						if($config_array['newsletter'] == 'V')
							$check = "check";
						else
							$check = ""
					?>
					<label for="newlog">Newsletter</label>
					<input type="checkbox" name="newsletter" checked="<?php echo $check; ?>" />
				</p>
				<p style="text-align: center;">
					<input style="width: 200px;" type="submit" />
				</p>
			</form>
	<?php
					break;
				case "apparence":
	?>
			<form method="post" action="script.php">
				<p>
					<img src="<?php echo $config_array['avatar']; ?>" alt="Avatar" /> <br /><br />
					<label for="avatar"><?php echo $langage[107]." : "; ?></label>
					<input style="width: 300px;" type="text" name="avatar" value="<?php echo $config_array['avatar']?>" /><br />
					<label style="width: 200px;" for="signature"><?php echo $langage[108]; ?></label><br />
					<textarea name="signature" rows="25" cols="80" style="width: 100%; height: 200px;"><?php echo str_replace("<br />", "", $config_array['signature']);?></textarea>
				</p>
				<p style="text-align: center;">
					<input style="width: 200px;" type="submit" />
				</p>
			</form>
	<?php
					break;
				case "detail":
	?>
			<form method="post" action="script.php">
				<p>
					<label style="width: 200px;" for="nom"><?php echo $langage[63]." : "; ?></label>
					<input style="width: 200px;" type="text" name="nom" value="<?php echo $config_array['nom'];?>" /><br />
					<label style="width: 200px;" for="prenom"><?php echo $langage[64]." : "; ?></label>
					<input style="width: 200px;" type="text" name="prenom" value="<?php echo $config_array['prenom'];?>" /><br />
					<?php 
						$date = explode("-", $config_array['naissance']);
						$date = $date[2]."-".$date[1]."-".$date[0]; 
					?>
					<label style="width: 200px;" for="naissance"><?php echo $langage[65]." : "; ?></label>
					<input style="width: 200px;" type="text" name="naissance" value="<?php echo $date;?>" /><br />
					<label style="width: 200px;" for="site"><?php echo $langage[76]." : "; ?></label>
					<input style="width: 200px;" type="text" name="site" value="<?php echo $config_array['site'];?>" /><br />
					<label style="width: 200px;" for="msn"><?php echo $langage[67]." : "; ?></label>
					<input style="width: 200px;" type="text" name="msn" value="<?php echo $config_array['msn'];?>" /><br />
					
					<label style="width: 200px;" for="residence"><?php echo $langage[68]." : "; ?></label>
					<input style="width: 200px;" type="text" name="residence" value="<?php echo $config_array['residence'];?>" /><br />
					<label style="width: 200px;" for="film"><?php echo $langage[70]." : "; ?></label>
					<input style="width: 200px;" type="text" name="film" value="<?php echo $config_array['film'];?>" /><br />
					<label style="width: 200px;" for="interet"><?php echo $langage[69]." : "; ?></label>
					<input style="width: 200px;" type="text" name="interet" value="<?php echo $config_array['interet'];?>" /><br />
					<br />
					<label style="width: 200px;" for="msg_bienvenu"><?php echo $langage[128]; ?></label><br />
					<textarea name="msg_bienvenu" rows="25" cols="80" style="width: 100%; height: 200px;"><?php echo str_replace("<br />", "", $config_array['msg_bienvenu']);?></textarea>
					<br />
					<label style="width: 200px;" for="presentation"><?php echo $langage[127]; ?></label><br />
					<textarea name="presentation" rows="25" cols="80" style="width: 100%; height: 200px;"><?php echo str_replace("<br />", "", $config_array['presentation']);?></textarea>
					
					<!--label style="width: 200px;" for="groupe"><?php echo $langage[71]." : "; ?></label>
					<input style="width: 200px;" type="text" name="groupe" value="<?php echo $config_array['groupe'];?>" /><br />
					<label style="width: 200px;" for="musique"><?php echo $langage[72]." : "; ?></label>
					<input style="width: 200px;" type="text" name="musique" value="<?php echo $config_array['musique'];?>" /><br />
					<label style="width: 200px;" for="artiste"><?php echo $langage[73]." : "; ?></label>
					<input style="width: 200px;" type="text" name="artiste" value="<?php echo $config_array['artiste'];?>" /><br />
					<label style="width: 200px;" for="genre"><?php echo $langage[74]." : "; ?></label>
					<input style="width: 200px;" type="text" name="genre" value="<?php echo $config_array['genre'];?>" /><br />
					<label style="width: 200px;" for="citation"><?php echo $langage[75]." : "; ?></label>
					<input style="width: 200px;" type="text" name="citation" value="<?php echo $config_array['citation'];?>" /><br /-->
				</p>
				<p style="text-align: center;">
					<input style="width: 200px;" type="submit" />
				</p>
			</form>
	<?php
					break;
			}
	?>
		</td>
	</tr>
</table>
<?php
	}
?>