<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "codes".
 *
 * @property string $title
 * @property int $type
 * @property string $value
 */
class Codes extends \yii\db\ActiveRecord
{

    const COUNTRY_SHIPPING_CODE = 1;
    const COUNTRY_TAX_CODE = 2;
    const HOLDING_CHARGE_CODE = 3;
    const PRODUCT_EXTRA_SHIPPING_CODE = 4;

    static $_type = [
        self::COUNTRY_SHIPPING_CODE => 'COUNTRY SHIPPING CODE',
        self::COUNTRY_TAX_CODE => 'COUNTRY TAX CODE',
        self::HOLDING_CHARGE_CODE => 'HOLDING DEPOSIT CODE',
        self::PRODUCT_EXTRA_SHIPPING_CODE => 'PRODUCT EXTRA SHIPPING CODE',

    ];


    static function getCodes($type){
        return ArrayHelper::map(self::findAll(['type'=>$type]),'id','name');
    }

    public function getName(){

        $value = $this->type == self::COUNTRY_TAX_CODE ? Yii::$app->formatter->asPercent($this->value/100) : Yii::$app->formatter->asCurrency($this->value);
        return "$this->title ($value)";
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'codes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'type'], 'required'],
            [['type'], 'integer'],
            [['value'], 'number'],
            [['title'], 'string', 'max' => 15],
            [['title', 'type'], 'unique', 'targetAttribute' => ['title', 'type']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'type' => 'Type',
            'value' => 'Value',
        ];
    }
}
