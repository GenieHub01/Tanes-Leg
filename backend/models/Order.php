<?php

namespace backend\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\Order as BaseOrder;

class Order extends BaseOrder
{

    static $_statusClass=[
        self::STATUS_NEW => 'border-info  ',
        self::STATUS_END=>'border-success  '
    ];


   public function rules()
   {
       $rules =  parent::rules(); // TODO: Change the autogenerated stub
       $rules[] = ['admin_note','string'];
       $rules[] = ['status','integer'];
       return $rules;
   }

}