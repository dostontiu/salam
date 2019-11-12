<?php

use yii\db\Migration;

/**
 * Class m191112_073112_org_filter
 */
class m191112_073112_org_filter extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('org_filter', [
            'id_id' => $this->primaryKey(),
            'organization_id' => $this->integer()->notNull(),
            'filter_id' => $this->integer()->notNull(),
        ]);
        // creates index for column `organization_id`
        $this->createIndex(
            'idx-org_filter-organization_id',
            'org_filter',
            'organization_id'
        );
        // add foreign key for table `organization`
        $this->addForeignKey(
            'fk-org_filter-organization_id',
            'org_filter',
            'organization_id',
            'organization',
            'id',
            'CASCADE'
        );
        // creates index for column `filter_id`
        $this->createIndex(
            'idx-org_filter-filter_id',
            'org_filter',
            'filter_id'
        );
        // add foreign key for table `filter`
        $this->addForeignKey(
            'fk-org_filter-filter_id',
            'org_filter',
            'filter_id',
            'filter',
            'id',
            'CASCADE'
        );
    }
    public function down()
    {
        $this->dropForeignKey(
            'fk-org_filter-organization_id',
            'org_filter'
        );
        $this->dropIndex(
            'idx-org_filter-organization_id',
            'org_filter'
        );
        $this->dropForeignKey(
            'fk-org_filter-filter_id',
            'org_filter'
        );
        $this->dropIndex(
            'idx-org_filter-filter_id',
            'org_filter'
        );
        $this->dropTable('org_filter');
    }
}
