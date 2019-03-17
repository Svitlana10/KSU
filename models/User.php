<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property integer $status
 * @property string $avatar
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property bool $isAdmin
 * @property bool $isModer
 * @property null $userStatus
 * @property mixed $password
 * @property string $image
 * @property string $authKey
 * @property Comment[] $comments
 */
class User extends ActiveRecord implements IdentityInterface
{
    const USER_STATUS_NOT_ACTIVE = 0;
    const USER_STATUS_BANNED     = 1;
    const USER_STATUS_USER       = 2;
    const USER_STATUS_MODERATOR  = 3;
    const USER_STATUS_ADMIN      = 4;

    public static $statuses = [
        ['id' => self::USER_STATUS_NOT_ACTIVE,  'title' => 'Not active'],
        ['id' => self::USER_STATUS_BANNED,      'title' => 'Banned'],
        ['id' => self::USER_STATUS_USER,        'title' => 'User'],
        ['id' => self::USER_STATUS_MODERATOR,   'title' => 'Moder'],
        ['id' => self::USER_STATUS_ADMIN,       'title' => 'Admin'],
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::USER_STATUS_NOT_ACTIVE],
            ['status', 'in', 'range' => [self::USER_STATUS_NOT_ACTIVE, self::USER_STATUS_BANNED, self::USER_STATUS_USER,
                self::USER_STATUS_MODERATOR, self::USER_STATUS_ADMIN]],
        ];

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => '№',
            'username'      => "Ім'я",
            'auth_key'      => "Ключ",
            'password_hash' => 'Пароль',
            'email'         => 'Email, Логін',
            'status'        => 'Статус',
            'avatar'        => 'Аватар',
            'created_at'    => 'Створено',
            'updated_at'    => 'Оновлено',
        ];
    }

    /**
     * @return null |null
     */
    public function getUserStatus()
    {
        return ArrayHelper::map(self::$statuses, 'id', 'title')[$this->status] ?: null;
    }

    /**
     * Check is user admin
     * @return bool
     */
    public function getIsAdmin()
    {
        return $this->status === self::USER_STATUS_ADMIN;
    }

    /**
     * Check is user admin
     * @return bool
     */
    public function getIsModer()
    {
        return $this->status === self::USER_STATUS_MODERATOR;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['user_id' => 'id']);
    }

    /**
     * @param int|string $id
     * @return User|IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return void|IdentityInterface
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @param $email
     * @return array|ActiveRecord|null
     */
    public static function findByEmail($email)
    {
        return User::findOne(['email' => $email]);
    }

    /**
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @param $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @throws \yii\base\Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @param $user_id
     * @param $name
     * @param $photo
     * @return bool
     */
    public function saveFromVk($user_id, $name, $photo)
    {
        $user = User::findOne($user_id);
        if($user)
        {
            return Yii::$app->user->login($user);
        }
        
        $this->id = $user_id;
        $this->username = $name;
        $this->avatar = $photo;
        $this->save();
        
        return Yii::$app->user->login($this);
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return ($this->avatar) ?: '';
    }

    /**
     *
     */
    public function deleteAvatar()
    {
        (new ImageUpload())->deleteCurrentImage($this->avatar);
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        $this->deleteAvatar();
        return parent::beforeDelete();
    }

    /**
     * @param $user_id
     * @return bool
     */
    public function sendActivationEmail($user_id)
    {
        if($user = User::findOne($user_id)){
            return Yii::$app->mailer->compose(
                ['html' => '', 'text' => ''],
                ['user' => $user]
            )
                ->setFrom([env('supportEmail', 'nomail@test.test') => env('appName', 'Yii-test-project'). ' robot'])
                ->setTo($user->email)
                ->setSubject('Activate account on' . env('appName', 'Yii-test-project'))
                ->send();
        }
        return false;
    }
}
