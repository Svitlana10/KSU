<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comments`.
 */
class m181016_060158_create_comment_table extends Migration
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

        $this->createTable('{{%comments}}', [
            'id'            => $this->primaryKey(),
            'text'          => $this->string(),
            'user_id'       => $this->integer(),
            'article_id'    => $this->integer(),
            'status'        => $this->integer(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-post-user_id',
            'comments',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-post-user_id',
            'comments',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        // creates index for column `article_id`
        $this->createIndex(
            'idx-article_id',
            'comments',
            'article_id'
        );

        // add foreign key for table `article`
        $this->addForeignKey(
            'fk-article_id',
            'comments',
            'article_id',
            'articles',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('idx-article_id', 'comments');
        $this->dropIndex('idx-post-user_id', 'comments');
        $this->dropForeignKey('fk-post-user_id-user_id', 'comments');
        $this->dropForeignKey('fk-article_id', 'comments');
        $this->dropTable('{{%comments}}');
    }
}
