<?php
/**
 * Appel Ajax - Page Contact
 * N�cessaire � certaines actions du module Contact
 *
 */
 
// Inclusion Ajax
header('Content-Type: text/html; charset=ISO-8859-1'); 
session_start();
	include '../include/fonctions.php';

switch(@$_GET['act'])
{
// Envoyer un message en tant qu'utilisateur logg�
case "posterLog":

	securite_membre(true);

	$sujet=addBdd($_POST['sujet']);
	$message=addBdd($_POST['message']);
	$myId=$_SESSION['sess_id'];
	$ip=ip();
	
	$sql=mysql_query("INSERT INTO ".PREFIX."contact (`sujet`, `message`, `id_membre`, `date`, `ip`)
											VALUES	('$sujet', '$message', '$myId', NOW(), '$ip')");
	
	if ($sql) echo "ok".SEPARATOR.miseenforme('message', '<b>Votre message a �t� envoy� avec succ�s !</b><br><br>Un membre du staff vous r�pondra dans les plus brefs d�lais.');
	else	  echo "bad";
	
break;
###################################################################################################################
// Envoyer un message en tant qu'invit�
case "posterNoLog":

	$sujet=addBdd($_POST['sujet']);
	$message=addBdd($_POST['message']);
	$nom=addBdd($_POST['nom']);
	$email=addBdd($_POST['email']);
	$ip=ip();
	
	$sql=mysql_query("INSERT INTO ".PREFIX."contact (`sujet`, `message`, `nom`,`email`, `date`, `ip`)
											VALUES	('$sujet', '$message', '$nom','$email', NOW(), '$ip')")
										or die (mysql_error());
	
	if ($sql) echo "ok".SEPARATOR.miseenforme('message', '<b>Votre message a �t� envoy� avec succ�s !</b><br><br>Un membre du staff vous r�pondra dans les plus brefs d�lais.');
	else	  echo "bad";
	
break;
}

ob_end_flush();
?>