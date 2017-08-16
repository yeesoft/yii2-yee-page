<?php

use yeesoft\helpers\Html;

/* @var $this yii\web\View */

$css = <<<CSS
.box .page {
    border-bottom: 1px solid #eee;
    padding: 0 10px 10px 10px;
}
.box .page h4 {
    font-size: 1.15em;
    font-weight: bold;
}
.box .page .pages-content {
    text-align: justify;
    margin: 10px 0 5px 0;
}
.box .page .page-footer {
    font-size: 1.1em;
    font-weight: bold;
}
CSS;

$this->registerCss($css);
?>

<?php if (count($items)): ?>
    <?php foreach ($items as $item) : ?>
        <div class="page clearfix">
            <h4><?= Html::a(Html::encode($item->title), ['/page/default/view', 'id' => $item->id]) ?></h4>
            <div class="page-content">
                <?= Html::encode($item->shortContent); ?>
            </div>
            <div class="page-footer">
                <div class="pull-left">
                    <b>Author: </b><?= Html::a($item->author->username, ['/user/default/update', 'id' => $item->author->id]) ?>
                </div>
                <div class="pull-right">
                    <?= $item->publishedDate ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <h4><em><?= Yii::t('yee/page', 'No pages found.') ?></em></h4>
<?php endif; ?>