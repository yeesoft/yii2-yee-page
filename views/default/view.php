<?php

use yeesoft\helpers\Html;
use yeesoft\models\User;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model yeesoft\page\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">

    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>

    <div class="panel panel-default">
        <div class="panel-body">

            <p>
                <?= Html::a('Edit', ['/page/default/update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
                <?=
                Html::a('Delete', ['/page/default/delete', 'id' => $model->id],
                    [
                        'class' => 'btn btn-sm btn-default',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this user?',
                            'method' => 'post',
                        ],
                    ])
                ?>
                <?= Html::a('Add New', ['/page/default/create'], ['class' => 'btn btn-sm btn-primary pull-right']) ?>
            </p>


            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'author',
                        'value' => $model->author->username,
                        'visible' => User::hasPermission('viewUserEmail'),
                    ],
                    'slug',
                    [
                        'attribute' => 'status',
                        'value' => $model->statusText,
                    ],
                    [
                        'attribute' => 'comment_status',
                        'value' => $model->commentStatusText,
                    ],
                    'revision',
                    [
                        'attribute' => 'published_at',
                        'value' => $model->publishedDate,
                    ],
                    [
                        'attribute' => 'updated_at',
                        'value' => $model->updatedTime,
                    ],
                    [
                        'attribute' => 'created_at',
                        'value' => $model->createdDate,
                    ],
                ],
            ])
            ?>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <h2><?= $model->title ?></h2>
            <?= $model->content ?>
        </div>
    </div>


</div>
