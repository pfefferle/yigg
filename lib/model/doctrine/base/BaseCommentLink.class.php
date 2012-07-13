<?php

/**
 * BaseCommentLink
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $comment_id
 * @property varchar $url
 * @property Comment $Comment
 * 
 * @method integer     getId()         Returns the current record's "id" value
 * @method integer     getCommentId()  Returns the current record's "comment_id" value
 * @method varchar     getUrl()        Returns the current record's "url" value
 * @method Comment     getComment()    Returns the current record's "Comment" value
 * @method CommentLink setId()         Sets the current record's "id" value
 * @method CommentLink setCommentId()  Sets the current record's "comment_id" value
 * @method CommentLink setUrl()        Sets the current record's "url" value
 * @method CommentLink setComment()    Sets the current record's "Comment" value
 * 
 * @package    yigg
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCommentLink extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('comment_link');
        $this->hasColumn('id', 'integer', 11, array(
             'primary' => true,
             'autoincrement' => true,
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('comment_id', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('url', 'varchar', 255, array(
             'type' => 'varchar',
             'length' => 255,
             ));


        $this->index('unique_comment_url', array(
             'fields' => 
             array(
              0 => 'comment_id',
              1 => 'url',
             ),
             'type' => 'unique',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Comment', array(
             'local' => 'comment_id',
             'foreign' => 'id'));

        $yiggsoftdelete0 = new yiggSoftDelete();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($yiggsoftdelete0);
        $this->actAs($timestampable0);
    }
}