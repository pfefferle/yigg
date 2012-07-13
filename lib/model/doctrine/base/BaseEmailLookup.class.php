<?php

/**
 * BaseEmailLookup
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $user_id
 * @property string $ip_address
 * @property User $User
 * 
 * @method integer     getId()         Returns the current record's "id" value
 * @method integer     getUserId()     Returns the current record's "user_id" value
 * @method string      getIpAddress()  Returns the current record's "ip_address" value
 * @method User        getUser()       Returns the current record's "User" value
 * @method EmailLookup setId()         Sets the current record's "id" value
 * @method EmailLookup setUserId()     Sets the current record's "user_id" value
 * @method EmailLookup setIpAddress()  Sets the current record's "ip_address" value
 * @method EmailLookup setUser()       Sets the current record's "User" value
 * 
 * @package    yigg
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEmailLookup extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('email_lookup');
        $this->hasColumn('id', 'integer', 11, array(
             'primary' => true,
             'autoincrement' => true,
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('user_id', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('ip_address', 'string', 15, array(
             'type' => 'string',
             'length' => 15,
             ));


        $this->index('email_lookup_ip_address', array(
             'fields' => 'ip_address',
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