<?php
if(isset($testeur) && $testeur == "lobo951")
	{
?>
<table class="article" style="width: 100%; height: 100%;">
	<tr> <!--TITRE-->
		<td colspan="2" class="chapitre">
			<span class="h2"><?php echo $langage[110]; ?></span>
		</td>
	</tr>
	<tr>
		<td class="boite" style="padding-left: 40px;">
			<br />
			<br />
			<?php echo $langage[109]; ?>
			<br />
			<br />
			<form method="post" action="script.php">
				<p>
					<label for="request" style="width: 150px;"><?php echo $langage[106]." : "; ?></label>
					<input type="text" name="request" style="width: 300px;" />
				</p>
				<p style="text-align: center;">
					<input type="submit" style="width: 300px;" />
				</p>
			</form>
			<br />
			<br />
		</td>
	</tr>
	<tr><td style="height: 100%;"></td></tr>
</table>
<?php
	}
?>