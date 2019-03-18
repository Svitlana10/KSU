<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "show".
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
 * @property bool $finishRegStatus
 * @property string $image
 * @property bool $startRegStatus
 * @property string $status
 * @property User $user
 */
class Show extends \yii\db\ActiveRecord
{

    const STATUS_REG_COMING_SOON = 'Скоро буде..';
    const STATUS_REG_GOING = 'Йде реєстрація..';
    const STATUS_REH_END = 'Рєстрація закінчена..';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'show';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'address', 'show_date'], 'required'],
            [['description'], 'string'],
            [['show_date', 'start_reg_date', 'end_reg_date', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'address', 'img'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'title' => 'Назва',
            'description' => 'Опис',
            'address' => 'Адреса',
            'show_date' => 'Дата виставки',
            'img' => 'Картинка',
            'start_reg_date' => 'Початок реєстрації',
            'end_reg_date' => 'Кінець реєстрації',
            'user_id' => 'Користувач',
            'created_at' => 'Дата створення',
            'updated_at' => 'Дата оновлення',
        ];
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
    public function getStartRegStatus()
    {
        return ($this->start_reg_date >= time()) ? true : false;
    }

    /**
     * @return bool
     */
    public function getFinishRegStatus()
    {
        return ($this->startRegStatus && $this->end_reg_date >= time()) ? true : false;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return ($this->startRegStatus) ? ($this->finishRegStatus) ? self::STATUS_REH_END : self::STATUS_REG_GOING : self::STATUS_REG_COMING_SOON;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
