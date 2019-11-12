<?php

namespace common\models;

use yii\helpers\ArrayHelper;

class OrgWithFilter extends Organization
{
    /**
     * @var array IDs of the filters
     */
    public $filter_ids = []; //shunaqa qildim endi

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            // each filter_id must exist in filter table (*1)
            ['filter_ids', 'each', 'rule' => [
                'exist', 'targetClass' => Filter::className(), 'targetAttribute' => 'id'
            ]
            ],
        ]);
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'filter_ids' => 'Filters',
        ]);
    }

    /**
     * load the organization's filters (*2)
     */
    public function loadFilters()
    {
        $this->filter_ids = [];
        if (!empty($this->id)) {
            $rows = OrgFilter::find()
                ->select(['filter_id'])
                ->where(['organization_id' => $this->id])
                ->asArray()
                ->all();
            foreach($rows as $row) {
                $this->filter_ids[] = $row['filter_id'];
            }
        }
    }

    /**
     * save the organization's filters (*3)
     */
    public function saveFilters()
    {
        /* clear the filters of the organization before saving */
        OrgFilter::deleteAll(['organization_id' => $this->id]);
        if (is_array($this->filter_ids)) {
            foreach($this->filter_ids as $filter_id) {
                $pc = new OrgFilter();
                $pc->organization_id = $this->id;
                $pc->filter_id = $filter_id;
                $pc->save();
            }
        }
    }

    /**
     * Get all the available categories (*4)
     * @return array available categories
     */
    public static function getAvailableFilters()
    {
        $filters = Filter::find()->orderBy('name_ru')->asArray()->all() ?? [];
        return ArrayHelper::map($filters, 'id', 'name_ru');
    }
}