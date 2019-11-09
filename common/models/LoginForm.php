<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            ['email', 'email'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
          'email'  =>Yii::t('app','Email'),
          'username'  =>Yii::t('app','Username'),
          'rememberMe'  =>Yii::t('app','Remember me'),
          'password'  =>Yii::t('app','Password'),

           
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)){
                $this->addError($attribute, 'Incorrect username or password.');
                return false;
            }


            if ($user->status == User::STATUS_DELETED){
                $this->addError($attribute, 'Your account has been locked out, please contact us.');
                return false;
            }

            if ($user->status == User::STATUS_INACTIVE){
                $this->addError($attribute, 'Your should validate email first.');
                return false;
            }




        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail2($this->email);
        }

        return $this->_user;
    }
}
