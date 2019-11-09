<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\User as UserModel;

/**
 * User represents the model behind the search form of `backend\models\User`.
 */
class User extends UserModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'role'], 'integer'],
            [['auth_key', 'password_hash', 'password_reset_token', 'email', 'verification_token', 'token', 'first_name', 'last_name', 'shipping_address', 'shipping_address_optional', 'shipping_city', 'shipping_postcode', 'shipping_phone', 'username'], 'safe'],
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
        $query = UserModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);



        $this->load($params);

        $query->andWhere(['<>','status',self::STATUS_DELETED]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
             $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'role' => $this->role,
        ]);

        $query->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'verification_token', $this->verification_token])
            ->andFilterWhere(['like', 'token', $this->token])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'shipping_address', $this->shipping_address])
            ->andFilterWhere(['like', 'shipping_address_optional', $this->shipping_address_optional])
            ->andFilterWhere(['like', 'shipping_city', $this->shipping_city])
            ->andFilterWhere(['like', 'shipping_postcode', $this->shipping_postcode])
            ->andFilterWhere(['like', 'shipping_phone', $this->shipping_phone])
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
