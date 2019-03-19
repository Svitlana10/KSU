<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%show}}`.
 */
class m190307_114535_create_show_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%show}}', [
            'id'            => $this->primaryKey(),
            'title'          => $this->string()->notNull(),
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
            '{{%show}}',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-dog_show-user_id',
            '{{%show}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE','RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-dog_show-user_id', '{{%show}}');
        $this->dropIndex('idx-dog_show-user_id', '{{%show}}');
        $this->dropTable('{{%show}}');
    }
}
