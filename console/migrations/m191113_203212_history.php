<?php

use yii\db\Migration;

/**
 * Class m191113_203212_history
 */
class m191113_203212_history extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('history', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'org_id' => $this->integer()->notNull(),
            'date' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createIndex('idx-history-user_id', 'history', 'user_id');
        $this->addForeignKey('fk-history-user_id', 'history', 'user_id', 'user', 'id');

        $this->createIndex('idx-history-org_id', 'history', 'org_id');
        $this->addForeignKey('fk-history-org_id', 'history', 'org_id', 'organization', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-history-user_id', 'history');
        $this->dropIndex('idx-history-user_id', 'history');

        $this->dropForeignKey('fk-history-org_id', 'history');
        $this->dropIndex('idx-history-org_id', 'history');

        $this->dropTable('history');
    }
}
