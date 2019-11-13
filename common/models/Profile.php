<?php

namespace common\models;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $father_name
 * @property string $date_birth
 * @property string $image
 * @property string $telephone
 * @property string $address
 * @property File $file
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name', 'last_name'], 'required'],
            [['user_id'], 'integer'],
            [['date_birth', 'file'], 'safe'],
            [['first_name', 'last_name', 'father_name', 'image', 'telephone', 'address'], 'string', 'max' => 255],
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
            'user_id' => 'ID пользователя',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'father_name' => 'Отчества',
            'date_birth' => 'Дата рождения',
            'image' => 'Изображение',
            'telephone' => 'Телефон',
            'address' => 'Адрес',
            'file' => 'Файл',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
