<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_tag`.
 */
class m181016_060258_create_article_tag_table extends Migration
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

        $this->createTable('{{%article_tag}}', [
            'id'            => $this->primaryKey(),
            'article_id'    => $this->integer(),
            'tag_id'        => $this->integer(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `user_id`
        $this->createIndex(
            'tag_article_article_id',
            'article_tag',
            'article_id'
        );


        // add foreign key for table `user`
        $this->addForeignKey(
            'tag_article_article_id',
            'article_tag',
            'article_id',
            'articles',
            'id',
            'CASCADE','RESTRICT'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx_tag_id',
            'article_tag',
            'tag_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-tag_id',
            'article_tag',
            'tag_id',
            'tags',
            'id',
            'CASCADE','RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('idx_tag_id', 'article_tag');
        $this->dropIndex('tag_article_article_id', 'article_tag');
        $this->dropForeignKey('tag_article_article_id', 'article_tag');
        $this->dropForeignKey('fk-tag_id', 'article_tag');
        $this->dropTable('{{%article_tag}}');
    }
}
