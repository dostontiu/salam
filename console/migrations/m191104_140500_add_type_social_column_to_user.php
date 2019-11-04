<?php

use yii\db\Migration;

/**
 * Class m191104_140500_add_type_social_column_to_user
 */
class m191104_140500_add_type_social_column_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'type_social', $this->string(255)->null()->after('auth_key'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'type_social');
    }

}
