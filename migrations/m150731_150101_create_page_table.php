<?php

use yii\db\Migration;
use yii\db\Schema;

class m150731_150101_create_page_table extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('page', [
            'id' => 'pk',
            'slug' => Schema::TYPE_STRING . '(200) NOT NULL DEFAULT ""',
            'status' => Schema::TYPE_INTEGER . '(1) unsigned NOT NULL DEFAULT "0" COMMENT "0-pending,1-published"',
            'comment_status' => Schema::TYPE_INTEGER . '(1) unsigned NOT NULL DEFAULT "1" COMMENT "0-closed,1-open"',
            'published_at' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'revision' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT "1"',
            'CONSTRAINT `fk_page_created_by` FOREIGN KEY (created_by) REFERENCES user (id) ON DELETE SET NULL ON UPDATE CASCADE',
            'CONSTRAINT `fk_page_updated_by` FOREIGN KEY (updated_by) REFERENCES user (id) ON DELETE SET NULL ON UPDATE CASCADE',
        ], $tableOptions);

        $this->createIndex('page_slug', 'page', 'slug');
        $this->createIndex('page_status', 'page', 'status');
        $this->createIndex('page_author', 'page', 'created_by');

        $this->createTable('page_lang', [
            'id' => 'pk',
            'page_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'language' => Schema::TYPE_STRING . '(6) NOT NULL',
            'title' => Schema::TYPE_TEXT . ' NOT NULL',
            'content' => Schema::TYPE_TEXT . ' DEFAULT NULL',
        ], $tableOptions);


        $this->createIndex('page_lang_post_id', 'page_lang', 'page_id');
        $this->createIndex('page_lang_language', 'page_lang', 'language');
        $this->addForeignKey('fk_page_lang', 'page_lang', 'page_id', 'page', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_page_created_by', 'page');
        $this->dropForeignKey('fk_page_updated_by', 'page');
        $this->dropForeignKey('fk_page_lang', 'page_lang');
        $this->dropTable('page_lang');
        $this->dropTable('page');
    }
}