<?php
require ("compat.php");
if(file_exists("log.php"))
{
	$testeur = "lobo951";
	include("fonctions.php");
	include("isset.php");
	include("sql_request.php");
?>

<!--"KALEIDOSCOPE" by Pentacle Technologie 2009-2010-->
<!--HTML/CSS/SQL/PHP/JS by BRILLANTE Jason Damdoshi - Norme du Chaos-->
<!--Flash concept by DARRIET Guillaume, Flash file by BRILLANTE Jason Damdoshi-->
<!--Thanks to MONPIERRE Lisa about her help for JScript-->
<!--Thanks to Liberty Rock Studio htt://libertyrockstudio.com for being the company host-->
<!--Hail Table, Tr, Td-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $langage_code; ?>">
	<head>
		<title>
			<?php echo $configuration[0]; ?>
		</title>
		<link 	rel="stylesheet" 
				media="screen" 
				type="text/css" 
				title="Design" 
				href= "<?php echo $configuration[4]; ?>" 
		/>
		<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252" />
		<meta name="Author" content="BRILLANTE Jason Damdoshi, DARRIET Guillaume Draak" />
		<meta name="Category" content="Multimedia" />
		<meta name="Copyright" content="Pentacle Technologie 2009-2010" />
		<meta name="Description" content="<?php echo $langage[13]; ?>" />
		<meta name="Keywords" content="<?php echo $configuration[1]; ?>" />
		<meta name="Distribution" content="global" />
		<meta name="Publisher" content="OVH" />
		<meta name="Robots" content="follow" />
		<script language="javascript">
			function logbox()
				{
					document.getElementById('login').focus();
				}
			
			function adaptation()
				{
					if(screen.width<=1100)
						{
							var cible = document.getElementsByTagName("object");
							cible[0].height = "378px";
							cible = document.getElementsByTagName("embed");
							cible[0].height = "378px";
						}
				}

			function searchbox()
				{
					document.getElementById('keyword').focus();
					adaptation();
				}
		</script>
	</head>
	<body onload="searchbox()">
		<h1 style="display:none;">
			<?php echo $langage[0]."<br />"; ?>
			<?php echo $langage[13]; ?>
		</h1>
		<table style="width: 100%; height: 100%; padding: 0px; margin: 0px;">
			<tr> <!--EN TETE-->
				<td colspan="2" style="height: 0%; padding: 0px;">
					<table style="width: 100%; height: 0%; padding: 0px; margin: 0px;">
						<tr>
							<td style="width: 200px; height: 0%; vertical-align: top;">
								<a href="index.php">
									<img src="<?php echo $configuration[3]; ?>" alt="<?php echo $configuration[0]; ?>"/>
								</a>
							</td>
							<td style="vertical-align: center; text-align: left; padding-left: 10px; padding-right: 10px; height: 0%;">
								<table style="width: 100%; height: 100%;">
									<tr>
										<td id="searchbar">
											<form method="post" action="index.php" style="diplay: inline;">
												<input type="hidden" id="fichier" name="fichier" value="list.php" />
												<!--b><?php echo $langage[10].": "; ?></b><br /-->
												<input type="text" id="keyword" name="keyword" style="width: 300px; display: inline;" maxlength="128" 
														value="<?php 
															if($fichier == "list.php" && $liste == "")
																echo $complete_keyword;
														?>"
												/>
												<input type="submit" value="<?php echo $langage[9]; ?>" style="width: 150px;" style="display: inline;" />
												<br />
												<a href="index.php" style="font-size: smaller;"><?php echo $langage[117]; ?></a>
												<?php
													while ($categorie_array = mysql_fetch_array($categorie))
														{
												?>
									
												<a href="index.php?fichier=list.php&amp;spec=old&amp;keyword=<?php echo $categorie_array['keyword']; ?>" style="font-size: smaller;"><?php echo $categorie_array['caption']; ?></a>
												<?php
														}
												?>
												<?php
													if ($connexion)
														{
															if ($admin > 1)
																{
																?>
																	<br />
																	<a href="admin/" style="font-size: smaller;">Panneau d'administration</a>
																<?php
																}
														}
												?>
											</form>
										</td>
									</tr>
								</table>
							</td>
							<td style="padding-right: 10px; text-align: right; width: 400px; vertical-align: top; height: 0%; line-height: 150%;">
								<?php //Log as / Vers page perso
									if($connexion)
										{
											echo $langage[0].": <a href=\"index.php?fichier=perso.php\">".$login_original."</a>"; //Connecté en tant que: 
											echo "&nbsp; &nbsp; &nbsp; &nbsp;";
											echo "<a href=\"script.php?logout=true\">".$langage[1]."</a>"; //Deconnexion
										}
									else
										{
											echo "<a href=\"index.php?fichier=inscription.php\">".$langage[7]."</a>";
											echo "&nbsp; &nbsp; &nbsp; &nbsp;";
											echo "<a href=\"#\" onclick=\"logbox()\">".$langage[2]."</a>";
										}
								?>
								<br />
								<div id="addvid" style="display: inline;">
									<?php //Connexion/Deconnexion ==> Add video
										if($connexion && ($admin || !$configuration[6]))
											{
												echo "<a href=\"index.php?fichier=upload.php\">".$langage[38]."</a>";
											}
										else if (!$configuration[6])
											{
												echo "<a href=\"index.php?fichier=inscription.php\">".$langage[38]."</a>";
											}
									?>
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr> <!--CORPS-->
				<td style="height: 100%; width: 100%; vertical-align: top; padding: 0px;">
					<?php
						if($fichier == "perso.php" && $id_camarade == 1)
							$fichier = "news.php";
						include($fichier);
					?>
				</td>
				<td style="min-width: 20%; width: 300px; height: 100%; text-align: center; vertical-align: top; padding: 0px;">
					<table style="height: 100%; width: 100%;">
						<tr> <!--PUBLICITE CARRE DROIT-->
							<td style="vertical-align: center; text-align: center; height: 0%;">
								<?php 
									$admin_global_array = mysql_fetch_array($admin_global);
									echo $admin_global_array['code'];
								?>
							</td>
						</tr>
					<?php
						if($fichier == "tube.php")
							{
					?>
						<tr>
							<td class="entete" style="width: 100%; height: 0%; padding: 0px;">
								<u class="h2"><?php echo $langage[121]." : "; ?></u>
								<table class="boite" style="padding: 0px; width: 100%; height: 0%;">
									<tr>
										<td>
											<p>
												<img src="<?php echo $tube_general_vision['avatar']; ?>" alt="<?php echo $tube_general_vision['login_original']; ?>" />
												<br />
												<b>
													<?php 
														echo $langage[11]." : <a href=\"index.php?fichier=perso.php&amp;camarade=".$tube_general_vision['id_auteur']."\">".$tube_general_vision['login_original']."</a>"; 
													?>
												</b>
											</p>
											<p>
												<?php 
													$date = explode("-", $tube_general_vision['date']);
													echo $langage[20]." ".$date[2]."-".$date[1]."-".$date[0]; 
												?><br />
												<?php echo $tube_general_vision['visite']." ".$langage[25]; ?>
											</p>
											<p style="font-size:smaller; text-align: justify;">
												<?php echo $tube_general_vision['description']; ?>
											</p>
											<form method="post" action="" style="display: inline;">
												<p style="font-size: smaller;">
													<?php echo $langage[50]." : "; ?><br />
													<input style="width: 180px;" type="text" value="<?php echo "http://".$domain."/index.php?fichier=tube.php&amp;tube=".$tube; ?> " readonly="readonly" />
												</p>
											</form>
											<form method="post" action="" style="display: inline;">
												<p style="font-size: smaller;">
													<?php echo $langage[51]." : "; ?><br />
													<?php $offset = "http://".$domain."/"; ?>
													<textarea style="width: 180px; display:inline;" rows="1" cols="1" readonly="readonly"><?php include("player.php"); ?></textarea>
												</p>
											</form>
											<p style="text-align: center;">
								<!--
								<?php 
									while($tube_general_keyword_array = mysql_fetch_array($tube_general_keyword))
										echo "<a href=\"index.php?fichier=list.php&amp;keyword=".$tube_general_keyword_array['keyword']."\">".$tube_general_keyword_array['keyword']."</a>&nbsp; &nbsp; &nbsp;"; 
								?>
								-->
								<?php 
									if($admin > 0 || $tube_general_vision['id_auteur'] == $id_membre)
										{
								?>				<!--
												<form method="post" action="script.php" style="display: inline;">
													<input type="hidden" class="link" name="link" value="http://<?php echo $url."?fichier=".$fichier."&amp;tube=".$tube; ?>" />
													<input type="hidden" name="position" value="edition_tube" />
													<input type="hidden" class="id_video" name="id_video" value="<?php echo $tube; ?>" />
													<input type="submit" value="<?php echo $langage[55]; ?>" style="width: 180px;" />
												</form>
												-->
								<?php
											if($admin > 0)
												{
								?>
												<form method="post" action="script.php?censure_vid=true" style="display: inline;">
													<input type="hidden" class="link" name="link" value="http://<?php echo $url."?fichier=".$fichier."&amp;tube=".$tube; ?>" />
													<input type="hidden" class="id_video" name="id_video" value="<?php echo $tube_general_vision['id_video']; ?>" />
													<input type="submit" value="<?php echo $langage[124]; ?>" style="width: 180px;" />
												</form>
								<?php
												}
											if($tube_general_vision['censure'] == 'F' || $admin > 1)
												{
								?>
												<form method="post" action="script.php?delete=true" style="display: inline;">
													<input type="hidden" class="link" name="link" value="http://<?php echo $url; ?>" />
													<input type="hidden" class="id_video" name="id_video" value="<?php echo $tube_general_vision['id_video']; ?>" />
													<input type="hidden" id="sel" name="sel" value="<?php echo $tube_general_vision['sel']; ?>" />
													<input type="submit" value="<?php echo $langage[123]; ?>" style="width: 180px;" />
												</form>
								<?php
												}
											if($admin > 1)
												{
								?>
												<form method="post" action="script.php?promotional=true" style="display: inline;">
													<input type="hidden" class="link" name="link" value="http://<?php echo $url."?fichier=".$fichier."&amp;tube=".$tube; ?>" />
													<input type="hidden" class="id_video" name="id_video" value="<?php echo $tube_general_vision['id_video']; ?>" />
													<input type="hidden" id="sel" name="sel" value="<?php echo $tube_general_vision['sel']; ?>" />
													<input type="submit" value="PROMOTE" style="width: 180px;" />
												</form>
								<?php
												}
										}
								?>
											</p>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					<?php
							}
							if(!$connexion)
								{
						?>
						<tr>
							<td class="entete" style="width: 100%; height: 0%; padding: 0px;">
								<u class="h2"><?php echo $langage[18]; ?></u>
								<table class="boite" style="padding: 0px; width: 100%; height: 0%;">
									<tr> <!--CONNEXION/DECONNEXION-->
										<td style="text-align: left; vertical-align: top; padding-left: 20px; padding-right: 20px;" id="boite">
											<br />
											<form method="post" action="script.php" id="logbox">
												<input type="hidden" class="link" name="link" value="<?php echo "http://".$url."?fichier=".$fichier."&amp;tube=".$tube; ?>" />
												<p>
													<label for="login"><?php echo $langage[3].": "; //Pseudo: ?></label>
													<input type="text" name="login" id="login" maxlength="16" /><br />
													<label for="login"><?php echo $langage[4].": "; //Password: ?></label>
													<input type="password" name="password" id="password" maxlength="16" /><br />
													<img src="code.php" alt="Code" /><br />
													<label for="code_bot_copie"><?php echo $langage[5].": "; //Code_bot_copie: ?></label>
													<input type="text" name="code_bot_copie" id="code_bot_copie" maxlength="8" />
												</p>
												<p style="text-align: center;">
													<input type="submit" style="text-align: center;" name="connect" id="connect" value="<?php echo $langage[2]; //Connexion ?>" />
													<input type="text" name="code_bot" id="code_bot" style="display: none;" value="<?php echo $rand; ?>" />
												</p>
											</form>
											<p style="font-size: smaller;">
												<?php
													echo "<a href=\"index.php?fichier=forgot.php\">".$langage[6]."</a> <br /> <a href=\"index.php?fichier=inscription.php\">".$langage[7]."</a>";
												?>
												<br /><br />
											</p>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<?php
								}
							else
								{
						?>	
						<tr>
							<td class="entete" style="width: 100%; height: 0%; padding: 0px;">
								<u class="h2"><?php echo $langage[54]; ?></u>
								<table class="boite" style="padding: 0px; width: 100%; height: 0%;">
									<tr> <!--MESSAGERIE-->
										<td style="text-align: left; vertical-align: top; padding-left: 10px; padding-right: 10px;" id="boite">
											<br />
											<span class="h2"><?php echo $langage[61]." : "; ?></span><br />
											<a href="index.php?fichier=perso.php&amp;section=perso_messagerie.php">
												<?php
													if($messagerie_compte['lu'] == 0)
														echo $langage[57];
													else
														echo $langage[58]." : ".$messagerie_compte['lu'];
												?>
											</a>
											<br /><br />
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<?php
								}
						?>
						<tr> <!--NEWS-->
							<td class="entete" colspan="2" style="width: 100%; height: 0%; padding: 0px;">
								<b class="h2"><u>News:</u></b>
								<?php
									$admin_news_limit_array = mysql_fetch_array($admin_news_limit);
								?>
								<table class="boite" style="width: 100%; height: 0%;">
									<tr>
										<td style="height: 0%;">
											<?php echo $langage[11]." : <br />".$admin_news_limit_array['login_original']; ?>
										</td>
										<td style="text-align: right; height: 0%; width: 100px;">
											<?php echo $admin_news_limit_array['date']; ?>
										</td>
									</tr>
									<tr>
										<td colspan="2" style="width: 100%; height: 50%; text-align: justify; vertical-align: top; padding-left: 10px; padding-right: 10px;">
											<br />
											<?php echo $admin_news_limit_array['titre']; ?>
											<br /><br />
											<?php echo $admin_news_limit_array['message']; ?>
											<br /><br />
											<a style="font-size: smaller;" href="index.php?fichier=news_complete.php"><?php echo $langage[16]; ?></a>
											<br /><br />
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr> <!--ANNONCES-->
							<td class="entete" colspan="2" style="width: 100%; height: 0%; padding: 0px;">
								<b class="h2"><u><?php echo $langage[125]; ?>:</u></b>
								<?php
									while($annonce_index_array = mysql_fetch_array($annonce_index))
										{
								?>
								<table class="boite" style="width: 100%; height: 0%;">
									<tr>
										<td style="height: 0%;">
											<?php echo $langage[11]." : <br />".$annonce_index_array['login_original']; ?>
										</td>
										<td style="text-align: right; height: 0%; width: 100px;">
											<?php echo $annonce_index_array['date']; ?>
										</td>
									</tr>
									<tr>
										<td colspan="2" style="width: 100%; height: 50%; text-align: justify; vertical-align: top; padding-left: 10px; padding-right: 10px;">
											<br />
											<?php echo $annonce_index_array['message']; ?>
											<br /><br />
											<a style="font-size: smaller;" href="index.php?fichier=annonce_complete.php"><?php echo $langage[126]; ?></a>
										</td>
									</tr>
								</table>
								<?php
										}
								?>
							</td>
						</tr>
						<tr><td style="height: 100%;">&nbsp;<br /><br /><br /></td></tr>
					</table>
					<img src="skin/gabarit.png" alt="" />
				</td>
			</tr>
			<tr> <!--PIED-->
				<td colspan="2" class="bas">
					<p style="text-align: center; font-size: 14px;"><?php echo $configuration[5]; ?></p>
					<table style="width: 100%;" class="bordure">
						<tr>
							<td class="bordure" style="height: 0%; width: 200px; text-align: center;">
								<p style="text-align: center; font-size: 10px;">
									"Kaleidoscope": powered by Pentacle Technologie Copyright 2009-2011 <br />
									<a href="http://pentacle-technologie.net">http://pentacle-technologie.net</a> All rights reserved<br />
									<a href="mailto:damdoshi@pentacle-technologie.net">Contact</a>
									<a href="http://pentacle-technologie.net/index.php?a=1"><?php echo $langage[53]; ?></a>
									<a href="http://pentacle-technologie.net/index.php?a=2"><?php echo $langage[52]; ?></a>
								</p>
							</td>
							<td class="bordure" style="text-align: center; width: 40%;">
								<p style="text-align: center; font-size: 10px;">
									DEEP SIDE CENTER<br />
									Centre de danse et remise en forme à Paris<br />
									19 rue Mont Louis 75011 Paris<br />
									<a href="http://www.deepside.eu">www.deepside.eu</a>
								</p>
							</td>
							<td class="bordure" style="vertical-align: center; text-align: right; width: 270px;">
								<form method="post" action="script.php" style="display: inline; width:100%;">
									<p style="display: inline;">
										<input type="hidden" class="link" name="link" value="<?php echo "http://".$url."?fichier=".$fichier."&amp;tube=".$tube; ?>" />
										<label for="langage" style="width: 160px;"><?php echo $langage[12]; ?> : &nbsp;</label>
										<select name="langage" id="langage" style="width: 70px;">
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
										<input type="submit" name="bouton" id="bouton" value="Ok" style="width: 30px;" />
									</p>
								</form>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
<?php
}
else
{
echo "Please install first!";
}
?>