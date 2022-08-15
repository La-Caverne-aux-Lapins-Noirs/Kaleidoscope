<?php
if(isset($testeur) && $testeur == "lobo951")
	{
?>
<table class="article" style="width: 100%; height: 100%;">
	<!--tr> <!--TITRE-!->
		<td class="chapitre">
			<span class="h2"><?php echo $langage[13]; ?></span>
		</td>
	</tr-->
	<tr> <!--PUB-->
		<td class="contenu" style="text-align: center; vertical-align: top; height: 0%;">
			<?php
				$admin_news_array = mysql_fetch_array($admin_news);
				echo $admin_news_array['code'];
			?>
		</td>
	</tr>
	<tr><td></td></tr>
	<tr>
		<td class="chapitre">
			<span class="h2"><?php echo $langage[17]." : "; ?></span>
		</td>
	</tr>
	<tr> <!--LISTE DE CRITERES-->
		<td class="chapitre" style="text-align: center; vertical-align: top; height: 0%;">
			<?php
				echo $langage[19]." : &nbsp; &nbsp;"; //Critères employés
				for($j = 0; $j < $nbr_keyword; $j++)
					echo "<a href=\"index.php?fichier=list.php&amp;keyword=".$keyword[$j]."\">".$keyword[$j]."</a> &nbsp; &nbsp; &nbsp;";
			?>
		</td>
	</tr>
	<tr> <!--LISTE DES VIDEOs-->
		<td style="height: 100%; vertical-align: top; padding-left: 0px; padding-right: 0px;">
			<?php
				$j = 0;
				while($tube_general_list_array = mysql_fetch_array($tube_general_list))
					{
			?>
				<div style="width: 150px; padding: 0px 0px 0px 0px; height: 300px; float: left; vertical-align: top;">
					<table style="width: 150px; height: 300px;">
						<tr><td style="background-color: black; height: 150px; width: 150px; vertical-align: center; text-align: center;">
							<a href="<?php echo "index.php?fichier=tube.php&amp;tube=".$tube_general_list_array['id_video']."#titre"; ?>">
								<img alt="Thumb" class="thumb" src="<?php echo "upload_img/mini_".$tube_general_list_array['id_video'].".jpg"; ?>" />
							</a>
						</td></tr>
						<tr><td style="vertical-align: top; font-size: x-small;">
							<a href="<?php echo "index.php?fichier=tube.php&amp;tube=".$tube_general_list_array['id_video']."#titre"; ?>" style="text-decoration: none;">
								<b><?php echo $tube_general_list_array['titre']; ?></b>
							</a><br />
							<?php echo substr($tube_general_list_array['description'], 0, 32)."..."; ?><br />
							<?php echo $langage[11]." <a href=\"index.php?fichier=perso.php&amp;camarade=".$tube_general_list_array['id_membre']."\">".$tube_general_list_array['login_original']."</a>" ?><br />
							<?php 
								$date = explode("-", $tube_general_list_array['date']);
								echo $langage[20]." ".$date[2]."-".$date[1]."-".$date[0]; 
							?>
							<?php echo $tube_general_list_array['visite']." ".$langage[25]; //Visite, views ?>
						</td></tr>
					</table>
				</div>
			<?php
						$j++;
					}
			?>
		</td>
	</tr>
	<tr><td style="text-align: center;">
		<?php
				if($j == 0)
					echo $langage[21]; //Aucune video
			?>
			<br /><br />
			<?php
				if($page > 0)
					echo "<a href=\"index.php?fichier=list.php&amp;keyword=".$complete_keyword."&amp;page=".($page - 1)."\">".$langage[22]."</a>";
					echo "&nbsp; &nbsp; ".$langage[24]." ".$page." &nbsp; &nbsp;";
					echo "<a href=\"index.php?fichier=list.php&amp;keyword=".$complete_keyword."&amp;page=".($page + 1)."\">".$langage[23]."</a>";
			?>
		</td>
	</tr>
</table>
<?php
	}
?>