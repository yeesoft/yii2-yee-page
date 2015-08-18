<?php

namespace yeesoft\page\controllers;

use yeesoft\controllers\admin\BaseController;

/**
 * Controller implements the CRUD actions for Page model.
 */
class DefaultController extends BaseController
{
    public $modelClass = 'yeesoft\page\models\Page';
    public $modelSearchClass = 'yeesoft\page\models\search\PageSearch';

    protected function getRedirectPage($action, $model = null)
    {
        switch ($action) {
            case 'update':
                return ['update', 'id' => $model->id];
                break;
            case 'create':
                return ['update', 'id' => $model->id];
                break;
            default:
                return parent::getRedirectPage($action, $model);
        }
    }
}