<?php

use yii\db\Migration;
use yii\db\Schema;

class m160414_212551_add_view_page extends Migration
{

    public function safeUp()
    {
        $this->addColumn('page', 'view', Schema::TYPE_STRING."(255) NOT NULL DEFAULT 'page'");
        $this->addColumn('page', 'layout', Schema::TYPE_STRING."(255) NOT NULL DEFAULT 'main'");
    }

    public function safeDown()
    {
        $this->dropColumn('page', 'view');
        $this->dropColumn('page', 'layout');
    }
}