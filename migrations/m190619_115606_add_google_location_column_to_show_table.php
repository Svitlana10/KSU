<?php

use yii\db\Migration;

/**
 * Handles adding google_location to table `{{%show}}`.
 */
class m190619_115606_add_google_location_column_to_show_table extends Migration
{

    /**
     * @var string $table
     */
    private $table = '{{%show}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table, 'google_location', $this->text()->after('user_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->table, 'google_location');
    }
}
