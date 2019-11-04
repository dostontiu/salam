<?php

namespace common\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%organization}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $region_id
 * @property int $category_id
 * @property string $rating
 * @property string $photo
 * @property string $gps
 * @property string $name_tj
 * @property string $name_en
 * @property string $name_ru
 * @property string $type_tj
 * @property string $type_en
 * @property string $type_ru
 * @property string $description_tj
 * @property string $description_en
 * @property string $description_ru
 *
 * @property Region $region
 * @property User $user
 * @property Category $category
 * @property OrgComment[] $orgComments
 */
class Organization extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%organization}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'rating', 'gps', 'category_id'], 'required'],
            [['user_id', 'region_id', 'category_id'], 'integer'],
            [['rating', 'photo', 'gps', 'name_tj', 'name_en', 'name_ru', 'type_tj', 'type_en', 'type_ru', 'description_tj', 'description_en', 'description_ru'], 'string', 'max' => 255],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
            [['image'], 'file', 'maxSize'=>'1048580'],
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
            'region_id' => 'Область',
            'rating' => 'Рейтинг',
            'photo' => 'Фото',
            'gps' => 'Геолокация',
            'name_tj' => 'Название (ТЖ)',
            'name_en' => 'Название (EN)',
            'name_ru' => 'Название (РУ)',
            'type_tj' => 'Тип (ТЖ)',
            'type_en' => 'Тип (EN)',
            'type_ru' => 'Тип (РУ)',
            'fullName' => 'Название',
            'allType' => 'Название типы',
            'description_tj' => 'Описание (ТЖ)',
            'description_en' => 'Описание (EN)',
            'description_ru' => 'Описание (РУ)',
            'category_id' => 'Категория',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /* Getter for all name */
    public function getFullName() {
        return Html::a(($this->name_ru)?$this->name_ru:'На другом языке',['view', 'id' => $this->id]);
    }

    public function getAllType() {
        return $this->type_ru ? $this->type_ru : 'На другом языке';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory(){
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getOrgComments()
    {
        return $this->hasMany(OrgComment::className(), ['org_id' => 'id'])->where(['status' => 1])->with('user');
    }

    public function extraFields()
    {
        return ['region', 'category', 'comments' => 'orgComments', 'user'];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ( ($this->name_tj!=null && $this->type_tj!=null && $this->description_tj!=null) || ($this->name_en!=null && $this->type_en!=null && $this->description_en!=null) || ($this->name_ru!=null && $this->type_ru!=null && $this->description_ru!=null) ){
            if ($this->photo==null){
                Yii::$app->session->setFlash('error', "Нужно загрузить изображение");
                return false;
            }
            return true;
        } else {
            Yii::$app->session->setFlash('error', "Пожалуйста, укажите хотя бы один язык");
            return false;
        }
    }
}
