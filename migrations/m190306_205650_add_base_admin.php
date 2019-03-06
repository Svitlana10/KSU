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
        $user->email = 'admin@admin.admin';
        $user->username = 'admin';
        $user->status = \app\models\User::USER_STATUS_ADMIN;
        $user->save();

        echo 'User admin@admin.admin created!';
    }


    /**
     * @return bool|false|int
     * @throws Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function safeDown()
    {
        if($user = \app\models\User::findOne(['email' => 'admin@admin.admin'])){
            return $user->delete();
        }
        return true;
    }
}
