<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name','email','password'], 'required'],
            [['name'], 'string'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass'=>'app\models\User', 'targetAttribute'=>'email']
        ];
    }

    /**
     * @return bool
     */
    public function signup()
    {
        if($this->validate())
        {
            $user = new User();
            $user->setAttributes($this->getAttributes());

            if($user->save()){
                return true;
            }
            $this->addErrors($user->getErrors());
        }

        return false;
    }
}