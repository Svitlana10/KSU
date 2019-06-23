<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190620_220034_add_messages_table
 */
class m190620_220034_add_messages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%messages}}', [
            'id'         => Schema::TYPE_PK . ' NOT NULL',
            'from_id'    => Schema::TYPE_INTEGER . ' NULL',
            'whom_id'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'message'    => Schema::TYPE_STRING  . '(750) NOT NULL',
            'status'     => Schema::TYPE_INTEGER . ' DEFAULT 0',
            'is_delete_from' => Schema::TYPE_INTEGER . ' DEFAULT 0',
            'is_delete_whom' => Schema::TYPE_INTEGER . ' DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
        ], $tableOptions);

        $this->createIndex('idx-messages-from_id', '{{%messages}}', 'from_id');
        $this->createIndex('idx-messages-whom_id', '{{%messages}}', 'whom_id');
        $this->addForeignKey(
            'fk-messages-from_id-user-id', '{{%messages}}', 'from_id', '{{%users}}', 'id'
        );
        $this->addForeignKey(
            'fk-messages-whom_id-user-id', '{{%messages}}', 'whom_id', '{{%users}}', 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-messages-from_id-user-id', '{{%messages}}');
        $this->dropIndex('idx-messages-from_id', '{{%messages}}');

        $this->dropForeignKey('fk-messages-whom_id-user-id', '{{%messages}}');
        $this->dropIndex('idx-messages-whom_id', '{{%messages}}');

        $this->dropTable('{{%messages}}');
    }
}
