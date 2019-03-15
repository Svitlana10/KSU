<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\data\Pagination;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%categories}}';
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
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::class, ['category_id' => 'id']);
    }

    /**
     * @return int|string
     */
    public function getArticlesCount()
    {
        return $this->getArticles()->count();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getAll()
    {
        return Category::find()->all();
    }

    public static function getAllAsArray()
    {
        return Category::find()->asArray()->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getArticlesByCategory($id)
    {
        // build a DB query to get all articles
        $query = Article::find()->where(['category_id'=>$id]);

        // get the total number of articles (but do not fetch the article data yet)
        $count = $query->count();

        // create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=>6]);

        // limit the query using the pagination and retrieve the articles
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $data['articles'] = $articles;
        $data['pagination'] = $pagination;
        
        return $data;
    }
}
