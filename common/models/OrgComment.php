<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "org_comment".
 *
 * @property int $id
 * @property int $user_id
 * @property int $org_id
 * @property string $title
 * @property int $status
 * @property string $date
 *
 * @property Organization $organization
 * @property User $user
 */
class OrgComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'org_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'org_id', 'title'], 'required'],
            [['user_id', 'org_id', 'status'], 'integer'],
            [['title'], 'string'],
            [['date', 'status'], 'safe'],
            [['org_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['org_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'org_id' => 'Организация',
            'title' => 'Заглавие',
            'status' => 'Статус',
            'date' => 'Дата',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'org_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function extraFields()
    {
        return ['organization', 'user'];
    }
}
