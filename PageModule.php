<?php
/**
 * @link http://www.yee-soft.com/
 * @copyright Copyright (c) 2015 Taras Makitra
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

namespace yeesoft\page;

use Yii;

/**
 * Page Module For Yee CMS
 *
 * @author Taras Makitra <makitrataras@gmail.com>
 */
class PageModule extends \yii\base\Module
{
    /**
     * Version number of the module.
     */
    const VERSION = '0.1-a';

    public $controllerNamespace = 'yeesoft\page\controllers';

    
    public $viewList;
    public $layoutsList;

    public function init()
    {


        /**
         * Default views and layouts
         * Add more views and layouts in your main config file by calling the module
         *
         *   Example: 
         *
         *   'page' => [
         *       'class' => 'yeesoft\page\PageModule',
         *       'viewList' => [
         *           'page' => 'View Label 1',
         *           'page_test' => 'View Label 2',
         *       ],
         *       'layoutsList' => [
         *           'main' => 'Layout Label 1',
         *           'dark_layout' => 'Layout Label 2',
         *       ],
         *   ],
         */
        
        if(empty($this->viewList)){

            $this->viewList = [
                'page' => Yii::t('yee', 'Page view')
            ];
        }

        if(empty($this->layoutsList)){

            $this->viewList = [
                'main' => Yii::t('yee', 'Main layout')
            ];
        }

        parent::init();
    }

}