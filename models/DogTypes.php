<?php
declare(strict_types=1);

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "dog_types".
 *
 * @property int $id
 * @property string $title
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Dog[] $dogs
 */
class DogTypes extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dog_types';
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
            [['title'], 'string', 'max' => 255],
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
     * @return ActiveQuery
     */
    public function getDogs()
    {
        return $this->hasMany(Dog::class, ['type_id' => 'id']);
    }

    /**
     * @return array
     */
    public static function getBreedsList()
    {
        $breeds = self::find()
            ->select(['id', 'title'])
            ->all();

        return ArrayHelper::map($breeds, 'id', 'title');
    }
}
