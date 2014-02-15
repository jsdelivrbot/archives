<?php
/**
 * Module Files
 * Affiche la liste des m�dias et fichers / ou un m�dia en d�tail
 *
 * Url : /Files/
 *       
 */


$design->template('files');

//::::: Page principale - Affichage de la liste des m�dias ::::://
if ($_GET['arg1']!="download" && $_GET['arg1']!="detail")
{

	// 1- Deniers m�dias
	if ($_GET['arg1']=="demos" || empty($_GET['arg1']))
	{

		$sql=mysql_query("SELECT * FROM ".PREFIX."demos ORDER BY id DESC");
		
		$c='<h2 class="titre">Demos In-Eyes et HLTV</h2>';
		
		$nb=mysql_affected_rows();
		if ($nb==0) $c.='<br \><center>Aucun m�dia disponible</center><br /><br />';
		
		else
		{
			$c.='<table id="listeMedias" cellspacing="0" cellpadding="0">
					<tr>
						<td class="top" style="text-align:left; width:30px"></td>
						<td class="top" style="width:90px">Date</td>
						<td class="top" style="width:70px">Demo</td>
						<td class="top" >Match</td>
						<td class="top" style="text-align:center;width:40px">Size</td>
						<td class="top" style="text-align:right; width:50px">Dl</td>
					</tr>';
			while ($d=mysql_fetch_object($sql)) {
			
				if ($d->cat=="hltv") $demo="HLTV"; else $demo="In-Eyes";
				
				$match=NULL;
				if ($d->player) $match.="<b>".recupBdd($d->player)."</b> <span style='color:#09F'>vs</span> ";
				if ($d->pays)   $match.='<img src="'.CHEMIN_PAYS.$d->pays.'.gif"> ';
								$match.="<b>".recupBdd($d->versus)."</b>";
				if ($d->map)	$match.=" <span style='font-size:10px; color:#666'>on ".$d->map."</span>";
			
	
				$c.='<tr class="in">
						<td style="text-align:left"><img src="'.CHEMIN_JEU.$d->jeu.'.png" /></td>
						<td style="font-size:9px">'.inverser_date($d->date,4).'</td>
						<td style="font-size:9px">'.$demo.'</td>
						<td><a href="files/demos/detail-'.$d->id.'-'.recode(recupBdd($d->player)).'-vs-'.recode(recupBdd($d->versus)).'.htm" title="D�mos : Afficher les infos sur le m�dia '.recupBdd($d->player).' vs '.recupBdd($d->versus).'">'.$match.'</a></td>
						<td style="font-size:10px; text-align:center;">'.$d->taille.' mo</td>
						<td style="text-align:right;">'.$d->nb_dl.' &nbsp;<a href="files/demos/detail-'.$d->id.'-'.recode(recupBdd($d->player)).'-vs-'.recode(recupBdd($d->versus)).'.htm" title="D�mos : Afficher les infos sur le m�dia '.recupBdd($d->player).' vs '.recupBdd($d->versus).'"><img src="images/boutons/download2.png" style="vertical-align:middle" /></a></td>
	
					 </tr>';
			}
			$c.='</table>';
		}
					
		
		$design->zone('contenu', $c);
		$design->zone('titrePage', 'Demos et HLTV');
		$design->zone('titre', 'M�dias de la team '.NOM);
	
	}
	else 
	{
		// 2- Movies
		// 3- Files et Softwares
		// 4- Others
		
		if ($_GET['arg1']=="movies") {
			$design->zone('titrePage', 'Gaming Movies');
			$c='<h2 class="titre">Gaming movies</h2>';
		} else if ($_GET['arg1']=="files") {
			$design->zone('titrePage', 'Files et Softwares');
			$c='<h2 class="titre">Files et Softwares</h2>';
		} else if ($_GET['arg1']=="others") {
			$design->zone('titrePage', 'Fichiers divers');
			$c='<h2 class="titre">Fichiers divers</h2>';
		} else bloquerAcces('Acc�s interdit ! ');

		
		// Requ�te SQL de s�lection des fichiers dans la cat�gorie
		$sql=mysql_query("SELECT * FROM ".PREFIX."files_movies WHERE cat='".addBdd($_GET['arg1'])."' ORDER BY id DESC");
		$nb=mysql_affected_rows();
		if ($nb==0) $c.='<br \><center>Aucun m�dia disponible</center><br /><br />';
		
		else
		{
			$c.='<table id="listeMedias" cellspacing="0" cellpadding="0">
					<tr>
						<td class="top" style="width:110px">Date</td>
						<td class="top" >Nom</td>
						<td class="top" style="text-align:center;width:70px">Size</td>
						<td class="top" style="text-align:right; width:60px">Dl</td>
					</tr>';
			while ($d=mysql_fetch_object($sql)) {			
	
				$c.='<tr class="in">
						<td style="font-size:9px">'.inverser_date($d->date,4).'</td>
						<td style="font-size:9px"><a href="files/'.$_GET['arg1'].'/detail-'.$d->id.'-'.recode(recupBdd($d->nom)).'.htm" title="'.$_GET['arg1'].' : Infos sur le fichier '.recupBdd($d->nom).'">'.recupBdd($d->nom).'</td>
						<td style="font-size:10px; text-align:center;">'.$d->taille.' mo</td>
						<td style="text-align:right;">'.$d->nb_dl.' &nbsp;<a href="files/'.$_GET['arg1'].'/detail-'.$d->id.'-'.recode(recupBdd($d->nom)).'.htm" title="'.$_GET['arg1'].' : Infos sur le fichier '.recupBdd($d->nom).'"><img src="images/boutons/download2.png" style="vertical-align:middle" /></a></td>
	
					 </tr>';
			}
			$c.='</table>';
		}
		
		$design->zone('contenu', $c);

	}

}

//::::: Fiche d�taill�e ::::://
if ($_GET['arg1']=="detail")
{
	   $id=(int)$_GET['id'];
	   $cat=$_GET['cat'];
	   
	   // S�lection de la base de donn�e
	   if ($cat=="demos") $catSql="demos";
	   else				  $catSql="files_movies";
	   
	   $sql=mysql_query("SELECT * FROM ".PREFIX.$catSql." WHERE id=$id");
	   $d=mysql_fetch_object($sql);
	   
	   // Image t�l�charger : diff�rence si connect� ou non
	   if (is_log()) 
	   	$telecharger='<center>
						 <a href="files/'.$cat.'/download-'.$d->id.'-'.recode(recupBdd($d->nom)).'.htm" title="T�l�charger '.$cat.' : Infos sur le fichier '.recupBdd($d->nom).'"><img src="images/download3.png" /></a>
					   </center>';
	   else
	   	$telecharger='<center>
						 <img src="images/no-download.png" /><br />
					   </center>';
	
        //  Si le m�dia est une vid�o, on met en forme les champs sp�cifiques ( MAP / Match )
	   if ($cat=="demos") {
	   			$match=NULL;
				if ($d->player) $match.=recupBdd($d->player).' vs ';
				if ($d->pays)   $match.='<img src="'.CHEMIN_PAYS.$d->pays.'.gif"> ';
								$match.=recupBdd($d->versus);
				if ($d->map)	{ $match.=" on ".$d->map."";
								  $imgMap="<img src='".CHEMIN_MAPS.$d->map.".jpg' alt='".$d->map."' class='effect' style='float:left; margin:0 15px 10px  25px' />";
								  $labelMapJeu="<br/><b>Jeu / Map</b>";
								  $infoMapJeu='<br /><img src="'.CHEMIN_JEU.$d->jeu.'.png" style="vertical-align:middle"/> on '.$d->map;
								}
				else 			{
							      $labelMapJeu="<br /><b>Jeu</b>";
								  $infoMapJeu='<br /><img src="'.CHEMIN_JEU.$d->jeu.'.png" style="vertical-align:middle"/>';
								}
				
	}

	   $c='
	    <div id="infoInscription" style="font-size:14px">
			
			<div class="titreMessagerie" style="color:#222">'.stripslashes(@$d->nom).@$match.'</div>
			Fiche du m�dia
		   </div><br />
		   
		   <table class="fichier_detail">
		    <tr>
			 <td style="width:150px ; line-height:10px" valign="top">
			 		<br /><br /><b>Ajout� le</b><br /><br />
			 		<b>Nb T�l�chargements</b><br /><br />
					<b>Taille du fichier</b><br />
					'.@$labelMapJeu.'
					</td>
			 <td style="width:200px; line-height:10px" valign="top">
			 		<br /><br />'.inverser_date($d->date, 6).'<br /><br />
					'.$d->nb_dl.' fois<br /><br />
					'.recupBdd($d->taille).' mo<br />
					'.@$infoMapJeu.'
			 	</td>
			 <td>'.$telecharger.'</td>
			</tr>
		   </table>
		   
		   
		  '.@$imgMap.'
		  
		<p style="margin-left:10px; padding-left:3px">
				<b>Infos suppl�mentaires</b><br /><br />
		  		'.nl2br(recupBdd($d->description)).'
			</p><br /><br />';
		   
	$design->zone('contenu', $c);
	$design->zone('titrePage', 'MEDIAS');
	$design->zone('titre', 'M�dias de la team '.NOM);

}

//::::: Compteur download ::::://
if ($_GET['arg1']=="download")
{
	securite_membre();
	
	$id=(int)$_GET['id'];
	if (empty($id)) die("Acc�s interdit !");
	
	$cat=$_GET['cat'];
	   
	   // S�lection de la base de donn�e
	   if ($cat=="demos") $catSql="demos";
	   else				  $catSql="files_movies";
	
	  $sql=mysql_query("UPDATE ".PREFIX.$catSql." SET nb_dl=nb_dl+1 WHERE id=$id");
	  
	  $sql2=mysql_query("SELECT url FROM ".PREFIX.$catSql." WHERE id=$id");
	  $d=mysql_fetch_object($sql2);
	  
	$fichier = recupBdd($d->url);
	header('location: '.$fichier);		
		
}



?>