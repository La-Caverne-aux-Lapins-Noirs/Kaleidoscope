<?php
	if(isset($testeur) && $testeur == "lobo951")
		{
			$actual_timestamp = time();
			mysql_connect($db_adr, $db_login, $db_password) or die(mysql_error());
			mysql_select_db($db_name) or die(mysql_error());
			$stat_gen_query = mysql_query("
				SELECT		SUM(visite) as total,
							COUNT(visite) as visiteur,
							AVG(visite) as moyenne
				FROM		admin_visiteur
			") or die (mysql_error());
			$stat_temp_query = mysql_query("
				SELECT		SUM(visite) as total,
							COUNT(visite) as visiteur,
							AVG(visite) as moyenne
				FROM		admin_visiteur
				WHERE		date > ($actual_timestamp - (60 * 60 * 24 * 7))
			") or die (mysql_error());
			$stat_video_query = mysql_query("
				SELECT		COUNT(visite) as video,
							SUM(visite) as visite,
							AVG(visite) as moyenne
				FROM		tube_general
			") or die(mysql_error());
			$stat_membre_query = mysql_query("
				SELECT		COUNT(id_membre) as membre
				FROM		membre_general
			") or die(mysql_error());
			mysql_close();
			$stat_gen = mysql_fetch_array($stat_gen_query);
			$stat_temp = mysql_fetch_array($stat_temp_query);
			$stat_video = mysql_fetch_array($stat_video_query);
			$stat_membre = mysql_fetch_array($stat_membre_query);
?>
<table style="height: 100%; width: 100%;"><tr><td style="height: 0px;" colspan="2">
		<p style="text-align: center;">Statistique</p>
	</td></tr><tr><td class="entete" style="width: 50%; height: 50%;">
		<table style="height: 100%; width: 100%;"><tr><td style="vertical-align: top;">
			Statistic about visitors:
		</td></tr><tr><td class="boite" style="vertical-align: top; height: 100%; padding-left: 5px;">
			<p>
				<br />
				Views: <?php echo number_format($stat_gen['total'], 0, ',', ' '); ?><br />
				Visitors: <?php echo number_format($stat_gen['visiteur'], 0, ',', ' '); ?><br />
				Views per visitors: <?php echo number_format($stat_gen['moyenne'], 3, ',', ' '); ?>
			</p>
		</td></tr></table>
	</td><td class="entete" style="height: 50%; width: 50%;">
		<table style="height: 100%; width: 100%;"><tr><td style="vertical-align: top;">
			Statistic about visitors last week:
		</td></tr><tr><td class="boite" style="vertical-align: top; height: 100%; padding-left: 5px;">
			<p>
				<br />
				Views: <?php echo number_format($stat_temp['total'], 0, ',', ' '); ?><br />
				Visitors: <?php echo number_format($stat_temp['visiteur'], 0, ',', ' '); ?><br />
				Views per visitors: <?php echo number_format($stat_temp['moyenne'], 3, ',', ' '); ?>
			</p>
		</td></tr></table>
	</td></tr><tr><td class="entete" style="height: 50%; width: 50%;">
		<table style="height: 100%; width: 100%;"><tr><td style="vertical-align: top;">
			Statistic about video:
		</td></tr><tr><td class="boite" style="vertical-align: top; height: 100%; padding-left: 5px;">
			<p>
				<br />
				Video: <?php echo number_format($stat_video['video'], 0, ',', ' '); ?><br />
				Views: <?php echo number_format($stat_video['visite'], 0, ',', ' '); ?><br />
				Views per video: <?php echo number_format($stat_video['moyenne'], 3, ',', ' '); ?>
			</p>
		</td></tr></table>
	</td><td class="entete" style="height: 50%; width: 50%;">
		<table style="height: 100%; width: 100%;"><tr><td style="vertical-align: top;">
			Statistic about members:
		</td></tr><tr><td class="boite" style="vertical-align: top; height: 100%; padding-left: 5px;">
			<p>
				<br />
				Members: <?php echo number_format($stat_membre['membre'], 0, ',', ' '); ?>
			</p>
	</td></tr></table>
</td></tr></table>
<?php
		}
	else
		echo "Forbidden";
?>