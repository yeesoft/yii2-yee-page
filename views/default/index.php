<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use yeesoft\models\User;
use yeesoft\helpers\Html;
use yeesoft\grid\GridView;
use yeesoft\page\models\Page;

/* @var $this yii\web\View */
/* @var $searchModel yeesoft\page\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yee/page', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
$this->params['description'] = 'YeeCMS 0.2.0';
$this->params['header-content'] = Html::a(Yii::t('yee', 'Add New'), ['create'], ['class' => 'btn btn-sm btn-primary']);
?>

<div class="box box-primary">
    <div class="box-body">
        <?php $pjax = Pjax::begin() ?>
        <?=
        GridView::widget([
            'pjaxId' => $pjax->id,
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'bulkActions' => [
                'actions' => [
                    Url::to(['bulk-activate']) => Yii::t('yee', 'Publish'),
                    Url::to(['bulk-deactivate']) => Yii::t('yee', 'Unpublish'),
                    Url::to(['bulk-delete']) => Yii::t('yii', 'Delete'),
                ]
            ],
            'quickFilters' => [
                'filters' => [
                    Yii::t('yee', 'All') => [],
                    Yii::t('yee', 'Published') => ['status' => 1],
                    Yii::t('yee', 'Pending') => ['status' => 0],
                ],
            ],
            'columns' => [
                ['class' => 'yeesoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px'], 'displayFilter' => false],
                [
                    'class' => 'yeesoft\grid\columns\TitleActionColumn',
                    'title' => function (Page $model) {
                        return Html::a($model->title, ['view', 'id' => $model->id], ['data-pjax' => 0]);
                    },
                    'filterOptions' => ['colspan' => 2],
                ],
                [
                    'attribute' => 'created_by',
                    'filter' => User::getUsersList(),
                    'value' => function (Page $model) {
                        return Html::a($model->author->username, ['/user/default/update', 'id' => $model->created_by], ['data-pjax' => 0]);
                    },
                    'format' => 'raw',
                    'visible' => User::hasPermission('viewUsers'),
                    'options' => ['style' => 'width:180px'],
                ],
                [
                    'class' => 'yeesoft\grid\columns\StatusColumn',
                    'attribute' => 'status',
                    'optionsArray' => Page::getStatusOptionsList(),
                    'options' => ['style' => 'width:60px'],
                ],
                [
                    'class' => 'yeesoft\grid\columns\DateFilterColumn',
                    'attribute' => 'published_at',
                    'value' => function (Page $model) {
                        return '<span style="font-size:85%;" class="label label-'
                                . ((time() >= $model->published_at) ? 'primary' : 'default') . '">'
                                . $model->publishedDate . '</span>';
                    },
                    'format' => 'raw',
                    'options' => ['style' => 'width:150px'],
                ],
            ],
        ]);
        ?>
        <?php Pjax::end() ?>
    </div>
</div>