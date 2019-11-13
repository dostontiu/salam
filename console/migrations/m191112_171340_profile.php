<?php

use yii\db\Migration;

/**
 * Class m191112_171340_profile
 */
class m191112_171340_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('profile',[
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'father_name' => $this->string()->null(),
            'date_birth' => $this->date(),
            'image' => $this->string(),
            'telephone' => $this->string()->null(),
            'address' => $this->string()->null(),
        ]);
        $this->createIndex('idx-profile-user_id','profile','user_id');
        $this->addForeignKey('fk-profile-user_id','profile', 'user_id', 'user', 'id');
    }
    public function safeDown()
    {
        $this->dropForeignKey('fk-profile-user_id', 'profile');
        $this->dropIndex('idx-profile-user_id','profile');
        $this->dropTable('profile');
    }
}
