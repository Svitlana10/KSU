<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "articles".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $date
 * @property string $image
 * @property integer $viewed
 * @property integer $user_id
 * @property integer $status
 * @property integer $category_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ArticleTag[] $articleTags
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%articles}}';
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
            [['title'], 'required'],
            [['title','description','content'], 'string'],
            [['date'], 'default', 'value'=>date('Y-m-d H:i:s')],
            [['title'], 'string', 'max' => 255],
            [['category_id'], 'number']
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
            'description' => 'Опис',
            'content' => 'Вміст',
            'date' => 'Дата',
            'image' => 'Фото',
            'viewed' => 'Переглянуто',
            'user_id' => '№ користувача',
            'status' => 'Статус',
            'category_id' => '№ категорії',
        ];
    }

    /**
     * @return bool
     */
    public function saveArticle()
    {
        $this->user_id = Yii::$app->user->id;
        return $this->save(false);
    }

    /**
     * @param $filename
     * @return bool
     */
    public function saveImage($filename)
    {
        $this->image = $filename;
        return $this->save(false);
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return ($this->image) ? '/uploads/' . $this->image : '/no-image.png';
    }

    /**
     *
     */
    public function deleteImage()
    {
        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->image);
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * @param $category_id
     * @return bool
     */
    public function saveCategory($category_id)
    {
        $category = Category::findOne($category_id);
        if($category != null)
        {
            $this->link('category', $category);
            return true;            
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('article_tag', ['article_id' => 'id']);
    }

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function getSelectedTags()
    {
         $selectedIds = $this->getTags()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedIds, 'id');
    }

    /**
     * @param $tags
     */
    public function saveTags($tags)
    {
        if (is_array($tags))
        {
            $this->clearCurrentTags();

            foreach($tags as $tag_id)
            {
                $tag = Tag::findOne($tag_id);
                $this->link('tags', $tag);
            }
        }
    }

    /**
     * 
     */
    public function clearCurrentTags()
    {
        ArticleTag::deleteAll(['article_id'=>$this->id]);
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->date);
    }

    /**
     * @param int $pageSize
     * @return mixed
     */
    public static function getAll($pageSize = 5)
    {
        // build a DB query to get all articles
        $query = Article::find();

        // get the total number of articles (but do not fetch the article data yet)
        $count = $query->count();

        // create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=>$pageSize]);

        // limit the query using the pagination and retrieve the articles
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('date desc')
            ->all();
        
        $data['articles'] = $articles;
        $data['pagination'] = $pagination;
        
        return $data;
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getPopular()
    {
        return Article::find()->orderBy('viewed desc')->limit(3)->all();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getRecent()
    {
        return Article::find()->orderBy('date asc')->limit(4)->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['article_id'=>'id']);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getArticleComments()
    {
        return $this->getComments()->where(['status'=>1])->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id'=>'user_id']);
    }

    /**
     * @return bool
     */
    public function viewedCounter()
    {
        $this->viewed += 1;
        return $this->save(false);
    }
}
