<?php

namespace yeesoft\page\models;

use yeesoft\behaviors\MultilingualBehavior;
use yeesoft\models\OwnerAccess;
use yeesoft\models\User;
use yeesoft\Yee;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property integer $status
 * @property integer $comment_status
 * @property string $content
 * @property string $published_at
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
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
            BlameableBehavior::className(),
            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
            ],
            'multilingual' => [
                'class' => MultilingualBehavior::className(),
                'langForeignKey' => 'page_id',
                'tableName' => "{{%page_lang}}",
                'attributes' => [
                    'title', 'content',
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['created_by', 'updated_by', 'status', 'comment_status', 'revision'], 'integer'],
            [['title', 'content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['slug'], 'string', 'max' => 200],
            ['published_at', 'date', 'timestampAttribute' => 'published_at'],
            ['published_at', 'default', 'value' => time()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yee::t('yee', 'ID'),
            'created_by' => Yee::t('yee', 'Author'),
            'updated_by' => Yee::t('yee', 'Updated By'),
            'slug' => Yee::t('yee', 'Slug'),
            'title' => Yee::t('yee', 'Title'),
            'status' => Yee::t('yee', 'Status'),
            'comment_status' => Yee::t('yee', 'Comment Status'),
            'content' => Yee::t('yee', 'Content'),
            'published_at' => Yee::t('yee', 'Published'),
            'created_at' => Yee::t('yee', 'Created'), '',
            'updated_at' => Yee::t('yee', 'Updated'),
            'revision' => Yee::t('yee', 'Revision'),
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
        return $this->hasOne(User::className(), ['id' => 'created_by']);
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
            self::STATUS_PENDING => Yee::t('yee', 'Pending'),
            self::STATUS_PUBLISHED => Yee::t('yee', 'Published'),
        ];
    }

    /**
     * getStatusOptionsList
     * @return array
     */
    public static function getStatusOptionsList()
    {
        return [
            [self::STATUS_PENDING, Yee::t('yee', 'Pending'), 'default'],
            [self::STATUS_PUBLISHED, Yee::t('yee', 'Published'), 'primary']
        ];
    }

    /**
     * getCommentStatusList
     * @return array
     */
    public static function getCommentStatusList()
    {
        return [
            self::COMMENT_STATUS_OPEN => Yee::t('yee', 'Open'),
            self::COMMENT_STATUS_CLOSED => Yee::t('yee', 'Closed')
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
        return 'created_by';
    }
}
