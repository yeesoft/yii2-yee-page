<?php

use yii\db\Migration;

class m150731_150101_create_page_table extends Migration
{
    const PAGE_TABLE = '{{%page}}';
    const PAGE_LANG_TABLE = '{{%page_lang}}';
    
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(self::PAGE_TABLE, [
            'id' => $this->primaryKey(),
            'slug' => $this->string(255)->notNull(),
            'status' => $this->integer(1)->notNull()->defaultValue(0)->comment('0-pending,1-published'),
            'comment_status' => $this->integer(1)->notNull()->defaultValue(1)->comment('0-closed,1-open'),
            'published_at' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'revision' => $this->integer(1)->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->createIndex('page_slug', self::PAGE_TABLE, 'slug');
        $this->createIndex('page_status', self::PAGE_TABLE, 'status');
        //$this->addForeignKey('fk_page_created_by', self::PAGE_TABLE, 'created_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
        //$this->addForeignKey('fk_page_updated_by', self::PAGE_TABLE, 'updated_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');

        $this->createTable(self::PAGE_LANG_TABLE, [
            'id' => $this->primaryKey(),
            'page_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'title' => $this->text(),
            'content' => $this->text(),
        ], $tableOptions);

        $this->createIndex('page_lang_post_id', self::PAGE_LANG_TABLE, 'page_id');
        $this->createIndex('page_lang_language', self::PAGE_LANG_TABLE, 'language');
        $this->addForeignKey('fk_page_lang', self::PAGE_LANG_TABLE, 'page_id', self::PAGE_TABLE, 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_page_created_by', self::PAGE_TABLE);
        $this->dropForeignKey('fk_page_updated_by', self::PAGE_TABLE);
        $this->dropForeignKey('fk_page_lang', self::PAGE_LANG_TABLE);
        $this->dropTable(self::PAGE_LANG_TABLE);
        $this->dropTable(self::PAGE_TABLE);
    }
}