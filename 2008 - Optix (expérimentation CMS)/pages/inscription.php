<?php

// Est d�j� connect� ?
if ($m->mbre->est_log()) {
	$m->design->template("erreur");
	$m->design->assign("nomErreur", "Inscription impossible");
	$m->design->assign("descErreur", "Nous avons d�tect� que vous �tes d�j� connect�. Vous ne pouvez donc pas vous inscrire.");
}
else
{

switch(@$_GET['act']){

#######################################################################
######### Page affich� par d�faut : Formualaire d'inscription #########
#######################################################################
default:
case "formulaire":

	$m->design->template("_general/inscription");
	$m->design->assign('titrePage', "Inscription aux services du blog");
	

	
break;
	
#######################################################################
############# Apr�s post du formulaire : ajoute un membre #############
#######################################################################	
case "verif":
		
	$donnees=$_POST;
	$r=$m->mbre->ajouter_membre($donnees['pseudo'], $donnees['pass1'], $donnees['pass2'], $donnees['email'], true, array("site" => $donnees['site']));
	
	if ($r===true) {
		
		if (defined('AJAX')) {  header('location: ajax.php?inscription&act=confirmation'); }
		else				 {  header('location: inscription-confirmation.htm'); }
		
	} else {
		switch($r) {
		 case "erreur_ip": $mess="Nous avons d�tect� que vous avez d�j� un compte sur ce site. Vous ne pouvez pas vous r�inscrire."; break;
		 case "erreur_pseudo": $mess="Votre pseudo ne semble pas correspondre aux pr�-requis."; break;
		 case "erreur_pseudo_utilise": $mess="Le pseudo que vous avez choisi est d�j� utilis� par un membre."; break;
		 case "erreur_email": $mess="Votre adresse email ne semble pas valide."; break;
		 case "erreur_email_utilise": $mess="L'adresse email que vous avez entr� est d�j� enregistr�e dans notre base de donn�e."; break;
		 case "erreur_pass": $mess="Vous avez entr� 2 mots de passe diff�rents."; break;
		 case "erreur_sql": $mess="Une erreur inconnue est survenue durant l'enregistrement de votre compte."; break;
		 default: $mess="Erreur tr�s inconnue !".$r; break;
		}
	   
	   if (defined('AJAX')) die ("erreur|:|".$mess);
	   else {
	   	$m->design->assign("erreur", $mess);
		$m->design->template("_general/inscription");
	   }

	}
		
break;

#######################################################################
####################### Message de confirmation #######################
#######################################################################	
case "confirmation":

	$m->design->template("_general/inscription_ok");
	$ajax_titre="Confirmation de votre inscription";
	$ajax_hash="#inscription-confirmation";
	
break;


#######################################################################
############### Active un compte avec son id et la cl�  ###############
#######################################################################	
case "valider_compte":

	$m->mbre->activer_compte(fonctions::addBdd($_GET['id']), fonctions::addBdd($_GET['cle']));

break;
}

	$m->design->assign('titrePage', "Inscription au blog");
}
?>