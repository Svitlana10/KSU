<?php

namespace app\models;

use Yii;
use yii\base\InvalidConfigException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $text
 * @property integer $user_id
 * @property integer $article_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Article $article
 * @property string $date
 * @property User $user
 */
class Comment extends ActiveRecord
{
    /**
     * @inheritdoc
     */

    const STATUS_ALLOW = 1;
    const STATUS_DISALLOW = 0;

    public static function tableName()
    {
        return '{{%comments}}';
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
            [['user_id', 'article_id', 'status'], 'integer'],
            [['text'], 'string', 'max' => 255],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::class, 'targetAttribute' => ['article_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'text' => 'Текст',
            'user_id' => '№ користувача',
            'article_id' => 'Article ID',
            'status' => 'Статус',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::class, ['id' => 'article_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->created_at);
    }

    /**
     * @return bool
     */
    public function isAllowed()
    {
        return $this->status === self::STATUS_ALLOW;
    }

    /**
     * @return bool
     */
    public function allow()
    {
        $this->status = self::STATUS_ALLOW;
        return $this->save(false);
    }

    /**
     * @return bool
     */
    public function disallow()
    {
        $this->status = self::STATUS_DISALLOW;
        return $this->save(false);
    }
}
