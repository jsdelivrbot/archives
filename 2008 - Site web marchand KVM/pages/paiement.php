<?php
securite_membre(); /* S�curisation */

/* 
 * KVM E-commerce : paiement.htm et paiement-$action.htm
 *
 * - Appel direct : G�rer le paiement en fonction du mode de paiement choisi !!!! A REALISER !!!!
 * - Validation : Retour de la page paiement : ajoutes les infos du panier, et les infos de la commande dans la BDD
 * - Confirmation : Message affichant � l'utilisateur que sa commande a �t� enregistr�e
 */
 
 
switch(@$_GET['action']) {


   // -------------------------------------------------------------------------------------------------- //
  //			Page principale : Affiche le module de paiement en fonction du moyen choisi  			//
 //                                               /paiement.htm                                        // 
// -------------------------------------------------------------------------------------------------- //
default:	
	
	
	// On enregistre le type de paiement ( cb, cheque ... )
	$_SESSION['moyen_paiement']=addBdd($_POST['paiement']);
	
	$design->zone("titre", "Paiement de votre commande");
	
	
	
	
	
	  /* ---------------------------------------------------------------------------------------- \\
	    \\																						   \\
	     \\          	GESTION DU PAIEMENT ICI EN FONCTION DU MOYEN DE PAIEMENT CHOISI             \\
	      \\																    (commander.php)		 \\
	   	   \\ ----------------------------------------------------------------------------------------*/
		 
		 
		 $c='<form name="exemple" action="paiement-validation.htm">
		 		<label>Exemple vide</label>
		 		<input type="submit" class="f-submit" value="Envoyer mon paiement" />
		 	</form>';
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 
break;


   // -------------------------------------------------------------------------------------------------- //
  //			Page de validation appell�e � la fin du paiement : enregistre la commande   			//
 //                                               /paiement-validation.htm                             // 
// -------------------------------------------------------------------------------------------------- //

case "validation":
	
	
	// V�rifier l'acc�s � cette page
	// Penser � distinguer paiement en ligne ( d�j� effectu� ) et paiment lent ( ch�que )
	
	
	$statut="en_attente";
	
	// On r�cup�re les infos du panier :
	$sqlPanier=mysql_query("SELECT * FROM ".PREFIX."paniers_membres WHERE id_membre=".$_SESSION['sess_id']);
	$pan=mysql_fetch_object($sqlPanier);
		$liste_produits=addBdd($pan->liste_produits_s);
		$total=$_SESSION['sess_panier_totalHT'];
		$total_eco=$_SESSION['sess_panier_totalEco'];
		
		// On v�rifie l'int�grit� du panier :
		if (md5($pan->liste_produits_s)!=$_SESSION['sess_panier_md5']) 
			bloquerAcces("	Votre panier semble avoir chang� depuis la validation de votre commande.<br />
							Si la confirmation de votre commande a d�j� �t� affich�e, revenez simplement � l'accueil du site.");
		// On v�rifie l'int�grit� des totaux enregistr�s
		if ($_SESSION['sess_panier_total_md5']!=md5($total.$total_eco.$_SESSION['sess_id'])) 
			bloquerAcces("	Votre panier semble avoir chang� depuis la validation de votre commande.<br />
							Si la confirmation de votre commande a d�j� �t� affich�e, revenez simplement � l'accueil du site.");
		
		
	// Insertion des donn�es dans la base sql
	$sql=mysql_query("	INSERT INTO `".PREFIX."commandes` 
						( `id_membre` , `liste_produits_s` , `total_prix` , `total_ecotaxe` , `mode_paiement` , `id_fdp` , `statut` , `validation_date` )
						VALUES 
						( ".$_SESSION['sess_id']." , '$liste_produits' , '$total' , '$total_eco' , '".$_SESSION['moyen_paiement']."' , '".$_SESSION['sess_panier_fdp']."' , '$statut', NOW() )");
						
		$id_commande=mysql_insert_id();
			
							
	//>> Si le paiement a �t� effectu� en m�me temps que la commande, d�comentez cette partie
	/*	$ref_paiement="LOREM IPSUM";
	$sqlPaiement=mysql_query("	UPDATE ".PREFIX."commandes 
								SET 
									statut='paye',
									paiement_date=NOW(),
									ref_paiement='$ref_paiement'
								WHERE id_commande=$id_commande ") or die(mysql_error());*/
								
	
	// On met � jour le compteur d'achat
	foreach(unserialize($pan->liste_produits_s) as $arrayId=>$arrayProduit) {
		list($idProduit, $nbProduit)=$arrayProduit;
		$idProduit=(int)$idProduit; $nbProduit=(int)$nbProduit;
		mysql_query("UPDATE ".PREFIX."produits SET nb_achat=nb_achat+$nbProduit WHERE id_produit=$idProduit");
	}
	
					
	// On vide les sessions contenant des infos du panier, plus le panier en cours
	unset($_SESSION['sess_panier_totalHT'], $_SESSION['sess_panier_totalEco'], $_SESSION['sess_panier_total_md5'], $_SESSION['sess_panier_md5'], $_SESSION['moyen_paiement'], $_SESSION['sess_panier_fdp']);
	$sqlSuppr=mysql_query("DELETE FROM ".PREFIX."paniers_membres WHERE id_membre=".$_SESSION['sess_id']);
	$_SESSION['commande_id']=$id_commande;
	
	header('location: paiement-confirmation.htm');

break;



   // -------------------------------------------------------------------------------------------------- //
  //						Indique � l'utilisateur que sa commande a �t� enregistr�e 					//
 //                                         /paiement-confirmation.htm                                 // 
// -------------------------------------------------------------------------------------------------- //

case "confirmation":

	$design->zone("titre", "Confirmation de votre commande");
	
	
	$c='<div class="centre">
			<strong>Nous avons recu votre paiement, votre commande vous sera exp�di�e dans les plus brefs d�lais</strong><br /><br />
			
			Nous vous remercions de la confiance accord�e � notre site pour l\'achat de cette commande.<br />
			Vous pourrez suivre l\'�volution de celle-ci � partir de votre espace personnel.<br /><br />
			
			Pour toute correspondance, merci de joindre le num�ro de votre commande : <strong>#'.$_SESSION['commande_id'].'</strong>
			
		</div>';

break;
}	
	
	$design->zone("contenu", $c);

?>