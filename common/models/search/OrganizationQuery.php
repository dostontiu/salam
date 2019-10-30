<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Organization;

/**
 * OrganizationQuery represents the model behind the search form of `common\models\Organization`.
 */
class OrganizationQuery extends Organization
{
    /* your calculated attribute */
    public $fullName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'region_id'], 'integer'],
            [['rating', 'photo', 'gps', 'name_tj', 'name_en', 'name_ru', 'type_tj', 'type_en', 'type_ru', 'description_tj', 'description_en', 'description_ru', 'category', 'fullName'], 'safe'],
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
        $query = Organization::find()->with('region');

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
                'type_tj',
                'type_en',
                'type_ru',
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'region_id' => $this->region_id,
        ]);

        $query->andWhere(
            'name_tj LIKE "%' . $this->fullName  . '%" '
            .'OR name_en LIKE "%' . $this->fullName . '%"'
            .'OR name_ru LIKE "%' . $this->fullName . '%"'
        );
        $query->andFilterWhere(['like', 'rating', $this->rating])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'gps', $this->gps])
            ->andFilterWhere(['like', 'name_tj', $this->name_tj])
            ->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'type_tj', $this->type_tj])
            ->andFilterWhere(['like', 'type_en', $this->type_en])
            ->andFilterWhere(['like', 'type_ru', $this->type_ru])
            ->andFilterWhere(['like', 'description_tj', $this->description_tj])
            ->andFilterWhere(['like', 'description_en', $this->description_en])
            ->andFilterWhere(['like', 'description_en', $this->description_en]);

        return $dataProvider;
    }
}
