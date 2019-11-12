<?php

namespace common\models\search;

use common\models\Filter;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * FilterQuery represents the model behind the search form of `common\models\Filter`.
 */
class FilterQuery extends Filter
{
    public $fullName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['icon', 'name_tj', 'name_en', 'name_ru', 'fullName'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Filter::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'fullName' => [
                    'asc' => ['name_tj' => SORT_ASC, 'name_en' => SORT_ASC, 'name_ru' => SORT_ASC],
                    'desc' => ['name_tj' => SORT_DESC, 'name_en' => SORT_DESC, 'name_ru' => SORT_DESC],
                    'label' => 'Full Name',
                    'default' => SORT_ASC
                ],
                'region_id',
                'rating',
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andWhere(
            'name_tj LIKE "%' . $this->fullName  . '%" '
            .'OR name_en LIKE "%' . $this->fullName . '%"'
            .'OR name_ru LIKE "%' . $this->fullName . '%"'
        );

        $query->andFilterWhere(['like', 'name_tj', $this->name_tj])
            ->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru]);

        return $dataProvider;
    }
}
