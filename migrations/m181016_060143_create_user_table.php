<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m181016_060143_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {

            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id'            => $this->primaryKey(),
            'username'      => $this->string()->notNull()->unique(),
            'auth_key'      => $this->string(32)->notNull(),
            'password_hash' => $this->string(),
            'email'         => $this->string()->notNull()->unique(),
            'status'        => $this->smallInteger()->notNull()->defaultValue(\app\models\User::USER_STATUS_NOT_ACTIVE),
            'avatar'        => $this->string()->defaultValue(null),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull(),
        ], $tableOptions);

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-article-user_id',
            'article',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
