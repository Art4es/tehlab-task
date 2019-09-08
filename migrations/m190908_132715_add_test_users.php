<?php

use app\models\User;
use yii\db\Migration;

/**
 * Class m190908_132715_add_test_users
 */
class m190908_132715_add_test_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users', [
            'username' => 'admin',
            'password_hash' => sha1('admin'),
            'role' => User::ROLE_ADMIN,
            'is_active' => User::STATUS_ACTIVE
        ]);
        $this->insert('users', [
            'username' => 'user',
            'password_hash' => sha1('user'),
            'role' => User::ROLE_USER,
            'is_active' => User::STATUS_ACTIVE
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('users',
            ['username' => 'admin']);
        $this->delete('users',
            ['username' => 'user']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190908_132715_add_test_users cannot be reverted.\n";

        return false;
    }
    */
}
