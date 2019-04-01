<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dog_types}}`.
 */
class m190319_183227_create_dog_types_table extends Migration
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

        $this->createTable('{{%dog_types}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk-dogs-type_id','dogs','type_id',
            '{{%dog_types}}','id','CASCADE','RESTRICT');

        $this->batchInsert('{{%dog_types}}', ['title', 'created_at', 'updated_at'],[
            ["Кобель", time(), time()],
            ['Сучка', time(), time()],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-dogs-type_id', '{{%dog_types}}');
        $this->dropTable('{{%dog_types}}');
    }
}
