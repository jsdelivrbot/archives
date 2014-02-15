<?php 
session_start();

include_once 'class_captcha.php';
include_once '../include/config.php';

define('DIR_FONT', '../include/fonts/');
define('DIR_IMG', '../images/');

// image PNG
$I = new captcha('PNG');

// on g�n�re une chaine al�atoire de 10 caract�res
$I->setStringLenght(5);

// police Tuffy de taille 15
$I->setFont(DIR_FONT.'stentiga.ttf' , 13);
$I->setTextColor(100,100,100);

// Angle du texte 5�
$I->setTextAngle(0);

$I->setMarginFromBorder(0,0,10,0);

//$I->setBackgroundImage(DIR_IMG.'fond_captcha.png');
$I->setBackgroundColor(255,255,255);
// g�n�ration de l image
$I->getImage();

// on met la cha�ne g�n�r�e en session pour le contr�le
$_SESSION['captcha-control'] = $I->getRandString();

?>