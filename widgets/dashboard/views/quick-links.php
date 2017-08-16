<?php

use yeesoft\helpers\Html;

/* @var $this yii\web\View */

$css = <<<CSS
.box .page-quick-links a{
    padding: 0 5px;
}
CSS;

$this->registerCss($css);
?>
<div class="page-quick-links text-center">
    <?php foreach ($links as $link) : ?>
        <?= Html::a("<b>{$link['count']}</b> {$link['label']}", $link['url']) ?>
    <?php endforeach; ?>
</div>