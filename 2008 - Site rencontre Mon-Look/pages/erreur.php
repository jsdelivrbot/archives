<?php

switch($_GET['code']) {
	case "01":
		$erreur="Vous n'�tes pas enregistr� ! <br><br>Veuillez vous connecter pour acc�der � votre espace personnel";
	break;
	case "02":
		$erreur="L'adresse Ip utilis� lors de votre connexion n'est plus la m�me que celle avec laquelle vous tentez d'acc�der � cette page.<br><br><b>Par mesure de s�curit�, vous avez �t� d�connect�</b><br><br>Merci de bien vouloir vous reconnecter avec vos indentifiants.";
	break;
	case "03":
		$erreur="Vous n'�tes pas autoris� � afficher cette page directement..";
	break;
	case "04":
		$erreur="Erreur lors de l'authentification !";
	break;
	case "05":
		$erreur="L'utilisateur indiqu� n'existe pas !";
	break;
	case "06":
		$erreur="Aucun membre n'entre dans les crit�res de s�lection de cette cat�gorie/recherche.";
	break;
	case "07":
		$erreur="Recherche incorrecte !";
	break;
	case "08":
		$erreur="<u>Erreur</u> : correspondance introuvable dans le champs `search_secure` ";
	break;
	case "09":
		$erreur="Vous ne pouvez pas visionner ce profil, le compte n'a pas encore �t� activ� ! ";
	break;
	case "10":
		$erreur="Ce membre a d�cid� de cloturer son compte sur Mon-Look";
	break;
}

	head();
	echo '<br><br>
	<div class="erreur">
		'.$erreur.'</div><img src="images/px.gif" height="150" width="1">';
	foot();

?>
