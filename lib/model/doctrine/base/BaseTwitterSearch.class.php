<?php

/**
 * BaseTwitterSearch
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $term
 * 
 * @method integer       getId()   Returns the current record's "id" value
 * @method string        getTerm() Returns the current record's "term" value
 * @method TwitterSearch setId()   Sets the current record's "id" value
 * @method TwitterSearch setTerm() Sets the current record's "term" value
 * 
 * @package    yigg
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTwitterSearch extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('twitter_search');
        $this->hasColumn('id', 'integer', 11, array(
             'primary' => true,
             'autoincrement' => true,
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('term', 'string', 128, array(
             'notnull' => true,
             'type' => 'string',
             'length' => 128,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}