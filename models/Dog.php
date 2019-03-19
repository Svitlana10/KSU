<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "dogs".
 *
 * @property int $id
 * @property string $dog_name
 * @property int $breed_id
 * @property string $pedigree_number
 * @property string $owner
 * @property int $months
 * @property int $type_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property DogShow[] $dogShows
 * @property DogBreeds $breed
 * @property DogTypes $type
 */
class Dog extends \yii\db\ActiveRecord
{
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
            [['breed_id', 'months', 'type_id'], 'integer'],
            [['dog_name', 'pedigree_number', 'owner'], 'string', 'max' => 255],
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
     * @return \yii\db\ActiveQuery
     */
    public function getDogShows()
    {
        return $this->hasMany(DogShow::class, ['dog_id' => 'id']);
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
}
