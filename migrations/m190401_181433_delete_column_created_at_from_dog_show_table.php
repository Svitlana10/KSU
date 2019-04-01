<?php

use yii\db\Migration;

/**
 * Class m190401_181433_delete_column_created_at_from_dog_show_table
 */
class m190401_181433_delete_column_created_at_from_dog_show_table extends Migration
{
    private $table = "{{%dog_show}}";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn($this->table, 'created_at');
        $this->dropColumn($this->table, 'updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn($this->table, 'created_at', $this->integer());
        $this->addColumn($this->table, 'updated_at', $this->integer());
    }
}
