<?php

use yeesoft\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yeesoft\page\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('yee/page', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-body">
        <?= Html::a(Yii::t('yee', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
        <?=
        Html::a(Yii::t('yee', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-sm btn-default',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>
        <?= Html::a(Yii::t('yee', 'Add New'), ['create'], ['class' => 'btn btn-sm btn-primary pull-right']) ?>
    </div>
</div>

<div class="box box-primary">
    <div class="box-body">
        <h2><?= $model->title ?></h2>
        <?= $model->content ?>
    </div>
</div>
