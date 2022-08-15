<?php
$install = true;
require __DIR__ . '/../compat.php';


	if(isset($_POST['login']))
		if($_POST['mdp'] == $_POST['mdp2'])
			{
				$fichier = fopen("../log.php", "a");
				$data = 
"<?php
if(isset(\$testeur) && \$testeur == \"lobo951\")
	{
	\$db_adr = '".$_POST['host']."';
	\$db_login = '".$_POST['bdd_login']."';
	\$db_password = '".$_POST['bdd_mdp']."';
	\$db_name = '".$_POST['name']."';
	}
?>";
				fputs($fichier, $data);
				fclose($fichier);
				$testeur = "lobo951";
				include("sql.php");
				
			}
?>
<html>
	<head>
		<meta charset="utf8" />
		<title>Pentacle Technologie: Kaleidoscope</title>
	</head>
	<style>
		h1
			{
				color: #FF0000;
			}
		p
			{
				color: #FFFFFF;
			}
		label
			{
				color: #FFFFFF;
				width: 400px;
			}
		input
			{
				width: 200px;
			}
	</style>
	<body bgcolor="#000000" style="vertical-align: top; padding-top: 10px; margin-right: 600px;">
		<h1>Bienvenue sur l'interface d'installation de Kaleidoscope!</h2>
		<p>	L'interface d'échange vidéo de Pentacle Technologie vous permet la mise en ligne de vidéos ainsi que leur conversion dans un
			format approprié à leur affichage dans un module Flash. Un moteur de recherche associé vous permettra de les parcourir ainsi 
			que de visionner.
			<br />
			Une messagerie interne permet aux membres inscrits de s'echanger des messages. Il leur est également possible de poster
			des commentaires et de disposer d'une page personelle aux fonctions simples.
			<br />
			Un système de délation communautaire, d'avertissement et de censure est a la disposition dans une certaine mesure des membres
			et de l'équipe de modération.
		</p>
		<p> Kaleidoscope est multi-langage. Anglais et Francais sont pré-installé.
		</p>
		<p> Kaleidoscope V1.00 ne comporte pas d'interface d'administration.
		</p>
		<p>	Nous vous remercions d'avoir acheté Kaléidoscope.
		</p>
		<h1>Les permissions d'accès doivent être reglé à 775!</h1>
		<form method="post" style="padding-left: 100px;">
			<p>
				<label for="login">Entrez ce qui va devenir votre login sur le site :</label>
				<input type="text" name="login" /><br />
				
				<label for="mdp">Entrez votre mot de passe :</label>
				<input type="password" name="mdp" /><br />
				
				<label for="mdp2">Entrez votre mot de passe une seconde fois :</label>
				<input type="password" name="mdp2" /><br />
				
				<label for="mail">Entrez votre adresse e-mail :</label>
				<input type="text" name="mail" /><br />
			</p>
			<p>
				<label for="host">Entrez l'adresse de votre base de donnée (ou localhost) :</label>
				<input type="text" name="host" /><br />
				
				<label for="name">Entrez le nom de la base de donnée à créer :</label>
				<input type="text" name="name" /><br />
				
				<label for="bdd_login">Entrez votre login sur votre base de donnée :</label>
				<input type="text" name="bdd_login" /><br />
				
				<label for="bdd_mpd">Entrez votre mot de passe de base de donnée :</label>
				<input type="password" name="bdd_mdp" /><br />
			</p>
			<p style="text-align: center;">
				<input type="submit" />
			</p>
		</form>
		<p style="text-align: center;">
			Website "Kaleidoscope" powered by Pentacle Technologie Copyright 2009-2010 <br />
			8 Rue des Rasselins 75020 Paris FRANCE <br />
			<br />
			Tel: 09-50-87-42-01 <a href="mailto:damdoshi@pentacle-technologie.net">damdoshi@pentacle-technologie.net</a><br />
			<a href="http://pentacle-technologie.net">http://pentacle-technologie.net</a> All rights reserved 
		</p>
	</body>
</html>