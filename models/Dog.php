<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "dogs".
 *
 * @property int $id
 * @property string $dog_name
 * @property int $breed_id
 * @property string $pedigree_number
 * @property string $owner
 * @property int $status
 * @property int $months
 * @property int $type_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property DogShow[] $dogShows
 * @property DogBreeds $breed
 * @property null|string $statusTitle
 * @property string $breedTitle
 * @property DogTypes $type
 */
class Dog extends \yii\db\ActiveRecord
{

    const STATUS_NEW        = 1;
    const STATUS_APPROVED   = 2;

    /** @var string $breed */
    public $breed_title;

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
        return 'dogs';
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
            [['breed_id', 'months', 'type_id', 'status'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_NEW],
            [['dog_name', 'pedigree_number', 'owner', 'breed_title'], 'string', 'max' => 255],
            [['breed_id'], 'exist', 'skipOnError' => true, 'targetClass' => DogBreeds::class, 'targetAttribute' => ['breed_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DogTypes::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dog_name' => 'Dog Name',
            'breed_id' => 'Breed ID',
            'pedigree_number' => 'Pedigree Number',
            'owner' => 'Owner',
            'months' => 'Months',
            'type_id' => 'Type ID',
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
    public function getDogShows()
    {
        return $this->hasMany(DogShow::class, ['dog_id' => 'id']);
    }

    public function getBreedTitle()
    {
        return ($breed = $this->breed) ? $breed->title : '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBreed()
    {
        return $this->hasOne(DogBreeds::class, ['id' => 'breed_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(DogTypes::class, ['id' => 'type_id']);
    }

    public static function getAllTypes()
    {
        return ArrayHelper::map(DogTypes::find()->select(['id', 'title'])->asArray()->all(), 'id', 'title');
    }
}
