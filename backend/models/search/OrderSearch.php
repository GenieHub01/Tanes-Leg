<?php

namespace backend\models\search;

use backend\models\Order;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Promocodes represents the model behind the search form of `common\models\Promocodes`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id' ], 'integer'],
            [['email'], 'safe'],
            [['status'], 'safe'],
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
        $query = Order::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }



        $query->andFilterWhere(['like', 'email', $this->email]);
        $query->andFilterWhere(['id'=>$this->id]);
        $query->andFilterWhere(['status'=>$this->status]);

        return $dataProvider;
    }
}
