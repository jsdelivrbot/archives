<?php /* Smarty version 2.6.18, created on 2008-11-07 13:59:26
         compiled from index.tpl */ ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="utf-8"<?php echo '?>'; ?>

<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Optix.com : En route vers une vision d'avenir - Lunettes-écrans révolutionnaires !</title>
	<link rel="stylesheet" href="styles_min.css?<?php echo time(); ?>*$" type="text/css" />
    <script type="application/javascript" src="javascript/librairies/jquery.js"></script>
    <script type="application/javascript" src="javascript/librairies/jquery_ui.js"></script>
    <script type="application/javascript" src="javascript/general.js?<?php echo time(); ?>"></script>

    <meta name="description" content="Avec optix, découvrez une façon révolutionnaire de naviguer sur internet, de regarder la télé ou encore d'être guider par GPS !" />
    <meta name="keywords" content="optix, lunettes, high tech, ...." />
    <meta name="author" content="Julien LAFONT" />

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body>

<div class="connexion">

	<div class="c">
    	    	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_blocs/login.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    	
    </div>
    
</div>
       
<div class="global"> 

	<div class="page">
		

        <div class="onglet"><img src="templates/images/lock.png" alt="lock" /> <a href="#"  class="infobulle2" title="Ouvrir le panneau de Connexion">Intranet</a></div>
        
        <div class="deco_fleche"></div>
        
		<div class="header">
		
			<h1 class="logo"><a href="accueil.htm" title="Retour à la page d'accueil Orpix"><strong>Lunettes de réalité virtuelles</strong></a></h1>

		</div>
		
		
		<div class="cadre">
			<div class="h"></div>
			
			<div class="degrade">
			
				<div class="contenu">
                	
                                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['page']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    
 				</div>
				
			</div>
			
			<br class="clear" />
			<div class="b"></div>
		</div>
        
        <div class="right">
        <div class="search">
			<form method="post" action="#">
            	<fieldset>
					<input type="text" class="text infobulle2" name="search" value="Rechercher" title="Effectuer une recherche|Inscrivez les mots clés puis validez." onfocus="if (this.value=='Rechercher') this.value='';" />
					<input type="submit" class="submit" value="GO" />
                </fieldset>
			</form>
		</div>
			
			
        <div class="menu">
        
        	<div class="h"></div>
            <div class="c">
            	<div class="contenu">
                
                	<a href="accueil.htm" title="Retourner à la page d'accueil " class="infobulle" style="margin:0 10px 0 20px"><img src="templates/images/home.png" alt="Accueil" /></a>
                    <a href="contact.htm" title="Contacter la société Optix " class="infobulle" style="margin-right:10px"><img src="templates/images/mail.png" alt="Email"/></a>
                    <a href="rss.xml" title="Abonnement au flux RSS " class="infobulle" ><img src="templates/images/rss.png" alt="RSS" /></a>
                    
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_blocs/menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                   
                </div>
            </div>
            <br class="clear" />
            <div class="b"></div>

        </div>
        
        </div>
        
        <br class="clear" />
   </div>
   
   
   <div class="footer">
   		<div class="deco_footer"></div>
    
        <div class="englobe">
        
            <div class="bloc marge">
             	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_blocs/actus.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
             </div>
             
             
            <div class="bloc">
            	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_blocs/equipes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

            </div>
            
            
            <div class="bloc">
            	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_blocs/partenaires.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>
            
        </div>
        
        <br class="clear" />
        
   </div>

   <div class="copyright">Copyright Optix 2008 - Tous droits réservés - Réalisation par <a href="#" title="#">Studio-Dev</a> - <a href="plan-du-site.htm" title="Accéder au plan du site">Plan du site</a></div>

</div>

</body>
</html>