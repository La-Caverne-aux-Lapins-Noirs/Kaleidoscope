<?php
	//Pentacle Technologie 2009: BRILLANTE Jason Damdoshi - Norme du Chaos
	header ("Content-type: image/png");
	$image = imagecreate(200,50);

	$noir = imagecolorallocate($image, 20, 20, 20);
	
	$bleu = imagecolorallocate($image, 0, 0, 255);
	$bleua = imagecolorallocate($image, 130, 130, 255);
	
	$rouge = imagecolorallocate($image, 255, 0, 0);
	$rougea = imagecolorallocate($image, 160, 0, 0);
	$rougeb = imagecolorallocate($image, 255, 100, 100);
	
	$gris = imagecolorallocate($image, 90, 90, 90);	
	$grisa = imagecolorallocate($image, 10, 10, 10);	
	
	ImageFilledRectangle ($image, 0, 10, 50, 40, $rouge);
	ImageFilledRectangle ($image, 51, 10, 100, 40, $bleu);
	ImageFilledRectangle ($image, 101, 10, 150, 40, $gris);
	ImageFilledRectangle ($image, 151, 10, 200, 40, $rouge);
	
	imagestring($image, 5, rand(0, 40), rand(10, 30), $_COOKIE['code1'], $rougea);
	imagestring($image, 5, rand(50, 80), rand(10, 30), $_COOKIE['code2'], $bleua);
	imagestring($image, 5, rand(100, 140), rand(10, 30), $_COOKIE['code3'], $grisa);
	imagestring($image, 5, rand(150, 170), rand(10, 30), $_COOKIE['code4'], $rougeb);
	
	imagepng($image);
?>