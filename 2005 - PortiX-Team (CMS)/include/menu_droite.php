<?

// ---------------------------------------------------------- //
//           Configuration des menus de DROITE                //
//                                                            // 
// Pour cr�er un menu, il suffit de mettre le contenu de      //
//  celui ci dans une variable nomm�e $menudroitetxt[x] et    //
//  $menudroitetitre[x] o� X est un m�me nombre pas encore    //
//  utilis�.												  //
// ---------------------------------------------------------- //
//                                                            // 
// Liste des menus d�j� d�finis :							  //
//  1- AUCUN 												  //
// ---------------------------------------------------------- //

$menu_titre=array();
$menu_txt=array();


	// => Mettez ici les diff�rents menus //
	
$menu_titre[1]="Test du Menu 1";
$menu_txt[1]="- <a href=\"".$ixteam['url']."?page=inscription\">Inscription</a><br>Blablabla<br>Blablabla<br>Blablabla<br>Blablabla<br><br>Blablabla<br>Blablabla<br>Blablabla<br>Blablabla";


for ($i=1;$i<=99;$i++){ 
	if (isset($menu_titre[$i])) {
 	$afficher->AddSession($handle,"menud");
    $afficher->setVar($handle,"menud.titre",$menu_titre[$i]);
    $afficher->setVar($handle,"menud.texte",$menu_txt[$i]);
 	$afficher->CloseSession($handle,"menud");
	}
}

?>