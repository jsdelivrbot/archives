<?php
securite_membre();

	$smyl='<img src="images/smyl/petitsmyl2.png" style="vertical-align:middle">';
switch($_GET['act']) {
default:

	$add='<link rel="stylesheet" type="text/css" href="include/effet/niftyCorners.css">
		<link rel="stylesheet" type="text/css" href="include/effet/niftyPrint.css" media="print">
		<script type="text/javascript" src="include/effet/nifty.js"></script>';
		
head($add);
	
	echo '<script type="text/javascript">
	window.onload=function(){
	if(!NiftyCheck())return;
	Rounded("div.round","all","#B4E4E6","#FFFFFF","smooth");}
	function round() {
		if(!NiftyCheck())return;
		Rounded("div.round","all","#B4E4E6","#FFFFFF","smooth");
	}
	</script>';

	echo '<h3>Smyl\'Center '.$smyl.'</h3><br><br>
	<table width="100%" border=0>
		<tr>
			<td width="20"></td>
			<td><div style="width:100%; background-color:#FFFFFF; margin-left:auto; margin-right:auto" class="round" >
					<div style="margin:5px; color:#666; font-size:11px; line-height:18px">
					 C\'est � partir de cet espace que vous pourrez dans quelques jours g�rer vos <b>smyl\'cr�dits.</b><br><br>
					 
					 Le smyl\' '.$smyl.', correspond � la monaie d\'�change sur Mon-Look, c\'est comme des � ou des $ sauf que �a ne vous coute rien :)<br>
					 En effet, le point essentiel � retenir est que vous pouvez acqu�rir des '.$smyl.' <b>sans d�penser un seul centime !</b><br><br>
					 
					<u>Que faire avec mes '.$smyl.' ? </u><br>
					D�s l\'ouverture du Smyl\'Center, vous pourrez �changer vos '.$smyl.' contre des <span style="color:#F33">SMS</span> � envoyer aux autres membres de Mon-Look, participer � des <span style="color:#F33">tirages au sort</span>, agrandir votre espace personnel : <span style="color:#F33">BLOG</span>, vid�o, BuddyList ...<br><br>
					
					<u>Et comment acqu�rir ces '.$smyl.' ? </u><br>
					Plusieurs m�thodes seront disponibles, gratuites pour la plupart. Par exemple, cliquer sur les <span style="color:#F33">pubs</span> de nos sponsors vous rapportera des point quotidiennent, r�pondre � des campagnes publicitaires, ou encore <span style="color:#F33">parrainer</span> de nouveaux membres. <br>De plus, nous mettrons aussi � votre disposition des moyens d\'acqu�rir des '.$smyl.' plus rapidement gr�ce aux syst�mes Allopass et <span style="color:#F33">Paypal</span>.<br><br>
										
					Bien entendu, vous n\'avez ici qu\'un r�sum� des possibilit�s qui seront offertes par Mon-Look, vous en saurez plus quand le <b>Smyl\'Center</b> sera officiellement lanc� !<br>
										</div>

			</div></td>
			<td width="20"></td>
		</tr>
	</table>';
	
foot();



break;
}