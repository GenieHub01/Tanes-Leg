<?php
namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use common\models\User as BaseUser;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends BaseUser implements IdentityInterface
{

    public function rules(){
        $rules = parent::rules();

        $rules[] = ['username', 'trim'];
        $rules[] = ['country_id', 'integer'];
//            ['username', 'required'],
        $rules[] =['username', 'unique',   'message' => 'This username has already been taken.'];
            $rules[] =['username', 'string', 'min' => 2, 'max' => 255];
           $rules[] = ['email', 'trim'];
           $rules[] = ['email', 'email'];
//            ['email', 'unique'],
           $rules[] = ['email', 'string', 'max' => 255];
           $rules[] = ['email', 'unique',  'message' => 'This email address has already been taken.'];
           $rules[] = ['email', 'unique',  'message' => 'This email address has already been taken.'];
           $rules['role_range'] = ['role', 'in', 'range' => [self::ROLE_MODER, self::ROLE_USER,self::ROLE_ADMIN ]];

           unset($rules['pass_length']);
           return $rules;

    }
}