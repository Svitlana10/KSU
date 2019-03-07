<?php

namespace app\models;

use yii\base\Model;

/**
 * Class SignupForm
 * @package app\models
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['username','email','password'], 'required'],
            [['username'], 'string'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass'=>'app\models\User', 'targetAttribute'=>'email']
        ];
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function signup()
    {
        if($this->validate())
        {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            if($user->save()){
                return true;
            }
            $this->addErrors($user->getErrors());
        }

        return false;
    }
}