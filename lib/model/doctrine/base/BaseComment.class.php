<?php

/**
 * BaseComment
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $description
 * @property integer $user_id
 * @property integer $comment_type
 * @property string $email
 * @property string $name
 * @property boolean $is_online
 * @property User $Author
 * @property Doctrine_Collection $Stories
 * @property CommentLink $Link
 * @property Doctrine_Collection $StoryComment
 * 
 * @method integer             getId()           Returns the current record's "id" value
 * @method string              getDescription()  Returns the current record's "description" value
 * @method integer             getUserId()       Returns the current record's "user_id" value
 * @method integer             getCommentType()  Returns the current record's "comment_type" value
 * @method string              getEmail()        Returns the current record's "email" value
 * @method string              getName()         Returns the current record's "name" value
 * @method boolean             getIsOnline()     Returns the current record's "is_online" value
 * @method User                getAuthor()       Returns the current record's "Author" value
 * @method Doctrine_Collection getStories()      Returns the current record's "Stories" collection
 * @method CommentLink         getLink()         Returns the current record's "Link" value
 * @method Doctrine_Collection getStoryComment() Returns the current record's "StoryComment" collection
 * @method Comment             setId()           Sets the current record's "id" value
 * @method Comment             setDescription()  Sets the current record's "description" value
 * @method Comment             setUserId()       Sets the current record's "user_id" value
 * @method Comment             setCommentType()  Sets the current record's "comment_type" value
 * @method Comment             setEmail()        Sets the current record's "email" value
 * @method Comment             setName()         Sets the current record's "name" value
 * @method Comment             setIsOnline()     Sets the current record's "is_online" value
 * @method Comment             setAuthor()       Sets the current record's "Author" value
 * @method Comment             setStories()      Sets the current record's "Stories" collection
 * @method Comment             setLink()         Sets the current record's "Link" value
 * @method Comment             setStoryComment() Sets the current record's "StoryComment" collection
 * 
 * @package    yigg
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseComment extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('comment');
        $this->hasColumn('id', 'integer', 11, array(
             'primary' => true,
             'autoincrement' => true,
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('description', 'string', 4000, array(
             'notnull' => true,
             'type' => 'string',
             'length' => 4000,
             ));
        $this->hasColumn('user_id', 'integer', 11, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 11,
             ));
        $this->hasColumn('comment_type', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('email', 'string', 128, array(
             'type' => 'string',
             'length' => 128,
             ));
        $this->hasColumn('name', 'string', 128, array(
             'type' => 'string',
             'length' => 128,
             ));
        $this->hasColumn('is_online', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 1,
             ));


        $this->index('comment_created_at', array(
             'fields' => 'created_at',
             ));
        $this->index('comment_epochtime', array(
             'fields' => 'epoch_time',
             'sorting' => 'DESC',
             ));
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('User as Author', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $this->hasMany('Story as Stories', array(
             'refClass' => 'StoryComment',
             'local' => 'comment_id',
             'foreign' => 'story_id'));

        $this->hasOne('CommentLink as Link', array(
             'local' => 'id',
             'foreign' => 'comment_id'));

        $this->hasMany('StoryComment', array(
             'local' => 'id',
             'foreign' => 'comment_id'));

        $yiggdescription0 = new yiggDescription(array(
             ));
        $yiggsoftdelete0 = new yiggSoftDelete(array(
             ));
        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $yiggepoch0 = new yiggEpoch(array(
             ));
        $this->actAs($yiggdescription0);
        $this->actAs($yiggsoftdelete0);
        $this->actAs($timestampable0);
        $this->actAs($yiggepoch0);
    }
}