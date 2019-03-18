<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "dog_show".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $address
 * @property int $show_date
 * @property string $img
 * @property int $start_reg_date
 * @property int $end_reg_date
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property boolean startRegStatus
 *
 * @property bool $finishRegStatus
 * @property string $image
 * @property User $user
 */
class DogShow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dog_show';
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'title', 'description', 'address',
                'show_date', 'start_reg_da', 'end_reg_date'
            ], 'required'],
            [['description'], 'string'],
            [['show_date', 'start_reg_date', 'end_reg_date', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'address', 'img'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['start_reg_da'], 'default', 'value' => time()]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'                => '№',
            'title'             => 'Назва',
            'description'       => 'Опис',
            'address'           => 'Адреса',
            'show_date'         => 'Дата виставки',
            'img'               => 'Картинка',
            'start_reg_date'    => 'Початок реєстрації',
            'end_reg_date'      => 'Кінець реєстрації',
            'user_id'           => 'Користувач',
            'created_at'        => 'Дата створення',
            'updated_at'        => 'Дата оновлення',
        ];
    }

    /**
     * @return bool
     */
    public function getStartRegStatus()
    {
        return ($this->start_reg_date >= time()) ? true : false;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return ($this->img) ? '/img/uploads/' . $this->img : '/no-image.png';
    }

    /**
     * @return bool
     */
    public function getFinishRegStatus()
    {
        return ($this->startRegStatus && $this->end_reg_date <= time()) ? true : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
