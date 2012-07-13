<?php

/**
 * BaseDomain
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $hostname
 * @property integer $yiggs
 * @property integer $stories
 * @property integer $distinct_users
 * @property string $rss_feed
 * @property integer $seitwert
 * @property enum $domain_status
 * @property Doctrine_Collection $Story
 * @property Doctrine_Collection $User
 * 
 * @method integer             getId()                     Returns the current record's "id" value
 * @method string              getHostname()               Returns the current record's "hostname" value
 * @method integer             getYiggs()                  Returns the current record's "yiggs" value
 * @method integer             getStories()                Returns the current record's "stories" value
 * @method integer             getDistinctUsers()          Returns the current record's "distinct_users" value
 * @method string              getRssFeed()                Returns the current record's "rss_feed" value
 * @method integer             getSeitwert()               Returns the current record's "seitwert" value
 * @method enum                getDomainStatus()           Returns the current record's "domain_status" value
 * @method Doctrine_Collection getStory()                  Returns the current record's "Story" collection
 * @method Doctrine_Collection getUserDomainSubscription() Returns the current record's "UserDomainSubscription" collection
 * @method Doctrine_Collection getUser()                   Returns the current record's "User" collection
 * @method Domain              setId()                     Sets the current record's "id" value
 * @method Domain              setHostname()               Sets the current record's "hostname" value
 * @method Domain              setYiggs()                  Sets the current record's "yiggs" value
 * @method Domain              setStories()                Sets the current record's "stories" value
 * @method Domain              setDistinctUsers()          Sets the current record's "distinct_users" value
 * @method Domain              setRssFeed()                Sets the current record's "rss_feed" value
 * @method Domain              setSeitwert()               Sets the current record's "seitwert" value
 * @method Domain              setDomainStatus()           Sets the current record's "domain_status" value
 * @method Domain              setStory()                  Sets the current record's "Story" collection
 * @method Domain              setUserDomainSubscription() Sets the current record's "UserDomainSubscription" collection
 * @method Domain              setUser()                   Sets the current record's "User" collectionDomainSubscription
 * @property Doctrine_Collection $User
 * 
 * @method integer             getId()                     Returns the current record's "id" value
 * @method string              getHostname()               Returns the current record's "hostname" value
 * @method integer             getYiggs()                  Returns the current record's "yiggs" value
 * @method integer             getStories()                Returns the current record's "stories" value
 * @method integer             getDistinctUsers()          Returns the current record's "distinct_users" value
 * @method string              getRssFeed()                Returns the current record's "rss_feed" value
 * @method integer             getSeitwert()               Returns the current record's "seitwert" value
 * @method enum                getDomainStatus()           Returns the current record's "domain_status" value
 * @method Doctrine_Collection getStory()                  Returns the current record's "Story" collection
 * @method Doctrine_Collection getUserDomainSubscription() Returns the current record's "UserDomainSubscription" collection
 * @method Doctrine_Collection getUser()                   Returns the current record's "User" collection
 * @method Domain              setId()                     Sets the current record's "id" value
 * @method Domain              setHostname()               Sets the current record's "hostname" value
 * @method Domain              setYiggs()                  Sets the current record's "yiggs" value
 * @method Domain              setStories()                Sets the current record's "stories" value
 * @method Domain              setDistinctUsers()          Sets the current record's "distinct_users" value
 * @method Domain              setRssFeed()                Sets the current record's "rss_feed" value
 * @method Domain              setSeitwert()               Sets the current record's "seitwert" value
 * @method Domain              setDomainStatus()           Sets the current record's "domain_status" value
 * @method Domain              setStory()                  Sets the current record's "Story" collection
 * @method Domain              setUserDomainSubscription() Sets the current record's "UserDomainSubscription" collection
 * @method Domain              setUser()                   Sets the current record's "User" collection
 * 
 * @package    yigg
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDomain extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('domain');
        $this->hasColumn('id', 'integer', null, array(
             'primary' => true,
             'autoincrement' => true,
             'type' => 'integer',
             'length' => '',
             ));
        $this->hasColumn('hostname', 'string', 128, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 128,
             ));
        $this->hasColumn('yiggs', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('stories', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('distinct_users', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('rss_feed', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('seitwert', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('domain_status', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'blacklisted',
              1 => 'whitelist',
              2 => 'normal',
             ),
             'notnull' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Story', array(
             'local' => 'id',
             'foreign' => 'domain_id'));

        $this->hasMany('UserDomainSubscription', array(
             'local' => 'id',
             'foreign' => 'domain_id'));

        $this->hasMany('User', array(
             'refClass' => 'UserDomainSubscription',
             'local' => 'domain_id',
             'foreign' => 'user_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}