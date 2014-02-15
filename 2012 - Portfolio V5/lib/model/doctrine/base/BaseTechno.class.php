<?php

/**
 * BaseTechno
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property varchar $nom
 * @property varchar $logo
 * @property varchar $url
 * @property Doctrine_Collection $Creations
 * @property Doctrine_Collection $RelTechnoCreation
 * 
 * @method varchar             getNom()               Returns the current record's "nom" value
 * @method varchar             getLogo()              Returns the current record's "logo" value
 * @method varchar             getUrl()               Returns the current record's "url" value
 * @method Doctrine_Collection getCreations()         Returns the current record's "Creations" collection
 * @method Doctrine_Collection getRelTechnoCreation() Returns the current record's "RelTechnoCreation" collection
 * @method Techno              setNom()               Sets the current record's "nom" value
 * @method Techno              setLogo()              Sets the current record's "logo" value
 * @method Techno              setUrl()               Sets the current record's "url" value
 * @method Techno              setCreations()         Sets the current record's "Creations" collection
 * @method Techno              setRelTechnoCreation() Sets the current record's "RelTechnoCreation" collection
 * 
 * @package    foliov4
 * @subpackage model
 * @author     Julien Lafont
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTechno extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('techno');
        $this->hasColumn('nom', 'varchar', 255, array(
             'type' => 'varchar',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('logo', 'varchar', 255, array(
             'type' => 'varchar',
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('url', 'varchar', 255, array(
             'type' => 'varchar',
             'notnull' => false,
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Creation as Creations', array(
             'refClass' => 'RelTechnoCreation',
             'local' => 'techno_id',
             'foreign' => 'creation_id'));

        $this->hasMany('RelTechnoCreation', array(
             'local' => 'id',
             'foreign' => 'techno_id'));
    }
}