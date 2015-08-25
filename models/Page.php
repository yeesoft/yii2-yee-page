<?php

namespace yeesoft\page\models;

use yeesoft\models\OwnerAccess;
use yeesoft\models\User;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property integer $author
 * @property string $slug
 * @property string $title
 * @property integer $status
 * @property integer $comment_status
 * @property string $content
 * @property string $published_at
 * @property string $created_at
 * @property string $updated_at
 * @property integer $revision
 */
class Page extends ActiveRecord implements OwnerAccess
{

    const STATUS_PENDING = 0;
    const STATUS_PUBLISHED = 1;
    const COMMENT_STATUS_CLOSED = 0;
    const COMMENT_STATUS_OPEN = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->on(self::EVENT_BEFORE_UPDATE, [$this, 'updateRevision']);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['author_id', 'status', 'comment_status', 'revision'], 'integer'],
            [['title', 'content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['slug'], 'string', 'max' => 200],
            ['published_at', 'date', 'timestampAttribute' => 'published_at'],
            ['published_at', 'default', 'value' => time()],
            ['author_id', 'default', 'value' => \Yii::$app->user->identity->id],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author',
            'slug' => 'Slug',
            'title' => 'Title',
            'status' => 'Status',
            'comment_status' => 'Comment Status',
            'content' => 'Content',
            'published_at' => 'Published',
            'created_at' => 'Created',
            'updated_at' => 'Last Update',
            'revision' => 'Revision',
        ];
    }

    /**
     * @inheritdoc
     * @return PageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageQuery(get_called_class());
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function getPublishedDate()
    {
        return date('Y-m-d', ($this->isNewRecord) ? time() : $this->published_at);
    }

    public function getUpdatedDate()
    {
        return date('Y-m-d', ($this->isNewRecord) ? time() : $this->updated_at);
    }

    public function getUpdatedTime()
    {
        return date('Y-m-d H:i', ($this->isNewRecord) ? time() : $this->updated_at);
    }

    public function getCreatedDate()
    {
        return date('Y-m-d', ($this->isNewRecord) ? time() : $this->created_at);
    }

    public function getStatusText()
    {
        return $this->getStatusList()[$this->status];
    }

    public function getCommentStatusText()
    {
        return $this->getCommentStatusList()[$this->comment_status];
    }

    public function getRevision()
    {
        return ($this->isNewRecord) ? 1 : $this->revision;
    }

    public function updateRevision()
    {
        $this->updateCounters(['revision' => 1]);
    }

    /**
     * getTypeList
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_PUBLISHED => 'Published'
        ];
    }

    /**
     * getStatusOptionsList
     * @return array
     */
    public static function getStatusOptionsList()
    {
        return [
            [self::STATUS_PENDING, 'Pending', 'default'],
            [self::STATUS_PUBLISHED, 'Published', 'primary']
        ];
    }

    /**
     * getCommentStatusList
     * @return array
     */
    public static function getCommentStatusList()
    {
        return [
            self::COMMENT_STATUS_OPEN => 'Open',
            self::COMMENT_STATUS_CLOSED => 'Closed'
        ];
    }

    /**
     *
     * @inheritdoc
     */
    public static function getOwnerAccessPermission()
    {
        return 'accessAllPages';
    }

    /**
     *
     * @inheritdoc
     */
    public static function getOwnerField()
    {
        return 'author_id';
    }
}
