<?php

   // ----------------------------------------------------------------------- //
  //                         Configuration du site                           //
 // ----------------------------------------------------------------------- //

		//:: Connexion Mysql :://
		define('HOTE', "localhost");
		define('LOGIN', "root");
		define('PASS', "");
		define('BASE', "faistonchoix");
		define('PREFIX', "iuf_");
		
		//:: Adresse d'acc�s :://
		define('URL', "http://127.0.0.1/TopOuFlop/");
		define('URL_REL', "/TopOuFlop/");
			// URL : url d'acc�s absolu avec slash final
		 	// URL_REL = Url relative : "/dossier1/" . Si acc�s direct, laisser vide

		
//:: Configuration facultative :://
define('PAGE_DEFAUT', "accueil");
define('CLE',"yot");
define('SEPARATOR','|:|'); /* jvs */
define('TEMPLATE_DEFAULT','accueil'); // Th�me par d�faut
define('COMPRESSER_CODE', 0); // Permet d'afficher le code source du site sur une ligne

define('DUEL', URL.'upload/duels/');
define('PHOTO', URL.'upload/photos/');
define('MIN', URL.'upload/minTheme/');

//:: D�finition les diff�rents groupes d'utilisateurs
define('GROUPE_BAN','9');
define('GROUPE_ADMIN','5');
define('GROUPE_ANIM','4');

//:: Nombres de points attribu�s aux diff�rentes actions
define('PT_VOTE', 1);
define('PT_SOUMISSION', 5);
define('PT_SOUMISSION_IMAGE', 10);
define('PT_MEMBRE_BRONZE', 50); /* -> 50 votes */
define('PT_MEMBRE_ARGENT', 100); /* -> 200 votes */
define('PT_MEMBRE_OR', 250); /* --> 500 votes */
define('PT_MEMBRE_PLATINIUM', 500); /* --> 700 votes, 6 mois d'anciennet�, >20 soumissions */

//:: Connexion Mysql :://
$db = mysql_connect(HOTE, LOGIN, PASS) or die ("<b>Erreur de connexion</b>");
mysql_select_db(BASE, $db) or die ("<b>Erreur de connexion base</b>");
?>