
<?
// SERVEUR SQL
$sql_serveur="sql.free.fr";
// LOGIN SQL
$sql_user="sniperman";
// MOT DE PASSE SQL
$sql_passwd="";
// NOM DE LA BASE DE DONNEES
$sql_bdd="sniperman";

// CONNEXION A LA BASE DE DONNEE
$db_link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd) or die ('erruer 1');
if(!$db_link) {echo "Connexion impossible � la base de donn�es <b>$sql_bdd</b> sur le serveur <b>$sql_server</b><br>V�rifiez les param�tres du fichier conf.php3"; exit;}

// on calcule la date
$date1=date("d F Y - H i s");

// ON REMPLIS TOUT SA !
$requete=mysql_db_query($sql_bdd,"insert into quiz2 values (\"$pseudo\",\"$points\",\"arme\",\"$REMOTE_ADDR\",\"$date1\")",$db_link) or die(mysql_error());
mysql_close();

echo "R�sultat Envoy� avec succ�s !";
?>
