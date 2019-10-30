<?php

use yii\db\Migration;

/**
 * Class m190911_060626_category
 */
class m190911_060626_category extends Migration
{
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'icon' => $this->string()->notNull(),
            'name_tj' => $this->string()->notNull(),
            'name_en' => $this->string()->notNull(),
            'name_ru' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('category');
    }
}
