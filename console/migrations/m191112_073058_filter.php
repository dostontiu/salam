<?php

use yii\db\Migration;

/**
 * Class m191112_073058_filter
 */
class m191112_073058_filter extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('filter', [
            'id' => $this->primaryKey(),
            'name_tj' => $this->string()->notNull(),
            'name_en' => $this->string()->notNull(),
            'name_ru' => $this->string()->notNull(),
        ]);

    }
    public function down()
    {
        $this->dropTable('filter');
    }
}
