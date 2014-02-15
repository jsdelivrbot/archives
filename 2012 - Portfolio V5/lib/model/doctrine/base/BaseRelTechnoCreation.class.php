<?php

/**
 * BaseRelTechnoCreation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $techno_id
 * @property integer $creation_id
 * @property Creation $Creation
 * @property Techno $Techno
 * 
 * @method integer           getTechnoId()    Returns the current record's "techno_id" value
 * @method integer           getCreationId()  Returns the current record's "creation_id" value
 * @method Creation          getCreation()    Returns the current record's "Creation" value
 * @method Techno            getTechno()      Returns the current record's "Techno" value
 * @method RelTechnoCreation setTechnoId()    Sets the current record's "techno_id" value
 * @method RelTechnoCreation setCreationId()  Sets the current record's "creation_id" value
 * @method RelTechnoCreation setCreation()    Sets the current record's "Creation" value
 * @method RelTechnoCreation setTechno()      Sets the current record's "Techno" value
 * 
 * @package    foliov4
 * @subpackage model
 * @author     Julien Lafont
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRelTechnoCreation extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('rel_techno_creation');
        $this->hasColumn('techno_id', 'integer', 8, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 8,
             ));
        $this->hasColumn('creation_id', 'integer', 8, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 8,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Creation', array(
             'local' => 'creation_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Techno', array(
             'local' => 'techno_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}