<?php

use app\models\User;
use yii\db\Migration;

/**
 * Class m190305_213056_create_base_user_admin
 */
class m190305_213056_create_base_user_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = new User();
        $user->name = "admin";
        $user->email = "admin@admin.com";
        $user->isAdmin = User::USER_IS_ADMIN;
        $user->password = "admin@admin.com";
        $user->save();
    }

    /**
     * @return bool|void
     * @throws Throwable
     * @throws \yii\db\StaleObjectException
     * {@inheritdoc}
     */
    public function safeDown()
    {
        if($user = User::findByEmail('admin@admin.com')){
            $user->delete();
        }

    }
}
