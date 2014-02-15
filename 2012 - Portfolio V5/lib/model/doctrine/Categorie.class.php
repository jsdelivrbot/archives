<?php

/**
 * Categorie
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    foliov4
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Categorie extends BaseCategorie
{

  public function __toString()
  {
    return $this->getTitre();
  }
  
	/**
	 * Retourne le nombre d'article liés à une catégorie
	 * @return int
	 */
	public function getNbArticles()
	{
		return ArticleTable::getInstance()->createQuery("a")
				->where("categorie_id = ?", $this->getId())
				->andWhere("publie = 1")
				//->useQueryCache(Apc::getInstance(), sfConfig::get('app_cachenbarticlesparcategories'))
				//->useResultCache(Apc::getInstance(), sfConfig::get('app_cachenbarticlesparcategories'))
				->count();
	}
	
	public function getCategorieSlug()
	{
	  return $this->getCategorie()->getSlug();
	}
	
	public function getLogo()
	{
	  if (Toolbox::isRawDump()) return $this->_get('logo');
	  
	  return ($this->_get('logo')!='') ? '/uploads/categories/'.$this->_get('logo') : null;
	}
}