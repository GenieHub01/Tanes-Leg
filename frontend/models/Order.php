<?php

namespace frontend\models;

use common\models\Promocodes;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\Order as BaseOrder;

class Order extends BaseOrder
{

    public $promocode;

    /** @inheritdoc */
    public function __construct( $config = [])
    {
//        if ($this->isNewRecord){

//        }

        parent::__construct($config);
    }

    public function rules()
    {
      $rules =  parent::rules(); // TODO: Change the autogenerated stub
        $rules[]= ['promocode', 'validateCode'];
        $rules[]= ['promocode', 'string'];
        return $rules;
    }
    public function validateCode($attribute, $params, $validator)
    {

        if (!$this->promocode) {
            return true;
        }
        if (!preg_match('/^[a-z0-9_]*?$/i', $this->promocode)) {
            $this->addError($attribute, 'Invalid promocode');
            return false;
        }



        $model = Promocodes::findPromocode($this->promocode);

        if (!$model):
            $this->addError($attribute, 'This code not exist or expired.');
            return false;
        endif;

        $this->promocodes_id = $model->id;

        return true;


    }
    
}