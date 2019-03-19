<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "dog_show".
 *
 * @property int $id
 * @property int $dog_id
 * @property int $show_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Dog $dog
 * @property Show $show
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
            [['dog_id', 'show_id'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['dog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dog::class, 'targetAttribute' => ['dog_id' => 'id']],
            [['show_id'], 'exist', 'skipOnError' => true, 'targetClass' => Show::class, 'targetAttribute' => ['show_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dog_id' => 'Dog ID',
            'show_id' => 'Show ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDog()
    {
        return $this->hasOne(Dog::class, ['id' => 'dog_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShow()
    {
        return $this->hasOne(Show::class, ['id' => 'show_id']);
    }
}
