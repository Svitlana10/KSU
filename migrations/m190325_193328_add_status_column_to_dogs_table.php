<?php

use yii\db\Migration;

/**
 * Class m190325_193328_add_status_column_to_dogs_table
 */
class m190325_193328_add_status_column_to_dogs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%dogs}}', 'status', $this->smallInteger()->after('owner')->defaultValue(\app\models\Dog::STATUS_NEW));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%dogs}}', 'status');
    }
}
