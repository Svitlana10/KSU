<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dog_breeds}}`.
 */
class m190319_183217_create_dog_breeds_table extends Migration
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

        $this->createTable('{{%dog_breeds}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk-dogs-breed_id','dogs','breed_id',
            '{{%dog_breeds}}','id','CASCADE','RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-dogs-breed_id', '{{%dog_breeds}}');
        $this->dropTable('{{%dog_breeds}}');
    }
}
