<?php

use yii\db\Migration;

/**
 * Class m190325_175956_add_status_column_to_dog_breeds_table
 */
class m190325_175956_add_status_column_to_dog_breeds_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%dog_breeds}}', 'status', $this->smallInteger()->after('title')->defaultValue(\app\models\DogBreeds::STATUS_NEW));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%dog_breeds}}', 'status');
    }
}
