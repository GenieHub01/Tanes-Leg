<?php

namespace common\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "promocodes".
 *
 * @property int $id
 * @property string $code
 * @property string $start_date
 * @property string $end_date
 * @property int $percent
 * @property int $created_ts
 * @property int $updated_ts
 * @property string $sum
 * @property string $minorder_sum
 * @property int $status
 */
class Promocodes extends \yii\db\ActiveRecord
{

    public $textDate;

    const STATUS_ACTIVE = 10;
    const STATUS_DISABLE = 1;
    const STATUS_DEFAULT  = self::STATUS_ACTIVE;

    public function getDesc(){
        " code :{$this->code} -". ($this->sum ? Yii::$app->formatter->asCurrency($this->sum) : Yii::$app->formatter->asPercent($this->percent/100));
    }

    static $_status = [

        self::STATUS_ACTIVE=>'Active',
          self::STATUS_DISABLE=>'Inactive'
        ];


    /**
     * @param $code
     * @return self
     */
    static function findPromocode($code){
        return  self::find()
//            ->andWhere(['>=','start_date',date('Y-m-d')])->orWhere(['start_date'=>null])
            ->andWhere("start_date<='".date('Y-m-d').'\' or start_date is null')
            ->andWhere(['code'=>$code,'status'=>Promocodes::STATUS_ACTIVE])
            ->andWhere(['>=','end_date',date('Y-m-d')])->one();

    }


    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_ts',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_ts',
                    // ActiveRecord::EVENT_BEFORE_UPDATE => 'date_updated',
                ],
                'value' => function () {
                    return time(); //
                },
            ],


//            'status' => [
//                'class' => AttributeBehavior::className(),
//                'attributes' => [
//                    ActiveRecord::EVENT_BEFORE_INSERT => 'status',
//                    //  ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_ts',
//                    // ActiveRecord::EVENT_BEFORE_UPDATE => 'date_updated',
//                ],
//                'value' => function () {
//                    return self::STATUS_ACTIVE; //
//                }
//            ],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promocodes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['end_date'], 'required'],
            [['code','status'], 'required'],
            [['status'], 'default','value'=>self::STATUS_DEFAULT],
            [['start_date', 'end_date'], 'safe'],
            [['percent', 'created_ts', 'updated_ts', 'status'], 'integer'],
            [['sum', 'minorder_sum'], 'number'],
            [['code'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'percent' => 'Percent',
            'created_ts' => 'Created Ts',
            'updated_ts' => 'Updated Ts',
            'sum' => 'Sum',
            'minorder_sum' => 'Minorder Sum',
            'status' => 'Status',
        ];
    }
}
