<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categories`.
 */
class m181016_060107_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull(),
        ], $tableOptions);

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-article-category_id',
            'articles',
            'category_id',
            '{{%categories}}',
            'id',
            'CASCADE','RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-article-category_id', '{{%categories}}');
        $this->dropTable('{{%categories}}');
    }
}
