<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m190907_130058_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->bigPrimaryKey(),
            'username' => $this->string(50)->unique()->notNull(),
            'password_hash' => $this->string(50)->notNull(),
            'role' => $this->integer()->notNull(),
            'is_active' => $this->binary()->notNull(),
        ]);
        $this->createIndex(
            'idx-users-id',
            'users',
            'id'
        );
        $this->createIndex(
            'idx-users-username',
            'users',
            'username'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-users-id', 'users');
        $this->dropIndex('idx-users-username', 'users');
        $this->dropTable('{{%users}}');
    }
}
