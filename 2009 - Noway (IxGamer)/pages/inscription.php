<?php
/**
 * Module Inscription
 * Inscription dynamique au site
 *
 * Url : /Inscription/
 */

// On bloque l'acc�s aux personnes d�j� connect�es
if (is_log()) bloquerAcces("Vous �tes d�j� connect�, vous ne pouvez pas acc�der � cette page");

// D�finitions des diff�rentes titres + ajout du fichier javascrpt n�cessaire //
	$design->zone('titrePage', 'Inscription � '.NOM);
	$design->zone('titre', 'Formulaire d\'inscription');
	$design->zone('header', '<script type="text/javascript" src="javascript/-inscription.js" ></script>');


switch(@$_GET['action'])
{

//:: Page affichant le formulaire d'inscription :://
default :
	
	$contenu = '
				<div class="titreMessagerie">Inscription sur le site '.NOM.'.</div>
				<div id="infoInscription">
					
					<span style="font-size:11px">Vous aurez ensuite acc�s � un espace priv� vous permettant de g�rer une messagerie, un guestbook, une liste d\'ami et de nombreuses autres applications.</span><br /><br /><br /><br />
				</div>
	
	
				<form name="inscript" id="inscription" action="?inscription&action=verif" method="post" onsubmit="return verifTotal();">
						<fieldset id="form">';
		
	// Si on a une erreur � afficher.
	if (isset($_SESSION['message'])) {
		$contenu .= '<b style="color:#ec5994"><u>Une erreur est survenue pendant l\'enregistrement de votre compte</u></b>
							  <ul id="mess_error">'.$_SESSION['message'].'</ul>';
		unset($_SESSION['message']);
	}

	$contenu.='<table style="width:100%; border:0">
				<tr>
					<td colspan="2" style="text-align:center"><div id="error"></div></td>
					<td rowspan="6" style="vertical-align:top">
						<div id="fond_astuces_inscription">
							<div id="texte_info">
								
								<img src="images/logo_black_trans_80.png" alt="logo" />
							</div>
						
						</div></td>
				</tr>
				<tr>
					<td style="width:140px"><label for="pseudo">Pseudo</label></td>
					<td style="width:250px"><input type="text" id="pseudo" name="pseudo" style="width:150px" maxlength="20" onfocus="no_efface=0; $(\'#texte_info\').html(\'Votre <span>pseudo</span> sera votre login pour acc�der au site.<br /><br /><b>Astuces</b><br />Entre 3 et 20 catact�res<br />Alphanum�riques et <em>-</em> et <em>_</em>\')" onblur="verifPseudo(); " onkeypress="return valid(event,\'alphanum\');" /></td><!--if (no_efface==0) $(\'texte_info\').innerHTML=\'\'-->
					
				</tr>
				<tr>
					<td><label for="email">Adresse email</label></td>
					<td><input type="text" id="email" name="email" maxlength="50"  onfocus="no_efface=0; $(\'#texte_info\').html(\'Votre <span>adresse email</span>. <br />Nous vous enverrons un lien pour confirmer votre inscription.<br /><br /><b>Astuces</b><br />V�rifiez le dossier <em>SPAM</em>.<br /><em>Hotmail</em> d�conseill� !\')" onblur="verifEmail();" onKeypress="return valid(event,\'email\');" /></td>
				</tr>
				<tr>
					<td><label for="pass1">Mot de Passe</label></td>
					<td><input type="password" id="pass1" name="pass1" style="width:100px" maxlength="20" onfocus="no_efface=0; $(\'#texte_info\').html(\'Entrez votre <span>mot de passe</span>.<br />Entre <em>4</em> et <em>20</em> caract�res alphanum�riques<br /><br />Niveau de s&eacute;curit&eacute; : <a id=Words><table cellpadding=0 cellspacing=2><tr><td height=15 width=150 bgcolor=#eee></td></tr></table></a>\')"  onblur="verifPass1()" onKeypress="return valid(event,\'alphanum\');" onkeyup="testPassword(this.value);" /></td>
				</tr>
				<tr>
					<td ><label for="pass2">Confirmer Mdp</label></td>
					<td><input type="password" id="pass2" name="pass2" style="width:100px" maxlength="20"  onblur="verifPass2()" onKeypress="return valid(event,\'alphanum\');" /></td>
				</tr>
				<tr>
					<td colspan="2"><br /><a class="button" href="#" onclick="if (verifTotal()) document.inscript.submit(); this.blur(); return false"><span>Inscription</span></a></td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;<br /><br /><br /></td>
				</tr>
			</table>
			
		</fieldset>	
		</form>';
						
	$design->zone('contenu', $contenu);
	
break;
#############################################################################################################
//:: Page v�rifiant les champs en PHP ( verif 'rapide' ;) car d�j� faite en jvs ) :://
#############################################################################################################
case "verif":

	if ($_POST) 
	{ 

		$nb_error = 0;
		$error = "";
		
		// S�curisation des variables
		$pseudo = addBdd(strtolower($_POST['pseudo']));
		$email = addBdd($_POST['email']);
		$password = addBdd(strtolower($_POST['pass1']));
		$password_verif = addBdd(strtolower($_POST['pass2']));
		$age=addBdd($_POST['age']);
		$msn=addBdd($_POST['msn']);
		$siteweb=addBdd($_POST['siteweb']);
		$sexe=addBdd($_POST['sexe']);
		
			// Champs n�cessaires remplis ?
			if (empty($pseudo) || empty($email) || empty($password) || empty($password_verif))
				{
					$error .= "<li>Il y a des champs obligatoires non renseign�s</li>";
					$nb_error++;
				}
			
			// Taille du pseudo ?
			if (strlen($pseudo) < 3 || strlen($pseudo) > 20)
				{
					$error .= "<li>Votre Mot de passe ne doit pas �tre inf�rieur � 3 caract�res et ne doit pas en d�passer 20</li>";
					$nb_error++;
				}
				
			// Taille des Mots de passe ?
			if (strlen($password) < 4 || strlen($password) > 20)
				{
					$error .= "<li>Votre Mot de passe ne doit pas �tre inf�rieur � 4 caract�res et ne doit pas en d�passer 20</li>";
					$nb_error++;
				}
				
			// Validit� adresse email ?
			if (!ereg('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+' . '@' . '[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.' . '[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $email))
				{
					$error .= "<li>Votre adresse email doit �tre valide, il vous sera envoy� un mail de validation</li>";
					$nb_error++;
				}
			
			// Mots de passe identiques ?
			if ($password != $password_verif)
				{
					$error .= "<li>Vos deux mots de passe doivent �tre identiques</li>";
					$nb_error++;
				}
				
			// Validit� du pseudo ?
      	    if (ereg ("[^A-Za-z,-_,0-9]", $pseudo))
				{
					$error .= "<li>Votre pseudo contient des caract�res non-autoris�s</li>";
					$nb_error++;
				}
			
			// Pseudo d�j� utilis� ?
			$query = mysql_query('SELECT count(*) as nb FROM '.PREFIX.'membres WHERE pseudo="'.$pseudo.'"') or die(mysql_error());
			$valid = mysql_fetch_object($query);
			if ($valid->nb != 0)
				{
					$error .= "<li>Votre pseudo est d�j� utilis�</li>";
					$nb_error++;
				}
			
			// Email d�j� utilis�e ?
			$query = mysql_query('SELECT count(*) as nb FROM '.PREFIX.'membres WHERE `email`="'.$email.'"')or die(mysql_error());
			$valid = mysql_fetch_object($query);
			if ($valid->nb != 0)
				{
					$error .= "<li>Votre email est d�j� utilis�e</li>";
					$nb_error++;
				}
			
			// V�rification de l'IP ( pas 2 inscriptions avec la m�me ip )
			$query = mysql_query('SELECT count(*) as nb FROM '.PREFIX.'membres WHERE `last_ip`="'.ip().'"')or die(mysql_error());
			$valid = mysql_fetch_object($query);
			if ($valid->nb != 0)
				{
					$error .= "<li>Vous vous �tes d�j� enregistr�</li>";
					$nb_error++;
				}


			if ($nb_error != 0)
				{
					$_SESSION['message']=$error;
					rediriger('inscription/');
				}
			else
				{
					
					// On crypte le mot de passe
					$password_encrypt = crypt( md5($password) , CLE );
					
					$gKey=GenKey();
					
					// On envoie dans la base de donn�e
					$query_main = mysql_query("	INSERT INTO ".PREFIX."membres 
											  		(`pseudo`, `mdp`, `email`, `last_ip`, `last_activity`, `cle`, `groupe`) 
											 	VALUES 
													('$pseudo', '$password_encrypt', '$email', '".ip()."', '".time()."', '$gKey', '0')
											  ") or die('1 '.mysql_error());
					$id_member = mysql_insert_id();
					$query_detail = mysql_query(" INSERT INTO ".PREFIX."membres_detail 
													(`id_membre`) 
												  VALUES 
												 	('$id_member')
												")or die('3 '.mysql_error());
					
$m_message = "
	<html>
	<body>
		Bonjour,<br />
		<br />Vous venez de vous inscrire sur le site de la Team ".NOM.", pour confirmer votre inscription, veuillez suivre le lien ci-dessous.						
		<br /><br />
		Vos identifiants de connexion sont :<br />
		Login: $pseudo<br />
		Password: $password<br />
		<br />
		<b>Activer mon compte :</b><br/>
		<a href='".URL."valider-compte/$id_member-$gKey/'>".URL."valider-compte/$id_member-$gKey/</a><br />
		<br />
		Nous vous souhaitons une bonne journ�e sur ".URL." !
		<br />Le staff ".NOM.".
	</body>
	</html>
";

// Envoie du mail
$m_sujet = "Finalisation de l'inscription au site ".NOM;

if (!@email( $email, $m_sujet, $m_message, '"Inscription '.NOM.'" <robot@'.NOM.'.com>' ))
	$txt = miseEnForme('erreur', 'Erreur durant l\'envoie du mail !');	
						
					if (empty($txt))
						$txt = miseEnForme('message', "<b>Votre inscription s'est d�roul�e avec succ�s.</b><br><br><br>
						Vous devez imp�rativement finaliser votre inscription en cliquant sur le lien pr�sent dans le mail que nous venons de vous envoyer.
						<br /><br />
						<br />
						<span style='color:#FF0000; font-size:10px'>Des probl�mes nous ont �t� signal�s avec les adresses hotmail. <br />
						 N'oubliez pas de regarder dans le dossier spam et soyez patient !<br />
						 Si vous ne recevez aucun mail, utilisez le formulaire contact.</span>
						<br /><br />
						<br />
						<i>Le Staff ".NOM."</i>");
					
					$design->zone('titrePage', "Inscription effectu�e");
					$design->zone('titre', "Confirmation de l'inscription par email");
					$design->zone('contenu', $txt);
  				}
				
	}

break;
#############################################################################################################
//:: Valider un compte :://
#############################################################################################################
case "valid":

// On r�cu�re les infos
$infos=explode('-',$_GET['key']);
	$id=addBdd($infos[0]);
	$cle=addBdd($infos[1]);
	
	if (empty($id) || empty($cle) || empty($_GET['key']))
	{
		$design->zone('contenu', miseEnForme( 'erreur', "Erreur de r�cup�ration") );
		$design->zone('titre', "Erreur");
	}
	else
	{
	
		$sql = mysql_query("SELECT count(id) as nb FROM ".PREFIX."membres WHERE `id`='".$id."' AND `cle`='".$cle."' AND `groupe`='0'");
		$data = mysql_fetch_object($sql);
		
		if ($data->nb == 1)
			{
				$maj = mysql_query("UPDATE ".PREFIX."membres SET groupe='1' WHERE `id`='".$id."'");
				
				$txt = "<b>Merci d'avoir activ� votre compte.</b><br><br><br>
						Vous pouvez maintenant vous connecter � ".URL."<br><br>
						N'oubliez pas de remplir vos informations publiques sur la page 'mon compte'<br><br>
						Bon surf !";			
				$design->zone('contenu', miseEnForme( 'message', $txt ) );
				$design->zone('titre', "Compte activ� avec succ�s !");
			}
		else
			{
				$design->zone('contenu', miseEnForme( 'erreur', 'Erreur de correspondance avec la cl� : '.$_GET['key']) );
				$design->zone('titre', "Erreur");
			}
	}
	
	$design->zone('titrePage', "Inscription valid�e");
	

break;
}
?>