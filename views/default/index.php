<?php

use webvimark\extensions\GridPageSize\GridPageSize;
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

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?= Html::encode($this->title) ?></h3>
            <?= Html::a('Add New', ['/page/default/create'], ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-6">
                    <?=
                    GridQuickLinks::widget([
                        'model' => Page::class,
                        'searchModel' => $searchModel,
                        'labels' => [
                            'all' => 'All',
                            'active' => 'Published',
                            'inactive' => 'Pending',
                        ]
                    ])
                    ?>
                </div>

                <div class="col-sm-6 text-right">
                    <?= GridPageSize::widget(['pjaxId' => 'page-grid-pjax']) ?>
                </div>
            </div>

            <?php
            Pjax::begin([
                'id' => 'page-grid-pjax',
            ])
            ?>

            <?=
            GridView::widget([
                'id' => 'page-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'bulkActionOptions' => [
                    'gridId' => 'page-grid',
                    'actions' => [
                        Url::to(['bulk-activate']) => 'Publish',
                        Url::to(['bulk-deactivate']) => 'Unpublish',
                        Url::to(['bulk-delete']) => 'Delete',
                    ]
                ],
                'columns' => [
                    ['class' => 'yii\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'class' => 'yeesoft\grid\columns\TitleActionColumn',
                        'controller' => '/page/default',
                        'title' => function (Page $model) {
                            return Html::a($model->title,
                                ['/page/default/view', 'id' => $model->id], ['data-pjax' => 0]);
                        },
                    ],
                    [
                        'attribute' => 'author_id',
                        'filter' => User::getUsersList(),
                        'filterInputOptions' => [],
                        'value' => function (Page $model) {
                            return Html::a($model->author->username,
                                ['user/view', 'id' => $model->author_id],
                                ['data-pjax' => 0]);
                        },
                        'format' => 'raw',
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
</div>


