<?php

namespace frontend\models;


use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class SettingsForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $shipping_address;
    public $shipping_address_optional;
    public $shipping_city;
    public $shipping_postcode;
    public $shipping_phone;
    public $country_id;


    private $_user;


    public function getUser()
    {
        if ($this->_user == null) {
            $this->_user = Yii::$app->user->identity;
        }

        return $this->_user;
    }

    /** @inheritdoc */
    public function __construct($config = [])
    {

        $this->setAttributes([
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
            'username' => $this->user->username,
            'country_id' => $this->user->country_id,
//            'email'    => $this->user->email,
            'shipping_address' => $this->user->shipping_address,
            'shipping_address_optional' => $this->user->shipping_address_optional,
            'shipping_city' => $this->user->shipping_city,
            'shipping_postcode' => $this->user->shipping_postcode,
            'shipping_phone' => $this->user->shipping_phone,
        ], false);
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['country_id', 'integer'],
            ['username', 'trim'],
//            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'email'],
//            ['email', 'unique'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

//            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            [['first_name', 'last_name', 'shipping_address', 'shipping_address_optional'
                , 'shipping_city', 'shipping_postcode', 'shipping_phone'], 'string', 'max' => 40]


        ];
    }


    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'country_id' => 'Country',

        ];
    }


    public function save()
    {
        if ($this->validate()) {
            $this->user->setAttributes([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'country_id' => $this->country_id,
                'username' => $this->username,
                'shipping_address' => $this->shipping_address,
                'shipping_address_optional' => $this->shipping_address_optional,
                'shipping_city' => $this->shipping_city,
                'shipping_postcode' => $this->shipping_postcode,
                'shipping_phone' => $this->shipping_phone,

            ], false);

            if ($this->email) {
                $this->user->setAttributes([
                    'email' => $this->email
                ], false);
            }

            if ($this->password){
                $this->user->setPassword($this->password);
                $this->user->generateAuthKey();
            }


            return $this->user->save();
        }

        return false;
    }
}
