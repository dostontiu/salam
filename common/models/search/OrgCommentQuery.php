<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OrgComment;

/**
 * OrgCommentQuery represents the model behind the search form of `common\models\OrgComment`.
 */
class OrgCommentQuery extends OrgComment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status'], 'integer'],
            [['title', 'date', 'org_id'], 'safe'],
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
        $query = OrgComment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if($this->org_id != null){
            $query->andWhere(['IN', 'org_id', (new \yii\db\Query())->select('id')->from('organization')->orWhere(['like', 'name_tj', $this->org_id])->orWhere(['like', 'name_en', $this->org_id])->orWhere(['like', 'name_ru', $this->org_id]) ]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'date', $this->date]);

        return $dataProvider;
    }
}
