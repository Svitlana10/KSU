<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "dog_show".
 *
 * @property int $id
 * @property int $dog_id
 * @property int $status
 * @property int $show_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Dog $dog
 * @property Show $show
 */
class DogShow extends \yii\db\ActiveRecord
{
    const STATUS_NEW        = 1;
    const STATUS_APPROVED   = 2;

    /**@var array $statuses*/
    public static $statuses = [
        ['id' => self::STATUS_NEW, 'title' => 'NEW'],
        ['id' => self::STATUS_APPROVED, 'title' => 'APPROVED'],
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%dog_show}}';
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
            [['dog_id', 'show_id', 'status'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_NEW],
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
     * @return string|null
     */
    public function getStatusTitle()
    {
        return ArrayHelper::map(self::$statuses, 'id', 'title')[$this->status] ?: null;
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
