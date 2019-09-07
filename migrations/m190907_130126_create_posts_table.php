<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%posts}}`.
 */
class m190907_130126_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%posts}}', [
            'id' => $this->bigPrimaryKey(),
            'text' => $this->text(),
            'created_by' => $this->bigInteger(),
            'created_at' => $this->dateTime(),
            'updated_by' => $this->bigInteger(),
            'updated_at' => $this->dateTime()
        ]);
        $this->createIndex(
            'idx-posts-id',
            'posts',
            'id'
        );
        $this->addForeignKey(
            'fk-posts-created_by',
            'posts',
            'created_by',
            'users',
            'id'
        );
        $this->addForeignKey(
            'fk-posts-updated_by',
            'posts',
            'updated_by',
            'users',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-posts-id', 'posts');
        $this->dropForeignKey('fk-posts-created_by', 'posts');
        $this->dropForeignKey('fk-posts-updated_by', 'posts');
        $this->dropTable('{{%posts}}');
    }
}
