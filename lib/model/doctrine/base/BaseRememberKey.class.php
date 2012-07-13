<?php

/**
 * BaseRememberKey
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $remember_key
 * @property string $ip_address
 * @property timestamp $created_at
 * @property integer $user_id
 * @property User $User
 * 
 * @method integer     getId()           Returns the current record's "id" value
 * @method string      getRememberKey()  Returns the current record's "remember_key" value
 * @method string      getIpAddress()    Returns the current record's "ip_address" value
 * @method timestamp   getCreatedAt()    Returns the current record's "created_at" value
 * @method integer     getUserId()       Returns the current record's "user_id" value
 * @method User        getUser()         Returns the current record's "User" value
 * @method RememberKey setId()           Sets the current record's "id" value
 * @method RememberKey setRememberKey()  Sets the current record's "remember_key" value
 * @method RememberKey setIpAddress()    Sets the current record's "ip_address" value
 * @method RememberKey setCreatedAt()    Sets the current record's "created_at" value
 * @method RememberKey setUserId()       Sets the current record's "user_id" value
 * @method RememberKey setUser()         Sets the current record's "User" value
 * 
 * @package    yigg
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRememberKey extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('remember_key');
        $this->hasColumn('id', 'integer', 11, array(
             'primary' => true,
             'autoincrement' => true,
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('remember_key', 'string', 32, array(
             'type' => 'string',
             'length' => 32,
             ));
        $this->hasColumn('ip_address', 'string', 15, array(
             'type' => 'string',
             'length' => 15,
             ));
        $this->hasColumn('created_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => 25,
             ));
        $this->hasColumn('user_id', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));


        $this->index('rememberme_key', array(
             'fields' => 'remember_key',
             ));
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('User', array(
             'local' => 'user_id',
             'foreign' => 'id'));
    }
}