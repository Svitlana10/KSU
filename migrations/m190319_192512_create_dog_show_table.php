<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dog_show}}`.
 */
class m190319_192512_create_dog_show_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%dog_show}}', [
            'id'            => $this->primaryKey(),
            'dog_id'        => $this->integer(),
            'show_id'       => $this->integer(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-dog-show-dog_id',
            'dog_show',
            'dog_id'
        );


        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-dog-show-dog_id',
            'dog_show',
            'dog_id',
            'dogs',
            'id',
            'CASCADE','RESTRICT'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-dog-show-show_id',
            'dog_show',
            'show_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-dog-show-show_id',
            'dog_show',
            'show_id',
            'show',
            'id',
            'CASCADE','RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-dog-show-dog_id', 'dog_show');
        $this->dropForeignKey('fk-dog-show-show_id', 'dog_show');
        $this->dropIndex('idx-dog-show-dog_id', 'dog_show');
        $this->dropIndex('idx-dog-show-show_id', 'dog_show');
        $this->dropTable('{{%dog_show}}');
    }
}
