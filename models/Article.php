<?php

namespace app\models;

use app\models\forms\ArticleForm;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "articles".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $image
 * @property integer $viewed
 * @property integer $user_id
 * @property integer $status
 * @property integer $category_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string  $statusText
 *
 * @property array $selectedTags
 *
 * @property ArticleTag[] $articleTags
 * @property Comment[] $comments
 * @property Category $category
 */
class Article extends \yii\db\ActiveRecord
{

    const STATUS_PUBLISH = '10';
    const STATUS_UNPUBLISH = '0';

    /**
     * @var array
     */
    public static $statuses = [
        ['id' => self::STATUS_PUBLISH, 'title' => 'Publish'],
        ['id' => self::STATUS_UNPUBLISH, 'title' => 'Un publish'],
    ];

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
            [['title'], 'string', 'max' => 255],
            [['category_id', 'status'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_UNPUBLISH],
            ['status', 'in', 'range' => [self::STATUS_PUBLISH, self::STATUS_UNPUBLISH]]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => '№',
            'title'         => 'Назва',
            'description'   => 'Опис',
            'content'       => 'Вміст',
            'image'         => 'Фото',
            'viewed'        => 'Переглянуто',
            'user_id'       => '№ користувача',
            'status'        => 'Статус',
            'category_id'   => '№ категорії',
            'created_at'    => 'Дата створення',
            'updated_at'    => 'Дата оновлення',
        ];
    }

    /**
     * @return string | null
     */
    public function getStatusText()
    {
        return ArrayHelper::map(self::$statuses, 'id', 'title')[$this->status] ?: null;
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
        return ($this->image) ? '/img/uploads/' . $this->image : '/no-image.png';
    }

    /**
     * @throws \yii\base\Exception
     */
    public function deleteImage()
    {
        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->image);
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert)
    {
        $photo = new ImageUpload();
        $form = new ArticleForm();

        if($file = UploadedFile::getInstance($form, 'image') ?: UploadedFile::getInstanceByName('image')){
            $this->image = $photo->uploadFile($file, $this->image);
        }

        return parent::beforeSave($insert);
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
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
        return ArrayHelper::getColumn($this->getTags()->select('id')->asArray()->all(), 'id');
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
            ->orderBy(['created_at' => SORT_DESC])
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
        return Article::find()->orderBy('created_at desc')->limit(4)->all();
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
        return $this->getComments()->where(['status'=>Comment::STATUS_ALLOW])->all();
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
