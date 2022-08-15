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
			<br />
<?php
		echo $announce['msg'];
		echo '<p style="text-align: right;">';
		echo $announce['date'];
		echo "</p>";
?>
		</td>
	</tr>
</table>
<?php
	}
?>