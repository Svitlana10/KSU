<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dog_show}}`.
 */
class m190307_114535_create_dog_show_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dog_show}}', [
            'id'            => $this->primaryKey(),
            'tile'          => $this->string()->notNull(),
            'description'   => $this->text()->notNull(),
            'address'       => $this->string()->notNull(),
            'show_date'     => $this->integer()->notNull(),
            'img'           => $this->string(),
            'start_reg_date'=> $this->integer(),
            'end_reg_date'  => $this->integer(),
            'user_id'       => $this->integer(),
            'created_at'    => $this->integer(),
            'updated_at'    => $this->integer(),
        ]);

        $this->createIndex(
            'idx-dog_show-user_id',
            '{{%dog_show}}',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-dog_show-user_id',
            '{{%dog_show}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-dog_show-user_id', '{{%dog_show}}');
        $this->dropForeignKey('fk-dog_show-user_id', '{{%dog_show}}');
        $this->dropTable('{{%dog_show}}');
    }
}
