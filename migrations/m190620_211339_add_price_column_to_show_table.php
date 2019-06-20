<?php

use yii\db\Migration;

/**
 * Handles adding price to table `{{%show}}`.
 */
class m190620_211339_add_price_column_to_show_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('show', 'price', $this->float()->after('user_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('show', 'price');
    }
}
