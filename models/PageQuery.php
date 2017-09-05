<?php

namespace yeesoft\page\models;

use yeesoft\db\ActiveQueryFilterTrait;
use yeesoft\multilingual\db\MultilingualTrait;

/**
 * This is the ActiveQuery class for [[Page]].
 *
 * @see Page
 */
class PageQuery extends \yii\db\ActiveQuery
{

    use MultilingualTrait;
    use ActiveQueryFilterTrait;

    public function active()
    {
        $this->andWhere(['status' => Page::STATUS_PUBLISHED]);
        return $this;
    }

    /**
     * @inheritdoc
     * @return Page[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Page|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}
