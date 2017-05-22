<?php

use yeesoft\grid\GridPageSize;
use yeesoft\grid\GridQuickLinks;
use yeesoft\grid\GridView;
use yeesoft\helpers\Html;
use yeesoft\models\User;
use yeesoft\page\models\Page;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel yeesoft\page\models\search\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yee/page', 'Pages');
$this->params['description'] = 'YeeCMS 0.2.0';
$this->params['breadcrumbs'][] = $this->title;
$this->params['header-content'] = Html::a(Yii::t('yee', 'Add New'), ['/page/default/create'], ['class' => 'btn btn-sm btn-primary']);
?>

<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-sm-6" style="margin-bottom: 10px">
                <?=
                GridQuickLinks::widget([
                    'model' => Page::className(),
                    'searchModel' => $searchModel,
                    'labels' => [
                        'all' => Yii::t('yee', 'All'),
                        'active' => Yii::t('yee', 'Published'),
                        'inactive' => Yii::t('yee', 'Pending'),
                    ],
                ])
                ?>
            </div>
            <div class="col-sm-6 text-right">
                
            </div>
        </div>

        <?php Pjax::begin(['id' => 'page-grid-pjax']) ?>
        <?=
        GridView::widget([
            'id' => 'page-grid',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'bulkActionOptions' => [
                'gridId' => 'page-grid',
                'actions' => [
                    Url::to(['bulk-activate']) => Yii::t('yee', 'Publish'),
                    Url::to(['bulk-deactivate']) => Yii::t('yee', 'Unpublish'),
                    Url::to(['bulk-delete']) => Yii::t('yii', 'Delete'),
                ]
            ],
            'columns' => [
                ['class' => 'yeesoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px'], 'displayFilter' => false],
                [
                    'class' => 'yeesoft\grid\columns\TitleActionColumn',
                    'title' => function (Page $model) {
                        return Html::a($model->title, ['/page/default/view', 'id' => $model->id], ['data-pjax' => 0]);
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