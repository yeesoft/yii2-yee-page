<?php

use yeesoft\db\SourceMessagesMigration;

class m151121_233615_i18n_yee_page_source extends SourceMessagesMigration
{

    public function getCategory()
    {
        return 'yee/page';
    }

    public function getMessages()
    {
        return [
            'Page' => 1,
            'Pages' => 1,
            'Create Page' => 1,
        ];
    }
}