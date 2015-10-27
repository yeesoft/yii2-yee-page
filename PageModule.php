<?php

namespace yeesoft\page;

use Yii;

class PageModule extends \yii\base\Module
{
    public $controllerNamespace = 'yeesoft\page\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['yii2-yee-page/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@vendor/yeesoft/yii2-yee-page/messages',
            'fileMap' => [
                'yii2-yee-page/page' => 'page.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('yii2-yee-page/' . $category, $message, $params, $language);
    }
}