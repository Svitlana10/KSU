<?php

use yii\db\Migration;

/**
 * Class m190306_205650_add_base_admin
 */
class m190306_205650_add_base_admin extends Migration
{
    /**
     * @return bool|void
     * @throws \yii\base\Exception
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = new \app\models\User();
        $user->setPassword('admin@admin.admin');
        $user->generateAuthKey();

        $this->insert('{{%users}}',[
            'username'      => 'admin',
            'auth_key'      => $user->auth_key,
            'password_hash' => $user->password_hash,
            'email'         => 'admin@admin.admin',
            'status'        => \app\models\User::USER_STATUS_ADMIN,
            'avatar'        => '',
            'created_at'    => time(),
            'updated_at'    => time(),
        ]);

        echo 'User admin@admin.admin created!';
    }


    /**
     * @throws Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function safeDown()
    {
        if($user = \app\models\User::findOne(['email' => 'admin@admin.admin'])){
            $user->delete();
        }
    }
}
