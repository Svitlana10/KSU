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
        $this->insert('{{%users}}',[
            'username'      => 'admin',
            'auth_key'      => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('admin@admin.admin'),
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
