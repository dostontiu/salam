<?php

namespace common\models;

use yii\helpers\Html;

/**
 * This is the model class for table "{{%filer}}".
 *
 * @property int $id
 * @property string $name_tj
 * @property string $name_en
 * @property string $name_ru
*
 * @property OrgFilter[] $organizationFilters
 */
class Filter extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%filter}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_tj', 'name_en', 'name_ru'], 'required'],
            [['name_tj', 'name_en', 'name_ru'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_tj' => 'Название (ТЖ)',
            'name_en' => 'Название (EN)',
            'name_ru' => 'Название (РУ)',
            'fullName' => 'Название',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationFilters()
    {
        return $this->hasMany(OrgFilter::className(), ['filter_id' => 'id'])->with('organization');
    }

    /* Getter for all name */
    public function getFullName() {
        return Html::a(($this->name_ru)?$this->name_ru:'На другом языке',['view', 'id' => $this->id]);
    }

    public function fields()
    {
        return [
            'id',
            'name_tj',
            'name_en',
            'name_ru',
            'organizations' => 'organizationFilters'
        ];
    }
}
