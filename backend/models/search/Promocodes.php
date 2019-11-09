<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Promocodes as PromocodesModel;

/**
 * Promocodes represents the model behind the search form of `common\models\Promocodes`.
 */
class Promocodes extends PromocodesModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'percent', 'created_ts', 'updated_ts', 'status'], 'integer'],
            [['code', 'start_date', 'end_date'], 'safe'],
            [['sum', 'minorder_sum'], 'number'],
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
        $query = PromocodesModel::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'percent' => $this->percent,
            'created_ts' => $this->created_ts,
            'updated_ts' => $this->updated_ts,
            'sum' => $this->sum,
            'minorder_sum' => $this->minorder_sum,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
