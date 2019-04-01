<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dogs}}`.
 */
class m190319_181940_create_dogs_table extends Migration
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

        $this->createTable('{{%dogs}}', [
            'id' => $this->primaryKey(),
            'dog_name' => $this->string(),
            'breed_id' => $this->integer(),
            'pedigree_number' => $this->string(),
            'owner' => $this->string(),
            'months' => $this->integer(),
            'type_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-dogs-breed_id','dogs','breed_id');
        $this->createIndex('idx-dogs-type_id','dogs','type_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-dogs-type_id', '{{%dogs}}');
        $this->dropIndex('idx-dogs-breed_id', '{{%dogs}}');
        $this->dropTable('{{%dogs}}');
    }
}
