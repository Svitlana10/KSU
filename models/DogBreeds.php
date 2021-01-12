<?php
declare(strict_types=1);

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "dog_breeds".
 *
 * @property int $id
 * @property string $title
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property string|null $statusTitle
 * @property Dog[] $dogs
 */
class DogBreeds extends ActiveRecord
{

    const STATUS_NEW = 1;
    const STATUS_APPROVED = 2;

    /**@var array $statuses */
    public static $statuses = [
        ['id' => self::STATUS_NEW, 'title' => 'NEW'],
        ['id' => self::STATUS_APPROVED, 'title' => 'APPROVED'],
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dog_breeds';
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
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['status'], 'integer'],
            [['status'], 'default', 'value' => self::STATUS_NEW],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return array
     */
    public static function getBreedsList()
    {
        $breeds = self::find()
            ->select(['id', 'title'])
            ->distinct(true)
            ->all();

        return ArrayHelper::map($breeds, 'id', 'title');
    }

    /**
     * @return string|null
     */
    public function getStatusTitle()
    {
        return ArrayHelper::map(self::$statuses, 'id', 'title')[$this->status] ?: null;
    }

    /**
     * @return ActiveQuery
     */
    public function getDogs()
    {
        return $this->hasMany(Dog::class, ['breed_id' => 'id']);
    }
}
