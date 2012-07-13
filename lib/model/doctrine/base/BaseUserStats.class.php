<?php

/**
 * BaseUserStats
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $rank
 * @property integer $yipps
 * @property integer $comment_award
 * @property integer $reading_award
 * @property integer $storys_total
 * @property integer $comments_total
 * @property integer $external_comments_total
 * @property integer $friends_total
 * @property integer $external_friends_total
 * @property integer $external_yiggs_total
 * @property integer $yiggs_total
 * @property integer $story_renders_total
 * @property timestamp $last_calculated
 * @property User $User
 * 
 * @method integer   getUserId()                  Returns the current record's "user_id" value
 * @method integer   getRank()                    Returns the current record's "rank" value
 * @method integer   getYipps()                   Returns the current record's "yipps" value
 * @method integer   getCommentAward()            Returns the current record's "comment_award" value
 * @method integer   getReadingAward()            Returns the current record's "reading_award" value
 * @method integer   getStorysTotal()             Returns the current record's "storys_total" value
 * @method integer   getCommentsTotal()           Returns the current record's "comments_total" value
 * @method integer   getExternalCommentsTotal()   Returns the current record's "external_comments_total" value
 * @method integer   getFriendsTotal()            Returns the current record's "friends_total" value
 * @method integer   getExternalFriendsTotal()    Returns the current record's "external_friends_total" value
 * @method integer   getExternalYiggsTotal()      Returns the current record's "external_yiggs_total" value
 * @method integer   getYiggsTotal()              Returns the current record's "yiggs_total" value
 * @method integer   getStoryRendersTotal()       Returns the current record's "story_renders_total" value
 * @method timestamp getLastCalculated()          Returns the current record's "last_calculated" value
 * @method User      getUser()                    Returns the current record's "User" value
 * @method UserStats setUserId()                  Sets the current record's "user_id" value
 * @method UserStats setRank()                    Sets the current record's "rank" value
 * @method UserStats setYipps()                   Sets the current record's "yipps" value
 * @method UserStats setCommentAward()            Sets the current record's "comment_award" value
 * @method UserStats setReadingAward()            Sets the current record's "reading_award" value
 * @method UserStats setStorysTotal()             Sets the current record's "storys_total" value
 * @method UserStats setCommentsTotal()           Sets the current record's "comments_total" value
 * @method UserStats setExternalCommentsTotal()   Sets the current record's "external_comments_total" value
 * @method UserStats setFriendsTotal()            Sets the current record's "friends_total" value
 * @method UserStats setExternalFriendsTotal()    Sets the current record's "external_friends_total" value
 * @method UserStats setExternalYiggsTotal()      Sets the current record's "external_yiggs_total" value
 * @method UserStats setYiggsTotal()              Sets the current record's "yiggs_total" value
 * @method UserStats setStoryRendersTotal()       Sets the current record's "story_renders_total" value
 * @method UserStats setLastCalculated()          Sets the current record's "last_calculated" value
 * @method UserStats setUser()                    Sets the current record's "User" value
 * 
 * @package    yigg
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUserStats extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('user_stats');
        $this->hasColumn('user_id', 'integer', 11, array(
             'primary' => true,
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('rank', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('yipps', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('comment_award', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('reading_award', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('storys_total', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('comments_total', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('external_comments_total', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('friends_total', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('external_friends_total', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('external_yiggs_total', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('yiggs_total', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('story_renders_total', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('last_calculated', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => 25,
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