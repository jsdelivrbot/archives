<?php

$design->template('simple');

$c='
 <p>
               <img src="images/news/web20.png" style="margin:0pt 20px 20px 0pt; float: left;" id="image_news" alt="News web 2.0" />
               Petite news pour vous annoncer l\'ouverture officielle de mon portfolio et de mon studio de d�veloppement que j\'ai magnifiquement nomm� <b>Studio-dev.fr</b><br /><br />
           </p>
           <p>Vous y trouverez une fiche d�taill�e de mes <a href="?mes-creations" title="Derni�res cr�ations de Yotsumi alias Julien LAFONT">derni�res cr�ations</a>, un formulaire de <a href="?contact" title="Me contacter">contact</a> avanc� ainsi qu\'un petit <a href="?cv" title="CV de Julien LAFONT">cv</a>.<br /><br /></p>
           <p>Plusieurs fonctionnalit�s ne sont pas encore disponible mais sa ne saurait tarder. <br />Si vous souhaitez que j\'expose vos design n\'h�sitez pas � me contacter et nous pourrons surement faire affaire.</p>
		   
		   
<div style="font-size:14px; font-weight:bold; text-align:center">Cette page est destin�e � toutes les personnes commen�ant leur apprentissage dans les technologies du Web 2.0, je vous ait fait une petite s�lection de liens qui vous serviront surement !<br /><br />
<span style="font-size:12px; font-weight:normal">Ces liens ne sont pas une liste de cours, juste des ressources qui vous seront sans doute utiles !</span></div>


<div id="liste_liens">

	<h4 style="annee">Tutoriaux pour commencer</h4>
		<p style="margin-left:30px; border-left:1px solid #09F; padding-left:7px">
			<b>&rsaquo;</b> <a href="http://www.toutjavascript.com/savoir/xmlhttprequest.php3" target="_blank">Tuto par ToutJavascript</a><br />
			<b>&rsaquo;</b> <a href="http://qwix.media-box.net/index.php/2005/01/21/45-XmlhttprequestEtPhp" target="_blank">Tuto par Media-box</a><br />
			<b>&rsaquo;</b> <a href="http://openweb.eu.org/articles/objet_xmlhttprequest/" target="_blank">Tuto par OpenWeb</a><br />
			<b>&rsaquo;</b> <a href="http://www.xul.fr/xml-ajax.html" target="_blank">Tuto par Xul-fr</a><br />
		</p>

	<h4 style="annee">Tutoriaux pour d�veloppeurs avanc�s</h4>
		<p style="margin-left:30px; border-left:1px solid #09F; padding-left:7px">
			<b>&rsaquo;</b> <a href="http://www.aliasdmc.fr/coursjavas/" target="_blank">Ressource pratiques, nottament pour l\'utilisation du DOM</a><br />
			<b>&rsaquo;</b> <a href="http://www.j0k3r.net/" target="_blank">Actualit� et tutoriaux</a><br />
			<b>&rsaquo;</b> <a href="http://javascript.developpez.com/cours/" target="_blank">Les cours les plus int�ressent : Jvs & Ajax par developpez.com</a>	<br />
		</p>	
			
	<h4 style="annee">Librairies javascript d\'effets</h4>
		<p style="margin-left:30px; border-left:1px solid #09F; padding-left:7px">
			<b>&rsaquo;</b> <a href="http://mootools.net/" target="_blank">Effets <b>Mootools</b>, la plus pratique</a><br />
			&nbsp;&nbsp;&nbsp;<b>&rsaquo;</b> <a href="http://fardeen.biz/index.php/tutoriel-mootools-framework-javascript-gratuit/" target="_blank">Tutos pour Mootools</a><br />
			<b>&rsaquo;</b> <a href="http://script.aculo.us/" target="_blank">ScriptAculoUs : Mootools en un peu moins bien, et surtout plus lourd</a><br />
			&nbsp;&nbsp;&nbsp;<b>&rsaquo;</b> <a href="http://www.hadrien.eu/scriptaculous/" target="_blank">Doc traduite en fr pr Scriptaculous</a><br />
			<b>&rsaquo;</b> <a href="http://www.sergiopereira.com/articles/prototype.js.html">Documentation de <b>Prototype</b> ( inclus dans Mootools et Scriptaculous )</a><br />
		</p>
		
	<h4 style="annee">Librairies javascripts modules</h4>
		<p style="margin-left:30px; border-left:1px solid #09F; padding-left:7px">
			<b>&rsaquo;</b> <a href="http://prototype-window.xilinus.com/" target="_blank">Affiche une fenetre en dessus de la page</a><br />
			<b>&rsaquo;</b> <a href="http://www.html.it/articoli/niftycube/index.html" target="_blank">Arrondi les angles d\'un div</a><br />
			<b>&rsaquo;</b> <a href="http://jquery.com/demo/thickbox/" target="_blank">Encore un script affichant une fenetre plus simple mais moins beau</a><br />
			<b>&rsaquo;</b> <a href="http://www.huddletogether.com/projects/lightbox2/" target="_blank">Parfait pour gallerie photo : affiche une photo de fa�on magnifique</a><br />
			<b>&rsaquo;</b> <a href="http://www.digitalia.be/software/slimbox" target="_blank">Pareil que ^ en plus l�ger car utilisant Mootools</a><br />
			<b>&rsaquo;</b> <a href="http://smoothslideshow.jondesign.net" target="_blank">Slideshow d\'images</a><br />
			<b>&rsaquo;</b> <a href="http://smoothgallery.jondesign.net/showcase/gallery/" target="_blank">Idem en plus �volu�</a><br />
		</p>
		
	<h4 style="annee">Divers</h4>
		<p style="margin-left:30px; border-left:1px solid #09F; padding-left:7px">
			<b>&rsaquo;</b> <a href="https://addons.mozilla.org/firefox/1843/" target="_blank"><b>Plugin de d�buggage pour firefox INDISPENSABLE</b></a><br />
			<b>&rsaquo;</b> <a href="http://www.creativyst.com/Prod/3/" target="_blank">Compression du code javascript</a><br />
			<b>&rsaquo;</b>  <a href="http://ajaxload.info/" target="_blank">Cr� un icone de chargement � vos couleurs</a><br />
		</p>
		
	J\'en ait surement oubli� beaucoups d\'int�ressent, je les rajouterais quand ils me reviendront � l\'esprit !
		
</div>
';



$design->zone('contenu', $c);

?>