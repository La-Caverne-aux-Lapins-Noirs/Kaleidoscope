<?php
	//Pentacle Technologie 2009: BRILLANTE Jason Damdoshi - Norme du Chaos
	header ("Content-type: image/jpg");
	$filename = "upload_img/mini_".$_GET['id_video'].".jpg";
	
	$xfinal = $_GET['x'];
	$yfinal = $_GET['y'];
	
	list($width, $height) = getimagesize($filename);
	if($width >= $height)
		{
			$facteur = $width / $xfinal;
			$width = $xfinal;
			$height = $height / $facteur;
		}
	else
		{
			$facteur = $height / $yfinal;
			$height = $yfinal;
			$width = $width / $facteur;
		}
		
	$cible = imagecreatetruecolor($width, $height);
	$source = imagecreatefromjpeg("oeuvre/".$_GET['lien']);
	
	$largeur_source = imagesx($source);
	$hauteur_source = imagesy($source);
	$largeur_cible = imagesx($cible);
	$hauteur_cible = imagesy($cible);
	imagecopyresampled($cible, $source, 0, 0, 0, 0, $largeur_cible, $hauteur_cible, $largeur_source, $hauteur_source);
	imagejpeg($cible);
?>
