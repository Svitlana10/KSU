<?php

use yii\db\Migration;

/**
 * Handles the creation of table `acrticle`.
 */
class m181016_060022_create_acrticle_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('article', [
            'id'            => $this->primaryKey(),
            'title'         => $this->string()->notNull(),
            'description'   => $this->text(),
            'content'       => $this->text(),
            'image'         => $this->string(),
            'viewed'        => $this->integer(),
            'user_id'       => $this->integer(),
            'status'        => $this->integer(),
            'category_id'   => $this->integer(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-article-user_id',
            'article',
            'user_id'
        );

        $this->createIndex(
            'idx-article-category_id',
            'article',
            'category_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
