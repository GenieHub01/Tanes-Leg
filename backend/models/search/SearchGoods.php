<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Goods;

/**
 * SearchGoods represents the model behind the search form of `common\models\Goods`.
 */
class SearchGoods extends Goods
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'import_id', 'category_id', 'fuel', 'stock_status', 'tax_status', 'status', 'tax_id', 'use_holdingcharge'], 'integer'],
            [[ 'holdingcharge_id','extra_shipping_id'], 'integer'],
            [['title', 'uri', 'description', 'images', 'brand', 'model', 'engine_type', 'add_info', 'oem_exchange', 'engine_capacity', 'engine_power', 'part_number_list', 'comparison_number_list', 'sku', 'category_string', 'years_string'], 'safe'],
            [['purchase_price', 'regular_price', 'sale_price'], 'number'],
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
        $query = Goods::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'import_id' => $this->import_id,
            'purchase_price' => $this->purchase_price,
            'regular_price' => $this->regular_price,
            'sale_price' => $this->sale_price,
            'category_id' => $this->category_id,
            'holdingcharge_id' => $this->holdingcharge_id,
            'extra_shipping_id' => $this->extra_shipping_id,
            'fuel' => $this->fuel,
            'stock_status' => $this->stock_status,
            'tax_status' => $this->tax_status,
            'status' => $this->status,
            'tax_id' => $this->tax_id,
            'use_holdingcharge' => $this->use_holdingcharge,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'uri', $this->uri])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'engine_type', $this->engine_type])
            ->andFilterWhere(['like', 'add_info', $this->add_info])
            ->andFilterWhere(['like', 'oem_exchange', $this->oem_exchange])
            ->andFilterWhere(['like', 'engine_capacity', $this->engine_capacity])
            ->andFilterWhere(['like', 'engine_power', $this->engine_power])
            ->andFilterWhere(['like', 'part_number_list', $this->part_number_list])
            ->andFilterWhere(['like', 'comparison_number_list', $this->comparison_number_list])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'category_string', $this->category_string])
            ->andFilterWhere(['like', 'years_string', $this->years_string]);

        return $dataProvider;
    }
}
