<?php

//----------------------------------------------------------
//-- Zones identiques des templates
//----> Pub pas de page
//----> Partenaires
//----------------------------------------------------------

	$pub_bas='<br /><SCRIPT TYPE="text/javascript" LANGUAGE="Javascript" SRC="http://pub.oxado.com/insert_ad?pub=84289"></SCRIPT>';
	$design->zone('pub_bas_page', $pub_bas);
		
	$partenaires='
		<a href="http://www.sego-ou-sarko.fr" title="Pour qui voteras tu ? D�cide qui sera le cyber vainqueur du duel des titans S�go contre Sarko !" target="_blank"><b>Sego-ou-Sarko ?</b></a> - 
		<a href="http://www.wixblog.com" target="_blank"  title="Tu reves d\'avoir ton propre blog? Avec Wixblog cr�e ton blog �volutif en moins de 5 minutes">Wixblog</a> : Service de blog Web 2.0 - 
		<a href="http://www.semencemag.fr" target="_blank" title="Semencemag.fr, le magazine du monde v�g�tal">Semence Mag</a> - 
		<a href="http://veryoutube.free.fr" target="_blank" title="VerYoutube | Les vid�os les plus comiques de Youtube, Wid�o et Dailymotion">VerYouTube</a>';
	$design->zone('partenaires', $partenaires);


//----------------------------------------------------------
//-- Bloc 'Espace Kdos' : colonne de droite
//-- + Formulaire de connexion si invit�, infos membres si d�j� connect�
//-- + Connexion automatique par cookies si n�cessaire
//----------------------------------------------------------

	// Si le membre n'est pas connect� mais a un cookies, on le connecte
	if (!$_SESSION['log_id'] AND $_COOKIE['log_email']) {       ####-- COPIE DANS MEMBRES_AJAX.PHP POUR CONNEXION NORMALE --####
	 
		$email=addBdd($_COOKIE['log_email']);
		$sql=mysql_query("SELECT * FROM ".PREFIX."membres WHERE email='".$email."'");
		$d=mysql_fetch_object($sql);
		
		// S�lection les duels d�j� vot�s:
		$sqlVote=mysql_query("SELECT id_duel FROM ".PREFIX."verifduel WHERE ip='".ip()."' OR email='".$email."'");
		while ($vote=mysql_fetch_object($sqlVote)) {
			$_SESSION['log_vote'][$vote->id_duel]=true;
		}
		
		$_SESSION['log_email']=$email;
		setcookie('log_email', $_GET['email'], (time() + 604800), URL_REL); /* 7j */
		$_SESSION['log_id']=$d->id;
	}

// Si l'utilisateur n'est pas connect�
if (!$_SESSION['log_id']) {
	
	$kdo='<br /><a href="informations_concours.htm" onclick="afficher_concours(); return false" title="Afficher les informations sur le concours"><img src="images/pub.png"  style="border:1px solid #ccc; padding:2px"/></a><br /><br />
	<fieldset id="form_log_email">
		 <legend style="color:#666"><span style="color:#0099FF">G</span>agner des Kdos</legend>  
		 <span style="color:#333">Pour participer au tirage au sort, entrez votre email et gagnez des points !</span><br />
		<input type="text" name="email" id="email" class="form_email" value="Entrez votre email" onclick="if (this.value==\'Entrez votre email\') this.value=\'\';"/>&nbsp;&nbsp;<a href="#" onclick="login(); return false">OK</A>
	</fieldset>';

// Si il est d�j� connect�
} else {
	
	// On rcup�re le nombre de points et la position dans le classement
	$sqlKdos=mysql_query("SELECT * FROM ".PREFIX."membres WHERE id=".$_SESSION['log_id']." AND email='".$_SESSION['log_email']."'");
		$kdos=mysql_fetch_object($sqlKdos);
	$sqlPos=mysql_query("SELECT count(*) as pos FROM ".PREFIX."membres WHERE points>".$kdos->points);
		$pos=mysql_fetch_object($sqlPos);
	
	if (($pos->pos+1)==1) 	$position="1�re";
	else 					$position=($pos->pos+1)."�me";
	
	if ($kdos->points>PT_MEMBRE_PLATINIUM) $bonus=' <img src="images/level4.png" alt="level 4" style="vertical-align:middle"/><br />';
	elseif ($kdos->points>PT_MEMBRE_OR) $bonus=' <img src="images/level3.png" alt="level 3"  /><br />';
	elseif ($kdos->points>PT_MEMBRE_ARGENT) $bonus=' <img src="images/level2.png"  alt="level 2" /><br />';
	elseif ($kdos->points>PT_MEMBRE_BRONZE) $bonus=' <img src="images/level1.png"  alt="level 1" /><br />';
	else $bonus='';

	$kdo='<br />
	<fieldset id="form_log_email">
		<legend><span style="color:#0099FF">G</span>agner des Kdos</legend>
		<table id="tableStats">
			<tr>
				<td>Bonjour <b>'.recupBdd($_SESSION['log_email']).'</b><br /><br />
					<b id="nbPoints"> '.$bonus.''.$kdos->points.'</b> points <br /><b id="position">'.$position.'</b> position</td>
				<td style="width:16px;"><a href="#" onclick="refreshScore(); return false" class="no" title="Mettre � jour mes Stats"><img src="images/recur.png" /></a><a href="#" onclick="deconnexion(); return false" class="no" title="Me d�connecter"><img src="images/aim_online.png" /></a></td>
			</tr>
		</table>
	</fieldset>';
}
$design->zone('espace_kdos', $kdo);	
		

//----------------------------------------------------------
//-- Bloc 'Th�mes duels' : colonne de gauche
//-- Affiche les 6 derniers th�mes configur�s dans l'admin
//----------------------------------------------------------


	$sqlThemes=mysql_query("SELECT * FROM ".PREFIX."themes WHERE afficher=1 ORDER BY ID ASC LIMIT 0,6");
	$themes="";
	$i=0;
	while ($theme=mysql_fetch_object($sqlThemes)) {
		$themes.='<li id="liTheme'.$theme->id.'"><a href="theme-'.recode(recupBdd($theme->nom)).'-'.$theme->id.'.htm" title="Acc�der aux duels du th�me '.recupBdd($theme->nom).' sur Faistonchoix.fr" onclick="ouvrir_theme('.$theme->id.'); return false" ><img src="'.MIN.$theme->miniature.'" style="width:70px; height:70px" id="minTheme'.$theme->id.'" /></a><br /><b>'.recupBdd($theme->nom).'</b></li>';
		$i++;
	}
	if ($i!=6) {
		$sqlNonAff=mysql_query("SELECT * FROM ".PREFIX."themes WHERE afficher=0 ORDER BY ID DESC LIMIT 0,".(6-$i) );
		while ($theme2=mysql_fetch_object($sqlNonAff)) {
			$themes.='<li id="liTheme'.$theme2->id.'"><a href="#Th�me_non_disponible" title="Le th�me '.recupBdd($theme2->nom).' n\'est pas encore disponible" onclick="return false" ><img src="'.MIN.$theme2->miniature.'" style="width:70px; height:70px ;filter: alpha(opacity=50);  -moz-opacity: 0.5;-khtml-opacity: 0.5;opacity: 0.5;" id="minTheme'.$theme2->id.'" /></a><br /><b style="color:#AAA">'.recupBdd($theme2->nom).'</b></li>';
		}
	}
	$design->zone('themes_duels', $themes);


//----------------------------------------------------------
//-- Bloc 'Derniers duels' : colonne du milieu
//-- Affiche la liste d�croissante des derniers duels 
//----------------------------------------------------------

	$sqlDuels=mysql_query("SELECT id, nom1, nom2, date FROM ".PREFIX."duels ORDER BY id DESC LIMIT 0,10");
	$duels="";
	$i=1;
	while ($duel=mysql_fetch_object($sqlDuels)) {
	
		// Si l'utilisateur n'est pas connect� mais � un compte ( ip ), on liste tout les votes d�j� effectu�s
		if (!$_SESSION['log_vote']) { 
			$sqlVote=mysql_query("SELECT id_duel FROM ".PREFIX."verifduel WHERE ip='".ip()."'");
			while ($vote=mysql_fetch_object($sqlVote)) {
				$_SESSION['log_vote'][$vote->id_duel]=true;
			}
		}
		
		// D�j� vot� ?
		if ($_SESSION['log_vote'][$duel->id]==true) $vote="<b id='indic".$duel->id."'>&bull;</b>";
		else										$vote="<u id='indic".$duel->id."'>&bull;</u>";
		
		// Mise en forme de la liste
		if ($i==1) 		$plus=''; 
		elseif ($i==10) $plus='<a href="#" onclick="liste_suivant(); return false" title="Voir les autres duels"><img src="images/fleche_bas.gif" style="float:right; margin-top:-15px" alt="news"/></a>';
		else 			$plus='';
		
		if (!$first) $first=$duel->id;
		$last=$duel->id;
		
		$duels.='<li>'.$vote.' <a href="duel-'.recode(recupBdd($duel->nom1)).'_ou_'.recode(recupBdd($duel->nom2)).'-'.$duel->id.'.htm" title="Afficher le duel '.recupBdd($duel->nom1).' contre '.recupBdd($duel->nom2).'" onclick="afficher_duel('.$duel->id.'); return false" title="Afficher le duel : '.recupBdd($duel->nom1).' VS '.recupBdd($duel->nom2).'"><span>'.$duel->date.'</span> '.recupBdd($duel->nom1).' <i>ou</i> '.recupBdd($duel->nom2).'</a> '.$plus.'</li>';
		$i++;
	}
	$design->zone('derniers_duels', '<h3 id="nom_cat2">Derniers duels</h3>	
									 <ul id="liste_duels" style="height:228px; ">'.$duels.'</ul>');
	$design->zone('lastDuel', $last);
	$design->zone('firstDuel', $first);
	
	
//----------------------------------------------------------
//-- Menu 'Administrateur' et 'Animateur'
//-- Menu Derni�res propositions
//----------------------------------------------------------

	if ($_SESSION['sess_admin']) {
	
		// Menu Animateur
		if ($_SESSION['sess_level']==4) 
			$design->zone('menu_admin', 
			'<ul id="nav"><li><a href="?admin-accueil">Accueil de l\'admin</a></li>
			<li><a href="?admin-duels">G�rer les duels</a></li>
			<li><a href="?admin-propositions">G�rer les propositions</a></li>
			<li><a href="?admin-themes">G�rer les th�mes</a></li>
			<li><a href="?admin-stats">Statistiques</a></li>
			<li><a href="?admin-deco">D�connexion</a></li></ul>');
		
		// Menu Administrateur
		if ($_SESSION['sess_level']>=5) 
			$design->zone('menu_admin', 
			'<ul id="nav"><li><a href="?admin-accueil">Accueil de l\'admin</a></li>
			<li><a href="?admin-duels">G�rer les duels</a></li>
			<li><a href="?admin-propositions">G�rer les propositions</a></li>
			<li><a href="?admin-themes">G�rer les th�mes</a></li>
			<li><a href="?admin-membres">G�rer les membres</a></li>
			<li><a href="?admin-stats">Statistiques</a></li>
			<li><a href="?admin-sitemap">G�n�rer Sitemap</a></li>
			<li><a href="?admin-deco">D�connexion</a></li></ul>');
		
		// Derni�res propositions
		$sqlProp=mysql_query("SELECT * FROM ".PREFIX."propositions WHERE etat=0 OR etat=1 ORDER BY id DESC LIMIT 0,10");
		$nb=mysql_num_rows($sqlProp);
		$liste='<div class="box">
				<h2 style="">Derni&egrave;res propositions</h2>
					<ul>';
		if ($nb==0) $liste.='<li>Pas de nouvelles propositions';
		while ($d=mysql_fetch_object($sqlProp)) {
			$liste.="<li>".$d->nom1." vs ".$d->nom2."</li>";		
		}
		$design->zone('last_prop', $liste.'</ul></div>');
	}

?>