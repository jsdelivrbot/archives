<?php
securite_membre();

$design->zone('titrePage', 'Mes amis !');
$design->zone('titre', 'G�rer mes ami(e)s');
$design->zone('header', '<script type="text/javascript" src="include/js/-amis.js"></script>
						 <script type="text/javascript" src="include/js/-bulle_infos.js" ></script>');

switch(@$_GET['action'])
{
default:
	$sqlAmis=mysql_query("SELECT amis FROM ".PREFIX."membres_detail WHERE id_membre=".$_SESSION['sess_id']);
	$amis=mysql_fetch_object($sqlAmis);
		$listeAmis=explode("-", $amis->amis);
		
	$contenu='<div id="curseur" class="infobulle"></div>
			<div id="amis">
				<h5>Liste de mes amis</h5>
				<ul>';

		if (count($listeAmis>0) && $listeAmis[0]!="")
		{
			$i=0;
			foreach($listeAmis as $idAmi)
			{
				$sql=mysql_query("	SELECT m.pseudo, m.last_activity, md.gen_sexe
									FROM ".PREFIX."membres m 
									LEFT JOIN ".PREFIX."membres_detail md
									ON md.id_membre=m.id
									WHERE m.id=$idAmi");
				$d=mysql_fetch_object($sql);
				
				// Sexe - Online ?
				$img=imgOnline($d->gen_sexe, $d->last_activity);	
				
				($i%2==0) ? $class="a" : $class="b";
				$i++;
				
				$contenu.='<li class="'.$class.'" id="li'.$idAmi.'"><img src="images/'.$img.'" /> <a href="#" onclick="infoAmi('.$idAmi.'); return false">'.ucfirst($d->pseudo).'</a></li>';
			
			}
		}
		else
		{
			$contenu.='<li class="a">Vous n\'avez ajout� aucun ami.</li>';
		}	
				
	$contenu.='	</ul>
			</div>';
	
	$design->zone('contenu', $contenu);

break;
################################################################################################
// ------------------------- Invitation accept�e + ajout du demandeur  -------------------------
################################################################################################
case "accepterAll":

	$infos=explode('-', $_GET['id']);
		$id=(int)$infos[0];
		$cle=$infos[1];

	// On r�cup�re les infos sur l'�change
	$sql=mysql_query("SELECT * FROM ".PREFIX."amis_temp WHERE id=$id");
	$d=mysql_fetch_object($sql);
		$idFrom=$d->demandeur;
		$idFutur=$d->futur_ami;

	// On v�rifie que la requ�te est autoris�e
	if ($cle!=$d->cle) die("Acc�s interdit");
		
	// On s'occupe du demandeur (from)
	$sqlFrom=mysql_query("SELECT amis FROM ".PREFIX."membres_detail WHERE id_membre=$idFrom");
	$from=mysql_fetch_object($sqlFrom);
		
		if (!empty($from->amis)) $tabloF=explode('-', $from->amis);
		else $tabloF=array();
		
		# on v�rifie que le membre n'a pas d�j� cet ami
		if (!in_array($idFutur, $tabloF))
		{
			$tempTab=array_reverse($tabloF);
			array_push($tempTab, $idFutur);
			$newTab=array_reverse($tempTab);
			$newListF=implode("-", $newTab);	
			mysql_query("UPDATE ".PREFIX."membres_detail SET amis='$newListF' WHERE id_membre=$idFrom");
		}

		
	// On s'occupe du Futur ami
	$sqlFutur=mysql_query("SELECT amis FROM ".PREFIX."membres_detail WHERE id_membre=$idFutur");
	$futur=mysql_fetch_object($sqlFutur);
		
		# on v�rifie que le membre n'a pas d�j� cet ami
		if (!in_array($idFutur, $tabloF))
		{
			$tempTab=array_reverse($tabloFF);
			array_push($tempTab, $idFrom);
			$newTab=array_reverse($tempTab);
			$newListFF=implode("-", $newTab);
		mysql_query("UPDATE ".PREFIX."membres_detail SET amis='$newListFF' WHERE id_membre=$idFutur");
		}


	// On envoie un MP au demandeur pour confirmer
	$dest=$idFrom;
	$etat='auto';
	$sujet=ucfirst($_SESSION['sess_pseudo']). " a accept� votre invitation";
	$message='	Vous avez envoy� une invitation � '.$_SESSION['sess_pseudo'].' pour l\'ajouter � votre liste d\'ami.<br /><br />
				Nous somme heureux de vous annoncer que votre invitation a �t� <b>accept�e.</b><br /><br />
				De plus ce membre vous a lui aussi ajout� � sa propre liste d\'amis.';		
	envoyerMp($dest, addslashes($sujet), addslashes($message), $etat);
	
	// On supprime l'ajout sql temporaire 
	$del=mysql_query("DELETE FROM ".PREFIX."amis_temp WHERE id=$id") or die("erreur suppr : ".mysql_error());
	
	// On affiche un message confirmant l'ajout.
	$contenu=miseenforme('message', '	Ce membre vient d\'�tre ajout� � votre liste d\'amis de m�me que vous avez �t� ajout� � la sienne !<br /><br />
										Bon surf sur D4team.com !');
	$design->zone('contenu', $contenu);
	
break;
################################################################################################
// ------------------------------------ Invitation accept�e -----------------------------------
################################################################################################
case "accepter":

	$infos=explode('-', $_GET['id']);
		$id=(int)$infos[0];
		$cle=$infos[1];
	
	// On r�cup�re les infos sur l'�change
	$sql=mysql_query("SELECT * FROM ".PREFIX."amis_temp WHERE id=$id");
	$d=mysql_fetch_object($sql);
		$idFrom=$d->demandeur;
		$idFutur=$d->futur_ami;
	
	// On v�rifie que la requ�te est autoris�e
	if ($cle!=$d->cle) die("Acc�s interdit");

	// On s'occupe du demandeur (from)
	$sqlFrom=mysql_query("SELECT amis FROM ".PREFIX."membres_detail WHERE id_membre=$idFrom");
	$from=mysql_fetch_object($sqlFrom);
		
		if (!empty($from->amis)) $tabloF=explode('-', $from->amis);
		else $tabloF=array();
		
		# on v�rifie que le membre n'a pas d�j� cet ami
		if (!in_array($idFutur, $tabloF))
		{
			$tempTab=array_reverse($tabloF);
			array_push($tempTab, $idFutur);
			$newTab=array_reverse($tempTab);
			$newListF=implode("-", $newTab);	
			mysql_query("UPDATE ".PREFIX."membres_detail SET amis='$newListF' WHERE id_membre=$idFrom");
		}
	
		/*$tabloF=explode('-', $from->amis);
		# on v�rifie que le membre n'a pas d�j� cet ami
		if (!in_array($idFutur, $tabloF))
		{
			$tempTab=array_reverse($tabloF);
			array_push($tempTab, $idFutur);
			$newTab=array_reverse($tempTab);
			$newListF=implode("-", $newTab);	
			if (count($newTab)==1) $newListF=substr($newListF, 0, -1);
		}*/
	
	
		
	// On envoie un MP au demandeur pour confirmer
	$dest=$idFrom;
	$etat='auto';
	$sujet=ucfirst($_SESSION['sess_pseudo']). " a accept� votre invitation";
	$message='	Vous avez envoy� une invitation � '.$_SESSION['sess_pseudo'].' pour l\'ajouter � votre liste d\'ami.<br /><br />
				Nous somme heureux de vous annoncer que votre invitation a �t� <b>accept�e.</b>';		
	envoyerMp($dest, addslashes($sujet), addslashes($message), $etat);
	
	// On supprime l'ajout sql temporaire 
	mysql_query("DELETE * FROM ".PREFIX."amis_temp WHERE id=$id");

	// On affiche un message confirmant l'ajout.
	$contenu=miseenforme('message', '	Vous venez d\'�tre ajout� � la liste d\'amis de ce membre avec succ�s.<br /><br />
										Bon surf sur D4team.com !');
	$design->zone('contenu', $contenu);

break;
################################################################################################
// ------------------------------------- Invitation refus�e ------------------------------------
################################################################################################
case "refuser":
	
	$infos=explode('-', $_GET['id']);
		$id=(int)$infos[0];
		$cle=$infos[1];
	
	// On r�cup�re les infos sur l'�change
	$sql=mysql_query("SELECT * FROM ".PREFIX."amis_temp WHERE id=$id");
	$d=mysql_fetch_object($sql);
	
	// On v�rifie que la requ�te est autoris�e
	if ($cle!=$d->cle) die("Acc�s interdit");
	
	// On envoie un MP au demandeur pour confirmer
	$dest=$d->demandeur;
	$etat='auto';
	$sujet=ucfirst($_SESSION['sess_pseudo']). " a refus� votre invitation";
	$message='	Vous avez envoy� une invitation � '.$_SESSION['sess_pseudo'].' pour l\'ajouter � votre liste d\'ami.<br /><br />
				Nous sommes dans le regret de vous apprendre que ce membre a <b>refus�</b> d\'�tre ajout� dans votre liste d\'ami.</b>';
	envoyerMp($dest, addslashes($sujet), addslashes($message), $etat);

	// On supprime l'ajout sql temporaire 
	mysql_query("DELETE * FROM ".PREFIX."amis_temp WHERE id=$id");
	
	// On affiche un message confirmant l'ajout.
	$contenu=miseenforme('message', '	Vous venez de refuser l\'invitation de ce membre.<br /><br />
										Bon surf sur D4team.com !');
	$design->zone('contenu', $contenu);

}
?>