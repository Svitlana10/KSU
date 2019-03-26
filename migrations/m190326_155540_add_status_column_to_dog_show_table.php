<?php

use yii\db\Migration;

/**
 * Handles adding status to table `{{%dog_show}}`.
 */
class m190326_155540_add_status_column_to_dog_show_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%dog_show}}', 'status', $this->smallInteger()->after('dog_id')->defaultValue(\app\models\DogShow::STATUS_NEW));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%dog_show}}', 'status');
    }
}
