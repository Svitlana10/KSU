<?php

namespace app\models\forms;

use app\models\User;
use yii\base\Exception;
use yii\base\Model;

/**
 * Class SignupForm
 * @package app\models\forms
 */
class SignupForm extends Model
{
    /** @var string $username */
    public $username;

    /** @var string $email */
    public $email;

    /** @var string $password */
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
            [['username'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'username'],
            [['email'], 'unique', 'targetClass'=> User::class , 'targetAttribute'=>'email']
        ];
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function signup()
    {
        if($this->validate()) {
            return false;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if($user->save()){
            return true;
        }
        $this->addErrors($user->getErrors());

        return false;
    }
}