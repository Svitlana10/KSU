<?php

use yii\db\Migration;

/**
 * Class m190317_211413_update_articles_status_column
 */
class m190317_211413_update_articles_status_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%articles}}', 'status' , $this->integer()->defaultValue(\app\models\Article::STATUS_UNPUBLISH));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%articles}}', 'status' , $this->integer());
    }
}
