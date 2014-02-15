<?php

	$m->design->assign('nomSite', NOM);
	$m->design->assign('baseUrl', URL);
	$m->design->assign('footer', FOOTER);
	$m->design->assign('infos_mbre', $m->mbre->infos());


	//-- Passage de variable --//
	/* Connect� ? */  $m->design->assign('est_connecte', $m->mbre->est_log());
	/* Admin ? */     $m->design->assign('est_admin', $m->mbre->est_admin());
	
	
	// Bloc derni�res actus
	$n = new News($m);
	$m->design->assign('actus', $n->lister_news_bloc(4));
	
	// Cat�gories et pages
	$p = new Page($m);
	$m->design->assign('menu', $p->lister_menu());
	
?>