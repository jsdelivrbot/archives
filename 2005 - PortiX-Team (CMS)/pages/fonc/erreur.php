<?php

if (isset($_GET['num'])) 
{
	
	$erreur[1]="<br><center>Vous n'avez pas les droits n�cessaire pour acc�der � cette page ou vous n'�tes pas connect�.</center><br>";
	$erreur[2]="<br><center>L'adresse Ip utilis� lors de votre connexion n'est plus la m�me que celle avec laquelle vous tentez d'acc�der � cette page.<br><br><b>Par mesure de s�curit�, vous avez �t� d�connect�</b><br><br>Merci de bien vouloir vous reconnecter avec vos indentifiants.</center><br><br>";
	
				$afficher->AddSession($handle, "contenu");
				$afficher->setVar($handle, "contenu.module_titre", "Erreur");
				$afficher->setVar($handle, "contenu.module_texte", $erreur[$_GET['num']]);
				$afficher->CloseSession($handle, "contenu"); 

}
?>

