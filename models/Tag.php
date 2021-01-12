<?php
declare(strict_types=1);

namespace app\models;

use yii\base\InvalidConfigException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tags".
 *
 * @property integer $id
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ActiveQuery $articles
 * @property ArticleTag[] $articleTags
 */
class Tag extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tags}}';
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
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'title' => 'Назва',
        ];
    }

    /**
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getArticles()
    {
        return $this->hasMany(Article::class, ['id' => 'article_id'])
            ->viaTable('article_tag', ['tag_id' => 'id']);
    }
}
