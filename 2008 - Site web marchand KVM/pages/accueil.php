<?php

/* 
 * KVM E-commerce : / page d'accueil
 *
 * On r�cup�re et met en forme ( en liste ) les produits des diff�rentes zones de la page d'accueil
 * Zone 'Derniers articles', 'Plus populaires', 'Coup de coeur'-> g�r� depuis l'admin
 */
 
	$design->zone('titre', "Bienvenu sur notre site");
	$design->template('accueil');
	
	// Liste des derniers objets ajout�s :
	$li_derniers="";
	$sql_1=mysql_query("SELECT * FROM ".PREFIX."produits ORDER BY id_produit DESC LIMIT 0,6");
	while ($d1=mysql_fetch_object($sql_1)) {
		
		// Gestion de l'image
		if (empty($d1->image)) $imageP=CHEMIN_DEFAUT."no_produit.jpg";
		else $imageP="pages/fonctions/redim.php?imgfile=".recupBdd($d1->image)."&max_height=120&max_width=120";
		
		// On met en forme la liste
		$li_derniers.='<li><a href="article-'.$d1->id_produit.'-'.recode($d1->nom).'.htm" title="Afficher les informations d�taill�es du produit '.recupBdd($d1->nom).'"> 
								<img src="'.$imageP.'" alt="'.recupBdd($d1->nom).'" />
							</a><br />
							<strong>'.recupBdd($d1->nom).'</strong>
					  </li>';

	}
		$design->zone("bloc_produits_derniers_articles", $li_derniers);



	// Liste des objets les plus populaires ( les plus vus )
	$li_populaires="";
	$sql_2=mysql_query("SELECT * FROM ".PREFIX."produits ORDER BY nb_vue DESC LIMIT 0,6");
	if (mysql_num_rows($sql_2)!=0) 
	{
	while ($d2=mysql_fetch_object($sql_2)) {
		
		// Gestion de l'image
		if (empty($d2->image)) $imageP=CHEMIN_DEFAUT."no_produit.jpg";
		else $imageP="pages/fonctions/redim.php?imgfile=".recupBdd($d2->image)."&max_height=120&max_width=120";
		
		// On met en forme la liste
		$li_populaires.='<li><a href="article-'.$d2->id_produit.'-'.recode($d2->nom).'.htm" title="Afficher les informations d�taill�es du produit '.recupBdd($d2->nom).'"> 
								<img src="'.$imageP.'" alt="'.recupBdd($d2->nom).'" />
							</a><br />
							<strong>'.recupBdd($d2->nom).'</strong>
					  </li>';

	}
	}
		$design->zone("bloc_produits_populaires", $li_populaires);
		


	// Liste les objets coup de coeur � partir d'une zone sp�ciale configur�e dans l'admin
	$li_coeur="";
	$sql_pre3=mysql_query("SELECT zone_coup_de_coeur as zone FROM ".PREFIX."produits_accueil");
		$pre3=mysql_fetch_object($sql_pre3);
		if (empty($pre3->zone)) 	$liste=array();
		else				   		$liste=unserialize($pre3->zone);
		
	foreach($liste as $key=>$idProduit) {
		
		// S�lection des infos sur le produit
		$sql_3=mysql_query("SELECT nom, image FROM ".PREFIX."produits WHERE id_produit=$idProduit");
		$d3=mysql_fetch_object($sql_3);
		
		// Gestion de l'image
		if (empty($d3->image)) $imageP=CHEMIN_DEFAUT."no_produit.jpg";
		else $imageP="pages/fonctions/redim.php?imgfile=".recupBdd($d3->image)."&max_height=120&max_width=120";
		
		// On met en forme la liste
		$li_coeur.='<li><a href="article-'.$d3->id_produit.'-'.recode($d3->nom).'.htm" title="Afficher les informations d�taill�es du produit '.recupBdd($d3->nom).'"> 
								<img src="'.$imageP.'" alt="'.recupBdd($d3->nom).'" />
							</a><br />
							<strong>'.recupBdd($d3->nom).'</strong>
					  </li>';

	}
		$design->zone("bloc_produits_coup_de_coeur", $li_coeur);
?>