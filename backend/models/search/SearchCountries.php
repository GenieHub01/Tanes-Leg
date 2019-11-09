<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Countries;

/**
 * SearchCountries represents the model behind the search form of `common\models\Countries`.
 */
class SearchCountries extends Countries
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tax_id','shipping_id', 'created_ts'], 'integer'],
            [['title', 'shortcode'], 'safe'],

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
        $query = Countries::find();

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
            'tax_id' => $this->tax_id,
            'shipping_id' => $this->shipping_id,
            'created_ts' => $this->created_ts,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'shortcode', $this->shortcode]);

        return $dataProvider;
    }
}
