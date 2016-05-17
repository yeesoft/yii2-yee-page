<?php

use yii\db\Migration;

class m160414_212551_add_view_page extends Migration
{
    const PAGE_TABLE = '{{%page}}';
    
    public function safeUp()
    {
        $this->addColumn(self::PAGE_TABLE, 'view', $this->string(255)->notNull()->defaultValue('page'));
        $this->addColumn(self::PAGE_TABLE, 'layout', $this->string(255)->notNull()->defaultValue('main'));
    }

    public function safeDown()
    {
        $this->dropColumn(self::PAGE_TABLE, 'view');
        $this->dropColumn(self::PAGE_TABLE, 'layout');
    }
}