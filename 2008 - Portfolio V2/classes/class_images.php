<?php

class images
{
	// On d�clare les constantes
	const DEFAULT_LARGEUR = 140;
	const DEFAULT_HAUTEUR = 140;
	const DEFAULT_NV_NOM = '';
	const DEFAULT_PREFIX = '';
	const DEFAULT_SUFFIX = '';
	const DEFAULT_NOM_CHAMPS = 'file';
	const DEFAULT_DESTINATION = '.';
	const DEFAULT_TAILLE_MAX = 3072000; // en octet => 3mo
	const DEFAULT_URL = false;
	const CHEMIN_TEMP = "upload/temp/";
	
	// Les attribus
	private $nom_champs; 
	private $raccourci_tmp;
	private $destination; // Repertoire de destination
	private $taille_max; // Taille maximale de l'image
	private $type_aut; // Tableau contenant les types d'image autoris�s
	private $type; // Type du fichier encours
	private $ext_aut; // Tableau contenant les noms des extensions autoris�s
	private $largeur; // Largeur de l'image
	private $hauteur; // Hauteur de l'image
	private $nv_nom; // Nouveau nom
	private $ext; // L'extension du fichier upload�
	private $pref; // Prefixe � ajouter
	private $suff; // Sufixe � ajouter
	private $url; // Mettre � true si nom_cchamps est une url
	private $chemin_temp;
	private $nom_temp;
	
	function __construct($array)
	{
		$this->largeur = self::DEFAULT_LARGEUR;
		$this->hauteur = self::DEFAULT_HAUTEUR;
		$this->nv_nom = self::DEFAULT_NV_NOM;
		$this->pref = self::DEFAULT_PREFIX;
		$this->suff = self::DEFAULT_SUFFIX;
		$this->nom_champs = self::DEFAULT_NOM_CHAMPS;
		$this->destination = self::DEFAULT_DESTINATION;
		$this->taille_max = self::DEFAULT_TAILLE_MAX;
		$this->type_aut = array('1', '2', '3'); // Types d'image autoris�s: 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = WBMP, 7 & 8= TIFF, 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF
		$this->ext_aut = array('gif', 'jpg', 'png', 'bmp'); // Les extensions autoris�es
		$this->url = self::DEFAULT_URL;
		$this->chemin_temp = self::CHEMIN_TEMP;
		
		if(isset($array) && is_array($array))
		{
			foreach($array as $c => $v)
			{
				$this->$c = $v;
			}
		}
		
		if ($this->url===false) $this->raccourci_tmp = $_FILES[$this->nom_champs]['tmp_name'];
		else					$this->raccourci_tmp = $_POST[$this->nom_champs];		
		
	}
	
	function executer()
	{
		if($this->existe() === false)
		{
			throw new Exception('Il n\'y a pas de fichier � charger !');
		}
		
		if($this->extension() === false)
		{
			throw new Exception('Ce type de fichier n\'est pas autoris� !');
		}
		
		if($this->type() === false)
		{
			throw new Exception('Ce type de fichier n\'est pas autoris� !');
		}
		
		if($this->poids() === false)
		{
			throw new Exception('Le poid de l\'image est sup�rieur � '.($this->taille_max/1024).' Ko');
		}
		
		if($this->dim() === false)
		{
			if($this->redim() === false)
			{
				throw new Exception('La largeur/hauteur de l\'image est grande !');
			}
		}
		else
		{
			if($this->copier() === false)
			{
				throw new Exception('Erreur lors de la copie du fichier !');
			}
		}
		
		// Supprime fichier temporaires
		if ($this->url===true) {
			@unlink($this->chemin_temp.$this->nom_tmp);
		}
	}
	
	function existe()
	{
		// D'abord on v�rifie si le fichier existe, s'il est upload� en m�moire
		// Si le fichier existe dans le dossier tmp...
		if(
			$this->url===false && ( !empty($_FILES[$this->nom_champs]['tmp_name']) && is_uploaded_file($_FILES[$this->nom_champs]['tmp_name']) )
			OR
			$this->url==true && ( !empty($_POST[$this->nom_champs]) ) 
		  )	
		{
			return true;
		}
		else
		{
			// Sinon on affiche l'erreur
			return false;
		}
		
	}
	
	function extension()
	{
		// On r�cup�re l'extension
		if ($this->url===false)
			$this->ext = strtolower(array_pop(explode(".", $_FILES[$this->nom_champs]['name'] )));
		else
			$this->ext = strtolower(array_pop(explode(".", $_POST[$this->nom_champs])));


		if ($this->url===true) {
		
			if(!is_dir($this->chemin_temp))
				{
					mkdir($this->chemin_temp, 0777);
					chmod($this->chemin_temp, 0777);
				}

			$newNom=GenKey(25).".".$this->ext;
			copy($this->raccourci_tmp, $this->chemin_temp.$newNom);
			$this->raccourci_tmp =$this->chemin_temp.$newNom;
			$this->nom_tmp=$newNom;

		}
					
		// Et on v�rifie si elle figure parmis les extensions autoris�es
		if(!empty($this->ext) && in_array(strtolower($this->ext), $this->ext_aut))
		{
			return true;
		}
		else
		{
			// Sinon on affiche l'erreur
			return false;
		}
		

	}
	
	function type()
	{
		// On v�rifie maintenant le type de l'image � l'aide de la fonction getimagesize()
		list($largeur, $hauteur, $this->type) = getimagesize($this->raccourci_tmp);
		
		// Si le $this->type de l'image figure parmis ceux autoris�s
		if(in_array($this->type, $this->type_aut))
		{
			return true;
		}
		else
		{
			// Sinon: "Le type de fichier est incorrect!!", on affiche l'erreur
			return false;
		}
	}
	
	function poids()
	{
		//On v�rifie la taille (le poids) du fichier avec "filesize()" pour plus de s�curit� encore
		if(filesize($this->raccourci_tmp) < $this->taille_max)
		{
			return true;
		}
		else
		{
			// Sinon on affiche l'erreur
			return false;
		}
	}
	
	function dim()
	{
		// On v�rifie maintenant les dimensions de l'image � l'aide de la fonction getimagesize()
		list($largeur, $hauteur) = getimagesize($this->raccourci_tmp);

		if($largeur <= $this->largeur && $hauteur <= $this->hauteur)
		{
			return true;
		}
		else
		{	
				// Sinon on affiche l'erreur
				return false;
		}
	}
	
	function redim()
	{
		//On essaye de redimensionner
		// On v�rifie d'abord si la librairie GD est activ�e
		if(extension_loaded('gd'))
		{
			// Si oui, on lance la m�thode pour redimensionner
			// Calcule des nouvelles dimensions
			list($largeur_orig, $hauteur_orig) = getimagesize($this->raccourci_tmp);
			
			// Un peu des math�matiques...
		$ratioWidth = $largeur_orig/$this->largeur;
		$ratioHeight = $hauteur_orig/$this->hauteur;
	
		if (($ratioWidth > 1) || ($ratioHeight > 1))
		{
			if( $ratioWidth < $ratioHeight) {
				$largeur = $largeur_orig/$ratioHeight;
				$hauteur = $this->hauteur;
			} else {
				$largeur = $this->largeur;
				$hauteur = $hauteur_orig/$ratioWidth;
			}
		} else {
			$largeur = $largeur_orig;  $hauteur = $hauteur_orig;
		}
		
			// Redimensionnement
			//copie avec la fonction "imagejpeg" pour le format jpg, "imagepng" pour les png et "imagegif" pour les gif. Les formats les plus utilis�s et qui sont support�s par la gd
			// $this->renommer(): cette m�thode retourne le nouveau nom s'il est mentionn� sinon retourne le nom original
				
			$image_finale = imagecreatetruecolor($largeur, $hauteur);

					
			switch ($this->type)
			{
				case 1 :
					$image_orig = imagecreatefromgif($this->raccourci_tmp);
					imagecopyresampled ( $image_finale, $image_orig, 0, 0, 0, 0, $largeur, $hauteur, $largeur_orig, $hauteur_orig );
					return imagegif($image_finale, $this->destination.'/'.$this->renommer());
				break;
	
				case 2 :
					$image_orig = imagecreatefromjpeg($this->raccourci_tmp);
					imagecopyresampled ( $image_finale, $image_orig, 0, 0, 0, 0, $largeur, $hauteur, $largeur_orig, $hauteur_orig );
					return imagejpeg($image_finale, $this->destination.'/'.$this->renommer(), 100);
				break;
	
				case 3 :
					$image_orig = imagecreatefrompng($this->raccourci_tmp);
					imagecopyresampled ( $image_finale, $image_orig, 0, 0, 0, 0, $largeur, $hauteur, $largeur_orig, $hauteur_orig );												
					return imagepng($image_finale, $this->destination.'/'.$this->renommer());
				break;
			}
		}
	}

	function copier()
	{
		// On copie le fichier dans le r�pertoire de destination
		if ($this->url===false) {
			if(!@move_uploaded_file($this->raccourci_tmp, $this->destination.'/'.$this->renommer()))
			{
				return false;
			}
		}
		else
		{
			if(!@copy($this->raccourci_tmp, $this->destination.'/'.$this->renommer()))
			{
				return false;
			}		
		}
	}

	function renommer()
	{
		// On renomme le fichier si le nouveau nom est fourni sinon on laisse
		if ($this->url===false) 
			($this->nv_nom == '')?$this->nv_nom = $_FILES[$this->nom_champs]['name']:$this->nv_nom = $this->nv_nom;
		else
			($this->nv_nom == '')?$this->nv_nom = $this->nom_tmp:$this->nv_nom = $this->nv_nom;
		
		// On verifie que le nom n'est pas d�j� utilis�
		while (file_exists($this->destination.$this->nv_nom)) {
			$aleatoire=GenKey(5);
			$this->nv_nom  = str_replace('.'.$this->ext, '', $this->nv_nom)."_".$aleatoire.".".$this->ext; 
		}
			
		// On r�cup�re le nom du fichier sans l'extension
		list($nom_sans_ext, $ext) = explode('.', $this->nv_nom);
		// On ajoute le sufixe s'il est mentionn�
		($this->suff == '')?$this->nv_nom = $this->nv_nom:$this->nv_nom = $nom_sans_ext.$this->suff.'.'.$this->ext;
		// On ajoute le pr�fixe s'il est mentionn�
		($this->pref == '')?$this->nv_nom = $this->nv_nom:$this->nv_nom = $this->pref.$this->nv_nom;
		return $this->nv_nom;
	}
	
	
	// Retourne le nom du fichier
	function nom() 
	{
		return $this->nv_nom;
	}
}
?>
