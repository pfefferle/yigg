<?php

/**
 * BaseStopwords
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $word
 * @property timestamp $created_at
 * 
 * @method integer   getId()         Returns the current record's "id" value
 * @method string    getWord()       Returns the current record's "word" value
 * @method timestamp getCreatedAt()  Returns the current record's "created_at" value
 * @method Stopwords setId()         Sets the current record's "id" value
 * @method Stopwords setWord()       Sets the current record's "word" value
 * @method Stopwords setCreatedAt()  Sets the current record's "created_at" value
 * 
 * @package    yigg
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseStopwords extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('stopwords');
        $this->hasColumn('id', 'integer', 11, array(
             'primary' => true,
             'autoincrement' => true,
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('word', 'string', 100, array(
             'notnull' => true,
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('created_at', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}