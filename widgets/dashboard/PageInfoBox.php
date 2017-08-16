<?php

namespace yeesoft\page\widgets\dashboard;

use yii\db\Query;
use yeesoft\helpers\FA;
use yeesoft\models\User;
use yeesoft\page\models\Page;
use yeesoft\dashboard\widgets\InfoBox;
use Yii;

class PageInfoBox extends InfoBox
{

    /**
     * @var string model class name
     */
    public $modelClass = 'yeesoft\page\models\Page';

    public function getHasAccess()
    {
        return User::hasPermission('viewPages');
    }

    public function getTitle()
    {
        return Yii::t('yee/page', 'Pages');
    }

    public function getIcon()
    {
        return FA::_FILE;
    }

    public function getNumber()
    {
        return Page::getDb()->cache(function ($db) {
                    return Page::find()->count();
                });
    }

    public function getProgress()
    {
        return ($this->increase > 100);
    }

    public function getDescription()
    {
        $increase = sprintf("%+d", $this->increase);
        return Yii::t('yee', '{increase}% in 30 Days', ['increase' => $increase]);
    }

    public function getIncrease()
    {
        return Yii::$app->cache->getOrSet([self::className(), 'increase'], function() {
                    $result = (new Query)->select([
                                'SUM(IF(created_at BETWEEN UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 MONTH)) AND UNIX_TIMESTAMP(), 1, 0)) current',
                                'SUM(IF(created_at BETWEEN UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 2 MONTH)) AND UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 MONTH)), 1, 0)) past'
                            ])->from(Page::tableName())
                            ->one();

                    $increase = ($result['past'] == 0) ? 1 : (($result['current'] / $result['past']) - 1);

                    return 100 * $increase;
                }, 60);
    }

}
