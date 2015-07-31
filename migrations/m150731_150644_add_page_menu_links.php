<?php

use yii\db\Migration;
use yii\db\Schema;

class m150731_150644_add_page_menu_links extends Migration
{

    public function up()
    {
        $this->insert('menu_link', ['id' => 'page', 'menu_id' => 'admin-main-menu', 'link' => '/page', 'label' => 'Pages', 'image' => 'file', 'order' => 2]);
    }

    public function down()
    {
        $this->delete('menu_link', ['like', 'id', 'page']);
    }
}