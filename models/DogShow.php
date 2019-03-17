<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dog_show".
 *
 * @property int $id
 * @property string $tile
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
    public function rules()
    {
        return [
            [['tile', 'description', 'address', 'show_date'], 'required'],
            [['description'], 'string'],
            [['show_date', 'start_reg_date', 'end_reg_date', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['tile', 'address', 'img'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tile' => 'Tile',
            'description' => 'Description',
            'address' => 'Address',
            'show_date' => 'Show Date',
            'img' => 'Img',
            'start_reg_date' => 'Start Reg Date',
            'end_reg_date' => 'End Reg Date',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(user::class, ['id' => 'user_id']);
    }
}
