<?php

if ($_GET['username']==null AND $_GET['pseudo']==null AND empty($_GET['id'])) {
	rediriger('?p=erreur&code=03');
}

// On g�re les priorit�s ( username > id )
@$us=$_GET['username'];
@$ps=$_GET['pseudo'];
@$id=$_GET['id'];

if (isset($us) AND isset($id)) $where="`username`='".addslashes($us)."'";
else if (isset($ps)) $where="`username`='".addslashes($ps)."'";
else if (isset($us)) $where="`username`='".addslashes($us)."'";
else if (isset($id)) $where="`id_membre`='". (int)$id."'";

// V�rif si le membre existe
$sql_pre=mysql_query("SELECT count(id_membre) as nb FROM members WHERE $where");
$nbb=mysql_fetch_object($sql_pre);
if( $nbb->nb==0 ) rediriger('?p=erreur&code=05');

head('<link rel="stylesheet" type="text/css" href="include/effet/niftyCorners.css">
<link rel="stylesheet" type="text/css" href="include/effet/niftyPrint.css" media="print">
<script src="include/script.js" type="text/javascript"></script>
<script type="text/javascript" src="include/effet/nifty.js"></script>');

echo '<script type="text/javascript">
window.onload=function(){
if(!NiftyCheck())
    return;
Rounded("div.round","all","#B4E4E6","#FFFFFF","smooth");
}

function round() {
	if(!NiftyCheck())
		return;
	Rounded("div.round","all","#B4E4E6","#FFFFFF","smooth");
}

</script>';

$sql=mysql_query("SELECT * FROM members WHERE ".$where);
$data=mysql_fetch_object($sql);

	if ($data->active==0) header('location: ?p=erreur&code=9'); 
	if ($data->active==9) header('location: ?p=erreur&code=10'); 
	
	// Conditions pour afficher la photo
	if(is_log()==1) {
		if (isset($data->img_principale) AND $data->img_valid==1 ) {
			$photo="<img src='upload/principal/$data->img_principale' id='img'>";
		} else {
			$photo="<img src='images/profil/nophoto.png' id='img'>";
		}
	} else {
		if ($data->gender=="h") {
			$photo="<img src='images/profil/nophoto_h.png' id='img'>";
		} else {
			$photo="<img src='images/profil/nophoto_f.png' id='img'>";
		}
	}
	
	// G�rer le Online/Offline
	$temps=time()-1200; // 20mn
	if ($data->lastdate<$temps) {$sqlmaj=mysql_query("UPDATE members SET `online`=0 WHERE $where"); $status="<img src='images/profil/offline.png' align='absmiddle'> ".ucfirst($data->username)." est <b style='color:#FF0000'>offline</b>"; }
	else if ($data->online==1 ) {$status="<img src='images/profil/online.png' align='absmiddle'> ".ucfirst($data->username)." est <b style='color:#30A600'>online</b>"; }
	else { $status="<img src='images/profil/offline.png' align='absmiddle'> ".ucfirst($data->username)." est <b style='color:#FF0000'>offline</b>"; }
	if ($data->username==$_SESSION['sess_pseudo']) { $sqlmaj=mysql_query("UPDATE members SET `online`=1, `lastdate`='".time()."' $where"); $status="<img src='images/profil/online.png' align='absmiddle'> ".ucfirst($data->username)." est <b style='color:#30A600'>online</b>"; }
	
		  if ($data->poid=="1") $z="Pr�f�re ne pas r�pondre";
		  if ($data->poid=="2") $z="Mince";
		  if ($data->poid=="3") $z="En forme";
		  if ($data->poid=="4") $z="Muscl�(e)";
		  if ($data->poid=="5") $z="Dans la moyenne";
		  if ($data->poid=="6") $z="Quelques livres en trop";
		  if ($data->poid=="7") $z="Corpulant(e)";
			if ($data->status=="1") $s="C�libataire";
			if ($data->status=="2") $s="En couple";
			if ($data->status=="3") $s="Mari�";
			if ($data->status=="4") $s="Divorc�";
			if ($data->status=="5") $s="Ouvert aux sugestions";
		if ($data->yeux=="1") $y="Bleu";
		if ($data->yeux=="2") $y="Vert";
		if ($data->yeux=="3") $y="Pairs";
		if ($data->yeux=="4") $y="Brun";
		if ($data->yeux=="5") $y="Noisette";
		if ($data->yeux=="6") $y="Je sais pas";
		  if ($data->chx=="1") $w="Brun";
		  if ($data->chx=="2") $w="Chatain";
		  if ($data->chx=="3") $w="Noir";
		  if ($data->chx=="4") $w="Brun";
		  if ($data->chx=="5") $w="Blond";
		  if ($data->chx=="6") $w="Autre";
	  if ($data->bois=="1") $b="Tr�s souvent";
	  if ($data->bois=="2") $b="R�guli�rement";
	  if ($data->bois=="3") $b="Desfois";
	  if ($data->bois=="4") $b="Jamais";
	  if ($data->bois=="5") $b="Non mes parents ne veulent pas !";
	  if ($data->bois=="6") $b="Pr�f�re ne pas r�pondre";
		if ($data->fume=="1") $f="Oui";
		if ($data->fume=="2") $f="Non";
		if ($data->fume=="3") $f="De temps en temps";
		if ($data->fume=="4") $f="Pr�f�re ne pas r�pondre";
	  if ($data->orientation=="1") $o="H�t�ro";
	  if ($data->orientation=="2") $o="Bi";
	  if ($data->orientation=="3") $o="Gay";
	  if ($data->orientation=="4") $o="Lesbienne";
	  if ($data->orientation=="5") $o="Je ne sais pas";
	  	if ($data->cherche=="f") $ch="une <span style='color:#FF00FF; font-family:georgia''>femme</span>";
		if ($data->cherche=="h") $ch="un <span style='color:#0066FF; font-family:georgia''>homme</span>";
	  	if ($data->cherche=="hf") $ch="une <span style='color:#FF00FF; font-family:georgia'>femme</span> ou un <span style='color:#0066FF; font-family:georgia'>homme</span>";
		if ($data->cherche=="p") $ch="<span style='font-family:georgia'>personne :)</span>";
		if ($data->cherche=="") $ch="non-sp�cifi�";
	if ($data->amitie==1) $type="- D�velopper une amiti�<br>";
	if ($data->activites==1) @$type.="- Partenaire d'activit�s<br>";
	if ($data->relationct==1) @$type.="- Une relation � court terme<br>";
	if ($data->relationlt==1) @$type.="- Une relation � long terme<br>";
	if ($data->amusement==1) @$type.="- S'amuser<br>";
	if ($data->sexe==1) @$type.="- Relation sexuelle";
	if (empty($type)) $type="Non Sp�cifi�";

	if (is_log()==0) {
		$lien2=$lien3=$lien4="document.getElementById('fonctions').innerHTML='<center><b style=\'color:#FF6600\'><br>Vous devez �tre inscrit pour acc�der � ces fonctions</b><br><br><a href=\'?p=inscription\'>S\'inscrire</a><br><br></center>';round(); return false";
		$lien1="href='#' onClick=\"document.getElementById('fonctions').innerHTML='<center><b style=\'color:#FF6600\'><br>Vous devez �tre inscrit pour acc�der � ces fonctions</b><br><br><a href=\'?p=inscription\'>S\'inscrire</a><br><br></center>';round(); return false\"";
	} else {
		$lien4='sms1(\''.ucfirst($data->username).'\'); return false';
		$lien3='vote1(\''.ucfirst($data->username).'\'); return false';
		$lien2='mess1(\''.ucfirst($data->username).'\'); return false';
		$lien1='href="?p=galerie&pseudo='.ucfirst($data->username).'"';

	}

                     
	echo '
	<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH=90% height=50 >
			<PARAM NAME=movie VALUE="images/title.swf?text='.ucfirst($data->username).'">
			<PARAM NAME=quality VALUE=high> <PARAM NAME=wmode VALUE=transparent> <PARAM NAME=menu VALUE=true>
			<EMBED src="images/title.swf?text='.ucfirst($data->username).'" quality=high wmode=transparent bgcolor=#00CCFF WIDTH=100% height=50 TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" menu="false"></EMBED>
		   </OBJECT>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td width="1%"></td>
              <td valign="top" width="56%">
			  	<table border="0" cellpadding="0" cellspacing="0" width="95%">
                  <tbody>
                    <tr>
                      <td valign="top"><div align="center">
                          <p></p>
                          <center>
                           '.$photo.'
                          </center>
                          <br>
                          Note : <b id="bloc_note">'.round($data->note,1).'/10</b>, avec <span id="bloc_coeff">'.$data->coeff_note.'</span> votes.<br>
						  '.$status.'</div><br></td>
                    </tr>
                  </tbody>
                </table>
                  <table border="0" cellpadding="0" cellspacing="0" width="95%">
                    <tbody>
                      <tr>
                        <td valign="top" width="60%"><div align="center">
                          <div align="left">
                              <table bgcolor="#4e84b9" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                  <tr>
                                    <td colspan="3" bgcolor="#ffffff" height="2"></td>
                                  </tr>
                                  <tr>
                                    <td width="10">&nbsp;</td>
                                    <td class="tblanc" width="560">D&eacute;cris toi en g&eacute;n&eacute;ral . </td>
                                    <td align="right" valign="top" width="10">&nbsp;</td>
                                  </tr>
                                </tbody>
                              </table>
                              '.stripslashes($data->about).'
                              <table bgcolor="#e5edf5" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                  <tr>
                                    <td align="right" width="20">&nbsp;</td>
                                    <td class="Label" width="550"><div align="right"><em>Ta personalit&eacute; ton apparence . </em></div></td>
                                    <td align="right" valign="top" width="10">&nbsp;</td>
                                  </tr>
                                </tbody>
                              </table>
                              <br>
                              <table bgcolor="#4e84b9" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                  <tr>
                                    <td colspan="3" bgcolor="#ffffff" height="2"></td>
                                  </tr>
                                  <tr>
                                    <td width="10">&nbsp;</td>
                                    <td class="tblanc" width="560">Ce que tu recherche sur Mon-Look . </td>
                                    <td align="right" valign="top" width="10">&nbsp;</td>
                                  </tr>
                                </tbody>
                              </table>
                              '.stripslashes($data->recherchetxt).'
                              <table bgcolor="#e5edf5" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                  <tr>
                                    <td align="right" width="20">&nbsp;</td>
                                    <td class="Label" width="550"><div align="right"><em>Tu recherche quel type de relation . </em></div></td>
                                    <td align="right" valign="top" width="10">&nbsp;</td>
                                  </tr>
                                </tbody>
                              </table>
                              <br>
                              <table bgcolor="#4e84b9" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                  <tr>
                                    <td colspan="3" bgcolor="#ffffff" height="2"></td>
                                  </tr>
                                  <tr>
                                    <td width="10">&nbsp;</td>
                                    <td class="tblanc" width="560">Ce que tu aime faire . </td>
                                    <td align="right" valign="top" width="10">&nbsp;</td>
                                  </tr>
                                </tbody>
                              </table>
                              '.stripslashes($data->occupations).'
                              <table bgcolor="#e5edf5" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                  <tr>
                                    <td align="right" width="20">&nbsp;</td>
                                    <td class="Label" width="550"><div align="right"><em>Que fait tu de ta vie tes loisirs . </em></div></td>
                                    <td align="right" valign="top" width="10">&nbsp;</td>
                                  </tr>
                                </tbody>
                            </table>
                            <center>
                            </center>
                            </div>
                        </div></td>
                      </tr>
                    </tbody>
                </table>
                  <br>
				  
				  
				  
				  
          	<div id="fonctions" class="round" style="width:95%; background-color:#FFFFFF; ">
				<center><b style="color:#FF6600">� � Actions disponibles � �</b></center><br>';
	// Condition acc�der galerie ( Ya des photos ? )
	$sql_tof=mysql_query("SELECT count(id) as nbtof FROM photos WHERE pseudo='$data->username'");
	$datanb=mysql_fetch_object($sql_tof);
	if ($datanb->nbtof!=0)
				echo '<div>
					<table id="infos"><tr><td width=50><a '.$lien1.'><img src="images/profil/photo.png" align="absmiddle"></a></td>
					 <td style="text-align:center; font-size:12px; color:#0066FF"><a '.$lien1.'>Visionner la galerie photo de '.ucfirst($data->username).'</a></td></tr></table>
				</div>';
	else
				echo '<div>
					<table id="infos"><tr><td width=50><img src="images/profil/photo.png" align="absmiddle"></td>
					 <td style="text-align:center; font-size:12px; color:#0066FF">Aucune photo dans la galerie de '.ucfirst($data->username).'</td></tr></table>
				</div>';

	// Condition Envoyer un SMS ( Pas � soi m�me , Num portable d�finis)
	if ($_SESSION['sess_pseudo']!=$data->username AND !empty($data->portable)) echo '
			<div>
					<table id="infos" style="width:100%"><tr><td width=50><a href="#" OnClick="'.$lien4.'"><img src="images/profil/sms.png" align="absmiddle"></a></td>
					 <td style="text-align:center; font-size:12px; color:#0066FF"><a href="#" OnClick="'.$lien4.'">Ecrire un SMS � '.ucfirst($data->username).'</a></td></tr></table>
				</div>';
	
	// Condition �crire un message ( Pas � soi m�me )
	if ($_SESSION['sess_pseudo']!=$data->username) echo '
			<div>
					<table id="infos" style="width:100%"><tr><td width=50><a href="#" OnClick="'.$lien2.'"><img src="images/profil/message.png" align="absmiddle"></a></td>
					 <td style="text-align:center; font-size:12px; color:#0066FF"><a href="#" OnClick="'.$lien2.'">Envoyer un message � <br>'.ucfirst($data->username).'</a></td></tr></table>
				</div>';
				
	// Condition Vote ( d�j� vot� ? - A une photo ? )
	$sql2=mysql_query("SELECT count(de) as nb FROM verif_vote WHERE `de`='".$_SESSION['sess_id']."' AND `a`='".$data->id_membre."'");
	$dat=mysql_fetch_object($sql2);
	if ($dat->nb==0 && $data->id_membre!=$_SESSION['sess_id'] AND isset($data->img_principale) AND $data->img_valid==1) echo '
				<div>
					<table id="infos" style="width:100%"><tr><td width=50><a href="#" OnClick="'.$lien3.'"><img src="images/profil/note.png" align="absmiddle"></a></td>
					 <td style="text-align:center; font-size:12px; color:#0066FF"><a href="#" OnClick="'.$lien3.'">Attribuer une note � <br>'.ucfirst($data->username).'</a></td></tr></table>
				</div>';
		
		echo'</div>
                  </td>
              <td width="40%" valign="top">
			  
			  
			  <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="margin-right:4px; padding-right:4px; ">

                    <tr>
                      <td style="background-color:#4e84b9; height:20px; text-align:center; border:1px solid #FFFFFF; color:#FFFFFF" >Profil de <b style="color:#CAF965" id="ajax_speudo">'.ucfirst($data->username).'</b></td>
                    </tr>
                    <tr>
                      <td width="100%" valign="top" style="border-left:1px solid #FFFFFF; border-right:1px solid #FFFFFF; border-bottom:1px solid #FFFFFF; background-color:#D5F0FF; padding:2px; line-height:15px; color:#111111; font-family:verdana">';
					  
					   if (isset($data->fname)) echo'<strong>Pr&eacute;nom</strong> : '.ucfirst($data->fname).'<br>';
					   if (isset($data->age))  echo'<strong> Age</strong> : '.$data->age.' ans<br><br>';
					   if (isset($data->country))  echo'<strong>Pays</strong> : '.ucfirst($data->country).'<br>';
					   if (isset($data->city))  echo'<strong>Ville</strong> : '.ucfirst($data->city).'<br><br>';
					   if (isset($data->taille))  echo'<strong>Taille</strong> : '.$data->taille.'pi ou '.round($data->taille*(30.48)).'cm<br>';
					   if (isset($z))  echo'<strong>Corpulence</strong> : '.$z.'<br>';
					   if (isset($y))  echo'<strong>Yeux</strong> : '.$y.'<br>';
					   if (isset($w))  echo'<strong>Cheveux</strong> : '.$w.'<br><br>';
					   if (isset($b))  echo'<strong>Bois-tu ? </strong> : '.$b.'<br>';
					   if (isset($f))  echo'<strong>Fume-tu ? </strong> : '.$f.'<br><br>';
					   if (isset($s))  echo'<strong>Situation</strong> : '.$s.'<br>';
					   if (isset($o))  echo'<strong>Orientation </strong> : '.$o.'<br><br>';
					   if (isset($data->joindate))  echo'<strong>Inscription </strong> : '.inverser_date($data->joindate,4).'<br>';
					   if (isset($data->lastdate))  echo'<strong>Derni�re connexion </strong> : '.difference_date($data->lastdate).'<br>';
					  echo'</td>
                    </tr>
					</table><br>
					
		  <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="margin-right:4px; padding-right:4px; ">

		<tr>
		  <td style="background-color:#4e84b9; height:20px; text-align:center; border:1px solid #FFFFFF; color:#FFFFFF" >Ses motivations</td>
		</tr>
		<tr>
		  <td width="100%" valign="top" style="border-left:1px solid #FFFFFF; border-right:1px solid #FFFFFF; border-bottom:1px solid #FFFFFF; background-color:#D5F0FF; padding:2px; line-height:15px; color:#111111; font-family:verdana">
		  <center><b>'.ucfirst($data->username).'</b> recherche '.$ch.' pour :</center>  <br>
		  <div style="font-size:10px">'.$type.'</div>
		  </td>
		  
		</tr>
		                
              </table></td>
            </tr>
          </tbody>
        </table>
		<div id="id" style="display:none">'.$data->id_membre.'</div>';
	
foot();	

?>