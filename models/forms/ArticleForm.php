<?php
/**
 * Created by PhpStorm.
 * User: comrade
 * Date: 15.03.19
 * Time: 23:55
 */

namespace app\models\forms;


use app\models\Article;
use app\models\Category;
use app\models\ImageUpload;
use app\models\User;
use yii\base\Model;

/**
 * Class ArticleForm
 * @package app\models\forms
 */
class ArticleForm extends Model
{
    /** @var integer $id */
    public $id;
    /** @var string $title */
    public $title;
    /** @var string $description */
    public $description;
    /** @var string $content */
    public $content;
    /** @var string $image */
    public $image;
    /** @var integer $viewed */
    public $viewed;

    /** @var User $user */
    public $user;
    /** @var integer $user_id */
    public $user_id;

    /** @var integer $status */
    public $status;

    /** @var Category $category */
    public $category;
    /** @var integer $category_id */
    public $category_id;

    /** @var integer $created_at */
    public $created_at;
    /** @var integer $updated_at */
    public $updated_at;

    /** @var Article $article */
    public $article;

    /** @var ImageUpload $imageUpload */
    public $imageUpload;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if($this->article){
            $this->setAttributes($this->article->getAttributes());
            $this->user = User::findOne($this->article->user_id);
            $this->category = Category::findOne($this->article->category_id);
        }
    }

    /**
     * {@inheritdoc}
     * @return array
     */
    public function rules()
    {
        return[
            [['title'], 'required'],
            [['title','description','content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['category_id', 'status', 'viewed', 'user_id', 'category_id'], 'integer'],
            ['image', 'file', 'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'], 'checkExtensionByMimeType' => true, 'maxSize' => 15 * 1024 * 1024],
        ];
    }

    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function create()
    {
        if(!$this->validate()){
            return false;
        }

        $transaction = \Yii::$app->db->beginTransaction();

        $this->article->setAttributes($this->getAttributes());
        $this->article->user_id;

        if($this->article->save()){

            $transaction->commit();
            return true;
        }

        $transaction->rollBack();
        return false;
    }

    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function update()
    {
        if(!$this->validate()){
            return false;
        }

        $transaction = \Yii::$app->db->beginTransaction();

        $this->article->setAttributes($this->getAttributes());
        $this->article->user_id;

        if($this->article->save()){

            $transaction->commit();
            return true;
        }

        $transaction->rollBack();
        return false;
    }
}