<?php

	$email=urldecode($_SESSION['sess_protec_email']);
	
	if (empty($email)) $email="Invalide";
	
	//Cr�ation des couleurs
	 $image = imagecreate(280, 18);
	 $color = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
	 $colorTxt = imagecolorallocate($image, 0x00, 0x00, 0x00);
	
	//Cr�ation du rectangle 
	imagerectangle($image,0,0,279,17,$color);
	 imagestring($image,2,4,2, "$email",$colorTxt);
	 imageinterlace($image, false);
	
	//Cr�ation de l'image avec destruction
	header("Content-type: image/png");
	 imagepng($image);
	 imagedestroy($image);
	 
?>