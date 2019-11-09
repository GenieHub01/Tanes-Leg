<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "years".
 *
 * @property int $year
 * @property int $goods_id
 *
 * @property Goods $goods
 */
class Years extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'years';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year', 'goods_id'], 'required'],
            [['year', 'goods_id'], 'integer'],
            [['year', 'goods_id'], 'unique', 'targetAttribute' => ['year', 'goods_id']],
            [['goods_id'], 'exist', 'skipOnError' => true, 'targetClass' => Goods::className(), 'targetAttribute' => ['goods_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'year' => 'Year',
            'goods_id' => 'Goods ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['id' => 'goods_id']);
    }
}
