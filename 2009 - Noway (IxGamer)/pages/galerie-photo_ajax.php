<?php
/**
 * Appel Ajax - Page Galerie
 * N�cessaire � certaines actions du module Galerie
 *
 */
 
// Inclusion ajax
header('Content-Type: text/html; charset=ISO-8859-1'); 
session_start();
	include '../include/fonctions.php';
	securite_membre(true);

switch(@$_GET['act'])
{
// Envoyer un vote sur une photo
case "noter_photo":

	$idPhoto=(int)$_POST['idPhoto'];
	$note=(int)$_POST['note'];
	$myId=$_SESSION['sess_id'];
	
	// V�rifications n�cessaires
	if ($note>5) die("ERROR : On ne triche pas !");

	$sqlVerif=mysql_query("	SELECT count(id_membre) as nbVote FROM ".PREFIX."galerie_verif_vote WHERE id_membre='".$myId."' AND id_photo='".$idPhoto."'");
	$verif=mysql_fetch_object($sqlVerif);
	if ($verif->nbVote!=0) die("ERROR : D�j� vot� !");
	
	$sqlVerif2=mysql_query("SELECT * FROM ".PREFIX."galerie WHERE id=$idPhoto");
	$d=mysql_fetch_object($sqlVerif2);
	if ($d->id_membre==$myId) die("ERROR : On ne vote pas pr ses photos");
	
	// Insertion dans Mysql
	$newcoeff=$d->note_coeff+1;
	$newnote=(($d->note*$d->note_coeff)+$note)/($newcoeff);
	
	$sql=mysql_query("UPDATE ".PREFIX."galerie SET note='$newnote', note_coeff='$newcoeff' WHERE id='$idPhoto'");
	$sql2=mysql_query("INSERT INTO ".PREFIX."galerie_verif_vote VALUES ('$idPhoto', '$myId')");
	
	// Retour ajax | Id de la photo | Nouvelle note | Nombres de votes |
	echo "+".SEPARATOR.$idPhoto.SEPARATOR.round($newnote,1).SEPARATOR.$newcoeff; 

break;
}
?>