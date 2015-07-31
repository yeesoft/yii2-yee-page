<?php

use yii\db\Migration;
use yii\db\Schema;

class m150731_150101_create_page_table extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('page',
            [
                'id' => 'pk',
                'author_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
                'slug' => Schema::TYPE_STRING . '(200) NOT NULL DEFAULT ""',
                'title' => Schema::TYPE_TEXT . ' NOT NULL',
                'status' => Schema::TYPE_INTEGER . '(1) unsigned NOT NULL DEFAULT "0" COMMENT "0-pending,1-published"',
                'comment_status' => Schema::TYPE_INTEGER . '(1) unsigned NOT NULL DEFAULT "1" COMMENT "0-closed,1-open"',
                'content' => Schema::TYPE_TEXT . ' NOT NULL',
                'published_at' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'revision' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT "1"',
            ], $tableOptions);

        $this->createIndex('page_slug', 'page', 'slug');
        $this->createIndex('page_status', 'page', 'status');
        $this->createIndex('page_author', 'page', 'author_id');
    }

    public function down()
    {
        $this->dropTable('page');
    }
}