<?php

use yii\db\Migration;

/**
 * Class m191031_104501_org_comment
 */
class m191031_104501_org_comment extends Migration
{

    public function up()
    {
        $this->createTable('org_comment', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'org_id' => $this->integer()->notNull(),
            'title' => $this->text()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(1),
            'date' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createIndex('idx-org_comment-user_id', 'org_comment', 'user_id');
        $this->addForeignKey('fk-org_comment-user_id', 'org_comment', 'user_id', 'user', 'id', 'CASCADE');

        $this->createIndex('idx-org_comment-org_id', 'org_comment', 'org_id');
        $this->addForeignKey('fk-org_comment-org_id', 'org_comment', 'org_id', 'organization', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk-org_comment-user_id', 'org_comment');
        $this->dropIndex('idx-org_comment-user_id', 'org_comment');

        $this->dropForeignKey('fk-org_comment-org_id', 'org_comment');
        $this->dropIndex('idx-org_comment-org_id', 'org_comment');

        $this->dropTable('org_comment');
    }

}
