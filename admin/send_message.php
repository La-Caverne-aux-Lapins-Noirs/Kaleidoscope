<?php
	if(isset($testeur) && $testeur == "lobo951")
		{
			mysql_connect($db_adr, $db_login, $db_password) or die(mysql_error());
			mysql_select_db($db_name) or die(mysql_error());
			
			$pub1 = mysql_query("
				SELECT		code
				FROM		admin_publicite
				WHERE		categorie = 'global'
			") or die(mysql_error());
			$pub2 = mysql_query("
				SELECT		code
				FROM		admin_publicite
				WHERE		categorie = 'news'
			") or die(mysql_error());
			$pub1 = mysql_fetch_array($pub1);
			$pub1 = $pub1['code'];
			$pub2 = mysql_fetch_array($pub2);
			$pub2 = $pub2['code'];
			mysql_close();
?>
<table style="width: 100%; height: 100%;"><tr><td class="entete" style="height: 50%; width: 50%;">
		<table style="height: 100%; width: 100%;"><tr><td>
			Add a news on the website:
		</td></tr><tr><td class="boite" style="vertical-align: top; height: 100%; padding-left: 5px;">
			<form action="script.php" method="post">
				<input type="hidden" name="news" />
				<p>
					<br />
					L'annonce d'une mise � jour permet aux internautes
					de mieux aprehender l'�volution d'un site web et
					d'en exploiter toutes les capacit�s.
				</p>
				<p>
					Titre: <input type="text" name="titre" /><br />
					<textarea name="txt" rows="10" cols="20" style="width: 100%; height: 100%;"></textarea>
				</p>
				<p style="text-align: center">
					<br />
					<input type="submit" value="Lancer une mise � jour" style="width: 100%;" />
				</p>
			</form>
		</td></tr></table>
	</td><td class="entete" style="height: 50%; width: 50%;">
		<table style="height: 100%; width: 100%;"><tr><td>
			Add an announce:
		</td></tr><tr><td class="boite" style="vertical-align: top; height: 100%; padding-left: 5px;">
			<form action="script.php" method="post">
				<input type="hidden" name="annonce" />
				<p>
					<br />
					Une annonce est un �lement compl�tement publicitaire.
					Elle peut-�tre lanc� par le webmaitre ou un tiers et servir
					de r�mun�ration dans certains cas.
				</p>
				<p>
					<input style="visibility: hidden;" /><br />
					<textarea name="txt" rows="10" cols="20" style="width: 100%; height: 100%;"></textarea><br />
					<input type="checkbox" name="show" />Montrer sur l'index.
				</p>
				<p style="text-align: center">
					<input type="submit" value="Lancer une mise � jour" style="width: 100%;" />
				</p>
			</form>
		</td></tr></table>
	</td></tr><tr><td class="entete" style="height: 50%; width: 50%;">
		<table style="height: 100%; width: 100%;"><tr><td>
			Newsletter:
		</td></tr><tr><td class="boite" style="vertical-align: top; height: 100%; padding-left: 5px;">
			<form action="script.php" method="post">
				<input type="hidden" name="newsletter" />
				<p>
					<br />
					Une news letter est un message envoy� � l'ensemble des membres
					inscrits sur le site. Il convient d'employer ce syst�me avec
					parcimonie.
				</p>
				<p>
					<textarea name="txt" rows="10" cols="20" style="width: 100%; height: 100%;"></textarea>
				</p>
				<p style="text-align: center">
					<input type="submit" value="Lancer une mise � jour" style="width: 100%;" />
				</p>
			</form>
		</td></tr></table>
	</td><td class="entete" style="height: 50%; width: 50%;">
		<table style="height: 100%; width: 100%;"><tr><td>
			New ads:
		</td></tr><tr><td class="boite" style="vertical-align: top; height: 100%; padding-left: 5px;">
			<form action="script.php" method="post">
				<input type="hidden" name="pub" />
				<p>
					<br />
					Une publicit� faisant la promotion de l'oeuvre d'autrui
					contre une r�mun�ration. Le contenu de cette boite de texte doit �tre du code.
				</p>
				<p>
					Pub g�n�rale:<br />
					<textarea name="txt1" rows="3" cols="20" style="width: 100%; height: 100%;"><?php
						echo $pub1;
					?></textarea><br />
					Pub de recherche:<br />
					<textarea name="txt2" rows="3" cols="20" style="width: 100%; height: 100%;"><?php
						echo $pub2;
					?></textarea>
				</p>
				<p style="text-align: center">
					<input type="submit" value="Lancer une mise � jour" style="width: 100%;" />
				</p>
			</form>
		</td></tr></table>
</td></tr></table>
<?php
		}
	else
		echo "Forbidden";
?>