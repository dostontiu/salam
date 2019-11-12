<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property int $id
 * @property string $icon
 * @property string $name_tj
 * @property string $name_en
 * @property string $name_ru
 *
 * @property Category[] $categories
 */
class Category extends \yii\db\ActiveRecord
{
    public $image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_tj', 'name_en', 'name_ru'], 'required'],
            [['icon', 'name_tj', 'name_en', 'name_ru'], 'string', 'max' => 255],
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
            'icon' => 'Икона',
            'name_tj' => 'Название (ТЖ)',
            'name_en' => 'Название (EN)',
            'name_ru' => 'Название (РУ)',
            'fullName' => 'Название',
        ];
    }

    public function getOrganizations()
    {
        return $this->hasMany(Organization::className(), ['category_id' => 'id']);
    }

    /* Getter for all name */
    public function getFullName() {
        return Html::a(($this->name_ru)?$this->name_ru:'На другом языке',['view', 'id' => $this->id]);
    }

    public function extraFields()
    {
        return ['organizations'];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($this->icon==null){
            Yii::$app->session->setFlash('error', "Нужно загрузить изображение");
            return false;
        }
        return true;
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['icon'] = function($model){
            return Url::base(true).'/uploads/'.$model->icon;
        };
        return $fields;
    }
}
