<?php

	$m->design->template(Fonctions::addBdd($_GET['tpl']));

	// On d�finit des titres pour les pages
	switch($_GET['tpl']) {
		case "_quisuisje/accueil":
			$m->design->assign("titrePage", "Qui suis-je ? Programmeur autodidacte et passion� du web");
		break;
		
		case "_cv/accueil":
			$m->design->assign("titrePage", "D�couvres mon CV et mes diff�rentes comp�tences");
		break;
		
		case "_general/plan":
			$m->design->assign("titrePage", "Plan de mon portfolio, Acc�s rapide aux diff�rentes rubriques.");
		break;		
	}	
?>